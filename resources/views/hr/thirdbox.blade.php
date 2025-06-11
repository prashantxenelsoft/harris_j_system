 <div class="timesheet-section card p-2">
    <div class="timesheet-header d-flex justify-content-between align-items-start">
    <ul class="nav nav-tabs" id="timesheetTabsMain">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#overviewTab">Timesheet Overview</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#extraTimeTab">Extra Time Log</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#payOffTab">Pay-Off Log</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#compOffTab">Comp-off log</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#copiesTab">Get Copies</button>
        </li>
    </ul>
    <button class="expand-btn" data-bs-toggle="modal" data-bs-target="#timesheetModal">
    <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" class="img-fluid" />
    </button>
    </div>
    <div class="tab-content tab_content_body p-2">
    <div class="tab-pane fade show active" id="overviewTab">
        <div class="timeline">
            @php
                use Carbon\Carbon;
                $timelineItems = [];
                $labelMap = [
                'PH' => 'Public Holiday',
                'ML' => 'Medical Leave',
                'AL' => 'Annual Leave',
                'UL' => 'Unpaid Leave',
                'PDO' => 'Paid day off',
                'Custom COMP-OFF' => 'Comp off',
                'pay_off' => 'Pay off',
                'comp_off' => 'Comp off',
                'ignore' => 'Ignore',
                ];

                $sortedTimesheet = $dataTimesheet->sortByDesc('updated_at');

                foreach ($sortedTimesheet as $entry) {
                $record = json_decode($entry->record, true);
                $leaveType = $record['leaveType'] ?? null;
                $workingHours = $record['workingHours'] ?? null;
                $leaveHourId = $record['leaveHourId'] ?? null;
                $applyOnCell = $record['applyOnCell'] ?? null;
                $dateRange = $record['date'] ?? '';
                $extraHours = $record['extraHours'] ?? null;
                $subType = $record['type'] ?? null;

                $leaveShort = '';
                if ($leaveHourId === 'fHalfDay') $leaveShort = 'HD1';
                elseif ($leaveHourId === 'sHalfDay') $leaveShort = 'HD2';
                elseif ($leaveHourId === 'customDay') $leaveShort = 'custom';

                $badgeText = $leaveType ? ($leaveShort ? "$leaveType $leaveShort" : $leaveType) : null;
                $mainLabel = $labelMap[$leaveType] ?? $labelMap[$subType] ?? null;
                $topLabel = $leaveType ?? ucfirst(str_replace('_', ' ', $subType));
                $dates = [];

                if ($dateRange && str_contains($dateRange, 'to')) {
                    try {
                        [$start, $end] = array_map('trim', explode('to', $dateRange));
                        $startDate = Carbon::createFromFormat('d / m / Y', $start);
                        $endDate = Carbon::createFromFormat('d / m / Y', $end);
                        while ($startDate->lte($endDate)) {
                            $dates[] = $startDate->copy();
                            $startDate->addDay();
                        }
                    } catch (\Exception $e) {}
                } elseif ($applyOnCell) {
                    try {
                        $dates[] = Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                    } catch (\Exception $e) {}
                }

                foreach ($dates as $date) {
                    if (in_array($date->dayOfWeek, [0, 6])) continue;

                    $timelineItems[] = [
                        'date' => $date,
                        'formattedDate' => $date->format('D, d M'),
                        'month' => $date->month,
                        'year' => $date->year,
                        'topLabel' => strtoupper($topLabel),
                        'mainLabel' => $mainLabel,
                        'badge' => $badgeText,
                        'workingHours' => $workingHours,
                        'extraHours' => $extraHours
                    ];
                }
                }
            @endphp

            @forelse (collect($timelineItems)->sortByDesc('date') as $item)
                <div id="littletimesheet" class="timeline-item d-flex align-items-start mb-3"
                data-month="{{ $item['month'] }}"
                data-year="{{ $item['year'] }}">
                <div class="me-2">
                    <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                    <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                </div>

                <div>
                    {{-- 🔷 TOP ROW: Image + leaveType --}}
                    <div class="d-flex align-items-center mb-1">
                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" width="24" height="24" />
                        <span class="fw-bold text-primary" style="font-size: 14px;">
                            {{ $item['topLabel'] }} - (1)
                        </span>
                    </div>

                    {{-- 🧾 SECOND ROW: Date + Label + Hours --}}
                    <div class="d-flex align-items-center flex-wrap gap-2 ms-4">
                        <span>{{ $item['formattedDate'] }}</span>

                        @if ($item['mainLabel'])
                            <span class="badge bg-info text-white">{{ $item['mainLabel'] }}</span>
                        @endif

                        @if (!empty($item['extraHours']))
                            <span class="fw-semibold">- {{ $item['extraHours'] }} hours off</span>
                        @elseif (!empty($item['workingHours']) && is_numeric($item['workingHours']))
                            <span class="fw-semibold">- {{ $item['workingHours'] }} hours</span>
                        @endif
                    </div>
                </div>
                </div>
            @empty
                
            @endforelse
            <div id="noTimelineMessage" class="fs-12 text-center text-muted p-2">
                <strong>No entries found for this month</strong>
                </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                setTimeout(function () {
                const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                const selectedYear = parseInt(localStorage.getItem("timesheetYear"));
                const items = document.querySelectorAll("#littletimesheet");
                let visibleCount = 0;
                items.forEach(item => {
                    const month = parseInt(item.getAttribute("data-month"));
                    const year = parseInt(item.getAttribute("data-year"));
                    if (month === selectedMonth && year === selectedYear) {
                        item.style.display = "";
                        visibleCount++;
                    } else {
                        item.style.setProperty("display", "none", "important");
                    }
                });
                    //console.log(visibleCount);
                const noMessage = document.querySelector("#noTimelineMessage");
                if (visibleCount == 0) {
                    noMessage.style.setProperty("display", "block", "important");
                }
                if (visibleCount > 0) {
                    noMessage.style.setProperty("display", "none", "important");
                }
                }, 200);
            });
        </script>
    </div>
    <div class="tab-pane fade" id="extraTimeTab">
        
        @php
        $hasData = false;
        @endphp

        <div id="filteredTimeline">
            @foreach ($dataTimesheet as $item)
                @php
                    $record = json_decode($item->record ?? '{}', true);
                    $type = $record['type'] ?? null;
                    $labelMap = [
                        'comp_off' => ['label' => 'Comp - Off', 'color' => '#d35400'],
                        'pay_off'  => ['label' => 'Pay - Off',  'color' => '#2980b9'],
                        'ignore'   => ['label' => 'Ignored',    'color' => '#7f8c8d'],
                    ];
                    $month = null;
                    $year = null;
                    if (!empty($record['applyOnCell'])) {
                        try {
                            $dt = \Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell']);
                            $month = $dt->month;
                            $year = $dt->year;
                        } catch (\Exception $e) {}
                    }
                @endphp

                @if (isset($labelMap[$type]) && $month && $year)
                    @php $hasData = true; @endphp
                    <div class="timeline-item d-flex align-items-start mb-3"
                        data-month="{{ $month }}"
                        data-year="{{ $year }}">
                        <div class="me-2">
                            <div class="dot rounded-circle" style="width: 10px; height: 10px; background-color: #007bff;"></div>
                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px; background-color: #007bff;"></div>
                        </div>
                        <div>
                            <div class="d-flex align-items-center mb-1 tl-header">
                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                <span style="color: {{ $labelMap[$type]['color'] }}; font-weight: bold;"> {{ $labelMap[$type]['label'] }}</span>
                            </div>
                            <div class="tl_details">
                                <span>{{ $record['applyOnCell'] ?? '--/--/----' }} - </span>
                                <span class="badge" style="background-color: #ffe0b3; color: {{ $labelMap[$type]['color'] }}; font-weight: bold;">
                                    {{ $labelMap[$type]['label'] }}
                                </span>
                                <span>- {{ str_pad($record['extraHours'] ?? '0', 2, '0', STR_PAD_LEFT) }} : 00 hours</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        @if (!$hasData)
            <div id="noEntriesMessage" class="fs-12 text-muted text-center p-2">
                <strong>No entries found for this month</strong>
            </div>
        @endif

    </div>
    <div class="tab-pane fade" id="payOffTab">
        <div class="timeline">

            @php
            $hasPayoff = false;
            @endphp

            <div id="payoffTimeline">
            @foreach ($dataTimesheet as $item)
                @php
                    $record = json_decode($item->record ?? '{}', true);
                    $month = null;
                    $year = null;
                    if (!empty($record['applyOnCell'])) {
                        try {
                        $dt = \Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell']);
                        $month = $dt->month;
                        $year = $dt->year;
                        } catch (\Exception $e) {}
                    }
                @endphp

                @if (isset($record['type']) && $record['type'] === 'pay_off' && $month && $year)
                    @php $hasPayoff = true; @endphp
                    <div class="timeline-item d-flex align-items-start mb-3"
                        data-month="{{ $month }}"
                        data-year="{{ $year }}">
                        <div class="me-2">
                        <div class="dot rounded-circle" style="width: 10px; height: 10px; background-color: #007bff;"></div>
                        <div class="line" style="width: 2px; height: 100%; margin-left: 4px; background-color: #007bff;"></div>
                        </div>
                        <div>
                        <div class="d-flex align-items-center mb-1 tl-header">
                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                            <div class="pay_off_log">
                                <span>{{ $record['applyOnCell'] ?? '--/--/----' }} - </span>
                                <span>{{ str_pad($record['extraHours'] ?? '0', 2, '0', STR_PAD_LEFT) }} : 00 hours</span>
                            </div>
                        </div>
                        </div>
                    </div>
                @endif
            @endforeach
            </div>

            @if (!$hasPayoff)
            <div id="noPayoffMessage" class="fs-12 text-muted text-center p-2">
                <strong>No entries found for this month</strong>
            </div>
            @endif

        </div>
    </div>
    <div class="tab-pane fade" id="compOffTab">
        <div class="timeline">

            @php $hasCompOff = false; @endphp

            <div id="compOffTimeline">
            @foreach ($dataTimesheet as $item)
                @php
                    $record = json_decode($item->record ?? '{}', true);

                    $leaveType = $record['leaveType'] ?? '';
                    $extraHours = (int) ($record['extraHours'] ?? 0);
                    $leaveHour = $record['leaveHour'] ?? '';
                    $applyOnCell = $record['applyOnCell'] ?? '';
                    $dateRange = $record['date'] ?? '';

                    $subLabel = '';
                    if (Str::contains($leaveHour, 'HD1')) {
                        $subLabel = 'HD1';
                    } elseif (Str::contains($leaveHour, 'HD2')) {
                        $subLabel = 'HD2';
                    }

                    $displayLabel = 'Comp - Off' . ($subLabel ? " $subLabel" : '');
                    $dates = [];

                    if ($dateRange && Str::contains($dateRange, 'to')) {
                        try {
                        [$start, $end] = array_map('trim', explode('to', $dateRange));
                        $startDate = Carbon::createFromFormat('d / m / Y', $start);
                        $endDate = Carbon::createFromFormat('d / m / Y', $end);
                        while ($startDate->lte($endDate)) {
                            $dates[] = $startDate->copy();
                            $startDate->addDay();
                        }
                        } catch (\Exception $e) {}
                    } elseif ($applyOnCell) {
                        try {
                        $dates[] = Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                        } catch (\Exception $e) {}
                    }
                @endphp

                @if ($leaveType === 'Custom COMP-OFF' && count($dates))
                    @foreach ($dates as $date)
                        @php
                        if (in_array($date->dayOfWeek, [0, 6])) continue; // Skip weekends
                        $month = $date->month;
                        $year = $date->year;
                        $formattedDate = $date->format('D, d M');
                        $hasCompOff = true;
                        @endphp

                        <div class="timeline-item d-flex align-items-start mb-3"
                            data-month="{{ $month }}"
                            data-year="{{ $year }}">
                        <div class="me-2">
                            <div class="dot rounded-circle" style="width: 10px; height: 10px; background-color: #007bff;"></div>
                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px; background-color: #007bff;"></div>
                        </div>
                        <div>
                            <div class="d-flex align-items-center mb-1 tl-header">
                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                <div class="comp_off_log d-flex align-items-center flex-wrap gap-2">
                                    <span>{{ $formattedDate }}</span>
                                    <span class="badge" style="background-color:#f9e79f; color:#d35400; font-weight: bold;">
                                    {{ $displayLabel }}
                                    </span>
                                    @if ($extraHours > 0)
                                    <span>{{ str_pad($extraHours, 2, '0', STR_PAD_LEFT) }} : 00 hours</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
            </div>

            @if (!$hasCompOff)
            <div id="noCompOffMessage" class="fs-12 text-muted text-center p-2">
                <strong>No entries found for this month</strong>
            </div>
            @endif


        </div>
        </div>
        <div class="tab-pane fade" id="copiesTab">
            @php
                $timesheetRemarks = $remarks_data->filter(function ($item) {
                return str_contains($item->pdf_link ?? '', '/timesheets/');
                });

                $latestSix = $timesheetRemarks->sortByDesc('created_at')->take(6);
            @endphp

            @if ($latestSix->isNotEmpty())
                @foreach ($latestSix as $entry)
                @php
                    try {
                        $monthTitle = \Carbon\Carbon::createFromFormat('m_Y', $entry->month_of)->format('F - Y');
                    } catch (\Exception $e) {
                        $monthTitle = $entry->month_of;
                    }

                    $createdAtFormatted = \Carbon\Carbon::parse($entry->created_at)->format('d M Y, h:i A');
                @endphp

                <div class="timeline">
                    <div class="timeline-item d-flex mb-3 fs-12">
                        <div class="me-2">
                            <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                            <div class="line bg-primary"></div>
                        </div>
                        <div class="w-100 d-flex">
                            <div class="d-flex mb-1 tl-header">
                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                            </div>
                            <div class="tl_details w-100">
                            <span class="text-primary">Timesheet Overview</span>
                            <div class="d-flex justify-content-between mt-2">
                                <span>({{ $monthTitle }})</span>
                                <a href="{{ asset(str_replace('storage', 'storage/app/public', $entry->pdf_link)) }}" download target="_blank" class="badge_icon">
                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                </a>
                            </div>
                            <small class="text-muted">Submitted on: {{ $createdAtFormatted }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-muted" style="padding: 0.5rem 1rem;">No submitted timesheets found</p>
            @endif

        </div>

    </div>
    </div>
</div>
<div class="modal fade" id="timesheetModal" tabindex="-1" aria-labelledby="timesheetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close popup-expand-btn" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="timesheet-header d-flex justify-content-between align-items-center">
                <ul class="nav nav-tabs popup_tabs" id="timesheetTabsModal">
                <li class="nav-item">
                    <button class="nav-link tab_btn active" data-bs-toggle="tab" data-bs-target="#modeloverviewTab">Timesheet Overview</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link tab_btn" data-bs-toggle="tab" data-bs-target="#modelextraTimeTab">Extra Time Log</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link tab_btn" data-bs-toggle="tab" data-bs-target="#modelpayOffTab">Pay-Off Log</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link tab_btn" data-bs-toggle="tab" data-bs-target="#modelcompOffTab">Comp-off log</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link tab_btn" data-bs-toggle="tab" data-bs-target="#modelcopiesTab">Get Copies</button>
                </li>
                </ul>
            </div>
            <div class="tab-content tab_content_body">
                <div class="tab-pane fade show active" id="modeloverviewTab">
                <div class="timeline">
                    @php

                        $timelineItems = [];
                        $labelMap = [
                            'PH' => 'Public Holiday',
                            'ML' => 'Medical Leave',
                            'AL' => 'Annual Leave',
                            'UL' => 'Unpaid Leave',
                            'PDO' => 'Paid day off',
                            'Custom COMP-OFF' => 'Comp off',
                            'pay_off' => 'Pay off',
                            'comp_off' => 'Comp off',
                            'ignore' => 'Ignore',
                        ];

                        $sortedTimesheet = $dataTimesheet->sortByDesc('updated_at');

                        foreach ($sortedTimesheet as $entry) {
                            $record = json_decode($entry->record, true);
                            $leaveType = $record['leaveType'] ?? null;
                            $subType = $record['type'] ?? null;
                            $workingHours = $record['workingHours'] ?? null;
                            $extraHours = $record['extraHours'] ?? null;
                            $leaveHourId = $record['leaveHourId'] ?? null;
                            $applyOnCell = $record['applyOnCell'] ?? null;
                            $dateRange = $record['date'] ?? '';

                            $leaveShort = '';
                            if ($leaveHourId === 'fHalfDay') $leaveShort = 'HD1';
                            elseif ($leaveHourId === 'sHalfDay') $leaveShort = 'HD2';
                            elseif ($leaveHourId === 'customDay') $leaveShort = 'custom';

                            $badgeText = $leaveType ? ($leaveShort ? "$leaveType $leaveShort" : $leaveType) : null;
                            $mainLabel = $labelMap[$leaveType] ?? $labelMap[$subType] ?? null;
                            $topLabel = $leaveType ?? ucfirst(str_replace('_', ' ', $subType));

                            $dates = [];
                            if ($dateRange && str_contains($dateRange, 'to')) {
                            try {
                                [$start, $end] = array_map('trim', explode('to', $dateRange));
                                $startDate = Carbon::createFromFormat('d / m / Y', $start);
                                $endDate = Carbon::createFromFormat('d / m / Y', $end);
                                while ($startDate->lte($endDate)) {
                                    $dates[] = $startDate->copy();
                                    $startDate->addDay();
                                }
                            } catch (\Exception $e) {}
                            } elseif ($applyOnCell) {
                            try {
                                $dates[] = Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                            } catch (\Exception $e) {}
                            }

                            foreach ($dates as $date) {
                            if (in_array($date->dayOfWeek, [0, 6])) continue;

                            $timelineItems[] = [
                                'date' => $date,
                                'formatted' => $date->format('D, d M'),
                                'month' => $date->month,
                                'year' => $date->year,
                                'topLabel' => strtoupper($topLabel),
                                'mainLabel' => $mainLabel,
                                'badge' => $badgeText,
                                'workingHours' => $workingHours,
                                'extraHours' => $extraHours,
                            ];
                            }
                        }
                    @endphp

                    <div class="timeline-wrapper">
                        @forelse (collect($timelineItems)->sortByDesc('date') as $item)
                            <div id="littletimesheet" class="timeline-item d-flex align-items-start mb-3"
                            data-month="{{ $item['month'] }}"
                            data-year="{{ $item['year'] }}">
                            <div class="me-2">
                                <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                            </div>
                            <div>
                                {{-- 🔷 TOP ROW: Image + leaveType --}}
                                <div class="d-flex align-items-center mb-1">
                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" width="24" height="24" />
                                    <span class="fw-bold text-primary" style="font-size: 14px;">
                                        {{ $item['topLabel'] }} - (1)
                                    </span>
                                </div>

                                {{-- 🧾 SECOND ROW: Date + Label + Hours --}}
                                <div class="d-flex align-items-center flex-wrap gap-2 ms-4">
                                    <span>{{ $item['formatted'] }}</span>

                                    @if ($item['mainLabel'])
                                        <span class="badge bg-info text-white">{{ $item['mainLabel'] }}</span>
                                    @endif

                                    @if (!empty($item['extraHours']))
                                        <span class="fw-semibold">- {{ $item['extraHours'] }} hours off</span>
                                    @elseif (!empty($item['workingHours']) && is_numeric($item['workingHours']))
                                        <span class="fw-semibold">- {{ $item['workingHours'] }} hours</span>
                                    @endif
                                </div>
                            </div>
                            </div>
                        @empty
                            
                        @endforelse
                        <div id="noTimelineMessage12" class="fs-12 text-center text-muted p-2">
                            <strong>No entries found for this month</strong>
                        </div>
                    </div>
                </div>

               
                </div>
                <div class="tab-pane fade" id="modelextraTimeTab">

                    @php
                        $filteredItems = [];

                        $labelMap = [
                            'comp_off' => ['label' => 'Comp - Off', 'color' => '#d35400'],
                            'pay_off'  => ['label' => 'Pay - Off',  'color' => '#2980b9'],
                            'ignore'   => ['label' => 'Ignored',    'color' => '#7f8c8d'],
                        ];

                        foreach ($dataTimesheet as $item) {
                            $record = json_decode($item->record ?? '{}', true);
                            $type = $record['type'] ?? null;

                            if (!isset($labelMap[$type]) || empty($record['applyOnCell'])) continue;

                            try {
                                $dt = \Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell']);
                                $filteredItems[] = [
                                    'date' => $record['applyOnCell'],
                                    'month' => $dt->month,
                                    'year' => $dt->year,
                                    'type' => $type,
                                    'extraHours' => $record['extraHours'] ?? '0',
                                ];
                            } catch (\Exception $e) {}
                        }
                    @endphp

                    @if (count($filteredItems) > 0)
                        <div id="filteredTimeline">
                            @foreach ($filteredItems as $item)
                                <div class="timeline-item d-flex align-items-start mb-3"
                                    data-month="{{ $item['month'] }}"
                                    data-year="{{ $item['year'] }}">
                                    <div class="me-2">
                                        <div class="dot rounded-circle" style="width: 10px; height: 10px; background-color: #007bff;"></div>
                                        <div class="line" style="width: 2px; height: 100%; margin-left: 4px; background-color: #007bff;"></div>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center mb-1 tl-header">
                                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                            <span style="color: {{ $labelMap[$item['type']]['color'] }}; font-weight: bold;">
                                                {{ $labelMap[$item['type']]['label'] }}
                                            </span>
                                        </div>
                                        <div class="tl_details">
                                            <span>{{ $item['date'] ?? '--/--/----' }} - </span>
                                            <span class="badge" style="background-color: #ffe0b3; color: {{ $labelMap[$item['type']]['color'] }}; font-weight: bold;">
                                                {{ $labelMap[$item['type']]['label'] }}
                                            </span>
                                            <span>- {{ str_pad($item['extraHours'], 2, '0', STR_PAD_LEFT) }} : 00 hours</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div id="noEntriesMessage354" class="fs-12 text-muted text-center p-2">
                            <strong>No entries found for this month</strong>
                        </div>
                    @endif

                   
                
                </div>
                <div class="tab-pane fade" id="modelpayOffTab">
                <div class="timeline">

                    @php
                        $filteredItems = [];

                        foreach ($dataTimesheet as $item) {
                            $record = json_decode($item->record ?? '{}', true);

                            if (($record['type'] ?? '') !== 'pay_off' || empty($record['applyOnCell'])) continue;

                            try {
                                $dt = \Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell']);
                                $filteredItems[] = [
                                    'date' => $record['applyOnCell'],
                                    'month' => $dt->month,
                                    'year' => $dt->year,
                                    'extraHours' => $record['extraHours'] ?? '0',
                                ];
                            } catch (\Exception $e) {}
                        }
                    @endphp

                    @if (count($filteredItems) > 0)
                        <div id="payoffTimeline">
                            @foreach ($filteredItems as $item)
                                <div class="timeline-item d-flex align-items-start mb-3"
                                    data-month="{{ $item['month'] }}"
                                    data-year="{{ $item['year'] }}">
                                    <div class="me-2">
                                        <div class="dot rounded-circle" style="width: 10px; height: 10px; background-color: #007bff;"></div>
                                        <div class="line" style="width: 2px; height: 100%; margin-left: 4px; background-color: #007bff;"></div>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center mb-1 tl-header">
                                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                            <div class="pay_off_log">
                                                <span>{{ $item['date'] }} - </span>
                                                <span>{{ str_pad($item['extraHours'], 2, '0', STR_PAD_LEFT) }} : 00 hours</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div id="noPayoffMessage12" class="fs-12 text-muted text-center p-2">
                            <strong>No entries found for this month</strong>
                        </div>
                    @endif

                </div>
                </div>
                <div class="tab-pane fade" id="modelcompOffTab">
                <div class="timeline">
                    @php
                        $compOffEntries = [];

                        foreach ($dataTimesheet as $item) {
                            $record = json_decode($item->record ?? '{}', true);

                            if (($record['leaveType'] ?? '') !== 'Custom COMP-OFF') continue;

                            $extraHours = (int) ($record['extraHours'] ?? 0);
                            $leaveHour = $record['leaveHour'] ?? '';
                            $applyOnCell = $record['applyOnCell'] ?? '';
                            $dateRange = $record['date'] ?? '';

                            $subLabel = '';
                            if (Str::contains($leaveHour, 'HD1')) $subLabel = 'HD1';
                            elseif (Str::contains($leaveHour, 'HD2')) $subLabel = 'HD2';

                            $displayLabel = 'Comp - Off' . ($subLabel ? " $subLabel" : '');

                            $dates = [];

                            if ($dateRange && Str::contains($dateRange, 'to')) {
                                try {
                                    [$start, $end] = array_map('trim', explode('to', $dateRange));
                                    $startDate = Carbon::createFromFormat('d / m / Y', $start);
                                    $endDate = Carbon::createFromFormat('d / m / Y', $end);
                                    while ($startDate->lte($endDate)) {
                                        if (!in_array($startDate->dayOfWeek, [0, 6])) {
                                            $compOffEntries[] = [
                                                'date' => $startDate->copy(),
                                                'formatted' => $startDate->format('D, d M'),
                                                'month' => $startDate->month,
                                                'year' => $startDate->year,
                                                'label' => $displayLabel,
                                                'extraHours' => $extraHours,
                                            ];
                                        }
                                        $startDate->addDay();
                                    }
                                } catch (\Exception $e) {}
                            } elseif ($applyOnCell) {
                                try {
                                    $date = Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                                    if (!in_array($date->dayOfWeek, [0, 6])) {
                                        $compOffEntries[] = [
                                            'date' => $date,
                                            'formatted' => $date->format('D, d M'),
                                            'month' => $date->month,
                                            'year' => $date->year,
                                            'label' => $displayLabel,
                                            'extraHours' => $extraHours,
                                        ];
                                    }
                                } catch (\Exception $e) {}
                            }
                        }
                    @endphp

                    @if (count($compOffEntries) > 0)
                        <div id="compOffTimeline">
                            @foreach ($compOffEntries as $entry)
                                <div class="timeline-item d-flex align-items-start mb-3"
                                    data-month="{{ $entry['month'] }}"
                                    data-year="{{ $entry['year'] }}">
                                    <div class="me-2">
                                        <div class="dot rounded-circle" style="width: 10px; height: 10px; background-color: #007bff;"></div>
                                        <div class="line" style="width: 2px; height: 100%; margin-left: 4px; background-color: #007bff;"></div>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center mb-1 tl-header">
                                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                            <div class="comp_off_log d-flex align-items-center flex-wrap gap-2">
                                                <span>{{ $entry['formatted'] }}</span>
                                                <span class="badge" style="background-color:#f9e79f; color:#d35400; font-weight: bold;">
                                                    {{ $entry['label'] }}
                                                </span>
                                                @if ($entry['extraHours'] > 0)
                                                    <span>{{ str_pad($entry['extraHours'], 2, '0', STR_PAD_LEFT) }} : 00 hours</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div id="noCompOffMessage12" class="fs-12 text-muted text-center p-2">
                            <strong>No entries found for this month</strong>
                        </div>
                    @endif

                </div>
                </div>
                <div class="tab-pane fade" id="modelcopiesTab">
                @php
                    $timesheetRemarks = $remarks_data->filter(function ($item) {
                        return isset($item->pdf_link) && str_contains($item->pdf_link, '/timesheets/');
                    })->sortByDesc('created_at');
                @endphp

                @if ($timesheetRemarks->count())
                    @foreach ($timesheetRemarks as $entry)
                        @php
                            $monthParts = explode('_', $entry->month_of);
                            $monthNum = $monthParts[0] ?? '01';
                            $year = $monthParts[1] ?? '2025';

                            try {
                            $monthTitle = \Carbon\Carbon::createFromDate($year, $monthNum, 1)->format('F - Y');
                            } catch (\Exception $e) {
                            $monthTitle = $entry->month_of;
                            }

                            $downloadUrl = asset($entry->pdf_link);
                            $createdAtFormatted = \Carbon\Carbon::parse($entry->created_at)->format('d M Y, h:i A');
                        @endphp

                        <div class="timeline">
                            <div class="timeline-item d-flex mb-3 fs-12">
                            <div class="me-2">
                                <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"></div>
                                <div class="line bg-primary"></div>
                            </div>
                            <div class="w-100 d-flex">
                                <div class="d-flex mb-1 tl-header">
                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2">
                                </div>
                                <div class="tl_details w-100">
                                    <span class="text-primary">Timesheet Overview</span>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span>({{ $monthTitle }})</span>
                                        <a href="{{ $downloadUrl }}" class="badge_icon" target="_blank">
                                        <i class="fa-solid fa-cloud-arrow-down"></i>
                                        </a>
                                    </div>
                                    <small class="text-muted">Submitted on: {{ $createdAtFormatted }}</small>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted" style="padding: 0.5rem 1rem;">No submitted timesheets found</p>
                @endif

                </div>
            </div>
        </div>
    </div>
    </div>
</div>
