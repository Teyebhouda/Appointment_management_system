<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
     public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeByPriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'like', "%{$term}%")
                     ->orWhere('description', 'like', "%{$term}%");
    }

}
