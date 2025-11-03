<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Confirmation</title>
</head>
<body>
    <h2>Booking Confirmation - North Trips & Travel</h2>

    <p>Dear {{ $booking->name }},</p>

    <p>Thank you for booking with North Trips & Travel! We have received your booking request and will process it shortly.</p>

    <h3>Booking Details:</h3>
    <ul>
        <li><strong>Booking ID:</strong> #{{ $booking->id }}</li>
        <li><strong>Name:</strong> {{ $booking->name }}</li>
        <li><strong>Email:</strong> {{ $booking->email }}</li>
        <li><strong>Phone:</strong> {{ $booking->phone ?? 'Not provided' }}</li>
        <li><strong>Booking Date:</strong> {{ $booking->formatted_date }}</li>
        <li><strong>Destination:</strong> {{ $booking->destination }}</li>
        <li><strong>Persons:</strong> {{ $booking->persons }}</li>
        <li><strong>Category:</strong> {{ $booking->category }}</li>
        @if($booking->special_request)
        <li><strong>Special Request:</strong> {{ $booking->special_request }}</li>
        @endif
    </ul>

    <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>

    <p>Our team will contact you within 24 hours to confirm your booking and provide further details.</p>

    <p>If you have any questions, please don't hesitate to contact us.</p>

    <p>Best regards,<br>
    North Trips & Travel Team</p>
</body>
</html>