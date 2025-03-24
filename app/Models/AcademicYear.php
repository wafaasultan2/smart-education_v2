<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = ['start_date', 'end_date', 'out_date', 'name', 'description', 'department_id', 'plan_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
