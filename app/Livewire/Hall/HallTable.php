<?php

namespace App\Livewire\Hall;

use App\Models\ClassRoom;
use Livewire\Component;
use Livewire\WithPagination;

class HallTable extends Component
{
    public $search = '';
    public $perPage = 1;
    public $paginate;
    public $halls;


    protected $updatesQueryString = ['search', 'perPage'];
    protected $listeners = ['hallCreated' => 'addHall'];

    public function mount()
    {
        $this->initPaginate($this->search());
    }

    public function updatingSearch($search)
    {
        $this->search = $search;
        $this->initPaginate($this->search());
    }

    public function changePerpage()
    {
        $this->perPage = empty($this->perPage) ? 10 : $this->perPage;
        $this->initPaginate($this->search());
    }

    public function gotoPage($page)
    {
        $this->initPaginate($this->search($page));
    }

    public function addHall($hall_id)
    {
        array_unshift($this->halls, ClassRoom::find($hall_id));
    }


    private function search($page = 1)
    {
        $query = ClassRoom::query();
        if ($this->search && !empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        return $query->paginate($this->perPage, ['*'], 'page', $page ?? 1);
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
        $this->halls = $paginate->items();
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
        return view('livewire.hall.hall-table');
    }
}
