<?php
// app/Http/Controllers/BookingController.php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\BookingNotification;

class BookingController extends Controller
{
    // Store booking from frontend
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'booking_date' => 'required|date',
            'booking_time' => 'nullable',
            'destination' => 'required|string|max:255',
            'persons' => 'required|integer|min:1|max:20',
            'category' => 'required|string|max:255',
            'special_request' => 'nullable|string|max:1000'
        ]);

        $booking = Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'destination' => $request->destination,
            'persons' => $request->persons,
            'category' => $request->category,
            'special_request' => $request->special_request,
            'status' => 'pending'
        ]);

        // Send confirmation email to customer
        try {
            Mail::to($booking->email)->send(new BookingConfirmation($booking));
        } catch (\Exception $e) {
            \Log::error('Booking confirmation email failed: ' . $e->getMessage());
        }

        // Send notification email to admin
        try {
            Mail::to(env('ADMIN_EMAIL', 'admin@northtrips.com'))->send(new BookingNotification($booking));
        } catch (\Exception $e) {
            \Log::error('Booking notification email failed: ' . $e->getMessage());
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your booking! We will contact you soon to confirm your tour.',
                'booking_id' => $booking->id
            ]);
        }

        return redirect()->back()->with('success', 'Thank you for your booking! We will contact you soon to confirm your tour.');
    }

    // AJAX endpoint to get available destinations
    public function getDestinations()
    {
        $destinations = [
            'Northern Areas Tour',
            'Skardu Adventure',
            'Hunza Valley Exploration',
            'Fairy Meadows Trek',
            'Naran Kaghan Tour',
            'Swat Valley Trip',
            'Neelum Valley Journey',
            'Chitral Kalash Tour',
            'Gilgit Expedition',
            'Custom Package'
        ];

        return response()->json($destinations);
    }
}