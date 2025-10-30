<?php
// app/Models/SocialMediaLink.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform_name',
        'icon_class',
        'url',
        'status'
    ];
}