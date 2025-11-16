<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExcludedService;
use Illuminate\Http\Request;

class ExcludedServiceController extends Controller
{
    public function index()
    {
        $services = ExcludedService::ordered()->get();
        return view('admin.excluded-services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.excluded-services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        ExcludedService::create($request->all());

        return redirect()->route('admin.excluded-services.index')
            ->with('success', 'Excluded service created successfully!');
    }

    public function show(ExcludedService $excludedService)
    {
        return view('admin.excluded-services.show', compact('excludedService'));
    }

    public function edit(ExcludedService $excludedService)
    {
        return view('admin.excluded-services.edit', compact('excludedService'));
    }

    public function update(Request $request, ExcludedService $excludedService)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        $excludedService->update($request->all());

        return redirect()->route('admin.excluded-services.index')
            ->with('success', 'Excluded service updated successfully!');
    }

    public function destroy(ExcludedService $excludedService)
    {
        $excludedService->delete();
        return redirect()->route('admin.excluded-services.index')
            ->with('success', 'Excluded service deleted successfully!');
    }

    public function toggleStatus(ExcludedService $excludedService)
    {
        $excludedService->update(['is_active' => !$excludedService->is_active]);

        $status = $excludedService->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Excluded service {$status} successfully!");
    }
}
