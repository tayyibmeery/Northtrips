@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Edit Booking')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Booking #{{ $booking->id }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Bookings
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')

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
                                <h4>Booking Details</h4>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Destination:</th>
                                        <td>{{ $booking->destination }}</td>
                                    </tr>
                                    <tr>
                                        <th>Booking Date:</th>
                                        <td>{{ $booking->formatted_date }}</td>
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

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Booking Status *</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="completed" {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="admin_notes">Admin Notes</label>
                                    <textarea class="form-control @error('admin_notes') is-invalid @enderror" id="admin_notes" name="admin_notes" rows="4" placeholder="Add any internal notes about this booking...">{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                                    @error('admin_notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if($booking->special_request)
                        <div class="row mt-3">
                            <div class="col-12">
                                <h5>Customer's Special Request</h5>
                                <div class="card">
                                    <div class="card-body">
                                        {{ $booking->special_request }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Booking
                                </button>
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection