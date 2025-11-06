@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Edit Package')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Package</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Package Title *</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $package->title) }}" required placeholder="e.g., Everest Base Camp Trek">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="destination">Destination *</label>
                                    <input type="text" class="form-control @error('destination') is-invalid @enderror" id="destination" name="destination" value="{{ old('destination', $package->destination) }}" required placeholder="e.g., Kathmandu, Nepal">
                                    @error('destination')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="duration_days">Duration (Days) *</label>
                                    <input type="number" class="form-control @error('duration_days') is-invalid @enderror" id="duration_days" name="duration_days" value="{{ old('duration_days', $package->duration_days) }}" required min="1" placeholder="e.g., 15">
                                    @error('duration_days')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="persons">Persons *</label>
                                    <input type="number" class="form-control @error('persons') is-invalid @enderror" id="persons" name="persons" value="{{ old('persons', $package->persons) }}" required min="1" placeholder="e.g., 2">
                                    @error('persons')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">Price *</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $package->price) }}" required min="0" step="0.01" placeholder="e.g., 1499.00">
                                    @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Package Image</label>
                                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Leave empty to keep current image. Recommended size: 800x600px
                                    </small>
                                    @if($package->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('images/packages/' . $package->image) }}" alt="Current Image" style="max-height: 150px; max-width: 100%; object-fit: cover;" class="img-thumbnail">
                                        <p class="text-muted mt-1">Current Image</p>
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="rating">Rating</label>
                                    <input type="number" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" value="{{ old('rating', $package->rating) }}" min="0" max="5" step="0.1" placeholder="e.g., 4.5">
                                    @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror>
                                    <small class="form-text text-muted">Enter rating from 0 to 5</small>
                                </div>

                                <div class="form-group">
                                    <label for="hotel_deals_text">Hotel Deals Text</label>
                                    <input type="text" class="form-control @error('hotel_deals_text') is-invalid @enderror" id="hotel_deals_text" name="hotel_deals_text" value="{{ old('hotel_deals_text', $package->hotel_deals_text) }}" placeholder="e.g., Hotel Deals">
                                    @error('hotel_deals_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="read_more_text">Read More Text</label>
                                    <input type="text" class="form-control @error('read_more_text') is-invalid @enderror" id="read_more_text" name="read_more_text" value="{{ old('read_more_text', $package->read_more_text) }}" placeholder="e.g., Read More">
                                    @error('read_more_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="read_more_link">Read More Link</label>
                                    <input type="url" class="form-control @error('read_more_link') is-invalid @enderror" id="read_more_link" name="read_more_link" value="{{ old('read_more_link', $package->read_more_link) }}" placeholder="e.g., https://example.com/package-details">
                                    @error('read_more_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="book_now_text">Book Now Text</label>
                                    <input type="text" class="form-control @error('book_now_text') is-invalid @enderror" id="book_now_text" name="book_now_text" value="{{ old('book_now_text', $package->book_now_text) }}" placeholder="e.g., Book Now">
                                    @error('book_now_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="book_now_link">Book Now Link</label>
                                    <input type="url" class="form-control @error('book_now_link') is-invalid @enderror" id="book_now_link" name="book_now_link" value="{{ old('book_now_link', $package->book_now_link) }}" placeholder="e.g., https://example.com/book-now">
                                    @error('book_now_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order">Display Order</label>
                                            <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $package->order) }}" min="0">
                                            @error('order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch mt-4">
                                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ $package->is_active ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="is_active">Active</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Package description" required>{{ old('description', $package->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Package
                            </button>
                            <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">
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
