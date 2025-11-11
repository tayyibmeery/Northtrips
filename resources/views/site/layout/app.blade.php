<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'North Trips & Travel')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" type="image/png" href="{{ asset('images/CompanySetting/' . $setting->logo) }}" class="rounded-circle">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        :root {
            --breadcrumb-bg-image: url({{ $setting->breadcrumb_image ? Storage::url($setting->breadcrumb_image) : asset('img/breadcrumb-bg.jpg') }});
        }

        /* Loading overlay */
        .page-loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .page-loading.active {
            display: flex;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Loading Overlay -->
    <div class="page-loading">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    @include('site.layout.topbar')

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        @include('site.layout.navbar')
        @if(isset($carousels))
        <div id="carousel-container">
            @include('site.layout.carousel')
        </div>
        @else
        <div id="carousel-container" style="display: none;"></div>
        @endif
    </div>

    <main id="main-content">
        @yield('content')
    </main>

    @include('site.layout.footer')

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- AJAX Navigation Script -->
    <script>
        $(document).ready(function() {
            const homeUrls = ['/', '/home', '{{ route("home") }}'];

            // Initialize on page load
            const currentPath = window.location.pathname;
            if (!homeUrls.includes(currentPath)) {
                $('#carousel-container').hide();
            }
            updateActiveNavState(window.location.href);

            // Handle navigation clicks
            $(document).on('click', 'a.nav-link, a.dropdown-item, a.navbar-brand', function(e) {
                // Skip if it's a dropdown toggle
                if ($(this).hasClass('dropdown-toggle')) {
                    return;
                }

                const href = $(this).attr('href');

                // Check if it's an internal link
                if (!href || href === '#' || href.startsWith('http') && !href.includes(window.location.host)) {
                    return;
                }

                e.preventDefault();
                loadPage(href);
            });

            // Handle browser back/forward
            window.addEventListener('popstate', function(e) {
                if (e.state && e.state.url) {
                    loadPage(e.state.url, false);
                } else {
                    // Fallback: reload the page
                    window.location.reload();
                }
            });

            // Main page loading function
            function loadPage(url, pushState = true) {
                // Show loading
                $('.page-loading').addClass('active');

                // Scroll to top
                $('html, body').animate({ scrollTop: 0 }, 300);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update page title
                            document.title = response.title;

                            // Update main content
                            $('#main-content').html(response.content);

                            // Handle carousel visibility
                            if (response.show_carousel) {
                                $('#carousel-container').show();
                                initializeCarousel();
                            } else {
                                $('#carousel-container').hide();
                            }

                            // Update active nav state
                            updateActiveNavState(url);

                            // Update browser history
                            if (pushState) {
                                history.pushState({url: url}, response.title, url);
                            }

                            // Reinitialize components
                            initializePageComponents();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading page:', error);

                        // On error, do a full page load
                        window.location.href = url;
                    },
                    complete: function() {
                        // Hide loading
                        $('.page-loading').removeClass('active');
                    }
                });
            }

            // Initialize carousel
            function initializeCarousel() {
                if ($('#carouselId').length) {
                    // Destroy existing carousel
                    const existingCarousel = bootstrap.Carousel.getInstance('#carouselId');
                    if (existingCarousel) {
                        existingCarousel.dispose();
                    }

                    // Create new carousel
                    new bootstrap.Carousel('#carouselId', {
                        interval: 5000,
                        wrap: true
                    });
                }
            }

            // Initialize page components
            function initializePageComponents() {
                // Reinitialize owl carousels
                if ($.fn.owlCarousel) {
                    $('.owl-carousel').each(function() {
                        const owl = $(this);

                        // Destroy existing carousel
                        if (owl.hasClass('owl-loaded')) {
                            owl.trigger('destroy.owl.carousel');
                            owl.removeClass('owl-loaded');
                        }

                        // Reinitialize based on class
                        if (owl.hasClass('testimonial-carousel')) {
                            owl.owlCarousel({
                                loop: true,
                                margin: 30,
                                nav: false,
                                dots: true,
                                autoplay: true,
                                autoplayTimeout: 5000,
                                responsive: {
                                    0: { items: 1 },
                                    768: { items: 2 },
                                    992: { items: 3 }
                                }
                            });
                        } else if (owl.hasClass('packages-carousel')) {
                            owl.owlCarousel({
                                loop: true,
                                margin: 20,
                                nav: true,
                                dots: false,
                                autoplay: true,
                                autoplayTimeout: 5000,
                                responsive: {
                                    0: { items: 1 },
                                    768: { items: 2 },
                                    992: { items: 3 }
                                }
                            });
                        } else if (owl.hasClass('InternationalTour-carousel')) {
                            owl.owlCarousel({
                                loop: true,
                                margin: 20,
                                nav: true,
                                dots: false,
                                autoplay: true,
                                autoplayTimeout: 5000,
                                responsive: {
                                    0: { items: 1 },
                                    768: { items: 2 },
                                    992: { items: 3 }
                                }
                            });
                        }
                    });
                }

                // Reinitialize lightbox
                if (typeof lightbox !== 'undefined') {
                    lightbox.option({
                        'resizeDuration': 200,
                        'wrapAround': true
                    });
                }

                // Reinitialize Bootstrap tabs
                const triggerTabList = [].slice.call(document.querySelectorAll('[data-bs-toggle="pill"]'));
                triggerTabList.forEach(function (triggerEl) {
                    new bootstrap.Tab(triggerEl);
                });
            }

            // Update active navigation state
            function updateActiveNavState(url) {
                $('.nav-link, .dropdown-item').removeClass('active');

                const path = url.split('?')[0];

                // Check if home page
                if (homeUrls.some(homeUrl => path === homeUrl || path.endsWith(homeUrl))) {
                    $('a.nav-link[href="{{ route("home") }}"]').addClass('active');
                    return;
                }

                // Find matching nav item
                const matchingLink = $('a.nav-link[href="' + path + '"], a.dropdown-item[href="' + path + '"]');
                if (matchingLink.length) {
                    matchingLink.addClass('active');
                    if (matchingLink.hasClass('dropdown-item')) {
                        matchingLink.closest('.dropdown').find('.dropdown-toggle').addClass('active');
                    }
                }
            }

            // Set initial state
            if (window.history.state === null) {
                history.replaceState({url: window.location.href}, document.title, window.location.href);
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
