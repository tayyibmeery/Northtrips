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
                <h1 class="mb-4">Welcome to <span class="text-primary">North Trips & Travel</span></h1>
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
                    <img src="{{ asset('img/about-img.jpg') }}" class="img-fluid w-100 h-100" alt="About North Trips & Travel">
                </div>
            </div>
            <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                <h5 class="section-about-title pe-3">About Us</h5>
                <h1 class="mb-4">Welcome to <span class="text-primary">North Trips & Travel</span></h1>
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
