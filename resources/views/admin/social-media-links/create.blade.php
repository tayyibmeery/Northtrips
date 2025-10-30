{{-- resources/views/admin/social-media-links/create.blade.php --}}
{{-- resources/views/admin/social-media-links/edit.blade.php --}}

@extends('admin.layout.app')

@section('title', isset($socialMediaLink) ? 'Edit Social Media Link' : 'Create Social Media Link')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ isset($socialMediaLink) ? 'Edit' : 'Create' }} Social Media Link</h3>
                </div>
                <div class="card-body">
                    <form action="{{ isset($socialMediaLink) ? route('admin.social-media-links.update', $socialMediaLink->id) : route('admin.social-media-links.store') }}" method="POST">
                        @csrf
                        @if(isset($socialMediaLink))
                        @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="platform_name">Platform Name</label>
                            <input type="text" class="form-control @error('platform_name') is-invalid @enderror" id="platform_name" name="platform_name" value="{{ old('platform_name', $socialMediaLink->platform_name ?? '') }}" required>
                            @error('platform_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="icon_class">Icon Class (Font Awesome)</label>
                            <input type="text" class="form-control @error('icon_class') is-invalid @enderror" id="icon_class" name="icon_class" value="{{ old('icon_class', $socialMediaLink->icon_class ?? '') }}" placeholder="e.g., fab fa-facebook, fab fa-twitter" required>
                            @error('icon_class')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $socialMediaLink->url ?? '') }}" required>
                            @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ (old('status', $socialMediaLink->status ?? true)) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status">Active</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ isset($socialMediaLink) ? 'Update' : 'Create' }}
                        </button>
                        <a href="{{ route('admin.social-media-links.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
