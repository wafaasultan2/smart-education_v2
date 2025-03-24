<?php

namespace App\Http\Controllers;

use App\Enums\Days;
use App\Enums\Levels;
use App\Models\AttendanceRecord;
use App\Models\Lecture;
use App\Models\Setting;
use App\Models\Teacher;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;

class ReportTeacherController extends Controller
{
    public $name;
    public $logo;

    public function __construct()
    {
        $settings = Setting::whereIn('key', ['logo_path', 'name_collage'])->pluck('value', 'key');

        $this->logo = $settings['logo_path'] ?? 'default_logo.png'; // استبدل بالقيمة الافتراضية المناسبة
        $this->name = $settings['name_collage'] ?? 'Default Name'; // استبدل بالقيمة الافتراضية المناسبة
    }


    public function reportTeacher(Teacher $teacher)
    {
        $attendanceRecords = AttendanceRecord::forActiveYearAndTerm()
            ->where('attendance_records.teacher_id', $teacher->id)
            ->groupedReport($teacher->academic_degree)
            ->get();
        $tax = Setting::where('key', 'tax')->first()->value ?? 0.1;
        return view(
            'home.report_teacher.report',
            [
                'name' => $this->name,
                'logo' => $this->logo,
                'teacher' => $teacher,
                'attendanceRecords' => $attendanceRecords,
                'tax' => $tax
            ]
        );
    }

    public function test()
    {
       
        $pdf = SnappyPdf::loadView('reports.lecture-report')->setPaper('A4');
        return $pdf->stream('report.pdf');
    }
}
