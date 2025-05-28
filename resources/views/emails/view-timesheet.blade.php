<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Timesheet</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="font-family: 'Space Grotesk', sans-serif; background: #fff; margin: 0; padding: 40px 10%; color: #000;">

<div id="main-content">
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
      <input type="hidden" name="consultant_dashboard_ids[]" class="consultant_dashboard_ids" value="{{ $record['id'] }}">
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
    <!-- <div style="width: 45%;">
      <strong>Approved By : </strong><br><br>
      <hr>
      <div><strong>Manager’s Name :</strong> Sarath Babu</div>
      <div><strong>Designation :</strong> Director</div>
      <div><strong>Date :</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
    </div> -->
  </div>

  <div style="font-size: 12px; margin-top: 30px;">
    <p><strong>LEGENDS</strong></p>
    <p><strong>PH:</strong> Public Holiday</p>
    <p><strong>ML:</strong> Medical Leave</p>
    <p><strong>AL:</strong> Annual Leave</p>
    <p><strong>UL:</strong> Unpaid Leave</p>
  </div>

  <div style="margin-top: 30px; text-align: center; font-size: 14px;">
    <p><strong>To approve/unapprove the timesheet, click a button below:</strong></p>
  </div>

  <div style="margin-top: 15px; display: flex; gap: 10px; justify-content: space-between;">
    <a href="javascript:void(0)" id="btnApprove"
   onclick="updateTimesheetStatus('Approved', this)"
   style="flex: 1; background: #28a745; color: #fff; padding: 15px; text-align: center; text-decoration: none; border-radius: 4px; font-weight: bold;">
   ✅ Approve
</a>
<a href="javascript:void(0)" id="btnReject"
   onclick="updateTimesheetStatus('Rejected', this)"
   style="flex: 1; background: #dc3545; color: #fff; padding: 15px; text-align: center; text-decoration: none; border-radius: 4px; font-weight: bold;">
   ❌ Reject
</a>
<a href="javascript:void(0)" id="btnRework"
   onclick="updateTimesheetStatus('Draft', this)"
   style="flex: 1; background: #ffc107; color: #000; padding: 15px; text-align: center; text-decoration: none; border-radius: 4px; font-weight: bold;">
   🔄 Rework
</a>

  </div>
</div>

<div id="thankyou-msg" style="display:none; text-align:center; margin-top: 100px;">
  <h2 style="color:#28a745; font-size: 28px;">Thank you for your submission!</h2>
  <p style="font-size:18px; margin-top: 10px;">Timesheet has been marked as <strong id="finalStatus"></strong>.</p>
  <p style="font-size:16px; margin-top: 5px;">A notification has been sent to the consultant.</p>
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

      const ids = [];
      $('.consultant_dashboard_ids').each(function () {
        ids.push($(this).val());
      });

      const selectedMonth = "{{ $selectedMonth }}";
      const selectedYear = "{{ $selectedYear }}";

      // Store and update clicked button only
      const originalHTML = clickedBtn.innerHTML;
      clickedBtn.innerHTML = '⏳ Submitting...';
      clickedBtn.setAttribute('data-original', originalHTML);

      // Disable all buttons
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

          // Re-enable all buttons
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