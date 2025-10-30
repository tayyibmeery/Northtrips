@extends('admin.layout.app')

@section('title', 'Travela - Edit Service')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Service</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Service Title *</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $service->title) }}" required placeholder="e.g., WorldWide Tours">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description *</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required placeholder="Enter service description">{{ old('description', $service->description) }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="icon">Icon Class *</label>
                                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $service->icon) }}" required placeholder="e.g., fa fa-globe">
                                    @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror>
                                    <small class="form-text text-muted">
                                        Use Font Awesome classes. Example: fa fa-globe, fa fa-hotel, fa fa-user
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="icon_color">Icon Color</label>
                                    <select class="form-control @error('icon_color') is-invalid @enderror" id="icon_color" name="icon_color">
                                        <option value="primary" {{ old('icon_color', $service->icon_color) == 'primary' ? 'selected' : '' }}>Primary (Blue)</option>
                                        <option value="secondary" {{ old('icon_color', $service->icon_color) == 'secondary' ? 'selected' : '' }}>Secondary (Gray)</option>
                                        <option value="success" {{ old('icon_color', $service->icon_color) == 'success' ? 'selected' : '' }}>Success (Green)</option>
                                        <option value="danger" {{ old('icon_color', $service->icon_color) == 'danger' ? 'selected' : '' }}>Danger (Red)</option>
                                        <option value="warning" {{ old('icon_color', $service->icon_color) == 'warning' ? 'selected' : '' }}>Warning (Yellow)</option>
                                        <option value="info" {{ old('icon_color', $service->icon_color) == 'info' ? 'selected' : '' }}>Info (Light Blue)</option>
                                        <option value="light" {{ old('icon_color', $service->icon_color) == 'light' ? 'selected' : '' }}>Light</option>
                                        <option value="dark" {{ old('icon_color', $service->icon_color) == 'dark' ? 'selected' : '' }}>Dark</option>
                                    </select>
                                    @error('icon_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="order">Display Order</label>
                                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $service->order) }}" min="0">
                                    @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Service
                            </button>
                            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
