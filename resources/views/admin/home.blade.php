@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Dashboard')
@section('page_title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $stats['total_bookings'] ?? 0 }}</h3>
                        <p>Total Bookings</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <a href="{{ route('admin.bookings.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $stats['confirmed_bookings'] ?? 0 }}</h3>
                        <p>Confirmed Bookings</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <a href="{{ route('admin.bookings.index', ['status' => 'confirmed']) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $stats['total_users'] ?? 0 }}</h3>
                        <p>Registered Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Rs. {{ number_format($stats['revenue'] ?? 0, 2) }}</h3>
                        <p>Total Revenue</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="{{ route('admin.bookings.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Booking Statistics Chart -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-bar mr-1"></i>
                            Monthly Bookings - {{ date('Y') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="bookingChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-list mr-1"></i>
                            Recent Bookings
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Customer</th>
                                    <th>Destination</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $booking)
                                <tr>
                                    <td>#{{ $booking->id }}</td>
                                    <td>{{ $booking->name }}</td>
                                    <td>{{ $booking->destination }}</td>
                                    <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No recent bookings found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- /.Left col -->

            <!-- right col -->
            <section class="col-lg-5 connectedSortable">
                <!-- Booking Status Distribution -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Booking Status Distribution
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="statusChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle mr-1"></i>
                            Quick Statistics
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon bg-info"><i class="fas fa-suitcase"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Packages</span>
                                        <span class="info-box-number">{{ $stats['total_packages'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon bg-success"><i class="fas fa-map-marker-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Destinations</span>
                                        <span class="info-box-number">{{ $stats['total_destinations'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon bg-warning"><i class="fas fa-comments"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Testimonials</span>
                                        <span class="info-box-number">{{ $stats['total_testimonials'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon bg-danger"><i class="fas fa-clock"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Pending Bookings</span>
                                        <span class="info-box-number">{{ $stats['pending_bookings'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- right col -->
        </div>
        <!-- /.row -->
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Prepare chart data - use simple approach
        var monthlyData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        @if(isset($monthlyBookings) && is_array($monthlyBookings))
            @foreach($monthlyBookings as $month => $count)
                monthlyData[{{ $month }} - 1] = {{ $count }};
            @endforeach
        @endif

        var statusLabels = @json(array_keys($bookingStatus ?? []));
        var statusData = @json(array_values($bookingStatus ?? []));

        // Monthly Booking Chart
        var bookingCtx = document.getElementById('bookingChart').getContext('2d');
        var bookingChart = new Chart(bookingCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Bookings',
                    data: monthlyData,
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Booking Status Pie Chart
        var statusCtx = document.getElementById('statusChart').getContext('2d');
        var statusChart = new Chart(statusCtx, {
            type: 'pie',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusData,
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.8)',  // pending - yellow
                        'rgba(40, 167, 69, 0.8)',   // confirmed - green
                        'rgba(220, 53, 69, 0.8)',   // cancelled - red
                        'rgba(108, 117, 125, 0.8)'  // completed - gray
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(40, 167, 69, 1)',
                        'rgba(220, 53, 69, 1)',
                        'rgba(108, 117, 125, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>
@endpush
