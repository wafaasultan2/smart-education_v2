<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $fillable = [
        'id',
        'name',
        'description',
        'department_id',
        'is_active',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'plans_courses', 'plan_id', 'course_id')
            ->withTimestamps();
    }

    public function relatedModel()
    {
        return $this->courses()->exists();
    }

    public function scopeActive($query){
        return $query->where('is_active', true);
    }
}
