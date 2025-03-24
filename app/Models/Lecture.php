<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = ['name', 'time_lecture', 'group', 'type', 'day', 'academic_year_id', 'course_id', 'teacher_id', 'classroom_id',  'term', 'year', 'department_id'];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
    
    public function attendanceRecords()
    {
        return $this->hasMany(AttendanceRecord::class, 'lecture_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, "classroom_id");
    }
    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class, 'term');
    }

    public function year()
    {
        return $this->belongsTo(Year::class, 'year');
    }

    // active year
    public function scopeForActiveYearAndTerm($query)
    {
        $year = Year::show()->first();
        if ($year) {
            $term = $year->terms()->active()->first();

            if ($term) {
                return $query->where('year', $year->id)->where('term', $term->id);
            }
        }
        return $query->whereNull('year')->whereNull('term');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
