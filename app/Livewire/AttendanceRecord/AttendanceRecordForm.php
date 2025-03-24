<?php

namespace App\Livewire\AttendanceRecord;

use App\Models\AttendanceRecord;
use App\Models\Lecture;
use App\Models\Teacher;
use App\Models\Year;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class AttendanceRecordForm extends Component
{
    public $teachers;
    public $lectures = [];
    public $departments = [];
    public $teacher_id;
    public $lecture_id;
    public $department_id;

    public $rules = [
        'teacher_id' => 'required|exists:teachers,id',
        'lecture_id' => 'required|exists:lectures,id',
        'department_id' => 'required|exists:departments,id',
    ];

    public $messages = [
        'teacher_id.required' => 'حقل الأستاذ مطلوب.',
        'teacher_id.exists' => 'الأستاذ المختار غير صالح.',
        'lecture_id.required' => 'حقل المحاضرة مطلوب.',
        'lecture_id.exists' => 'المحاضرة المختارة غير صالحة.',
        'department_id.required' => 'حقل القسم مطلوب.',
        'department_id.exists' => 'القسم المختار غير صالح.',
    ];


    public function mount()
    {
        $this->teachers = Teacher::get();
    }

    #[On('toggleTeacher')]
    public function toggleTeacher($teacher_id)
    {
        $this->teacher_id = $teacher_id;
        $teacher = Teacher::find($this->teacher_id);
        $this->departments = $teacher->lectures->pluck('department')->unique();
        $this->lectures = [];
        $this->dispatch('inintSelect', $this->teacher_id);
    }

    #[On('toggleDepartment')]
    public function toggleDepartment()
    {
        $teacher = Teacher::find($this->teacher_id);
        $this->lectures = $teacher->lectures->where('department_id', $this->department_id);
        $this->dispatch('inintSelect', $this->teacher_id);
    }

    public function submit()
    {
        $this->validate();
        $attendance = null;
        try {
            $year = Year::active()?->show()->first();
            if (!$year) {
                throw new \Exception('لا يوجد عام دراسي نشط.');
            }
            $lecture = Lecture::find($this->lecture_id);
            $lectureCount = DB::table('attendance_records')
                ->join('lectures', 'attendance_records.lecture_id', '=', 'lectures.id')
                ->where('attendance_records.teacher_id', $this->teacher_id)
                ->where('attendance_records.is_attended', true)
                ->where('lectures.course_id', $lecture->course_id) // نفس المادة
                ->where('lectures.department_id', $this->department_id) // نفس القسم
                ->where('lectures.year', $lecture->year) // نفس العام
                ->where('lectures.term', $lecture->term) // نفس الترم
                ->count();
            if ($lectureCount >= 12) {
                throw new \Exception('لا يمكن تسجيل حضور أكثر من 12 محاضرة في الترم.');
            }

            $attendance = AttendanceRecord::create([
                'lecture_id' => $this->lecture_id,
                'teacher_id' => $this->teacher_id,
                'department_id' => $this->department_id, // إضافة department_id
                'created_at' => now(),
            ]);
            $this->departments = [];
            $this->lectures = [];
            $this->dispatch('attendanceRecordCreated',  $attendance->id);
        } catch (\Exception $e) {
            $this->dispatch('errorEvent', ['message' => $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.attendance-record.attendance-record-form');
    }
}
