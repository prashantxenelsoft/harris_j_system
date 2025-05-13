<section class="add-consultant-parent">
    <section class="login-as-consultant">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-dashboard-top-bar">
                        <div class="left-col-top-bar">
                            <div class="employee-details-consultant">
                                <ul>
                                    <li>
                                        <h6>Employee ID</h6>
                                        <p>:Emp14982</p>
                                    </li>
                                    <li>
                                        <h6>Employee Name</h6>
                                        <p>: Bruce Lee</p>
                                    </li>
                                </ul>
                            </div>

                            <div class="client-details-consultant">
                                <ul>
                                    <li>
                                        <h6>Client Name</h6>
                                        <p>:Encore Films</p>
                                    </li>
                                    <li>
                                        <h6>Reporting Manager</h6>
                                        <p>:Miss.Tiana Calzoni (tiana@gmail.com)</p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="right-col-top-bar">
                            <div class="date-container">
                                <input id="date" type="text" />
                                <i class="date-icon fa fa-calendar" aria-hidden="true"></i>
                                <span class="date-text">August - 2024</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pb-5">
                <div class="col-lg-9 col-xxl-8">
                    <div class="consultant-dashboard-left-col">
                        <div class="dashboard-consultant-wrapper-graph">
                            <div class="graph-one-col-dashboard-consultant">
                                  @php

                            $monthWise = [];

                            foreach ($dataTimesheet as $item) {
                                $record = json_decode($item->record ?? '{}', true);

                                if (!isset($record['applyOnCell'])) continue;

                                $parts = explode(' / ', $record['applyOnCell']);
                                if (count($parts) !== 3) continue;

                                [$day, $month, $year] = $parts;
                                $monthKey = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);

                                $status = strtolower(trim($item->status));
                                $monthWise[$monthKey][] = $status;
                            }

                            $monthStatusSummary = [];

                            foreach ($monthWise as $monthKey => $statuses) {
                                if (in_array('draft', $statuses)) {
                                $monthStatusSummary[$monthKey] = 'Draft';
                                } elseif (count(array_unique($statuses)) === 1) {
                                $monthStatusSummary[$monthKey] = ucfirst($statuses[0]);
                                } else {
                                $monthStatusSummary[$monthKey] = 'Mixed';
                                }
                            }

                            $submittedCount = 0;
                            $approvedCount = 0;
                            $rejectedCount = 0;

                            foreach ($monthStatusSummary as $status) {
                                $lower = strtolower($status);
                                if ($lower === 'submitted') $submittedCount++;
                                elseif ($lower === 'approved' || $lower === 'auto approved') $approvedCount++;
                                elseif ($lower === 'rejected') $rejectedCount++;
                            }

                            $totalCount = count($monthStatusSummary);
                            @endphp

                            <script>

                                window.dashboardDataTimeSheet = {
                                     submitted: {{ $submittedCount }},
                                        approved: {{ $approvedCount }},
                                        rejected: {{ $rejectedCount }},
                                        total: {{ $totalCount }}
                                };
                            
                            </script>
                                <div class="total-label">
                                    Total Timesheets: <span class="total-count">{{ $totalCount }}</span>
                                </div>
                                <canvas id="timesheetChart"></canvas>
                                <div class="labels">
                                    <div class="label-item submitted">Submitted: {{ $submittedCount }}</div>
                                    <div class="label-item approved">Approved: {{ $approvedCount }}</div>
                                    <div class="label-item rejected">Rejected: {{ $rejectedCount }}</div>
                                </div>
                                

                            </div>

                            @php
                                $workingHourRows = 0;
                                $totalWorkingHours = 0;

                                foreach ($dataTimesheet as $item) {
                                    $record = json_decode($item->record ?? '{}', true);

                                    if (isset($record['workingHours']) && is_numeric($record['workingHours'])) {
                                        $workingHourRows++;
                                        $totalWorkingHours += (float) $record['workingHours'];
                                    }
                                }

                                $totalCalculatedHours = $workingHourRows * 8;
                                @endphp

                                <div class="graph-two-col-dashboard-consultant">
                                    <div class="title">
                                        Working log:
                                        <span class="log-count">{{ $totalWorkingHours }} hrs</span>
                                    </div>

                                    <canvas id="workingChart" width="180" height="180"></canvas>

                                    <div class="labels">
                                        <div class="label-item forecasted">Hours Forecasted: {{ $totalCalculatedHours }}</div>
                                        <div class="label-item logged">Hours Logged: {{ $totalWorkingHours }}</div>
                                    </div>
                                    <script>
                                        window.dashboardData = {
                                            totalLogged: {{ $totalWorkingHours }},
                                            totalForecasted: {{ $totalCalculatedHours }}
                                        };
                                    </script>
                                    
                                </div>

                        </div>

                        <div class="claim-summary-dashboard-consultant">
                            <div class="claim-header-consultant">
                                <h4>
                                    Claims Summary
                                </h4>

                                <div class="view-all-cta">
                                    <a href="#">
                                        <!-- <img src="assets/images/save-icon-circle.png"> -->
                                        View All
                                    </a>
                                </div>
                            </div>

                            @php
    $firstClaim = $dataClaims->first();
    $record = $firstClaim ? json_decode($firstClaim->record, true) : null;
@endphp

@if($record)
<div class="claim-form-conusltant-dashboard">
    <div class="heading-wrap-claim">
        <h3>Claim Form</h3>
        <h6>#{{ $record['claim_no'] ?? 'N/A' }}</h6>
    </div>

    <div class="draft-badge-wrap">
        <div class="draft-badge">
            <span></span>
            {{ ucfirst($firstClaim->status ?? 'Draft') }}
        </div>
    </div>

    <div class="claim-tab-dummy-consulatnt">
        <a href="#">
            Individual Claims ( {{ str_pad($dataClaims->count(), 2, '0', STR_PAD_LEFT) }} )
        </a>

        <a href="#">
            Base Work Hours
        </a>
    </div>
</div>

<div class="table-dashboard-consultant">
    <div class="expense-card">
        <div class="expense-header">
            <div class="expense-item">
                <strong>Date & Time</strong>
                <span>{{ \Carbon\Carbon::parse($record['date'])->format('l, jS M, Y') }}</span>
            </div>
            <div class="expense-item">
                <strong>Expense Type</strong>
                <span>{{ $record['expenseType'] ?? '-' }}</span>
            </div>
            <div class="expense-item">
                <strong>Amount</strong>
                <span>$ {{ number_format((float)($record['amount'] ?? 0), 2) }}</span>
            </div>
            <div class="actions"></div>
        </div>

        <div class="expense-body">
            <div class="expense-item">
                <strong>Particulars</strong>
                <span>{{ $record['particulars'] ?? '-' }}</span>
            </div>
            @if (!empty($record['locationFrom']))
            <div class="expense-item">
                <strong>Location From</strong>
                <span>{{ $record['locationFrom'] }}</span>
            </div>
            @endif
            @if (!empty($record['locationTo']))
            <div class="expense-item">
                <strong>Location To</strong>
                <span>{{ $record['locationTo'] }}</span>
            </div>
            @endif
            <div class="actions"></div>
        </div>
    </div>

    <div class="dashboard-remark-section">
        <h4>Remarks</h4>
        <p>{{ $record['remarks'] ?? '-' }}</p>
    </div>
</div>
@endif



                        </div>
                    </div>
                </div>

                

                <div class="col-lg-3 col-xxl-4">
                <div class="timesheet-overview-consultant" id="home_page_timesheet">
                    <div class="timeline-container">
                        <div class="timeline-title">
                            <i class="fa-solid fa-caret-down"></i> {{ $consultant->client_name ?? 'N/A' }}
                        </div>

                        @php
                            use Carbon\Carbon;

                            $monthGroups = [];

                            foreach ($dataTimesheet as $item) {
                            $record = json_decode($item->record ?? '{}', true);
                            if (!isset($record['applyOnCell'])) continue;

                            $parts = explode(' / ', $record['applyOnCell']);
                            if (count($parts) !== 3) continue;

                            [$day, $month, $year] = $parts;
                            $key = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
                            $monthGroups[$key][] = strtolower(trim($item->status));
                            }

                            $monthlyStatus = [];
                            foreach ($monthGroups as $monthKey => $statuses) {
                            if (in_array('draft', $statuses)) {
                                $monthlyStatus[$monthKey] = 'Draft';
                            } elseif (count(array_unique($statuses)) === 1) {
                                $monthlyStatus[$monthKey] = ucfirst($statuses[0]);
                            } else {
                                $monthlyStatus[$monthKey] = 'Mixed';
                            }
                            }

                            krsort($monthlyStatus);
                            $monthlyStatus = array_slice($monthlyStatus, 0, 6, true);
                        @endphp

                        @if (!empty($monthlyStatus))
                            @foreach ($monthlyStatus as $monthKey => $status)
                            @php
                                $statusLower = strtolower($status);

                                $dotClass = match($statusLower) {
                                    'draft' => 'dot-blue',
                                    'submitted' => 'dot-yellow',
                                    'auto approved', 'approved' => 'dot-green',
                                    'rejected' => 'dot-red',
                                    default => 'dot-gray',
                                };

                                $lineClass = match($statusLower) {
                                    'draft' => 'blue-timeline',
                                    'submitted' => 'yellow-timeline',
                                    'auto approved', 'approved' => 'green-timeline',
                                    'rejected' => 'red-timeline',
                                    default => 'gray-timeline',
                                };

                                $badgeClass = match($statusLower) {
                                    'draft' => 'badge blue',
                                    'submitted' => 'badge yellow',
                                    'auto approved', 'approved' => 'badge green',
                                    'rejected' => 'badge red',
                                    default => 'badge gray',
                                };

                                $icon = match($statusLower) {
                                    'auto approved', 'approved' => '<i class="fa-solid fa-check"></i>',
                                    'submitted' => '<i class="fa-solid fa-xmark"></i>',
                                    default => '',
                                };
                            @endphp

                            <div class="timeline-item">
                                <div class="timeline-dot {{ $dotClass }}">{!! $icon !!}</div>

                                @unless ($loop->last)
                                    <div class="timeline-line {{ $lineClass }}"></div>
                                @endunless

                                <div class="timeline-content">
                                    <h4>Timesheet Overview</h4>
                                    <div class="{{ $badgeClass }}">{{ ucwords($status) }}</div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p class="text-muted" style="padding: 0.5rem 1rem;">Timesheet Overview not found</p>
                        @endif
                    </div>
                </div>
                </div>



            </div>
        </div>
    </section>
</section>