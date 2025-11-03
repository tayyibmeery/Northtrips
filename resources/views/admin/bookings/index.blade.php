@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Bookings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tour Bookings</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.bookings.statistics') }}" class="btn btn-info">
                            <i class="fas fa-chart-bar"></i> View Statistics
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fas fa-check"></i> {{ session('success') }}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Destination</th>
                                    <th>Date</th>
                                    <th>Persons</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Booked At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                <tr>
                                    <td>#{{ $booking->id }}</td>
                                    <td>
                                        <strong>{{ $booking->name }}</strong><br>
                                        <small class="text-muted">{{ $booking->email }}</small><br>
                                        <small class="text-muted">{{ $booking->phone ?? 'N/A' }}</small>
                                    </td>
                                    <td>{{ $booking->destination }}</td>
                                    <td>{{ $booking->formatted_date }}</td>
                                    <td>{{ $booking->persons }}</td>
                                    <td>{{ $booking->category }}</td>
                                    <td>
                                        <span class="badge badge-{{
                                            $booking->status == 'confirmed' ? 'success' :
                                            ($booking->status == 'pending' ? 'warning' :
                                            ($booking->status == 'cancelled' ? 'danger' : 'info'))
                                        }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $booking->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-primary" title="Edit Booking">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')" title="Delete Booking">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No bookings found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection