@extends('admin.layout.app')

@section('title', 'Travela - Edit About Section')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit About Section</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.about-sections.update', $aboutSection->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $aboutSection->title) }}" placeholder="e.g., About Us">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description1">Description 1</label>
                                    <textarea class="form-control @error('description1') is-invalid @enderror" id="description1" name="description1" rows="3" placeholder="Enter first description">{{ old('description1', $aboutSection->description1) }}</textarea>
                                    @error('description1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description2">Description 2</label>
                                    <textarea class="form-control @error('description2') is-invalid @enderror" id="description2" name="description2" rows="3" placeholder="Enter second description">{{ old('description2', $aboutSection->description2) }}</textarea>
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
                                        Leave empty to keep current image. Recommended size: 500x600px
                                    </small>
                                    @if($aboutSection->image)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($aboutSection->image) }}" alt="Current Image" style="max-height: 150px; max-width: 100%; object-fit: cover;">
                                    </div>
                                    @endif
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
                                        Leave empty to keep current image
                                    </small>
                                    @if($aboutSection->background_image)
                                    <div class="mt-2">
                                        <img src="{{ Storage::url($aboutSection->background_image) }}" alt="Current Background Image" style="max-height: 100px; max-width: 100%; object-fit: cover;">
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Features</label>
                                    <div id="features-container">
                                        @if($aboutSection->features && count($aboutSection->features) > 0)
                                        @foreach($aboutSection->features as $feature)
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="features[]" value="{{ $feature }}" placeholder="e.g., First Class Flights">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-feature">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="features[]" placeholder="e.g., First Class Flights">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-feature">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endif
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
                                    <input type="text" class="form-control @error('button_text') is-invalid @enderror" id="button_text" name="button_text" value="{{ old('button_text', $aboutSection->button_text) }}" placeholder="e.g., Read More">
                                    @error('button_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="button_link">Button Link</label>
                                    <input type="url" class="form-control @error('button_link') is-invalid @enderror" id="button_link" name="button_link" value="{{ old('button_link', $aboutSection->button_link) }}" placeholder="e.g., https://example.com/about">
                                    @error('button_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ $aboutSection->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update About Section
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
