<?php
// app/Models/Booking.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'booking_date',
        'booking_time',
        'destination',
        'persons',
        'category',
        'special_request',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    // Scope for pending bookings
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope for confirmed bookings
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    // Scope for today's bookings
    public function scopeToday($query)
    {
        return $query->whereDate('booking_date', today());
    }

    // Accessor for formatted booking date
    public function getFormattedDateAttribute()
    {
        return $this->booking_date->format('M d, Y');
    }

    // Accessor for formatted booking time
    public function getFormattedTimeAttribute()
    {
        return $this->booking_time ? date('h:i A', strtotime($this->booking_time)) : 'Not specified';
    }
}