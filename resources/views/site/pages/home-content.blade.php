<!-- Home Page Components -->
@include('site.components.About')
@include('site.components.Services')
@include('site.components.Destination')
@include('site.components.Explore')
@include('site.components.Packages')
@include('site.components.Gallery')
@include('site.components.Booking')
@include('site.components.TravelGuide')
@include('site.components.Blog')
@include('site.components.Testimonial')
@include('site.components.Subscribe')

@push('scripts')
<script>
    $(document).ready(function() {
        // Home page specific initializations
        console.log('Home page content loaded via AJAX');

        // Make sure carousel is working
        if ($('#carouselId').length) {
            $('#carouselId').carousel();
        }
    });
</script>
@endpush