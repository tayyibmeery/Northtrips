@extends('admin.layout.app')

@section('title', 'Edit Important Information')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Important Information</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.important-information.update', $importantInformation->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title *</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           value="{{ old('title', $importantInformation->title) }}" required>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="icon">Icon (Emoji)</label>
                                    <input type="text" class="form-control" id="icon" name="icon"
                                           value="{{ old('icon', $importantInformation->icon) }}" placeholder="🆔">
                                    <small class="form-text text-muted">Use emoji or icon code</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"
                                      rows="3">{{ old('description', $importantInformation->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order">Order</label>
                                    <input type="number" class="form-control" id="order" name="order"
                                           value="{{ old('order', $importantInformation->order) }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Information
                            </button>
                            <a href="{{ route('admin.important-information.index') }}" class="btn btn-secondary">
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
