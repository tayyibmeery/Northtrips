<?php
// app/Http/Controllers/Admin/BookingController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $booking->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    public function statistics()
    {

        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $cancelledBookings = Booking::where('status', 'cancelled')->count();
        $completedBookings = Booking::where('status', 'completed')->count();
        $todayBookings = Booking::whereDate('booking_date', today())->count();

        return view('admin.bookings.statistics', compact(
            'totalBookings',
            'pendingBookings',
            'confirmedBookings',
            'cancelledBookings',
            'completedBookings',
            'todayBookings'
        ));
    }
}
