<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExperienceHighlight;
use Illuminate\Http\Request;

class ExperienceHighlightController extends Controller
{
    public function index()
    {
        $highlights = ExperienceHighlight::ordered()->get();
        return view('admin.experience-highlights.index', compact('highlights'));
    }

    public function create()
    {
        return view('admin.experience-highlights.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        ExperienceHighlight::create($request->all());

        return redirect()->route('admin.experience-highlights.index')
            ->with('success', 'Experience highlight created successfully!');
    }

    public function show(ExperienceHighlight $experienceHighlight)
    {
        return view('admin.experience-highlights.show', compact('experienceHighlight'));
    }

    public function edit(ExperienceHighlight $experienceHighlight)
    {
        return view('admin.experience-highlights.edit', compact('experienceHighlight'));
    }

    public function update(Request $request, ExperienceHighlight $experienceHighlight)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        $experienceHighlight->update($request->all());

        return redirect()->route('admin.experience-highlights.index')
            ->with('success', 'Experience highlight updated successfully!');
    }

    public function destroy(ExperienceHighlight $experienceHighlight)
    {
        $experienceHighlight->delete();
        return redirect()->route('admin.experience-highlights.index')
            ->with('success', 'Experience highlight deleted successfully!');
    }

    public function toggleStatus(ExperienceHighlight $experienceHighlight)
    {
        $experienceHighlight->update(['is_active' => !$experienceHighlight->is_active]);

        $status = $experienceHighlight->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Experience highlight {$status} successfully!");
    }
}
