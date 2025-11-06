<!-- Destination Start -->
<div class="container-fluid destination py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Destination</h5>
            <h1 class="mb-0">Popular Destination</h1>
        </div>

        @if($destinationCategories->count() > 0 && $destinations->count() > 0) {{-- Changed from $categories to $destinationCategories --}}
        <div class="tab-class text-center">
            <!-- Category Tabs -->
            <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                <li class="nav-item">
                    <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-all">
                        <span class="text-dark" style="width: 150px;">All</span>
                    </a>
                </li>
                @foreach($destinationCategories as $category) {{-- Changed from $categories to $destinationCategories --}}
                <li class="nav-item">
                    <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-{{ $category->slug }}">
                        <span class="text-dark" style="width: 150px;">{{ $category->name }}</span>
                    </a>
                </li>
                @endforeach
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- All Destinations Tab -->
                <div id="tab-all" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        @php
                        $allDestinations = $destinations->chunk(ceil($destinations->count() / 3));
                        @endphp

                        @if($allDestinations->count() >= 3)
                        <!-- First Column - 4 items -->
                        <div class="col-xl-8">
                            <div class="row g-4">
                                @foreach($allDestinations[0] as $destination)
                                <div class="col-lg-6">
                                    <div class="destination-img position-relative overflow-hidden rounded">
                                        <img class="img-fluid rounded w-100" src="{{ asset('images/destinations/' . $destination->image) }}" alt="{{ $destination->title }}" style="height: 300px; object-fit: cover;">
                                        <div class="destination-overlay p-4">
                                            <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">{{ $destination->photos_count ?? 20 }} Photos</a>
                                            <h4 class="text-white mb-2 mt-3">{{ $destination->title }}</h4>
                                            <a href="{{ $destination->button_link ?: '#' }}" class="btn-hover text-white">
                                                View All Place <i class="fa fa-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                        <div class="search-icon">
                                            <a href="{{ asset('images/destinations/' . $destination->image) }}" data-lightbox="destination-{{ $destination->id }}">
                                                <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Second Column - Full height image -->
                        @if(isset($allDestinations[1]) && $allDestinations[1]->count() > 0)
                        <div class="col-xl-4">
                            <div class="destination-img position-relative overflow-hidden rounded h-100">
                                <img class="img-fluid rounded w-100 h-100" src="{{ asset('images/destinations/' . $allDestinations[1]->first()->image) }}" style="object-fit: cover; min-height: 300px;" alt="{{ $allDestinations[1]->first()->title }}">
                                <div class="destination-overlay p-4">
                                    <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">{{ $allDestinations[1]->first()->photos_count ?? 20 }} Photos</a>
                                    <h4 class="text-white mb-2 mt-3">{{ $allDestinations[1]->first()->title }}</h4>
                                    <a href="{{ $allDestinations[1]->first()->button_link ?: '#' }}" class="btn-hover text-white">
                                        View All Place <i class="fa fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                                <div class="search-icon">
                                    <a href="{{ asset('images/destinations/' . $allDestinations[1]->first()->image) }}" data-lightbox="destination-{{ $allDestinations[1]->first()->id }}">
                                        <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Third Column - Remaining items -->
                        @if(isset($allDestinations[2]))
                        <div class="row g-4 mt-0">
                            @foreach($allDestinations[2] as $destination)
                            <div class="col-lg-4">
                                <div class="destination-img position-relative overflow-hidden rounded">
                                    <img class="img-fluid rounded w-100" src="{{ asset('images/destinations/' . $destination->image) }}" alt="{{ $destination->title }}" style="height: 250px; object-fit: cover;">
                                    <div class="destination-overlay p-4">
                                        <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">{{ $destination->photos_count ?? 20 }} Photos</a>
                                        <h4 class="text-white mb-2 mt-3">{{ $destination->title }}</h4>
                                        <a href="{{ $destination->button_link ?: '#' }}" class="btn-hover text-white">
                                            View All Place <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                    <div class="search-icon">
                                        <a href="{{ asset('images/destinations/' . $destination->image) }}" data-lightbox="destination-{{ $destination->id }}">
                                            <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        @else
                        <!-- Fallback layout for fewer destinations -->
                        <div class="row g-4">
                            @foreach($destinations as $destination)
                            <div class="col-lg-4 col-md-6">
                                <div class="destination-img position-relative overflow-hidden rounded">
                                    <img class="img-fluid rounded w-100" src="{{ asset('images/destinations/' . $destination->image) }}" alt="{{ $destination->title }}" style="height: 250px; object-fit: cover;">
                                    <div class="destination-overlay p-4">
                                        <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">{{ $destination->photos_count ?? 20 }} Photos</a>
                                        <h4 class="text-white mb-2 mt-3">{{ $destination->title }}</h4>
                                        <a href="{{ $destination->button_link ?: '#' }}" class="btn-hover text-white">
                                            View All Place <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                    <div class="search-icon">
                                        <a href="{{ asset('images/destinations/' . $destination->image) }}" data-lightbox="destination-{{ $destination->id }}">
                                            <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Category-specific Tabs -->
                @foreach($destinationCategories as $category) {{-- Changed from $categories to $destinationCategories --}}
                <div id="tab-{{ $category->slug }}" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        @php
                        $categoryDestinations = $destinations->where('category_id', $category->id);
                        @endphp

                        @if($categoryDestinations->count() > 0)
                        @foreach($categoryDestinations as $destination)
                        <div class="col-lg-6">
                            <div class="destination-img position-relative overflow-hidden rounded">
                                <img class="img-fluid rounded w-100" src="{{ asset('images/destinations/' . $destination->image) }}" alt="{{ $destination->title }}" style="height: 300px; object-fit: cover;">
                                <div class="destination-overlay p-4">
                                    <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">{{ $destination->photos_count ?? 20 }} Photos</a>
                                    <h4 class="text-white mb-2 mt-3">{{ $destination->title }}</h4>
                                    <a href="{{ $destination->button_link ?: '#' }}" class="btn-hover text-white">
                                        View All Place <i class="fa fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                                <div class="search-icon">
                                    <a href="{{ asset('images/destinations/' . $destination->image) }}" data-lightbox="destination-{{ $destination->id }}">
                                        <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="col-12 text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-map-marker-alt fa-3x mb-3"></i>
                                <h4>No destinations found for {{ $category->name }}</h4>
                                <p>Check back later for amazing destinations in this category!</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <!-- Default destinations when no data exists -->
        <div class="tab-class text-center">
            <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                <li class="nav-item">
                    <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-default-all">
                        <span class="text-dark" style="width: 150px;">All</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-default-usa">
                        <span class="text-dark" style="width: 150px;">USA</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-default-canada">
                        <span class="text-dark" style="width: 150px;">Canada</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="tab-default-all" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <!-- Default destination items -->
                        <div class="col-lg-4 col-md-6">
                            <div class="destination-img position-relative overflow-hidden rounded">
                                <img class="img-fluid rounded w-100" src="{{ asset('img/destination-1.jpg') }}" alt="New York City" style="height: 250px; object-fit: cover;">
                                <div class="destination-overlay p-4">
                                    <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                    <h4 class="text-white mb-2 mt-3">New York City</h4>
                                    <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                                <div class="search-icon">
                                    <a href="{{ asset('img/destination-1.jpg') }}" data-lightbox="destination-default-1">
                                        <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="destination-img position-relative overflow-hidden rounded">
                                <img class="img-fluid rounded w-100" src="{{ asset('img/destination-2.jpg') }}" alt="Las Vegas" style="height: 250px; object-fit: cover;">
                                <div class="destination-overlay p-4">
                                    <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                    <h4 class="text-white mb-2 mt-3">Las Vegas</h4>
                                    <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                                <div class="search-icon">
                                    <a href="{{ asset('img/destination-2.jpg') }}" data-lightbox="destination-default-2">
                                        <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="destination-img position-relative overflow-hidden rounded">
                                <img class="img-fluid rounded w-100" src="{{ asset('img/destination-3.jpg') }}" alt="Los Angeles" style="height: 250px; object-fit: cover;">
                                <div class="destination-overlay p-4">
                                    <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                    <h4 class="text-white mb-2 mt-3">Los Angeles</h4>
                                    <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                                <div class="search-icon">
                                    <a href="{{ asset('img/destination-3.jpg') }}" data-lightbox="destination-default-3">
                                        <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other default tabs -->
                <div id="tab-default-usa" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="destination-img position-relative overflow-hidden rounded">
                                <img class="img-fluid rounded w-100" src="{{ asset('img/destination-4.jpg') }}" alt="San Francisco" style="height: 300px; object-fit: cover;">
                                <div class="destination-overlay p-4">
                                    <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                    <h4 class="text-white mb-2 mt-3">San Francisco</h4>
                                    <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                                <div class="search-icon">
                                    <a href="{{ asset('img/destination-4.jpg') }}" data-lightbox="destination-default-4">
                                        <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="destination-img position-relative overflow-hidden rounded">
                                <img class="img-fluid rounded w-100" src="{{ asset('img/destination-5.jpg') }}" alt="Miami" style="height: 300px; object-fit: cover;">
                                <div class="destination-overlay p-4">
                                    <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">20 Photos</a>
                                    <h4 class="text-white mb-2 mt-3">Miami</h4>
                                    <a href="#" class="btn-hover text-white">View All Place <i class="fa fa-arrow-right ms-2"></i></a>
                                </div>
                                <div class="search-icon">
                                    <a href="{{ asset('img/destination-5.jpg') }}" data-lightbox="destination-default-5">
                                        <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Destination End -->
