<?php

namespace App\Models;

use App\Enums\AttendanceType;
use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    protected $table = 'attendance_records';

    protected $fillable = ['teacher_id', 'lecture_id', 'is_attended', 'substitute_teacher_id', 'created_at', 'department_id', 'type'];

    protected $casts = [
        'is_attended' => 'boolean',
        'type' => AttendanceType::class,
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function substituteTeacher()
    {
        return $this->belongsTo(Teacher::class, 'substitute_teacher_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function scopeForActiveYearAndTerm($query)
    {
        // جلب العام النشط والفصل النشط في استعلام واحد
        $term = Year::show()->first()?->terms()->active()->first();
        if ($term) {
            // جلب المحاضرات التي تتبع العام والفصل النشطين فقط
            return $query->whereHas('lecture', function ($query) use ($term) {
                $query->where('year', Year::show()->first()->id)->where('term', $term->id);
            });
        }

        // إرجاع استعلام فارغ في حالة عدم وجود عام أو فصل نشطين
        return $query->whereNull('lecture_id');
    }

    public function scopeGroupedReport($query,$colSalaryDegree)
    {
        return $query->join('departments', 'attendance_records.department_id', '=', 'departments.id')
            ->join('lectures', 'attendance_records.lecture_id', '=', 'lectures.id')
            ->join('courses', 'lectures.course_id', '=', 'courses.id')  // إضافة العلاقة مع جدول courses
            ->selectRaw('
                '.$colSalaryDegree.' as salary_degree,
                departments.name as department_name,
                lectures.name as lecture_name,
                courses.name as course_name,  -- اسم المادة من جدول courses
                COUNT(CASE WHEN attendance_records.is_attended = true THEN 1 END) as attended_count,
                COUNT(CASE WHEN attendance_records.is_attended = false THEN 1 END) as absent_count,
                COUNT(CASE WHEN attendance_records.type = ? THEN 1 END) as substitute_count
            ', ['تعويضي'])
            ->groupBy('departments.name', 'lectures.name', 'courses.name')  // إضافة course_name في groupBy
            ->orderBy('departments.name')
            ->orderBy('lectures.name');
    }
}
