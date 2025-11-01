{{-- resources/views/admin/social-media-links/index.blade.php --}}

@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Social Media Links')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Social Media Links</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.social-media-links.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Platform</th>
                                <th>Icon Class</th>
                                <th>URL</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($socialMediaLinks as $link)
                            <tr>
                                <td>{{ $link->id }}</td>
                                <td>{{ $link->platform_name }}</td>
                                <td><i class="{{ $link->icon_class }}"></i> {{ $link->icon_class }}</td>
                                <td>{{ $link->url }}</td>
                                <td>
                                    <span class="badge badge-{{ $link->status ? 'success' : 'danger' }}">
                                        {{ $link->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.social-media-links.edit', $link->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.social-media-links.destroy', $link->id) }}" method="POST" style="display: inline-block;">
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
            </div>
        </div>
    </div>
</div>
@endsection
