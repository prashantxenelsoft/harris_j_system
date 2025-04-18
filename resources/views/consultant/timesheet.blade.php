<div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="homeconsultant" role="tabpanel" aria-labelledby="pills-home-tab">...</div>

            <div class="tab-pane fade show active" id="timesheet" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="container my-4">
                    <div class="row">
                        <div class="col-lg-9 col-xl-8">
                            <div class="calender-wrap-parent">
                                <div class="login-dashboard-top-bar mb-0">
                                    <div class="left-col-top-bar">
                                    @if($consultant)
                                        <div class="employee-details-consultant">
                                            <ul>
                                                <li>
                                                    <h6>Employee ID</h6>
                                                    <p>: {{ $consultant->emp_code ?? 'N/A' }}</p>
                                                </li>
                                                <li>
                                                    <h6>Employee Name</h6>
                                                    <p>: {{ $consultant->emp_name ?? 'N/A' }}</p>
                                                </li>
                                                
                                            </ul>
                                        </div>

                                        <div class="client-details-consultant">
                                            <ul>
                                                <li> 
                                                    <h6>Client Name</h6>
                                                    <p>: {{ $consultant->client_name ?? 'N/A' }}</p>
                                                </li>
                                                <li>
                                                    <h6>Reporting Manager</h6>
                                                    <p>: {{ $consultant->designation ?? 'N/A' }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    @else
                                        <p>No consultant data found.</p>
                                    @endif

                                    </div>

                                    <div class="right-col-top-bar">
                                        <div class="calendar-top-header-btn-group">
                                            <a href="#" class="edit-icon">
                                                <i class="fa fa-pen"></i>
                                            </a>

                                            <a href="#" class="save-btn">
                                                <img src="{{ asset('public/assets/latest/images/save-icon-circle.png') }}" class="img-fluid" />
                                                Save
                                            </a>

                                            <a href="#" class="submit-btn">
                                                Submit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                           
                                    <div class="calendar-container">
                                       

                                        <div class="calendar">
                                            <div class="calendar-nav">
                                                <div class="calendar-tools">
                                                <i>A</i>
                                                <i>&#9992;</i>
                                                <i>&#x25C9;</i>
                                                <i>&#9998;</i>
                                                <i>&#128197;</i>
                                                <i>&#x1F5C3;</i>
                                                </div>
                                                <div class="month-controls">
                                                <button onclick="changeMonth(-1)">&#x25C0;</button>
                                                <select id="monthSelect"></select>
                                                <select id="yearSelect"></select>
                                                <button onclick="changeMonth(1)">&#x25B6;</button>
                                                </div>
                                            </div>
                                            <div class="calendar-grid" id="calendarDays">
                                                <div class="day-label">Sunday</div>
                                                <div class="day-label">Monday</div>
                                                <div class="day-label">Tuesday</div>
                                                <div class="day-label">Wednesday</div>
                                                <div class="day-label">Thursday</div>
                                                <div class="day-label">Friday</div>
                                                <div class="day-label">Saturday</div>
                                            </div>
                                        </div>
                                        

                                        <div class="modal fade" id="medicalLeave" tabindex="-1" aria-labelledby="medicalLeaveModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="model_employee">
                                                            <div class="model_emp_img">
                                                                <img src="{{ asset('public/assets/latest/images/emp-icon1.png') }}" alt="">
                                                            </div>
                                                            <span class="model_emp_name">Bruce Lee</span>
                                                        </div>
                                                        <button type="button" class="btn-close ml-close-btn" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        <div class="modal_body_inner">
                                                            <div class="mb_left">
                                                                <div class="ml_date_box">
                                                                    <div class="ml_date">
                                                                        <span>Date: <span>19 / 08 / 2024</span></span>
                                                                    </div>
                                                                    <div class="ml_duty_time">
                                                                        <span>Time On Duty : <span>  -- / 8.30</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="ml_leave_detail">
                                                                    <div class="leave_type">
                                                                        <span>Leave type :</span>
                                                                        <h2>Medical Leave (ML)</h2>
                                                                    </div>
                                                                    <div class="select_leave_hour">
                                                                        <span>ML leave hours :</span>
                                                                    </div>
                                                                    <div class="ml_leave_hour">
                                                                        <ul>
                                                                            <li>
                                                                                <input type="radio" name="Day" id="fullDay">
                                                                                <img src="{{ asset('public/assets/latest/images/night-day.png') }}" alt="">
                                                                                <label for="fullDay">Full Day</label>
                                                                            </li>
                                                                            <li>
                                                                                <input type="radio" name="Day" id="sHalfDay">
                                                                                <img src="{{ asset('public/assets/latest/images/night-day.png') }}" alt="">
                                                                                <label for="sHalfDay">Second half workday (HD2)</label>
                                                                            </li>
                                                                        </ul>
                                                                        <ul>
                                                                            <li>
                                                                                <input type="radio" name="Day" id="fHalfDay">
                                                                                <img src="{{ asset('public/assets/latest/images/night-day.png') }}" alt="">
                                                                                <label for="fHalfDay">First half workday (HD1)</label>
                                                                            </li>
                                                                            <li>
                                                                                <input type="radio" name="Day" id="customDay">
                                                                                <img src="{{ asset('public/assets/latest/images/custom-wheel.png') }}" alt="">
                                                                                <label for="customDay">First half workday (HD1)</label>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="date_selector">
                                                                        <span>Select date :</span>
                                                                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                                                                        <style>
                                                                            #dateRange {
                                                                                border-radius: 8px;
                                                                                padding: 10px 12px;
                                                                                border: 1px solid #ccc;
                                                                                width: 100%;
                                                                                font-size: 14px;
                                                                                margin-top: 10px;
                                                                            }
                                                                        </style>
                                                                        <input type="text" id="dateRange" placeholder="dd / mm / yyyy - dd / mm / yyyy">
                                                                        <!-- Flatpickr JS -->
                                                                        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                                                                        <script>
                                                                            flatpickr("#dateRange", {
                                                                            mode: "range",
                                                                            dateFormat: "d / m / Y"
                                                                            });
                                                                        </script>
                                                                    </div>

                                                                    


                                                                    <div class="leave_slot_selector">
                                                                        <span>Select Leave Slot :</span>
                                                                        <div class="day_and_night_selector">
                                                                            <div class="day_night">
                                                                                <span>Mid - Night</span>
                                                                                <div class="mid_night_img">
                                                                                    <img src="{{ asset('public/assets/latest/images/moon.png') }}" alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="day_night">
                                                                                <span>Noon</span>
                                                                                <div class="mid_night_img">
                                                                                 <img src="{{ asset('public/assets/latest/images/sun.png') }}" alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="day_night">
                                                                                <span>Mid - Night</span>
                                                                                <div class="mid_night_img">
                                                                                <img src="{{ asset('public/assets/latest/images/moon.png') }}" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="range_selector">
                                                                            <div class="range">
                                                                                <div class="range-slider">
                                                                                    <span class="range-selected"></span>
                                                                                    <span class="tooltips min-tooltip">7:30 AM</span>
                                                                                    <span class="tooltips max-tooltip">4:00 PM</span>
                                                                                </div>
                                                                                
                                                                                <div class="range-input">
                                                                                    <input type="range" class="min" min="0" max="47" value="15" step="1">
                                                                                    <input type="range" class="max" min="0" max="47" value="32" step="1">
                                                                                    </div>
                                                                                
                                                                                </div>
                                                                                <div class="range-scale"><div class="tick tick-large"><span class="tick-label">12<br>AM</span></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-large"><span class="tick-label">4<br>AM</span></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-large"><span class="tick-label">8<br>AM</span></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-large"><span class="tick-label">12<br>PM</span></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-large"><span class="tick-label">4<br>PM</span></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-large"><span class="tick-label">8<br>PM</span></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-large"><span class="tick-label">12<br>AM</span></div></div> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="upload_certificate">
                                                                        <div class="file_input">
                                                                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                                                            <p>Upload Medical Leave Certificate</p>
                                                                        </div>
                                                                        <input type="file" name="" id="uploadFile">
                                                                        <p>*Allow to upload file <span>PNG,JPG,PDF</span> (Max.file size: 1MB)</p>
                                                                    </div>
                                                                    <div class="clock_it_btn">
                                                                        <button class="ml_cancel_btn">
                                                                            Cancel   
                                                                        </button>
                                                                        <button class="ml_clockit_btn">
                                                                            Clock It   
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-right">
                                                                <h3 class="mb_right_title">
                                                                    Documents List
                                                                </h3>
                                                                <div class="ml_document_list">
                                                                    <div class="ml_no_data">
                                                                    <img src="{{ asset('public/assets/latest/images/no-file.png') }}" alt="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Custom Leave Model -->
                                        <div class="modal fade " id="customLeave" tabindex="-1" aria-labelledby="customLeaveModal" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="model_employee">
                                                            <div class="model_emp_img">
                                                                <img src="{{ asset('public/assets/latest/images/emp-icon1.png') }}" alt="">
                                                            </div>
                                                            <span class="model_emp_name">Bruce Lee</span>
                                                        </div>
                                                        <button type="button" class="btn-close ml-close-btn" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        <div class="modal_body_inner">
                                                            <div class="mb_left">
                                                                <div class="ml_date_box">
                                                                    <div class="ml_date">
                                                                        <span>Date: <span>19 / 08 / 2024</span></span>
                                                                    </div>
                                                                    <div class="ml_duty_time">
                                                                        <span>Time On Duty : <span>  -- / 8.30</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="ml_leave_detail">
                                                                <div class="leave_type">
                                                                    <span>Select leave type :</span>
                                                                </div>
                                                                <div class="leave_type_options">
                                                                    <div><a href="#">AL</a></div>
                                                                    <div><a href="#">UL</a></div>
                                                                    <div><a href="#">PDO</a></div>
                                                                </div>
                                                                <div class="select_leave_hour">
                                                                    <span>Select  leave hours :</span>
                                                                </div>
                                                                    <div class="ml_leave_hour">
                                                                        <ul>
                                                                            <li>
                                                                                <input type="radio" name="Day" id="fullDay">
                                                                                <img src="{{ asset('public/assets/latest/images/night-day.png') }}" alt="">
                                                                                <label for="fullDay">Full Day</label>
                                                                            </li>
                                                                            <li>
                                                                                <input type="radio" name="Day" id="sHalfDay">
                                                                                <img src="{{ asset('public/assets/latest/images/night-day.png') }}" alt="">
                                                                                <label for="sHalfDay">Second half workday (HD2)</label>
                                                                            </li>
                                                                        </ul>
                                                                        <ul>
                                                                            <li>
                                                                                <input type="radio" name="Day" id="fHalfDay">
                                                                                <img src="{{ asset('public/assets/latest/images/night-day.png') }}" alt="">
                                                                                <label for="fHalfDay">First half workday (HD1)</label>
                                                                            </li>
                                                                            <li>
                                                                                <input type="radio" name="Day" id="customDay">
                                                                                <img src="{{ asset('public/assets/latest/images/custom-wheel.png') }}" alt="">
                                                                                <label for="customDay">First half workday (HD1)</label>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="date_selector">
                                                                        <span>Select date :</span>
                                                                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                                                                        <style>
                                                                            #dateRange {
                                                                                border-radius: 8px;
                                                                                padding: 10px 12px;
                                                                                border: 1px solid #ccc;
                                                                                width: 100%;
                                                                                font-size: 14px;
                                                                                margin-top: 10px;
                                                                            }
                                                                        </style>
                                                                        <input type="text" id="dateRange" placeholder="dd / mm / yyyy - dd / mm / yyyy">
                                                                        <!-- Flatpickr JS -->
                                                                        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                                                                        <script>
                                                                            flatpickr("#dateRange", {
                                                                            mode: "range",
                                                                            dateFormat: "d / m / Y"
                                                                            });
                                                                        </script>
                                                                    </div>

                                                                    


                                                                    <div class="leave_slot_selector">
                                                                        <span>Select Leave Slot :</span>
                                                                        <div class="day_and_night_selector">
                                                                            <div class="day_night">
                                                                                <span>Mid - Night</span>
                                                                                <div class="mid_night_img">
                                                                                    <img src="{{ asset('public/assets/latest/images/moon.png') }}" alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="day_night">
                                                                                <span>Noon</span>
                                                                                <div class="mid_night_img">
                                                                                 <img src="{{ asset('public/assets/latest/images/sun.png') }}" alt="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="day_night">
                                                                                <span>Mid - Night</span>
                                                                                <div class="mid_night_img">
                                                                                <img src="{{ asset('public/assets/latest/images/moon.png') }}" alt="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="range_selector">
                                                                            <div class="range">
                                                                                <div class="range-slider">
                                                                                    <span class="range-selected"></span>
                                                                                    <span class="tooltips min-tooltip">7:30 AM</span>
                                                                                    <span class="tooltips max-tooltip">4:00 PM</span>
                                                                                </div>
                                                                                
                                                                                <div class="range-input"> 
                                                                                    <input type="range" class="min" min="0" max="47" value="15" step="1">
                                                                                    <input type="range" class="max" min="0" max="47" value="32" step="1">
                                                                                    </div>
                                                                                
                                                                                </div>
                                                                                <div class="range-scale"><div class="tick tick-large"><span class="tick-label">12<br>AM</span></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-large"><span class="tick-label">4<br>AM</span></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-large"><span class="tick-label">8<br>AM</span></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-large"><span class="tick-label">12<br>PM</span></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-large"><span class="tick-label">4<br>PM</span></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-large"><span class="tick-label">8<br>PM</span></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-medium"></div><div class="tick tick-small"></div><div class="tick tick-large"><span class="tick-label">12<br>AM</span></div></div> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="add_remark">
                                                                        <span>Remarks</span>
                                                                        <textarea name="remarks" id="customRemark" rows="6" placeholder="Write your remarks.."></textarea>
                                                                    </div>
                                                                    <div class="clock_it_btn">
                                                                        <button class="ml_cancel_btn">
                                                                            Cancel   
                                                                        </button>
                                                                        <button class="ml_clockit_btn">
                                                                            Clock It   
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-right">
                                                                <h3 class="mb_right_title">
                                                                    Documents List
                                                                </h3>
                                                                <div class="ml_document_list">
                                                                    <div class="ml_no_data">
                                                                    <img src="{{ asset('public/assets/latest/images/no-file.png') }}" alt="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <script>
                                            const calendarDays = document.getElementById("calendarDays");
                                            const monthSelect = document.getElementById("monthSelect");
                                            const yearSelect = document.getElementById("yearSelect");
                                            const dropdownSuggestions = [
                                                { label: "PH", icon: "&#128170;" },
                                                { label: "AL", icon: "&#127873;" },
                                                { label: "ML", icon: "&#128154;" },
                                                { label: "PDO", icon: "&#128100;&#8205;&#9794;️" },
                                                { label: "Custom", icon: "&#128295;" }
                                            ];

                                            let currentDate = new Date();
                                            let highlightedCell = null;

                                            function populateMonthYearSelectors() {
                                                const months = Array.from({ length: 12 }, (_, i) => new Date(0, i).toLocaleString('default', { month: 'long' }));
                                                months.forEach((m, i) => {
                                                const opt = new Option(m, i);
                                                if (i === currentDate.getMonth()) opt.selected = true;
                                                monthSelect.appendChild(opt);
                                                });

                                                for (let y = 1970; y <= 2100; y++) {
                                                const opt = new Option(y, y);
                                                if (y === currentDate.getFullYear()) opt.selected = true;
                                                yearSelect.appendChild(opt);
                                                }
                                            }

                                            monthSelect.addEventListener("change", () => {
                                                currentDate.setMonth(+monthSelect.value);
                                                renderCalendar();
                                            });

                                            yearSelect.addEventListener("change", () => {
                                                currentDate.setFullYear(+yearSelect.value);
                                                renderCalendar();
                                            });

                                            function renderCalendar() {
                                                const year = currentDate.getFullYear();
                                                const month = currentDate.getMonth();

                                                calendarDays.querySelectorAll(".calendar-cell").forEach(e => e.remove());

                                                const firstDay = new Date(year, month, 1).getDay();
                                                const daysInMonth = new Date(year, month + 1, 0).getDate();

                                                for (let i = 0; i < firstDay; i++) {
                                                calendarDays.innerHTML += `<div class="calendar-cell disabled"></div>`;
                                                }

                                                for (let i = 1; i <= daysInMonth; i++) {
                                                const date = new Date(year, month, i);
                                                const cell = document.createElement("div");
                                                cell.classList.add("calendar-cell");
                                                if (i === 16 && month === 7 && year === 2024) {
                                                    cell.classList.add("highlighted");
                                                    highlightedCell = cell;
                                                }

                                                const dateLabel = document.createElement("div");
                                                dateLabel.classList.add("cell-date");
                                                dateLabel.innerText = i;
                                                cell.appendChild(dateLabel);

                                                const day = date.getDay();
                                                if (day === 0 || day === 6) {
                                                    cell.classList.add("disabled");
                                                } else {
                                                    cell.addEventListener("click", (e) => showInputDropdown(e, cell));
                                                }

                                                // Add example tags with blue color
                                                const tagRules = {
                                                "3-2025": [  // April 2025
                                                    { index: 1, label: "PDO" },
                                                    { index: 2, label: "8" },
                                                    { index: 8, label: "5" },
                                                    { index: 9, label: "PH" },
                                                    { index: 15, label: "ML" },
                                                    { index: 16, label: "AL" },
                                                    { index: 25, label: "6" },
                                                ],
                                                "4-2025": [
                                                    { index: 2, label: "PH" },
                                                    { index: 20, label: "8" },
                                                ]
                                            };

                                            // Example: current month = 4, year = 2025
                                            const currentKey = `${month}-${year}`;
                                            if (tagRules[currentKey]) {
                                                tagRules[currentKey].forEach(rule => {
                                                    if (i === rule.index) {
                                                        applyTag(cell, rule.label, "#007bff");
                                                    }
                                                });
                                            }


                                                calendarDays.appendChild(cell);
                                                }
                                            }

                                            function showInputDropdown(event, cell) {
                                                closeAllDropdowns();

                                                const dropdown = document.createElement("div");
                                                dropdown.classList.add("dropdown");

                                                const cellRect = cell.getBoundingClientRect();
                                                const dropdownWidth = 180;
                                                const leftPosition = (cellRect.width - dropdownWidth) / 2;
                                                dropdown.style.left = `${leftPosition}px`;

                                                const input = document.createElement("input");
                                                input.placeholder = 'Type label...';

                                                const suggestionBox = document.createElement("div");
                                                suggestionBox.className = 'suggestions';

                                                function updateSuggestions(val) {
                                                suggestionBox.innerHTML = "";
                                                dropdownSuggestions
                                                    .filter(s => s.label.toLowerCase().includes(val.toLowerCase()))
                                                    .forEach(item => {
                                                    const opt = document.createElement("div");
                                                    opt.innerHTML = `<span style="margin-right: 8px;">${item.icon}</span>${item.label}`;
                                                    opt.onclick = () => {
                                                       // console.log("check item",item);
                                                        if (item.label === "ML") {
                                                            const modal = new bootstrap.Modal(document.getElementById("medicalLeave"));
                                                            modal.show();
                                                        }
                                                        if (item.label === "Custom") {
                                                            const modalCustomLeave = new bootstrap.Modal(document.getElementById("customLeave"));
                                                            modalCustomLeave.show();
                                                        }
                                                        applyTag(cell, item.label, "#007bff");
                                                        dropdown.remove();
                                                    }
                                                    suggestionBox.appendChild(opt);
                                                    });
                                                }

                                                input.addEventListener("input", () => updateSuggestions(input.value));
                                                input.addEventListener("keydown", e => {
                                                if (e.key === "Enter") {
                                                    if (input.value.trim() !== "") {
                                                    applyTag(cell, input.value.trim(), "#007bff");
                                                    dropdown.remove();
                                                    }
                                                }
                                                });

                                                dropdown.appendChild(input);
                                                dropdown.appendChild(suggestionBox);
                                                cell.appendChild(dropdown);
                                                input.focus();
                                                updateSuggestions("");
                                            }

                                            function applyTag(cell, label, color = "#007bff") {
                                                cell.querySelectorAll(".tag").forEach(t => t.remove());

                                                const tag = Object.assign(document.createElement("div"), {
                                                    className: "tag",
                                                    innerText: label
                                                });

                                                if (["PDO", "PH", "AL", "ML"].includes(label)) {
                                                    tag.style.color = "blue";
                                                } else if (!isNaN(label) && parseInt(label) < 8) {
                                                    tag.style.color = "red";
                                                }

                                                cell.appendChild(tag);
                                            }

                                            function closeAllDropdowns() {
                                                document.querySelectorAll(".dropdown").forEach(d => d.remove());
                                            }

                                            function changeMonth(delta) {
                                                currentDate.setMonth(currentDate.getMonth() + delta);
                                                monthSelect.value = currentDate.getMonth();
                                                yearSelect.value = currentDate.getFullYear();
                                                renderCalendar();
                                            }

                                            document.addEventListener("click", function(e) {
                                                if (!e.target.closest(".calendar-cell")) closeAllDropdowns();
                                            });

                                            populateMonthYearSelectors();
                                            renderCalendar();
                                        </script>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xl-4">
                            <div class="timeline-parent-col">
                                <h6>
                                    <i class="fa-solid fa-caret-down"></i>
                                    Encore Films
                                </h6>

                                <div class="timelines-inner">
                                    <ul>
                                        <li>
                                            <div class="timeline-item">
                                                <div class="timeline-icon blue"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-title">Timesheet Overview</div>
                                                    <span class="badge draft">Draft</span>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="timeline-item">
                                                <div class="timeline-icon green"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-title">Timesheet Overview</div>
                                                    <span class="badge approved">Auto Approved</span>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="timeline-item line">
                                                <div class="timeline-icon yellow"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-title">Timesheet Overview</div>
                                                    <span class="badge submitted">Submitted</span>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="timeline-item">
                                                <div class="timeline-icon blue"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-title">Timesheet Overview</div>
                                                    <span class="badge draft">Draft</span>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="timeline-item">
                                                <div class="timeline-icon green"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-title">Timesheet Overview</div>
                                                    <span class="badge approved">Auto Approved</span>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="timeline-item line">
                                                <div class="timeline-icon yellow"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-title">Timesheet Overview</div>
                                                    <span class="badge submitted">Submitted</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 bottom-remark-timesheet-group">
                            <div class="col-lg-6 col-xl-4 mb-4 mb-xl-none">
                                <div class="work-summary">
                                    <!-- Expand Button -->
                                    <button class="expand-btn" data-bs-toggle="modal"
                                        data-bs-target="#workSummaryModal">
                                        <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" class="img-fluid" />
                                    </button>

                                    <!-- Tabs -->
                                    <ul class="nav nav-tabs" id="workTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="leave-tab" data-bs-toggle="tab"
                                                data-bs-target="#leave" type="button" role="tab">Leave Log</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="summary-tab" data-bs-toggle="tab"
                                                data-bs-target="#summary" type="button" role="tab">Work summery</button>
                                        </li>
                                    </ul>



                                    <div class="tab-content tab_content_body border border-top-0 p-1 p-xxl-3" id="workTabsContent">
                                        <div class="tab-pane fade" id="leave" role="tabpanel"
                                            aria-labelledby="leave-tab">
                                            <div class="leave-log w-100">
                                                            <table class="w-100">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Type Of Leave</th>
                                                                        <th>From</th>
                                                                        <th>To</th>
                                                                        <th>Days</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><span class="leave-type pdo lt_btn1">PDO</span></td>
                                                                        <td>05/05/2024</td>
                                                                        <td>05/05/2024</td>
                                                                        <td class="half-day">1/2</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><span class="leave-type ml lt_btn1">ML
                                                                                <sup>HD1</sup></span></td>
                                                                        <td>09/05/2024</td>
                                                                        <td>09/05/2024</td>
                                                                        <td class="half-day">1/2</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><span class="leave-type ul lt_btn2">UL</span></td>
                                                                        <td>11/05/2024</td>
                                                                        <td>11/05/2024</td>
                                                                        <td class="half-day">1/2</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><span class="leave-type ul-hd lt_btn2">UL
                                                                                <sup>HD1</sup></span></td>
                                                                        <td>22/05/2024</td>
                                                                        <td>22/05/2024</td>
                                                                        <td class="half-day">1/2</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                        </div>
                                        <div class="tab-pane fade show active" id="summary" role="tabpanel"
                                            aria-labelledby="summary-tab">
                                            <div class="stats-box">
                                                <div>
                                                    <div class="stats-number">168</div>
                                                    <div class="stats-label">Hours Forecasted</div>
                                                </div>
                                                <div>
                                                    <div class="stats-number">168</div>
                                                    <div class="stats-label">Hours Logged</div>
                                                </div>
                                            </div>

                                            <div class="bottom-stats">
                                                <div>15</div>
                                                <div>10</div>
                                                <div>03</div>
                                                <div>02</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="workSummaryModal" tabindex="-1"
                                    aria-labelledby="workSummaryModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header ">
                                                <button type="button" class="btn-close popup-expand-btn "
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body ">
                                                <!-- Reuse same tab structure inside modal -->
                                                <ul class="nav nav-tabs popup_tabs" id="modalTabs" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link tab_btn" id="modal-leave-tab"
                                                            data-bs-toggle="tab" data-bs-target="#modal-leave"
                                                            type="button" role="tab">Leave Log</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link tab_btn active" id="modal-summary-tab"
                                                            data-bs-toggle="tab" data-bs-target="#modal-summary"
                                                            type="button" role="tab">Work Log Summary</button>
                                                    </li>
                                                </ul>

                                                <div class="tab-content tab_content_body">
                                                    <div class="tab-pane fade" id="modal-leave" role="tabpanel">
                                                        <div class="leave-log w-100">
                                                            <table class="w-100">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Type Of Leave</th>
                                                                        <th>From</th>
                                                                        <th>To</th>
                                                                        <th>Days</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><span class="leave-type pdo lt_btn1">PDO</span></td>
                                                                        <td>05/05/2024</td>
                                                                        <td>05/05/2024</td>
                                                                        <td class="half-day">1/2</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><span class="leave-type ml lt_btn1">ML
                                                                                <sup>HD1</sup></span></td>
                                                                        <td>09/05/2024</td>
                                                                        <td>09/05/2024</td>
                                                                        <td class="half-day">1/2</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><span class="leave-type ul lt_btn2">UL</span></td>
                                                                        <td>11/05/2024</td>
                                                                        <td>11/05/2024</td>
                                                                        <td class="half-day">1/2</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><span class="leave-type ul-hd lt_btn2">UL
                                                                                <sup>HD1</sup></span></td>
                                                                        <td>22/05/2024</td>
                                                                        <td>22/05/2024</td>
                                                                        <td class="half-day">1/2</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade show active" id="modal-summary"
                                                        role="tabpanel">
                                                        <div class="stats-box">
                                                            <div>
                                                                <div class="stats-number">168</div>
                                                                <div class="stats-label">Total Work Hours</div>
                                                            </div>
                                                            <div>
                                                                <div class="stats-number">168</div>
                                                                <div class="stats-label">Billed Work Hours</div>
                                                            </div>
                                                        </div>

                                                        <div class="bottom-stats">
                                                            <div class="stats_score">
                                                                <span class="w_hrs">06.30</span>
                                                                 / <span class="tw_hrs">15</span>
                                                                 <p>Total Work Hours</p>
                                                            </div>
                                                            <div class="stats_score">
                                                                <span class="w_hrs">05.30</span>
                                                                 / <span class="tw_hrs">15</span>
                                                                 <p>AL</p>
                                                            </div>
                                                            <div class="stats_score">
                                                                <span class="w_hrs">01.45</span>
                                                                 / <span class="tw_hrs">14</span>
                                                                 <p>MC</p>
                                                            </div>
                                                            <div class="stats_score">
                                                                <span class="w_hrs">01.30</span>
                                                                 / <span class="tw_hrs">03</span>
                                                                 <p>Total Work Hours</p>
                                                            </div>
                                                            <div class="stats_score">
                                                                <span class="w_hrs">0.30</span>
                                                                 / <span class="tw_hrs">02</span>
                                                                 <p>PDO</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6 col-xl-4 mb-4 mb-xl-none">
                                <div class="remark-section card p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6>Remarks</h6>
                                        <div class="btn-group-remark">
                                            <button class="btn btn-link p-0 text-danger" data-bs-toggle="modal"
                                                data-bs-target="#remarksModal">
                                                <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" class="img-fluid" />
                                            </button>

                                             <!-- edit button -->
                                            <button class="flow-edit-btn" data-bs-toggle="modal"
                                                data-bs-target="#editRemarksModal">
                                                <i class="fa-solid fa-pen-nib"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="remark-timeline">
                                        <div class="remark-item mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2 text-primary">
                                                    <div class="dot bg-primary rounded-circle"
                                                        style="width:10px; height:10px;"></div>
                                                    <div class="line bg-primary"
                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2"
                                                            title="Alena" />
                                                        <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45
                                                            AM</small>
                                                    </div>
                                                    <p>This is Approved, Thank you for the excellent contribution</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="remark-item mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2 text-primary">
                                                    <div class="dot bg-primary rounded-circle"
                                                        style="width:10px; height:10px;"></div>
                                                    <div class="line bg-primary"
                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2"
                                                            title="Alena" />
                                                        <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45
                                                            AM</small>
                                                    </div>
                                                    <p>This is Approved, Thank you for the excellent contribution</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="remark-item mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2 text-primary">
                                                    <div class="dot bg-primary rounded-circle"
                                                        style="width:10px; height:10px;"></div>
                                                    <div class="line bg-primary"
                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2"
                                                            title="Alena" />
                                                        <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45
                                                            AM</small>
                                                    </div>
                                                    <p>This is Approved, Thank you for the excellent contribution</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="remark-item mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2 text-primary">
                                                    <div class="dot bg-primary rounded-circle"
                                                        style="width:10px; height:10px;"></div>
                                                    <div class="line bg-primary"
                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2"
                                                            title="Alena" />
                                                        <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45
                                                            AM</small>
                                                    </div>
                                                    <p>This is Approved, Thank you for the excellent contribution</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Modal for Expanded View -->
                                <div class="modal fade" id="remarksModal" tabindex="-1"
                                    aria-labelledby="remarksModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="remarksModalLabel">Remarks</h5>
                                                <button type="button" class="btn-close popup-expand-btn" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- You can repeat the same timeline markup from above here -->
                                                <div class="remark-timeline">
                                                    <div class="remark-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <div class="me-3 text-primary">
                                                                <div class="dot bg-primary rounded-circle"
                                                                    style="width:10px; height:10px;"></div>
                                                                <div class="line bg-primary"
                                                                    style="width:2px; height:100%; margin-left:4px;"></div>
                                                            </div>
                                                            <div>
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2"
                                                                        title="Alena" />
                                                                    <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45
                                                                        AM</small>
                                                                </div>
                                                                <p>This is Approved, Thank you for the excellent contribution</p>
                                                            </div>
                                                        </div>
                                                    </div>
            
                                                    <div class="remark-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <div class="me-3 text-primary">
                                                                <div class="dot bg-primary rounded-circle"
                                                                    style="width:10px; height:10px;"></div>
                                                                <div class="line bg-primary"
                                                                    style="width:2px; height:100%; margin-left:4px;"></div>
                                                            </div>
                                                            <div>
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2"
                                                                        title="Alena" />
                                                                    <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45
                                                                        AM</small>
                                                                </div>
                                                                <p>This is Approved, Thank you for the excellent contribution</p>
                                                            </div>
                                                        </div>
                                                    </div>
            
                                                    <div class="remark-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <div class="me-3 text-primary">
                                                                <div class="dot bg-primary rounded-circle"
                                                                    style="width:10px; height:10px;"></div>
                                                                <div class="line bg-primary"
                                                                    style="width:2px; height:100%; margin-left:4px;"></div>
                                                            </div>
                                                            <div>
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2"
                                                                        title="Alena" />
                                                                    <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45
                                                                        AM</small>
                                                                </div>
                                                                <p>This is Approved, Thank you for the excellent contribution</p>
                                                            </div>
                                                        </div>
                                                    </div>
            
                                                    <div class="remark-item mb-3">
                                                        <div class="d-flex align-items-start">
                                                            <div class="me-3 text-primary">
                                                                <div class="dot bg-primary rounded-circle"
                                                                    style="width:10px; height:10px;"></div>
                                                                <div class="line bg-primary"
                                                                    style="width:2px; height:100%; margin-left:4px;"></div>
                                                            </div>
                                                            <div>
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2"
                                                                        title="Alena" />
                                                                    <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45
                                                                        AM</small>
                                                                </div>
                                                                <p>This is Approved, Thank you for the excellent contribution</p>
                                                            </div>
                                                        </div>
                                                    </div>
            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="modal fade" id="editRemarksModal" tabindex="-1"
                                    aria-labelledby="editRemarksModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header ">
                                               <div class="remark_popup_detial">
                                                <div class="r_img">
                                                    <img src="{{ asset('public/assets/latest/images/emp-icon1.png') }}" class="img-fluid" />
                                                </div>
                                                <div class="r_detail">
                                                    <span class="r_name">Bruce Lee</span>
                                                    <p class="r_id">Employee Id : Emp14982 </p>
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
                                            <div class="modal-body ">
                                                <div class="rc_detail_box">
                                                    <div class="rc_left_detail">
                                                        <div class="rc_box">
                                                            <div class="rc_img">
                                                                 <img src="{{ asset('public/assets/latest/images/client-icon-1.png') }}" class="img-fluid" />
                                                            </div>
                                                            <span class="rc_name">Encore Films</span>
                                                        </div>
                                                        <p class="rc_status">Remarks  For : <span>Approved <i class="fa-solid fa-check"></i></span></p>
                                                    </div>
                                                    <div class="rc_right_detail">
                                                        <p>Designation : <span>Information Security Analyst</span></p>
                                                    </div>
                                                </div>
                                                <div class="r_text_area">
                                                    <textarea name="r_update" id="" placeholder="Your timesheet was Approved."></textarea>
                                                </div>

                                                <div class="r_update_btn">
                                                    <button type="button" class="btn-close "
                                                   data-bs-dismiss="modal" aria-label="Close">
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
                            </div>

                            <div class="col-lg-6 col-xl-4">
                                <div class="timesheet-section card p-2">

                                    <!-- Tabs -->
                                    <div class="timesheet-header d-flex justify-content-between align-items-start">
                                        <ul class="nav nav-tabs" id="timesheetTabs">
                                            <li class="nav-item">
                                                <button class="nav-link active" data-bs-toggle="tab"
                                                    data-bs-target="#overviewTab">Timesheet Overview</button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab"
                                                    data-bs-target="#extraTimeTab">Extra Time Log</button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab"
                                                    data-bs-target="#payOffTab">Pay-Off Log</button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab"
                                                    data-bs-target="#compOffTab">Comp-off log</button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab"
                                                    data-bs-target="#copiesTab">Get Copies</button>
                                            </li>
                                        </ul>

                                          <!-- model expand button -->
                                        <button class="expand-btn" data-bs-toggle="modal" data-bs-target="#timesheetModal">
                                        <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" class="img-fluid" />
                                        </button>
                                    </div>

                                    <!-- Tab Contents -->
                                    <div class="tab-content tab_content_body p-2">
                                        <div class="tab-pane fade show active" id="overviewTab">
                                            <div class="timeline">
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot bg-primary rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line bg-primary"
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span class=" text-primary">PH - (1)</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>Sat, 15 Aug - </span>
                                                            <span class="badge  ">PH</span>
                                                            <span>-</span>
                                                            <span class="text-primary badge badge bold_text">  Paid day off</span>
                                                            <span> - 3 hours off</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span class=" text-primary">PH - (1)</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>Sat, 15 Aug - </span>
                                                            <span class="badge  ">PH</span>
                                                            <span>-</span>
                                                            <span class="text-primary badge badge bold_text"> Paid day off</span>
                                                            <span> - 3 hours off</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span class=" text-primary">PH - (1)</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>Sat, 15 Aug - </span>
                                                            <span class="badge  ">PH</span>
                                                            <span>-</span>
                                                            <span class="text-primary badge bold_text">  Paid day off</span>
                                                            <span> - 3 hours off</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span class=" text-primary">PH - (1)</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>Sat, 15 Aug - </span>
                                                            <span class="badge  ">PH</span>
                                                            <span>-</span>
                                                            <span class="text-primary badge bold_text">  Paid day off</span>
                                                            <span> - 3 hours off</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span class=" text-primary">PH - (1)</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>Sat, 15 Aug - </span>
                                                            <span class="badge  ">PH</span>
                                                            <span>-</span>
                                                            <span class="text-primary badge bold_text"> Paid day off</span>
                                                            <span> - 3 hours off</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span class=" text-primary">PH - (1)</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>Sat, 15 Aug - </span>
                                                            <span class="badge  ">PH</span>
                                                            <span>-</span>
                                                            <span class="text-primary badge bold_text">  Paid day off</span>
                                                            <span> - 3 hours off</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span class=" text-primary">PH - (1)</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>Sat, 15 Aug - </span>
                                                            <span class="badge  ">PH</span>
                                                            <span>-</span>
                                                            <span class="text-primary badge bold_text">  Paid day off</span>
                                                            <span> - 3 hours off</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span class=" text-primary">PH - (1)</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>Sat, 15 Aug - </span>
                                                            <span class="badge  ">PH</span>
                                                            <span>-</span>
                                                            <span class="text-primary badge bold_text">  Paid day off</span>
                                                            <span> - 3 hours off</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Other tabs can be filled similarly -->
                                        <div class="tab-pane fade" id="extraTimeTab">
                                            <div class="timeline">
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span>Comp - Off</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>15/08/2024  -</span>
                                                            <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                            <span>- 4 : 00 hours</span>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="timeline">
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span>Comp - Off</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>15/08/2024  -</span>
                                                            <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                            <span>- 4 : 00 hours</span>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="timeline">
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span>Comp - Off</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>15/08/2024  -</span>
                                                            <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                            <span>- 4 : 00 hours</span>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="timeline">
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span>Comp - Off</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>15/08/2024  -</span>
                                                            <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                            <span>- 4 : 00 hours</span>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="timeline">
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span>Comp - Off</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>15/08/2024  -</span>
                                                            <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                            <span>- 4 : 00 hours</span>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="timeline">
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <span>Comp - Off</span>
                                                        </div>
                                                        <div class="tl_details">
                                                            <span>15/08/2024  -</span>
                                                            <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                            <span>- 4 : 00 hours</span>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="payOffTab">
                                            <div class="timeline">
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="pay_off_log">
                                                                <span>03/08/2024  - </span>
                                                                <span>4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="pay_off_log">
                                                                <span>03/08/2024  - </span>
                                                                <span>4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="pay_off_log">
                                                                <span>03/08/2024  - </span>
                                                                <span>4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="pay_off_log">
                                                                <span>03/08/2024  - </span>
                                                                <span>4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="pay_off_log">
                                                                <span>03/08/2024  - </span>
                                                                <span>4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="pay_off_log">
                                                                <span>03/08/2024  - </span>
                                                                <span>4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="pay_off_log">
                                                                <span>03/08/2024  - </span>
                                                                <span>4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="pay_off_log">
                                                                <span>03/08/2024  - </span>
                                                                <span>4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="compOffTab">
                                            <div class="timeline">
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="comp_off_log">
                                                                <span>03/08/2024  -</span>
                                                                <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                <span>- 4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="comp_off_log">
                                                                <span>03/08/2024  -</span>
                                                                <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                <span>- 4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="comp_off_log">
                                                                <span>03/08/2024  -</span>
                                                                <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                <span>- 4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="comp_off_log">
                                                                <span>03/08/2024  -</span>
                                                                <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                <span>- 4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="comp_off_log">
                                                                <span>03/08/2024  -</span>
                                                                <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                <span>- 4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="comp_off_log">
                                                                <span>03/08/2024  -</span>
                                                                <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                <span>- 4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot  rounded-circle"
                                                            style="width:10px; height:10px;"></div>
                                                        <div class="line "
                                                            style="width:2px; height:100%; margin-left:4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1 tl-header">
                                                            <img src="https://i.pravatar.cc/24"
                                                                class="rounded-circle me-2" />
                                                            <div class="comp_off_log">
                                                                <span>03/08/2024  -</span>
                                                                <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                <span>- 4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="copiesTab">Get Copies Content</div>
                                    </div>

                                   

                                </div>

                                <!-- Modal for Expanded View -->
                                <div class="modal fade" id="timesheetModal" tabindex="-1"
                                    aria-labelledby="timesheetModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close popup-expand-btn" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- You can repeat the same timeline markup from above here -->
                                                <!-- Tabs -->
                                                <div class="timesheet-header d-flex justify-content-between align-items-center">
                                                    <ul class="nav nav-tabs popup_tabs" id="timesheetTabs">
                                                        <li class="nav-item">
                                                            <button class="nav-link tab_btn active" data-bs-toggle="tab"
                                                                data-bs-target="#modeloverviewTab">Timesheet Overview</button>
                                                        </li>
                                                        <li class="nav-item">
                                                            <button class="nav-link tab_btn" data-bs-toggle="tab"
                                                                data-bs-target="#modelextraTimeTab">Extra Time Log</button>
                                                        </li>
                                                        <li class="nav-item">
                                                            <button class="nav-link tab_btn" data-bs-toggle="tab"
                                                                data-bs-target="#modelpayOffTab">Pay-Off Log</button>
                                                        </li>
                                                        <li class="nav-item">
                                                            <button class="nav-link tab_btn" data-bs-toggle="tab"
                                                                data-bs-target="#modelcompOffTab">Comp-off log</button>
                                                        </li>
                                                        <li class="nav-item">
                                                            <button class="nav-link tab_btn" data-bs-toggle="tab"
                                                                data-bs-target="#modelcopiesTab">Get Copies</button>
                                                        </li>
                                                    </ul>

                                                </div>

                                                <!-- Tab Contents -->
                                                <div class="tab-content tab_content_body">
                                                    <div class="tab-pane fade show active" id="modeloverviewTab">
                                                        <div class="timeline">
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot bg-primary rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line bg-primary"
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span class=" text-primary">PH - (1)</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>Sat, 15 Aug - </span>
                                                                        <span class="badge  ">PH</span>
                                                                        <span>-</span>
                                                                        <span class="text-primary badge badge bold_text">  Paid day off</span>
                                                                        <span> - 3 hours off</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span class=" text-primary">PH - (1)</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>Sat, 15 Aug - </span>
                                                                        <span class="badge  ">PH</span>
                                                                        <span>-</span>
                                                                        <span class="text-primary badge badge bold_text"> Paid day off</span>
                                                                        <span> - 3 hours off</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span class=" text-primary">PH - (1)</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>Sat, 15 Aug - </span>
                                                                        <span class="badge  ">PH</span>
                                                                        <span>-</span>
                                                                        <span class="text-primary badge bold_text">  Paid day off</span>
                                                                        <span> - 3 hours off</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span class=" text-primary">PH - (1)</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>Sat, 15 Aug - </span>
                                                                        <span class="badge  ">PH</span>
                                                                        <span>-</span>
                                                                        <span class="text-primary badge bold_text">  Paid day off</span>
                                                                        <span> - 3 hours off</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span class=" text-primary">PH - (1)</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>Sat, 15 Aug - </span>
                                                                        <span class="badge  ">PH</span>
                                                                        <span>-</span>
                                                                        <span class="text-primary badge bold_text"> Paid day off</span>
                                                                        <span> - 3 hours off</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span class=" text-primary">PH - (1)</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>Sat, 15 Aug - </span>
                                                                        <span class="badge  ">PH</span>
                                                                        <span>-</span>
                                                                        <span class="text-primary badge bold_text">  Paid day off</span>
                                                                        <span> - 3 hours off</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span class=" text-primary">PH - (1)</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>Sat, 15 Aug - </span>
                                                                        <span class="badge  ">PH</span>
                                                                        <span>-</span>
                                                                        <span class="text-primary badge bold_text">  Paid day off</span>
                                                                        <span> - 3 hours off</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span class=" text-primary">PH - (1)</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>Sat, 15 Aug - </span>
                                                                        <span class="badge  ">PH</span>
                                                                        <span>-</span>
                                                                        <span class="text-primary badge bold_text">  Paid day off</span>
                                                                        <span> - 3 hours off</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Other tabs can be filled similarly -->
                                                    <div class="tab-pane fade" id="modelextraTimeTab">
                                                        <div class="timeline">
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span>Comp - Off</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>15/08/2024  -</span>
                                                                        <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                        <span>- 4 : 00 hours</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="timeline">
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span>Comp - Off</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>15/08/2024  -</span>
                                                                        <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                        <span>- 4 : 00 hours</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="timeline">
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span>Comp - Off</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>15/08/2024  -</span>
                                                                        <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                        <span>- 4 : 00 hours</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="timeline">
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span>Comp - Off</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>15/08/2024  -</span>
                                                                        <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                        <span>- 4 : 00 hours</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="timeline">
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span>Comp - Off</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>15/08/2024  -</span>
                                                                        <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                        <span>- 4 : 00 hours</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="timeline">
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span>Comp - Off</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>15/08/2024  -</span>
                                                                        <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                        <span>- 4 : 00 hours</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="modelpayOffTab">
                                                        <div class="timeline">
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="pay_off_log">
                                                                            <span>03/08/2024  - </span>
                                                                            <span>4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="pay_off_log">
                                                                            <span>03/08/2024  - </span>
                                                                            <span>4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="pay_off_log">
                                                                            <span>03/08/2024  - </span>
                                                                            <span>4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="pay_off_log">
                                                                            <span>03/08/2024  - </span>
                                                                            <span>4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="pay_off_log">
                                                                            <span>03/08/2024  - </span>
                                                                            <span>4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="pay_off_log">
                                                                            <span>03/08/2024  - </span>
                                                                            <span>4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="pay_off_log">
                                                                            <span>03/08/2024  - </span>
                                                                            <span>4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="pay_off_log">
                                                                            <span>03/08/2024  - </span>
                                                                            <span>4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="modelcompOffTab">
                                                        <div class="timeline">
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="comp_off_log">
                                                                            <span>03/08/2024  -</span>
                                                                            <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                            <span>- 4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="comp_off_log">
                                                                            <span>03/08/2024  -</span>
                                                                            <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                            <span>- 4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="comp_off_log">
                                                                            <span>03/08/2024  -</span>
                                                                            <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                            <span>- 4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="comp_off_log">
                                                                            <span>03/08/2024  -</span>
                                                                            <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                            <span>- 4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="comp_off_log">
                                                                            <span>03/08/2024  -</span>
                                                                            <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                            <span>- 4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="comp_off_log">
                                                                            <span>03/08/2024  -</span>
                                                                            <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                            <span>- 4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <div class="comp_off_log">
                                                                            <span>03/08/2024  -</span>
                                                                            <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                            <span>- 4 : 00 hours</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="modelcopiesTab">
                                                        <div class="timeline">
                                                            <div class="timeline-item d-flex align-items-start mb-3">
                                                                <div class="me-2">
                                                                    <div class="dot  rounded-circle"
                                                                        style="width:10px; height:10px;"></div>
                                                                    <div class="line "
                                                                        style="width:2px; height:100%; margin-left:4px;"></div>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                                        <img src="https://i.pravatar.cc/24"
                                                                            class="rounded-circle me-2" />
                                                                        <span class=" text-primary">PH - (1)</span>
                                                                    </div>
                                                                    <div class="tl_details">
                                                                        <span>Sat, 15 Aug - </span>
                                                                        <span class="badge  ">PH</span>
                                                                        <span>-</span>
                                                                        <span class="text-primary badge badge bold_text">  Paid day off</span>
                                                                        <span> - 3 hours off</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="claims" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
        </div>