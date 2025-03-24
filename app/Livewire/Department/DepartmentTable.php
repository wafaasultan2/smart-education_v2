<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Component;

class DepartmentTable extends Component
{
    public $perPage = 1;
    public $departments;
    public $search = '';
    public $paginate;

    protected $updatesQueryString = ['perPage'];

    protected $listeners = ['departmentCreated' => 'addDepartment', 'departemntDelete' => 'departemntDelete'];

    public function mount()
    {
        $this->initPaginate($this->search());
    }

    public function departemntDelete($id)
    {
        $message = '';
        $status = 'danger';
        try {
            $department = Department::findOrFail($id);
            if ($department->relatedModel()) {
                $message = 'لا يمكن حذف هذا القسم لأنه مرتبط ببيانات أخرى.';
                return;
            }

            $department->delete();
            $this->departments = array_filter($this->departments, function ($department) use ($id) {
                return $department->id != $id;
            });

            $message = 'تم حذف القسم بنجاح.';
            $status = 'success';
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $message = 'القسم المطلوب غير موجود.';
        } catch (\Illuminate\Database\QueryException $e) {
            $message = 'حدث خطأ أثناء الحذف. ربما توجد قيود على قاعدة البيانات.';
        } catch (\Exception $e) {
            $message = 'حدث خطأ غير متوقع.';
        } finally {
            $this->dispatch('departmentDeleted', ['message' => $message, 'status' => $status]);
        }
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

    public function addDepartment($data)
    {
        array_unshift($this->departments, Department::find($data['id']));
    }

    public function gotoPage($page)
    {
        $this->initPaginate($this->search($page));
    }


    private function search($page = 1)
    {
        $query = Department::query();
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
        $this->departments = $paginate->items();
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
        $this->departments = array_filter($this->departments);
        return view('livewire.department.department-table');
    }
}
