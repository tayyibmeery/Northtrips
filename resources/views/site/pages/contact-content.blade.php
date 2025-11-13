<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Contact Us</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active text-white">Contact</li>
        </ol>
    </div>
</div>

<!-- Contact Content -->
<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Contact Us</h5>
            <h1 class="mb-0">Get In Touch</h1>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="contact-item">
                    <h4 class="mb-4">Contact Information</h4>
                    <div class="d-flex mb-3">
                        <i class="fas fa-map-marker-alt fa-2x text-primary me-3"></i>
                        <div>
                            <h5>Address</h5>
                            <p>{{ $setting->address }}</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="fas fa-envelope fa-2x text-primary me-3"></i>
                        <div>
                            <h5>Email</h5>
                            <p>{{ $setting->email }}</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="fas fa-phone fa-2x text-primary me-3"></i>
                        <div>
                            <h5>Phone</h5>
                            <p>{{ $setting->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <form id="contactForm">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control border-0" placeholder="Your Name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control border-0" placeholder="Your Email" name="email" required>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control border-0" placeholder="Subject" name="subject" required>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control border-0" rows="5" placeholder="Message" name="message" required></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
