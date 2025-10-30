<?php
// app/Http/Controllers/Admin/CarouselController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::orderBy('order')->get();
        return view('admin.carousels.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('carousels', 'public');
        }

        Carousel::create([
            'image' => $imagePath,
            'title' => $request->title,
            'heading' => $request->heading,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'is_active' => $request->is_active ?? true,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.carousels.index')
            ->with('success', 'Carousel item created successfully.');
    }

    public function edit(Carousel $carousel)
    {
        return view('admin.carousels.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($carousel->image && Storage::exists($carousel->image)) {
                Storage::delete($carousel->image);
            }

            $imagePath = $request->file('image')->store('carousels', 'public');
            $carousel->image = $imagePath;
        }

        $carousel->update([
            'title' => $request->title,
            'heading' => $request->heading,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'is_active' => $request->is_active ?? true,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.carousels.index')
            ->with('success', 'Carousel item updated successfully.');
    }

    public function destroy(Carousel $carousel)
    {
        // Delete image
        if ($carousel->image && Storage::exists($carousel->image)) {
            Storage::delete($carousel->image);
        }

        $carousel->delete();

        return redirect()->route('admin.carousels.index')
            ->with('success', 'Carousel item deleted successfully.');
    }

    // Update order
    public function updateOrder(Request $request)
    {
        foreach ($request->order as $order => $id) {
            Carousel::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }
}