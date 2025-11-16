<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $itineraryTemplate->title }} - {{ $companySetting->company_name ?? 'North Trips & Travel' }}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        /* ---------- A4 Page Setup ---------- */
        @page {
            size: A4;
            margin: 0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            width: 210mm;
            margin: 0 auto;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background: #fff;
            font-size: 10pt;
            line-height: 1.4;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 15mm;
            margin: 0 auto;
            page-break-after: always;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .page:last-child {
            page-break-after: auto;
        }

        .page-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* ---------- Header ---------- */
        .header {
            background: linear-gradient(135deg, #2C3E50 0%, #1a5276 100%);
            padding: 4mm 6mm;
            color: #fff;
            border-bottom: 2mm solid #e67e22;
            margin: -15mm -15mm 5mm -15mm;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-section {
            display: flex;
            align-items: center;
            gap: 4mm;
        }

        .logo-box {
            width: 15mm;
            height: 15mm;

            border-radius: 10mm;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 6mm;
            color: #fff;
        }

        .company-info h1 {
            margin: 0;
            font-size: 5mm;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .company-info .tagline {
            margin-top: 1mm;
            font-size: 3mm;
            color: #f1c40f;
            font-weight: 600;
        }

        .contact-info {
            text-align: right;
            font-size: 2.5mm;
            line-height: 1.4;
        }

        .contact-info .badge {
            display: inline-block;
            background: rgba(241, 196, 15, 0.2);
            border: 1px solid #f1c40f;
            color: #f1c40f;
            padding: 1mm 2mm;
            border-radius: 2mm;
            font-weight: 700;
            font-size: 2mm;
            margin-top: 1mm;
        }

        /* ---------- Hero Section ---------- */
        .hero {
            padding: 3mm 0;
            margin-bottom: 3mm;
        }

        .trip-title {
            font-size: 7mm;
            font-weight: 900;
            color: #2C3E50;
            margin: 0 0 1mm 0;
            line-height: 1.1;
        }

        .trip-subtitle {
            font-size: 3.5mm;
            color: #7f8c8d;
            font-weight: 600;
            margin-bottom: 3mm;
        }

        .badges-row {
            display: flex;
            gap: 2mm;
            flex-wrap: wrap;
        }

        .badge-item {
            background: #f8f9fa;
            border: 1px solid #e67e22;
            padding: 1.5mm 3mm;
            border-radius: 2mm;
            font-weight: 700;
            font-size: 2.5mm;
            color: #2C3E50;
        }

        /* ---------- Main Content Grid ---------- */
        .main-grid {
            display: grid;
            grid-template-columns: 55mm 1fr;
            gap: 4mm;
            flex: 1;
        }

        /* ---------- Sidebar ---------- */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 4mm;
        }

        .info-card {
            background: #f8f9fa;
            border-radius: 2mm;
            padding: 3mm;
            border: 1px solid #e9ecef;
            box-shadow: 0 0.5mm 1mm rgba(0,0,0,0.05);
        }

        .info-card-title {
            font-size: 3.5mm;
            font-weight: 800;
            color: #2C3E50;
            margin: 0 0 2mm 0;
            padding-bottom: 1mm;
            border-bottom: 1px solid #e67e22;
        }

        .fact-grid {
            display: grid;
            gap: 1.5mm;
        }

        .fact-item {
            background: #fff;
            padding: 2mm;
            border-radius: 1mm;
            border-left: 1.5px solid #e67e22;
        }

        .fact-label {
            font-size: 2mm;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 0.5mm;
        }

        .fact-value {
            font-size: 3mm;
            font-weight: 700;
            color: #2C3E50;
        }

        .list-items {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .list-items li {
            padding: 1.5mm 0;
            border-bottom: 0.5px solid #eee;
            font-size: 2.5mm;
            line-height: 1.3;
        }

        .list-items li:last-child {
            border-bottom: none;
        }

        .list-items strong {
            color: #2C3E50;
            display: block;
            margin-bottom: 0.3mm;
            font-size: 2.8mm;
        }

        .list-items .note {
            color: #7f8c8d;
            font-size: 2.2mm;
        }

        /* ---------- Main Content ---------- */
        .main-content {
            display: flex;
            flex-direction: column;
            gap: 4mm;
        }

        .content-section {
            background: #fff;
            border-radius: 2mm;
            overflow: hidden;
            border: 1px solid #e9ecef;
            box-shadow: 0 0.5mm 1mm rgba(0,0,0,0.05);
        }

        .section-header {
            background: #2C3E50;
            padding: 2mm 3mm;
            border-bottom: 1px solid #e9ecef;
        }

        .section-header h2 {
            margin: 0;
            font-size: 4mm;
            font-weight: 800;
            color: #fff;
        }

        .section-body {
            padding: 3mm;
        }

        .overview-text {
            font-size: 3mm;
            color: #555;
            line-height: 1.4;
            margin: 0;
        }

        /* ---------- Day Cards ---------- */
        .day-card {
            background: #fff;
            border: 1px solid #e9ecef;
            border-left: 2px solid #e67e22;
            border-radius: 1.5mm;
            padding: 3mm;
            margin-bottom: 2mm;
            page-break-inside: avoid;
        }

        .day-header {
            display: flex;
            align-items: center;
            gap: 2mm;
            margin-bottom: 1.5mm;
        }

        .day-number {
            background: #2C3E50;
            color: #fff;
            width: 6mm;
            height: 6mm;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 3mm;
            flex-shrink: 0;
        }

        .day-title {
            font-size: 3.5mm;
            font-weight: 800;
            color: #2C3E50;
            flex: 1;
        }

        .day-description {
            font-size: 3mm;
            color: #555;
            line-height: 1.4;
            margin-bottom: 2mm;
        }

        .day-tags {
            display: flex;
            gap: 1.5mm;
            flex-wrap: wrap;
        }

        .tag {
            background: #fff8e1;
            border: 0.5px solid #ffd54f;
            padding: 0.8mm 1.5mm;
            border-radius: 1.5mm;
            font-size: 2.2mm;
            font-weight: 700;
            color: #e65100;
        }

        /* ---------- Pricing Table ---------- */
        .pricing-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2mm;
            font-size: 2.5mm;
        }

        .pricing-table th {
            background: #2C3E50;
            padding: 2mm;
            text-align: left;
            font-weight: 800;
            color: #fff;
            border: 0.5px solid #2C3E50;
        }

        .pricing-table td {
            padding: 2mm;
            border: 0.5px solid #e9ecef;
            background: #fff;
        }

        .pricing-table .tier-name {
            font-weight: 700;
            color: #2C3E50;
        }

        .price-value {
            font-size: 3.5mm;
            font-weight: 900;
            color: #e67e22;
        }

        .payment-notice {
            margin-top: 3mm;
            padding: 2mm;
            background: #f9f9f9;
            border-left: 2px solid #e67e22;
            border-radius: 1mm;
            font-size: 2.5mm;
        }

        .payment-notice strong {
            color: #2C3E50;
            display: block;
            margin-bottom: 0.8mm;
            font-size: 2.8mm;
        }

        .payment-notice div {
            color: #555;
            line-height: 1.4;
        }

        /* ---------- Footer ---------- */
        .footer {
            background: #2C3E50;
            padding: 3mm 0;
            color: #fff;
            border-top: 1mm solid #e67e22;
            margin: 5mm -15mm -15mm -15mm;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 6mm;
        }

        .footer-left {
            font-weight: 700;
            font-size: 2.5mm;
        }

        .footer-right {
            text-align: right;
            font-size: 2.2mm;
            color: #ecf0f1;
            line-height: 1.3;
        }

        /* ---------- Page Numbering ---------- */
        .page-number {
            position: absolute;
            bottom: 20mm;
            right: 15mm;
            font-size: 2.5mm;
            color: #7f8c8d;
        }

        /* ---------- Action Buttons ---------- */
        .action-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            gap: 10px;
        }

        .action-btn {
            background: #e67e22;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: #d35400;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        .action-btn.download {
            background: #27ae60;
        }

        .action-btn.download:hover {
            background: #219a52;
        }

        /* ---------- Print Optimization ---------- */
        @media print {
            .action-buttons {
                display: none;
            }

            body {
                width: 210mm;
                height: 297mm;
                margin: 0;
                padding: 0;
            }

            .page {
                width: 210mm;
                height: 297mm;
                margin: 0;
                padding: 15mm;
                box-shadow: none;
            }

            .day-card, .content-section {
                page-break-inside: avoid;
            }

            .header, .footer {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('admin.itinerary-templates.download-pdf', $itineraryTemplate) }}" class="action-btn download">
            📥 Download PDF
        </a>
        <a href="{{ route('admin.itinerary-templates.index') }}" class="action-btn">
            ← Back to List
        </a>
    </div>

    <!-- Page 1 -->
    <div class="page">
        <!-- Header -->
        <header class="header">
            <div class="header-content">
                <div class="brand-section">
                    <div class="logo-box">
                        <img src="{{ asset('images/logo/nortlogo.png') }}" width="70px" height="70px">

                    </div>
                    <div class="company-info">
                        <h1>{{ $companySetting->company_name ?? 'North Trips & Travel' }}</h1>
                        <div class="tagline">Premium Adventure & Tour Operations</div>
                    </div>
                </div>
                <div class="contact-info">
                    <div>📞 <strong>{{ $companySetting->phone ?? '0343-1428730' }}</strong></div>
                    <div>✉ {{ $companySetting->email ?? 'ntrips20@gmail.com' }}</div>
                    <div class="badge">🏅 GOVT LICENSED</div>
                </div>
            </div>
        </header>

        <div class="page-content">
            <!-- Hero Section -->
            <section class="hero">
                <h1 class="trip-title">{{ $itineraryTemplate->title }}</h1>
                @if(!empty($itineraryTemplate->subtitle))
                    <div class="trip-subtitle">{{ $itineraryTemplate->subtitle }}</div>
                @endif
                <div class="badges-row">
                    <div class="badge-item">🔖 TRIP CODE: {{ $itineraryTemplate->trip_code ?? 'N/A' }}</div>
                    <div class="badge-item">⏱ {{ $itineraryTemplate->duration_days ?? 0 }} DAYS / {{ $itineraryTemplate->duration_nights ?? 0 }} NIGHTS</div>
                    <div class="badge-item">🌤 {{ strtoupper(str_replace('_', ' ', $itineraryTemplate->season ?? 'peak')) }} SEASON</div>
                    <div class="badge-item">⭐ PREMIUM ADVENTURE</div>
                </div>
            </section>

            <!-- Main Content Grid -->
            <div class="main-grid">
                <!-- Sidebar -->
                <aside class="sidebar">
                    <!-- Quick Facts -->
                    <div class="info-card">
                        <h3 class="info-card-title">📊 Quick Facts</h3>
                        <div class="fact-grid">
                            @if($itineraryTemplate->selected_quick_facts && method_exists($itineraryTemplate, 'getQuickFactsData'))
                                @foreach($itineraryTemplate->getQuickFactsData() as $fact)
                                    <div class="fact-item">
                                        <div class="fact-label">{{ $fact->fact ?? 'Fact' }}</div>
                                        <div class="fact-value">{{ $fact->value ?? 'Value' }}</div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Default Quick Facts -->
                                <div class="fact-item">
                                    <div class="fact-label">Destination</div>
                                    <div class="fact-value">Northern Pakistan</div>
                                </div>
                                <div class="fact-item">
                                    <div class="fact-label">Group Size</div>
                                    <div class="fact-value">12-18 Persons</div>
                                </div>
                                <div class="fact-item">
                                    <div class="fact-label">Transport</div>
                                    <div class="fact-value">Coaster / Grand Cabin</div>
                                </div>
                                <div class="fact-item">
                                    <div class="fact-label">Best Season</div>
                                    <div class="fact-value">April - October</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- What's Included -->
                    <div class="info-card">
                        <h3 class="info-card-title">✅ What's Included</h3>
                        <ul class="list-items">
                            @if($itineraryTemplate->selected_included_services && method_exists($itineraryTemplate, 'getIncludedServicesData'))
                                @foreach($itineraryTemplate->getIncludedServicesData() as $service)
                                    <li>
                                        <strong>{{ $service->title ?? 'Service' }}</strong>
                                        @if(!empty($service->description))
                                            <span class="note">{{ $service->description }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <!-- Default Included Services -->
                                <li>
                                    <strong>Transportation</strong>
                                    <span class="note">Round trip from Islamabad in comfortable vehicles</span>
                                </li>
                                <li>
                                    <strong>Accommodation</strong>
                                    <span class="note">Hotels on sharing basis (twin/triple)</span>
                                </li>
                                <li>
                                    <strong>Meals</strong>
                                    <span class="note">Daily breakfast & dinner included</span>
                                </li>
                                <li>
                                    <strong>Professional Guide</strong>
                                    <span class="note">Experienced tour leader & basic first aid</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- What's Not Included -->
                    <div class="info-card">
                        <h3 class="info-card-title">❌ Not Included</h3>
                        <ul class="list-items">
                            @if($itineraryTemplate->selected_excluded_services && method_exists($itineraryTemplate, 'getExcludedServicesData'))
                                @foreach($itineraryTemplate->getExcludedServicesData() as $service)
                                    <li>
                                        <strong>{{ $service->title ?? 'Service' }}</strong>
                                        @if(!empty($service->description))
                                            <span class="note">{{ $service->description }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <!-- Default Excluded Services -->
                                <li><strong>Lunches & personal beverages</strong></li>
                                <li><strong>Entry fees to monuments</strong></li>
                                <li><strong>Boat/Jeep safari charges</strong></li>
                                <li><strong>Travel & medical insurance</strong></li>
                            @endif
                        </ul>
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="main-content">
                    <!-- Overview -->
                    <div class="content-section">
                        <div class="section-header">
                            <h2>🗺 Journey Overview</h2>
                        </div>
                        <div class="section-body">
                            <p class="overview-text">
                                {{ $itineraryTemplate->description ?? 'An unforgettable adventure through the majestic landscapes of northern Pakistan. Experience breathtaking mountain scenery, pristine lakes, rich local culture, and create memories that will last a lifetime.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Detailed Itinerary - Days 1-4 -->
                    <div class="content-section">
                        <div class="section-header">
                            <h2>📅 Detailed Itinerary</h2>
                        </div>
                        <div class="section-body">
                            @php
                                $firstHalfDays = $itineraryTemplate->days->take(4);
                            @endphp

                            @foreach($firstHalfDays as $day)
                                <div class="day-card">
                                    <div class="day-header">
                                        <div class="day-number">{{ $day->day_number }}</div>
                                        <div class="day-title">{{ $day->title }}</div>
                                    </div>
                                    <div class="day-description">
                                        {{ $day->description }}
                                    </div>
                                    <div class="day-tags">
                                        @if($day->activities)
                                            <span class="tag">🎯 {{ \Illuminate\Support\Str::limit($day->activities, 40) }}</span>
                                        @endif
                                        @if($day->meals)
                                            <span class="tag">🍽 {{ \Illuminate\Support\Str::limit($day->meals, 30) }}</span>
                                        @endif
                                        @if($day->accommodation)
                                            <span class="tag">🏨 {{ \Illuminate\Support\Str::limit($day->accommodation, 40) }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="section-body">
                            @php
                                $secondHalfDays = $itineraryTemplate->days->skip(4);
                            @endphp

                            @foreach($secondHalfDays as $day)
                                <div class="day-card">
                                    <div class="day-header">
                                        <div class="day-number">{{ $day->day_number }}</div>
                                        <div class="day-title">{{ $day->title }}</div>
                                    </div>
                                    <div class="day-description">
                                        {{ $day->description }}
                                    </div>
                                    <div class="day-tags">
                                        @if($day->activities)
                                            <span class="tag">🎯 {{ \Illuminate\Support\Str::limit($day->activities, 40) }}</span>
                                        @endif
                                        @if($day->meals)
                                            <span class="tag">🍽 {{ \Illuminate\Support\Str::limit($day->meals, 30) }}</span>
                                        @endif
                                        @if($day->accommodation)
                                            <span class="tag">🏨 {{ \Illuminate\Support\Str::limit($day->accommodation, 40) }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </main>





                <!-- Sidebar -->
                <aside class="sidebar">
                    <!-- Important Notes -->
                    <div class="info-card">
                        <h3 class="info-card-title">📝 Important Notes</h3>
                        <ul class="list-items">
                            @if($itineraryTemplate->selected_important_information && method_exists($itineraryTemplate, 'getImportantInformationData'))
                                @foreach($itineraryTemplate->getImportantInformationData() as $info)
                                    <li>
                                        <strong>{{ $info->title ?? 'Note' }}</strong>
                                        @if(!empty($info->description))
                                            <span class="note">{{ $info->description }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            @else
                                <!-- Default Important Notes -->
                                <li>
                                    <strong>Weather Conditions</strong>
                                    <span class="note">Itinerary may change due to weather or road conditions</span>
                                </li>
                                <li>
                                    <strong>Health & Fitness</strong>
                                    <span class="note">Moderate fitness level required for some activities</span>
                                </li>
                                <li>
                                    <strong>Documentation</strong>
                                    <span class="note">Valid CNIC/Passport required for all travelers</span>
                                </li>
                                <li>
                                    <strong>Packing List</strong>
                                    <span class="note">Warm clothes, comfortable shoes, personal medication</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Contact Information -->
                    <div class="info-card">
                        <h3 class="info-card-title">📞 Contact Info</h3>
                        <div class="fact-grid">
                            <div class="fact-item">
                                <div class="fact-label">Emergency Contact</div>
                                <div class="fact-value">{{ $companySetting->phone ?? '0343-1428730' }}</div>
                            </div>
                            <div class="fact-item">
                                <div class="fact-label">Email</div>
                                <div class="fact-value">{{ $companySetting->email ?? 'ntrips20@gmail.com' }}</div>
                            </div>
                            <div class="fact-item">
                                <div class="fact-label">Office Address</div>
                                <div class="fact-value">{{ $companySetting->address ?? 'Lahore, Pakistan' }}</div>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="main-content">


                    <!-- Pricing -->
                    <div class="content-section">
                        <div class="section-header">
                            <h2>💰 Investment & Pricing</h2>
                        </div>
                        <div class="section-body">
                            <table class="pricing-table">
                                <thead>
                                    <tr>
                                        <th>Package Tier</th>
                                        <th>Solo Traveler</th>
                                        <th>Per Person (Couple)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $pricing = $itineraryTemplate->pricing_options ?? [];
                                    @endphp

                                    @if(!empty($pricing['standard_solo']))
                                    <tr>
                                        <td class="tier-name">Standard Package</td>
                                        <td><span class="price-value">PKR {{ number_format($pricing['standard_solo']) }}/-</span></td>
                                        <td><span class="price-value">PKR {{ number_format($pricing['standard_couple'] ?? 0) }}/-</span></td>
                                    </tr>
                                    @endif

                                    @if(!empty($pricing['deluxe_solo']))
                                    <tr>
                                        <td class="tier-name">Deluxe Package</td>
                                        <td><span class="price-value">PKR {{ number_format($pricing['deluxe_solo']) }}/-</span></td>
                                        <td><span class="price-value">PKR {{ number_format($pricing['deluxe_couple'] ?? 0) }}/-</span></td>
                                    </tr>
                                    @endif

                                    @if(!empty($pricing['premium_solo']))
                                    <tr>
                                        <td class="tier-name">Premium Package</td>
                                        <td><span class="price-value">PKR {{ number_format($pricing['premium_solo']) }}/-</span></td>
                                        <td><span class="price-value">PKR {{ number_format($pricing['premium_couple'] ?? 0) }}/-</span></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>

                            @if(!empty($itineraryTemplate->payment_terms))
                                <div class="payment-notice">
                                    <strong>💳 Payment Terms</strong>
                                    <div>{!! nl2br(e($itineraryTemplate->payment_terms)) !!}</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="content-section">
                        <div class="section-header">
                            <h2>📋 Terms & Conditions</h2>
                        </div>
                        <div class="section-body">
                            @if(!empty($itineraryTemplate->cancellation_policy))
                                <div class="payment-notice">
                                    <strong>Cancellation Policy</strong>
                                    <div>{!! nl2br(e($itineraryTemplate->cancellation_policy)) !!}</div>
                                </div>
                            @endif

                            @if(!empty($itineraryTemplate->terms_conditions))
                                <div class="payment-notice" style="margin-top: 2mm;">
                                    <strong>General Terms & Conditions</strong>
                                    <div>{!! nl2br(e($itineraryTemplate->terms_conditions)) !!}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Page Number -->
        <div class="page-number">Page 2 of 2</div>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-left">
                    {{ $companySetting->company_name ?? 'North Trips & Travel' }} • Premium Adventures Since 2020
                </div>
                <div class="footer-right">
                    Generated: {{ now()->format('F d, Y') }}<br>
                    {{ $companySetting->address ?? 'H#10/147 Ferozpur Road, Muslim Town, Lahore' }}
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
