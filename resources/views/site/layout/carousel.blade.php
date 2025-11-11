<!-- Carousel Start -->
@if(isset($carousels) && $carousels->count() > 0)
<div class="carousel-header">
    <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        @if($carousels->count() > 1)
        <ol class="carousel-indicators">
            @foreach($carousels as $key => $carousel)
            <li data-bs-target="#carouselId" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>
        @endif

        <div class="carousel-inner" role="listbox">
            @foreach($carousels as $key => $carousel)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                @if($carousel->image)
                <img src="{{ asset('images/carousels/' . $carousel->image) }}" class="img-fluid w-100" alt="{{ $carousel->title }}" style="max-height: 800px; object-fit: cover;">
                @else
                <div class="bg-primary d-flex align-items-center justify-content-center" style="height: 600px;">
                    <div class="text-white text-center">
                        <i class="fas fa-image fa-5x mb-3"></i>
                        <h3>No Image Available</h3>
                    </div>
                </div>
                @endif

                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        @if($carousel->heading)
                        <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">{{ $carousel->heading }}</h4>
                        @endif

                        @if($carousel->title)
                        <h1 class="display-2 text-capitalize text-white mb-4">{{ $carousel->title }}</h1>
                        @endif

                        @if($carousel->description)
                        <p class="mb-5 fs-5">{{ $carousel->description }}</p>
                        @endif

                        @if($carousel->button_text && $carousel->button_link)
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="{{ $carousel->button_link }}">
                                {{ $carousel->button_text }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($carousels->count() > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="false"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon btn bg-primary" aria-hidden="false"></span>
            <span class="visually-hidden">Next</span>
        </button>
        @endif
    </div>
</div>
@endif
<!-- Carousel End -->
