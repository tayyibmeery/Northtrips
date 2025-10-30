<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function destinations()
    {
        return $this->hasMany(Destination::class, 'category_id');
    }

    public function activeDestinations()
    {
        return $this->hasMany(Destination::class, 'category_id')->active();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    // Check if category has destinations
    public function getHasDestinationsAttribute()
    {
        return $this->destinations()->active()->exists();
    }

    // Get destinations count
    public function getDestinationsCountAttribute()
    {
        return $this->destinations()->active()->count();
    }
}