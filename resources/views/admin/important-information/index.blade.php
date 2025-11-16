@extends('admin.layout.app')

@section('title', 'Important Information')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Important Information</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.important-information.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Information
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
                                @foreach($information as $info)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{!! $info->icon !!}</td>
                                    <td>{{ $info->title }}</td>
                                    <td>{{ Str::limit($info->description, 50) }}</td>
                                    <td>{{ $info->order }}</td>
                                    <td>
                                        <span class="badge badge-{{ $info->is_active ? 'success' : 'danger' }}">
                                            {{ $info->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.important-information.edit', $info->id) }}"
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.important-information.toggle-status', $info->id) }}"
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-{{ $info->is_active ? 'warning' : 'success' }}"
                                                    title="{{ $info->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="fas fa-{{ $info->is_active ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.important-information.destroy', $info->id) }}"
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
