<!-- Subscribe Start -->
<div class="container-fluid subscribe py-5">
    <div class="container text-center py-5">
        <div class="mx-auto text-center" style="max-width: 900px;">
            <h5 class="subscribe-title px-3">Subscribe</h5>
            <h1 class="text-white mb-4">Our Newsletter</h1>
            <p class="text-white mb-5">Stay updated with our latest travel deals, new destinations, and exclusive offers. Subscribe to our newsletter and be the first to know about exciting adventures and special discounts.</p>

            <form id="subscribeForm" method="POST" action="{{ route('subscribe') }}" class="position-relative mx-auto">
                @csrf
                <input class="form-control border-primary rounded-pill w-100 py-3 ps-4 pe-5 @error('email') is-invalid @enderror"
                       type="email" name="email" placeholder="Your email" value="{{ old('email') }}" required>
                <button type="submit" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2" id="subscribeBtn">
                    <span id="subscribeText">Subscribe</span>
                    <div id="subscribeSpinner" class="spinner-border spinner-border-sm d-none" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
                @error('email')
                <div class="invalid-feedback d-block text-start">{{ $message }}</div>
                @enderror
            </form>

            <div id="subscribeMessage" class="mt-3"></div>
        </div>
    </div>
</div>
<!-- Subscribe End -->

@push('scripts')
<script>
    $(document).ready(function() {
        $('#subscribeForm').on('submit', function(e) {
            e.preventDefault();

            const subscribeBtn = $('#subscribeBtn');
            const subscribeText = $('#subscribeText');
            const subscribeSpinner = $('#subscribeSpinner');
            const messageDiv = $('#subscribeMessage');

            // Show loading state
            subscribeBtn.prop('disabled', true);
            subscribeText.text('Subscribing...');
            subscribeSpinner.removeClass('d-none');
            messageDiv.html('');

            // Submit form via AJAX
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    messageDiv.html('<div class="alert alert-success">Thank you for subscribing! You will receive our latest updates and offers.</div>');
                    $('#subscribeForm')[0].reset();
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    messageDiv.html('<div class="alert alert-danger">' + errorMessage + '</div>');
                },
                complete: function() {
                    // Reset button state
                    subscribeBtn.prop('disabled', false);
                    subscribeText.text('Subscribe');
                    subscribeSpinner.addClass('d-none');
                }
            });
        });
    });
</script>
@endpush