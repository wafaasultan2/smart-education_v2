<?php

namespace App\Livewire\Lecture;

use App\Models\Lecture;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LectureTable extends Component
{

    public $search = '';
    public $perPage = 10;
    public $paginate;
    public $lectures;


    protected $updatesQueryString = ['search', 'perPage'];
    protected $listeners = ['lectureCreated' => 'addLecture', 'lectureDelete' => 'lectureDelete'];


    public function lectureDelete($id)
    {
        $message = '';
        $status = 'danger';
        try {
            $lecture = Lecture::findOrFail($id);
            if ($lecture->relatedModel()) {
                $message = 'لا يمكن حذف هذا الخطة لأنه مرتبط ببيانات أخرى.';
                return;
            }

            $lecture->delete();
            $this->lectures = array_filter($this->lectures, function ($lecture) use ($id) {
                return $lecture->id != $id;
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
            $this->dispatch('lectureDeleted', ['message' => $message, 'status' => $status]);
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

    public function addLecture($data)
    {
        if ($data['id'] == null) return;
        $lecture = Lecture::find($data['id'])?->first();
        if ($lecture == null) return;
        array_unshift($this->lectures, $lecture);
    }

    public function gotoPage($page)
    {
        $this->initPaginate($this->search($page));
    }


    private function search($page = 1)
    {
        $query = Lecture::forActiveYearAndTerm();
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
        $this->lectures = $paginate->items();
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
        return view('livewire.lecture.lecture-table');
    }
}
