<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="North Trips & Travel Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">North Trips & Travel Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Bookings Section -->
            <!-- In your sidebar, update the bookings section -->
<li class="nav-item {{ request()->routeIs('admin.bookings.*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-calendar-check"></i>
        <p>
            Bookings
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ request()->routeIs('admin.bookings.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Bookings</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.bookings.statistics') }}" class="nav-link {{ request()->routeIs('admin.bookings.statistics') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Statistics</p>
            </a>
        </li>
    </ul>
</li>
                <!-- Settings Section -->
                <li class="nav-header">SETTINGS</li>
                <li class="nav-item">
                    <a href="{{ route('admin.company-settings.edit') }}" class="nav-link {{ request()->routeIs('admin.company-settings.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Company Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.social-media-links.index') }}" class="nav-link {{ request()->routeIs('admin.social-media-links.*') ? 'active' : '' }}">
                        <i class="nav-icon fab fa-share-alt"></i>
                        <p>Social Media</p>
                    </a>
                </li>

                <!-- Homepage Section -->
                <li class="nav-header">HOMEPAGE</li>
                <li class="nav-item">
                    <a href="{{ route('admin.carousels.index') }}" class="nav-link {{ request()->routeIs('admin.carousels.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-images"></i>
                        <p>Carousel</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.about-sections.index') }}" class="nav-link {{ request()->routeIs('admin.about-sections.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>About Sections</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-concierge-bell"></i>
                        <p>Services</p>
                    </a>
                </li>

                <!-- Destinations Section -->
                <li class="nav-header">DESTINATIONS</li>
                <li class="nav-item {{ request()->routeIs('admin.destination-categories.*') || request()->routeIs('admin.destinations.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.destination-categories.*') || request()->routeIs('admin.destinations.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>
                            Destinations
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.destination-categories.index') }}" class="nav-link {{ request()->routeIs('admin.destination-categories.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.destinations.index') }}" class="nav-link {{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Destinations</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Tours Section -->
                <li class="nav-header">TOURS</li>
                <li class="nav-item {{ request()->routeIs('admin.tour-categories.*') || request()->routeIs('admin.explore-tours.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.tour-categories.*') || request()->routeIs('admin.explore-tours.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-suitcase"></i>
                        <p>
                            Explore Tours
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.tour-categories.index') }}" class="nav-link {{ request()->routeIs('admin.tour-categories.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tour Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.explore-tours.index') }}" class="nav-link {{ request()->routeIs('admin.explore-tours.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Explore Tours</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.packages.index') }}" class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-gift"></i>
                        <p>Packages</p>
                    </a>
                </li>

                <!-- Gallery Section -->
                <li class="nav-header">GALLERY</li>
                <li class="nav-item {{ request()->routeIs('admin.gallery-categories.*') || request()->routeIs('admin.galleries.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.gallery-categories.*') || request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Gallery
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.gallery-categories.index') }}" class="nav-link {{ request()->routeIs('admin.gallery-categories.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.galleries.index') }}" class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gallery Items</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Content Section -->
                <li class="nav-header">CONTENT</li>
                <li class="nav-item">
                    <a href="{{ route('admin.travel-guides.index') }}" class="nav-link {{ request()->routeIs('admin.travel-guides.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Travel Guides</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.blog-categories.*') || request()->routeIs('admin.blogs.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.blog-categories.*') || request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>
                            Blog
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.blog-categories.index') }}" class="nav-link {{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blog Posts</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>Testimonials</p>
                    </a>
                </li>

                <!-- Subscribers -->
                <li class="nav-header">NEWSLETTER</li>
                <li class="nav-item">
                    <a href="{{ route('admin.subscribers.index') }}" class="nav-link {{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Subscribers</p>
                    </a>
                </li>

                <!-- User Profile -->
                <li class="nav-header">ACCOUNT</li>
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>