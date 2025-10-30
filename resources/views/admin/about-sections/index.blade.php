@extends('admin.layout.app')

@section('title', 'Travela - About Sections')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">About Sections</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.about-sections.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New About Section
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($aboutSections->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Features Count</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aboutSections as $about)
                                <tr>
                                    <td>{{ $about->id }}</td>
                                    <td>{{ $about->title ?? 'N/A' }}</td>
                                    <td>
                                        @if($about->image)
                                        <img src="{{ Storage::url($about->image) }}" alt="About Image" style="max-height: 60px; max-width: 100px; object-fit: cover;">
                                        @else
                                        No Image
                                        @endif
                                    </td>
                                    <td>{{ count($about->features ?? []) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $about->is_active ? 'success' : 'danger' }}">
                                            {{ $about->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.about-sections.edit', $about->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.about-sections.destroy', $about->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-info">
                        No about sections found. <a href="{{ route('admin.about-sections.create') }}">Create the first one!</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
