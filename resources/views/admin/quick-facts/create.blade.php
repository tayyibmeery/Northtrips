@extends('admin.layout.app')

@section('title', 'Create Quick Fact')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create New Quick Fact</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.quick-facts.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fact">Fact *</label>
                                    <input type="text" class="form-control" id="fact" name="fact"
                                           value="{{ old('fact') }}" required placeholder="e.g., Group Size">
                                    @error('fact')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="value">Value *</label>
                                    <input type="text" class="form-control" id="value" name="value"
                                           value="{{ old('value') }}" required placeholder="e.g., 12-25 Travelers">
                                    @error('value')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="icon">Icon (Emoji)</label>
                                    <input type="text" class="form-control" id="icon" name="icon"
                                           value="{{ old('icon') }}" placeholder="👥">
                                    <small class="form-text text-muted">Use emoji or icon code</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order">Order</label>
                                    <input type="number" class="form-control" id="order" name="order"
                                           value="{{ old('order', 0) }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Fact
                            </button>
                            <a href="{{ route('admin.quick-facts.index') }}" class="btn btn-secondary">
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
