@extends('site.layout.app')

@section('title', 'Travela - Home')

@section('content')

@php
use App\Models\CompanySetting;
use App\Models\SocialMediaLink;
use App\Models\Carousel;
use App\Models\AboutSection;

$aboutSections = AboutSection::where('is_active', true)->get();
$setting = CompanySetting::first();
$social = SocialMediaLink::all();
$carousels = Carousel::active()->ordered()->get();
@endphp

<!-- About Start -->
<div class="container-fluid about py-5">
    <div class="container py-5">
        @forelse($aboutSections as $about)
        <div class="row g-5 align-items-center">
            <!-- Image Column -->
            <div class="col-lg-5">
                <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                    @if($about->image)
                    <img src="{{ asset('storage/' . $about->image) }}" class="img-fluid w-100 h-100" alt="{{ $about->title ?: 'About Us' }}" style="object-fit: cover;">
                    @else
                    <!-- Fallback image -->
                    <div class="bg-light d-flex align-items-center justify-content-center h-100">
                        <div class="text-center text-muted">
                            <i class="fas fa-image fa-4x mb-3"></i>
                            <p>About Us Image</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Content Column -->
            <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)),
                        url({{ $about->background_image ? asset('storage/' . $about->background_image) : asset('img/about-img-1.png') }});
                        background-size: cover; background-position: center;">

                <h5 class="section-about-title pe-3">About Us</h5>

                @if($about->title)
                <h1 class="mb-4">{!! $about->title !!}</h1>
                @else
                <h1 class="mb-4">Welcome to <span class="text-primary">Travela</span></h1>
                @endif

                @if($about->description1)
                <p class="mb-4">{{ $about->description1 }}</p>
                @else
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, dolorum, doloribus sunt dicta, officia voluptatibus libero necessitatibus natus impedit quam ullam assumenda? Id atque iste consectetur. Commodi odit ab saepe!</p>
                @endif

                @if($about->description2)
                <p class="mb-4">{{ $about->description2 }}</p>
                @else
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium quos voluptatem suscipit neque enim, doloribus ipsum rem eos distinctio, dignissimos nisi saepe nulla? Libero numquam perferendis provident placeat molestiae quia?</p>
                @endif

                <!-- Features List -->
                @if($about->features && count($about->features) > 0)
                <div class="row gy-2 gx-4 mb-4">
                    @foreach($about->features as $index => $feature)
                    @if($feature)
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>{{ $feature }}</p>
                    </div>
                    @endif
                    @endforeach
                </div>
                @else
                <!-- Default features -->
                <div class="row gy-2 gx-4 mb-4">
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>First Class Flights</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Handpicked Hotels</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>5 Star Accommodations</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Latest Model Vehicles</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>150 Premium City Tours</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>24/7 Service</p>
                    </div>
                </div>
                @endif

                <!-- Action Button -->
                @if($about->button_text && $about->button_link)
                <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="{{ $about->button_link }}">
                    {{ $about->button_text }}
                </a>
                @else
                {{-- <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="{{ route('about') }}">Read More</a> --}}
                @endif
            </div>
        </div>
        @empty
        <!-- Default About Section when no data exists -->
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                    <img src="{{ asset('img/about-img.jpg') }}" class="img-fluid w-100 h-100" alt="About Travela">
                </div>
            </div>
            <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                <h5 class="section-about-title pe-3">About Us</h5>
                <h1 class="mb-4">Welcome to <span class="text-primary">Travela</span></h1>
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, dolorum, doloribus sunt dicta, officia voluptatibus libero necessitatibus natus impedit quam ullam assumenda? Id atque iste consectetur. Commodi odit ab saepe!</p>
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium quos voluptatem suscipit neque enim, doloribus ipsum rem eos distinctio, dignissimos nisi saepe nulla? Libero numquam perferendis provident placeat molestiae quia?</p>
                <div class="row gy-2 gx-4 mb-4">
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>First Class Flights</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Handpicked Hotels</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>5 Star Accommodations</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Latest Model Vehicles</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>150 Premium City Tours</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>24/7 Service</p>
                    </div>
                </div>
                <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="{{ route('about') }}">Read More</a>
            </div>
        </div>
        @endforelse
    </div>
</div>
<!-- About End -->


@php
use App\Models\Service;
$services = Service::active()->ordered()->get();
@endphp

<!-- Services Start -->
<div class="container-fluid bg-light service py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Services</h5>
            <h1 class="mb-0">Our Services</h1>
        </div>

        @if($services->count() > 0)
        <div class="row g-4">
            <!-- Left Column Services (Icon on right) -->
            <div class="col-lg-6">
                <div class="row g-4">
                    @foreach($services as $index => $service)
                    @if($index % 2 == 0) {{-- Even indexes go on left --}}
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                            <div class="service-content text-end">
                                <h5 class="mb-4">{{ $service->title }}</h5>
                                <p class="mb-0">{{ $service->description }}</p>
                            </div>
                            <div class="service-icon p-4">
                                <i class="{{ $service->icon }} fa-4x" style="color: {{ $service->icon_color ?: '#13357B' }}"></i>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

            <!-- Right Column Services (Icon on left) -->
            <div class="col-lg-6">
                <div class="row g-4">
                    @foreach($services as $index => $service)
                    @if($index % 2 == 1) {{-- Odd indexes go on right --}}
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                            <div class="service-icon p-4">
                                <i class="{{ $service->icon }} fa-4x" style="color: {{ $service->icon_color ?: '#13357B' }}"></i>
                            </div>
                            <div class="service-content">
                                <h5 class="mb-4">{{ $service->title }}</h5>
                                <p class="mb-0">{{ $service->description }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

            <!-- If odd number of services, handle the last one -->
            @if($services->count() % 2 == 1)
            @php $lastService = $services->last(); @endphp
            <div class="col-12 d-lg-none">
                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4">
                    <div class="service-icon p-4">
                        <i class="{{ $lastService->icon }} fa-4x" style="color: {{ $lastService->icon_color ?: '#13357B' }}"></i>
                    </div>
                    <div class="service-content">
                        <h5 class="mb-4">{{ $lastService->title }}</h5>
                        <p class="mb-0">{{ $lastService->description }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="col-12">
                <div class="text-center">
                    <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="#">View All Services</a>
                </div>
            </div>
        </div>
        @else
        <!-- Default services when no data exists -->
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                            <div class="service-content text-end">
                                <h5 class="mb-4">WorldWide Tours</h5>
                                <p class="mb-0">Dolor sit amet consectetur adipisicing elit. Non alias eum, suscipit expedita corrupti officiis debitis possimus nam laudantium beatae quidem dolore consequuntur voluptate rem reiciendis, omnis sequi harum earum.</p>
                            </div>
                            <div class="service-icon p-4">
                                <i class="fa fa-globe fa-4x text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                            <div class="service-content text-end">
                                <h5 class="mb-4">Hotel Reservation</h5>
                                <p class="mb-0">Dolor sit amet consectetur adipisicing elit. Non alias eum, suscipit expedita corrupti officiis debitis possimus nam laudantium beatae quidem dolore consequuntur voluptate rem reiciendis, omnis sequi harum earum.</p>
                            </div>
                            <div class="service-icon p-4">
                                <i class="fa fa-hotel fa-4x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                            <div class="service-icon p-4">
                                <i class="fa fa-user fa-4x text-primary"></i>
                            </div>
                            <div class="service-content">
                                <h5 class="mb-4">Travel Guides</h5>
                                <p class="mb-0">Dolor sit amet consectetur adipisicing elit. Non alias eum, suscipit expedita corrupti officiis debitis possimus nam laudantium beatae quidem dolore consequuntur voluptate rem reiciendis, omnis sequi harum earum.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                            <div class="service-icon p-4">
                                <i class="fa fa-cog fa-4x text-primary"></i>
                            </div>
                            <div class="service-content">
                                <h5 class="mb-4">Event Management</h5>
                                <p class="mb-0">Dolor sit amet consectetur adipisicing elit. Non alias eum, suscipit expedita corrupti officiis debitis possimus nam laudantium beatae quidem dolore consequuntur voluptate rem reiciendis, omnis sequi harum earum.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="text-center">
                    <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="{{ route('services') }}">View All Services</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Services End -->


@php
use App\Models\Destination;
use App\Models\DestinationCategory;

$categories = DestinationCategory::active()->ordered()->get();
$destinations = Destination::with('category')->active()->ordered()->get();
@endphp

<!-- Destination Start -->
<div class="container-fluid destination py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Destination</h5>
            <h1 class="mb-0">Popular Destination</h1>
        </div>

        @if($categories->count() > 0 && $destinations->count() > 0)
        <div class="tab-class text-center">
            <!-- Category Tabs -->
            <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                <li class="nav-item">
                    <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-all">
                        <span class="text-dark" style="width: 150px;">All</span>
                    </a>
                </li>
                @foreach($categories as $category)
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
                                        <img class="img-fluid rounded w-100" src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->title }}" style="height: 300px; object-fit: cover;">
                                        <div class="destination-overlay p-4">
                                            <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">{{ $destination->photos_count ?? 20 }} Photos</a>
                                            <h4 class="text-white mb-2 mt-3">{{ $destination->title }}</h4>
                                            <a href="{{ $destination->button_link ?: '#' }}" class="btn-hover text-white">
                                                View All Place <i class="fa fa-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                        <div class="search-icon">
                                            <a href="{{ asset('storage/' . $destination->image) }}" data-lightbox="destination-{{ $destination->id }}">
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
                                <img class="img-fluid rounded w-100 h-100" src="{{ asset('storage/' . $allDestinations[1]->first()->image) }}" style="object-fit: cover; min-height: 300px;" alt="{{ $allDestinations[1]->first()->title }}">
                                <div class="destination-overlay p-4">
                                    <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">{{ $allDestinations[1]->first()->photos_count ?? 20 }} Photos</a>
                                    <h4 class="text-white mb-2 mt-3">{{ $allDestinations[1]->first()->title }}</h4>
                                    <a href="{{ $allDestinations[1]->first()->button_link ?: '#' }}" class="btn-hover text-white">
                                        View All Place <i class="fa fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                                <div class="search-icon">
                                    <a href="{{ asset('storage/' . $allDestinations[1]->first()->image) }}" data-lightbox="destination-{{ $allDestinations[1]->first()->id }}">
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
                                    <img class="img-fluid rounded w-100" src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->title }}" style="height: 250px; object-fit: cover;">
                                    <div class="destination-overlay p-4">
                                        <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">{{ $destination->photos_count ?? 20 }} Photos</a>
                                        <h4 class="text-white mb-2 mt-3">{{ $destination->title }}</h4>
                                        <a href="{{ $destination->button_link ?: '#' }}" class="btn-hover text-white">
                                            View All Place <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                    <div class="search-icon">
                                        <a href="{{ asset('storage/' . $destination->image) }}" data-lightbox="destination-{{ $destination->id }}">
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
                                    <img class="img-fluid rounded w-100" src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->title }}" style="height: 250px; object-fit: cover;">
                                    <div class="destination-overlay p-4">
                                        <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">{{ $destination->photos_count ?? 20 }} Photos</a>
                                        <h4 class="text-white mb-2 mt-3">{{ $destination->title }}</h4>
                                        <a href="{{ $destination->button_link ?: '#' }}" class="btn-hover text-white">
                                            View All Place <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                    <div class="search-icon">
                                        <a href="{{ asset('storage/' . $destination->image) }}" data-lightbox="destination-{{ $destination->id }}">
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
                @foreach($categories as $category)
                <div id="tab-{{ $category->slug }}" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        @php
                        $categoryDestinations = $destinations->where('category_id', $category->id);
                        @endphp

                        @if($categoryDestinations->count() > 0)
                        @foreach($categoryDestinations as $destination)
                        <div class="col-lg-6">
                            <div class="destination-img position-relative overflow-hidden rounded">
                                <img class="img-fluid rounded w-100" src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->title }}" style="height: 300px; object-fit: cover;">
                                <div class="destination-overlay p-4">
                                    <a href="#" class="btn btn-primary text-white rounded-pill border py-2 px-3">{{ $destination->photos_count ?? 20 }} Photos</a>
                                    <h4 class="text-white mb-2 mt-3">{{ $destination->title }}</h4>
                                    <a href="{{ $destination->button_link ?: '#' }}" class="btn-hover text-white">
                                        View All Place <i class="fa fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                                <div class="search-icon">
                                    <a href="{{ asset('storage/' . $destination->image) }}" data-lightbox="destination-{{ $destination->id }}">
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


@php
use App\Models\ExploreTour;
use App\Models\TourCategory;

$nationalTours = ExploreTour::with('category')
->whereHas('category', function($query) {
$query->where('type', 'national');
})
->active()
->ordered()
->get();

$internationalTours = ExploreTour::with('category')
->whereHas('category', function($query) {
$query->where('type', 'international');
})
->active()
->ordered()
->get();
@endphp

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



@php
use App\Models\Package;
$packages = Package::active()->ordered()->get();
@endphp

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


<!-- Gallery Start -->
<div class="container-fluid gallery py-5 my-5">
    <div class="mx-auto text-center mb-5" style="max-width: 900px;">
        <h5 class="section-title px-3">Our Gallery</h5>
        <h1 class="mb-4">Tourism & Traveling Gallery.</h1>
        <p class="mb-0">Explore our stunning collection of travel destinations and experiences from around the world. Discover breathtaking landscapes, cultural treasures, and unforgettable adventures.</p>
    </div>

    @php
    $categories = App\Models\GalleryCategory::with(['galleries' => function($query) {
    $query->active()->ordered();
    }])->active()->ordered()->get();
    @endphp

    @if($categories->count() > 0)
    <div class="tab-class text-center">
        <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
            <li class="nav-item">
                <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#GalleryTab-all">
                    <span class="text-dark" style="width: 150px;">All</span>
                </a>
            </li>
            @foreach($categories as $index => $category)
            <li class="nav-item">
                <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#GalleryTab-{{ $category->id }}">
                    <span class="text-dark" style="width: 150px;">{{ $category->name }}</span>
                </a>
            </li>
            @endforeach
        </ul>

        <div class="tab-content">
            <!-- All Tab -->
            <div id="GalleryTab-all" class="tab-pane fade show p-0 active">
                <div class="row g-2">
                    @foreach($categories as $category)
                    @foreach($category->galleries as $gallery)
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                        <div class="gallery-item h-100">
                            <img src="{{ Storage::url($gallery->image) }}" class="img-fluid w-100 h-100 rounded" alt="{{ $gallery->title }}" style="object-fit: cover;">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">{{ $category->name }}</h5>
                                    <p class="text-white mb-2 small">{{ $gallery->title }}</p>
                                    @if($gallery->button_text && $gallery->button_link)
                                    <a href="{{ $gallery->button_link }}" class="btn-hover text-white">
                                        {{ $gallery->button_text }} <i class="fa fa-arrow-right ms-2"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ Storage::url($gallery->image) }}" data-lightbox="gallery-all" class="my-auto">
                                    <i class="fas fa-plus fa-2x text-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>

            <!-- Category Tabs -->
            @foreach($categories as $category)
            <div id="GalleryTab-{{ $category->id }}" class="tab-pane fade show p-0">
                <div class="row g-2">
                    @foreach($category->galleries as $gallery)
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                        <div class="gallery-item h-100">
                            <img src="{{ Storage::url($gallery->image) }}" class="img-fluid w-100 h-100 rounded" alt="{{ $gallery->title }}" style="object-fit: cover;">
                            <div class="gallery-content">
                                <div class="gallery-info">
                                    <h5 class="text-white text-uppercase mb-2">{{ $category->name }}</h5>
                                    <p class="text-white mb-2 small">{{ $gallery->title }}</p>
                                    @if($gallery->button_text && $gallery->button_link)
                                    <a href="{{ $gallery->button_link }}" class="btn-hover text-white">
                                        {{ $gallery->button_text }} <i class="fa fa-arrow-right ms-2"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="gallery-plus-icon">
                                <a href="{{ Storage::url($gallery->image) }}" data-lightbox="gallery-{{ $category->id }}" class="my-auto">
                                    <i class="fas fa-plus fa-2x text-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="text-center py-5">
        <p class="text-muted">No gallery categories available at the moment.</p>
    </div>
    @endif
</div>
<!-- Gallery End -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize lightbox
        if (typeof lightbox !== 'undefined') {
            lightbox.option({
                'resizeDuration': 200
                , 'wrapAround': true
                , 'imageFadeDuration': 300
                , 'positionFromTop': 50
            });
        }

        // Smooth tab transitions
        const galleryTabs = document.querySelectorAll('.nav-pills .nav-link');
        galleryTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                galleryTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Lazy loading for images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    });

</script>



<!-- Tour Booking Start -->
<div class="container-fluid booking py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h5 class="section-booking-title pe-3">Booking</h5>
                <h1 class="text-white mb-4">Online Booking</h1>
                <p class="text-white mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur maxime ullam esse fuga blanditiis accusantium pariatur quis sapiente, veniam doloribus praesentium? Repudiandae iste voluptatem fugiat doloribus quasi quo iure officia.
                </p>
                <p class="text-white mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur maxime ullam esse fuga blanditiis accusantium pariatur quis sapiente, veniam doloribus praesentium? Repudiandae iste voluptatem fugiat doloribus quasi quo iure officia.
                </p>
                <a href="#" class="btn btn-light text-primary rounded-pill py-3 px-5 mt-2">Read More</a>
            </div>
            <div class="col-lg-6">
                <h1 class="text-white mb-3">Book A Tour Deals</h1>
                <p class="text-white mb-4">Get <span class="text-warning">50% Off</span> On Your First Adventure Trip With Travela. Get More Deal Offers Here.</p>
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control bg-white border-0" id="name" placeholder="Your Name">
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control bg-white border-0" id="email" placeholder="Your Email">
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating date" id="date3" data-target-input="nearest">
                                <input type="text" class="form-control bg-white border-0" id="datetime" placeholder="Date & Time" data-target="#date3" data-toggle="datetimepicker" />
                                <label for="datetime">Date & Time</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="select1">
                                    <option value="1">Destination 1</option>
                                    <option value="2">Destination 2</option>
                                    <option value="3">Destination 3</option>
                                </select>
                                <label for="select1">Destination</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="SelectPerson">
                                    <option value="1">Persons 1</option>
                                    <option value="2">Persons 2</option>
                                    <option value="3">Persons 3</option>
                                </select>
                                <label for="SelectPerson">Persons</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="CategoriesSelect">
                                    <option value="1">Kids</option>
                                    <option value="2">1</option>
                                    <option value="3">2</option>
                                    <option value="3">3</option>
                                </select>
                                <label for="CategoriesSelect">Categories</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control bg-white border-0" placeholder="Special Request" id="message" style="height: 100px"></textarea>
                                <label for="message">Special Request</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary text-white w-100 py-3" type="submit">Book Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Tour Booking End -->
<!-- Travel Guide Start -->
<div class="container-fluid guide py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Travel Guide</h5>
            <h1 class="mb-0">Meet Our Guide</h1>
        </div>

        @php
        $guides = App\Models\TravelGuide::active()->ordered()->get();
        @endphp

        <div class="row g-4">
            @foreach($guides as $guide)
            <div class="col-md-6 col-lg-3">
                <div class="guide-item">
                    <div class="guide-img">
                        <div class="guide-img-efects">
                            <img src="{{ Storage::url($guide->image) }}" class="img-fluid w-100 rounded-top" alt="{{ $guide->name }}" style="height: 300px; object-fit: cover;">
                        </div>
                        <div class="guide-icon rounded-pill p-2">
                            @if($guide->facebook_url)
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href="{{ $guide->facebook_url }}" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            @endif
                            @if($guide->twitter_url)
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href="{{ $guide->twitter_url }}" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                            @endif
                            @if($guide->instagram_url)
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href="{{ $guide->instagram_url }}" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            @endif
                            @if($guide->linkedin_url)
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href="{{ $guide->linkedin_url }}" target="_blank">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="guide-title text-center rounded-bottom p-4">
                        <div class="guide-title-inner">
                            <h4 class="mt-3">{{ $guide->name }}</h4>
                            <p class="mb-0">{{ $guide->designation }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Show empty state if no guides --}}
            @if($guides->count() == 0)
            <div class="col-12 text-center py-5">
                <p class="text-muted">No travel guides available at the moment.</p>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Travel Guide End -->

<!-- Blog Start -->
<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Our Blog</h5>
            <h1 class="mb-4">Popular Travel Blogs</h1>
            <p class="mb-0">Discover amazing travel stories, tips, and guides from our experienced travelers. Get inspired for your next adventure with our latest blog posts.</p>
        </div>

        @php
        $blogs = App\Models\Blog::with('category')
        ->active()
        ->where('status', 'published')
        ->ordered()
        ->take(3)
        ->get();
        @endphp

        <div class="row g-4 justify-content-center">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <div class="blog-img">
                        <div class="blog-img-inner">
                            <img class="img-fluid w-100 rounded-top" src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" style="height: 250px; object-fit: cover;">
                            <div class="blog-icon">
                                <a href="{{ $blog->read_more_link ?: '#' }}" class="my-auto">
                                    <i class="fas fa-link fa-2x text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="blog-info d-flex align-items-center border border-start-0 border-end-0">
                            <small class="flex-fill text-center border-end py-2">
                                <i class="fa fa-calendar-alt text-primary me-2"></i>
                                {{ \Carbon\Carbon::parse($blog->published_date)->format('d M Y') }}
                            </small>
                            <a href="#" class="btn-hover flex-fill text-center text-white border-end py-2">
                                <i class="fa fa-thumbs-up text-primary me-2"></i>{{ $blog->likes_count ?: 0 }}
                            </a>
                            <a href="#" class="btn-hover flex-fill text-center text-white py-2">
                                <i class="fa fa-comments text-primary me-2"></i>{{ $blog->comments_count ?: 0 }}
                            </a>
                        </div>
                    </div>
                    <div class="blog-content border border-top-0 rounded-bottom p-4">
                        <p class="mb-3">Posted By: {{ $blog->author_name }}</p>
                        <a href="{{ $blog->read_more_link ?: '#' }}" class="h4">{{ $blog->title }}</a>
                        <p class="my-3">{{ $blog->excerpt }}</p>
                        <a href="{{ $blog->read_more_link ?: '#' }}" class="btn btn-primary rounded-pill py-2 px-4">
                            {{ $blog->read_more_text ?: 'Read More' }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Show empty state if no blogs --}}
            @if($blogs->count() == 0)
            <div class="col-12 text-center py-5">
                <div class="blog-item">
                    <div class="blog-content border rounded p-5">
                        <h4 class="text-muted">No blog posts available</h4>
                        <p class="text-muted">Check back later for new travel stories and guides.</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Blog End -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth hover effects
        const blogItems = document.querySelectorAll('.blog-item');

        blogItems.forEach(item => {
            // Ensure consistent image height
            const blogImg = item.querySelector('.blog-img-inner img');
            if (blogImg) {
                blogImg.style.height = '250px';
                blogImg.style.objectFit = 'cover';
            }
        });

        // Like and comment button interactions
        const interactionButtons = document.querySelectorAll('.btn-hover');
        interactionButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                // Add your like/comment functionality here
                console.log('Interaction button clicked');
            });
        });
    });

</script>


<!-- Testimonial Start -->
<div class="container-fluid testimonial py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Testimonial</h5>
            <h1 class="mb-0">Our Clients Say!!!</h1>
        </div>
        <div class="testimonial-carousel owl-carousel">
            <div class="testimonial-item text-center rounded pb-4">
                <div class="testimonial-comment bg-light rounded p-4">
                    <p class="text-center mb-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis nostrum cupiditate, eligendi repellendus saepe illum earum architecto dicta quisquam quasi porro officiis. Vero reiciendis,
                    </p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="img/testimonial-1.jpg" class="img-fluid rounded-circle" alt="Image">
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
                    <p class="text-center mb-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis nostrum cupiditate, eligendi repellendus saepe illum earum architecto dicta quisquam quasi porro officiis. Vero reiciendis,
                    </p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="img/testimonial-2.jpg" class="img-fluid rounded-circle" alt="Image">
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
                    <p class="text-center mb-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis nostrum cupiditate, eligendi repellendus saepe illum earum architecto dicta quisquam quasi porro officiis. Vero reiciendis,
                    </p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="img/testimonial-3.jpg" class="img-fluid rounded-circle" alt="Image">
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
                    <p class="text-center mb-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis nostrum cupiditate, eligendi repellendus saepe illum earum architecto dicta quisquam quasi porro officiis. Vero reiciendis,
                    </p>
                </div>
                <div class="testimonial-img p-1">
                    <img src="img/testimonial-4.jpg" class="img-fluid rounded-circle" alt="Image">
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
        </div>
    </div>
</div>
<!-- Testimonial End -->

<!-- Subscribe Start -->
<div class="container-fluid subscribe py-5">
    <div class="container text-center py-5">
        <div class="mx-auto text-center" style="max-width: 900px;">
            <h5 class="subscribe-title px-3">Subscribe</h5>
            <h1 class="text-white mb-4">Our Newsletter</h1>
            <p class="text-white mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum tempore nam, architecto doloremque velit explicabo? Voluptate sunt eveniet fuga eligendi! Expedita laudantium fugiat corrupti eum cum repellat a laborum quasi.
            </p>
            <div class="position-relative mx-auto">
                <input class="form-control border-primary rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                <button type="button" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2">Subscribe</button>
            </div>
        </div>
    </div>
</div>
<!-- Subscribe End -->


@endsection

@push('scripts')
<script>
    // Additional page-specific scripts can go here
    $(document).ready(function() {
        console.log('Home page loaded');
    });

</script>
@endpush
