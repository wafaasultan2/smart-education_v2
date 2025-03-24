<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $fillable = ['year', 'is_active', 'is_show'];

    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeShow($query)
    {
        return $query->where('is_show', true);
    }

    public function isWrite()
    {
        return $this->is_active && $this->is_show;
    }


    public function scopeActiveTermYear()
    {
        $year = Year::active()?->first();
        $term = $year?->terms()->active()->first();
        return ['term' => $term, 'year' => $year];
    }
}
