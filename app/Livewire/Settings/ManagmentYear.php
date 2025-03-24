<?php

namespace App\Livewire\Settings;

use App\Enums\Terms;
use App\Models\Term;
use App\Models\Year;
use Livewire\Component;

class ManagmentYear extends Component
{
    public $activeYear;
    public $years;

    public $perPage = 1;
    public $paginate;

    public function updateIsShow($id)
    {
        $year = Year::show()->first();
        if ($year && $year->id == $id) return;
        if ($year) {
            $year->update(['is_show' => false]);
        }
        $year = Year::findOrFail($id);
        $year->update(['is_show' => true]);
        $this->activeYear?->refresh();
        $this->initPaginate($this->search());
    }


    public function updateIsActive($id)
    {
        if ($this->activeYear?->id == $id) return;
        $this->activeYear?->update(['is_active' => false]);
        $year = Year::findOrFail($id);
        $year->update(['is_active' => true]);
        $this->activeYear = $year;
        $this->initPaginate($this->search());
    }

    public function toggleActiveTerm($id)
    {
        $term = Term::findOrFail($id);
        if ($term->is_active) return;

        foreach ($term->year->terms as $t) {
            $t->update(['is_active' => false]);
        }

        $term->update(['is_active' => true]);
        $this->initPaginate($this->search());
    }

    public function mount()
    {
        $this->activeYear = Year::active()->first();
        $this->initPaginate($this->search());
    }

    public function openYear()
    {
        $year = now()->year;
        $yearFound = Year::where('year', sprintf('%d-%d', $year, $year + 1))->first();
        if ($yearFound) {
            throw new \Exception('سنة الدراسة مفتوحة بالفعل');
            return;
        }
        $this->activeYear?->update(['is_active' => false]);
        $this->activeYear?->update(['is_show' => false]);
        $this->activeYear = Year::create([
            'year' => sprintf('%d-%d', $year, $year + 1),
            'is_active' => true,
            'is_show' => true,
        ]);
        $this->createTermsForYear($this->activeYear->id);
        $this->initPaginate($this->search());
    }

    private function createTermsForYear($id)
    {
        Term::insert([
            [
                "year_id" => $id,
                "term_number" => Terms::First->value,
                "is_active" => true,
            ],
            [
                "year_id" => $id,
                "term_number" => Terms::Second->value,
                "is_active" => false,
            ]
        ]);
    }

    public function gotoPage($page)
    {
        $this->initPaginate($this->search($page));
    }

    private function search($page = 1)
    {
        return Year::where('id', '!=', $this->activeYear?->id)->paginate($this->perPage, ['*'], 'page', $page ?? 1);
    }


    private function initPaginate($paginate)
    {
        $this->paginate = (object)[
            'firstItem' => $paginate?->firstItem() ?? 0,
            'lastItem' => $paginate?->lastItem() ?? 0,
            'total' => $paginate?->total() ?? 0,
            'lastPage' => $paginate?->lastPage() ?? 0,
            'hasMorePages' => $paginate?->hasMorePages() ?? 0,
            'currentPage' => $paginate?->currentPage() ?? 0,
            'getPageName' => $paginate?->getPageName() ?? 0,
            'onFirstPage' => $paginate?->onFirstPage() ?? 0,
            'pages' => $paginate != null ? $this->generatePagination($paginate) : [],
        ];
        $this->years = $paginate?->items() ?? [];
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
        return view('livewire.settings.managment-year');
    }
}
