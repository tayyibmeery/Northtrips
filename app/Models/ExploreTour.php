<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExploreTour extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'image',
        'cities_count',
        'tour_places_count',
        'discount_percentage',
        'button_text',
        'button_link',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'discount_percentage' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(TourCategory::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeNational($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('type', 'national');
        });
    }

    public function scopeInternational($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('type', 'international');
        });
    }

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('img/default-tour.jpg');
    }

    // Accessor for button text with fallback
    public function getDisplayButtonTextAttribute()
    {
        return $this->button_text ?: 'View Details';
    }

    // Check if tour has discount
    public function getHasDiscountAttribute()
    {
        return !is_null($this->discount_percentage) && $this->discount_percentage > 0;
    }

    // Get discount badge color based on percentage
    public function getDiscountBadgeColorAttribute()
    {
        if (!$this->has_discount)
            return 'secondary';

        if ($this->discount_percentage >= 50) {
            return 'warning';
        } elseif ($this->discount_percentage >= 30) {
            return 'success';
        } else {
            return 'info';
        }
    }
}