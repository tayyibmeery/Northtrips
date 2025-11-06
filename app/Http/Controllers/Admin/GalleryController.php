<?php
// app/Http/Controllers/Admin/GalleryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('category')->ordered()->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        $categories = GalleryCategory::active()->ordered()->get();
        return view('admin.galleries.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:gallery_categories,id',
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageDirectory = public_path('images/galleries');

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

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery item created successfully.');
    }

    public function edit(Gallery $gallery)
    {
        $categories = GalleryCategory::active()->ordered()->get();
        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'category_id' => 'required|exists:gallery_categories,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageDirectory = public_path('images/galleries');

            // Create directory if it doesn't exist
            if (!file_exists($imageDirectory)) {
                mkdir($imageDirectory, 0755, true);
            }

            // Delete old image if exists
            if ($gallery->image) {
                $oldImagePath = $imageDirectory . '/' . $gallery->image;
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

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        // Delete image
        if ($gallery->image) {
            $imagePath = public_path('images/galleries/' . $gallery->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery item deleted successfully.');
    }
}
