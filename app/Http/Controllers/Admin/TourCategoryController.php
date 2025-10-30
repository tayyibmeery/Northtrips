<?php
// app/Http/Controllers/Admin/TourCategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourCategoryController extends Controller
{
    public function index()
    {
        $categories = TourCategory::ordered()->get();
        return view('admin.tour-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.tour-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tour_categories',
            'type' => 'required|in:national,international',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        TourCategory::create([
            'name' => $request->name,
            'type' => $request->type,
            'order' => $request->order ?? 0,
            'is_active' => $request->is_active ?? true
        ]);

        return redirect()->route('admin.tour-categories.index')
            ->with('success', 'Tour category created successfully.');
    }

    public function edit(TourCategory $tourCategory)
    {
        return view('admin.tour-categories.edit', compact('tourCategory'));
    }

    public function update(Request $request, TourCategory $tourCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tour_categories,name,' . $tourCategory->id,
            'type' => 'required|in:national,international',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $tourCategory->update([
            'name' => $request->name,
            'type' => $request->type,
            'order' => $request->order ?? 0,
            'is_active' => $request->is_active ?? true
        ]);

        return redirect()->route('admin.tour-categories.index')
            ->with('success', 'Tour category updated successfully.');
    }

    public function destroy(TourCategory $tourCategory)
    {
        if ($tourCategory->exploreTours()->count() > 0) {
            return redirect()->route('admin.tour-categories.index')
                ->with('error', 'Cannot delete category with tours. Please move or delete tours first.');
        }

        $tourCategory->delete();

        return redirect()->route('admin.tour-categories.index')
            ->with('success', 'Tour category deleted successfully.');
    }
}