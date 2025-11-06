<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Package;
use App\Models\Destination;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        try {
            // Get statistics based on your actual Booking model
            $stats = [
                'total_bookings' => Booking::count(),
                'pending_bookings' => Booking::where('status', 'pending')->count(),
                'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
                'total_users' => User::where('is_admin', false)->count(),
                'total_packages' => Package::count(),
                'total_destinations' => Destination::count(),
                'total_testimonials' => Testimonial::count(),
                'revenue' => 0, // Since you don't have amount field
            ];

            // Recent bookings - using your actual Booking model fields
            $recentBookings = Booking::latest()
                ->take(5)
                ->get();

            // Monthly booking statistics for chart
            $monthlyBookings = Booking::select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as count')
                )
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('count', 'month')
                ->toArray();

            // Booking status distribution
            $bookingStatus = Booking::select('status', DB::raw('COUNT(*) as count'))
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            return view('admin.home', compact(
                'stats',
                'recentBookings',
                'monthlyBookings',
                'bookingStatus'
            ));

        } catch (\Exception $e) {
            // Log the error and show fallback
            \Log::error('Dashboard error: ' . $e->getMessage());

            return $this->fallbackDashboard();
        }
    }

    /**
     * Fallback dashboard data if there are database issues
     */
    private function fallbackDashboard()
    {
        $stats = [
            'total_bookings' => 0,
            'pending_bookings' => 0,
            'confirmed_bookings' => 0,
            'total_users' => 0,
            'total_packages' => 0,
            'total_destinations' => 0,
            'total_testimonials' => 0,
            'revenue' => 0,
        ];

        $recentBookings = collect();
        $monthlyBookings = [];
        $bookingStatus = [];

        return view('admin.home', compact(
            'stats',
            'recentBookings',
            'monthlyBookings',
            'bookingStatus'
        ));
    }
}
