<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $fillable = ['id', 'name', 'level', 'term', 'type'];

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plans_courses', 'course_id', 'plan_id')
            ->withTimestamps();
    }

    // العلاقة مع المعلمين (Many-to-Many)
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'courses_teachers', 'course_id', 'teacher_id')
            ->withTimestamps();
    }


    public function relatedModel()
    {
        return $this->teachers()->exists();
    }
}
