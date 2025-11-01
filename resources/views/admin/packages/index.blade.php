@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Packages')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Packages</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Package
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if($packages->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Duration</th>
                                    <th>Price</th>
                                    <th>Featured</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packages as $package)
                                <tr>
                                    <td>{{ $package->id }}</td>
                                    <td>
                                        @if($package->image)
                                        <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                        <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $package->name }}</td>
                                    <td>{{ $package->category->name ?? 'N/A' }}</td>
                                    <td>{{ $package->duration }}</td>
                                    <td>${{ number_format($package->price, 2) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $package->is_featured ? 'warning' : 'secondary' }}">
                                            {{ $package->is_featured ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $package->is_active ? 'success' : 'danger' }}">
                                            {{ $package->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" style="display: inline-block;">
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
                        No packages found. <a href="{{ route('admin.packages.create') }}">Create the first one!</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
