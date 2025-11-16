<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanySetting;

class CompanySettingSeeder extends Seeder
{
    public function run()
    {
        CompanySetting::create([
            'company_name' => 'NORTH TRIPS & TRAVEL',
            'logo' => null, // You can add a logo path here if you have one
            'address' => 'Office No 1, 3rd Floor Pearl Plaza, 174 Ferozpur Road, Lahore',
            'email' => 'ntrips20@gmail.com',
            'phone' => '0343-1428730, 0355-5897584',
            'whatsapp' => '0343-1428730'
        ]);
    }
}
