@extends('admin.layout.app')

@section('title', 'Quick Facts')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Facts</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.quick-facts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Fact
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
                                    <th>Fact</th>
                                    <th>Value</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($facts as $fact)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{!! $fact->icon !!}</td>
                                    <td>{{ $fact->fact }}</td>
                                    <td>{{ $fact->value }}</td>
                                    <td>{{ $fact->order }}</td>
                                    <td>
                                        <span class="badge badge-{{ $fact->is_active ? 'success' : 'danger' }}">
                                            {{ $fact->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.quick-facts.edit', $fact->id) }}"
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.quick-facts.toggle-status', $fact->id) }}"
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-{{ $fact->is_active ? 'warning' : 'success' }}"
                                                    title="{{ $fact->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="fas fa-{{ $fact->is_active ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.quick-facts.destroy', $fact->id) }}"
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
