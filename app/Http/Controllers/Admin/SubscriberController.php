<?php
// app/Http/Controllers/Admin/SubscriberController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function create()
    {
        return view('admin.subscribers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
            'is_active' => 'boolean'
        ]);

        Subscriber::create([
            'email' => $request->email,
            'is_active' => $request->is_active ?? true
        ]);

        return redirect()->route('admin.subscribers.index')
            ->with('success', 'Subscriber created successfully.');
    }

    public function edit(Subscriber $subscriber)
    {
        return view('admin.subscribers.edit', compact('subscriber'));
    }

    public function update(Request $request, Subscriber $subscriber)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email,' . $subscriber->id,
            'is_active' => 'boolean'
        ]);

        $subscriber->update([
            'email' => $request->email,
            'is_active' => $request->is_active ?? true
        ]);

        return redirect()->route('admin.subscribers.index')
            ->with('success', 'Subscriber updated successfully.');
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('admin.subscribers.index')
            ->with('success', 'Subscriber deleted successfully.');
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);

        Subscriber::create([
            'email' => $request->email,
            'is_active' => true
        ]);

        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }













 
    // ... other methods ...

    public function export($format)
    {
        $subscribers = Subscriber::where('is_active', true)->get();
        $filename = 'subscribers-' . Carbon::now()->format('Y-m-d') . '.' . $format;

        if ($format === 'csv') {
            return $this->exportCsv($subscribers, $filename);
        } elseif ($format === 'excel') {
            return $this->exportExcel($subscribers, $filename);
        }

        return redirect()->back()->with('error', 'Invalid export format.');
    }

    public function activate(Subscriber $subscriber)
    {
        $subscriber->update(['is_active' => true]);
        return redirect()->back()->with('success', 'Subscriber activated successfully.');
    }

    public function deactivate(Subscriber $subscriber)
    {
        $subscriber->update(['is_active' => false]);
        return redirect()->back()->with('success', 'Subscriber deactivated successfully.');
    }

    private function exportCsv($subscribers, $filename)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($subscribers) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, ['ID', 'Email', 'Status', 'Subscribed At']);

            // Add data
            foreach ($subscribers as $subscriber) {
                fputcsv($file, [
                    $subscriber->id,
                    $subscriber->email,
                    $subscriber->is_active ? 'Active' : 'Inactive',
                    $subscriber->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportExcel($subscribers, $filename)
    {
        // For Excel export, you might want to use a package like Maatwebsite/Excel
        // For now, we'll return CSV as well
        return $this->exportCsv($subscribers, str_replace('.xlsx', '.csv', $filename));
    }

}