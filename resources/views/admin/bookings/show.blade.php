@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Booking Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Booking Details #{{ $booking->id }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Bookings
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Customer Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $booking->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $booking->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $booking->phone ?? 'Not provided' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Booking Information</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge badge-{{
                                            $booking->status == 'confirmed' ? 'success' :
                                            ($booking->status == 'pending' ? 'warning' :
                                            ($booking->status == 'cancelled' ? 'danger' : 'info'))
                                        }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Booking Date:</th>
                                    <td>{{ $booking->formatted_date }}</td>
                                </tr>
                                <tr>
                                    <th>Destination:</th>
                                    <td>{{ $booking->destination }}</td>
                                </tr>
                                <tr>
                                    <th>Persons:</th>
                                    <td>{{ $booking->persons }}</td>
                                </tr>
                                <tr>
                                    <th>Category:</th>
                                    <td>{{ $booking->category }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($booking->special_request)
                    <div class="row mt-3">
                        <div class="col-12">
                            <h4>Special Request</h4>
                            <div class="card">
                                <div class="card-body">
                                    {{ $booking->special_request }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($booking->admin_notes)
                    <div class="row mt-3">
                        <div class="col-12">
                            <h4>Admin Notes</h4>
                            <div class="card">
                                <div class="card-body">
                                    {{ $booking->admin_notes }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Timeline</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li><strong>Created:</strong> {{ $booking->created_at->format('M d, Y H:i:s') }}</li>
                                        <li><strong>Last Updated:</strong> {{ $booking->updated_at->format('M d, Y H:i:s') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Booking
                            </a>
                            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">
                                    <i class="fas fa-trash"></i> Delete Booking
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection