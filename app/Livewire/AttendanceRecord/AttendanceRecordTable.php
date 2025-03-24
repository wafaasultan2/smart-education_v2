<?php

namespace App\Livewire\AttendanceRecord;

use App\Enums\Days;
use App\Models\AttendanceRecord;
use App\Models\Lecture;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class AttendanceRecordTable extends Component
{
    public $search = '';
    public $perPage = 10;
    public $paginate;
    public $attendanceRecords = [];
    public $date;

    protected $updatesQueryString = ['search', 'perPage'];
    protected $listeners = ['attendanceRecordCreated' => 'addAttendanceRecord', 'attendanceRecordDelete' => 'attendanceRecordDelete'];

    public function attendanceRecordDelete($id)
    {
        $message = '';
        $status = 'danger';
        try {
            $attendanceRecord = attendanceRecord::findOrFail($id);
            if ($attendanceRecord->relatedModel()) {
                $message = 'لا يمكن حذف هذا الخطة لأنه مرتبط ببيانات أخرى.';
                return;
            }

            $attendanceRecord->delete();
            $this->attendanceRecords = array_filter($this->attendanceRecords, function ($attendanceRecord) use ($id) {
                return $attendanceRecord->id != $id;
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
            $this->dispatch('attendanceRecordDeleted', ['message' => $message, 'status' => $status]);
        }
    }

    public function mount()
    {
        $this->date = now();
        $this->initPaginate($this->search());
    }

    #[On('dateGetAttends')]
    public function dateGetAttends($date)
    {
        $this->date = Carbon::parse($date);

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

    public function addAttendanceRecord($id)
    {
        $attendanceRecord = AttendanceRecord::find($id);
        array_unshift($this->attendanceRecords, $attendanceRecord);
    }

    public function gotoPage($page)
    {
        $this->initPaginate($this->search($page));
    }


    private function search($page = 1)
    {
        // التحقق من وجود سجلات حضور لهذا التاريخ
        if (!$this->date->gt(now()) && !AttendanceRecord::forActiveYearAndTerm()->whereDate('created_at', $this->date)->exists()) {
            Lecture::forActiveYearAndTerm()
                ->where('day', $this->date->format('l')) // الفلترة حسب اليوم
                ->get()
                ->each(function ($lecture) {
                    $teacher = $lecture->teacher;
                    $department = $lecture->department;

                    if ($teacher && $department) {
                        $lectureCount = DB::table('attendance_records')
                            ->join('lectures', 'attendance_records.lecture_id', '=', 'lectures.id')
                            ->where('attendance_records.teacher_id', $teacher->id)
                            ->where('lectures.course_id', $lecture->course_id) // نفس المادة
                            ->where('lectures.department_id', $lecture->department_id) // نفس القسم
                            ->where('lectures.year', $lecture->year) // نفس العام
                            ->where('lectures.term', $lecture->term) // نفس الترم
                            ->count();

                        Log::info($lectureCount);
                        if ($lectureCount < 12) {
                            AttendanceRecord::create([
                                'lecture_id' => $lecture->id,
                                'teacher_id' => $teacher->id,
                                'department_id' => $department->id, // إضافة department_id
                                'created_at' => $this->date,
                            ]);
                        }
                    }
                });
        }
        return AttendanceRecord::forActiveYearAndTerm()
            ->with('teacher') // تحميل العلاقة مع المعلم
            ->whereDate('created_at', $this->date)
            ->when($this->search, function ($q) {
                $q->whereHas('teacher', function ($query) {
                    $query->where('name', 'like', "%{$this->search}%");
                });
            })
            ->paginate($this->perPage, ['*'], 'page', $page);
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
        $this->attendanceRecords = $paginate->items();
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
        return view('livewire.attendance-record.attendance-record-table');
    }
}
