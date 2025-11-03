<!-- Packages Start -->
<div class="container-fluid packages py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Packages</h5>
            <h1 class="mb-0">Awesome Packages</h1>
        </div>

        @if($packages->count() > 0)
        <div class="packages-carousel owl-carousel">
            @foreach($packages as $package)
            <div class="packages-item">
                <div class="packages-img position-relative">
                    <img src="{{ asset('storage/' . $package->image) }}" class="img-fluid w-100 rounded-top" alt="{{ $package->title }}" style="height: 250px; object-fit: cover;">
                    <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute" style="width: 100%; bottom: 0; left: 0; z-index: 5; background: rgba(255,255,255,0.9);">
                        <small class="flex-fill text-center border-end py-2">
                            <i class="fa fa-map-marker-alt me-2"></i>{{ $package->destination }}
                        </small>
                        <small class="flex-fill text-center border-end py-2">
                            <i class="fa fa-calendar-alt me-2"></i>{{ $package->duration_days }} days
                        </small>
                        <small class="flex-fill text-center py-2">
                            <i class="fa fa-user me-2"></i>{{ $package->persons }} Person{{ $package->persons > 1 ? 's' : '' }}
                        </small>
                    </div>
                    <div class="packages-price py-2 px-4">${{ number_format($package->price, 2) }}</div>
                </div>
                <div class="packages-content bg-light">
                    <div class="p-4 pb-0">
                        <h5 class="mb-0">{{ $package->title }}</h5>
                        <small class="text-uppercase">{{ $package->hotel_deals_text ?: 'Hotel Deals' }}</small>
                        <div class="mb-3">
                            {!! $package->star_rating !!}
                        </div>
                        <p class="mb-4">{{ Str::limit($package->description, 120) }}</p>
                    </div>
                    <div class="row bg-primary rounded-bottom mx-0">
                        <div class="col-6 text-start px-0">
                            <a href="{{ $package->read_more_link ?: '#' }}" class="btn-hover btn text-white py-2 px-4">
                                {{ $package->read_more_text ?: 'Read More' }}
                            </a>
                        </div>
                        <div class="col-6 text-end px-0">
                            <a href="{{ $package->book_now_link ?: '#' }}" class="btn-hover btn text-white py-2 px-4">
                                {{ $package->book_now_text ?: 'Book Now' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Default packages when no data exists -->
        <div class="packages-carousel owl-carousel">
            <div class="packages-item">
                <div class="packages-img position-relative">
                    <img src="{{ asset('img/packages-1.jpg') }}" class="img-fluid w-100 rounded-top" alt="Venice - Italy">
                    <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute" style="width: 100%; bottom: 0; left: 0; z-index: 5; background: rgba(255,255,255,0.9);">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt me-2"></i>Venice - Italy</small>
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt me-2"></i>3 days</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-user me-2"></i>2 Person</small>
                    </div>
                    <div class="packages-price py-2 px-4">$349.00</div>
                </div>
                <div class="packages-content bg-light">
                    <div class="p-4 pb-0">
                        <h5 class="mb-0">Venice - Italy</h5>
                        <small class="text-uppercase">Hotel Deals</small>
                        <div class="mb-3">
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                        </div>
                        <p class="mb-4">Experience the romantic canals and historic architecture of Venice with our exclusive package.</p>
                    </div>
                    <div class="row bg-primary rounded-bottom mx-0">
                        <div class="col-6 text-start px-0">
                            <a href="#" class="btn-hover btn text-white py-2 px-4">Read More</a>
                        </div>
                        <div class="col-6 text-end px-0">
                            <a href="#" class="btn-hover btn text-white py-2 px-4">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Packages End -->
