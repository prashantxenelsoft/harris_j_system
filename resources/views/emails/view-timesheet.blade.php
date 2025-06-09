<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Claim Timesheet</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      font-family: 'Space Grotesk', sans-serif;
      background: linear-gradient(to bottom right, #f2f9ff, #e0f0ff);
      padding: 40px 10%;
      color: #000;
    }
    h1, h2 {
      color: #003366;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      background: #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
      border-radius: 8px;
      overflow: hidden;
    }
    th, td {
      padding: 8px;
      border: 1px solid #ccc;
      text-align: left;
    }
    th {
      background-color: #f1f1f1;
      font-weight: bold;
    }
    .button {
      padding: 15px;
      text-align: center;
      font-weight: bold;
      border-radius: 4px;
      text-decoration: none;
      flex: 1;
      transition: all 0.2s ease-in-out;
    }
    .button:hover {
      transform: scale(1.03);
    }
    .btn-green { background: #28a745; color: #fff; }
    .btn-red { background: #dc3545; color: #fff; }
    .btn-yellow { background: #ffc107; color: #000; }
    #thankyou-msg { display: none; text-align: center; margin-top: 100px; }
    #thankyou-msg h2 { color: #28a745; font-size: 28px; }
    #thankyou-msg p { font-size: 18px; }
    .calendar-cell { height: 100px; vertical-align: top; font-size: 12px; padding: 6px; border: 1px solid #dee2e6; }
    .calendar-cell strong { display: block; margin-bottom: 5px; }
    .calendar-entry { background: #e0ecff; margin-top: 4px; padding: 3px 5px; border-radius: 4px; }
  </style>
</head>
<body>

<div id="main-content">
  <div style="display: flex; justify-content: space-between; flex-wrap: wrap; align-items: center;">
    <h1 style="margin: 0;">Harris J</h1>
    <div style="font-size: 14px; text-align: right;">
      <div><strong>Company Name:</strong> {{ $client->serving_client ?? 'N/A' }}</div>
      <div style="margin-top: 10px;"><strong>Consultancy Name:</strong> {{ $consultancy->name ?? 'N/A' }}</div>
    </div>
  </div>

  <h2 style="margin: 30px 0 10px; font-weight: 400;">Timesheet</h2>

  <table style="margin-bottom: 20px;">
    <tr>
      <td><strong>Staff Name :</strong></td>
      <td>{{ $consultant->emp_name ?? 'N/A' }}</td>
      <td><strong>For the Month/ Year of :</strong></td>
      <td>{{ $selectedMonth }}/{{ $selectedYear }}</td>
    </tr>
    <tr>
      <td><strong>Date of Submission :</strong></td>
      <td>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
    </tr>
    <tr>
      <td style="font-style: italic; font-size: 12px;">(in dd/mm/yyyy)</td>
    </tr>
  </table>

@php
  $calculatedWorkingHours = 0;
  $totalExtraHours = 0;

  $parsedRecords = collect($dashboards)->map(function ($dashboard) {
      $record = json_decode($dashboard->record, true);
      $record['raw'] = $dashboard->record;
      $record['id'] = $dashboard->id;
      $record['applyOnCell'] = str_replace('\/', '/', $record['applyOnCell'] ?? '');
      $record['parsedDate'] = !empty($record['applyOnCell']) 
          ? \Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell']) 
          : null;
      return $record;
  });

  $recordsByDate = [];
  foreach ($parsedRecords as $rec) {
      if (!empty($rec['parsedDate'])) {
          $dateKey = $rec['parsedDate']->format('Y-m-d');
          $recordsByDate[$dateKey][] = $rec;
      }
  }

  $month = (int) $selectedMonth;
  $year = (int) $selectedYear;
  $startOfMonth = \Carbon\Carbon::create($year, $month, 1);
  $endOfMonth = $startOfMonth->copy()->endOfMonth();
@endphp

<table>
  <tr>
    <th>Day</th>
    <th>Date</th>
    <th>Leave Type</th>
    <th>Normal (H:MM)</th>
    <th>Overtime</th>
    <th>Remark</th>
  </tr>

  @for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay())
    @php
      $dateStr = $date->format('Y-m-d');
      $day = $date->format('D');
      $displayDate = $date->format('d / m / Y');
      $entries = $recordsByDate[$dateStr] ?? [];

      $leaveType = '-';
      $normalHours = '-';
      $overtime = '';
      $remarks = '-';
      $hiddenInput = '';

      if (!empty($entries)) {
        $entry = $entries[0]; // assuming one entry per day

        $leaveType = $entry['leaveType'] ?? '-';
        $remarks = $entry['remarks'] ?? '-';
        $workingHours = $entry['workingHours'] ?? null;

        if (is_numeric($workingHours)) {
          $wh = floatval($workingHours);
          $extra = $wh > 8 ? $wh - 8 : 0;
          $normal = $wh > 8 ? 8 : $wh;

          $normalHours = $normal;
          $calculatedWorkingHours += $normal;
          if ($extra > 0) {
            $overtime = '+' . $extra . 'h';
            $totalExtraHours += $extra;
          }
        }

        // only add hidden input if entry has id
        if (!empty($entry['id'])) {
          $hiddenInput = '<input type="hidden" name="consultant_dashboard_ids[]" class="consultant_dashboard_ids" value="' . $entry['id'] . '">';
        }
      }

      $rowStyle = in_array($day, ['Sat', 'Sun']) ? 'background-color: #e5e5e5;' : '';
    @endphp

    <tr style="{{ $rowStyle }}">
      {!! $hiddenInput !!}
      <td>{{ $day }}</td>
      <td>{{ $displayDate }}</td>
      <td>{{ $leaveType }}</td>
      <td>{{ $normalHours }}</td>
      <td>{{ $overtime }}</td>
      <td>{{ $remarks }}</td>
    </tr>
  @endfor

  <tr>
    <td colspan="3"><strong>Total Hours</strong></td>
    <td><strong>{{ $calculatedWorkingHours }}h</strong></td>
    <td><strong>{{ $totalExtraHours }}h</strong></td>
    <td></td>
  </tr>
</table>





<div class="mt-5">
  <h4 class="text-primary mb-3">Calendar View ({{ $selectedMonth }}/{{ $selectedYear }})</h4>
  @php
    $month = (int) $selectedMonth;
    $year = (int) $selectedYear;
    $startOfMonth = \Carbon\Carbon::create($year, $month, 1);
    $endOfMonth = $startOfMonth->copy()->endOfMonth();
    $daysInMonth = $startOfMonth->daysInMonth;
    $firstDayOfWeek = ($startOfMonth->dayOfWeek + 1) % 7;
    $firstDayOfWeek = $firstDayOfWeek == 0 ? 7 : $firstDayOfWeek;
    $totalCells = $daysInMonth + ($firstDayOfWeek - 1);
    $recordsByDate = [];
    $totalExtraHours = 0;
    foreach ($parsedRecords as $record) {
        if (!empty($record['parsedDate'])) {
            $key = $record['parsedDate']->format('Y-m-d');
            $recordsByDate[$key][] = $record;
        }
    }
  @endphp

  <table class="table table-bordered">
    <thead class="table-dark text-center">
      <tr>
        @foreach (["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"] as $day)
          <th>{{ $day }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @for ($i = 0; $i < $totalCells; $i++)
        @php
          $date = $startOfMonth->copy()->startOfMonth()->addDays($i - ($firstDayOfWeek - 1));
          $inMonth = $date->month == $month;
          $entries = $inMonth ? ($recordsByDate[$date->format('Y-m-d')] ?? []) : [];
          $dayOfWeek = $i % 7;
          $isWeekend = $dayOfWeek == 0 || $dayOfWeek == 6;
        @endphp

        @if ($i % 7 == 0)
          <tr>
        @endif

        <td class="calendar-cell {{ !$inMonth ? 'bg-light text-muted' : '' }}" style="{{ in_array($dayOfWeek, [0, 6]) ? 'background-color: #cccccc;' : '' }}">

          @if ($inMonth)
            <strong>{{ $date->day }}</strong>
            @foreach ($entries as $entry)
              <div class="calendar-entry">
                @if (!empty($entry['leaveType']))
                  <div><strong>Leave:</strong> {{ $entry['leaveType'] }}</div>
                  @if (!empty($entry['leaveHour']))
                    <div><strong>Hours:</strong> {{ $entry['leaveHour'] }}</div>
                  @endif
                @elseif (!empty($entry['workingHours']))
                  <div><strong>Worked:</strong> {{ $entry['workingHours'] }}h</div>
                  @php
                    $extra = floatval($entry['workingHours']) - 8;
                    if ($extra > 0) {
                        $totalExtraHours += $extra;
                        echo '<div><strong>Extra:</strong> +' . $extra . 'h</div>';
                    }
                  @endphp
                @endif
              </div>
            @endforeach
          @endif
        </td>

        @if ($i % 7 == 6)
          </tr>
        @endif
      @endfor
    </tbody>
  </table>

  <div class="mt-3">
    <strong>Total Extra Hours:</strong> {{ $totalExtraHours }}h
  </div>
</div>



  <div style="margin-top: 15px; font-size: 16px; font-weight: bold;">
    Working Hours Normal: {{ $calculatedWorkingHours }} Hours
  </div>

  <div style="margin-top: 15px; font-size: 16px; font-weight: bold;">
    Total Working Hours (Calculated): {{ $calculatedWorkingHours+$totalExtraHours }} Hours
  </div>



  <div style="margin-top: 40px; font-size: 14px;">
    <strong>Submitted By :</strong> {{ $consultant->emp_name ?? 'N/A' }}<br><br>
    <hr>
    <div><strong>Name :</strong> {{ $consultant->emp_name ?? 'N/A' }}</div>
    <div><strong>Date :</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
  </div>

  <div style="font-size: 12px; margin-top: 30px;">
    <p><strong>LEGENDS</strong></p>
    <p><strong>PH:</strong> Public Holiday</p>
    <p><strong>ML:</strong> Medical Leave</p>
    <p><strong>AL:</strong> Annual Leave</p>
    <p><strong>UL:</strong> Unpaid Leave</p>
    <p><strong>PDO:</strong> Paid Leave</p>
  </div>

  <div style="margin-top: 30px; text-align: center; font-size: 14px;">
    <p><strong>To approve/unapprove the timesheet, click a button below:</strong></p>
  </div>

  <div style="margin-top: 15px; display: flex; gap: 10px; justify-content: space-between;">
    <a href="javascript:void(0)" id="btnApprove" onclick="updateTimesheetStatus('Approved', this)" class="button btn-green">✅ Approve</a>
    <a href="javascript:void(0)" id="btnReject" onclick="updateTimesheetStatus('Rejected', this)" class="button btn-red">❌ Reject</a>
    <a href="javascript:void(0)" id="btnRework" onclick="updateTimesheetStatus('Draft', this)" class="button btn-yellow">🔄 Rework</a>
  </div>
</div>

<div id="thankyou-msg">
  <h2>Thank you for your submission!</h2>
  <p>Timesheet has been marked as <strong id="finalStatus"></strong>.</p>
  <p>A notification has been sent to the consultant.</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function updateTimesheetStatus(action, clickedBtn) {
    Swal.fire({
      title: `Are you sure you want to mark this timesheet as ${action}?`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, confirm',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (!result.isConfirmed) return;

      const ids = [];
      $('.consultant_dashboard_ids').each(function () {
        ids.push($(this).val());
      });

      const selectedMonth = "{{ $selectedMonth }}";
      const selectedYear = "{{ $selectedYear }}";

      const originalHTML = clickedBtn.innerHTML;
      clickedBtn.innerHTML = '⏳ Submitting...';
      clickedBtn.setAttribute('data-original', originalHTML);

      const buttons = document.querySelectorAll('a[onclick^="updateTimesheetStatus"]');
      buttons.forEach(btn => {
        btn.style.opacity = '0.6';
        btn.style.pointerEvents = 'none';
      });

      $.ajax({
        url: "{{ url('/consultant/approve-sheet/update-status') }}",
        method: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          ids: ids,
          token: "{{ $token }}",
          status: action,
          month: selectedMonth,
          year: selectedYear
        },
        success: function (res) {
          $('#main-content').hide();
          $('#finalStatus').text(action);
          $('#thankyou-msg').show();
        },
        error: function (err) {
          Swal.fire('Error', 'Something went wrong.', 'error');
          buttons.forEach(btn => {
            const original = btn.getAttribute('data-original');
            if (original) btn.innerHTML = original;
            btn.style.opacity = '1';
            btn.style.pointerEvents = 'auto';
          });
        }
      });
    });
  }
</script>

</body>
</html>
