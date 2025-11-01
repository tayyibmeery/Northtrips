@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Create About Section')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create About Section</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.about-sections.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="e.g., About Us">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description1">Description 1</label>
                                    <textarea class="form-control @error('description1') is-invalid @enderror" id="description1" name="description1" rows="3" placeholder="Enter first description">{{ old('description1') }}</textarea>
                                    @error('description1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description2">Description 2</label>
                                    <textarea class="form-control @error('description2') is-invalid @enderror" id="description2" name="description2" rows="3" placeholder="Enter second description">{{ old('description2') }}</textarea>
                                    @error('description2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Main Image</label>
                                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Recommended size: 500x600px. Max file size: 2MB
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="background_image">Background Image</label>
                                    <input type="file" class="form-control-file @error('background_image') is-invalid @enderror" id="background_image" name="background_image">
                                    @error('background_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Background pattern image. Max file size: 2MB
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label>Features</label>
                                    <div id="features-container">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="features[]" placeholder="e.g., First Class Flights">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-feature">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary" id="add-feature">
                                        <i class="fas fa-plus"></i> Add Feature
                                    </button>
                                    @error('features')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="button_text">Button Text</label>
                                    <input type="text" class="form-control @error('button_text') is-invalid @enderror" id="button_text" name="button_text" value="{{ old('button_text', 'Read More') }}" placeholder="e.g., Read More">
                                    @error('button_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="button_link">Button Link</label>
                                    <input type="url" class="form-control @error('button_link') is-invalid @enderror" id="button_link" name="button_link" value="{{ old('button_link') }}" placeholder="e.g., https://example.com/about">
                                    @error('button_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked>
                                        <label class="custom-control-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create About Section
                            </button>
                            <a href="{{ route('admin.about-sections.index') }}" class="btn btn-secondary">
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

@push('scripts')
<script>
    $(document).ready(function() {
        // Add feature field
        $('#add-feature').click(function() {
            const featureHtml = `
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="features[]"
                           placeholder="e.g., First Class Flights">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-feature">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
            $('#features-container').append(featureHtml);
        });

        // Remove feature field
        $(document).on('click', '.remove-feature', function() {
            if ($('#features-container .input-group').length > 1) {
                $(this).closest('.input-group').remove();
            }
        });
    });

</script>
@endpush
