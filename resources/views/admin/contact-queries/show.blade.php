@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Contact Query Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact Query Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.contact-queries.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-muted">Name</span>
                                    <span class="info-box-number">{{ $contactQuery->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-muted">Email</span>
                                    <span class="info-box-number">
                                        <a href="mailto:{{ $contactQuery->email }}">{{ $contactQuery->email }}</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-muted">Phone</span>
                                    <span class="info-box-number">
                                        {{ $contactQuery->phone ?? 'Not provided' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-muted">Type</span>
                                    <span class="info-box-number">
                                        <span class="badge badge-info text-capitalize">{{ $contactQuery->type }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-muted">Status</span>
                                    <span class="info-box-number">
                                        <span class="badge badge-{{ $contactQuery->status == 'new' ? 'warning' : ($contactQuery->status == 'in_progress' ? 'primary' : ($contactQuery->status == 'resolved' ? 'success' : 'secondary')) }}">
                                            {{ ucfirst(str_replace('_', ' ', $contactQuery->status)) }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-muted">Submitted</span>
                                    <span class="info-box-number">{{ $contactQuery->created_at->format('M j, Y g:i A') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($contactQuery->responded_at)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-muted">Responded At</span>
                                    <span class="info-box-number">{{ $contactQuery->responded_at->format('M j, Y g:i A') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Subject</h4>
                                </div>
                                <div class="card-body">
                                    <h5>{{ $contactQuery->subject }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Message</h4>
                                </div>
                                <div class="card-body">
                                    <p style="white-space: pre-wrap;">{{ $contactQuery->message }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($contactQuery->ip_address)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Technical Information</h4>
                                </div>
                                <div class="card-body">
                                    <p><strong>IP Address:</strong> {{ $contactQuery->ip_address }}</p>
                                    @if($contactQuery->user_agent)
                                    <p><strong>User Agent:</strong> {{ $contactQuery->user_agent }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Update Status Form -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Status</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.contact-queries.update', $contactQuery->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="new" {{ $contactQuery->status == 'new' ? 'selected' : '' }}>New</option>
                                <option value="in_progress" {{ $contactQuery->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ $contactQuery->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="closed" {{ $contactQuery->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="admin_notes">Admin Notes</label>
                            <textarea class="form-control @error('admin_notes') is-invalid @enderror"
                                      id="admin_notes" name="admin_notes" rows="4"
                                      placeholder="Add internal notes about this query...">{{ old('admin_notes', $contactQuery->admin_notes) }}</textarea>
                            @error('admin_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Update Status
                        </button>
                    </form>

                    @if($contactQuery->isNew())
                    <form action="{{ route('admin.contact-queries.respond', $contactQuery->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-check"></i> Mark as Responded
                        </button>
                    </form>
                    @endif

                    <form action="{{ route('admin.contact-queries.destroy', $contactQuery->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block"
                                onclick="return confirm('Are you sure you want to delete this query?')">
                            <i class="fas fa-trash"></i> Delete Query
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Quick Actions</h3>
                </div>
                <div class="card-body">
                    <a href="mailto:{{ $contactQuery->email }}?subject=Re: {{ $contactQuery->subject }}"
                       class="btn btn-primary btn-block mb-2" target="_blank">
                        <i class="fas fa-reply"></i> Reply via Email
                    </a>

                    @if($contactQuery->phone)
                    <a href="tel:{{ $contactQuery->phone }}" class="btn btn-success btn-block mb-2">
                        <i class="fas fa-phone"></i> Call {{ $contactQuery->phone }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
