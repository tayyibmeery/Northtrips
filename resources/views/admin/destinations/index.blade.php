@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Destinations')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Destinations</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Destination
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($destinations->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Photos</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($destinations as $destination)
                                <tr>
                                    <td>{{ $destination->id }}</td>
                                    <td>
                                        @if($destination->image)
                                        <img src="{{ Storage::url($destination->image) }}" alt="Destination Image" style="max-height: 60px; max-width: 100px; object-fit: cover;">
                                        @else
                                        No Image
                                        @endif
                                    </td>
                                    <td>{{ $destination->title }}</td>
                                    <td>{{ $destination->category->name }}</td>
                                    <td>{{ $destination->photos_count }}</td>
                                    <td>{{ $destination->order }}</td>
                                    <td>
                                        <span class="badge badge-{{ $destination->is_active ? 'success' : 'danger' }}">
                                            {{ $destination->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.destinations.destroy', $destination->id) }}" method="POST" style="display: inline-block;">
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
                        No destinations found. <a href="{{ route('admin.destinations.create') }}">Create the first one!</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
