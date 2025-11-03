<!-- Breadcrumb Header -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h3 class="text-white display-3 mb-4">Our Services</h3>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="sp-link" data-route="home">Home</a></li>
            <li class="breadcrumb-item active text-white">Services</li>
        </ol>
    </div>
</div>

<!-- Services Component -->
@include('site.components.Services')
