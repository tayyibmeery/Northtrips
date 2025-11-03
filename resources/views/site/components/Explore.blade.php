<!-- Explore Tour Start -->
<div class="container-fluid ExploreTour py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Explore Tour</h5>
            <h1 class="mb-4">The World</h1>
            <p class="mb-0">Discover amazing national and international tour packages tailored to your travel preferences. From weekend getaways to international adventures, we have the perfect tour for every traveler.</p>
        </div>
        <div class="tab-class text-center">
            <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                <li class="nav-item">
                    <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#NationalTab-1">
                        <span class="text-dark" style="width: 250px;">National Tour Category</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#InternationalTab-2">
                        <span class="text-dark" style="width: 250px;">International Tour Category</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- National Tours Tab -->
                <div id="NationalTab-1" class="tab-pane fade show p-0 active">
                    @if($nationalTours->count() > 0)
                    <div class="row g-4">
                        @foreach($nationalTours as $tour)
                        <div class="col-md-6 col-lg-4">
                            <div class="national-item position-relative overflow-hidden rounded">
                                <img src="{{ asset('storage/' . $tour->image) }}" class="img-fluid w-100 rounded" alt="{{ $tour->title }}" style="height: 300px; object-fit: cover;">
                                <div class="national-content position-absolute bottom-0 start-0 end-0 p-4">
                                    <div class="national-info">
                                        <h5 class="text-white text-uppercase mb-2">{{ $tour->title }}</h5>
                                        <a href="{{ $tour->button_link ?: '#' }}" class="btn-hover text-white">
                                            View All Place <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                                @if($tour->discount_percentage)
                                <div class="tour-offer bg-info position-absolute top-0 end-0 m-3">
                                    {{ $tour->discount_percentage }}% Off
                                </div>
                                @endif
                                <div class="national-plus-icon position-absolute top-0 start-0 m-3">
                                    <a href="{{ $tour->button_link ?: '#' }}" class="my-auto">
                                        <i class="fas fa-link fa-2x text-white"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-map-marked-alt fa-4x mb-3"></i>
                            <h4>No National Tours Available</h4>
                            <p>Check back later for amazing national tour packages!</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- International Tours Tab -->
                <div id="InternationalTab-2" class="tab-pane fade show p-0">
                    @if($internationalTours->count() > 0)
                    <div class="InternationalTour-carousel owl-carousel">
                        @foreach($internationalTours as $tour)
                        <div class="international-item position-relative overflow-hidden rounded">
                            <img src="{{ asset('storage/' . $tour->image) }}" class="img-fluid w-100 rounded" alt="{{ $tour->title }}" style="height: 400px; object-fit: cover;">
                            <div class="international-content position-absolute bottom-0 start-0 end-0 p-4">
                                <div class="international-info">
                                    <h5 class="text-white text-uppercase mb-2">{{ $tour->title }}</h5>
                                    <div class="d-flex flex-wrap">
                                        @if($tour->cities_count)
                                        <a href="#" class="btn-hover text-white me-4 mb-2">
                                            <i class="fas fa-map-marker-alt me-1"></i> {{ $tour->cities_count }} Cities
                                        </a>
                                        @endif
                                        @if($tour->tour_places_count)
                                        <a href="#" class="btn-hover text-white mb-2">
                                            <i class="fa fa-eye ms-2"></i> <span>{{ $tour->tour_places_count }}+ Tour Places</span>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($tour->discount_percentage)
                            <div class="tour-offer bg-success position-absolute top-0 end-0 m-3">
                                {{ $tour->discount_percentage }}% Off
                            </div>
                            @endif
                            <div class="international-plus-icon position-absolute top-0 start-0 m-3">
                                <a href="{{ $tour->button_link ?: '#' }}" class="my-auto">
                                    <i class="fas fa-link fa-2x text-white"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="text-muted">
                            <i class="fas fa-globe-americas fa-4x mb-3"></i>
                            <h4>No International Tours Available</h4>
                            <p>Check back later for amazing international destinations!</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Explore Tour End -->


@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Owl Carousel for International Tours
        $('.InternationalTour-carousel').owlCarousel({
            loop: true
            , margin: 20
            , nav: true
            , dots: false
            , autoplay: true
            , autoplayTimeout: 5000
            , autoplayHoverPause: true
            , responsive: {
                0: {
                    items: 1
                }
                , 768: {
                    items: 2
                }
                , 992: {
                    items: 3
                }
            }
        });
    });

</script>
@endpush

