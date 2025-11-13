<!DOCTYPE html>
<html>
<head>
    <title>We Have Received Your Message</title>
</head>
<body>
    <h2>Thank You for Contacting {{ $setting->company_name ?? config('app.name') }}</h2>

    <div style="background: #f8f9fa; padding: 20px; border-radius: 5px;">
        <p>Dear {{ $query->name }},</p>

        <p>We have received your message and appreciate you reaching out to us. Here's a summary of your inquiry:</p>

        <div style="background: white; padding: 15px; border-left: 4px solid #28a745; margin: 15px 0;">
            <p><strong>Subject:</strong> {{ $query->subject }}</p>
            <p><strong>Message:</strong> {{ $query->message }}</p>
            <p><strong>Reference ID:</strong> #{{ $query->id }}</p>
        </div>

        <p><strong>What happens next?</strong></p>
        <ul>
            <li>Our team will review your message</li>
            <li>We'll respond within 24 hours during business days</li>
            <li>For urgent matters, please call us at {{ $setting->phone ?? 'our contact number' }}</li>
        </ul>

        <p><strong>Our Contact Information:</strong></p>
        <p>
            Email: {{ $setting->email ?? 'contact@example.com' }}<br>
            Phone: {{ $setting->phone ?? '+1 234 567 8900' }}<br>
            Address: {{ $setting->address ?? 'Our Office Address' }}
        </p>
    </div>

    <p style="margin-top: 20px;">
        Best regards,<br>
        <strong>The {{ $setting->company_name ?? config('app.name') }} Team</strong>
    </p>
</body>
</html>
