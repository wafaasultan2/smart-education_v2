<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $fillable = ['year_id', 'term_number', 'is_active'];

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

     // Scope لجلب ترم المفعلة فقط
     public function scopeActive($query)
     {
         return $query->where('is_active', true);
     }
     public function lectures()
     {
         return $this->belongsToMany(Lecture::class);
     }

}
