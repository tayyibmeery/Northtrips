<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuickFact;
use Illuminate\Http\Request;

class QuickFactController extends Controller
{
    public function index()
    {
        $facts = QuickFact::ordered()->get();
        return view('admin.quick-facts.index', compact('facts'));
    }

    public function create()
    {
        return view('admin.quick-facts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fact' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        QuickFact::create($request->all());

        return redirect()->route('admin.quick-facts.index')
            ->with('success', 'Quick fact created successfully!');
    }

    public function show(QuickFact $quickFact)
    {
        return view('admin.quick-facts.show', compact('quickFact'));
    }

    public function edit(QuickFact $quickFact)
    {
        return view('admin.quick-facts.edit', compact('quickFact'));
    }

    public function update(Request $request, QuickFact $quickFact)
    {
        $request->validate([
            'fact' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        $quickFact->update($request->all());

        return redirect()->route('admin.quick-facts.index')
            ->with('success', 'Quick fact updated successfully!');
    }

    public function destroy(QuickFact $quickFact)
    {
        $quickFact->delete();
        return redirect()->route('admin.quick-facts.index')
            ->with('success', 'Quick fact deleted successfully!');
    }

    public function toggleStatus(QuickFact $quickFact)
    {
        $quickFact->update(['is_active' => !$quickFact->is_active]);

        $status = $quickFact->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Quick fact {$status} successfully!");
    }
}
