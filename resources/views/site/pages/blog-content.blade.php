<!-- Breadcrumb Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Our Blog</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active text-white">Blog</li>
        </ol>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Blog Start -->
<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Our Blog</h5>
            <h1 class="mb-4">Latest Travel Stories & Tips</h1>
            <p class="mb-0">Discover amazing travel stories, tips, and guides from our experienced travelers. Get inspired for your next adventure with our latest blog posts.</p>
        </div>

        @if($blogs->count() > 0)
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
        </div>

        <!-- Pagination -->
        @if($blogs->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
        @endif
        @else
        <!-- Empty State -->
        <div class="row">
            <div class="col-12 text-center py-5">
                <div class="blog-item">
                    <div class="blog-content border rounded p-5">
                        <i class="fas fa-blog fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No blog posts available</h4>
                        <p class="text-muted">Check back later for new travel stories and guides.</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!-- Blog End -->

<!-- Subscribe Section -->
@include('site.components.Subscribe')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth hover effects
        const blogItems = document.querySelectorAll('.blog-item');

        blogItems.forEach(item => {
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
                if (this.getAttribute('href') === '#') {
                    e.preventDefault();
                    console.log('Interaction button clicked');
                }
            });
        });
    });
</script>
