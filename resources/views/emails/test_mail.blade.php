<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>
    <h2>Hello, {{ $data['name'] }}</h2>
    <p>{{ $data['message'] }}</p>

    <p>Click the button below to visit the link:</p>
    <a href="{{ $data['url'] }}" style="display: inline-block; padding: 10px 20px; background: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Visit Now</a>

    <p>Or copy and paste this URL into your browser:</p>
    <p><a href="{{ $data['url'] }}">{{ $data['url'] }}</a></p>

    <p>Thank you,</p>
    <p><strong>{{ env('MAIL_FROM_NAME') }}</strong></p>
</body>
</html>
