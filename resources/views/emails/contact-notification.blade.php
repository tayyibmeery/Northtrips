<!DOCTYPE html>
<html>
<head>
    <title>New Contact Query</title>
</head>
<body>
    <h2>New Contact Query Received</h2>

    <div style="background: #f8f9fa; padding: 20px; border-radius: 5px;">
        <p><strong>Name:</strong> {{ $query->name }}</p>
        <p><strong>Email:</strong> {{ $query->email }}</p>
        <p><strong>Phone:</strong> {{ $query->phone ?? 'Not provided' }}</p>
        <p><strong>Subject:</strong> {{ $query->subject }}</p>
        <p><strong>Type:</strong> {{ ucfirst($query->type) }}</p>
        <p><strong>Submitted:</strong> {{ $query->created_at->format('F j, Y \a\t g:i A') }}</p>

        <div style="margin-top: 15px;">
            <strong>Message:</strong>
            <div style="background: white; padding: 15px; border-left: 4px solid #007bff; margin-top: 5px;">
                {{ $query->message }}
            </div>
        </div>
    </div>

    <p style="margin-top: 20px;">
        <a href="{{ url('/admin/contact-queries') }}" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            View in Admin Panel
        </a>
    </p>
</body>
</html>
