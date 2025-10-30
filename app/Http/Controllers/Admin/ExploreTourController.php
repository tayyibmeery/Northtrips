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
        // $categories = DestinationCategory::active()->ordered()->get();
        return view('admin.explore-tours.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:tour_categories,id',
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            $data['image'] = $request->file('image')->store('explore-tours', 'public');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            // Delete old image
            if ($exploreTour->image && Storage::exists($exploreTour->image)) {
                Storage::delete($exploreTour->image);
            }
            $data['image'] = $request->file('image')->store('explore-tours', 'public');
        }

        $exploreTour->update($data);

        return redirect()->route('admin.explore-tours.index')
            ->with('success', 'Explore tour updated successfully.');
    }

    public function destroy(ExploreTour $exploreTour)
    {
        // Delete image
        if ($exploreTour->image && Storage::exists($exploreTour->image)) {
            Storage::delete($exploreTour->image);
        }

        $exploreTour->delete();

        return redirect()->route('admin.explore-tours.index')
            ->with('success', 'Explore tour deleted successfully.');
    }
}