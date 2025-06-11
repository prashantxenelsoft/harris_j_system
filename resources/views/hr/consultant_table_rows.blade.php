@foreach ($consultants as $consultant)
    @php
        $userData = $dashboardData[$consultant->user_id] ?? collect();
        $totalLogged = 0;

        // Forecasted hours
        $start = Carbon\Carbon::create($year, $month, 1);
        $end = $start->copy()->endOfMonth();
        $workingDays = 0;
        while ($start->lte($end)) {
            if (!$start->isWeekend()) $workingDays++;
            $start->addDay();
        }
        $forecastedHours = $workingDays * 8;

        $used = ['AL' => 0, 'ML' => 0, 'UL' => 0, 'PDO' => 0, 'Comp Off' => 0];

        foreach ($userData as $entry) {
            $record = json_decode($entry->record ?? '{}', true);
            if (!$record) continue;

            $leaveRaw = strtoupper(trim($record['leaveType'] ?? ''));
            $hourId = $record['leaveHourId'] ?? '';
            $applyOnCell = trim($record['applyOnCell'] ?? '');
            $dateRange = trim($record['date'] ?? '');
            $workingHours = isset($record['workingHours']) && is_numeric($record['workingHours']) ? floatval($record['workingHours']) : 0;
            $perDayValue = in_array($hourId, ['fHalfDay', 'sHalfDay']) ? 0.5 : 1;

            $mapTypes = [
                'CUSTOM AL' => 'AL',
                'CUSTOM ML' => 'ML',
                'CUSTOM UL' => 'UL',
                'CUSTOM PDO' => 'PDO',
                'CUSTOM COMP-OFF' => 'Comp Off',
            ];
            $type = $mapTypes[$leaveRaw] ?? $leaveRaw;

            $dates = [];
            if ($dateRange && Str::contains($dateRange, 'to')) {
                try {
                    [$startDate, $endDate] = array_map('trim', explode('to', $dateRange));
                    $startDate = Carbon\Carbon::createFromFormat('d / m / Y', $startDate);
                    $endDate = Carbon\Carbon::createFromFormat('d / m / Y', $endDate);
                    while ($startDate->lte($endDate)) {
                        $dates[] = $startDate->copy();
                        $startDate->addDay();
                    }
                } catch (\Exception $e) {}
            } elseif ($applyOnCell) {
                try {
                    $dates[] = Carbon\Carbon::createFromFormat('d / m / Y', $applyOnCell);
                } catch (\Exception $e) {}
            }

            foreach ($dates as $d) {
                if (in_array($d->dayOfWeek, [0, 6])) continue;

                if (Str::contains($type, 'AL')) $used['AL'] += $perDayValue;
                if (Str::contains($type, 'ML')) $used['ML'] += $perDayValue;
                if (Str::contains($type, 'PDO')) $used['PDO'] += $perDayValue;
                if (Str::contains($type, 'UL')) $used['UL'] += $perDayValue;

                if ($type === 'COMP OFF' || $type === 'COMP-OFF') {
                    $used['Comp Off'] += $workingHours > 8 ? ($workingHours - 8) / 8 : $perDayValue;
                }
            }

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

    <tr>
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
