@extends('admin.layout.app')

@section('title', 'Itinerary Templates')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tour Itinerary Templates</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.itinerary-templates.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create New Template
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Template Name</th>
                                    <th>Trip Code</th>
                                    <th>Title</th>
                                    <th>Season</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($templates as $template)
                                <tr>
                                    <td>
                                        <strong>{{ $template->name }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $template->trip_code }}</span>
                                    </td>
                                    <td>{{ Str::limit($template->title, 30) }}</td>
                                    <td>
                                        <span class="{{ $template->season_badge }}">
                                            {{ ucfirst($template->season) }}
                                        </span>
                                    </td>
                                    <td>{{ $template->duration_days }}D/{{ $template->duration_nights }}N</td>
                                    <td>
                                        <span class="badge badge-{{ $template->is_active ? 'success' : 'danger' }}">
                                            {{ $template->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $template->featured ? 'warning' : 'secondary' }}">
                                            {{ $template->featured ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td>
                                           {{-- PDF View Button --}}
    <a href="{{ route('admin.itinerary-templates.view-pdf', $template) }}"
       class="btn btn-info btn-sm"
       target="_blank">
       <i class="fas fa-file-pdf"></i> PDF
    </a>
                                        <a href="{{ route('admin.itinerary-templates.edit', $template->id) }}"
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.itinerary-templates.download-pdf', $template->id) }}"
                                           class="btn btn-sm btn-info" title="Download PDF">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <form action="{{ route('admin.itinerary-templates.toggle-status', $template->id) }}"
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-{{ $template->is_active ? 'warning' : 'success' }}"
                                                    title="{{ $template->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="fas fa-{{ $template->is_active ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.itinerary-templates.destroy', $template->id) }}"
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this template?')" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($templates->isEmpty())
                    <div class="text-center py-4">
                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No Itinerary Templates Found</h4>
                        <p class="text-muted">Create your first itinerary template to get started.</p>
                        <a href="{{ route('admin.itinerary-templates.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create First Template
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
