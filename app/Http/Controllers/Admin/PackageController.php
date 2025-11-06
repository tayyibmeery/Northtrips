<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::ordered()->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
            'persons' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'hotel_deals_text' => 'nullable|string|max:50',
            'read_more_text' => 'nullable|string|max:50',
            'read_more_link' => 'nullable|string|max:255',
            'book_now_text' => 'nullable|string|max:50',
            'book_now_link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageDirectory = public_path('images/packages');

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

        // Set default values
        $data['is_active'] = $request->has('is_active');
        $data['order'] = $request->order ?? 0;

        Package::create($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package created successfully.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'duration_days' => 'required|integer|min:1',
            'persons' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'hotel_deals_text' => 'nullable|string|max:50',
            'read_more_text' => 'nullable|string|max:50',
            'read_more_link' => 'nullable|string|max:255',
            'book_now_text' => 'nullable|string|max:50',
            'book_now_link' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageDirectory = public_path('images/packages');

            // Create directory if it doesn't exist
            if (!file_exists($imageDirectory)) {
                mkdir($imageDirectory, 0755, true);
            }

            // Delete old image if exists
            if ($package->image) {
                $oldImagePath = $imageDirectory . '/' . $package->image;
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

        $data['is_active'] = $request->has('is_active');

        $package->update($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        // Delete image
        if ($package->image) {
            $imagePath = public_path('images/packages/' . $package->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package deleted successfully.');
    }
}
