@php
    use Illuminate\Support\Str;
    use Carbon\Carbon;
@endphp
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

                                                      <tr>
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
                                 <div class="calendar-ui">
                                    <div class="hr-tab-inner-top-profile-row">
                                          <div class="profile-header">
                                             <img src="{{ asset('public/assets/images/profile-icon-img.png')}}" alt="Profile Picture" class="profile-pic" data-bs-toggle="modal" data-bs-target="#hr-profile-modal-{{ $tabId }}" />
                                             <div>
                                                <h3>{{ $filteredConsultants->first()->emp_name ?? 'No Consultant' }}</h3>
                                                <p>Employee Id : {{ $filteredConsultants->first()->emp_code ?? 'N/A' }}</p>
                                             </div>
                                          </div>

                                          <!-- Modal (unique per tab to avoid ID clash) -->
                                          <div class="modal fade" id="hr-profile-modal-{{ $tabId }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                             <div class="modal-dialog">
                                                <div class="modal-content">
                                                      <div class="modal-body">
                                                         <div class="modal-profile">
                                                            <div class="profile-modal-row-top">
                                                                  <div class="profile-img-wrap">
                                                                     <div class="profile-img-inner">
                                                                        <img src="{{ asset('public/assets/images/profile-icon-img.png')}}" alt="Profile Picture" class="profile-pic" />
                                                                     </div>
                                                                     <div>
                                                                        <h3>{{ $filteredConsultants->first()->emp_name ?? 'No Consultant' }}</h3>
                                                                        <p>{{ $filteredConsultants->first()->emp_code ?? 'N/A' }}</p>
                                                                     </div>
                                                                  </div>
                                                                  <div class="badge-wrap-modal">
                                                                     <div class="active-badge">Active</div>
                                                                  </div>
                                                            </div>
                                                            <div class="consultancy-info-row-modal">
                                                                  <div class="consultancy-info-inner">
                                                                     <h3><img src="{{ asset('public/assets/images/client-icon-1.png')}}"> {{ $client->serving_client }}</h3>
                                                                     <h6>{{ $filteredConsultants->first()->designation ?? '' }}</h6>
                                                                  </div>
                                                                  <div class="consultancy-info-joining-modal">
                                                                     <h5><span>Joining Date :</span> {{ \Carbon\Carbon::parse($filteredConsultants->first()->joining_date ?? '')->format('d / m / Y') }}</h5>
                                                                  </div>
                                                            </div>
                                                            <div class="consultancy-info-modal-listing">
                                                                  <ul>
                                                                     <li>
                                                                        <div class="img-icon"><img src="{{ asset('public/assets/images/phn-circle-icon-1.png') }}" class="img-fluid"></div>
                                                                        <p>{{ $filteredConsultants->first()->mobile_number ?? '' }}</p>
                                                                     </li>
                                                                     <li>
                                                                        <div class="img-icon"><img src="{{ asset('public/assets/images/msg-circle-icon-1.png') }}" class="img-fluid"></div>
                                                                        <p>{{ $filteredConsultants->first()->email ?? '' }}</p>
                                                                     </li>
                                                                     <li>
                                                                        <div class="img-icon"><img src="{{ asset('public/assets/images/location-circle-icon-1.png') }}" class="img-fluid"></div>
                                                                        <p>{{ $filteredConsultants->first()->full_address ?? '' }}</p>
                                                                     </li>
                                                                     <li>
                                                                        <div class="img-icon"><img src="{{ asset('public/assets/images/dots-circle-icon-1.png') }}" class="img-fluid"></div>
                                                                        <p>{{ $filteredConsultants->first()->show_address_input ?? '' }}</p>
                                                                     </li>
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
                                             <div class="days" id="days_{{ $tabId }}"></div>
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
   renderCalendar(selMonth, selYear, tabId);
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


document.addEventListener("DOMContentLoaded", function () {
   document.querySelectorAll(".table-clickable tbody tr").forEach(row => {
      row.addEventListener("click", function () {
         // remove active from other rows in the same table
         const allRows = this.closest("tbody").querySelectorAll("tr");
         allRows.forEach(r => r.classList.remove("active-row"));
         
         // add active to clicked row
         this.classList.add("active-row");
      });
   });
});
</script>

