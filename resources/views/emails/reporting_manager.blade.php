<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Timesheet</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Space Grotesk', sans-serif; background: #fff; margin: 0; padding: 40px 10%; color: #000;">
  <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
    <h1 style="font-size: 24px; color: #003366; margin: 0;">Harris J</h1>
    <div style="font-size: 14px; text-align: right;">
      <div><strong>Company Name:</strong> {{ $client->serving_client ?? 'N/A' }}</div>
      <div style="margin-top: 10px;"><strong>Consultancy Name:</strong> {{ $consultancy->name ?? 'N/A' }}</div>
    </div>
  </div>

  <h2 style="font-family: 'Montserrat', sans-serif; font-size: 26px; margin: 30px 0 10px; font-weight: 400;">Timesheet</h2>

  <table style="width: 100%; margin-bottom: 10px; font-size: 14px;">
    <tr>
      <td style="padding: 4px 8px; font-weight: bold;">Staff Name :</td>
      <td style="padding: 4px 8px;">{{ $consultant->emp_name ?? 'N/A' }}</td>
      <td style="padding: 4px 8px; font-weight: bold;">For the Month/ Year of :</td>
      <td style="padding: 4px 8px;">{{ $selectedMonth }}/{{ $selectedYear }}</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px; font-weight: bold;">Date of Submission :</td>
      <td style="padding: 4px 8px;">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px; font-style: italic; font-size: 12px;">(in dd/mm/yyyy)</td>
    </tr>
  </table>

  @php
    $calculatedWorkingHours = 0;
    $parsedRecords = collect($dashboards)->map(function ($dashboard) {
        $record = json_decode($dashboard->record, true);
        $record['raw'] = $dashboard->record;
        $record['id'] = $dashboard->id;
        $record['applyOnCell'] = str_replace('\/', '/', $record['applyOnCell'] ?? '');
        $record['parsedDate'] = !empty($record['applyOnCell']) 
            ? \Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell']) 
            : null;
        return $record;
    })->sortBy('parsedDate');
  @endphp

  <table style="width: 100%; border-collapse: collapse; font-size: 14px; margin-top: 20px;">
    <tr>
      <th style="border: 1px solid #000; padding: 6px; background: #f1f1f1;">Day</th>
      <th style="border: 1px solid #000; padding: 6px; background: #f1f1f1;">Date</th>
      <th style="border: 1px solid #000; padding: 6px; background: #f1f1f1;">Time In</th>
      <th style="border: 1px solid #000; padding: 6px; background: #f1f1f1;">Time Out</th>
      <th style="border: 1px solid #000; padding: 6px; background: #f1f1f1;">Leave Type</th>
      <th style="border: 1px solid #000; padding: 6px; background: #f1f1f1;">Normal (H:MM)</th>
      <th style="border: 1px solid #000; padding: 6px; background: #f1f1f1;">Overtime</th>
      <th style="border: 1px solid #000; padding: 6px; background: #f1f1f1;">Remark</th>
    </tr>
    @foreach ($parsedRecords as $record)
      @php
        $applyOnCell = $record['applyOnCell'] ?? '-';
        $workingHours = $record['workingHours'] ?? '';
        $leaveType = $record['leaveType'] ?? '';
        $remarks = $record['remarks'] ?? '';
        $inTime = $record['inTime'] ?? '';
        $outTime = $record['outTime'] ?? '';
        $day = $record['parsedDate'] ? $record['parsedDate']->format('D') : '-';
        if (is_numeric($workingHours)) {
          $calculatedWorkingHours += floatval($workingHours);
        }
      @endphp
      <tr>
        <td style="border: 1px solid #000; padding: 6px;">{{ $day }}</td>
        <td style="border: 1px solid #000; padding: 6px;">{{ $applyOnCell }}</td>
        <td style="border: 1px solid #000; padding: 6px;">{{ $inTime ?: '-' }}</td>
        <td style="border: 1px solid #000; padding: 6px;">{{ $outTime ?: '-' }}</td>
        <td style="border: 1px solid #000; padding: 6px;">{{ $leaveType ?: '-' }}</td>
        <td style="border: 1px solid #000; padding: 6px;">{{ $workingHours ?: '-' }}</td>
        <td style="border: 1px solid #000; padding: 6px;"></td>
        <td style="border: 1px solid #000; padding: 6px;">{{ $remarks ?: '-' }}</td>
      </tr>
    @endforeach
    <tr>
      <td colspan="5" style="border: 1px solid #000; padding: 6px; font-weight: bold;">Total Hours</td>
      <td style="border: 1px solid #000; padding: 6px; font-weight: bold;">{{ $calculatedWorkingHours }}:00</td>
      <td style="border: 1px solid #000;"></td>
      <td style="border: 1px solid #000;"></td>
    </tr>
  </table>

  <div style="margin-top: 15px; font-size: 16px; font-weight: bold;">
    Total Working Hours (Calculated): {{ $calculatedWorkingHours }} Hours
  </div>

  <div style="display: flex; justify-content: space-between; flex-wrap: wrap; margin-top: 40px; font-size: 14px;">
    <div style="width: 45%;">
      <strong>Submitted By : {{ $consultant->emp_name ?? 'N/A' }}</strong><br><br>
      <hr>
      <div><strong>Name :</strong> {{ $consultant->emp_name ?? 'N/A' }}</div>
      <div><strong>Date :</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
    </div>
   
  </div>

  <div style="font-size: 12px; margin-top: 30px;">
    <p><strong>LEGENDS</strong></p>
    <p><strong>PH:</strong> Public Holiday</p>
    <p><strong>ML:</strong> Medical Leave</p>
    <p><strong>AL:</strong> Annual Leave</p>
    <p><strong>UL:</strong> Unpaid Leave</p>
  </div>

  @if(empty($isPdf))
  <div style="margin-top: 30px; text-align: center; font-size: 14px;">
    <p><strong>To approve/unapprove the timesheet, click on the link below:</strong></p>
    <p>
      <a href="{{ url('/consultant/approve-sheet/' . $token) }}" target="_blank" style="color: #003366; text-decoration: underline;">
        {{ url('/consultant/approve-sheet/' . $token) }}
      </a>
    </p>
  </div>
@endif

</body>
</html>