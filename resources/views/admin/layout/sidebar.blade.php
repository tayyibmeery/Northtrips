<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        @php
            $companySettings = \App\Models\CompanySetting::first();
            $logoPath = $companySettings && $companySettings->logo ? asset('images/CompanySetting/' . $companySettings->logo) : asset('admin/dist/img/AdminLTELogo.png');
            $companyName = $companySettings && $companySettings->company_name ? $companySettings->company_name : 'North Trips & Travel';
        @endphp
        <img src="{{ $logoPath }}" alt="{{ $companyName }} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $companyName }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                <small class="text-success"><i class="fas fa-circle text-success"></i> Online</small>
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

                <!-- Company Settings - Moved to top -->
                <li class="nav-header">COMPANY SETTINGS</li>
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

                <!-- ITINERARY MANAGEMENT -->
                <li class="nav-header">ITINERARY MANAGEMENT</li>

                <!-- Itinerary Components -->
                <li class="nav-item {{
                    request()->routeIs('admin.included-services.*') ||
                    request()->routeIs('admin.excluded-services.*') ||
                    request()->routeIs('admin.experience-highlights.*') ||
                    request()->routeIs('admin.important-information.*') ||
                    request()->routeIs('admin.quick-facts.*') ? 'menu-open' : ''
                }}">
                    <a href="#" class="nav-link {{
                        request()->routeIs('admin.included-services.*') ||
                        request()->routeIs('admin.excluded-services.*') ||
                        request()->routeIs('admin.experience-highlights.*') ||
                        request()->routeIs('admin.important-information.*') ||
                        request()->routeIs('admin.quick-facts.*') ? 'active' : ''
                    }}">
                        <i class="nav-icon fas fa-puzzle-piece"></i>
                        <p>
                            Itinerary Components
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Included Services -->
                        <li class="nav-item">
                            <a href="{{ route('admin.included-services.index') }}" class="nav-link {{ request()->routeIs('admin.included-services.*') ? 'active' : '' }}">
                                <i class="far fa-check-circle nav-icon text-success"></i>
                                <p>Included Services</p>
                            </a>
                        </li>

                        <!-- Excluded Services -->
                        <li class="nav-item">
                            <a href="{{ route('admin.excluded-services.index') }}" class="nav-link {{ request()->routeIs('admin.excluded-services.*') ? 'active' : '' }}">
                                <i class="far fa-times-circle nav-icon text-danger"></i>
                                <p>Excluded Services</p>
                            </a>
                        </li>

                        <!-- Experience Highlights -->
                        <li class="nav-item">
                            <a href="{{ route('admin.experience-highlights.index') }}" class="nav-link {{ request()->routeIs('admin.experience-highlights.*') ? 'active' : '' }}">
                                <i class="far fa-star nav-icon text-warning"></i>
                                <p>Experience Highlights</p>
                            </a>
                        </li>

                        <!-- Important Information -->
                        <li class="nav-item">
                            <a href="{{ route('admin.important-information.index') }}" class="nav-link {{ request()->routeIs('admin.important-information.*') ? 'active' : '' }}">
                                <i class="far fa-info-circle nav-icon text-info"></i>
                                <p>Important Information</p>
                            </a>
                        </li>

                        <!-- Quick Facts -->
                        <li class="nav-item">
                            <a href="{{ route('admin.quick-facts.index') }}" class="nav-link {{ request()->routeIs('admin.quick-facts.*') ? 'active' : '' }}">
                                <i class="far fa-lightbulb nav-icon text-primary"></i>
                                <p>Quick Facts</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Itinerary Templates -->
                <li class="nav-item">
                    <a href="{{ route('admin.itinerary-templates.index') }}" class="nav-link {{ request()->routeIs('admin.itinerary-templates.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Itinerary Templates
                            @php
                                $activeTemplatesCount = \App\Models\ItineraryTemplate::active()->count();
                            @endphp
                            @if($activeTemplatesCount > 0)
                            <span class="badge badge-success right">{{ $activeTemplatesCount }}</span>
                            @endif
                        </p>
                    </a>
                </li>

                <!-- Bookings Section -->
                <li class="nav-header">BOOKINGS MANAGEMENT</li>
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
                                @if($pendingBookingsCount ?? 0 > 0)
                                <span class="badge badge-warning right">{{ $pendingBookingsCount }}</span>
                                @endif
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

                <!-- Content Management -->
                <li class="nav-header">CONTENT MANAGEMENT</li>

                <!-- Homepage Section -->
                <li class="nav-item {{ request()->routeIs('admin.carousels.*') || request()->routeIs('admin.about-sections.*') || request()->routeIs('admin.services.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.carousels.*') || request()->routeIs('admin.about-sections.*') || request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Homepage
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.carousels.index') }}" class="nav-link {{ request()->routeIs('admin.carousels.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Carousel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.about-sections.index') }}" class="nav-link {{ request()->routeIs('admin.about-sections.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>About Sections</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Services</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Destinations Section -->
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
                <li class="nav-item {{ request()->routeIs('admin.tour-categories.*') || request()->routeIs('admin.explore-tours.*') || request()->routeIs('admin.packages.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.tour-categories.*') || request()->routeIs('admin.explore-tours.*') || request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-suitcase"></i>
                        <p>
                            Tours & Packages
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
                        <li class="nav-item">
                            <a href="{{ route('admin.packages.index') }}" class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Packages</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Gallery Section -->
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
                <li class="nav-item {{ request()->routeIs('admin.blog-categories.*') || request()->routeIs('admin.blogs.*') || request()->routeIs('admin.travel-guides.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.blog-categories.*') || request()->routeIs('admin.blogs.*') || request()->routeIs('admin.travel-guides.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Content
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.travel-guides.index') }}" class="nav-link {{ request()->routeIs('admin.travel-guides.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Travel Guides</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.blog-categories.index') }}" class="nav-link {{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blog Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blog Posts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Testimonials</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Footer Settings -->
                <li class="nav-item">
                    <a href="{{ route('admin.footer-settings.edit') }}" class="nav-link {{ request()->routeIs('admin.footer-settings.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shoe-prints"></i>
                        <p>Footer Settings</p>
                    </a>
                </li>

                <!-- Contact Management -->
                <li class="nav-header">CONTACT MANAGEMENT</li>
                <li class="nav-item">
                    <a href="{{ route('admin.contact-queries.index') }}" class="nav-link {{ request()->routeIs('admin.contact-queries.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-headset"></i>
                        <p>
                            Contact Queries
                            @php
                                $newQueriesCount = \App\Models\ContactQuery::where('status', 'new')->count();
                            @endphp
                            @if($newQueriesCount > 0)
                            <span class="badge badge-warning right">{{ $newQueriesCount }}</span>
                            @endif
                        </p>
                    </a>
                </li>

                <!-- Newsletter -->
                <li class="nav-header">NEWSLETTER</li>
                <li class="nav-item">
                    <a href="{{ route('admin.subscribers.index') }}" class="nav-link {{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Subscribers</p>
                    </a>
                </li>

                <!-- Account Section -->
                <li class="nav-header">ACCOUNT</li>
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Profile Settings</p>
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
