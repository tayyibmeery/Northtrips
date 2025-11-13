@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Contact Queries')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact Queries</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.contact-queries.export', 'csv') }}" class="btn btn-success">
                            <i class="fas fa-download"></i> Export CSV
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-envelope"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Queries</span>
                                    <span class="info-box-number">{{ $stats['total'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">New</span>
                                    <span class="info-box-number">{{ $stats['new'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary"><i class="fas fa-spinner"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">In Progress</span>
                                    <span class="info-box-number">{{ $stats['in_progress'] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-check"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Resolved</span>
                                    <span class="info-box-number">{{ $stats['resolved'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('admin.contact-queries.index') }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="all" {{ $status == 'all' ? 'selected' : '' }}>All Status</option>
                                                <option value="new" {{ $status == 'new' ? 'selected' : '' }}>New</option>
                                                <option value="in_progress" {{ $status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="resolved" {{ $status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                <option value="closed" {{ $status == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="type">Type</label>
                                            <select class="form-control" id="type" name="type">
                                                <option value="all" {{ $type == 'all' ? 'selected' : '' }}>All Types</option>
                                                <option value="general" {{ $type == 'general' ? 'selected' : '' }}>General</option>
                                                <option value="booking" {{ $type == 'booking' ? 'selected' : '' }}>Booking</option>
                                                <option value="complaint" {{ $type == 'complaint' ? 'selected' : '' }}>Complaint</option>
                                                <option value="suggestion" {{ $type == 'suggestion' ? 'selected' : '' }}>Suggestion</option>
                                                <option value="partnership" {{ $type == 'partnership' ? 'selected' : '' }}>Partnership</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="search">Search</label>
                                            <input type="text" class="form-control" id="search" name="search"
                                                   value="{{ $search }}" placeholder="Search by name, email, subject...">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="btn btn-primary btn-block">
                                                <i class="fas fa-filter"></i> Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($queries->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Submitted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($queries as $query)
                                <tr class="{{ $query->isNew() ? 'table-warning' : '' }}">
                                    <td>{{ $query->id }}</td>
                                    <td>{{ $query->name }}</td>
                                    <td>{{ $query->email }}</td>
                                    <td>{{ Str::limit($query->subject, 50) }}</td>
                                    <td>
                                        <span class="badge badge-info text-capitalize">{{ $query->type }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $query->status == 'new' ? 'warning' : ($query->status == 'in_progress' ? 'primary' : ($query->status == 'resolved' ? 'success' : 'secondary')) }}">
                                            {{ ucfirst(str_replace('_', ' ', $query->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $query->created_at->format('M j, Y g:i A') }}</td>
                                    <td>
                                        <a href="{{ route('admin.contact-queries.show', $query->id) }}"
                                           class="btn btn-sm btn-info" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($query->isNew())
                                        <form action="{{ route('admin.contact-queries.respond', $query->id) }}"
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"
                                                    title="Mark as Responded">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        @endif
                                        <form action="{{ route('admin.contact-queries.destroy', $query->id) }}"
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this query?')"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $queries->appends(request()->query())->links() }}
                    </div>
                    @else
                    <div class="alert alert-info text-center">
                        <i class="fas fa-inbox fa-2x mb-3"></i>
                        <h4>No Contact Queries Found</h4>
                        <p>No contact queries match your current filters.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Auto-submit form when filters change
        $('#status, #type').change(function() {
            $(this).closest('form').submit();
        });
    });
</script>
@endpush
