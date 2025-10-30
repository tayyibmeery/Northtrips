<?php
// app/Http/Controllers/Admin/DestinationCategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DestinationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationCategoryController extends Controller
{
    public function index()
    {
        $categories = DestinationCategory::ordered()->get();
        return view('admin.destination-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.destination-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:destination_categories',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        DestinationCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'order' => $request->order ?? 0,
            'is_active' => $request->is_active ?? true
        ]);

        return redirect()->route('admin.destination-categories.index')
            ->with('success', 'Destination category created successfully.');
    }

    public function edit(DestinationCategory $destinationCategory)
    {
        return view('admin.destination-categories.edit', compact('destinationCategory'));
    }

    public function update(Request $request, DestinationCategory $destinationCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:destination_categories,name,' . $destinationCategory->id,
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $destinationCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'order' => $request->order ?? 0,
            'is_active' => $request->is_active ?? true
        ]);

        return redirect()->route('admin.destination-categories.index')
            ->with('success', 'Destination category updated successfully.');
    }

    public function destroy(DestinationCategory $destinationCategory)
    {
        if ($destinationCategory->destinations()->count() > 0) {
            return redirect()->route('admin.destination-categories.index')
                ->with('error', 'Cannot delete category with destinations. Please move or delete destinations first.');
        }

        $destinationCategory->delete();

        return redirect()->route('admin.destination-categories.index')
            ->with('success', 'Destination category deleted successfully.');
    }
}