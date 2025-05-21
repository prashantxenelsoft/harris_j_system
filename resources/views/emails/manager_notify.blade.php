<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Timesheet Submission Notification</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <h2 style="color: #003366;">Timesheet Submission Notification</h2>

    <p>Dear Manager,</p>

    <p>
        This is to inform you that <strong>{{ $consultant->emp_name }}</strong> has successfully submitted their timesheet for the month of <strong>{{ $selectedMonth }}/{{ $selectedYear }}</strong>.
    </p>

    <p>
        Kindly review the timesheet and take the appropriate action by approving, rejecting, or requesting rework.
    </p>

    <p>
        You can review the submission and take action through the following link:
    </p>

    <p>
        <a href="{{ url('/consultant/approve-sheet/' . $token) }}" style="color: #003366;">
            {{ url('/consultant/approve-sheet/' . $token) }}
        </a>
    </p>

    <p>
        The full timesheet has also been attached to this email for your convenience.
    </p>

    <p>Regards,<br>Harris J System</p>
</body>
</html>
