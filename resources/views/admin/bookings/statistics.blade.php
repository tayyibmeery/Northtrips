@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Booking Statistics')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Booking Statistics</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Bookings
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Total Bookings -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $totalBookings }}</h3>
                                    <p>Total Bookings</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <a href="{{ route('admin.bookings.index') }}" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Pending Bookings -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $pendingBookings }}</h3>
                                    <p>Pending Bookings</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <a href="{{ route('admin.bookings.index') }}?status=pending" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Confirmed Bookings -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $confirmedBookings }}</h3>
                                    <p>Confirmed Bookings</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <a href="{{ route('admin.bookings.index') }}?status=confirmed" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Today's Bookings -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{ $todayBookings }}</h3>
                                    <p>Today's Bookings</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <a href="{{ route('admin.bookings.index') }}?date=today" class="small-box-footer">
                                    More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Statistics -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Booking Status Distribution</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="statusChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Popular Destinations</h3>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        @php
                                            $popularDestinations = \App\Models\Booking::select('destination', \DB::raw('COUNT(*) as count'))
                                                ->groupBy('destination')
                                                ->orderBy('count', 'DESC')
                                                ->limit(5)
                                                ->get();
                                        @endphp
                                        @foreach($popularDestinations as $destination)
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $destination->destination }}
                                            <span class="badge badge-primary badge-pill">{{ $destination->count }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Bookings -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Recent Bookings</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer</th>
                                                    <th>Destination</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $recentBookings = \App\Models\Booking::latest()->take(5)->get();
                                                @endphp
                                                @foreach($recentBookings as $recent)
                                                <tr>
                                                    <td>#{{ $recent->id }}</td>
                                                    <td>{{ $recent->name }}</td>
                                                    <td>{{ $recent->destination }}</td>
                                                    <td>{{ $recent->formatted_date }}</td>
                                                    <td>
                                                        <span class="badge badge-{{
                                                            $recent->status == 'confirmed' ? 'success' :
                                                            ($recent->status == 'pending' ? 'warning' :
                                                            ($recent->status == 'cancelled' ? 'danger' : 'info'))
                                                        }}">
                                                            {{ ucfirst($recent->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('statusChart').getContext('2d');
        var statusChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Confirmed', 'Cancelled', 'Completed'],
                datasets: [{
                    data: [
                        {{ $pendingBookings }},
                        {{ $confirmedBookings }},
                        {{ \App\Models\Booking::where('status', 'cancelled')->count() }},
                        {{ \App\Models\Booking::where('status', 'completed')->count() }}
                    ],
                    backgroundColor: [
                        '#ffc107',
                        '#28a745',
                        '#dc3545',
                        '#17a2b8'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    });
</script>
@endpush