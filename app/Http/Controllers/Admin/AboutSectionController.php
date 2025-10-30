<?php
// app/Http/Controllers/Admin/AboutSectionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutSectionController extends Controller
{
    public function index()
    {
        $aboutSections = AboutSection::all();
        return view('admin.about-sections.index', compact('aboutSections'));
    }

    public function create()
    {
        return view('admin.about-sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description1' => 'nullable|string',
            'description2' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url',
            'is_active' => 'boolean'
        ]);

        $data = $request->except(['image', 'background_image']);

        // Handle main image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('about', 'public');
        }

        // Handle background image upload
        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('about', 'public');
        }

        // Handle features array
        if ($request->has('features')) {
            $features = array_filter($request->features);
            $data['features'] = $features;
        }

        AboutSection::create($data);

        return redirect()->route('admin.about-sections.index')
            ->with('success', 'About section created successfully.');
    }

    public function edit(AboutSection $aboutSection)
    {
        return view('admin.about-sections.edit', compact('aboutSection'));
    }

    public function update(Request $request, AboutSection $aboutSection)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description1' => 'nullable|string',
            'description2' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url',
            'is_active' => 'boolean'
        ]);

        $data = $request->except(['image', 'background_image']);

        // Handle main image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($aboutSection->image && Storage::exists($aboutSection->image)) {
                Storage::delete($aboutSection->image);
            }
            $data['image'] = $request->file('image')->store('about', 'public');
        }

        // Handle background image upload
        if ($request->hasFile('background_image')) {
            // Delete old background image
            if ($aboutSection->background_image && Storage::exists($aboutSection->background_image)) {
                Storage::delete($aboutSection->background_image);
            }
            $data['background_image'] = $request->file('background_image')->store('about', 'public');
        }

        // Handle features array
        if ($request->has('features')) {
            $features = array_filter($request->features);
            $data['features'] = $features;
        }

        $aboutSection->update($data);

        return redirect()->route('admin.about-sections.index')
            ->with('success', 'About section updated successfully.');
    }

    public function destroy(AboutSection $aboutSection)
    {
        // Delete images
        if ($aboutSection->image && Storage::exists($aboutSection->image)) {
            Storage::delete($aboutSection->image);
        }
        if ($aboutSection->background_image && Storage::exists($aboutSection->background_image)) {
            Storage::delete($aboutSection->background_image);
        }

        $aboutSection->delete();

        return redirect()->route('admin.about-sections.index')
            ->with('success', 'About section deleted successfully.');
    }
}