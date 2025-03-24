<?php

namespace App\Livewire\AttendanceRecord;

use App\Models\AttendanceRecord;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TableReportAttendanceRecord extends Component
{
    public $attendanceRecords = [];
    public $tax = 0.1;
    public $title = '';

    public function mount($fromDate="2025-02-01", $toDate="2025-2-29")
    {
        $this->tax = Setting::getValue('tax', $this->tax);
        $this->attendanceRecords = AttendanceRecord::select(
            'teachers.id as teacher_id',
            'teachers.name as teacher_name',
            'teachers.num_job as num_job',
            'departments.id as department_id',
            'departments.name as department_name',
            DB::raw('COUNT(attendance_records.id) as total_attendance'),
            DB::raw("
                CASE
                    WHEN teachers.academic_degree = 'TEACHING_ASSISTANT' THEN departments.TEACHING_ASSISTANT
                    WHEN teachers.academic_degree = 'LECTURER' THEN departments.LECTURER
                    WHEN teachers.academic_degree = 'ASSISTANT_PROFESSOR' THEN departments.ASSISTANT_PROFESSOR
                    WHEN teachers.academic_degree = 'ASSOCIATE_PROFESSOR' THEN departments.ASSOCIATE_PROFESSOR
                    WHEN teachers.academic_degree = 'PROFESSOR' THEN departments.PROFESSOR
                    ELSE 0
                END as salary
            ")
        )
            ->join('teachers', 'attendance_records.teacher_id', '=', 'teachers.id')
            ->join('lectures', 'attendance_records.lecture_id', '=', 'lectures.id')
            ->leftJoin('departments', 'lectures.department_id', '=', 'departments.id')
            ->forActiveYearAndTerm()
            ->where('attendance_records.is_attended', true)
            ->whereBetween('attendance_records.created_at', [$fromDate, $toDate])
            ->groupBy('teachers.id', 'departments.id')
            ->get();
    }
    public function render()
    {
        return view('livewire.attendance-record.table-report-attendance-record');
    }
}
