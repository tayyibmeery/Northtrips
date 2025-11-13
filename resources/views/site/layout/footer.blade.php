@php
    $footerSetting = \App\Models\FooterSetting::getSettings();
    $setting = \App\Models\CompanySetting::first();
    $social = \App\Models\SocialMediaLink::where('status', true)->get();
@endphp

<!-- Footer Start -->
<div class="container-fluid footer py-5">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Get In Touch -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Get In Touch</h4>
                    @if($setting->address)
                    <a href="javascript:void(0)"><i class="fas fa-home me-2"></i> {{ $setting->address }}</a>
                    @endif

                    @if($setting->email)
                    <a href="mailto:{{ $setting->email }}"><i class="fas fa-envelope me-2"></i> {{ $setting->email }}</a>
                    @endif

                    @if($setting->phone)
                    <a href="tel:{{ $setting->phone }}"><i class="fas fa-phone me-2"></i> {{ $setting->phone }}</a>
                    @endif

                    @if($setting->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $setting->whatsapp) }}" target="_blank" class="mb-3">
                        <i class="fab fa-whatsapp me-2"></i> {{ $setting->whatsapp }}
                    </a>
                    @endif

                    @if($social->count() > 0)
                    <div class="d-flex align-items-center">
                        <i class="fas fa-share fa-2x text-white me-2"></i>
                        @foreach($social as $value)
                        <a class="btn-square btn btn-primary rounded-circle mx-1" href="{{ $value->url }}" target="_blank">
                            <i class="fab fa-{{ $value->icon_class }}"></i>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <!-- Company Links -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Company</h4>
                    @foreach($footerSetting->company_links as $link)
                    <a href="{{ $link['url'] }}"><i class="fas fa-angle-right me-2"></i> {{ $link['name'] }}</a>
                    @endforeach
                </div>
            </div>

            <!-- Support Links -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="mb-4 text-white">Support</h4>
                    @foreach($footerSetting->support_links as $link)
                    <a href="{{ $link['url'] }}"><i class="fas fa-angle-right me-2"></i> {{ $link['name'] }}</a>
                    @endforeach
                </div>
            </div>

            <!-- Language & Payments -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <div class="row gy-3 gx-2 mb-4">
                        <div class="col-xl-6">
                            <form>
                                <div class="form-floating">
                                    <select class="form-select bg-dark border" id="language-select">
                                        <option selected>{{ $footerSetting->default_language }}</option>
                                        @foreach($footerSetting->languages as $language)
                                        <option value="{{ $language['code'] }}">{{ $language['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <label for="language-select">Language</label>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-6">
                            <form>
                                <div class="form-floating">
                                    <select class="form-select bg-dark border" id="currency-select">
                                        <option selected>{{ $footerSetting->default_currency }}</option>
                                        @foreach($footerSetting->currencies as $currency)
                                        <option value="{{ $currency['code'] }}">{{ $currency['code'] }} ({{ $currency['symbol'] }})</option>
                                        @endforeach
                                    </select>
                                    <label for="currency-select">Currency</label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h4 class="text-white mb-3">Payments</h4>
                    <div class="footer-bank-card">
                        @foreach($footerSetting->payment_methods as $method)
                        <a href="#" class="text-white me-2">
                            <i class="{{ $footerSetting->getPaymentIcon($method) }} fa-2x"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright text-body py-4">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-6 text-center text-md-end mb-md-0">
                <i class="fas fa-copyright me-2"></i>
                <a class="text-white" href="{{ route('home') }}">{{ $footerSetting->copyright_text }}</a>
            </div>
 @if($footerSetting->show_designer_credit)
<div class="col-md-6 text-center text-md-start">
    <small class="text-light opacity-75">
        Design: <a class="text-white" href="https://htmlcodex.com" target="_blank">Tayyib Meery</a> |
        Contact: <a class="text-white" href="tel:+923001520326">+92 300 1520326</a>
    </small>
</div>
@endif
        </div>
    </div>
</div>
<!-- Copyright End -->

@if($setting->whatsapp)
<!-- Floating Action Buttons -->
<div class="floating-buttons">
    <!-- WhatsApp Button -->
    <a href="https://wa.me/{{ preg_replace('/\D/', '', $setting->whatsapp) }}?text=Hello%20{{ urlencode($setting->company_name ?? 'North Trips & Travel') }}%2C%20I'm%20interested%20in%20your%20travel%20services%20and%20would%20like%20to%20know%20more%20about%20your%20packages%20and%20pricing."
       class="floating-btn whatsapp-btn"
       target="_blank"
       title="Message us on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    @if($footerSetting->show_back_to_top)
    <!-- Back to Top Button -->
    <a href="#" class="floating-btn back-to-top-btn" title="Back to Top">
        <i class="fas fa-arrow-up"></i>
    </a>
    @endif
</div>

<style>
.floating-buttons {
    position: fixed;
    bottom: 25px;
    right: 25px;
    z-index: 1000;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.floating-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    font-size: 1.5rem;
}

.whatsapp-btn {
    background: linear-gradient(135deg, #25D366, #128C7E);
    color: white;
    animation: float 3s ease-in-out infinite;
}



.floating-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

.whatsapp-btn:hover {
    background: linear-gradient(135deg, #128C7E, #075E54);
}



@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-5px);
    }
}
</style>
@endif
