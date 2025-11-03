<!-- Travel Guide Start -->
<div class="container-fluid guide py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Travel Guide</h5>
            <h1 class="mb-0">Meet Our Guide</h1>
        </div>


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

