<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'itinerary_template_id',
        'day_number',
        'title',
        'description',
        'activities',
        'meals',
        'accommodation',
        'image',
        'order'
    ];

    protected $casts = [
        'day_number' => 'integer',
        'order' => 'integer'
    ];

    /**
     * Get the itinerary template that owns the day
     */
    public function itineraryTemplate()
    {
        return $this->belongsTo(ItineraryTemplate::class);
    }

    /**
     * Scope to order by day number
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('day_number')->orderBy('order');
    }
}
