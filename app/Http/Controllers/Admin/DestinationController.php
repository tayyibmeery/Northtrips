<?php
// app/Http/Controllers/Admin/DestinationController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::with('category')->ordered()->get();
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        $categories = DestinationCategory::active()->ordered()->get();
        return view('admin.destinations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:destination_categories,id',
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photos_count' => 'integer|min:1',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageDirectory = public_path('images/destinations');

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

        Destination::create($data);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination created successfully.');
    }

    public function edit(Destination $destination)
    {
        $categories = DestinationCategory::active()->ordered()->get();
        return view('admin.destinations.edit', compact('destination', 'categories'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'category_id' => 'required|exists:destination_categories,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photos_count' => 'integer|min:1',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageDirectory = public_path('images/destinations');

            // Create directory if it doesn't exist
            if (!file_exists($imageDirectory)) {
                mkdir($imageDirectory, 0755, true);
            }

            // Delete old image if exists
            if ($destination->image) {
                $oldImagePath = $imageDirectory . '/' . $destination->image;
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

        $destination->update($data);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination)
    {
        // Delete image
        if ($destination->image) {
            $imagePath = public_path('images/destinations/' . $destination->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination deleted successfully.');
    }
}
