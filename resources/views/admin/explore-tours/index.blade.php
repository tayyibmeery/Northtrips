@extends('admin.layout.app')

@section('title', 'Travela - Explore Tours')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Explore Tours</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.explore-tours.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Tour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($tours->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Discount</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tours as $tour)
                                <tr>
                                    <td>{{ $tour->id }}</td>
                                    <td>
                                        @if($tour->image)
                                        <img src="{{ Storage::url($tour->image) }}" alt="Tour Image" style="max-height: 60px; max-width: 100px; object-fit: cover;">
                                        @else
                                        No Image
                                        @endif
                                    </td>
                                    <td>{{ $tour->title }}</td>
                                    <td>{{ $tour->category->name }}</td>
                                    <td>
                                        <span class="badge badge-{{ $tour->category->type == 'national' ? 'info' : 'warning' }}">
                                            {{ ucfirst($tour->category->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($tour->discount_percentage)
                                        <span class="badge badge-success">{{ $tour->discount_percentage }}% Off</span>
                                        @else
                                        <span class="badge badge-secondary">No Discount</span>
                                        @endif
                                    </td>
                                    <td>{{ $tour->order }}</td>
                                    <td>
                                        <span class="badge badge-{{ $tour->is_active ? 'success' : 'danger' }}">
                                            {{ $tour->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.explore-tours.edit', $tour->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.explore-tours.destroy', $tour->id) }}" method="POST" style="display: inline-block;">
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
                        No explore tours found. <a href="{{ route('admin.explore-tours.create') }}">Create the first one!</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
