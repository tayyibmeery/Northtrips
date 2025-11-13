@extends('admin.layout.app')

@section('title', 'North Trips & Travel - Footer Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Footer Settings</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('admin.footer-settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Company Links -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Company Links</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="company-links-container">
                                            @foreach($footerSetting->company_links ?? [] as $index => $link)
                                            <div class="row mb-2 company-link-item">
                                                <div class="col-5">
                                                    <input type="text" class="form-control"
                                                           name="company_links[{{ $index }}][name]"
                                                           value="{{ $link['name'] }}"
                                                           placeholder="Link Name" required>
                                                </div>
                                                <div class="col-5">
                                                    <input type="text" class="form-control"
                                                           name="company_links[{{ $index }}][url]"
                                                           value="{{ $link['url'] }}"
                                                           placeholder="URL" required>
                                                </div>
                                                <div class="col-2">
                                                    <button type="button" class="btn btn-danger remove-link" data-type="company">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-sm btn-primary mt-2" id="add-company-link">
                                            <i class="fas fa-plus"></i> Add Company Link
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Support Links -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Support Links</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="support-links-container">
                                            @foreach($footerSetting->support_links ?? [] as $index => $link)
                                            <div class="row mb-2 support-link-item">
                                                <div class="col-5">
                                                    <input type="text" class="form-control"
                                                           name="support_links[{{ $index }}][name]"
                                                           value="{{ $link['name'] }}"
                                                           placeholder="Link Name" required>
                                                </div>
                                                <div class="col-5">
                                                    <input type="text" class="form-control"
                                                           name="support_links[{{ $index }}][url]"
                                                           value="{{ $link['url'] }}"
                                                           placeholder="URL" required>
                                                </div>
                                                <div class="col-2">
                                                    <button type="button" class="btn btn-danger remove-link" data-type="support">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-sm btn-primary mt-2" id="add-support-link">
                                            <i class="fas fa-plus"></i> Add Support Link
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <!-- Payment Methods -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Payment Methods</h4>
                                    </div>
                                    <div class="card-body">
                                        @php
                                            $paymentMethods = ['visa', 'mastercard', 'amex', 'paypal', 'discover', 'apple_pay', 'credit_card'];
                                        @endphp
                                        @foreach($paymentMethods as $method)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   name="payment_methods[]" value="{{ $method }}"
                                                   id="payment_{{ $method }}"
                                                   {{ in_array($method, $footerSetting->payment_methods ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="payment_{{ $method }}">
                                                <i class="{{ \App\Models\FooterSetting::getPaymentIcon($method) }} me-2"></i>
                                                {{ ucfirst(str_replace('_', ' ', $method)) }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Language & Currency -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Language & Currency</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="default_language">Default Language</label>
                                            <input type="text" class="form-control" id="default_language"
                                                   name="default_language" value="{{ $footerSetting->default_language }}"
                                                   placeholder="e.g., English" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="default_currency">Default Currency</label>
                                            <input type="text" class="form-control" id="default_currency"
                                                   name="default_currency" value="{{ $footerSetting->default_currency }}"
                                                   placeholder="e.g., USD" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <!-- Copyright & Settings -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Copyright & Display Settings</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="copyright_text">Copyright Text</label>
                                            <input type="text" class="form-control" id="copyright_text"
                                                   name="copyright_text" value="{{ $footerSetting->copyright_text }}"
                                                   placeholder="Copyright text" required>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   name="show_designer_credit" value="1"
                                                   id="show_designer_credit"
                                                   {{ $footerSetting->show_designer_credit ? 'checked' : '' }}>
                                            <label class="form-check-label" for="show_designer_credit">
                                                Show Designer Credit
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   name="show_back_to_top" value="1"
                                                   id="show_back_to_top"
                                                   {{ $footerSetting->show_back_to_top ? 'checked' : '' }}>
                                            <label class="form-check-label" for="show_back_to_top">
                                                Show Back to Top Button
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Footer Settings
                            </button>
                            <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let companyLinkCount = {{ count($footerSetting->company_links ?? []) }};
        let supportLinkCount = {{ count($footerSetting->support_links ?? []) }};

        // Add company link
        $('#add-company-link').click(function() {
            const html = `
                <div class="row mb-2 company-link-item">
                    <div class="col-5">
                        <input type="text" class="form-control"
                               name="company_links[${companyLinkCount}][name]"
                               placeholder="Link Name" required>
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control"
                               name="company_links[${companyLinkCount}][url]"
                               placeholder="URL" required>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-danger remove-link" data-type="company">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
            $('#company-links-container').append(html);
            companyLinkCount++;
        });

        // Add support link
        $('#add-support-link').click(function() {
            const html = `
                <div class="row mb-2 support-link-item">
                    <div class="col-5">
                        <input type="text" class="form-control"
                               name="support_links[${supportLinkCount}][name]"
                               placeholder="Link Name" required>
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control"
                               name="support_links[${supportLinkCount}][url]"
                               placeholder="URL" required>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-danger remove-link" data-type="support">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
            $('#support-links-container').append(html);
            supportLinkCount++;
        });

        // Remove link
        $(document).on('click', '.remove-link', function() {
            $(this).closest('.row').remove();
        });
    });
</script>
@endpush
