<nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <a href="{{ route('home') }}" class="navbar-brand rounded-circle p-0">
        <img src="{{ Storage::url($setting->logo) }}" alt="{{ $setting->company_name }}" class="rounded-circle" style="height: 50px; width: 50px; object-fit: cover;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('services') }}" class="nav-item nav-link {{ request()->is('services') ? 'active' : '' }}">Services</a>
            <a href="{{ route('packages') }}" class="nav-item nav-link {{ request()->is('packages') ? 'active' : '' }}">Packages</a>
            <a href="{{ route('blog') }}" class="nav-item nav-link {{ request()->is('blog') ? 'active' : '' }}">Blog</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ request()->is('destination', 'tour', 'booking', 'gallery', 'guides', 'testimonial') ? 'active' : '' }}" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu m-0">
                    <a href="{{ route('destination') }}" class="dropdown-item {{ request()->is('destination') ? 'active' : '' }}">Destination</a>
                    <a href="{{ route('tour') }}" class="dropdown-item {{ request()->is('tour') ? 'active' : '' }}">Explore Tour</a>
                    <a href="{{ route('booking') }}" class="dropdown-item {{ request()->is('booking') ? 'active' : '' }}">Travel Booking</a>
                    <a href="{{ route('gallery') }}" class="dropdown-item {{ request()->is('gallery') ? 'active' : '' }}">Our Gallery</a>
                    <a href="{{ route('guides') }}" class="dropdown-item {{ request()->is('guides') ? 'active' : '' }}">Travel Guides</a>
                    <a href="{{ route('testimonial') }}" class="dropdown-item {{ request()->is('testimonial') ? 'active' : '' }}">Testimonial</a>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
        </div>
        <a href="{{ route('booking') }}" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Book Now</a>
    </div>
</nav>