@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;
@endphp
<script>
   window.dashboardData = @json($dashboardData);
</script>
<div class="add-consultants-wrapper">
   <div class="pt-4">
      <div class="row">
         <div class="col-lg-12 col-xxl-12">
            <div class="hr-inner-tab">
               <div class="add-consultant-clients-wrapper">
                  <h4>Turn – in – rate : 90 / 100</h4>
                  <h4>Client – Wise Dossiers</h4>
                  <div class="clients-tabs-consultants pt-3">
                     <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach ($clients as $index => $client)
                           @php
                                 $isActive = $index === 0 ? 'active' : '';
                                 $tabId = 'client-' . $client->id;

                                 $filtered = $consultants->filter(fn($c) => $c->client_id == $client->id);
                                 $inactive = $filtered->where('status', 'Inactive')->count();
                                 $active = $filtered->where('status', 'Active')->count();
                                 $notice = $filtered->where('status', 'Notice Period')->count();
                                 $total = $filtered->count();
                           @endphp

                           <button class="nav-link {{ $isActive }}"
                                 id="v-pills-{{ $tabId }}-tab"
                                 data-bs-toggle="pill"
                                 data-bs-target="#v-pills-{{ $tabId }}"
                                 type="button"
                                 role="tab"
                                 aria-controls="v-pills-{{ $tabId }}"
                                 aria-selected="{{ $isActive === 'active' ? 'true' : 'false' }}">
                                 
                                 <div class="clients-tab-switch">
                                    <div class="clients-img-name">
                                       <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="{{ $client->serving_client }}" />
                                       <h6 class="{{ $isActive ? 'fw-bold' : '' }} truncate-text">{{ Str::limit($client->serving_client, 16) }}</h6>
                                    </div>

                                    <div class="clients-numbers-tab-switch">
                                       <span>
                                             (
                                             <em style="color: red;">{{ $inactive }}</em>,
                                             <em style="color: blue;">{{ $active }}</em>,
                                             <em style="color: gray;">{{ $notice }}</em>
                                             ) <b>/ {{ $total }}</b>
                                       </span>
                                    </div>
                                 </div>
                           </button>
                        @endforeach
                     </div>

                  </div>
                  <div class="clients-consultants-tags">
                     <ul>
                        <li>
                           <span></span> 
                           <p>Manual Review</p>
                        </li>
                        <li>
                           <span></span> 
                           <p>Auto Approved</p>
                        </li>
                        <li>
                           <span></span> 
                           <p>Draft</p>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="hr-consultants-clients-tabs-content">
                  <div class="tab-content" id="v-pills-tabContent">
                     @foreach ($clients as $index => $client)
                        @php
                              $tabId = 'client-' . $client->id;
                              $isActive = $index === 0 ? 'show active' : '';
                              $filteredConsultants = $groupedConsultants[$client->id] ?? collect();
                        @endphp

                        <div class="tab-pane fade {{ $isActive }}" id="v-pills-{{ $tabId }}" role="tabpanel" aria-labelledby="v-pills-{{ $tabId }}-tab">
                              <div class="hr-tab-inner">
                                 <div class="hr-table">
                                    <div class="hr-table-inner">
                                          <!-- Calendar Header -->
                                          <div class="hr-table-header">
                                             <div class="calendar-display" onclick="toggleGrid('{{ $tabId }}')">
                                                <i class="fa-solid fa-calendar-days"></i>
                                                <span id="calendarLabel_{{ $tabId }}"></span>
                                             </div>
                                             <div class="month-grid-popup" id="gridPopup_{{ $tabId }}">
                                                <div class="month-grid-header">
                                                      <button onclick="chgYr(-1, '{{ $tabId }}')">&#8592;</button>
                                                      <span id="yrLbl_{{ $tabId }}"></span>
                                                      <button onclick="chgYr(1, '{{ $tabId }}')">&#8594;</button>
                                                </div>
                                                <div class="month-grid" id="gridMonths_{{ $tabId }}"></div>
                                             </div>
                                          </div>

                                          <!-- Consultant Table -->
                                         <table class="table-clickable">
                                             <thead>
                                                <tr>
                                                      <th>Name</th>
                                                      <th>Queue</th>
                                                      <th>Hours Logged / Hours Forecasted</th>
                                                      <th>Logged Time-off</th>
                                                      <th>AL Overview</th>
                                                      <th>ML Overview</th>
                                                      <th>PDO Overview</th>
                                                      <th>UL Overview</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                @foreach ($filteredConsultants as $consultant)
                                                      @php
                                                         $userData = $dashboardData[$consultant->user_id] ?? collect();
                                                         $totalLogged = 0;

                                                         [$monthName, $year] = explode(' - ', trim($selectedMonthLabel));
                                                         $month = Carbon::parse("01 $monthName")->format('m');

                                                         // Forecasted = working days * 8
                                                         $start = Carbon::create($year, $month, 1);
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

                                                            // Normalize leave type
                                                            $mapTypes = [
                                                                  'CUSTOM AL' => 'AL',
                                                                  'CUSTOM ML' => 'ML',
                                                                  'CUSTOM UL' => 'UL',
                                                                  'CUSTOM PDO' => 'PDO',
                                                                  'CUSTOM COMP-OFF' => 'Comp Off',
                                                            ];
                                                            $type = $mapTypes[$leaveRaw] ?? $leaveRaw;

                                                            // Collect dates
                                                            $dates = [];
                                                            if ($dateRange && Str::contains($dateRange, 'to')) {
                                                                  try {
                                                                     [$startDate, $endDate] = array_map('trim', explode('to', $dateRange));
                                                                     $startDate = Carbon::createFromFormat('d / m / Y', $startDate);
                                                                     $endDate = Carbon::createFromFormat('d / m / Y', $endDate);
                                                                     while ($startDate->lte($endDate)) {
                                                                        $dates[] = $startDate->copy();
                                                                        $startDate->addDay();
                                                                     }
                                                                  } catch (\Exception $e) {}
                                                            } elseif ($applyOnCell) {
                                                                  try {
                                                                     $dates[] = Carbon::createFromFormat('d / m / Y', $applyOnCell);
                                                                  } catch (\Exception $e) {}
                                                            }

                                                            // ✅ Count leave regardless of month
                                                            foreach ($dates as $d) {
                                                                  if (in_array($d->dayOfWeek, [0, 6])) continue;

                                                                  if (Str::contains($type, 'AL')) $used['AL'] += $perDayValue;
                                                                  if (Str::contains($type, 'ML')) $used['ML'] += $perDayValue;
                                                                  if (Str::contains($type, 'PDO')) $used['PDO'] += $perDayValue;
                                                                  if (Str::contains($type, 'UL')) $used['UL'] += $perDayValue;

                                                                  if ($type === 'COMP OFF' || $type === 'COMP-OFF') {
                                                                     if ($workingHours > 8) {
                                                                        $extra = $workingHours - 8;
                                                                        $compVal = $extra / 8;
                                                                        $used['Comp Off'] += $compVal;
                                                                     } else {
                                                                        $used['Comp Off'] += $perDayValue;
                                                                     }
                                                                  }
                                                            }

                                                            // ✅ Only this is month-filtered
                                                            if (!empty($record['workingHours']) && !empty($record['applyOnCell'])) {
                                                                  try {
                                                                     $logDate = Carbon::createFromFormat('d / m / Y', $record['applyOnCell']);
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
                                                         data-status="{{ $consultant->status }}"
                                                          @if($totalLogged == 0) data-na="1" @endif>
                                                         <td>{{ $consultant->emp_name }}</td>
                                                         <td><span class="queue-dot blue"></span></td>
                                                         <td>
                                                            {{ $totalLogged > 0 ? "$totalLogged/$forecastedHours" : 'N/A' }}
                                                         </td>
                                                         <td>0/0/0</td>
                                                         <td>
                                                            {{ $used['AL'] > 0 ? "$used[AL]/" . ($consultant->assign_al ?? 12) : 'N/A' }}
                                                         </td>
                                                         <td>
                                                            {{ $used['ML'] > 0 ? "$used[ML]/" . ($consultant->assign_ml ?? 12) : 'N/A' }}
                                                         </td>
                                                         <td>
                                                            {{ $used['PDO'] > 0 ? "$used[PDO]/" . ($consultant->assign_pdo ?? 2) : 'N/A' }}
                                                         </td>
                                                         <td>
                                                            {{ $used['UL'] > 0 ? "$used[UL]/" . ($consultant->assign_ul ?? 0) : 'N/A' }}
                                                         </td>


                                                      </tr>
                                                @endforeach
                                             </tbody>
                                          </table>
                                    </div>
                                 </div>

                                 <!-- Calendar + Profile Right Section -->
                                 <div class="calendar-ui" id="calendar_id">
                                    <div class="hr-tab-inner-top-profile-row">
                                          <div class="profile-header">
                                             <img src="{{ asset('public/assets/images/profile-icon-img.png')}}" alt="Profile Picture" class="profile-pic open-profile-modal" data-bs-toggle="modal" data-bs-target="#hr-profile-modal-{{ $tabId }}" />
                                             <div>
                                                <h3></h3>
                                                <p>Employee Id : </p>
                                             </div>
                                          </div>

                                           <div class="icons-bar">
                                             <span class="icon">
                                                <svg width="32" height="32" viewBox="0 0 32 32"
                                                      fill="none"
                                                      xmlns="http://www.w3.org/2000/svg">
                                                      <g clip-path="url(#clip0_41157_9825)">
                                                         <circle cx="16" cy="16" r="15"
                                                            fill="white" stroke="#A1AEBE"
                                                            stroke-width="2" />
                                                      </g>
                                                      <g clip-path="url(#clip1_41157_9825)">
                                                         <path
                                                            d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                            fill="black" />
                                                      </g>
                                                      <defs>
                                                         <clipPath id="clip0_41157_9825">
                                                            <rect width="32" height="32"
                                                                  fill="white" />
                                                         </clipPath>
                                                         <clipPath id="clip1_41157_9825">
                                                            <rect width="15" height="15"
                                                                  fill="white"
                                                                  transform="translate(8 8)" />
                                                         </clipPath>
                                                      </defs>
                                                </svg>
                                             </span>
                                             <span class="icon">
                                                <svg width="32" height="32" viewBox="0 0 32 32"
                                                      fill="none"
                                                      xmlns="http://www.w3.org/2000/svg">
                                                      <g clip-path="url(#clip0_41157_9825)">
                                                         <circle cx="16" cy="16" r="15"
                                                            fill="white" stroke="#A1AEBE"
                                                            stroke-width="2" />
                                                      </g>
                                                      <g clip-path="url(#clip1_41157_9825)">
                                                         <path
                                                            d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                            fill="black" />
                                                      </g>
                                                      <defs>
                                                         <clipPath id="clip0_41157_9825">
                                                            <rect width="32" height="32"
                                                                  fill="white" />
                                                         </clipPath>
                                                         <clipPath id="clip1_41157_9825">
                                                            <rect width="15" height="15"
                                                                  fill="white"
                                                                  transform="translate(8 8)" />
                                                         </clipPath>
                                                      </defs>
                                                </svg>
                                             </span>
                                             <span class="icon">
                                                <svg width="32" height="32" viewBox="0 0 32 32"
                                                      fill="none"
                                                      xmlns="http://www.w3.org/2000/svg">
                                                      <g clip-path="url(#clip0_41157_9825)">
                                                         <circle cx="16" cy="16" r="15"
                                                            fill="white" stroke="#A1AEBE"
                                                            stroke-width="2" />
                                                      </g>
                                                      <g clip-path="url(#clip1_41157_9825)">
                                                         <path
                                                            d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                            fill="black" />
                                                      </g>
                                                      <defs>
                                                         <clipPath id="clip0_41157_9825">
                                                            <rect width="32" height="32"
                                                                  fill="white" />
                                                         </clipPath>
                                                         <clipPath id="clip1_41157_9825">
                                                            <rect width="15" height="15"
                                                                  fill="white"
                                                                  transform="translate(8 8)" />
                                                         </clipPath>
                                                      </defs>
                                                </svg>
                                             </span>
                                             <span class="icon">
                                                <svg width="32" height="32" viewBox="0 0 32 32"
                                                      fill="none"
                                                      xmlns="http://www.w3.org/2000/svg">
                                                      <g clip-path="url(#clip0_41157_9825)">
                                                         <circle cx="16" cy="16" r="15"
                                                            fill="white" stroke="#A1AEBE"
                                                            stroke-width="2" />
                                                      </g>
                                                      <g clip-path="url(#clip1_41157_9825)">
                                                         <path
                                                            d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                            fill="black" />
                                                      </g>
                                                      <defs>
                                                         <clipPath id="clip0_41157_9825">
                                                            <rect width="32" height="32"
                                                                  fill="white" />
                                                         </clipPath>
                                                         <clipPath id="clip1_41157_9825">
                                                            <rect width="15" height="15"
                                                                  fill="white"
                                                                  transform="translate(8 8)" />
                                                         </clipPath>
                                                      </defs>
                                                </svg>
                                             </span>
                                             <span class="icon">
                                                <svg width="32" height="32" viewBox="0 0 32 32"
                                                      fill="none"
                                                      xmlns="http://www.w3.org/2000/svg">
                                                      <g clip-path="url(#clip0_41157_9825)">
                                                         <circle cx="16" cy="16" r="15"
                                                            fill="white" stroke="#A1AEBE"
                                                            stroke-width="2" />
                                                      </g>
                                                      <g clip-path="url(#clip1_41157_9825)">
                                                         <path
                                                            d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                            fill="black" />
                                                      </g>
                                                      <defs>
                                                         <clipPath id="clip0_41157_9825">
                                                            <rect width="32" height="32"
                                                                  fill="white" />
                                                         </clipPath>
                                                         <clipPath id="clip1_41157_9825">
                                                            <rect width="15" height="15"
                                                                  fill="white"
                                                                  transform="translate(8 8)" />
                                                         </clipPath>
                                                      </defs>
                                                </svg>
                                             </span>
                                             <span class="icon">
                                                <svg width="32" height="32" viewBox="0 0 32 32"
                                                      fill="none"
                                                      xmlns="http://www.w3.org/2000/svg">
                                                      <g clip-path="url(#clip0_41157_9825)">
                                                         <circle cx="16" cy="16" r="15"
                                                            fill="white" stroke="#A1AEBE"
                                                            stroke-width="2" />
                                                      </g>
                                                      <g clip-path="url(#clip1_41157_9825)">
                                                         <path
                                                            d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                            fill="black" />
                                                      </g>
                                                      <defs>
                                                         <clipPath id="clip0_41157_9825">
                                                            <rect width="32" height="32"
                                                                  fill="white" />
                                                         </clipPath>
                                                         <clipPath id="clip1_41157_9825">
                                                            <rect width="15" height="15"
                                                                  fill="white"
                                                                  transform="translate(8 8)" />
                                                         </clipPath>
                                                      </defs>
                                                </svg>
                                             </span>
                                             <span class="icon">
                                                <svg width="32" height="32" viewBox="0 0 32 32"
                                                      fill="none"
                                                      xmlns="http://www.w3.org/2000/svg">
                                                      <g clip-path="url(#clip0_41157_9825)">
                                                         <circle cx="16" cy="16" r="15"
                                                            fill="white" stroke="#A1AEBE"
                                                            stroke-width="2" />
                                                      </g>
                                                      <g clip-path="url(#clip1_41157_9825)">
                                                         <path
                                                            d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                            fill="black" />
                                                      </g>
                                                      <defs>
                                                         <clipPath id="clip0_41157_9825">
                                                            <rect width="32" height="32"
                                                                  fill="white" />
                                                         </clipPath>
                                                         <clipPath id="clip1_41157_9825">
                                                            <rect width="15" height="15"
                                                                  fill="white"
                                                                  transform="translate(8 8)" />
                                                         </clipPath>
                                                      </defs>
                                                </svg>
                                             </span>
                                          </div>

                                          <!-- Consultant Profile Modal -->
                                          <div class="modal fade" id="hr-profile-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                             <div class="modal-dialog">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h5 class="modal-title" id="modalLabel">Consultant Details</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <div class="modal-profile">
                                                         <div class="profile-modal-row-top mb-3">
                                                            <div class="profile-img-wrap d-flex align-items-center">
                                                               <div class="profile-img-inner me-3">
                                                                  <img src="{{ asset('public/assets/images/profile-icon-img.png') }}" alt="Profile Picture" class="profile-pic" />
                                                               </div>
                                                               <div>
                                                                  <h3 id="modalName">Name</h3>
                                                                  <p id="modalCode">Employee Id</p>
                                                               </div>
                                                            </div>
                                                         </div>

                                                         <div class="consultancy-info-row-modal mb-3">
                                                            <div class="consultancy-info-inner">
                                                               <h5>Designation: <span id="modalDesignation"></span></h5>
                                                               <h6>Joining Date: <span id="modalJoining"></span></h6>
                                                            </div>
                                                         </div>

                                                         <div class="consultancy-info-modal-listing">
                                                            <ul class="list-unstyled">
                                                               <li><strong>Email:</strong> <span id="modalEmail"></span></li>
                                                               <li><strong>Phone:</strong> <span id="modalPhone"></span></li>
                                                               <li><strong>Address:</strong> <span id="modalAddress"></span></li>
                                                               <li><strong>Other Address:</strong> <span id="modalAltAddress"></span></li>
                                                            </ul>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>



                                    </div>

                                    <div class="calender-small-hr">
                                          <div class="status-buttons">
                                             <button class="status good"><img src="{{ asset('public/assets/images/tick-circle-icon.png') }}" class="img-fluid"> Good To Go</button>
                                             <button class="status hold"><img src="{{ asset('public/assets/images/pause-circle-icon.png') }}" class="img-fluid"> Hold</button>
                                             <button class="status rework"><img src="{{ asset('public/assets/images/recycle-circle-icon.png') }}" class="img-fluid"> Rework</button>
                                          </div>
                                          <div class="calendar" id="show_calendar_{{ $tabId }}">
                                             <div class="weekdays">
                                                <div>SUN</div><div>MON</div><div>TUE</div>
                                                <div>WED</div><div>THU</div><div>FRI</div><div>SAT</div>
                                             </div>
                                             <div class="days" id="days_{{ $tabId }}">
                                                
                                             </div>
                                          </div>
                                    </div>
                                 </div> <!-- /.calendar-ui -->
                              </div>
                        </div>
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
const months = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
let today = new Date(), selMonth = today.getMonth(), selYear = today.getFullYear();
let currentTabId = null;

function toggleGrid(tabId) {
   currentTabId = tabId;
   const grid = document.getElementById("gridPopup_" + tabId);
   grid.style.display = (grid.style.display === "block") ? "none" : "block";
   renderGrid(tabId);
}

function chgYr(d, tabId) {
   selYear += d;
   renderGrid(tabId);
}

function renderGrid(tabId) {
   const yrLbl = document.getElementById("yrLbl_" + tabId);
   const gridMonths = document.getElementById("gridMonths_" + tabId);
   yrLbl.innerText = selYear;
   gridMonths.innerHTML = months.map((m, i) => {
      const selected = (i === selMonth && selYear === today.getFullYear()) ? 'selected' : '';
      return `<button class="${selected}" onclick="setMonth(${i}, '${tabId}')">${m}</button>`;
   }).join("");
}


function setMonth(m, tabId) {
   selMonth = m;
   const full = new Date(selYear, selMonth).toLocaleString('default', { month: 'long' });
   document.getElementById("calendarLabel_" + tabId).innerText = `${full} - ${selYear}`;
   document.getElementById("gridPopup_" + tabId).style.display = "none";

   // AJAX update
   updateTableData(tabId, selMonth + 1, selYear);
   renderCalendar(selMonth, selYear, tabId);
}


function updateTableData(tabId, month, year) {
   const clientId = tabId.replace('client-', '');

   const url = `{{ route('consultant.data.fetch') }}?month=${month}&year=${year}&client_id=${clientId}`;

   fetch(url)
      .then(response => response.text())
      .then(html => {
         const container = document.querySelector(`#v-pills-${tabId} .table-clickable tbody`);
         if (container) {
            container.innerHTML = html;
            bindRowClickEvents(); // ✅ re-bind click events after DOM update
         }
      })
      .catch(error => {
         console.error("Fetch error:", error);
      });
}

function renderCalendar(month, year, tabId) {
   const daysDiv = document.getElementById("days_" + tabId);
   if (!daysDiv) return;

   const startDate = new Date(year, month, 1);
   const startDay = startDate.getDay();
   const daysInMonth = new Date(year, month + 1, 0).getDate();
   let html = "";

   for (let i = 0; i < startDay; i++) html += `<div class="empty"></div>`;
   for (let i = 1; i <= daysInMonth; i++) html += `<div>${i}</div>`;
   const total = startDay + daysInMonth;
   const trailingBlanks = 7 - (total % 7);
   if (trailingBlanks < 7) for (let i = 0; i < trailingBlanks; i++) html += `<div class="empty"></div>`;

   daysDiv.innerHTML = html;
}

// Hide calendar popup on outside click
window.addEventListener("click", e => {
   if (!e.target.closest(".calendar-display") && !e.target.closest(".month-grid-popup")) {
      if (currentTabId) {
         const popup = document.getElementById("gridPopup_" + currentTabId);
         if (popup) popup.style.display = "none";
      }
   }
});

// Init default visible tab's calendar on load
window.addEventListener("DOMContentLoaded", () => {
   const defaultLabel = document.querySelector("[id^='calendarLabel_']");
   if (defaultLabel) {
      const defaultTabId = defaultLabel.id.replace("calendarLabel_", "");
      setMonth(selMonth, defaultTabId);
   }
});

// Refresh calendar when switching tabs
document.querySelectorAll('[data-bs-toggle="pill"]').forEach(btn => {
   btn.addEventListener('shown.bs.tab', function (e) {
      const tabId = e.target.getAttribute('data-bs-target').replace('#v-pills-', '');
      setMonth(selMonth, tabId);
   });
});

function buildCalendarWithRecords(records, month, year) {
   const start = new Date(year, month - 1, 1);
   const totalDays = new Date(year, month, 0).getDate();
   const startDay = start.getDay(); // 0 = Sunday

   const dayMap = {};

   records.forEach(entry => {
      try {
         const record = JSON.parse(entry.record);
         const leaveType = record.leaveType || '';
         const workingHours = parseInt(record.workingHours || 0);

         const applyRange = record.date || '';
         const applySingle = record.applyOnCell?.trim();

         let dates = [];

         if (applyRange.includes('to')) {
            const [startStr, endStr] = applyRange.split('to').map(s => s.trim());
            const startDate = parseDate(startStr);
            const endDate = parseDate(endStr);
            while (startDate <= endDate) {
               dates.push(new Date(startDate));
               startDate.setDate(startDate.getDate() + 1);
            }
         } else if (applySingle) {
            dates.push(parseDate(applySingle));
         }

         dates.forEach(date => {
            const d = date.getDate();
            if (date.getMonth() + 1 === parseInt(month) && date.getFullYear() === parseInt(year)) {
               if (!dayMap[d]) dayMap[d] = {};
               if (leaveType) dayMap[d].leave = leaveType;
               if (workingHours) dayMap[d].hours = workingHours;
            }
         });

      } catch (err) {
         console.warn("Invalid record:", entry, err);
      }
   });

   // ✅ Build calendar
   let html = '';
   for (let i = 0; i < startDay; i++) {
      html += `<div class="empty"></div>`;
   }

   for (let d = 1; d <= totalDays; d++) {
      const info = dayMap[d];
      let cell = `<div>${d}`;
      if (info?.leave) {
         cell += `<br><span class="leave">${info.leave}</span>`;
      }
      if (info?.hours) {
         cell += `<br>${info.hours}`;
      }
      cell += `</div>`;
      html += cell;
   }

   const trailing = (startDay + totalDays) % 7;
   if (trailing > 0) {
      for (let i = 0; i < 7 - trailing; i++) html += `<div class="empty"></div>`;
   }

   return html;
}

function parseDate(str) {
   const [d, m, y] = str.split('/').map(s => parseInt(s.trim()));
   return new Date(y, m - 1, d);
}


// Utility to convert "02 / 06 / 2025" to Date object
function parseDate(str) {
   const [day, month, year] = str.split(" / ").map(s => parseInt(s.trim()));
   return new Date(year, month - 1, day);
}


function bindRowClickEvents() {
   document.querySelectorAll(".table-clickable tbody tr").forEach(row => {
      const isNA = row.dataset.na === "1";

      if (isNA) {
         row.style.cursor = "not-allowed";
         row.classList.add("disabled-row");
         return; // ❌ skip adding click event
      }

      row.style.cursor = "pointer";
      row.addEventListener("click", function () {
         const allRows = this.closest("tbody").querySelectorAll("tr");
         allRows.forEach(r => r.classList.remove("active-row"));
         this.classList.add("active-row");

         // (optional: update calendar logic here)
      });
   });

   document.querySelectorAll(".table-row-click").forEach(row => {
      row.addEventListener("click", function () {
         const name = this.dataset.name;
         const empId = this.dataset.empid;
         const userId = this.dataset.userid;
         const tabId = this.closest(".tab-pane").id.replace("v-pills-", ""); // e.g., client-6

         // ✅ Now target correct calendar
         const calendarContainer = document.querySelector(`#days_${tabId}`);
         if (!calendarContainer) return;

         const records = window.dashboardData[userId] || [];

         const selectedMonth = selMonth + 1; // JavaScript month (0-based)
         const selectedYear = selYear;

         const html = buildCalendarWithRecords(records, selectedMonth, selectedYear);
         calendarContainer.innerHTML = html;

         // ✅ Update profile header
         document.querySelector("#calendar_id h3").innerText = name;
         document.querySelector("#calendar_id p").innerText = `Employee Id : ${empId}`;
         document.getElementById("modalName").innerText = this.dataset.name || '';
         document.getElementById("modalCode").innerText = "Employee Id: " + (this.dataset.empid || '');
         document.getElementById("modalEmail").innerText = this.dataset.email || '';
         document.getElementById("modalPhone").innerText = this.dataset.phone || '';
         document.getElementById("modalAddress").innerText = this.dataset.address || '';
         document.getElementById("modalAltAddress").innerText = this.dataset.altaddress || '';
         document.getElementById("modalJoining").innerText = this.dataset.joining || '';
         document.getElementById("modalDesignation").innerText = this.dataset.designation || '';
      });
   });


}


document.addEventListener("DOMContentLoaded", function () {
   bindRowClickEvents();
});

document.querySelectorAll(".open-profile-modal").forEach(img => {
   img.addEventListener("click", function (e) {
      e.stopPropagation(); // prevent row click

      const myModal = new bootstrap.Modal(document.getElementById('hr-profile-modal'));
      myModal.show();
   });
});
</script>



