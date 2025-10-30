<?php
// app/Models/Subscriber.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}