<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function exploreTours()
    {
        return $this->hasMany(ExploreTour::class, 'category_id');
    }

    public function activeExploreTours()
    {
        return $this->hasMany(ExploreTour::class, 'category_id')->active();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeNational($query)
    {
        return $query->where('type', 'national');
    }

    public function scopeInternational($query)
    {
        return $query->where('type', 'international');
    }

    // Accessor for type display name
    public function getTypeDisplayAttribute()
    {
        return $this->type === 'national' ? 'National Tour' : 'International Tour';
    }

    // Check if category has tours
    public function getHasToursAttribute()
    {
        return $this->exploreTours()->active()->exists();
    }

    // Get tours count
    public function getToursCountAttribute()
    {
        return $this->exploreTours()->active()->count();
    }
}