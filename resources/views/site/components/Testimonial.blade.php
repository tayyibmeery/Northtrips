<!-- Testimonial Start -->
<div class="container-fluid testimonial py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Testimonial</h5>
            <h1 class="mb-0">Our Clients Say!!!</h1>
        </div>

        @if(isset($testimonials) && $testimonials->count() > 0)
        <div class="testimonial-carousel owl-carousel">
            @foreach($testimonials as $testimonial)
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-5">{{ $testimonial->comment }}</p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="{{ asset('images/testimonials/' . $testimonial->image) }}" class="img-fluid rounded-circle" alt="{{ $testimonial->client_name }}" style="width: 80px; height: 80px; object-fit: cover;">
                </div>
                <div style="margin-top: -35px;">
                    <h5 class="mb-0">{{ $testimonial->client_name }}</h5>
                    <p class="mb-0">{{ $testimonial->location }}</p>
                    <div class="d-flex justify-content-center">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimonial->rating)
                                <i class="fas fa-star text-primary"></i>
                            @else
                                <i class="far fa-star text-primary"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Fallback testimonials if no dynamic testimonials exist -->
        <div class="testimonial-carousel owl-carousel">
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-5">Amazing travel experience! North Trips made our vacation unforgettable with their excellent service and attention to detail.</p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="{{ asset('img/testimonial-1.jpg') }}" class="img-fluid rounded-circle" alt="John Abraham">
                </div>
                <div style="margin-top: -35px;">
                    <h5 class="mb-0">John Abraham</h5>
                    <p class="mb-0">New York, USA</p>
                    <div class="d-flex justify-content-center">
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-5">Professional team and great packages. We enjoyed every moment of our trip. Highly recommended for family vacations!</p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="{{ asset('img/testimonial-2.jpg') }}" class="img-fluid rounded-circle" alt="Sarah Johnson">
                </div>
                <div style="margin-top: -35px;">
                    <h5 class="mb-0">Sarah Johnson</h5>
                    <p class="mb-0">London, UK</p>
                    <div class="d-flex justify-content-center">
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Testimonial End -->

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize testimonial carousel
        if ($('.testimonial-carousel').length) {
            $('.testimonial-carousel').owlCarousel({
                loop: true,
                margin: 30,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    }
                }
            });
        }
    });
</script>
@endpush
