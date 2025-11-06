<?php
// app/Http/Controllers/Admin/ExploreTourController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DestinationCategory;
use App\Models\ExploreTour;
use App\Models\TourCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExploreTourController extends Controller
{
    public function index()
    {
        $tours = ExploreTour::with('category')->ordered()->get();
        return view('admin.explore-tours.index', compact('tours'));
    }

    public function create()
    {
        $categories = TourCategory::active()->ordered()->get();
        return view('admin.explore-tours.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:tour_categories,id',
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cities_count' => 'nullable|integer|min:0',
            'tour_places_count' => 'nullable|integer|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageDirectory = public_path('images/explore-tours');

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

        ExploreTour::create($data);

        return redirect()->route('admin.explore-tours.index')
            ->with('success', 'Explore tour created successfully.');
    }

    public function edit(ExploreTour $exploreTour)
    {
        $categories = TourCategory::active()->ordered()->get();
        return view('admin.explore-tours.edit', compact('exploreTour', 'categories'));
    }

    public function update(Request $request, ExploreTour $exploreTour)
    {
        $request->validate([
            'category_id' => 'required|exists:tour_categories,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cities_count' => 'nullable|integer|min:0',
            'tour_places_count' => 'nullable|integer|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageDirectory = public_path('images/explore-tours');

            // Create directory if it doesn't exist
            if (!file_exists($imageDirectory)) {
                mkdir($imageDirectory, 0755, true);
            }

            // Delete old image if exists
            if ($exploreTour->image) {
                $oldImagePath = $imageDirectory . '/' . $exploreTour->image;
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

        $exploreTour->update($data);

        return redirect()->route('admin.explore-tours.index')
            ->with('success', 'Explore tour updated successfully.');
    }

    public function destroy(ExploreTour $exploreTour)
    {
        // Delete image
        if ($exploreTour->image) {
            $imagePath = public_path('images/explore-tours/' . $exploreTour->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $exploreTour->delete();

        return redirect()->route('admin.explore-tours.index')
            ->with('success', 'Explore tour deleted successfully.');
    }
}
