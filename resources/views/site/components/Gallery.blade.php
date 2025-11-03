<!-- Gallery Start -->
<div class="container-fluid gallery py-5 my-5">
    <div class="mx-auto text-center mb-5" style="max-width: 900px;">
        <h5 class="section-title px-3">Our Gallery</h5>
        <h1 class="mb-4">Tourism & Traveling Gallery.</h1>
        <p class="mb-0">Explore our stunning collection of travel destinations and experiences from around the world. Discover breathtaking landscapes, cultural treasures, and unforgettable adventures.</p>
    </div>

    @if($galleryCategories->count() > 0) {{-- Changed from $categories to $galleryCategories --}}
    <div class="tab-class text-center">
        <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
            <li class="nav-item">
                <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#GalleryTab-all">
                    <span class="text-dark" style="width: 150px;">All</span>
                </a>
            </li>
            @foreach($galleryCategories as $index => $category) {{-- Changed from $categories to $galleryCategories --}}
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
                    @foreach($galleryCategories as $category) {{-- Changed from $categories to $galleryCategories --}}
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
            @foreach($galleryCategories as $category) {{-- Changed from $categories to $galleryCategories --}}
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
