<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Claim Timesheet</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <style>
    @page {
      margin: 10px 15px;
    }
    body {
      font-size: 11px;
      font-family: DejaVu Sans, sans-serif;
      line-height: 1.4;
      color: #000;
    }
    table.calendar-table {
      width: 100%;
      border-collapse: collapse;
      text-align: center;
      font-size: 11px;
      table-layout: fixed;
      margin-bottom: 20px;
      page-break-inside: avoid;
    }
    table.calendar-table th, table.calendar-table td {
      border: 1px solid #ccc;
      vertical-align: top;
      height: 25px;
      padding: 4px;
    }
    table.calendar-table th {
      background: #f0f0f0;
    }
    .calendar-wrapper {
      page-break-inside: avoid;
      margin-bottom: 50px;
    }
    .instructions-block {
      margin-top: 30px;
      padding: 18px;
      border: 1px solid #ccc;
      border-radius: 8px;
      background: #f9f9f9;
      page-break-inside: avoid;
    }
  </style>
</head>
<body style="margin: 0; padding: 40px 10%;">
@php
  // Extract parent_form_id from the first available dashboard record
  $formId = 'N/A';
  if (!empty($dashboards) && count($dashboards)) {
      $formId = $dashboards[0]->parent_form_id ?? 'N/A';
  }
@endphp
  <!-- Header -->
  <div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
    <div style="font-size: 14px; text-align: left;">
      <div><strong>Company Name:</strong> {{ $client->serving_client ?? 'N/A' }}</div>
      <div style="margin-top: 10px;"><strong>Consultancy Name:</strong> {{ $consultancy->name ?? 'N/A' }}</div>
        <div style="margin-top: 10px;"><strong>Form ID:</strong> {{ $formId }}</div>
    </div>
  </div>

  <h2 style="font-family: 'Montserrat', sans-serif; font-size: 22px; margin: 30px 0 10px; font-weight: 400;">Claim Timesheet</h2>

  @php
    $allMonthYears = array_keys($claimsByMonth);
    sort($allMonthYears);
    $rangeFrom = $rangeTo = 'N/A';
    if (!empty($allMonthYears)) {
      $first = \Carbon\Carbon::createFromFormat('m_Y', $allMonthYears[0]);
      $last = \Carbon\Carbon::createFromFormat('m_Y', end($allMonthYears));
      $rangeFrom = $first->format('F Y');
      $rangeTo = $last->format('F Y');
    }
  @endphp

  <table style="width: 100%; margin-bottom: 20px; font-size: 13px;">
    <tr>
      <td style="padding: 4px 8px; font-weight: bold;">Staff Name :</td>
      <td style="padding: 4px 8px;">{{ $consultant->emp_name ?? 'N/A' }}</td>
      <td style="padding: 4px 8px; font-weight: bold;">For the Month/Year :</td>
      <td style="padding: 4px 8px;">{{ $rangeFrom }} - {{ $rangeTo }}</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px; font-weight: bold;">Submission Date :</td>
      <td style="padding: 4px 8px;">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
    </tr>
    <tr>
      <td style="padding: 4px 8px; font-style: italic; font-size: 12px;">(Format: dd/mm/yyyy)</td>
    </tr>
  </table>

  @php
    $colorMap = [
      'taxi' => '#e6f3ef',
      'dining' => '#fceeee',
      'others' => '#ff9c1a',
    ];
  @endphp

  @foreach($claimsByMonth as $monthYear => $days)
    @php
      [$month, $year] = explode('_', $monthYear);
      $monthName = \Carbon\Carbon::createFromDate($year, $month, 1)->format('F');
      $start = \Carbon\Carbon::create($year, $month, 1);
      $startDay = $start->dayOfWeekIso;
      $totalDays = $start->daysInMonth;

      $calendar = [];
      $week = array_fill(0, 7, '');
      $day = 1;

      for ($i = $startDay - 1; $i < 7; $i++) $week[$i] = $day++;
      $calendar[] = $week;

      while ($day <= $totalDays) {
        $week = array_fill(0, 7, '');
        for ($i = 0; $i < 7 && $day <= $totalDays; $i++) $week[$i] = $day++;
        $calendar[] = $week;
      }
    @endphp

    <div class="calendar-wrapper">
      <h3 style="margin-top: 30px;">Claims Calendar - {{ $monthName }} {{ $year }}</h3>
      <table class="calendar-table">
        <thead>
          <tr>
            <th>Mon</th><th>Tue</th><th>Wed</th>
            <th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th>
          </tr>
        </thead>
        <tbody>
          @foreach($calendar as $week)
            <tr>
              @foreach($week as $d)
                @php $claimData = $days[$d] ?? []; @endphp
                <td>
                  @if($d)
                    <div style="font-weight: bold; margin-bottom: 5px;">{{ $d }}</div>
                    @if(count($claimData))
                      <table width="100%" cellpadding="2" cellspacing="0" border="0">
                        @foreach($claimData as $claim)
                          <tr>
                            <td style="background-color: {{ $colorMap[$claim['type']] ?? '#ddd' }}; padding: 3px; text-align: center; font-size: 11px;">
                              {{ ucfirst($claim['type']) }}<br>₹{{ $claim['amount'] }}
                            </td>
                          </tr>
                        @endforeach
                      </table>
                    @endif
                  @endif
                </td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endforeach

  <!-- Instructions -->
  <div class="instructions-block">
    <h3 style="margin-top: 0; color: #003366;">Instructions for Reporting Manager</h3>
    <ul style="padding-left: 18px; font-size: 13px; line-height: 1.7;">
      <li><strong>Approve:</strong> Click the <span style="color: green; font-weight: bold;">Approve</span> button if the timesheet is accurate.</li>
      <li><strong>Decline/Reject:</strong> Use <span style="color: red; font-weight: bold;">Reject</span> for inaccurate submissions.</li>
      <li><strong>Rework:</strong> Send back for minor corrections using <span style="color: orange; font-weight: bold;">Rework</span>.</li>
    </ul>
    <p style="margin-top: 12px; font-size: 13px; color: #555;">Actions notify the consultant via email and update the system status.</p>
  </div>

  <!-- Footer -->
  <div style="display: flex; justify-content: space-between; flex-wrap: wrap; margin-top: 30px; font-size: 13px;">
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

  @if(empty($isPdf))
    <div style="margin-top: 30px; text-align: center; font-size: 13px;">
      <p><strong>To approve/unapprove the claim timesheet, click the link below:</strong></p>
      <p>
        <a href="{{ url('/consultant/approve-sheet-claim/' . $token) }}" target="_blank" style="color: #003366; text-decoration: underline;">
          {{ url('/consultant/approve-sheet-claim/' . $token) }}
        </a>
      </p>
    </div>
  @endif

</body>
</html>
