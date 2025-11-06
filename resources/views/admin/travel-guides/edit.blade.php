@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Edit Travel Guide')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Travel Guide</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.travel-guides.update', $travelGuide->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $travelGuide->name) }}" required placeholder="Enter guide name">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="designation">Designation *</label>
                                    <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', $travelGuide->designation) }}" required placeholder="Enter guide designation">
                                    @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Profile Image</label>
                                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Leave empty to keep current image. Recommended size: 400x400px
                                    </small>
                                    @if($travelGuide->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('images/travel-guides/' . $travelGuide->image) }}" alt="Current Image" style="max-height: 150px; max-width: 100%; object-fit: cover;" class="img-thumbnail">
                                        <p class="text-muted mt-1">Current Image</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="facebook_url">Facebook URL</label>
                                    <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $travelGuide->facebook_url) }}" placeholder="https://facebook.com/username">
                                    @error('facebook_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="twitter_url">Twitter URL</label>
                                    <input type="url" class="form-control @error('twitter_url') is-invalid @enderror" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $travelGuide->twitter_url) }}" placeholder="https://twitter.com/username">
                                    @error('twitter_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="instagram_url">Instagram URL</label>
                                    <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $travelGuide->instagram_url) }}" placeholder="https://instagram.com/username">
                                    @error('instagram_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="linkedin_url">LinkedIn URL</label>
                                    <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $travelGuide->linkedin_url) }}" placeholder="https://linkedin.com/in/username">
                                    @error('linkedin_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="order">Display Order</label>
                                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $travelGuide->order) }}" min="0">
                                    @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch mt-4">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ $travelGuide->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Guide
                            </button>
                            <a href="{{ route('admin.travel-guides.index') }}" class="btn btn-secondary">
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
