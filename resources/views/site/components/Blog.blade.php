<!-- Blog Start -->
<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Our Blog</h5>
            <h1 class="mb-4">Popular Travel Blogs</h1>
            <p class="mb-0">Discover amazing travel stories, tips, and guides from our experienced travelers. Get inspired for your next adventure with our latest blog posts.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="blog-item">
                    <div class="blog-img">
                        <div class="blog-img-inner">
                            <img class="img-fluid w-100 rounded-top" src="{{ asset('images/blogs/' . $blog->image) }}" alt="{{ $blog->title }}" style="height: 250px; object-fit: cover;">
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

@push('scripts')
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
@endpush
