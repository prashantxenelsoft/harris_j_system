<div class="remark-section card p-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
    <h6>Remarks</h6>
    <div class="btn-group-remark">
        <button class="btn btn-link p-0 text-danger" data-bs-toggle="modal" data-bs-target="#remarksModal">
        <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" class="img-fluid" />
        </button>
        <!-- <button class="flow-edit-btn" data-bs-toggle="modal" data-bs-target="#editRemarksModal">
            <i class="fa-solid fa-pen-nib"></i>
            </button> -->
    </div>
    </div>
    <div class="remark-timeline" id="remarkTimeline">
        @php
            use Carbon\Carbon;
            $timelineItems = [];
            $sortedTimesheet = $dataTimesheet->sortByDesc('updated_at');
            foreach ($sortedTimesheet as $entry) {
                $record = json_decode($entry->record, true);
                $leaveType = $record['leaveType'] ?? null;
                $workingHours = $record['workingHours'] ?? null;
                $status = $entry->status ?? null;
                $leaveHourId = $record['leaveHourId'] ?? null;
                $applyOnCell = $record['applyOnCell'] ?? null;
                $dateRange = $record['date'] ?? '';
                $remarks = $record['remarks'] ?? null;
                $time = $record['time'] ?? null;
                $leaveShort = '';
                if ($leaveHourId === 'fHalfDay') $leaveShort = 'HD1';
                elseif ($leaveHourId === 'sHalfDay') $leaveShort = 'HD2';
                elseif ($leaveHourId === 'customDay') $leaveShort = 'custom';
                $badgeText = $leaveType ? ($leaveShort ? "$leaveType $leaveShort" : $leaveType) : null;
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
                    'formatted' => $date->format('d / m / Y') . ($time ? ' ' . $time : ''),
                    'badge' => $badgeText,
                    'workingHours' => $workingHours,
                    'status'=> $status,
                    'leaveType' => $leaveType,
                    'remarks' => $remarks,
                    'month' => $date->month,
                    'year' => $date->year
                ];
                }
            }
        @endphp

        <div id="timelineContainer" class="remark-container">
            @if (count($timelineItems) > 0)
                @foreach ($timelineItems as $item)
                    <div class="remark-item mb-3 px-2" data-month="{{ $item['month'] }}" data-year="{{ $item['year'] }}">
                        <div class="d-flex align-items-start">
                            <div class="me-2 text-primary">
                                <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-1">
                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                    <small class="text-muted">
                                        Approved On {{ $item['formatted'] }}
                                        @if ($item['badge'])
                                            <span class="badge bg-light text-dark">{{ \Illuminate\Support\Str::replaceFirst('Custom', '', $item['badge']) }}</span>
                                        @endif
                                    </small>
                                </div>

                                @if (!empty($item['leaveType']) && str_contains($item['leaveType'], 'ML'))
                                    <small class="text-muted">{{ $consultant->emp_name }} has applied for medical leave</small><br>
                                @endif

                                @if ($item['workingHours'])
                                    <small class="text-muted">Working - {{ $item['workingHours'] }} hours</small><br>
                                @endif

                                @if (!empty($item['remarks']))
                                    <small class="text-muted">{!! $item['remarks'] !!}</small><br>
                                @endif

                                @if ($item['status'] === 'Submitted')
                                    <small class="text-muted">Harris J system update - Successfully submitted timesheet. You can track request via status bar.</small>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div id="noRemarksMessage" class="text-center text-muted p-3">
                    <strong>No entries found for this month</strong>
                </div>
            @endif
        </div>


    </div>
</div>
<div class="modal fade" id="remarksModal" tabindex="-1" aria-labelledby="remarksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="remarksModalLabel">Remarks</h5>
            <button type="button" class="btn-close popup-expand-btn" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="remark-timeline" id="remarkTimeline">
                @php
                    $timelineItems = [];
                    $sortedTimesheet = $dataTimesheet->sortByDesc('updated_at');

                    foreach ($sortedTimesheet as $entry) {
                        $record = json_decode($entry->record, true);
                        $leaveType = $record['leaveType'] ?? null;
                        $workingHours = $record['workingHours'] ?? null;
                        $status = $entry->status ?? null;
                        $leaveHourId = $record['leaveHourId'] ?? null;
                        $applyOnCell = $record['applyOnCell'] ?? null;
                        $dateRange = $record['date'] ?? '';
                        $remarks = $record['remarks'] ?? null;
                        $time = $record['time'] ?? null;

                        $leaveShort = '';
                        if ($leaveHourId === 'fHalfDay') $leaveShort = 'HD1';
                        elseif ($leaveHourId === 'sHalfDay') $leaveShort = 'HD2';
                        elseif ($leaveHourId === 'customDay') $leaveShort = 'custom';

                        $badgeText = $leaveType ? ($leaveShort ? "$leaveType $leaveShort" : $leaveType) : null;

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
                            'formatted' => $date->format('d / m / Y') . ($time ? ' ' . $time : ''),
                            'badge' => $badgeText,
                            'workingHours' => $workingHours,
                            'leaveType' => $leaveType,
                            'remarks' => $remarks,
                            'status' => $status,
                            'month' => $date->month,
                            'year' => $date->year
                            ];
                        }
                    }
                @endphp

                <div id="timelineContainer123" class="remark-container">
                    @forelse ($timelineItems as $item)
                        <div class="remark-item mb-3 px-2" data-month="{{ $item['month'] }}" data-year="{{ $item['year'] }}">
                            <div class="d-flex align-items-start">
                                <div class="me-2 text-primary">
                                    <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                    <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                        <small class="text-muted">
                                            Approved On {{ $item['formatted'] }}
                                            @if ($item['badge'])
                                                <span class="badge bg-light text-dark">{{ str_replace('Custom', '', $item['badge']) }}</span>
                                            @endif
                                        </small>
                                    </div>

                                    @if (!empty($item['leaveType']) && str_contains($item['leaveType'], 'ML'))
                                        <small class="text-muted">{{ $consultant->emp_name }} has applied for medical leave</small><br>
                                    @endif

                                    @if (!empty($item['workingHours']))
                                        <small class="text-muted">Working - {{ $item['workingHours'] }} hours</small><br>
                                    @endif

                                    @if (!empty($item['remarks']))
                                        <small class="text-muted">{!! $item['remarks'] !!}</small><br>
                                    @endif

                                    @if ($item['status'] === 'Submitted')
                                        <small class="text-muted">Harris J system update - Successfully submitted timesheet. You can track request via status bar.</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div id="remarksEmptyMsg" class="text-center text-muted p-3">
                            <strong>No entries found for this month</strong>
                        </div>
                    @endforelse
                </div>

                
                </div>
             
        </div>
    </div>
    </div>
</div>
<div class="modal fade" id="editRemarksModal" tabindex="-1" aria-labelledby="editRemarksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <div class="remark_popup_detial">
                <div class="r_img">
                <img src="{{ asset('public/assets/latest/images/emp-icon1.png') }}" class="img-fluid" />
                </div>
                <div class="r_detail">
                <span class="r_name">{{ $consultant->emp_name ?? 'N/A' }}</span>
                <p class="r_id">Employee Id : {{ $consultant->emp_code ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="remark_popup_detial">
                <div class="r_img">
                <img src="{{ asset('public/assets/latest/images/emp-icon1.png') }}" class="img-fluid" />
                </div>
                <div class="r_detail">
                <span class="r_name">Erin</span>
                <p class="r_id">HR</p>
                </div>
            </div>
        </div>
        <div class="modal-body">
            <div class="rc_detail_box">
                <div class="rc_left_detail">
                <div class="rc_box">
                    <div class="rc_img">
                        <img src="{{ asset('public/assets/latest/images/client-icon-1.png') }}" class="img-fluid" />
                    </div>
                    <span class="rc_name">{{ $consultant->client_name ?? 'N/A' }}</span>
                </div>
                <p class="rc_status">
                    Remarks For : <span>Approved <i class="fa-solid fa-check"></i></span>
                </p>
                </div>
                <div class="rc_right_detail">
                <p>Designation : <span>Information Security Analyst</span></p>
                </div>
            </div>
            <div class="r_text_area">
                <textarea name="r_update" id="" placeholder="Your timesheet was Approved."></textarea>
            </div>
            <div class="r_update_btn">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                Cancel
                </button>
                <button type="button" class="r_submit_btn">
                Submit
                </button>
            </div>
        </div>
    </div>
    </div>
</div>