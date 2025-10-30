   <div class="container-fluid position-relative p-0">
       <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
           <a href="" class="navbar-brand rounded-circle p-0">
               {{-- <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>{{$setting->company_name}}</h1> --}}
               <img src="{{ Storage::url($setting->logo) }}" alt="{{$setting->company_name}}" class="rounded-circle">
           </a>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
               <span class="fa fa-bars"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarCollapse">
               <div class="navbar-nav ms-auto py-0">
                   <a href="index.html" class="nav-item nav-link active">Home</a>
                   <a href="about.html" class="nav-item nav-link">About</a>
                   <a href="services.html" class="nav-item nav-link">Services</a>
                   <a href="packages.html" class="nav-item nav-link">Packages</a>
                   <a href="blog.html" class="nav-item nav-link">Blog</a>
                   <div class="nav-item dropdown">
                       <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                       <div class="dropdown-menu m-0">
                           <a href="destination.html" class="dropdown-item">Destination</a>
                           <a href="tour.html" class="dropdown-item">Explore Tour</a>
                           <a href="booking.html" class="dropdown-item">Travel Booking</a>
                           <a href="gallery.html" class="dropdown-item">Our Gallery</a>
                           <a href="guides.html" class="dropdown-item">Travel Guides</a>
                           <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                           <a href="404.html" class="dropdown-item">404 Page</a>
                       </div>
                   </div>
                   <a href="contact.html" class="nav-item nav-link">Contact</a>
               </div>
               <a href="" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Book Now</a>
           </div>
       </nav>
       <!-- Carousel Start -->
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
                   @forelse($carousels as $key => $carousel)
                   <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                       @if($carousel->image)
                       <img src="{{ asset('storage/' . $carousel->image) }}" class="img-fluid w-100" alt="{{ $carousel->title }}" style="max-height: 800px; object-fit: cover;">
                       @else
                       <!-- Fallback image if no image is set -->
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
                   @empty
                   <!-- Default carousel items if no carousels exist in database -->
                   <div class="carousel-item active">
                       <img src="{{ asset('img/carousel-1.jpg') }}" class="img-fluid" alt="Default Image">
                       <div class="carousel-caption">
                           <div class="p-3" style="max-width: 900px;">
                               <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explore The World</h4>
                               <h1 class="display-2 text-capitalize text-white mb-4">Welcome to Travela</h1>
                               <p class="mb-5 fs-5">Discover amazing destinations and create unforgettable memories with our premium travel services.</p>
                               <div class="d-flex align-items-center justify-content-center">
                                   <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="{{ route('packages.index') }}">Discover Now</a>
                               </div>
                           </div>
                       </div>
                   </div>
                   @endforelse
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
       <!-- Carousel End -->

   </div>
   {{-- <div class="container-fluid search-bar position-relative" style="top: -50%; transform: translateY(-50%);">
       <div class="container">
           <div class="position-relative rounded-pill w-100 mx-auto p-5" style="background: rgba(19, 53, 123, 0.8);">
               <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Eg: Thailand">
               <button type="button" class="btn btn-primary rounded-pill py-2 px-4 position-absolute me-2" style="top: 50%; right: 46px; transform: translateY(-50%);">Search</button>
           </div>
       </div>
   </div> --}}
