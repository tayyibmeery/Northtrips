<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'North Trips & Travel')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" type="image/png" href="{{ Storage::url($setting->logo) }}" class="rounded-circle">
    <!-- CSRF Token -->
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
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Dynamic Breadcrumb CSS Variable -->
    <style>
        :root {
            --breadcrumb-bg-image: url({{ $setting->breadcrumb_image ? Storage::url($setting->breadcrumb_image) : asset('img/breadcrumb-bg.jpg') }});
        }
    </style>

    <!-- Additional Styles -->
    @stack('styles')
</head>

<body>
    @include('site.layout.topbar')
    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        @include('site.layout.navbar')
        <div id="carousel-container">
            @include('site.layout.carousel')
        </div>
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

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- AJAX Navigation Script -->
    <script>
        $(document).ready(function() {
            // Handle navigation clicks
            $(document).on('click', 'a.nav-link, a.dropdown-item', function(e) {
                // Don't prevent default if it's a dropdown toggle
                if ($(this).hasClass('dropdown-toggle')) {
                    return;
                }

                e.preventDefault();

                const url = $(this).attr('href');
                const linkText = $(this).text().trim();

                // Update active state in navbar
                $('.nav-link').removeClass('active');
                $(this).closest('.nav-link').addClass('active');

                // Load content via AJAX
                loadPage(url);
            });

            // Handle home logo/brand click
            $(document).on('click', '.navbar-brand', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');

                $('.nav-link').removeClass('active');
                $('a[href="' + url + '"]').addClass('active');

                loadPage(url);
            });

            // Handle browser back/forward buttons
            window.addEventListener('popstate', function(e) {
                if (e.state && e.state.url) {
                    loadPage(e.state.url, false);
                }
            });

            function loadPage(url, pushState = true) {
                // Show loading indicator
                $('#main-content').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Loading...</p></div>');

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        // Update page title
                        document.title = response.title;

                        // Update main content
                        $('#main-content').html(response.content);

                        // Show/hide carousel based on page
                        if (url === '/' || url === '/home' || url === '{{ route("home") }}') {
                            $('#carousel-container').show();
                            // Reinitialize carousel for home page
                            initializeCarousel();
                        } else {
                            $('#carousel-container').hide();
                        }

                        // Update active nav state based on current URL
                        updateActiveNavState(url);

                        // Update browser history
                        if (pushState) {
                            history.pushState({url: url}, response.title, url);
                        }

                        // Reinitialize any components that need it
                        initializePageComponents();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading page:', error);
                        $('#main-content').html(
                            '<div class="alert alert-danger text-center mt-5">Error loading page. <a href="' + url + '" class="alert-link">Please try again</a> or <a href="{{ route("home") }}" class="alert-link">return to home</a>.</div>'
                        );
                    }
                });
            }

            function initializeCarousel() {
                if ($('#carouselId').length) {
                    // Reinitialize the carousel
                    const carousel = new bootstrap.Carousel('#carouselId');

                    // Restart auto-cycling if it was enabled
                    $('#carouselId').carousel('cycle');
                }
            }

            function initializePageComponents() {
                // Reinitialize carousel if it exists
                if ($('#carouselId').length) {
                    initializeCarousel();
                }

                // Reinitialize lightbox
                if (typeof lightbox !== 'undefined') {
                    lightbox.option({
                        'resizeDuration': 200,
                        'wrapAround': true
                    });
                }

                // Reinitialize owl carousels
                if ($.fn.owlCarousel && $('.owl-carousel').length) {
                    $('.owl-carousel').owlCarousel();
                }
            }

            function updateActiveNavState(url) {
                // Remove active class from all nav items
                $('.nav-link, .dropdown-item').removeClass('active');

                // Add active class to current page nav item
                const path = url.split('?')[0]; // Remove query parameters

                // Exact match for home
                if (path === '/' || path === '/home' || path === '{{ route("home") }}') {
                    $('a.nav-link[href="{{ route("home") }}"]').addClass('active');
                    return;
                }

                // Try to find exact match first
                const exactMatch = $('a.nav-link[href="' + path + '"], a.dropdown-item[href="' + path + '"]');
                if (exactMatch.length) {
                    exactMatch.addClass('active');
                    // If it's a dropdown item, also activate its parent dropdown
                    if (exactMatch.hasClass('dropdown-item')) {
                        exactMatch.closest('.dropdown').find('.dropdown-toggle').addClass('active');
                    }
                    return;
                }

                // Fallback: check if URL contains any of the route paths
                const routes = [
                    'about', 'services', 'packages', 'blog', 'destination',
                    'tour', 'booking', 'gallery', 'guides', 'testimonial', 'contact'
                ];

                for (const route of routes) {
                    if (path.includes(route)) {
                        const navItem = $('a.nav-link[href*="' + route + '"], a.dropdown-item[href*="' + route + '"]');
                        if (navItem.length) {
                            navItem.addClass('active');
                            if (navItem.hasClass('dropdown-item')) {
                                navItem.closest('.dropdown').find('.dropdown-toggle').addClass('active');
                            }
                        }
                        break;
                    }
                }
            }

            // Initial page load handling
            const currentPath = window.location.pathname;
            if (currentPath !== '/' && currentPath !== '/home') {
                $('#carousel-container').hide();
            }

            // Set initial active nav state
            updateActiveNavState(window.location.href);
        });
    </script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>