<?php
// app/Http/Controllers/Admin/CompanySettingController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanySettingController extends Controller
{
    public function edit()
    {
        $companySetting = CompanySetting::first();
        if (!$companySetting) {
            $companySetting = new CompanySetting();
        }

        return view('admin.company-settings.edit', compact('companySetting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
        ]);

        $companySetting = CompanySetting::firstOrNew();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($companySetting->logo && Storage::exists($companySetting->logo)) {
                Storage::delete($companySetting->logo);
            }

            $logoPath = $request->file('logo')->store('company', 'public');
            $companySetting->logo = $logoPath;
        }

        $companySetting->company_name = $request->company_name;
        $companySetting->address = $request->address;
        $companySetting->email = $request->email;
        $companySetting->phone = $request->phone;
        $companySetting->whatsapp = $request->whatsapp;
        $companySetting->save();

        return redirect()->route('admin.company-settings.edit')
            ->with('success', 'Company settings updated successfully.');
    }
}