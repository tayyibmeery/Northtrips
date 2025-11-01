@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Subscribers')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Newsletter Subscribers</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exportModal">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if($subscribers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Subscribed At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscribers as $subscriber)
                                <tr>
                                    <td>{{ $subscriber->id }}</td>
                                    <td>{{ $subscriber->email }}</td>
                                    <td>
                                        <span class="badge badge-{{ $subscriber->is_active ? 'success' : 'danger' }}">
                                            {{ $subscriber->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $subscriber->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        @if($subscriber->is_active)
                                        <form action="{{ route('admin.subscribers.deactivate', $subscriber->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Deactivate this subscriber?')">
                                                <i class="fas fa-ban"></i> Deactivate
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('admin.subscribers.activate', $subscriber->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Activate this subscriber?')">
                                                <i class="fas fa-check"></i> Activate
                                            </button>
                                        </form>
                                        @endif
                                        <form action="{{ route('admin.subscribers.destroy', $subscriber->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure? This will permanently delete the subscriber.')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $subscribers->links() }}
                    </div>
                    @else
                    <div class="alert alert-info">
                        No subscribers found.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Export Modal -->
<div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">Export Subscribers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Choose export format:</p>
                <div class="btn-group-vertical w-100">
                    <a href="{{ route('admin.subscribers.export', ['format' => 'csv']) }}" class="btn btn-success mb-2">
                        <i class="fas fa-file-csv"></i> Export as CSV
                    </a>
                    <a href="{{ route('admin.subscribers.export', ['format' => 'excel']) }}" class="btn btn-primary">
                        <i class="fas fa-file-excel"></i> Export as Excel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
