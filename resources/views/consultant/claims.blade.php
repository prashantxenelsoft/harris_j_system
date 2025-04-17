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
                                        

                                       

                                        <div class="modal fade common_modal" id="textModal" tabindex="-1" aria-labelledby="cExpenseModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="model_employee">
                                                            <div class="model_emp_img">
                                                                <img src="assets/images/emp-icon1.png" alt="">
                                                            </div>
                                                            <span class="model_emp_name">Bruce Lee</span>
                                                        </div>
                                                        <button type="button" class="btn-close ml-close-btn"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="modal_body_inner">
                                                            <div class="mb_left">
                                                                <div class="ml_date_box">
                                                                    <div class="ml_date">
                                                                        <span>Date: <span>19 / 08 / 2024</span></span>
                                                                    </div>
                                                                    <div class="ml_duty_time">
                                                                        <span>Claim Form # : <span>  CF0982</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="ml_leave_detail">
                                                                    <div class="leave_type">
                                                                        <span>Select Expense Type :</span>
                                                                        <h2>Taxi</h2>
                                                                    </div>
                                                                    <form action="">
                                                                        <div class="e_form_fields">
                                                                            <div class="container-fluid p-0">
                                                                                <div class="row">
                                                                                    <div class="col-md-6 mb-4">
                                                                                        <label for="date" class="form-label">Date</label>
                                                                                        <input type="date" class="form-control" id="eDate" placeholder="Sunday, 5th Aug, 2024 ">
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-4">
                                                                                        <label for="expenseType " class="form-label">Expense Type </label>
                                                                                        <select name="expenseType" id="expenseType">
                                                                                            <option value="Taxi">Taxi</option>
                                                                                            <option value="Dining">Dining</option>
                                                                                            <option value="Others">Others</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <label for="otherExpense" class="form-label">Write Your Expense</label>
                                                                                        <div class="other_exp_field">
                                                                                            <input type="text" class="form-control" id="otherExpense">
                                                                                        <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Define Eligible Expense Types like Settling, Relocation, Project Release, Logistics, Visa/Legal/Travel. For any queries, please contact HR before submitting."></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-4">
                                                                                        <label for="particulars" class="form-label">Particulars</label>
                                                                                        <input type="text" class="form-control" id="eParticulars" placeholder="Invoice no." >
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-4">
                                                                                        <label for="amount" class="form-label">Amount $</label>
                                                                                        <input type="number" class="form-control" id="eAmount" placeholder="00 . 00">
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-4">
                                                                                        <label for="locationFrom" class="form-label">Location From</label>
                                                                                        <input type="text" class="form-control" id="eLocationFrom" >
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-4">
                                                                                        <label for="locationTo" class="form-label">Location To</label>
                                                                                        <input type="text" class="form-control" id="eLocationTo" >
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="add_remark">
                                                                            <span>Remarks *</span>
                                                                            <textarea name="remarks" id="customRemark" rows="4" placeholder="Max 200 words are allowed"></textarea>
                                                                        </div>
                                                                        <div class="upload_certificate">
                                                                            <div class="file_input">
                                                                                <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                                                                <p>Upload Invoice / Receipt</p>
                                                                            </div>
                                                                            <input type="file" name="" id="uploadFile">
                                                                            <p>*Allow to upload file <span>PNG,JPG,PDF</span> (Max.file size: 1MB)</p>
                                                                        </div>
                                                                        <div class="clock_it_btn">
                                                                            <button>
                                                                                Close   
                                                                            </button>
                                                                            <button>
                                                                                Save   
                                                                            </button>
                                                                            <button>
                                                                                Save & Add   
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="mb-right">
                                                                <h3 class="mb_right_title">
                                                                    Individual Claims List
                                                                </h3>
                                                                <div class="tab_type_list">
                                                                    <div class="tab_lists">
                                                                        <div class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                                                                            <span class="list_date">
                                                                                <i class="fa-solid fa-calendar-days me-2"></i>
                                                                                    12/08/2024
                                                                            </span> 
                                                                            <span class="list_e_type">Expenses Type : Taxi</span> 
                                                                        </div>
                                                                        <div class="flex-wrap d-flex align-items-center justify-content-between mb-2">
                                                                            <span class="list_particulars">
                                                                                Particulars : PA082073NU978
                                                                            </span> 
                                                                            <span class="list_e_amount">Amount : $ 250.00</span> 
                                                                        </div>
                                                                        <div class="d-flex align-items-center justify-content-end ">
                                                                            <span class="list_icons">
                                                                                <a href="#" class="badge_icon">
                                                                                    <i class="fa-solid fa-paperclip"></i>
                                                                                </a>
                                                                                <a href="#" class="badge_icon">
                                                                                    <i class="fa-solid fa-pen-nib"></i>
                                                                                </a>
                                                                                <a href="#" class="badge_icon">
                                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                                </a>
                                                                            </span>  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade common_modal" id="otherModal" tabindex="-1" aria-labelledby="cExpenseModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="model_employee">
                                                            <div class="model_emp_img">
                                                                <img src="assets/images/emp-icon1.png" alt="">
                                                            </div>
                                                            <span class="model_emp_name">Bruce Lee</span>
                                                        </div>
                                                        <button type="button" class="btn-close ml-close-btn"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="modal_body_inner">
                                                            <div class="mb_left">
                                                                <div class="ml_date_box">
                                                                    <div class="ml_date">
                                                                        <span>Date: <span>19 / 08 / 2024</span></span>
                                                                    </div>
                                                                    <div class="ml_duty_time">
                                                                        <span>Claim Form # : <span>  CF0982</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="ml_leave_detail">
                                                                    <div class="leave_type">
                                                                        <span>Select Expense Type :</span>
                                                                        <h2>Taxi</h2>
                                                                    </div>
                                                                    <form action="">
                                                                        <div class="e_form_fields">
                                                                            <div class="container-fluid p-0">
                                                                                <div class="row">
                                                                                    <div class="col-md-6 mb-4">
                                                                                        <label for="date" class="form-label">Date</label>
                                                                                        <input type="date" class="form-control" id="eDate" placeholder="Sunday, 5th Aug, 2024 ">
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-4">
                                                                                        <label for="expenseType " class="form-label">Expense Type </label>
                                                                                        <select name="expenseType" id="expenseType">
                                                                                            <option value="Taxi">Taxi</option>
                                                                                            <option value="Dining">Dining</option>
                                                                                            <option value="Others">Others</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <label for="otherExpense" class="form-label">Write Your Expense</label>
                                                                                        <div class="other_exp_field">
                                                                                            <input type="text" class="form-control" id="otherExpense">
                                                                                        <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Define Eligible Expense Types like Settling, Relocation, Project Release, Logistics, Visa/Legal/Travel. For any queries, please contact HR before submitting."></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-4">
                                                                                        <label for="particulars" class="form-label">Particulars</label>
                                                                                        <input type="text" class="form-control" id="eParticulars" placeholder="Invoice no." >
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-4">
                                                                                        <label for="amount" class="form-label">Amount $</label>
                                                                                        <input type="number" class="form-control" id="eAmount" placeholder="00 . 00">
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-4">
                                                                                        <label for="locationFrom" class="form-label">Location From</label>
                                                                                        <input type="text" class="form-control" id="eLocationFrom" >
                                                                                    </div>
                                                                                    <div class="col-md-6 mb-4">
                                                                                        <label for="locationTo" class="form-label">Location To</label>
                                                                                        <input type="text" class="form-control" id="eLocationTo" >
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="add_remark">
                                                                            <span>Remarks *</span>
                                                                            <textarea name="remarks" id="customRemark" rows="4" placeholder="Max 200 words are allowed"></textarea>
                                                                        </div>
                                                                        <div class="upload_certificate">
                                                                            <div class="file_input">
                                                                                <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                                                                <p>Upload Invoice / Receipt</p>
                                                                            </div>
                                                                            <input type="file" name="" id="uploadFile">
                                                                            <p>*Allow to upload file <span>PNG,JPG,PDF</span> (Max.file size: 1MB)</p>
                                                                        </div>
                                                                        <div class="clock_it_btn">
                                                                            <button>
                                                                                Close   
                                                                            </button>
                                                                            <button>
                                                                                Save   
                                                                            </button>
                                                                            <button>
                                                                                Save & Add   
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="mb-right">
                                                                <h3 class="mb_right_title">
                                                                    Individual Claims List
                                                                </h3>
                                                                <div class="tab_type_list">
                                                                    <div class="tab_lists">
                                                                        <div class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                                                                            <span class="list_date">
                                                                                <i class="fa-solid fa-calendar-days me-2"></i>
                                                                                    12/08/2024
                                                                            </span> 
                                                                            <span class="list_e_type">Expenses Type : Taxi</span> 
                                                                        </div>
                                                                        <div class="flex-wrap d-flex align-items-center justify-content-between mb-2">
                                                                            <span class="list_particulars">
                                                                                Particulars : PA082073NU978
                                                                            </span> 
                                                                            <span class="list_e_amount">Amount : $ 250.00</span> 
                                                                        </div>
                                                                        <div class="d-flex align-items-center justify-content-end ">
                                                                            <span class="list_icons">
                                                                                <a href="#" class="badge_icon">
                                                                                    <i class="fa-solid fa-paperclip"></i>
                                                                                </a>
                                                                                <a href="#" class="badge_icon">
                                                                                    <i class="fa-solid fa-pen-nib"></i>
                                                                                </a>
                                                                                <a href="#" class="badge_icon">
                                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                                </a>
                                                                            </span>  
                                                                        </div>
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
                                                { label: "Dining", icon: "&#128170;" },
                                                { label: "Texi", icon: "&#128154;" },
                                                { label: "VISA/legal", icon: "&#128100;&#8205;&#9794;️" },
                                                { label: "Other", icon: "&#128295;" },
                                                { label: "Relocation", icon: "&#128295;" },
                                                { label: "Logistics", icon: "&#128295;" }
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
                                            //     const tagRules = {
                                            //     "3-2025": [  // April 2025
                                            //         { index: 1, label: "PDO" },
                                            //         { index: 2, label: "8" },
                                            //         { index: 8, label: "5" },
                                            //         { index: 9, label: "PH" },
                                            //         { index: 15, label: "ML" },
                                            //         { index: 16, label: "AL" },
                                            //         { index: 25, label: "6" },
                                            //     ],
                                            //     "4-2025": [
                                            //         { index: 2, label: "PH" },
                                            //         { index: 20, label: "8" },
                                            //     ]
                                            // };

                                            // // Example: current month = 4, year = 2025
                                            // const currentKey = `${month}-${year}`;
                                            // if (tagRules[currentKey]) {
                                            //     tagRules[currentKey].forEach(rule => {
                                            //         if (i === rule.index) {
                                            //             applyTag(cell, rule.label, "#007bff");
                                            //         }
                                            //     });
                                            // }


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
                                                        if (item.label === "Texi") {
                                                            const modal = new bootstrap.Modal(document.getElementById("textModal"));
                                                            modal.show();
                                                        }
                                                        if (item.label === "Other") {
                                                            const modalCustomLeave = new bootstrap.Modal(document.getElementById("otherModal"));
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

                        <div class=" col-xl-4">
                               <div class="db_sidebar">
                                <div class="d-flex align-items-center justify-content-between">
                                    <ul class="nav nav-tabs" id="clickTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link tab_btn active" data-bs-toggle="tab"
                                                data-bs-target="#claimContent" type="button" role="tab">Claim</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link tab_btn " data-bs-toggle="tab"
                                                data-bs-target="#gCopiesContent" type="button" role="tab">Get Copies</button>
                                        </li>
                                    </ul>

                                    <button class="expand-btn" data-bs-toggle="modal" data-bs-target="#claimModal">
                                        <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}">
                                        
                                    </button>
                                </div>

                                <div class="tab-content tab_content_body" id="clickTabsContent">
                                    <div class="tab-pane fade show active" id="claimContent" role="tabpanel" aria-labelledby="claim-tab">
                                        <div class="timeline">
                                            <div class="timeline-item d-flex mb-3">
                                                <div class="me-2">
                                                    <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"></div>
                                                    <div class="line bg-primary" ></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2">
                                                        <span class=" text-primary">Claim No # - Cl04892F12 </span>
                                                    </div>
                                                    <div class="tl_details">
                                                        <span>12/08/2024 -</span>
                                                        <span class="badge"><span class="badge_dot"></span>Submitted</span>
                                                        <span>- 3 individual claims -</span>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-item d-flex mb-3">
                                                <div class="me-2">
                                                    <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"></div>
                                                    <div class="line bg-primary" ></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2">
                                                        <span class=" text-primary">Claim No # - Cl04892F12 </span>
                                                    </div>
                                                    <div class="tl_details">
                                                        <span>12/08/2024 -</span>
                                                        <span class="badge"><span class="badge_dot"></span>Submitted</span>
                                                        <span>- 3 individual claims -</span>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-item d-flex mb-3">
                                                <div class="me-2">
                                                    <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"></div>
                                                    <div class="line bg-primary" ></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2">
                                                        <span class=" text-primary">Claim No # - Cl04892F12 </span>
                                                    </div>
                                                    <div class="tl_details">
                                                        <span>12/08/2024 -</span>
                                                        <span class="badge"><span class="badge_dot"></span>Submitted</span>
                                                        <span>- 3 individual claims -</span>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-item d-flex mb-3">
                                                <div class="me-2">
                                                    <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"></div>
                                                    <div class="line bg-primary" ></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2">
                                                        <span class=" text-primary">Claim No # - Cl04892F12 </span>
                                                    </div>
                                                    <div class="tl_details">
                                                        <span>12/08/2024 -</span>
                                                        <span class="badge"><span class="badge_dot"></span>Submitted</span>
                                                        <span>- 3 individual claims -</span>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-item d-flex mb-3">
                                                <div class="me-2">
                                                    <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"></div>
                                                    <div class="line bg-primary" ></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1 tl-header">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2">
                                                        <span class=" text-primary">Claim No # - Cl04892F12 </span>
                                                    </div>
                                                    <div class="tl_details">
                                                        <span>12/08/2024 -</span>
                                                        <span class="badge"><span class="badge_dot"></span>Submitted</span>
                                                        <span>- 3 individual claims -</span>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="gCopiesContent" role="tabpanel" aria-labelledby="gCopies-tab">
                                        <div class="db_sidebar_title_box">
                                            <span>Total Work Hours</span>
                                            <span>Total Work Hours</span>
                                        </div>
                                        <div class="timeline tile_shape_box">
                                            <div class="timeline-item d-flex mb-3">
                                                <div class="select_box">
                                                    <input type="checkbox" value="">
                                                </div>
                                                <div class="timeline_right">
                                                    <div class="d-flex align-items-center mb-3 tl-header">
                                                        <span class="c_form_no">Claim Form : #2948</span>
                                                        <span class="c_amount">Amount : $ 1800.00</span>
                                                    </div>
                                                    <div class="d-flex align-items-center tl-header">
                                                        <span class="ind_claim">individual claims ( 03 )</span>
                                                        <span>
                                                            <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-item d-flex mb-3">
                                                <div class="select_box">
                                                    <input type="checkbox" value="">
                                                </div>
                                                <div class="timeline_right">
                                                    <div class="d-flex align-items-center mb-3 tl-header">
                                                        <span class="c_form_no">Claim Form : #2948</span>
                                                        <span class="c_amount">Amount : $ 1800.00</span>
                                                    </div>
                                                    <div class="d-flex align-items-center tl-header">
                                                        <span class="ind_claim">individual claims ( 03 )</span>
                                                        <span>
                                                            <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-item d-flex mb-3">
                                                <div class="select_box">
                                                    <input type="checkbox" value="">
                                                </div>
                                                <div class="timeline_right">
                                                    <div class="d-flex align-items-center mb-3 tl-header">
                                                        <span class="c_form_no">Claim Form : #2948</span>
                                                        <span class="c_amount">Amount : $ 1800.00</span>
                                                    </div>
                                                    <div class="d-flex align-items-center tl-header">
                                                        <span class="ind_claim">individual claims ( 03 )</span>
                                                        <span>
                                                            <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-item d-flex mb-3">
                                                <div class="select_box">
                                                    <input type="checkbox" value="">
                                                </div>
                                                <div class="timeline_right">
                                                    <div class="d-flex align-items-center mb-3 tl-header">
                                                        <span class="c_form_no">Claim Form : #2948</span>
                                                        <span class="c_amount">Amount : $ 1800.00</span>
                                                    </div>
                                                    <div class="d-flex align-items-center tl-header">
                                                        <span class="ind_claim">individual claims ( 03 )</span>
                                                        <span>
                                                            <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-item d-flex mb-3">
                                                <div class="select_box">
                                                    <input type="checkbox" value="">
                                                </div>
                                                <div class="timeline_right">
                                                    <div class="d-flex align-items-center mb-3 tl-header">
                                                        <span class="c_form_no">Claim Form : #2948</span>
                                                        <span class="c_amount">Amount : $ 1800.00</span>
                                                    </div>
                                                    <div class="d-flex align-items-center tl-header">
                                                        <span class="ind_claim">individual claims ( 03 )</span>
                                                        <span>
                                                            <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-item d-flex mb-3">
                                                <div class="select_box">
                                                    <input type="checkbox" value="">
                                                </div>
                                                <div class="timeline_right">
                                                    <div class="d-flex align-items-center mb-3 tl-header">
                                                        <span class="c_form_no">Claim Form : #2948</span>
                                                        <span class="c_amount">Amount : $ 1800.00</span>
                                                    </div>
                                                    <div class="d-flex align-items-center tl-header">
                                                        <span class="ind_claim">individual claims ( 03 )</span>
                                                        <span>
                                                            <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="g_cpoies_submit_btn r_update_btn">
                                            <button type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- claim modal -->

                                <div class="modal fade" id="claimModal" tabindex="-1" aria-labelledby="claimModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="emp_n_c_form">
                                                    <div class="model_employee">
                                                        <div class="model_emp_img">
                                                            <!-- <img src="assets/images/emp-icon1.png" alt=""> -->
                                                            <img src="{{ asset('public/assets/latest/images/emp-icon1.png') }}">
                                                        </div>
                                                        <div class="name_n_id">
                                                            <span class="model_emp_name">Bruce Lee</span>
                                                            <span class="model_emp_id">Employee Id : Emp14982 </span>
                                                        </div>
                                                    </div>
                                                    <div class="model_c_form">
                                                        <h4>Claim Form</h4>
                                                        <span>#CLF08982</span>
                                                    </div>
                                                </div>
                                                <a href="#" class="draft_btn"><span class="dot"></span> Draft</a>
                                                <div class="claim_hour_title">
                                                    <span class="text-danger me-4 fw-bold">Individual Claims ( 03 )</span>
                                                    <span class="fw-bold">Total Work Hours</span>
                                                </div>
                                                <button type="button" class="btn-close ml-close-btn" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                                
                                            </div>
                                            <div class="modal-body">
                                                <div class="step_icons mb-4">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_41157_9825)">
                                                                        <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                                                    </g>
                                                                    <g clip-path="url(#clip1_41157_9825)">
                                                                        <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"></path>
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_41157_9825">
                                                                            <rect width="32" height="32" fill="white"></rect>
                                                                        </clipPath>
                                                                        <clipPath id="clip1_41157_9825">
                                                                            <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </span>
                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_41157_9825)">
                                                                        <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                                                    </g>
                                                                    <g clip-path="url(#clip1_41157_9825)">
                                                                        <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"></path>
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_41157_9825">
                                                                            <rect width="32" height="32" fill="white"></rect>
                                                                        </clipPath>
                                                                        <clipPath id="clip1_41157_9825">
                                                                            <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </span>
                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_41157_9825)">
                                                                        <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                                                    </g>
                                                                    <g clip-path="url(#clip1_41157_9825)">
                                                                        <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"></path>
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_41157_9825">
                                                                            <rect width="32" height="32" fill="white"></rect>
                                                                        </clipPath>
                                                                        <clipPath id="clip1_41157_9825">
                                                                            <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </span>
                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_41157_9825)">
                                                                        <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                                                    </g>
                                                                    <g clip-path="url(#clip1_41157_9825)">
                                                                        <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"></path>
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_41157_9825">
                                                                            <rect width="32" height="32" fill="white"></rect>
                                                                        </clipPath>
                                                                        <clipPath id="clip1_41157_9825">
                                                                            <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </span>
                                                        </li>

                                                        <li>
                                                            <span>
                                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_41157_9825)">
                                                                        <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                                                    </g>
                                                                    <g clip-path="url(#clip1_41157_9825)">
                                                                        <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"></path>
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_41157_9825">
                                                                            <rect width="32" height="32" fill="white"></rect>
                                                                        </clipPath>
                                                                        <clipPath id="clip1_41157_9825">
                                                                            <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_41157_9825)">
                                                                        <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                                                    </g>
                                                                    <g clip-path="url(#clip1_41157_9825)">
                                                                        <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"></path>
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_41157_9825">
                                                                            <rect width="32" height="32" fill="white"></rect>
                                                                        </clipPath>
                                                                        <clipPath id="clip1_41157_9825">
                                                                            <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g clip-path="url(#clip0_41157_9825)">
                                                                        <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                                                    </g>
                                                                    <g clip-path="url(#clip1_41157_9825)">
                                                                        <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"></path>
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_41157_9825">
                                                                            <rect width="32" height="32" fill="white"></rect>
                                                                        </clipPath>
                                                                        <clipPath id="clip1_41157_9825">
                                                                            <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal_body_inner">
                                                    <div class="container-fluid">
                                                        <div class="row tabs_type_row mb-4">
                                                            <div class="col-md-6 p-0">
                                                                <div class="top_ic_details detial_row">
                                                                    <div class="d_n_t">
                                                                        <span class="fw-bold">Date & Time</span>
                                                                        <span>Sunday, 5th Aug, 2024</span>
                                                                    </div>
                                                                    <div class="e_n_t">
                                                                        <span class="fw-bold">Expense Type </span>
                                                                        <span>Taxi</span>
                                                                    </div>
                                                                    <div class="e_amt">
                                                                        <span class="fw-bold">Amount</span>
                                                                        <span>$ 250. 34</span>
                                                                    </div>
                                                                    <div class="u_icons">
                                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-pen-nib"></i></a>
                                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-trash-can"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="bottom_ic_details detial_row">
                                                                    <div class="e_particular">
                                                                        <span class="fw-bold">Particulars</span>
                                                                        <span>PA082073NU978</span>
                                                                    </div>
                                                                    <div class="e_location_from">
                                                                        <span class="fw-bold">Location From</span>
                                                                        <span>Jurong East</span>
                                                                    </div>
                                                                    <div class="e_location_to">
                                                                        <span class="fw-bold">Location To</span>
                                                                        <span>Changi</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 p-0">
                                                                <div class="e_invoice_box">
                                                                    <div class="e_invoice_box_inner">
                                                                        <img src="{{ asset('public/assets/latest/images/no-data-2.png') }}">
                                                                        <p class="mt-2"><span >
                                                                            Add Invoice
                                                                        </span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 p-0">
                                                                <div class="e_remark_box">
                                                                    <div class="e_remark_box_inner">
                                                                        <span class="fw-bold">Remarks</span>
                                                                        <p class="mt-2">
                                                                            <span>Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's .</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row tabs_type_row mb-4">
                                                            <div class="col-md-6 p-0">
                                                                <div class="top_ic_details detial_row">
                                                                    <div class="d_n_t">
                                                                        <span class="fw-bold">Date & Time</span>
                                                                        <span>Sunday, 5th Aug, 2024</span>
                                                                    </div>
                                                                    <div class="e_n_t">
                                                                        <span class="fw-bold">Expense Type </span>
                                                                        <span>Taxi</span>
                                                                    </div>
                                                                    <div class="e_amt">
                                                                        <span class="fw-bold">Amount</span>
                                                                        <span>$ 250. 34</span>
                                                                    </div>
                                                                    <div class="u_icons">
                                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-pen-nib"></i></a>
                                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-trash-can"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="bottom_ic_details detial_row">
                                                                    <div class="e_particular">
                                                                        <span class="fw-bold">Particulars</span>
                                                                        <span>PA082073NU978</span>
                                                                    </div>
                                                                    <div class="e_location_from">
                                                                        <span class="fw-bold">Location From</span>
                                                                        <span>Jurong East</span>
                                                                    </div>
                                                                    <div class="e_location_to">
                                                                        <span class="fw-bold">Location To</span>
                                                                        <span>Changi</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 p-0">
                                                                <div class="e_invoice_box">
                                                                    <div class="e_invoice_box_inner">
                                                                    <img src="{{ asset('public/assets/latest/images/no-data-2.png') }}">
                                                                        <p class="mt-2"><span >
                                                                            Add Invoice
                                                                        </span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 p-0">
                                                                <div class="e_remark_box">
                                                                    <div class="e_remark_box_inner">
                                                                        <span class="fw-bold">Remarks</span>
                                                                        <p class="mt-2">
                                                                            <span>Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's .</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row tabs_type_row mb-4">
                                                            <div class="col-md-6 p-0">
                                                                <div class="top_ic_details detial_row">
                                                                    <div class="d_n_t">
                                                                        <span class="fw-bold">Date & Time</span>
                                                                        <span>Sunday, 5th Aug, 2024</span>
                                                                    </div>
                                                                    <div class="e_n_t">
                                                                        <span class="fw-bold">Expense Type </span>
                                                                        <span>Taxi</span>
                                                                    </div>
                                                                    <div class="e_amt">
                                                                        <span class="fw-bold">Amount</span>
                                                                        <span>$ 250. 34</span>
                                                                    </div>
                                                                    <div class="u_icons">
                                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-pen-nib"></i></a>
                                                                        <a href="#" class="badge_icon"><i class="fa-solid fa-trash-can"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="bottom_ic_details detial_row">
                                                                    <div class="e_particular">
                                                                        <span class="fw-bold">Particulars</span>
                                                                        <span>PA082073NU978</span>
                                                                    </div>
                                                                    <div class="e_location_from">
                                                                        <span class="fw-bold">Location From</span>
                                                                        <span>Jurong East</span>
                                                                    </div>
                                                                    <div class="e_location_to">
                                                                        <span class="fw-bold">Location To</span>
                                                                        <span>Changi</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 p-0">
                                                                <div class="e_invoice_box">
                                                                    <div class="e_invoice_box_inner">
                                                                    <img src="{{ asset('public/assets/latest/images/no-data-2.png') }}">
                                                                        <p class="mt-2"><span >
                                                                            Add Invoice
                                                                        </span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 p-0">
                                                                <div class="e_remark_box">
                                                                    <div class="e_remark_box_inner">
                                                                        <span class="fw-bold">Remarks</span>
                                                                        <p class="mt-2">
                                                                            <span>Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's .</span>
                                                                        </p>
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
                               <div class="db_sidebar db_sidebar2">
                                <div class="remark-section card tab_content_body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6>Remarks</h6>
                                        <div class="btn-group-remark">
                                            <button class="btn btn-link p-0 text-danger" data-bs-toggle="modal" data-bs-target="#remarksModal">
                                               
                                                <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}">
                                            </button>

                                             <!-- edit button -->
                                            <button class="flow-edit-btn" data-bs-toggle="modal" data-bs-target="#editRemarksModal">
                                                <i class="fa-solid fa-pen-nib"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="timeline">
                                        <div class="remark-item mb-3">
                                            <div class="d-flex ">
                                                <div class="me-2 text-primary">
                                                    <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"></div>
                                                    <div class="line bg-primary" ></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena">
                                                        <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45
                                                            AM</small>
                                                    </div>
                                                    <p>This is Approved, Thank you for the excellent contribution</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="remark-item mb-3">
                                            <div class="d-flex ">
                                                <div class="me-2 text-primary">
                                                    <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"></div>
                                                    <div class="line bg-primary" ></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena">
                                                        <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45
                                                            AM</small>
                                                    </div>
                                                    <p>This is Approved, Thank you for the excellent contribution</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="remark-item mb-3">
                                            <div class="d-flex ">
                                                <div class="me-2 text-primary">
                                                    <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"></div>
                                                    <div class="line bg-primary" ></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena">
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
                </div>
            </div>

            <div class="tab-pane fade" id="claims" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
        </div>