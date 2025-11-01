@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Travel Guides')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Travel Guides</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.travel-guides.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Guide
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

                    @if($guides->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Image</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guides as $guide)
                                <tr>
                                    <td>{{ $guide->id }}</td>
                                    <td>{{ $guide->name }}</td>
                                    <td>{{ $guide->designation }}</td>
                                    <td>
                                        @if($guide->image)
                                        <img src="{{ Storage::url($guide->image) }}" alt="{{ $guide->name }}" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                        @else
                                        <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td>{{ $guide->order }}</td>
                                    <td>
                                        <span class="badge badge-{{ $guide->is_active ? 'success' : 'secondary' }}">
                                            {{ $guide->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.travel-guides.edit', $guide->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.travel-guides.destroy', $guide->id) }}" method="POST" style="display: inline-block;">
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
                        No travel guides found. <a href="{{ route('admin.travel-guides.create') }}">Create the first one!</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
