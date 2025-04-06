<?php

namespace App\Models;

use App\Enums\Levels;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'num_job',
        'name',
        'academic_degree',
        'phone',
        'email',
        'address',
        'image',
        'status',
        'department_id',
    ];


    // العلاقة مع الدورات (Many-to-Many)
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'courses_teachers', 'teacher_id', 'course_id')
            ->withTimestamps();
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'teacher_id');
    }


    // العلاقة مع الأقسام (Many-to-Many)
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'departments_teachers', 'teacher_id', 'department_id')
            ->withTimestamps();
    }

    public function name()
    {
        $name = trim($this->name);
        $words = explode(" ", $name);
        if (count($words) === 0) {
            return "";
        }

        if (count($words) === 1) {
            return strtoupper($words[0][0]);
        }
        $firstWord = $words[0];
        $lastWord = $words[count($words) - 1];
        $firstInitial = strtoupper($firstWord[0]);
        $lastInitial = strtoupper($lastWord[strlen($lastWord) - 1]);

        return $firstInitial . $lastInitial;
    }

    public function attendanceRecords()
    {
        return $this->hasMany(AttendanceRecord::class, 'teacher_id');
    }


}
