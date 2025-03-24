<?php

namespace App\Livewire\AttendanceRecord;

use App\Models\Year;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AttendanceRecordRow extends Component
{
    public $attendanceRecord;
    public $isAttended;

    public function mount($attendanceRecord)
    {
        $this->attendanceRecord = $attendanceRecord;
        $this->isAttended = $attendanceRecord->is_attended;
    }

    public function toggleIsAttended()
    {
        try {
            $year = Year::active()?->show()->first();
            if (!$year) {
                throw new \Exception('لا يوجد عام دراسي نشط.');
            }
            $lectureCount = DB::table('attendance_records')
                ->join('lectures', 'attendance_records.lecture_id', '=', 'lectures.id')
                ->where('attendance_records.teacher_id', $this->attendanceRecord->teacher->id)
                ->where('attendance_records.is_attended', true)
                ->where('lectures.course_id', $this->attendanceRecord->lecture->course_id) // نفس المادة
                ->where('lectures.department_id', $this->attendanceRecord->lecture->department_id) // نفس القسم
                ->where('lectures.year', $this->attendanceRecord->lecture->year) // نفس العام
                ->where('lectures.term', $this->attendanceRecord->lecture->term) // نفس الترم
                ->count();
            if ($lectureCount >= 12) {
                throw new \Exception('لا يمكن تسجيل حضور أكثر من 12 محاضرة في الترم.');
            }
            $this->attendanceRecord->is_attended = !$this->attendanceRecord->is_attended;
            $this->attendanceRecord->save();
        } catch (\Exception $e) {
            $this->dispatch('errorEvent', ['message' => $e->getMessage()]);
        }
        $this->dispatch('toggleAttended', ['id' => $this->attendanceRecord->id, 'is_attended' => $this->attendanceRecord->is_attended]);
    }


    public function render()
    {
        return view('livewire.attendance-record.attendance-record-row');
    }
}
