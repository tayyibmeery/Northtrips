<?php
// app/Http/Controllers/Admin/TravelGuideController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelGuide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TravelGuideController extends Controller
{
    public function index()
    {
        $guides = TravelGuide::ordered()->get();
        return view('admin.travel-guides.index', compact('guides'));
    }

    public function create()
    {
        return view('admin.travel-guides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('travel-guides', 'public');
        }

        TravelGuide::create($data);

        return redirect()->route('admin.travel-guides.index')
            ->with('success', 'Travel guide created successfully.');
    }

    public function edit(TravelGuide $travelGuide)
    {
        return view('admin.travel-guides.edit', compact('travelGuide'));
    }

    public function update(Request $request, TravelGuide $travelGuide)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($travelGuide->image && Storage::exists($travelGuide->image)) {
                Storage::delete($travelGuide->image);
            }
            $data['image'] = $request->file('image')->store('travel-guides', 'public');
        }

        $travelGuide->update($data);

        return redirect()->route('admin.travel-guides.index')
            ->with('success', 'Travel guide updated successfully.');
    }

    public function destroy(TravelGuide $travelGuide)
    {
        // Delete image
        if ($travelGuide->image && Storage::exists($travelGuide->image)) {
            Storage::delete($travelGuide->image);
        }

        $travelGuide->delete();

        return redirect()->route('admin.travel-guides.index')
            ->with('success', 'Travel guide deleted successfully.');
    }
}