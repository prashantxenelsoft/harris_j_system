<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invalid Access - Harris J System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body style="margin: 0; padding: 0; background-color: #f7f9fc; font-family: 'Poppins', sans-serif;">

  <div style="max-width: 600px; margin: 100px auto; background-color: #fff; border-radius: 12px; box-shadow: 0 0 20px rgba(0,0,0,0.05); padding: 40px; text-align: center;">
    
    <img src="https://cdn-icons-png.flaticon.com/512/463/463612.png" alt="Error" width="80" style="margin-bottom: 20px;">

    <h1 style="color: #dc3545; font-size: 28px; margin-bottom: 10px;">Invalid or Expired Link</h1>
    
    <p style="color: #333; font-size: 16px; margin-bottom: 30px;">
      {{ $errorMessage ?? 'The token you used is either invalid, expired, or has already been processed.' }}
    </p>


    <p style="margin-top: 25px; font-size: 14px; color: #777;">
      If you think this is a mistake, please contact <strong>Harris J System</strong> support.
    </p>
  </div>

</body>
</html>
