<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Claim Timesheet</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 40px 10%;
      background: #f8f9fa;
      color: #333;
    }
    h1, h2, h3 {
      color: #003366;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      padding: 8px;
      border: 1px solid #dee2e6;
      font-size: 14px;
      text-align: left;
    }
    th {
      background-color: #e9ecef;
    }
    .calendar-table td {
      height: 100px;
      vertical-align: top;
      padding: 6px;
    }
    .claim-block {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      padding: 2px;
      border: 1px solid #fff;
      background: #f1f1f1;
      margin-bottom: 2px;
    }
    .header-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .header-section .info {
      font-size: 14px;
    }
    .btn-group {
      display: flex;
      gap: 12px;
      margin-top: 20px;
    }
    .btn {
      flex: 1;
      padding: 15px;
      border-radius: 6px;
      text-align: center;
      font-weight: bold;
      text-decoration: none;
      cursor: pointer;
      transition: background 0.3s;
    }
    .btn-approve {
      background-color: #28a745;
      color: white;
    }
    .btn-reject {
      background-color: #dc3545;
      color: white;
    }
    .btn-rework {
      background-color: #ffc107;
      color: #212529;
    }
    .thankyou-msg {
      display: none;
      text-align: center;
      margin-top: 80px;
    }
    .thankyou-msg h2 {
      color: #28a745;
    }
  </style>
</head>
<body>
  <div id="main-content">
    <div class="header-section">
      <div>
        <h1>Harris J</h1>
      </div>
      <div class="info">
        <div><strong>Company Name:</strong> {{ $client->serving_client ?? 'N/A' }}</div>
        <div><strong>Consultancy Name:</strong> {{ $consultancy->name ?? 'N/A' }}</div>
        <div><strong>Form ID:</strong> {{ $parentFormId ?? 'N/A' }}</div>
      </div>
    </div>

    <h2>Timesheet</h2>
    <table>
      <tr>
        <td><strong>Staff Name:</strong></td>
        <td>{{ $consultant->emp_name ?? 'N/A' }}</td>
        <td><strong>For the Month/Year:</strong></td>
        <td>From {{ $firstMonth }} To {{ $lastMonth }}</td>
      </tr>
      <tr>
        <td><strong>Date of Submission:</strong></td>
        <td>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
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
     <input type="hidden" name="consultant_dashboard_ids[]" class="consultant_dashboard_ids" value="{{ $monthYear ?? '' }}">
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

      <h3>Claims Calendar - {{ $monthName }} {{ $year }}</h3>
      <table class="calendar-table">
        <thead>
          <tr>
            <th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th>
          </tr>
        </thead>
        <tbody>
          @foreach($calendar as $week)
            <tr>
              @foreach($week as $d)
                @php $claimData = $days[$d] ?? []; @endphp
                <td>
                  @if($d)
                    <div style="font-weight: bold; padding-bottom: 4px;">{{ $d }}</div>
                    @foreach($claimData as $claim)
                      <div class="claim-block" style="background: {{ $colorMap[$claim['type']] ?? '#ddd' }};">
                        {{ ucfirst($claim['type']) }}<br>₹{{ $claim['amount'] }}
                      </div>
                    @endforeach
                  @endif
                </td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    @endforeach

    <div class="btn-group">
      <a id="btnApprove" class="btn btn-approve" onclick="updateTimesheetStatus('Approved', this)">✅ Approve</a>
      <a id="btnReject" class="btn btn-reject" onclick="updateTimesheetStatus('Rejected', this)">❌ Reject</a>
      <a id="btnRework" class="btn btn-rework" onclick="updateTimesheetStatus('Draft', this)">🔄 Rework</a>
    </div>
  </div>

  <div class="thankyou-msg" id="thankyou-msg">
    <h2>Thank you for your submission!</h2>
    <p>Timesheet has been marked as <strong id="finalStatus"></strong>.</p>
    <p>A notification has been sent to the consultant.</p>
  </div>

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

    const token = "{{ $token }}";

    // ✅ Collect all month_year values from input fields
    const ids = Array.from(document.querySelectorAll('.consultant_dashboard_ids'))
      .map(input => input.value)
      .filter(Boolean); // Filter out empty strings just in case

    if (ids.length === 0) {
      Swal.fire("Error", "No claim data found for submission.", "error");
      return;
    }

    const originalHTML = clickedBtn.innerHTML;
    clickedBtn.innerHTML = '⏳ Submitting...';
    clickedBtn.setAttribute('data-original', originalHTML);

    const buttons = document.querySelectorAll('a[onclick^="updateTimesheetStatus"]');
    buttons.forEach(btn => {
      btn.style.opacity = '0.6';
      btn.style.pointerEvents = 'none';
    });

    $.ajax({
      url: "{{ url('/consultant/approve-sheet-claim/update-status') }}",
      method: "POST",
      data: {
        _token: "{{ csrf_token() }}",
        token: token,
        status: action,
        month_year: ids  // ✅ Sending month_year values
      },
      success: function () {
        $('#main-content').hide();
        $('#finalStatus').text(action);
        $('#thankyou-msg').show();
      },
      error: function () {
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
