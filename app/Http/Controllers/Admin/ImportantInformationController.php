<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportantInformation;
use Illuminate\Http\Request;

class ImportantInformationController extends Controller
{
    public function index()
    {
        $information = ImportantInformation::ordered()->get();
        return view('admin.important-information.index', compact('information'));
    }

    public function create()
    {
        return view('admin.important-information.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        ImportantInformation::create($request->all());

        return redirect()->route('admin.important-information.index')
            ->with('success', 'Important information created successfully!');
    }

    public function show(ImportantInformation $importantInformation)
    {
        return view('admin.important-information.show', compact('importantInformation'));
    }

    public function edit(ImportantInformation $importantInformation)
    {
        return view('admin.important-information.edit', compact('importantInformation'));
    }

    public function update(Request $request, ImportantInformation $importantInformation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        $importantInformation->update($request->all());

        return redirect()->route('admin.important-information.index')
            ->with('success', 'Important information updated successfully!');
    }

    public function destroy(ImportantInformation $importantInformation)
    {
        $importantInformation->delete();
        return redirect()->route('admin.important-information.index')
            ->with('success', 'Important information deleted successfully!');
    }

    public function toggleStatus(ImportantInformation $importantInformation)
    {
        $importantInformation->update(['is_active' => !$importantInformation->is_active]);

        $status = $importantInformation->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Important information {$status} successfully!");
    }
}
