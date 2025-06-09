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

  <!-- Header Section -->
  <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
    <div style="font-size: 14px; text-align: left;">
      <div><strong>Company Name:</strong> {{ $client->serving_client ?? 'N/A' }}</div>
      <div style="margin-top: 10px;"><strong>Consultancy Name:</strong> {{ $consultancy->name ?? 'N/A' }}</div>
    </div>
  </div>

  <!-- Title -->
  <h2 style="font-family: 'Montserrat', sans-serif; font-size: 26px; margin: 30px 0 10px; font-weight: 400;">Timesheet</h2>

  <!-- Info Table -->
  <table style="width: 100%; margin-bottom: 10px; font-size: 14px;">
    <tr>
      <td style="padding: 4px 8px; font-weight: bold;">Staff Name :</td>
      <td style="padding: 4px 8px;">{{ $consultant->emp_name ?? 'N/A' }}</td>
      <td style="padding: 4px 8px; font-weight: bold;">For the Month/Year :</td>
      <td style="padding: 4px 8px;">{{ $selectedMonth }}/{{ $selectedYear }}</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px; font-weight: bold;">Submission Date :</td>
      <td style="padding: 4px 8px;">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px; font-style: italic; font-size: 12px;">(Format: dd/mm/yyyy)</td>
    </tr>
  </table>

  <!-- Backend Logic for Records -->
  @php
    use Carbon\Carbon;
    use Carbon\CarbonPeriod;

    $calculatedWorkingHours = 0;
    $leaveOnlyRecords = [];
    $parsedRecords = collect($dashboards)->map(function ($dashboard) {
        $record = json_decode($dashboard->record, true);
       $record['applyOnCell'] = str_replace('\/', '/', $record['applyOnCell'] ?? '');
$record['parsedDate'] = !empty($record['applyOnCell']) 
    ? Carbon::createFromFormat('d / m / Y', $record['applyOnCell']) 
    : null;
return $record;
    })->sortBy('parsedDate');

    foreach ($parsedRecords as $record) {
        if (!empty($record['workingHours']) && is_numeric($record['workingHours'])) {
            $calculatedWorkingHours += floatval($record['workingHours']);
        }
        if (!empty($record['leaveType'])) {
            $leaveOnlyRecords[] = $record;
        }
    }

    $month = (int) $selectedMonth;
    $year = (int) $selectedYear;
    $startOfMonth = Carbon::create($year, $month, 1);
    $endOfMonth = $startOfMonth->copy()->endOfMonth();
    $period = CarbonPeriod::create($startOfMonth, $endOfMonth);
    $weekdays = collect($period)->filter(fn($date) => !$date->isWeekend())->count();
    $forecastHours = $weekdays * 8;
  @endphp

  <!-- Leave Table -->
  <table style="width: 100%; border-collapse: collapse; font-size: 14px; margin-top: 20px;">
    <thead>
      <tr>
        <th style="border: 1px solid #000; padding: 6px; background: #f1f1f1;">From To Date</th>
        <th style="border: 1px solid #000; padding: 6px; background: #f1f1f1;">Leave Type</th>
        <th style="border: 1px solid #000; padding: 6px; background: #f1f1f1;">Leave</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($leaveOnlyRecords as $record)
        <tr>
          <td style="border: 1px solid #000; padding: 6px;">
  @if (!empty($record['date']))
    {{ $record['date'] }}
  @elseif (!empty($record['applyOnCell']))
    {{ \Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell'])->format('d/m/Y') }}
  @else
    -
  @endif
</td>
          <td style="border: 1px solid #000; padding: 6px;">{{ $record['leaveType'] ?? '-' }}</td>
          <td style="border: 1px solid #000; padding: 6px;">{{ $record['leaveHour'] ?? '-' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Summary Card -->
  <div style="display: flex; gap: 20px; margin-top: 30px; flex-wrap: wrap;">
    <div style="flex: 1; min-width: 280px; border: 1px solid #ccc; padding: 20px; border-radius: 8px; background: #f9f9f9;">
      <h3 style="margin-top: 0; color: #003366;">Total Working Hours</h3>
      <p><strong>Total Logged Hours:</strong> {{ $calculatedWorkingHours }} hours</p>
      <p><strong>Forecast Hours (Weekdays × 8h):</strong> {{ $forecastHours }} hours</p>
      <p style="font-size: 13px; color: #666;">Based on weekdays from {{ $startOfMonth->format('d M Y') }} to {{ $endOfMonth->format('d M Y') }}</p>
    </div>
  </div>

  @php
  $daysInMonth = $startOfMonth->daysInMonth;
  $recordsByDate = [];
  foreach ($parsedRecords as $record) {
      if (!empty($record['parsedDate'])) {
          $key = $record['parsedDate']->format('Y-m-d');
          $recordsByDate[$key][] = $record;
      }
  }
  $firstDayOfWeek = $startOfMonth->copy()->startOfMonth()->dayOfWeekIso; // 1=Mon to 7=Sun
  $totalCells = ceil(($daysInMonth + $firstDayOfWeek - 1) / 7) * 7;
@endphp

<div style="margin-top: 40px;">
  <h3 style="color: #003366;">Monthly Calendar View ({{ $startOfMonth->format('F Y') }})</h3>
 <table style="width: 100%; border-collapse: collapse; font-size: 13px; border: 1px solid #ccc; margin-top: 40px;">
  <thead>
    <tr style="background: #003366; color: #fff; text-align: center;">
      @foreach (['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $dayName)
        <th style="width: 14.28%; padding: 8px; border: 1px solid #fff;">{{ $dayName }}</th>
      @endforeach
    </tr>
  </thead>
  <tbody>
    @for ($i = 1; $i <= $totalCells; $i++)
      @php
        $cellDate = $startOfMonth->copy()->startOfMonth()->addDays($i - $firstDayOfWeek);
        $inMonth = $cellDate->month === $month;
        $entries = $recordsByDate[$cellDate->format('Y-m-d')] ?? [];
        $dayNum = $cellDate->day;
      @endphp

      @if (($i - 1) % 7 == 0)
        <tr>
      @endif

      <td style="width: 14.28%; vertical-align: top; border: 1px solid #ccc; padding: 6px; background: {{ $inMonth ? '#fff' : '#f1f1f1' }};">
        <div style="font-weight: bold; color: #003366;">{{ $dayNum }}</div>
        @foreach ($entries as $entry)
          <div style="margin-top: 4px; background: #e0ecff; padding: 3px 5px; border-radius: 4px;">
            @if (!empty($entry['leaveType']))
              <div><strong>Leave:</strong> {{ $entry['leaveType'] }}</div>
              <div><strong>Hours:</strong> {{ $entry['leaveHour'] ?? '-' }}</div>
            @elseif (!empty($entry['workingHours']))
              <div><strong>Worked:</strong> {{ $entry['workingHours'] }}h</div>
            @endif
          </div>
        @endforeach
      </td>

      @if ($i % 7 == 0)
        </tr>
      @endif
    @endfor
  </tbody>
</table>

</div>

  <!-- Manager Instructions -->
  <div style="margin-top: 40px; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: #f9f9f9;">
    <h3 style="margin-top: 0; color: #003366;">Instructions for Reporting Manager</h3>
    <ul style="padding-left: 18px; font-size: 14px; line-height: 1.8;">
      <li><strong>Approve:</strong> Click the <span style="color: green; font-weight: bold;">Approve</span> button if the timesheet is accurate.</li>
      <li><strong>Decline/Reject:</strong> Use <span style="color: red; font-weight: bold;">Reject</span> for inaccurate submissions.</li>
      <li><strong>Rework:</strong> Send back for minor corrections using <span style="color: orange; font-weight: bold;">Rework</span>.</li>
    </ul>
    <p style="margin-top: 12px; font-size: 13px; color: #555;">Actions notify the consultant via email and update the system status. Please review all data before proceeding.</p>
  </div>

  <!-- Footer -->
  <div style="display: flex; justify-content: space-between; flex-wrap: wrap; margin-top: 40px; font-size: 14px;">
    <div style="width: 45%;">
      <strong>Submitted By : {{ $consultant->emp_name ?? 'N/A' }}</strong><br><br>
      <hr>
      <div><strong>Name :</strong> {{ $consultant->emp_name ?? 'N/A' }}</div>
      <div><strong>Date :</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
    </div>
    <div style="width: 45%;">
      <div><strong>Date :</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
    </div>
  </div>

  <!-- Legends -->
  <div style="font-size: 12px; margin-top: 30px;">
    <p><strong>LEGENDS</strong></p>
    <p><strong>PH:</strong> Public Holiday</p>
    <p><strong>ML:</strong> Medical Leave</p>
    <p><strong>AL:</strong> Annual Leave</p>
    <p><strong>UL:</strong> Unpaid Leave</p>
  </div>

  <!-- Approval Link -->
  @if(empty($isPdf))
  <div style="margin-top: 30px; text-align: center; font-size: 14px;">
    <p><strong>To approve/unapprove the timesheet, click the link below:</strong></p>
    <p>
      <a href="{{ url('/consultant/approve-sheet/' . $token) }}" target="_blank" style="color: #003366; text-decoration: underline;">
        {{ url('/consultant/approve-sheet/' . $token) }}
      </a>
    </p>
  </div>
  @endif

</body>
</html>