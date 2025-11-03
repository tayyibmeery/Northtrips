<!-- Breadcrumb Header -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Contact Us</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="sp-link" data-route="home">Home</a></li>
            <li class="breadcrumb-item active text-white">Contact</li>
        </ol>
    </div>
</div>

<!-- Contact Component (You'll need to create this) -->
<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Contact Us</h5>
            <h1 class="mb-0">Get In Touch</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="contact-form">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control border-0 py-3" placeholder="Your Name">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control border-0 py-3" placeholder="Your Email">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control border-0 py-3" placeholder="Subject">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-0" rows="5" placeholder="Message"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="contact-info bg-light p-4 rounded">
                    <h5 class="mb-4">Contact Info</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-2"></i> {{ $setting->address ?? '123 Street, City, Country' }}</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-2"></i> {{ $setting->phone ?? '+012 345 67890' }}</p>
                    <p class="mb-2"><i class="fa fa-envelope me-2"></i> {{ $setting->email ?? 'info@example.com' }}</p>
                    <div class="d-flex pt-2">
                        @foreach($social as $socialLink)
                        @if($socialLink->platform == 'facebook' && $socialLink->url)
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="{{ $socialLink->url }}" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        @endif
                        @if($socialLink->platform == 'twitter' && $socialLink->url)
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="{{ $socialLink->url }}" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                        @endif
                        @if($socialLink->platform == 'instagram' && $socialLink->url)
                        <a class="btn btn-square btn-primary rounded-circle me-2" href="{{ $socialLink->url }}" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        @endif
                        @if($socialLink->platform == 'linkedin' && $socialLink->url)
                        <a class="btn btn-square btn-primary rounded-circle" href="{{ $socialLink->url }}" target="_blank">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
