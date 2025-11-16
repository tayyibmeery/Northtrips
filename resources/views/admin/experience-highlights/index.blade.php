@extends('admin.layout.app')

@section('title', 'Experience Highlights')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Experience Highlights</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.experience-highlights.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Highlight
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
                                @foreach($highlights as $highlight)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{!! $highlight->icon !!}</td>
                                    <td>{{ $highlight->title }}</td>
                                    <td>{{ Str::limit($highlight->description, 50) }}</td>
                                    <td>{{ $highlight->order }}</td>
                                    <td>
                                        <span class="badge badge-{{ $highlight->is_active ? 'success' : 'danger' }}">
                                            {{ $highlight->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.experience-highlights.edit', $highlight->id) }}"
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.experience-highlights.toggle-status', $highlight->id) }}"
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-{{ $highlight->is_active ? 'warning' : 'success' }}"
                                                    title="{{ $highlight->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="fas fa-{{ $highlight->is_active ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.experience-highlights.destroy', $highlight->id) }}"
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
