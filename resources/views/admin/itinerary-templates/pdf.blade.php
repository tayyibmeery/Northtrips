<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $itineraryTemplate->title }} - {{ $companySetting->company_name ?? 'North Trips & Travel' }}</title>
    <style>
        /* Global Reset & Typography */
        @page { margin: 0; size: A4; }
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.5;
            color: #343A40; /* Dark Charcoal */
            background: #F8F9FA; /* Light Gray Background */
        }

        .container {
            width: 100%;
            padding: 0;
            margin: 0;
        }
        .section-container {
            width: 90%; /* Content width reduced slightly for margins */
            max-width: 700px;
            margin: 0 auto; /* Center the entire content area */
        }
        .clearfix::after { content: ""; clear: both; display: table; }

        /* ---------- Color Palette ---------- */
        :root {
            --color-primary: #2C3E50; /* Navy Blue */
            --color-accent: #E67E22; /* Burnt Orange */
            --color-secondary: #FFC107; /* Gold */
            --color-text: #343A40;
            --color-light-bg: #F8F9FA;
        }

        /* ---------- Header (Now Centered) ---------- */
        .header {
            background-color: var(--color-primary);
            padding: 18px 0;
            color: white;
            border-bottom: 4px solid var(--color-accent);
            text-align: center; /* Center the whole header block */
        }
        .header-content { display: inline-block; }

        .brand-info { line-height: 1.1; margin-bottom: 10px; }
        .brand-info h1 { font-size: 16pt; margin: 0; font-weight: 800; letter-spacing: 0.5px; }
        .brand-info p { font-size: 9pt; color: #ADB5BD; margin-top: 2px; }

        .contact-info { font-size: 8pt; line-height: 1.4; }
        .contact-info strong { color: var(--color-secondary); margin-right: 15px; }

        /* ---------- Trip Title & Meta (Hero - Centered) ---------- */
        .title-section {
            padding: 20px 30px;
            background: #FFFFFF;
            border-bottom: 1px solid #DEE2E6;
            text-align: center; /* CENTERED */
        }
        .trip-title {
            font-size: 18pt;
            font-weight: 900;
            color: var(--color-primary);
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .trip-subtitle { font-size: 10pt; color: #6C757D; margin-bottom: 8px; }

        .trip-meta {
            font-size: 9pt;
            display: block;
            margin-top: 10px;
        }
        .trip-meta span {
            background: #FFF8F2;
            border: 1px solid rgba(230,126,34,0.3);
            color: var(--color-accent);
            padding: 5px 10px;
            margin: 0 4px; /* Adjust margin for centering */
            display: inline-block;
            border-radius: 20px;
            font-weight: 700;
        }

        /* ---------- Main Content Layout (Single Column) ---------- */
        .content {
            padding: 25px 0;
            display: block;
        }

        /* General Section Styling */
        .section { margin-bottom: 25px; }
        .section-head {
            font-size: 13pt;
            font-weight: 800;
            color: var(--color-primary);
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 2px solid var(--color-accent);
            text-transform: uppercase;
            text-align: left; /* Keep section headers left-aligned */
        }
        .section-body { font-size: 9.5pt; color: #495057; text-align: left; }

        /* ---------- Panels / Cards ---------- */
        .panel {
            background: #FFFFFF;
            border: 1px solid #E9ECEF;
            padding: 15px;
            margin-bottom: 18px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-left: 4px solid var(--color-primary);
        }
        .panel-accent { border-left: 4px solid var(--color-accent); }

        .panel-title {
            font-size: 11pt;
            font-weight: 800;
            color: var(--color-primary);
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #E9ECEF;
            text-transform: uppercase;
            text-align: left;
        }

        /* List/Fact Styling */
        .list-fact, .list-plain { list-style: none; padding: 0; margin: 0; }
        .list-fact li {
            padding: 8px 0;
            border-bottom: 1px dashed #DEE2E6;
            font-size: 9pt;
            display: block;
            overflow: hidden;
        }
        .list-fact li strong { float: right; color: var(--color-accent); font-weight: 700; }
        .list-fact li:last-child { border-bottom: none; }

        /* Inclusion/Exclusion List */
        .list-plain li {
            font-size: 9pt;
            padding: 5px 0;
            color: var(--color-text);
        }
        .list-plain .description { display: block; font-size: 8pt; color: #6C757D; }

        /* ---------- Day Cards (Detailed Itinerary) ---------- */
        .day-card {
            background: #FFFFFF;
            border: 1px solid #DEE2E6;
            border-left: 4px solid var(--color-accent);
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .day-head { display: block; overflow: hidden; margin-bottom: 6px; }

        .day-num {
            background: var(--color-primary);
            color: white;
            float: left;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 25px;
            border-radius: 50%;
            font-weight: 800;
            font-size: 9pt;
            margin-right: 8px;
        }

        .day-title {
            font-size: 10.5pt;
            font-weight: 700;
            color: var(--color-primary);
            padding-top: 1px;
        }

        .day-desc {
            font-size: 9pt;
            margin: 6px 0;
            color: #555;
            border-bottom: 1px dashed #DEE2E6;
            padding-bottom: 8px;
        }

        .day-tags { margin-top: 5px; }
        .day-tag {
            background: #FDF4E0;
            border: 1px solid #FFE082;
            padding: 3px 7px;
            font-size: 8pt;
            display: inline-block;
            margin-right: 5px;
            margin-top: 3px;
            border-radius: 12px;
            color: var(--color-accent);
            font-weight: 600;
        }

        /* Pricing Table */
        table.pricing {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 9pt;
            text-align: left;
        }

        table.pricing th {
            background: var(--color-primary);
            color: var(--color-secondary);
            padding: 8px;
            text-align: left;
            font-weight: 800;
        }

        table.pricing td {
            padding: 8px;
            border: 1px solid #E9ECEF;
            color: var(--color-text);
        }

        .price {
            font-size: 10pt;
            font-weight: 800;
            color: var(--color-accent);
        }

        /* Notice Boxes (Terms/Payment) */
        .notice-box {
            background: #F8F9FA;
            border-left: 4px solid var(--color-accent);
            padding: 10px;
            margin-top: 10px;
            border-radius: 4px;
            font-size: 9pt;
            text-align: left;
        }

        .notice-box strong {
            font-size: 9.5pt;
            color: var(--color-primary);
            display: block;
            margin-bottom: 4px;
        }

        /* ---------- Footer (Centered) ---------- */
        .footer {
            background: var(--color-primary);
            color: white;
            padding: 15px 30px;
            font-size: 8pt;
            border-top: 4px solid var(--color-accent);
            text-align: center; /* CENTERED */
        }
        .footer-left { font-weight: 700; color: var(--color-secondary); display: block; }
        .footer-right { color: #ADB5BD; display: block; margin-top: 5px; }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <div class="header-content">
            <div class="brand-info">
                <h1>{{ $companySetting->company_name ?? 'NORTH TRIPS & TRAVEL' }}</h1>
                <p>Premium Adventure & Tour Operations - GOVT LICENSED</p>
            </div>
            <div class="contact-info">
                <strong>Contact & Licensing</strong>
                Phone: {{ $companySetting->phone ?? '0343-1428730' }} | Email: {{ $companySetting->email ?? 'ntrips20@gmail.com' }}
            </div>
        </div>
    </div>

    <div class="title-section">
        <div class="trip-title">{{ strtoupper($itineraryTemplate->title) }}</div>

        @if(!empty($itineraryTemplate->subtitle))
        <div class="trip-subtitle">{{ $itineraryTemplate->subtitle }}</div>
        @endif

        <div class="trip-meta">
            <span>🔖 CODE: **{{ $itineraryTemplate->trip_code ?? 'N/A' }}**</span>
            <span>⏱ DURATION: **{{ $itineraryTemplate->duration_days ?? 0 }}D/{{ $itineraryTemplate->duration_nights ?? 0 }}N**</span>
            <span>🌤 SEASON: **{{ strtoupper(str_replace('_',' ',$itineraryTemplate->season ?? 'PEAK')) }}**</span>
        </div>
    </div>

    <div class="content">
        <div class="section-container">

            <div class="section">
                <div class="section-head">Journey Overview</div>
                <div class="section-body">
                    <p>{{ $itineraryTemplate->description ?? 'A detailed description of the trip is currently unavailable. Please contact our team for more information.' }}</p>
                </div>
            </div>

            <div class="panel panel-accent">
                <div class="panel-title">Quick Facts</div>
                <ul class="list-fact">
                    @if($itineraryTemplate->selected_quick_facts && method_exists($itineraryTemplate,'getQuickFactsData'))
                        @foreach($itineraryTemplate->getQuickFactsData() as $fact)
                            <li>{{ $fact->fact }} <strong>{{ $fact->value }}</strong></li>
                        @endforeach
                    @else
                        <li>Destination <strong>{{ $itineraryTemplate->destination ?? 'N/A' }}</strong></li>
                        <li>Type <strong>Adventure / Tour</strong></li>
                        <li>Transport <strong>Coaster / Grand Cabin</strong></li>
                    @endif
                </ul>
            </div>

            <div class="section">
                <div class="section-head">Detailed Itinerary</div>
                <div class="section-body" style="padding: 0;">

                    @foreach($itineraryTemplate->days as $day)
                    <div class="day-card">
                        <div class="day-head">
                            <span class="day-num">{{ $day->day_number }}</span>
                            <div class="day-title">{{ $day->title }}</div>
                        </div>
                        <div class="day-desc">
                            {!! nl2br(e($day->description)) !!}
                        </div>

                        @if($day->activities || $day->meals || $day->accommodation)
                        <div class="day-tags">
                            @if($day->activities)
                                <span class="day-tag">🎯 Activity: {{ \Illuminate\Support\Str::limit($day->activities, 30) }}</span>
                            @endif
                            @if($day->meals)
                                <span class="day-tag">🍽 Meals: {{ \Illuminate\Support\Str::limit($day->meals, 20) }}</span>
                            @endif
                            @if($day->accommodation)
                                <span class="day-tag">🏨 Stay: {{ \Illuminate\Support\Str::limit($day->accommodation, 30) }}</span>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="section">
                <div class="section-head">Investment & Pricing</div>
                <div class="section-body" style="padding: 0;">
                    @php $pricing = $itineraryTemplate->pricing_options ?? []; @endphp

                    <table class="pricing">
                        <thead>
                            <tr>
                                <th>Package Tier</th>
                                <th>Solo</th>
                                <th>Couple (Per Person)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($pricing['standard_solo']))
                            <tr>
                                <td>**Standard**</td>
                                <td><span class="price">PKR {{ number_format($pricing['standard_solo']) }}</span></td>
                                <td><span class="price">PKR {{ number_format($pricing['standard_couple']) }}</span></td>
                            </tr>
                            @endif
                            @if(!empty($pricing['deluxe_solo']))
                            <tr>
                                <td>**Deluxe**</td>
                                <td><span class="price">PKR {{ number_format($pricing['deluxe_solo']) }}</span></td>
                                <td><span class="price">PKR {{ number_format($pricing['deluxe_couple']) }}</span></td>
                            </tr>
                            @endif
                            @if(!empty($pricing['premium_solo']))
                            <tr>
                                <td>**Premium**</td>
                                <td><span class="price">PKR {{ number_format($pricing['premium_solo']) }}</span></td>
                                <td><span class="price">PKR {{ number_format($pricing['premium_couple']) }}</span></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                    @if(!empty($itineraryTemplate->payment_terms))
                    <div class="notice-box">
                        <strong>Payment Terms</strong>
                        {{ strip_tags($itineraryTemplate->payment_terms) }}
                    </div>
                    @endif
                </div>
            </div>

            <div class="panel">
                <div class="panel-title">What's Included</div>
                <ul class="list-plain">
                    @if($itineraryTemplate->selected_included_services && method_exists($itineraryTemplate,'getIncludedServicesData'))
                        @foreach($itineraryTemplate->getIncludedServicesData() as $s)
                            <li>**{{ $s->title }}**
                                @if(!empty($s->description))
                                    <span class="description">{{ $s->description }}</span>
                                @endif
                            </li>
                        @endforeach
                    @else
                        <li>**Transport** (as per itinerary)</li>
                        <li>**Accommodation** (Quality Hotel Stays)</li>
                        <li>**Meals** (Breakfast & Dinner)</li>
                        <li>**Professional Guide**</li>
                    @endif
                </ul>
            </div>

            <div class="panel panel-accent">
                <div class="panel-title">Not Included</div>
                <ul class="list-plain">
                    @if($itineraryTemplate->selected_excluded_services && method_exists($itineraryTemplate,'getExcludedServicesData'))
                        @foreach($itineraryTemplate->getExcludedServicesData() as $s)
                            <li style="color: #6C757D;">**{{ $s->title }}**
                                @if(!empty($s->description))
                                    <span class="description">{{ $s->description }}</span>
                                @endif
                            </li>
                        @endforeach
                    @else
                        <li style="color: #6C757D;">**Lunches & Beverages**</li>
                        <li style="color: #6C757D;">**Entry Tickets / Jeep Fees**</li>
                        <li style="color: #6C757D;">**Travel Insurance & Rescue**</li>
                    @endif
                </ul>
            </div>

            @if(!empty($itineraryTemplate->cancellation_policy) || !empty($itineraryTemplate->terms_conditions))
            <div class="section">
                <div class="section-head">Policies & Important Information</div>
                <div class="section-body" style="padding: 0;">

                    @if(!empty($itineraryTemplate->cancellation_policy))
                    <div class="notice-box">
                        <strong>Cancellation Policy</strong>
                        {!! nl2br(e($itineraryTemplate->cancellation_policy)) !!}
                    </div>
                    @endif

                    @if(!empty($itineraryTemplate->terms_conditions))
                    <div class="notice-box">
                        <strong>Terms & Conditions</strong>
                        {!! nl2br(e($itineraryTemplate->terms_conditions)) !!}
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="footer">
        <div class="footer-left">
            **{{ $companySetting->company_name ?? 'NORTH TRIPS & TRAVEL' }}** | Premium Adventures
        </div>
        <div class="footer-right">
            Generated: {{ now()->format('d F Y') }}<br>
            Office Address: {{ $companySetting->address ?? 'Lahore, Pakistan' }}
        </div>
    </div>

</div>
</body>
</html>
