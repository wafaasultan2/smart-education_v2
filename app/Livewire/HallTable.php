<?php

namespace App\Livewire;

use App\Models\ClassRoom;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use App\Enums\Days;
use App\Enums\TimeLecture;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class HallTable extends Component
{
    use WithPagination;

    public $search = '';
    #[Rule(['required', 'integer', 'min:1', 'between:1,1000'])]
    public $perPage = 1;
    public $paginate;
    public $screen = "all";
    public $status = "فاضية";
    protected $updatesQueryString = ['search', 'perPage'];

    public $classRooms;
    public $selectedDay;

    public function updatedSearch()
    {
        $this->initPaginate($this->fetchClassRooms());
    }

    public function changePerpage()
    {
        $this->perPage = empty($this->perPage) ? 10 : max(1, min($this->perPage, 1000));
        $this->initPaginate($this->fetchClassRooms());
    }

    public function gotoPage($page)
    {
        $this->initPaginate($this->fetchClassRooms($page));
    }

    public function mount()
    {
        $currentDay = Carbon::now()->format('l');
        $this->selectedDay = Days::from($currentDay);
        $this->initPaginate($this->fetchClassRooms());
    }

    public function fetchClassRooms($page = 1)
    {

        $info = Year::activeTermYear();

        Log::info(strtolower(trim($this->search)));
        // Base query
        $query = ClassRoom::query();
        $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower(trim($this->search)) . '%']);
        
        // Eager load lectures with filters
        $query->with(['lectures' => function ($q) use ($info) {
            $q->where('day', $this->selectedDay->value)
                ->where('year', $info['year']?->id)
                ->where('term', $info['term']?->id);
        }]);

        // Apply screen filter
        if ($this->screen == "screen") {
            $query->where('is_screen', 1);
        } else if ($this->screen == "no_screen") {
            $query->where('is_screen', 0);
        }


        // Paginate the results
        $classRooms = $query->paginate($this->perPage, ['*'], 'page', $page);

        // Transform the items in the collection
        $classRooms->getCollection()->transform(function ($classRoom) {
            $classRoom->times = [
                'EIGHT_TO_TEN' => $classRoom->lectures->contains('time_lecture', TimeLecture::EIGHT_TO_TEN->value) ? 'مشغوله' : 'فاضي',
                'TEN_TO_TWELVE' => $classRoom->lectures->contains('time_lecture', TimeLecture::TEN_TO_TWELVE->value) ? 'مشغوله' : 'فاضي',
                'TWELVE_TO_TWO' => $classRoom->lectures->contains('time_lecture', TimeLecture::TWELVE_TO_TWO->value) ? 'مشغوله' : 'فاضي',
                'TWO_TO_FOUR' => $classRoom->lectures->contains('time_lecture', TimeLecture::TWO_TO_FOUR->value) ? 'مشغوله' : 'فاضي',
            ];
            return $classRoom;
        });

        return $classRooms;
    }

    public function changeScreen()
    {
        $this->initPaginate($this->fetchClassRooms());
    }

    private function initPaginate($paginate)
    {
        $this->paginate = (object)[
            'firstItem' => $paginate->firstItem(),
            'lastItem' => $paginate->lastItem(),
            'total' => $paginate->total(),
            'lastPage' => $paginate->lastPage(),
            'hasMorePages' => $paginate->hasMorePages(),
            'currentPage' => $paginate->currentPage(),
            'getPageName' => $paginate->getPageName(),
            'onFirstPage' => $paginate->onFirstPage(),
            'pages' => $this->generatePagination($paginate)
        ];
        $this->classRooms = $paginate->items();
    }

    private function generatePagination($paginate)
    {
        $currentPage = $paginate->currentPage();
        $lastPage = $paginate->lastPage();

        $startPages = 3;
        $endPages = 3;
        $nearbyPages = 1;

        $pages = [];

        for ($i = 1; $i <= min($startPages, $lastPage); $i++) {
            $pages[] = $i;
        }
        if ($currentPage > $startPages + $nearbyPages + 1) {
            $pages[] = '...';
        }
        $startNearby = max($currentPage - $nearbyPages, $startPages + 1);
        $endNearby = min($currentPage + $nearbyPages, $lastPage - $endPages);

        for ($i = $startNearby; $i <= $endNearby; $i++) {
            if (!in_array($i, $pages))
                $pages[] = $i;
        }
        if ($currentPage < $lastPage - $endPages - $nearbyPages) {
            $pages[] = '...';
        }
        if ($lastPage - $endPages + 1 !== 0) {
            for ($i = $lastPage - $endPages + 1; $i <= $lastPage; $i++) {
                if (!in_array($i, $pages))
                    $pages[] = $i;
            }
        }
        return $pages;
    }

    public function render()
    {
        return view('livewire.hall-table');
    }
}
