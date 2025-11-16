@extends('admin.layout.app')

@section('title', 'Included Services')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Included Services</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.included-services.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Service
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
                                    <th>#</th>
                                    <th>Icon</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{!! $service->icon !!}</td>
                                    <td>{{ $service->title }}</td>
                                    <td>{{ Str::limit($service->description, 50) }}</td>
                                    <td>{{ $service->order }}</td>
                                    <td>
                                        <span class="badge badge-{{ $service->is_active ? 'success' : 'danger' }}">
                                            {{ $service->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.included-services.edit', $service->id) }}"
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.included-services.toggle-status', $service->id) }}"
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-{{ $service->is_active ? 'warning' : 'success' }}"
                                                    title="{{ $service->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="fas fa-{{ $service->is_active ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.included-services.destroy', $service->id) }}"
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
