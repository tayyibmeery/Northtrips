<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncludedService;
use Illuminate\Http\Request;

class IncludedServiceController extends Controller
{
    public function index()
    {
        $services = IncludedService::ordered()->get();
        return view('admin.included-services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.included-services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        IncludedService::create($request->all());

        return redirect()->route('admin.included-services.index')
            ->with('success', 'Included service created successfully!');
    }

    public function edit(IncludedService $includedService)
    {
        return view('admin.included-services.edit', compact('includedService'));
    }

    public function update(Request $request, IncludedService $includedService)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        $includedService->update($request->all());

        return redirect()->route('admin.included-services.index')
            ->with('success', 'Included service updated successfully!');
    }

    public function destroy(IncludedService $includedService)
    {
        $includedService->delete();
        return redirect()->route('admin.included-services.index')
            ->with('success', 'Included service deleted successfully!');
    }

    public function toggleStatus(IncludedService $includedService)
    {
        $includedService->update(['is_active' => !$includedService->is_active]);
        return redirect()->back()->with('success', 'Status updated successfully!');
    }
}
