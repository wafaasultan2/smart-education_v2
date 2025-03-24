<?php

namespace App\Livewire\Plan;

use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;

class PlanTable extends Component
{
    public $search = '';
    public $perPage = 1;
    public $paginate;
    public $plans;


    protected $updatesQueryString = ['search', 'perPage'];
    protected $listeners = ['planCreated' => 'addPlan', 'planDelete' => 'planDelete'];


    public function planDelete($id)
    {
        $message = '';
        $status = 'danger';
        try {
            $plan = Plan::findOrFail($id);
            if ($plan->relatedModel()) {
                $message = 'لا يمكن حذف هذا الخطة لأنه مرتبط ببيانات أخرى.';
                return;
            }

            $plan->delete();
            $this->plans = array_filter($this->plans, function ($plan) use ($id) {
                return $plan->id != $id;
            });

            $message = 'تم حذف الخطة بنجاح.';
            $status = 'success';
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $message = 'الخطة المطلوب غير موجود.';
        } catch (\Illuminate\Database\QueryException $e) {
            $message = 'حدث خطأ أثناء الحذف. ربما توجد قيود على قاعدة البيانات.';
        } catch (\Exception $e) {
            $message = 'حدث خطأ غير متوقع.';
        } finally {
            $this->dispatch('planDeleted', ['message' => $message, 'status' => $status]);
        }
    }

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

    public function addPlan($plan_id)
    {
        array_unshift($this->plans, Plan::find($plan_id));
    }

    public function gotoPage($page)
    {
        $this->initPaginate($this->search($page));
    }


    private function search($page = 1)
    {
        $query = Plan::query();
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
        $this->plans = $paginate->items();
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
        return view('livewire.plan.plan-table');
    }
}
