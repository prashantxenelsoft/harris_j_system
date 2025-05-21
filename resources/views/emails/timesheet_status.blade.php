<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Timesheet Status Update</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">

  <div style="max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); border: 1px solid #e0e0e0;">
    
    <div style="background-color: #003366; padding: 20px; color: #ffffff;">
      <h2 style="margin: 0;">Harris J System</h2>
    </div>

    <div style="padding: 30px;">
      <p style="font-size: 16px; margin-bottom: 20px;">Dear <strong>{{ $name }}</strong>,</p>

      <p style="font-size: 15px; line-height: 1.6;">
        We would like to inform you that your <strong>timesheet</strong> has been updated and is now marked as:
        <span style="display: inline-block; background-color: #f1f1f1; padding: 6px 12px; border-radius: 4px; font-weight: bold; color: #003366;">
          {{ $status }}
        </span>
      </p>

      <p style="font-size: 15px; line-height: 1.6; margin-top: 20px;">
        Please log in to your account to review the details and take any necessary action.
      </p>


    </div>

    <div style="background-color: #f7f7f7; padding: 20px; text-align: center; font-size: 12px; color: #777;">
      © {{ date('Y') }} Harris J System. All rights reserved.
    </div>
  </div>

</body>
</html>
