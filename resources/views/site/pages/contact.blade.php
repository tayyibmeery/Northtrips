@extends('site.layout.app')
@section('title', 'Contact Us - ' . ($setting->company_name ?? 'North Trips & Travel'))

@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid bg-breadcrumb" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), var(--breadcrumb-bg-image); background-size: cover; background-position: center;">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Contact Us</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
            <li class="breadcrumb-item active text-white">Contact</li>
        </ol>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Contact Start -->
<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Contact Us</h5>
            <h1 class="mb-4">Get In Touch With Us</h1>
            <p class="mb-0">Have questions about our travel packages or need assistance with your booking? We're here to help! Reach out to us through any of the following methods.</p>
        </div>

        <div class="row g-5">
            <!-- Contact Information -->
            <div class="col-lg-5">
                <div class="contact-info bg-light rounded p-5 h-100">
                    <h4 class="mb-4">Contact Information</h4>
                    <p class="mb-4">Feel free to contact us for any travel inquiries, bookings, or assistance. Our team is available to help you plan your perfect trip.</p>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-map-marker-alt fa-2x text-white"></i>
                            </div>
                        </div>
                        <div class="ms-4">
                            <h5 class="text-primary">Our Address</h5>
                            <p class="mb-0">{{ $setting->address ?? 'North Trips & Travel Office' }}</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-envelope fa-2x text-white"></i>
                            </div>
                        </div>
                        <div class="ms-4">
                            <h5 class="text-primary">Email Us</h5>
                            <p class="mb-0">{{ $setting->email ?? 'info@northtrips.com' }}</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-phone fa-2x text-white"></i>
                            </div>
                        </div>
                        <div class="ms-4">
                            <h5 class="text-primary">Call Us</h5>
                            <p class="mb-0">{{ $setting->phone ?? '+1 234 567 8900' }}</p>
                        </div>
                    </div>

                    @if($setting->whatsapp)
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fab fa-whatsapp fa-2x text-white"></i>
                            </div>
                        </div>
                        <div class="ms-4">
                            <h5 class="text-primary">WhatsApp</h5>
                            <p class="mb-0">{{ $setting->whatsapp }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Social Media Links -->
                    @if($social->count() > 0)
                    <div class="mt-5">
                        <h5 class="text-primary mb-3">Follow Us</h5>
                        <div class="d-flex">
                            @foreach($social as $socialMedia)
                            <a href="{{ $socialMedia->url }}" target="_blank" class="btn btn-primary btn-square rounded-circle me-2">
                                <i class="fab fa-{{ $socialMedia->icon_class }}"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="contact-form bg-white rounded p-5">
                    <h4 class="mb-4">Send Us a Message</h4>
                    <form id="contactForm" method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control border-primary" id="name" name="name" placeholder="Your Name" required>
                                    <label for="name">Your Name *</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control border-primary" id="email" name="email" placeholder="Your Email" required>
                                    <label for="email">Your Email *</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control border-primary" id="phone" name="phone" placeholder="Your Phone">
                                    <label for="phone">Your Phone (Optional)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control border-primary" id="subject" name="subject" placeholder="Subject" required>
                                    <label for="subject">Subject *</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-control border-primary" id="type" name="type">
                                        <option value="general">General Inquiry</option>
                                        <option value="booking">Booking Related</option>
                                        <option value="complaint">Complaint</option>
                                        <option value="suggestion">Suggestion</option>
                                        <option value="partnership">Partnership</option>
                                    </select>
                                    <label for="type">Query Type</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control border-primary" placeholder="Leave a message here" id="message" name="message" style="height: 150px" required></textarea>
                                    <label for="message">Message *</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit" id="contactSubmitBtn">
                                    <span id="contactSubmitText">Send Message</span>
                                    <div id="contactSubmitSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div id="contactMessage" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<!-- Map Section Start -->
<div class="container-fluid map-section py-5 bg-light">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Find Us</h5>
            <h1 class="mb-4">Our Location</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="map-container rounded">
                    <div class="ratio ratio-16x9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3618.664763855663!2d67.001774315544!3d24.906151984028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33f5b7e7a3a39%3A0x3f00fc97c2bfb3a0!2sKarachi%2C%20Pakistan!5e0!3m2!1sen!2s!4v1620000000000!5m2!1sen!2s"
                            width="100%"
                            height="450"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            class="rounded">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Map Section End -->
@endsection

@push('styles')
<style>
    .bg-breadcrumb {
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
    }

    .contact-info {
        border-left: 5px solid var(--bs-primary);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .contact-form {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border: 1px solid #e9ecef;
    }

    .map-container {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .btn-square {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-control:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Contact form submission
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();

            const submitBtn = $('#contactSubmitBtn');
            const submitText = $('#contactSubmitText');
            const submitSpinner = $('#contactSubmitSpinner');
            const messageDiv = $('#contactMessage');

            // Show loading state
            submitBtn.prop('disabled', true);
            submitText.text('Sending...');
            submitSpinner.removeClass('d-none');
            messageDiv.html('');

            // Submit form via AJAX
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        messageDiv.html('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                            '<strong>Success!</strong> ' + response.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                            '</div>');
                        $('#contactForm')[0].reset();
                    } else {
                        messageDiv.html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            '<strong>Error!</strong> ' + response.message +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                            '</div>');
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred while sending your message. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        // Display validation errors
                        let errors = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errors += value + '<br>';
                        });
                        errorMessage = errors;
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    messageDiv.html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        '<strong>Error!</strong> ' + errorMessage +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>');
                },
                complete: function() {
                    // Reset button state
                    submitBtn.prop('disabled', false);
                    submitText.text('Send Message');
                    submitSpinner.addClass('d-none');

                    // Scroll to message
                    $('html, body').animate({
                        scrollTop: messageDiv.offset().top - 100
                    }, 500);
                }
            });
        });
    });
</script>
@endpush
