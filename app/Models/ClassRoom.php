<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable = ['id', 'name', 'description', 'capacity', 'is_screen'];

    public function lectures()
    {
        return $this->hasMany(Lecture::class, "classroom_id");
    }
}
