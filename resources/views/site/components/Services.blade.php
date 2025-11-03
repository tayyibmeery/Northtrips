
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
