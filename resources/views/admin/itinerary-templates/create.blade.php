@extends('admin.layout.app')

@section('title', 'Create Itinerary Template')

@push('styles')
<style>
    .component-section {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        background: #f8f9fa;
    }
    .component-item {
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 8px;
        cursor: move;
    }
    .selected-components {
        min-height: 100px;
        border: 2px dashed #28a745;
        border-radius: 10px;
        padding: 15px;
        background: #f8fff9;
    }
    .day-card {
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
        background: #f8f9fa;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create New Itinerary Template</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.itinerary-templates.store') }}" method="POST" enctype="multipart/form-data" id="itinerary-form">
                        @csrf

                        <!-- Basic Information -->
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h4 class="card-title mb-0">Basic Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Template Name *</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="season">Season *</label>
                                            <select class="form-control" id="season" name="season" required>
                                                <option value="">Select Season</option>
                                                @foreach($seasons as $key => $value)
                                                <option value="{{ $key }}" {{ old('season') == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('season')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Trip Title *</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subtitle">Subtitle</label>
                                            <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle') }}">
                                            @error('subtitle')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="duration_days">Duration (Days) *</label>
                                            <input type="number" class="form-control" id="duration_days" name="duration_days" value="{{ old('duration_days') }}" required min="1">
                                            @error('duration_days')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="duration_nights">Duration (Nights) *</label>
                                            <input type="number" class="form-control" id="duration_nights" name="duration_nights" value="{{ old('duration_nights') }}" required min="0">
                                            @error('duration_nights')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cover_image">Cover Image</label>
                                            <input type="file" class="form-control-file" id="cover_image" name="cover_image">
                                            <small class="form-text text-muted">Recommended size: 1200x600px</small>
                                            @error('cover_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Trip Description *</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic Components Selection -->
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">
                                <h4 class="card-title mb-0">Dynamic Components</h4>
                            </div>
                            <div class="card-body">

                                <!-- Included Services -->
                                <div class="component-section mb-4">
                                    <h5>What's Included</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6>Available Services</h6>
                                            <div id="included-services-available" class="selected-components">
                                                @foreach($includedServices as $service)
                                                <div class="component-item" data-id="{{ $service->id }}">
                                                    <div class="form-check">
                                                        <input class="form-check-input included-service-checkbox" type="checkbox" name="selected_included_services[]" value="{{ $service->id }}" id="included-{{ $service->id }}">
                                                        <label class="form-check-label" for="included-{{ $service->id }}">
                                                            <strong>{{ $service->title }}</strong>
                                                            @if($service->description)
                                                            <br><small>{{ Str::limit($service->description, 50) }}</small>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Excluded Services -->
                                <div class="component-section mb-4">
                                    <h5>What's Not Included</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6>Available Services</h6>
                                            <div id="excluded-services-available" class="selected-components">
                                                @foreach($excludedServices as $service)
                                                <div class="component-item" data-id="{{ $service->id }}">
                                                    <div class="form-check">
                                                        <input class="form-check-input excluded-service-checkbox" type="checkbox" name="selected_excluded_services[]" value="{{ $service->id }}" id="excluded-{{ $service->id }}">
                                                        <label class="form-check-label" for="excluded-{{ $service->id }}">
                                                            <strong>{{ $service->title }}</strong>
                                                            @if($service->description)
                                                            <br><small>{{ Str::limit($service->description, 50) }}</small>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Experience Highlights -->
                                <div class="component-section mb-4">
                                    <h5>Experience Highlights</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6>Available Highlights</h6>
                                            <div id="experience-highlights-available" class="selected-components">
                                                @foreach($experienceHighlights as $highlight)
                                                <div class="component-item" data-id="{{ $highlight->id }}">
                                                    <div class="form-check">
                                                        <input class="form-check-input experience-highlight-checkbox" type="checkbox" name="selected_experience_highlights[]" value="{{ $highlight->id }}" id="highlight-{{ $highlight->id }}">
                                                        <label class="form-check-label" for="highlight-{{ $highlight->id }}">
                                                            <strong>{{ $highlight->title }}</strong>
                                                            @if($highlight->description)
                                                            <br><small>{{ Str::limit($highlight->description, 50) }}</small>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Important Information -->
                                <div class="component-section mb-4">
                                    <h5>Important Information</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6>Available Information</h6>
                                            <div id="important-information-available" class="selected-components">
                                                @foreach($importantInformation as $info)
                                                <div class="component-item" data-id="{{ $info->id }}">
                                                    <div class="form-check">
                                                        <input class="form-check-input important-information-checkbox" type="checkbox" name="selected_important_information[]" value="{{ $info->id }}" id="info-{{ $info->id }}">
                                                        <label class="form-check-label" for="info-{{ $info->id }}">
                                                            <strong>{{ $info->title }}</strong>
                                                            @if($info->description)
                                                            <br><small>{{ Str::limit($info->description, 50) }}</small>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Facts -->
                                <div class="component-section mb-4">
                                    <h5>Quick Facts</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6>Available Facts</h6>
                                            <div id="quick-facts-available" class="selected-components">
                                                @foreach($quickFacts as $fact)
                                                <div class="component-item" data-id="{{ $fact->id }}">
                                                    <div class="form-check">
                                                        <input class="form-check-input quick-fact-checkbox" type="checkbox" name="selected_quick_facts[]" value="{{ $fact->id }}" id="fact-{{ $fact->id }}">
                                                        <label class="form-check-label" for="fact-{{ $fact->id }}">
                                                            <strong>{{ $fact->fact }}</strong>: {{ $fact->value }}
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Itinerary Days -->
                        <div class="card mb-4">
                            <div class="card-header bg-warning text-dark">
                                <h4 class="card-title mb-0">Detailed Itinerary</h4>
                            </div>
                            <div class="card-body" id="days-container">
                                <!-- Days will be added here dynamically -->
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-sm btn-primary" id="add-day">
                                    <i class="fas fa-plus"></i> Add Day
                                </button>
                            </div>
                        </div>

                        <!-- Pricing Options -->
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">
                                <h4 class="card-title mb-0">Pricing Options</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Standard Package (Solo) *</label>
                                            <input type="number" class="form-control" name="pricing_options[standard_solo]" value="{{ old('pricing_options.standard_solo') }}" required>
                                            @error('pricing_options.standard_solo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Standard Package (Couple) *</label>
                                            <input type="number" class="form-control" name="pricing_options[standard_couple]" value="{{ old('pricing_options.standard_couple') }}" required>
                                            @error('pricing_options.standard_couple')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Deluxe Package (Solo)</label>
                                            <input type="number" class="form-control" name="pricing_options[deluxe_solo]" value="{{ old('pricing_options.deluxe_solo') }}">
                                            @error('pricing_options.deluxe_solo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Deluxe Package (Couple)</label>
                                            <input type="number" class="form-control" name="pricing_options[deluxe_couple]" value="{{ old('pricing_options.deluxe_couple') }}">
                                            @error('pricing_options.deluxe_couple')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-white">
                                <h4 class="card-title mb-0">Additional Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="payment_terms">Payment Terms</label>
                                    <textarea class="form-control" id="payment_terms" name="payment_terms" rows="3">{{ old('payment_terms') }}</textarea>
                                    @error('payment_terms')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cancellation_policy">Cancellation Policy</label>
                                    <textarea class="form-control" id="cancellation_policy" name="cancellation_policy" rows="3">{{ old('cancellation_policy') }}</textarea>
                                    @error('cancellation_policy')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="terms_conditions">Terms & Conditions</label>
                                    <textarea class="form-control" id="terms_conditions" name="terms_conditions" rows="4">{{ old('terms_conditions') }}</textarea>
                                    @error('terms_conditions')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Itinerary Template
                            </button>
                            <a href="{{ route('admin.itinerary-templates.index') }}" class="btn btn-secondary">
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
    let dayCount = 0;

    // Add first day
    addDay();

    function addDay() {
        const html = `
            <div class="day-card mb-3 p-3 border rounded">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Day Number</label>
                            <input type="number" class="form-control" name="days[${dayCount}][day_number]" value="${dayCount + 1}" min="1" required>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Day Title *</label>
                            <input type="text" class="form-control" name="days[${dayCount}][title]" required>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm remove-day mt-4" ${dayCount === 0 ? 'disabled' : ''}>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description *</label>
                    <textarea class="form-control" name="days[${dayCount}][description]" rows="3" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Activities</label>
                            <textarea class="form-control" name="days[${dayCount}][activities]" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Meals</label>
                            <textarea class="form-control" name="days[${dayCount}][meals]" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Accommodation</label>
                            <textarea class="form-control" name="days[${dayCount}][accommodation]" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#days-container').append(html);
        dayCount++;
    }

    $('#add-day').click(function() {
        addDay();
        // Enable remove buttons if there's more than one day
        if (dayCount > 1) {
            $('.remove-day').prop('disabled', false);
        }
    });

    $(document).on('click', '.remove-day', function() {
        if ($('.day-card').length > 1) {
            $(this).closest('.day-card').remove();
            dayCount--;
            // Disable remove button if only one day left
            if (dayCount === 1) {
                $('.remove-day').prop('disabled', true);
            }
        }
    });

    // Component selection handling
    $('.component-item').click(function(e) {
        if (!$(e.target).is('input')) {
            const checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked'));
        }
    });
</script>
@endpush
