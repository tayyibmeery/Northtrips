@extends('site.layout.app')

@section('title', 'Packages - ' . ($setting->company_name ?? 'North Trips & Travel'))

@section('content')
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Our Packages</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active text-white">Packages</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<!-- Packages Start -->
<div class="container-fluid packages py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Packages</h5>
            <h1 class="mb-0">Awesome Packages</h1>
        </div>

        @if($packages->count() > 0)
        <div class="row g-4">
            @foreach($packages as $package)
            <div class="col-lg-4 col-md-6">
                <div class="packages-item">
                    <div class="packages-img position-relative">
                        <img src="{{ asset('images/packages/' . $package->image) }}" class="img-fluid w-100 rounded-top" alt="{{ $package->title }}" style="height: 250px; object-fit: cover;">
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
                                @if($package->rating)
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($package->rating))
                                            <small class="fa fa-star text-primary"></small>
                                        @elseif($i - 0.5 <= $package->rating)
                                            <small class="fa fa-star-half-alt text-primary"></small>
                                        @else
                                            <small class="far fa-star text-primary"></small>
                                        @endif
                                    @endfor
                                    <small class="ms-1">({{ number_format($package->rating, 1) }})</small>
                                @else
                                    <small class="text-muted">No rating</small>
                                @endif
                            </div>
                            <p class="mb-4">{{ Str::limit($package->description, 120) }}</p>
                        </div>
                        <div class="row bg-primary rounded-bottom mx-0">
                            <div class="col-6 text-start px-0">
                                @if($package->read_more_link)
                                <a href="{{ $package->read_more_link }}" class="btn-hover btn text-white py-2 px-4">
                                    {{ $package->read_more_text ?: 'Read More' }}
                                </a>
                                @else
                                <button class="btn-hover btn text-white py-2 px-4" onclick="showPackageDetails({{ $package->id }})">
                                    {{ $package->read_more_text ?: 'Read More' }}
                                </button>
                                @endif
                            </div>
                            <div class="col-6 text-end px-0">
                                @if($package->book_now_link)
                                <a href="{{ $package->book_now_link }}" class="btn-hover btn text-white py-2 px-4">
                                    {{ $package->book_now_text ?: 'Book Now' }}
                                </a>
                                @else
                                <a href="{{ route('booking') }}" class="btn-hover btn text-white py-2 px-4">
                                    {{ $package->book_now_text ?: 'Book Now' }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <div class="text-muted">
                <i class="fas fa-box-open fa-4x mb-3"></i>
                <h4>No Packages Available</h4>
                <p>Check back later for amazing tour packages!</p>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Packages End -->
@endsection

@push('scripts')
<script>
function showPackageDetails(packageId) {
    alert('Package details coming soon! Package ID: ' + packageId);
    // You can implement a modal or redirect to a details page here
}
</script>
@endpush
