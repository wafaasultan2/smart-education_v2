<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportTeacherController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'ban',
    'redirect.role'
])->group(function () {
    Route::get('/', function () {
        return view('home.dashboard');
    })->name('dashboard');

    Route::get('/department', function () {
        return view('home.department');
    })->name('department');

    Route::get('/plan', function () {
        return view('home.plan');
    })->name('plan');

    Route::get('/course', function () {
        return view('home.course');
    })->name('course');

    Route::get('/classroom', function () {
        return view('home.hall');
    })->name('classroom');

    Route::get('/teachers', function () {
        return view('home.teacher');
    })->name('teacher');

    Route::get('/teachers/report/{teacher}', [ReportTeacherController::class,'reportTeacher'])->name('teacher.report.reportTeacher');

    Route::get('/plan/report', function () {
        return view('home.report');
    })->name('plan.report');

    Route::get('/Lecture', function () {
        return view('home.lecture');
    })->name('lecture');

    Route::get('/Lecture/report', [ReportTeacherController::class,'test'])->name('lecture.report');

    Route::get('/students', function () {
        return view('home.students');
    })->name('students');

    Route::get('/attendance-record', function () {
        return view('home.attendance-record');
    })->name('attendance-record');

    Route::get('/users',  function () {
        return view('home.user');
    })->name('users');

    Route::get('/settings', function () {
        return view('home.settings');
    })->name('settings');
});


Route::get('year', function () {
    function getAcademicYears()
    {
        $academicYears = [];
        $startYear = 2000;  // البداية من سنة 2000
        $currentYear = (int)date("Y");  // الحصول على السنة الحالية

        // حساب الأعوام الدراسية من 2000 حتى السنة الدراسية الحالية
        for ($i = $startYear; $i <= $currentYear; $i++) {
            $academicYears["$i"] = $i . '-' . ($i + 1);
        }

        return $academicYears;
    }

    // استخدام الدالة لتوليد عوام دراسية من سنة 2000 حتى السنة الدراسية الحالية
    $academicYears = getAcademicYears();
    dd($academicYears);
});
