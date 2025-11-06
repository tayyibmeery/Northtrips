<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'icon_color',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    // Get icon color or default
    public function getIconColorAttribute($value)
    {
        return $value ?: '#FFCE3F'; // Default primary color
    }

    // Check if service should be on left or right side
    public function getPositionAttribute()
    {
        return $this->order % 2 == 0 ? 'left' : 'right';
    }
}
