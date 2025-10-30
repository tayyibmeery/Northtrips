<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'destination',
        'duration_days',
        'persons', // Changed to 'persons'
        'price',
        'rating',
        'description',
        'image',
        'hotel_deals_text',
        'read_more_text',
        'read_more_link',
        'book_now_text',
        'book_now_link',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'rating' => 'decimal:1'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('img/default-package.jpg');
    }

    // Accessor for formatted price
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    // Accessor for duration display
    public function getDurationDisplayAttribute()
    {
        return $this->duration_days . ' day' . ($this->duration_days > 1 ? 's' : '');
    }

    // Accessor for persons display
    public function getPersonsDisplayAttribute()
    {
        return $this->persons . ' Person' . ($this->persons > 1 ? 's' : '');
    }

    // Generate star rating HTML
    public function getStarRatingAttribute()
    {
        $rating = $this->rating ?? 5;
        $stars = '';

        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $stars .= '<small class="fa fa-star text-primary"></small>';
            } else {
                $stars .= '<small class="fa fa-star text-secondary"></small>';
            }
        }

        return $stars;
    }
}