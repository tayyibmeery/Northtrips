<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home(){

        $setting = CompanySetting::first();
        return view('site.home', compact('setting'));
    }

    // public function aboutus()
    // {
    //     return view('site.aboutus');
    // }



}
