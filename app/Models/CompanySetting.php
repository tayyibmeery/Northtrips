<?php
// app/Models/CompanySetting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'logo',
        'address',
        'email',
        'phone',
        'whatsapp'
    ];

       public static function getSettings()
    {
        return static::first() ?? new static([
            'company_name' => 'NORTH TRIPS & TRAVEL',
            'address' => 'Office No 1, 3rd Floor Pearl Plaza, 174 Ferozpur Road, Lahore',
            'email' => 'ntrips20@gmail.com',
            'phone' => '0343-1428730, 0355-5897584',
            'whatsapp' => '0343-1428730'
        ]);
    }
}
