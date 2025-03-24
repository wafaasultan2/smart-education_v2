<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $fillable = [
        'id',
        'name',
        'TEACHING_ASSISTANT',
        'LECTURER',
        'ASSISTANT_PROFESSOR',
        'ASSOCIATE_PROFESSOR',
        'PROFESSOR',
        'description',
        'is_active',
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class, 'department_id');
    }

    public function attendanceRecords()
    {
        return $this->hasMany(AttendanceRecord::class, 'department_id');
    }

    // العلاقة مع المعلمين (Many-to-Many)
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'departments_teachers', 'department_id', 'teacher_id')
            ->withTimestamps();
    }

    public function relatedModel()
    {
        return $this->plans()->exists() || $this->teachers()->exists();
    }
}
