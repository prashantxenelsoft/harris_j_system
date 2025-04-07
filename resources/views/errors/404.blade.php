<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            text-align: center;
            padding: 50px;
        }
        .error-container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }
        .error-code {
            font-size: 100px;
            font-weight: bold;
            color: #dc3545;
            margin: 0;
        }
        .error-message {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
            color: #333;
        }
        .error-description {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <div class="error-container">
        <img src="{{ asset('assets/latest/images/logo.png') }}" style="width: 120px; margin-bottom: 20px;" alt="Logo">
        <h1 class="error-code">404</h1>
        <p class="error-message">Oops! Page Not Found</p>
        <p class="error-description">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
        <!-- <a href="{{ route('admin.dashboard') }}" class="btn">Go to Dashboard</a> -->
    </div>

</body>
</html>
