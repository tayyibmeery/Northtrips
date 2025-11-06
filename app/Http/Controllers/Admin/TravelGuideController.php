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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        try {
            $data = $request->except('image');

            // Handle image upload
            if ($request->hasFile('image')) {
                $imageDirectory = public_path('images/travel-guides');

                // Create directory if it doesn't exist
                if (!file_exists($imageDirectory)) {
                    mkdir($imageDirectory, 0755, true);
                }

                $imageFile = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();

                // Move uploaded file
                $imageFile->move($imageDirectory, $imageName);
                $data['image'] = $imageName;
            }

            // Handle checkbox boolean value
            $data['is_active'] = $request->has('is_active') ? true : false;

            TravelGuide::create($data);

            return redirect()->route('admin.travel-guides.index')
                ->with('success', 'Travel guide created successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating travel guide: ' . $e->getMessage())
                ->withInput();
        }
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        try {
            $data = $request->except('image');

            // Handle image upload
            if ($request->hasFile('image')) {
                $imageDirectory = public_path('images/travel-guides');

                // Create directory if it doesn't exist
                if (!file_exists($imageDirectory)) {
                    mkdir($imageDirectory, 0755, true);
                }

                // Delete old image if exists
                if ($travelGuide->image) {
                    $oldImagePath = $imageDirectory . '/' . $travelGuide->image;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Store new image
                $imageFile = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();

                // Move uploaded file
                $imageFile->move($imageDirectory, $imageName);
                $data['image'] = $imageName;
            }

            $data['is_active'] = $request->has('is_active') ? true : false;

            $travelGuide->update($data);

            return redirect()->route('admin.travel-guides.index')
                ->with('success', 'Travel guide updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating travel guide: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(TravelGuide $travelGuide)
    {
        try {
            // Delete image
            if ($travelGuide->image) {
                $imagePath = public_path('images/travel-guides/' . $travelGuide->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $travelGuide->delete();

            return redirect()->route('admin.travel-guides.index')
                ->with('success', 'Travel guide deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting travel guide: ' . $e->getMessage());
        }
    }
}
