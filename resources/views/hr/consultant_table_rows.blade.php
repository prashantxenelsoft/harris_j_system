<tbody>
@if ($consultants->isEmpty())
    <tr>
        <td colspan="8" class="text-center text-muted">Consultant not found for this client</td>
    </tr>
@else
    @foreach ($consultants as $consultant)
        @php
            $userData = $dashboardData[$consultant->user_id] ?? collect();

            $totalLogged = 0;
            $used = ['AL' => 0, 'ML' => 0, 'UL' => 0, 'PDO' => 0, 'Comp Off' => 0];

            // Only filter hours for selected month
            $forecastedHours = 0;
            if ($month && $year) {
                $start = Carbon\Carbon::create($year, $month, 1);
                $end = $start->copy()->endOfMonth();
                $workingDays = 0;
                while ($start->lte($end)) {
                    if (!$start->isWeekend()) $workingDays++;
                    $start->addDay();
                }
                $forecastedHours = $workingDays * 8;
            }

            foreach ($userData as $entry) {
                $record = json_decode($entry->record ?? '{}', true);
                if (!$record) continue;

                $leaveRaw = strtoupper(trim($record['leaveType'] ?? ''));
                $hourId = $record['leaveHourId'] ?? '';
                $applyOnCell = trim($record['applyOnCell'] ?? '');
                $dateRange = trim($record['date'] ?? '');
                $workingHours = isset($record['workingHours']) && is_numeric($record['workingHours']) ? floatval($record['workingHours']) : 0;

                $perDayValue = in_array($hourId, ['fHalfDay', 'sHalfDay']) ? 0.5 : 1;

                if (Str::contains($leaveRaw, 'AL')) $used['AL'] += $perDayValue;
                if (Str::contains($leaveRaw, 'ML')) $used['ML'] += $perDayValue;
                if (Str::contains($leaveRaw, 'PDO')) $used['PDO'] += $perDayValue;
                if (Str::contains($leaveRaw, 'UL')) $used['UL'] += $perDayValue;

                if (Str::contains($leaveRaw, 'COMP')) {
                    if ($workingHours > 8) {
                        $used['Comp Off'] += ($workingHours - 8) / 8;
                    } else {
                        $used['Comp Off'] += $perDayValue;
                    }
                }

                // ✅ Only sum hours if in selected month
                if (!empty($record['workingHours']) && !empty($record['applyOnCell'])) {
                    try {
                        $logDate = Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell']);
                        if ((int)$logDate->format('m') === (int)$month && (int)$logDate->format('Y') === (int)$year) {
                            $totalLogged += (int) $record['workingHours'];
                        }
                    } catch (\Exception $e) {}
                }
            }

            foreach ($used as $key => $val) {
                $used[$key] = number_format($val, 2);
            }
        @endphp

        <tr class="table-row-click"
            data-name="{{ $consultant->emp_name }}"
            data-empid="{{ $consultant->emp_code }}"
            data-userid="{{ $consultant->user_id }}"
            data-email="{{ $consultant->email }}"
            data-phone="{{ $consultant->mobile_number }}"
            data-address="{{ $consultant->full_address }}"
            data-altaddress="{{ $consultant->show_address_input }}"
            data-joining="{{ $consultant->joining_date }}"
            data-designation="{{ $consultant->designation }}"
            data-client="{{ $consultant->client_name }}"
            data-profile="{{ asset('storage/app/public/' . $consultant->profile_image) }}"
            data-status="{{ $consultant->status }}"
            @if($totalLogged == 0) data-na="1" @endif>
            <td>{{ $consultant->emp_name }}</td>
            <td><span class="queue-dot blue"></span></td>
            <td>
                {{ $totalLogged > 0 ? "$totalLogged/$forecastedHours" : 'N/A' }}
            </td>
            <td>0/0/0</td>
            <td>{{ $used['AL'] > 0 ? "$used[AL]/" . ($consultant->assign_al ?? 12) : 'N/A' }}</td>
            <td>{{ $used['ML'] > 0 ? "$used[ML]/" . ($consultant->assign_ml ?? 12) : 'N/A' }}</td>
            <td>{{ $used['PDO'] > 0 ? "$used[PDO]/" . ($consultant->assign_pdo ?? 2) : 'N/A' }}</td>
            <td>{{ $used['UL'] > 0 ? "$used[UL]/" . ($consultant->assign_ul ?? 0) : 'N/A' }}</td>
        </tr>
    @endforeach
@endif

</tbody>
