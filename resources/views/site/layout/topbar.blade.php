<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Topbar Start -->
<div class="container-fluid bg-primary px-5 d-none d-lg-block">
    <div class="row gx-0">
        <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                @foreach($social as $value)
                <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="{{ $value->url }}"><i class="fab fa-{{$value->icon_class}} fw-normal"></i></a>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <a href="{{ route('register') }}"><small class="me-3 text-light"><i class="fa fa-user me-2"></i>Register</small></a>
                <a href="{{ route('login') }}"><small class="me-3 text-light"><i class="fa fa-sign-in-alt me-2"></i>Login</small></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->
