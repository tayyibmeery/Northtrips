<!-- Tour Booking Start -->
<div class="container-fluid booking py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h5 class="section-booking-title pe-3">Booking</h5>
                <h1 class="text-white mb-4">Online Booking</h1>
                <p class="text-white mb-4">Book your dream tour with North Trips & Travel. We offer customized packages to the most beautiful destinations in Pakistan. Our expert team ensures you have an unforgettable experience with the best services and competitive prices.</p>
                <p class="text-white mb-4">Get <span class="text-warning fw-bold">50% Off</span> on your first adventure trip with us. Experience the majestic mountains, serene valleys, and rich culture of Northern Pakistan with our professional guides.</p>
                <a href="{{ route('packages') }}" class="btn btn-light text-primary rounded-pill py-3 px-5 mt-2">View All Packages</a>
            </div>
            <div class="col-lg-6">
                <h1 class="text-white mb-3">Book A Tour</h1>
                <p class="text-white mb-4">Get <span class="text-warning fw-bold">50% Off</span> On Your First Adventure Trip With North Trips & Travel.</p>

                <form id="bookingForm" method="POST" action="{{ route('booking.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control bg-white border-0 @error('name') is-invalid @enderror" id="name" name="name" placeholder="Your Name" value="{{ old('name') }}" required>
                                <label for="name">Your Name *</label>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control bg-white border-0 @error('email') is-invalid @enderror" id="email" name="email" placeholder="Your Email" value="{{ old('email') }}" required>
                                <label for="email">Your Email *</label>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control bg-white border-0 @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Your Phone" value="{{ old('phone') }}">
                                <label for="phone">Your Phone</label>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control bg-white border-0 @error('booking_date') is-invalid @enderror" id="booking_date" name="booking_date" value="{{ old('booking_date') }}" min="{{ date('Y-m-d') }}" required>
                                <label for="booking_date">Booking Date *</label>
                                @error('booking_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0 @error('destination') is-invalid @enderror" id="destination" name="destination" required>
                                    <option value="">Select Destination</option>
                                    <option value="Northern Areas Tour" {{ old('destination') == 'Northern Areas Tour' ? 'selected' : '' }}>Northern Areas Tour</option>
                                    <option value="Skardu Adventure" {{ old('destination') == 'Skardu Adventure' ? 'selected' : '' }}>Skardu Adventure</option>
                                    <option value="Hunza Valley Exploration" {{ old('destination') == 'Hunza Valley Exploration' ? 'selected' : '' }}>Hunza Valley Exploration</option>
                                    <option value="Fairy Meadows Trek" {{ old('destination') == 'Fairy Meadows Trek' ? 'selected' : '' }}>Fairy Meadows Trek</option>
                                    <option value="Naran Kaghan Tour" {{ old('destination') == 'Naran Kaghan Tour' ? 'selected' : '' }}>Naran Kaghan Tour</option>
                                    <option value="Swat Valley Trip" {{ old('destination') == 'Swat Valley Trip' ? 'selected' : '' }}>Swat Valley Trip</option>
                                    <option value="Custom Package" {{ old('destination') == 'Custom Package' ? 'selected' : '' }}>Custom Package</option>
                                </select>
                                <label for="destination">Destination *</label>
                                @error('destination')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0 @error('persons') is-invalid @enderror" id="persons" name="persons" required>
                                    <option value="">Select Persons</option>
                                    @for($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}" {{ old('persons') == $i ? 'selected' : '' }}>{{ $i }} Person{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                                <label for="persons">Number of Persons *</label>
                                @error('persons')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0 @error('category') is-invalid @enderror" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="Family Tour" {{ old('category') == 'Family Tour' ? 'selected' : '' }}>Family Tour</option>
                                    <option value="Adventure Tour" {{ old('category') == 'Adventure Tour' ? 'selected' : '' }}>Adventure Tour</option>
                                    <option value="Honeymoon Package" {{ old('category') == 'Honeymoon Package' ? 'selected' : '' }}>Honeymoon Package</option>
                                    <option value="Group Tour" {{ old('category') == 'Group Tour' ? 'selected' : '' }}>Group Tour</option>
                                    <option value="Solo Travel" {{ old('category') == 'Solo Travel' ? 'selected' : '' }}>Solo Travel</option>
                                    <option value="Corporate Tour" {{ old('category') == 'Corporate Tour' ? 'selected' : '' }}>Corporate Tour</option>
                                </select>
                                <label for="category">Tour Category *</label>
                                @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control bg-white border-0 @error('special_request') is-invalid @enderror" placeholder="Special Request" id="special_request" name="special_request" style="height: 100px">{{ old('special_request') }}</textarea>
                                <label for="special_request">Special Request</label>
                                @error('special_request')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary text-white w-100 py-3" type="submit" id="submitBtn">
                                <span id="submitText">Book Now</span>
                                <div id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </form>

                <div id="bookingMessage" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>
<!-- Tour Booking End -->

@push('scripts')
<script>
    $(document).ready(function() {
        $('#bookingForm').on('submit', function(e) {
            e.preventDefault();

            const submitBtn = $('#submitBtn');
            const submitText = $('#submitText');
            const submitSpinner = $('#submitSpinner');
            const messageDiv = $('#bookingMessage');

            // Show loading state
            submitBtn.prop('disabled', true);
            submitText.text('Booking...');
            submitSpinner.removeClass('d-none');
            messageDiv.html('');

            // Submit form via AJAX
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        messageDiv.html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#bookingForm')[0].reset();
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
                    }
                    messageDiv.html('<div class="alert alert-danger">' + errorMessage + '</div>');
                },
                complete: function() {
                    // Reset button state
                    submitBtn.prop('disabled', false);
                    submitText.text('Book Now');
                    submitSpinner.addClass('d-none');
                }
            });
        });

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        $('#booking_date').attr('min', today);
    });
</script>
@endpush