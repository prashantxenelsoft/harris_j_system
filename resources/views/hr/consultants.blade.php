<div class="add-consultants-wrapper">
    <div class="pt-4">
        <div class="row">
            <div class="col-lg-4 col-xxl-3">
                <div class="add-consultant-clients-wrapper">
                    <h4>Clients</h4>

                    <div class="clients-tabs-consultants pt-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                <div class="clients-tab-switch">
                                    <div class="clients-img-name">
                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                        <h6>Encore Films</h6>
                                    </div>

                                    <div class="clients-numbers-tab-switch">
                                        <span>
                                            (<em>10</em>,<em>23</em>,<em>12</em>)
                                            <b>/ 45 </b>
                                        </span>
                                    </div>
                                </div>
                            </button>
                            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                <div class="clients-tab-switch">
                                    <div class="clients-img-name">
                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                        <h6>Encore Films</h6>
                                    </div>
                                    <div class="clients-numbers-tab-switch">
                                        <span>
                                            (<em>10</em>,<em>23</em>,<em>12</em>)
                                            <b>/ 45 </b>
                                        </span>
                                    </div>
                                </div>
                            </button>

                            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                <div class="clients-tab-switch">
                                    <div class="clients-img-name">
                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                        <h6>Bank of America</h6>
                                    </div>
                                    <div class="clients-numbers-tab-switch">
                                        <span>
                                            (<em>10</em>,<em>23</em>,<em>12</em>)
                                            <b>/ 45 </b>
                                        </span>
                                    </div>
                                </div>
                            </button>

                            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                <div class="clients-tab-switch">
                                    <div class="clients-img-name">
                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                        <h6>Citi Bank</h6>
                                    </div>
                                    <div class="clients-numbers-tab-switch">
                                        <span>
                                            (<em>10</em>,<em>23</em>,<em>12</em>)
                                            <b>/ 45 </b>
                                        </span>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>

                    <div class="clients-consultants-tags">
                        <ul>
                            <li>
                                <span></span>
                                <p>Inactive</p>
                            </li>

                            <li>
                                <span></span>
                                <p>active</p>
                            </li>

                            <li>
                                <span></span>
                                <p>Notice Period</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-xxl-9">
                <div class="consultants-clients-tabs-content">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="clients-tab-inner-section">
                                <div class="clients-tab-header">
                                    <div class="clients-tab-header-left-col">
                                        <h6>Consultants</h6>
                                        <input type="text" placeholder="Search..." />
                                        <select>
                                            <option>
                                                Designation
                                            </option>
                                        </select>
                                        <select>
                                            <option>
                                                Status
                                            </option>
                                        </select>
                                    </div>

                                    <div class="clients-tab-header-right-col">
                                        <a href="#" class="add-consultants-btn">
                                            <img src="{{ asset('public/assets/latest/images/circle-add-button.png') }}" class="img-fluid" />
                                            Add Consultants
                                        </a>
                                    </div>
                                </div>
                                <div class="table-hj-list-section mt-3">
                                    <div class="container p-0">
                                        <div class="col-md-12">
                                            <table class="table table-condensed table-striped" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Employee ID</th>
                                                        <th>Employee Name</th>
                                                        <th>Email Address</th>
                                                        <th>Residential Status</th>
                                                        <th>Designation</th>
                                                        <th>Joining Date</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <!-- First employee row -->
                                                    <tr>
                                                        <td>01</td>
                                                        <td>EM1008ID</td>
                                                        <td>
                                                            <div class="country-wrap">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                                <p>Bruce Lee</p>
                                                            </div>
                                                        </td>
                                                        <td>brucelee@gmail.com</td>
                                                        <td>
                                                            <span class="blue-badge"><strong>SR</strong></span>
                                                        </td>
                                                        <td><span class="blue-badge">Information Security Analyst</span></td>
                                                        <td>
                                                            <p>
                                                                <span>
                                                                    12 / 08 / 2024
                                                                </span>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <span class="active-badge">
                                                                Active
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="icon-group-listing">
                                                                <span>
                                                                    <i class="fas fa-pen-nib"></i>
                                                                </span>

                                                                <span>
                                                                    <i class="fa fa-trash" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
                                                                    <div class="modal fade delete-popup" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered">
                                                                            <div class="modal-content"> 
                                                                                <img src="{{ asset('public/assets/latest/images/close-icon-popup.png') }}" data-bs-dismiss="modal" aria-label="Close" class="delete-popup-close-btn" />

                                                                                <div class="modal-body">
                                                                                    <div class="delete-popup-row">
                                                                                        <div class="delete-icon-row">
                                                                                            <span>
                                                                                                <i class="fa fa-trash"></i>
                                                                                            </span>
                                                                                        </div>

                                                                                        <div class="delete-row-text">
                                                                                            <h6>Are you sure you want to delete this user?</h6>
                                                                                            <p>
                                                                                                This action cannot be undone. The user's data will be permanently removed
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="delete-popup-btn-group">
                                                                                        <a href="#" data-bs-dismiss="modal">
                                                                                            No, cancel
                                                                                        </a>
                                                                                        <a href="#">
                                                                                            Yes, confirm
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Second employee row -->
                                                    <tr>
                                                        <td>02</td>
                                                        <td>EM1009ID</td>
                                                        <td>
                                                            <div class="country-wrap">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                                <p>Allison Schleifer</p>
                                                            </div>
                                                        </td>
                                                        <td>brucelee@gmail.com</td>
                                                        <td>
                                                            <span class="red-badge"><strong>SPR</strong></span>
                                                        </td>
                                                        <td><span class="red-badge">Head Administrator</span></td>
                                                        <td>
                                                            <p>
                                                                <span>
                                                                    12 / 08 / 2024
                                                                </span>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <span class="active-badge">
                                                                Active
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="icon-group-listing">
                                                                <span>
                                                                    <i class="fas fa-pen-nib"></i>
                                                                </span>

                                                                <span>
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Third employee row -->
                                                    <tr>
                                                        <td>03</td>
                                                        <td>EM1010ID</td>
                                                        <td>
                                                            <div class="country-wrap">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                                <p>Bruce Lee</p>
                                                            </div>
                                                        </td>
                                                        <td>brucelee@gmail.com</td>
                                                        <td>
                                                            <span class="orange-badge"><strong>PP</strong></span>
                                                        </td>
                                                        <td><span class="blue-badge">Web developer</span></td>
                                                        <td>
                                                            <p>
                                                                <span>
                                                                    12 / 08 / 2024
                                                                </span>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <span class="active-badge">
                                                                Active
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="icon-group-listing">
                                                                <span>
                                                                    <i class="fas fa-pen-nib"></i>
                                                                </span>

                                                                <span>
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Third employee row -->
                                                    <tr>
                                                        <td>04</td>
                                                        <td>EM1011ID</td>
                                                        <td>
                                                            <div class="country-wrap">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                                <p>Lincoln Geidt</p>
                                                            </div>
                                                        </td>
                                                        <td>lincin@gmail.com</td>
                                                        <td>
                                                            <span class="blue-badge"><strong>EP</strong></span>
                                                        </td>
                                                        <td>
                                                            <span class="orange-badge">
                                                                Technical support analyst
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <p>
                                                                <span>
                                                                    12 / 08 / 2024
                                                                </span>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <span class="inactive-badge">
                                                                Inactive
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="icon-group-listing">
                                                                <span>
                                                                    <i class="fas fa-pen-nib"></i>
                                                                </span>

                                                                <span>
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"></div>

                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"></div>

                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.add-consultants-btn').on('click', function(e) {
                e.preventDefault();
                $('.add-user-form-section').removeClass('d-none'); // ✅ Show the form
                $('.pt-4').addClass('d-none');  // ✅ Optionally hide wrapper (if needed)
            });
        });
    </script>

    <div class="add-user-form-section d-none">
        <div class="hj-add-consultancy-screen">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 d-flex align-items-center">
                        <h2 id="consultancy_form_heading">Add Consultants</h2>
                    </div>

                    <div class="col-lg-8">
                        <div class="add-consultancy-btn-group">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);" onclick="clearUserManagementForm();">
                                        <img src="{{ asset('public/assets/latest/images/clear-icon.png') }}" class="img-fluid" />
                                        Clear
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0);" onclick="validateUserManagementForm();">
                                        <img src="{{ asset('public/assets/latest/images/save-icon.png') }}" class="img-fluid" />
                                        Save
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row add-consultancy-form">
                    <div class="col-lg-12">
                        <form id="userManagmentForm" method="POST" action="#" enctype="multipart/form-data">
                            @csrf
                            
                            <h3>General Information</h3>

                            <div class="form-row-consultancy">
                                <div class="consultancy-form-col">
                                    <input type="text" name="emp_name" placeholder="Employee Name *" required>
                                </div>
                                <input type="hidden" name="edit_id" value="" />

                                <div class="consultancy-form-col">
                                    <input type="text" name="emp_code" placeholder="Employee Code" required>
                                </div>

                                <div class="consultancy-form-col gender_selection_box" id="genderBox">
                                    <span>Sex :</span>
                                    <span>
                                        <input type="radio" name="sex" value="Male" id="sex_male" required>
                                        <label for="sex_male">Male</label>
                                        <i class="fa-solid fa-mars"></i>
                                    </span>
                                    <span>
                                        <input type="radio" name="sex" value="Female" id="sex_female">
                                        <label for="sex_female">Female</label>
                                        <i class="fa-solid fa-venus"></i>
                                    </span>
                                    <span>
                                        <input type="radio" name="sex" value="Others" id="sex_others">
                                        <label for="sex_others">Others</label>
                                    </span>
                                </div>

                                <!-- Custom "Others" Input (Initially Hidden) -->
                                <div class="consultancy-form-col" id="otherGenderInput" style="display: none;">
                                    <input type="text" id="custom_sex" placeholder="Specify gender">
                                </div>

                                <script>
                                    const radios = document.querySelectorAll('input[name="sex"]');
                                    const otherInputDiv = document.getElementById("otherGenderInput");
                                    const customInput = document.getElementById("custom_sex");

                                    radios.forEach((radio) => {
                                        radio.addEventListener("change", function () {
                                            if (this.value === "Others" && this.checked) {
                                                otherInputDiv.style.display = "block";
                                            } else {
                                                otherInputDiv.style.display = "none";
                                            }
                                        });
                                    });

                                    
                                </script>



                                <div class="consultancy-form-col">
                                    <span>Date Of Birth :</span>
                                    <input type="date" name="dob" required>
                                    <span class="ms-1 ms-xxl-3">Age :-</span>
                                </div>

                                <div class="consultancy-form-col telephone-form-col">
                                    <input type="tel" id="mobile_number" name="mobile_number" placeholder="Mobile Number" required />
                                </div>


                                <div class="consultancy-form-col">
                                    <input type="email" name="email" placeholder="Email Address *" required>
                                </div>

                                <div class="consultancy-form-col ">
                                    <div class="upload_certificate">
                                        <div class="file_input">
                                            <i class="fa-solid fa-arrow-up-from-bracket me-3"></i>
                                            <p>Upload Profile Picture</p>
                                        </div>
                                        <input type="file" name="receipt_file" id="uploadFile">
                                    
                                    </div>
                                </div>

                                <div class="consultancy-form-col">
                                    <div class="preview_box text-center" id="previewBox" style="cursor: pointer;">
                                        <!-- <p class="preview mb-0">Profile Picture Preview</p> -->
                                        <small id="previewHint" style="display: none; color: green;">Click to view uploaded image</small>
                                    </div>
                                </div>

                                <!-- Modal for Image Preview -->
                                <div id="imageModal">
                                    <span id="closeModal">&times;</span>
                                    <img id="imageModalContent">
                                </div>

                                <style>
                                    #imageModal {
                                        display: none;
                                        position: fixed;
                                        z-index: 9999;
                                        left: 0;
                                        top: 0;
                                        width: 100%;
                                        height: 100%;
                                        background-color: rgba(0,0,0,0.8);
                                    }

                                    #imageModalContent {
                                        display: block;
                                        margin: 5% auto;
                                        max-width: 80%;
                                        border-radius: 10px;
                                    }

                                    #closeModal {
                                        position: absolute;
                                        top: 20px;
                                        right: 35px;
                                        color: white;
                                        font-size: 40px;
                                        font-weight: bold;
                                        cursor: pointer;
                                    }

                                    .preview_box {
                                        border: 2px dashed #ccc;
                                        padding: 20px;
                                        border-radius: 10px;
                                        transition: all 0.3s ease;
                                    }

                                    .preview_box.active {
                                        border-color: #28a745;
                                        background-color: #f0fff0;
                                    }
                                </style>
                                <script>
                                    let uploadedImgSrc = ""; // Store image data
                                    const previewBox = document.getElementById('previewBox');
                                    const previewHint = document.getElementById('previewHint');

                                    document.getElementById('uploadFile').addEventListener('change', function (event) {
                                        const file = event.target.files[0];

                                        if (file && file.type.startsWith('image/')) {
                                            const reader = new FileReader();
                                            reader.onload = function (e) {
                                                uploadedImgSrc = e.target.result;

                                                // Highlight preview box
                                                previewBox.classList.add('active');
                                                previewHint.style.display = 'block';
                                            };
                                            reader.readAsDataURL(file);
                                        } else {
                                            alert("Please upload a valid image file.");
                                        }
                                    });

                                    // Show modal on preview click
                                    previewBox.addEventListener('click', function () {
                                        if (uploadedImgSrc !== "") {
                                            document.getElementById('imageModal').style.display = 'block';
                                            document.getElementById('imageModalContent').src = uploadedImgSrc;
                                        } else {
                                            alert("Please upload an image first.");
                                        }
                                    });

                                    // Close modal on click
                                    document.getElementById('closeModal').addEventListener('click', function () {
                                        document.getElementById('imageModal').style.display = 'none';
                                    });

                                    // Click outside to close
                                    window.addEventListener('click', function (event) {
                                        const modal = document.getElementById('imageModal');
                                        if (event.target === modal) {
                                            modal.style.display = 'none';
                                        }
                                    });


                                </script>

                                <div class="consultancy-form-col add-address-col" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <i class="fa-solid fa-house"></i>
                                    <p>Add Address</p>
                                </div>

                                <div class="consultancy-form-col">
                                    <input readonly id="manual_address_input" type="text" style="border: 3px dashed #a8b9ca; border-radius: 6px;" required />
                                    <input type="hidden" id="full_address" name="full_address" />
                                    <input type="hidden" id="show_address_input" name="show_address_input" />
                                    <div class="consultancy-form-address-feed-form d-none">
                                        <div class="default-address-badge">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <h6>Default</h6>
                                        </div>

                                        <div class="address-text-col-popup">
                                            <div class="address-default-text">
                                                <p id="show_address"></p>
                                            </div>

                                            <div class="address-default-btn-group">
                                                <div class="icon-group-listing">
                                                    <span data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        <i class="fas fa-pen-nib"></i>
                                                    </span>

                                                    <span>
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                    
                                <!-- Start Date -->
                                <div class="consultancy-form-col full_width start-date-col" onclick="document.getElementById('startDate').showPicker()">
                                    <input 
                                        type="date" 
                                        id="startDate" 
                                        name="joining_date" 
                                        placeholder="Start Date / Joining Date" 
                                        style="margin-left: 0px;"
                                    />
                                    <table id="dateTable" border="1">
                                        <thead>
                                            <tr><th>Start Date / Joining Date</th></tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                                <!-- End Date -->
                                <div class="consultancy-form-col full_width end-date-col" onclick="document.getElementById('endDate').showPicker()">
                                    <input 
                                        type="date" 
                                        id="endDate" 
                                        name="resignation_date" 
                                        placeholder="Select Expire / Last working date" 
                                        style="margin-left: 0px;"
                                    />
                                    <table id="enddateTable" border="1">
                                        <thead>
                                            <tr><th>Select Expire / Last working date</th></tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                                <script>
                                    document.getElementById("startDate").addEventListener("change", function () {
                                        this.placeholder = "";
                                        const thead = document.querySelector("#dateTable thead");
                                        if (thead) thead.remove();

                                        const tableBody = document.querySelector("#dateTable tbody");
                                        tableBody.innerHTML = "";

                                        const newRow = tableBody.insertRow();
                                        const newCell = newRow.insertCell(0);
                                        newCell.textContent = this.value;
                                    });

                                    document.getElementById("endDate").addEventListener("change", function () {
                                        this.placeholder = "";
                                        const thead = document.querySelector("#enddateTable thead");
                                        if (thead) thead.remove();

                                        const tableBody = document.querySelector("#enddateTable tbody");
                                        tableBody.innerHTML = "";

                                        const newRow = tableBody.insertRow();
                                        const newCell = newRow.insertCell(0);
                                        newCell.textContent = this.value;
                                    });
                                </script>



                                <div class="consultancy-form-col">
                                    <select name="status" required>
                                        <option value="" selected disabled>Select User Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Disabled">Disabled</option>
                                        <!-- <option value="Block">Block</option>
                                        <option value="Deleted">Deleted</option> -->
                                    </select>
                                </div>
                                <div class="consultancy-form-col">
                                    <select name="select_client" required>
                                        <option>
                                        <option value="" selected disabled>Select Client</option>
                                        <option value="Client 1">Client 1</option>
                                        <option value="Client 2">Client 2</option>
                                            
                                        </option>
                                        
                                    </select>
                                </div>

                                <div class="consultancy-form-col">
                                    <select name="select_holiday" required>
                                    
                                        <option value="" selected disabled>Select Holiday Profile</option>
                                        <option value="Holiday 1">Holiday 1</option>
                                        <option value="Holiday 2">Holiday 2</option>
                                        
                                    </select>
                                </div>
                            </div>

                            <h3>Designation</h3>
                            <div class="form-row-consultancy">
                                <div class="consultancy-form-col">
                                    <select name="designation" required>
                                        <option value="" selected disabled>Designation</option>
                                        <option value="Finance">Finance</option>
                                        <option value="HR">HR</option>
                                        <option value="Operator">Operator</option>
                                        <!-- <option value="Consultant">Consultant</option> -->
                                    </select>
                                </div>
                            </div>

                            <h3>User Credentials</h3>
                            <div class="form-row-consultancy">
                                <div class="consultancy-form-col">
                                    <input type="email" name="login_email" placeholder="User Id / Email *" required>
                                </div>

                                <div class="consultancy-form-col">
                                    <div class="reset-password">
                                        <input type="checkbox" name="reset_password" value="1">
                                        <label> Reset Password </label>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                <!-- Address Modal -->
                <div class="hj-add-address-screen">
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">
                                            <img src="{{ asset('public/assets/latest/images/location-icon.png') }}" class="img-fluid" />
                                            Add Address
                                        </h5>
                                        <button aria-label="Close">
                                            <img src="{{ asset('public/assets/latest/images/close-btn-address-popup.png') }}" class="img-fluid" data-bs-dismiss="modal" />
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <form action="#" method="POST" id="address_form" class="address_form">
                                                    <h3>Address Information</h3>

                                                    <div class="address-single-col">
                                                        <select id="address-type" name="address_type" required>
                                                            <option value="" selected disabled>Select Address Type *</option>
                                                            <option value="Home">Home</option>
                                                            <option value="Office">Office</option>
                                                            <option value="Billing">Billing</option>
                                                            <option value="Shipping">Shipping</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>

                                                    <div class="address-form-popup">
                                                        <div class="address-form-col">
                                                            <select id="country-select" name="country" required>
                                                                <option value="" selected disabled>Select Country *</option>
                                                            </select>
                                                        </div>

                                                        <div class="address-form-col">
                                                            <input type="text" placeholder="Postal Code *" id="postal-code" name="postal_code" required />
                                                        </div>

                                                        <div class="address-form-col">
                                                            <input type="text" placeholder="Apartment Name / Street Name *" name="street_name" required />
                                                        </div>

                                                        <div class="address-form-col address-form-col-group">
                                                            <input type="text" placeholder="Unit Number" name="unit_number" />
                                                            <input type="text" placeholder="Land Mark" name="land_mark" />
                                                        </div>

                                                        <div class="address-form-col">
                                                            <input type="text" placeholder="Town / Area *" name="town_area" required />
                                                        </div>

                                                        <div class="address-form-col">
                                                            <input type="text" placeholder="City / District *" name="city" required />
                                                        </div>

                                                        <div class="address-form-col">
                                                            <select id="state-select" name="state" required>
                                                                <option value="" selected disabled>Select State / Province *</option>
                                                            </select>
                                                        </div>

                                                        <div class="address-form-col google-map-plus-field">
                                                            <input type="text" placeholder="Google map plus code" id="google-map-field" name="google_plus_code" />
                                                        </div>

                                                        <div class="bottom-address-form-row">
                                                            <div class="set-default-address">
                                                                <input type="checkbox" name="set_default" value="1" />
                                                                <label>Set as Default</label>
                                                            </div>

                                                            <div class="address-form-btn-group">
                                                                <ul>
                                                                    <li><a href="#" data-bs-dismiss="modal">Cancel</a></li>
                                                                    <li><a href="#" id="save-address-btn">Save</a></li>
                                                                    <li><a href="#" id="confirm-address-btn">Confirm</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="address-popup-right-col">
                                                    <h4>Address</h4>

                                                    <div class="blank-address-content">
                                                        <img src="{{ asset('public/assets/latest/images/no-data-2.png') }}" class="img-fluid" />
                                                        <h5>Add Address</h5>
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
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchInput");
            const statusFilter = document.getElementById("statusFilter");
            const designationFilter = document.getElementById("statusFilterDesignation");
            const table = document.getElementById("myTable");
            const rows = table.querySelectorAll("tbody tr:nth-child(odd)");

            function filterTable() {
                const searchValue = searchInput.value.toLowerCase();
                const selectedStatus = statusFilter.value.toLowerCase();
                const selectedDesignation = designationFilter.value.toLowerCase();

                rows.forEach((row) => {
                    const name = row.cells[2].textContent.toLowerCase();
                    const userId = row.cells[1].textContent.toLowerCase();
                    const designation = row.cells[3].textContent.trim().toLowerCase();
                    const status = row.cells[4].textContent.trim().toLowerCase();

                    const matchesSearch =
                        name.includes(searchValue) || userId.includes(searchValue) || designation.includes(searchValue);

                    const matchesStatus = !selectedStatus || status === selectedStatus;
                    const matchesDesignation = !selectedDesignation || designation === selectedDesignation;

                    if (matchesSearch && matchesStatus && matchesDesignation) {
                        row.style.display = "";
                        const expandRow = row.nextElementSibling;
                        if (expandRow && expandRow.classList.contains("hiddenRow")) {
                            expandRow.style.display = "";
                        }
                    } else {
                        row.style.display = "none";
                        const expandRow = row.nextElementSibling;
                        if (expandRow && expandRow.classList.contains("hiddenRow")) {
                            expandRow.style.display = "none";
                        }
                    }
                });
            }

            searchInput.addEventListener("input", filterTable);
            statusFilter.addEventListener("change", filterTable);
            designationFilter.addEventListener("change", filterTable);
        });


        let iti1;
        $(document).ready(function () {
            iti1 = $("#mobile_number").intlTelInput({
                initialCountry: "sg",
                separateDialCode: true,
            });


            $(".show-add-user-form").on("click", function (e) {
                $(".table-hj-list-section").hide();
                $(".filter-section-consultancy").hide();
                $(".add-user-form-section").show(); // use toggle() if you don’t want slide effect
            });

        });

        function clearUserManagementForm() {
            
            document.getElementById("manual_address_input").style.display = "block";
            document.getElementById("manual_address_input").setAttribute("required", "required");
            const addressBlock = document.getElementsByClassName("consultancy-form-address-feed-form")[0];
            addressBlock.classList.add("d-none");
            const form2 = document.getElementById("address_form");
            form2.reset();

            const addressCol = document.querySelector(".address-popup-right-col");
            addressCol.innerHTML = `<h4>Address</h4><div class="blank-address-content"><img src="{{ asset('public/assets/latest/images/no-data-2.png') }}" class="img-fluid" /><h5>Add Address</h5></div>`;
            $("#state-select").empty().append('<option value="" selected disabled>Select State / Province *</option>');
            document.getElementById("userManagmentForm").reset();
        }

        function validateUserManagementForm() {
            var editId = $('input[name="edit_id"]').val();
            const form = document.getElementById("userManagmentForm");
            let valid = true;

            const startDateInput = document.getElementById("startDate");
            const endDateInput = document.getElementById("endDate");

            const startDateWrapper = document.querySelector(".start-date-col");
            const endDateWrapper = document.querySelector(".end-date-col");

            // Reset any previous red borders
            startDateWrapper.style.border = "";
            endDateWrapper.style.border = "";

            // Validate start date
            if (!startDateInput.value) {
                startDateWrapper.style.border = "1px solid red";
                valid = false;
            }

            // Validate end date
            if (!endDateInput.value) {
                endDateWrapper.style.border = "1px solid red";
                valid = false;
            }
        
            const selectedRadio = form.querySelector('input[name="sex"]:checked');
            const selectedSex = selectedRadio ? selectedRadio.value : "";

            const genderBox = document.getElementById("genderBox");
            const customInput = document.getElementById("custom_sex");
            const customInputWrapper = document.getElementById("otherGenderInput");

            // Clean previous error styles
            genderBox.style.border = "";
            genderBox.querySelector(".field-error")?.remove();
            customInput.style.border = "";
            customInputWrapper.querySelector(".field-error")?.remove();

            // Case 1: No gender selected
            if (!selectedSex) {
                genderBox.style.border = "1px solid red";
                genderBox.style.borderRadius = "6px";

                const errorMsg = document.createElement("span");
                errorMsg.className = "field-error";
                errorMsg.style.color = "red";
                errorMsg.style.fontSize = "10px";
                genderBox.appendChild(errorMsg);

                valid = false;
            }

            // Case 2: Others selected → validate custom input
            if (selectedSex === "Others") {
                const customValue = customInput.value.trim();
                if (customValue === "") {
                    customInput.style.border = "1px solid red";
                    valid = false;
                }
            }

            // Remove previous styles and messages
            document.querySelectorAll(".mobile-error").forEach((el) => el.remove());
            document.querySelectorAll(".has-error").forEach((el) => el.classList.remove("has-error"));

            const requiredFields = form.querySelectorAll("input[required], select[required]");
            requiredFields.forEach((field) => {
                const value = field.value.trim();
                if (!value) {
                    field.style.borderColor = "red";
                    valid = false;
                } else {
                    field.style.borderColor = "";
                }
            });

            // Digit check for mobile_code
            var mobileInput = document.getElementById("mobile_number");
            var mobileValue = mobileInput.value.trim();
            var mobileParentDiv = mobileInput.closest(".telephone-form-col");

            // Remove any existing error message
            var existingError = mobileParentDiv.querySelector(".mobile-error");
            if (existingError) {
                existingError.remove();
            }

            if (!/^\d{11}$/.test(mobileValue)) {
                mobileInput.style.borderColor = "red";
                valid = false;

                var errorMsg = document.createElement("span");
                errorMsg.classList.add("mobile-error");
                errorMsg.style.marginTop = "50px";
                errorMsg.style.position = "absolute";
                errorMsg.style.color = "red";
                errorMsg.style.fontSize = "10px";
                errorMsg.textContent = "Mobile number must be exactly 11 digits";
                mobileParentDiv.appendChild(errorMsg);
            } else {
                mobileInput.style.borderColor = ""; // Reset border color if valid
            }
        // console.log("check valid",valid);

            if (!valid) return false;

            // Proceed with AJAX Submission
            let formData = new FormData(form);

            if (selectedSex === "Others") {
                const customValue = customInput.value.trim();
                formData.set("sex", "Other:" + customValue); 
            }

            const dialCode1 = "+" + iti1.intlTelInput("getSelectedCountryData").dialCode;
            formData.append("mobile_number_code", dialCode1);
            formData.append('reset_password', $('input[name="reset_password"]').is(':checked') ? '1' : '0');
            
            // Determine whether to Add or Update
            var actionUrl = "";
            var httpMethod = "";

            if (editId) {
                // If edit_id exists, it's an Update
                actionUrl = "{{ url('consultancies/update-user') }}/" + editId;
                formData.append("_method", "PUT");
            } else {
                // Add new record
                actionUrl = "{{ route('consultancy.add_user') }}"; // 
            }

            //console.log(Object.fromEntries(formData.entries()));

            $.ajax({
                url: "{{ route('hr.add_consultant') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                beforeSend: function () {
                    // Loader show karna
                    Swal.fire({
                        title: "Please wait...",
                        text: "Processing your request",
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function (response) {
                    // Loader close karna
                    Swal.close();
                    //console.log("check response",response)
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: response.message,
                        confirmButtonColor: "#3085d6",
                        allowOutsideClick: false, // Prevent closing by clicking outside
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });


                    // Optionally reset form
                    form.reset();
                },
                error: function (xhr) {
                    // Loader close karna
                    Swal.close();

                    let errorMessage = "Something went wrong while submitting the form.";
                    if (xhr.status === 400 || xhr.status === 409) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: "error",
                        title: "Oops!",
                        text: errorMessage,
                        confirmButtonColor: "#d33",
                    });

                    console.log(xhr.responseText);
                },
            });

        }
        function setIntlTelInput(selector, dialCode) {
            let countryISO = Object.keys(countryCode).find(key => countryCode[key] === dialCode) || "in";
            $(selector).intlTelInput("destroy").intlTelInput({
                initialCountry: countryISO,
                separateDialCode: true,
            });
        }

        function updateStartDateTable(date) {
            const thead = document.querySelector("#dateTable thead");
            if (thead) thead.remove();

            const tableBody = document.querySelector("#dateTable tbody");
            tableBody.innerHTML = "";

            const newRow = tableBody.insertRow();
            const newCell = newRow.insertCell(0);
            newCell.textContent = date;
        }

        function updateEndDateTable(date) {
            const thead = document.querySelector("#enddateTable thead");
            if (thead) thead.remove();

            const tableBody = document.querySelector("#enddateTable tbody");
            tableBody.innerHTML = "";

            const newRow = tableBody.insertRow();
            const newCell = newRow.insertCell(0);
            newCell.textContent = date;
        }

        const countryStateData = {
    
        "Afghanistan": [
          "Badakhshan", "Badghis", "Baghlan", "Balkh", "Bamyan", "Daykundi", "Farah", "Faryab", "Ghazni", "Ghor",
          "Helmand", "Herat", "Jowzjan", "Kabul", "Kandahar", "Kapisa", "Khost", "Kunar", "Kunduz", "Laghman",
          "Logar", "Nangarhar", "Nimruz", "Nuristan", "Paktia", "Paktika", "Panjshir", "Parwan", "Samangan",
          "Sar-e Pol", "Takhar", "Urozgan", "Wardak", "Zabul"
        ],
        "Albania": [
          "Berat", "Dibër", "Durrës", "Elbasan", "Fier", "Gjirokastër", "Korçë", "Kukës", "Lezhë", "Shkodër", "Tirana", "Vlorë"
        ],
        "Algeria": [
          "Adrar", "Chlef", "Laghouat", "Oum El Bouaghi", "Batna", "Béjaïa", "Biskra", "Béchar", "Blida", "Bouira",
          "Tamanrasset", "Tébessa", "Tlemcen", "Tiaret", "Tizi Ouzou", "Algiers", "Djelfa", "Jijel", "Sétif", "Saïda",
          "Skikda", "Sidi Bel Abbès", "Annaba", "Guelma", "Constantine", "Médéa", "Mostaganem", "M'Sila", "Mascara", "Ouargla",
          "Oran", "El Bayadh", "Illizi", "Bordj Bou Arréridj", "Boumerdès", "El Tarf", "Tindouf", "Tissemsilt", "El Oued", "Khenchela",
          "Souk Ahras", "Tipaza", "Mila", "Aïn Defla", "Naâma", "Aïn Témouchent", "Ghardaïa", "Relizane"
        ],
        "Andorra": [
          "Andorra la Vella", "Canillo", "Encamp", "Escaldes-Engordany", "La Massana", "Ordino", "Sant Julià de Lòria"
        ],
        "Angola": [
          "Bengo", "Benguela", "Bié", "Cabinda", "Cuando Cubango", "Cuanza Norte", "Cuanza Sul", "Cunene", "Huambo", "Huíla",
          "Luanda", "Lunda Norte", "Lunda Sul", "Malanje", "Moxico", "Namibe", "Uíge", "Zaire"
        ],
        "Antigua and Barbuda": [
          "Saint George", "Saint John", "Saint Mary", "Saint Paul", "Saint Peter", "Saint Philip", "Barbuda", "Redonda"
        ],
        "Argentina": [
          "Buenos Aires", "Catamarca", "Chaco", "Chubut", "Córdoba", "Corrientes", "Entre Ríos", "Formosa", "Jujuy",
          "La Pampa", "La Rioja", "Mendoza", "Misiones", "Neuquén", "Río Negro", "Salta", "San Juan", "San Luis",
          "Santa Cruz", "Santa Fe", "Santiago del Estero", "Tierra del Fuego", "Tucumán"
        ],
        "Armenia": [
          "Aragatsotn", "Ararat", "Armavir", "Gegharkunik", "Kotayk", "Lori", "Shirak", "Syunik", "Tavush", "Vayots Dzor", "Yerevan"
        ],
        "Australia": [
          "New South Wales", "Queensland", "South Australia", "Tasmania", "Victoria", "Western Australia",
          "Australian Capital Territory", "Northern Territory"
        ],
        "Austria": [
          "Burgenland", "Carinthia", "Lower Austria", "Upper Austria", "Salzburg", "Styria", "Tyrol", "Vorarlberg", "Vienna"
        ],
        "Azerbaijan": [
          "Absheron", "Ganja", "Sumqayit", "Mingachevir", "Lankaran", "Nakhchivan", "Shaki", "Shirvan", "Yevlakh", "Quba",
          "Zaqatala", "Guba-Khachmaz", "Jalilabad", "Fuzuli", "Tartar", "Barda"
        ],
      
      
    "Bahamas": [
    "Acklins", "Berry Islands", "Bimini", "Black Point", "Cat Island", "Central Abaco", "Central Andros",
    "Central Eleuthera", "City of Freeport", "Crooked Island", "East Grand Bahama", "Exuma", "Grand Cay",
    "Harbour Island", "Hope Town", "Inagua", "Long Island", "Mayaguana", "New Providence", "North Abaco",
    "North Andros", "North Eleuthera", "Ragged Island", "Rum Cay", "San Salvador", "South Abaco", "South Andros",
    "South Eleuthera", "Spanish Wells", "West Grand Bahama"
  ],
  "Bahrain": [
    "Capital", "Muharraq", "Northern", "Southern"
  ],
  "Bangladesh": [
    "Barisal", "Chittagong", "Dhaka", "Khulna", "Mymensingh", "Rajshahi", "Rangpur", "Sylhet"
  ],
  "Barbados": [
    "Christ Church", "Saint Andrew", "Saint George", "Saint James", "Saint John", "Saint Joseph",
    "Saint Lucy", "Saint Michael", "Saint Peter", "Saint Philip", "Saint Thomas"
  ],
  "Belarus": [
    "Brest", "Gomel", "Grodno", "Minsk", "Mogilev", "Vitebsk"
  ],
  "Belgium": [
    "Brussels-Capital Region", "Flemish Region", "Walloon Region"
  ],
  "Belize": [
    "Belize District", "Cayo District", "Corozal District", "Orange Walk District", "Stann Creek District", "Toledo District"
  ],
  "Benin": [
    "Alibori", "Atakora", "Atlantique", "Borgou", "Collines", "Donga", "Kouffo", "Littoral", "Mono", "Ouémé", "Plateau", "Zou"
  ],
  "Bhutan": [
    "Bumthang", "Chukha", "Dagana", "Gasa", "Haa", "Lhuntse", "Mongar", "Paro", "Pemagatshel", "Punakha",
    "Samdrup Jongkhar", "Samtse", "Sarpang", "Thimphu", "Trashigang", "Trashiyangtse", "Trongsa", "Tsirang",
    "Wangdue Phodrang", "Zhemgang"
  ],
  "Bolivia": [
    "Beni", "Chuquisaca", "Cochabamba", "La Paz", "Oruro", "Pando", "Potosí", "Santa Cruz", "Tarija"
  ],
  "Bosnia and Herzegovina": [
    "Federation of Bosnia and Herzegovina", "Republika Srpska", "Brčko District"
  ],
  "Botswana": [
    "Central", "Ghanzi", "Kgalagadi", "Kgatleng", "Kweneng", "North-East", "North-West", "South-East", "Southern"
  ],
  "Brazil": [
    "Acre", "Alagoas", "Amapá", "Amazonas", "Bahia", "Ceará", "Distrito Federal", "Espírito Santo", "Goiás", "Maranhão",
    "Mato Grosso", "Mato Grosso do Sul", "Minas Gerais", "Pará", "Paraíba", "Paraná", "Pernambuco", "Piauí",
    "Rio de Janeiro", "Rio Grande do Norte", "Rio Grande do Sul", "Rondônia", "Roraima", "Santa Catarina", "São Paulo",
    "Sergipe", "Tocantins"
  ],
  "Brunei": [
    "Belait", "Brunei-Muara", "Temburong", "Tutong"
  ],
  "Bulgaria": [
    "Blagoevgrad", "Burgas", "Dobrich", "Gabrovo", "Haskovo", "Kardzhali", "Kyustendil", "Lovech", "Montana",
    "Pazardzhik", "Pernik", "Pleven", "Plovdiv", "Razgrad", "Ruse", "Shumen", "Silistra", "Sliven", "Smolyan",
    "Sofia City", "Sofia Province", "Stara Zagora", "Targovishte", "Varna", "Veliko Tarnovo", "Vidin", "Vratsa", "Yambol"
  ],
  "Burkina Faso": [
    "Boucle du Mouhoun", "Cascades", "Centre", "Centre-Est", "Centre-Nord", "Centre-Ouest", "Centre-Sud",
    "Est", "Hauts-Bassins", "Nord", "Plateau-Central", "Sahel", "Sud-Ouest"
  ],
  "Burundi": [
    "Bubanza", "Bujumbura Mairie", "Bujumbura Rural", "Bururi", "Cankuzo", "Cibitoke", "Gitega", "Karuzi",
    "Kayanza", "Kirundo", "Makamba", "Muramvya", "Muyinga", "Mwaro", "Ngozi", "Rumonge", "Rutana", "Ruyigi"
  ],
  "Cabo Verde": [
    "Boa Vista", "Brava", "Maio", "Mosteiros", "Paul", "Porto Novo", "Praia", "Ribeira Brava", "Ribeira Grande",
    "Ribeira Grande de Santiago", "Sal", "Santa Catarina", "Santa Catarina do Fogo", "Santa Cruz", "São Domingos",
    "São Filipe", "São Lourenço dos Órgãos", "São Miguel", "São Salvador do Mundo", "São Vicente", "Tarrafal", "Tarrafal de São Nicolau"
  ],
  "Cambodia": [
    "Banteay Meanchey", "Battambang", "Kampong Cham", "Kampong Chhnang", "Kampong Speu", "Kampong Thom", "Kampot",
    "Kandal", "Kep", "Koh Kong", "Kratie", "Mondulkiri", "Phnom Penh", "Preah Vihear", "Prey Veng", "Pursat",
    "Ratanakiri", "Siem Reap", "Sihanoukville", "Stung Treng", "Svay Rieng", "Takeo", "Oddar Meanchey", "Pailin", "Tbong Khmum"
  ],
  "Cameroon": [
    "Adamawa", "Centre", "East", "Far North", "Littoral", "North", "Northwest", "South", "Southwest", "West"
  ],
  "Canada": [
    "Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland and Labrador", "Nova Scotia",
    "Ontario", "Prince Edward Island", "Quebec", "Saskatchewan", "Northwest Territories", "Nunavut", "Yukon"
  ],
  "Central African Republic": [
    "Bamingui-Bangoran", "Basse-Kotto", "Haute-Kotto", "Haute-Sangha", "Haut-Mbomou", "Kémo", "Lobaye", "Mambéré-Kadéï",
    "Mbomou", "Nana-Grébizi", "Nana-Mambéré", "Ombella-M'Poko", "Ouaka", "Ouham", "Ouham-Pendé", "Sangha-Mbaéré",
    "Vakaga"
  ],
  "Chad": [
    "Batha", "Borkou", "Chari-Baguirmi", "Guéra", "Hadjer-Lamis", "Kanem", "Lac", "Logone Occidental", "Logone Oriental",
    "Mandoul", "Mayo-Kebbi Est", "Mayo-Kebbi Ouest", "Moyen-Chari", "Ouaddaï", "Salamat", "Sila", "Tandjilé",
    "Tibesti", "Ville de N'Djamena", "Wadi Fira"
  ],
  "Chile": [
    "Arica y Parinacota", "Tarapacá", "Antofagasta", "Atacama", "Coquimbo", "Valparaíso", "Metropolitana de Santiago",
    "Libertador General Bernardo O'Higgins", "Maule", "Ñuble", "Biobío", "Araucanía", "Los Ríos", "Los Lagos",
    "Aysén", "Magallanes"
  ],
  "China": [
    "Anhui", "Beijing", "Chongqing", "Fujian", "Gansu", "Guangdong", "Guangxi", "Guizhou", "Hainan", "Hebei",
    "Heilongjiang", "Henan", "Hong Kong", "Hubei", "Hunan", "Inner Mongolia", "Jiangsu", "Jiangxi", "Jilin", "Liaoning",
    "Macau", "Ningxia", "Qinghai", "Shaanxi", "Shandong", "Shanghai", "Shanxi", "Sichuan", "Tianjin", "Tibet",
    "Xinjiang", "Yunnan", "Zhejiang"
  ],
  "Colombia": [
    "Amazonas", "Antioquia", "Arauca", "Atlántico", "Bogotá", "Bolívar", "Boyacá", "Caldas", "Caquetá", "Casanare",
    "Cauca", "Cesar", "Chocó", "Córdoba", "Cundinamarca", "Guainía", "Guaviare", "Huila", "La Guajira", "Magdalena",
    "Meta", "Nariño", "Norte de Santander", "Putumayo", "Quindío", "Risaralda", "San Andrés and Providencia", "Santander",
    "Sucre", "Tolima", "Valle del Cauca", "Vaupés", "Vichada"
  ],
  "Comoros": [
    "Anjouan", "Grande Comore", "Mohéli"
  ],
  "Congo (Brazzaville)": [
    "Bouenza", "Brazzaville", "Cuvette", "Cuvette-Ouest", "Kouilou", "Lekoumou", "Likouala", "Niari", "Plateaux",
    "Pointe-Noire", "Pool", "Sangha"
  ],
  "Congo (Kinshasa)": [
    "Bas-Uele", "Haut-Uele", "Ituri", "Tshopo", "Haut-Lomami", "Lomami", "Kasai", "Kasai-Central", "Kasai-Oriental",
    "Kwilu", "Kwango", "Mai-Ndombe", "Kinshasa", "Mongala", "Nord-Ubangi", "Sud-Ubangi", "Équateur", "Tshuapa",
    "Maniema", "Sud-Kivu", "Nord-Kivu", "Tanganyika", "Haut-Katanga", "Lualaba"
  ],
  "Costa Rica": [
    "Alajuela", "Cartago", "Guanacaste", "Heredia", "Limón", "Puntarenas", "San José"
  ],
  "Croatia": [
    "Bjelovar-Bilogora", "Brod-Posavina", "Dubrovnik-Neretva", "Istria", "Karlovac", "Koprivnica-Križevci",
    "Krapina-Zagorje", "Lika-Senj", "Međimurje", "Osijek-Baranja", "Požega-Slavonia", "Primorje-Gorski Kotar",
    "Šibenik-Knin", "Sisak-Moslavina", "Split-Dalmatia", "Varaždin", "Virovitica-Podravina", "Vukovar-Srijem",
    "Zadar", "Zagreb County", "City of Zagreb"
  ],
  "Cuba": [
    "Artemisa", "Camagüey", "Ciego de Ávila", "Cienfuegos", "Granma", "Guantánamo", "Havana", "Holguín",
    "Isla de la Juventud", "Las Tunas", "Matanzas", "Mayabeque", "Pinar del Río", "Sancti Spíritus", "Santiago de Cuba",
    "Villa Clara"
  ],
  "Cyprus": [
    "Famagusta", "Kyrenia", "Larnaca", "Limassol", "Nicosia", "Paphos"
  ],
  "Denmark": [
    "Capital Region of Denmark",
    "Central Denmark Region",
    "North Denmark Region",
    "Region of Southern Denmark",
    "Region Zealand"
  ],
  "Djibouti": [
    "Ali Sabieh Region",
    "Arta Region",
    "Dikhil Region",
    "Djibouti City",
    "Obock Region",
    "Tadjourah Region"
  ],
  "Dominica": [
    "Saint Andrew Parish",
    "Saint David Parish",
    "Saint George Parish",
    "Saint John Parish",
    "Saint Joseph Parish",
    "Saint Luke Parish",
    "Saint Mark Parish",
    "Saint Patrick Parish",
    "Saint Paul Parish",
    "Saint Peter Parish"
  ],
  "Dominican Republic": [
    "Azua", "Bahoruco", "Barahona", "Dajabón", "Distrito Nacional", "Duarte", "Elías Piña", "El Seibo",
    "Espaillat", "Hato Mayor", "Hermanas Mirabal", "Independencia", "La Altagracia", "La Romana", "La Vega",
    "María Trinidad Sánchez", "Monseñor Nouel", "Monte Cristi", "Monte Plata", "Pedernales", "Peravia",
    "Puerto Plata", "Samaná", "San Cristóbal", "San José de Ocoa", "San Juan", "San Pedro de Macorís",
    "Sánchez Ramírez", "Santiago", "Santiago Rodríguez", "Santo Domingo", "Valverde"
  ],
  "Ecuador": [
    "Azuay", "Bolívar", "Cañar", "Carchi", "Chimborazo", "Cotopaxi", "El Oro", "Esmeraldas", "Galápagos",
    "Guayas", "Imbabura", "Loja", "Los Ríos", "Manabí", "Morona Santiago", "Napo", "Orellana", "Pastaza",
    "Pichincha", "Santa Elena", "Santo Domingo de los Tsáchilas", "Sucumbíos", "Tungurahua", "Zamora-Chinchipe"
  ],
  "Egypt": [
    "Alexandria", "Aswan", "Asyut", "Beheira", "Beni Suef", "Cairo", "Dakahlia", "Damietta", "Faiyum", "Gharbia",
    "Giza", "Ismailia", "Kafr El Sheikh", "Luxor", "Matruh", "Minya", "Monufia", "New Valley", "North Sinai",
    "Port Said", "Qalyubia", "Qena", "Red Sea", "Sharqia", "Sohag", "South Sinai", "Suez"
  ],
  "El Salvador": [
    "Ahuachapán", "Cabañas", "Chalatenango", "Cuscatlán", "La Libertad", "La Paz", "La Unión", "Morazán",
    "San Miguel", "San Salvador", "San Vicente", "Santa Ana", "Sonsonate", "Usulután"
  ],
  "Equatorial Guinea": [
    "Annobón", "Bioko Norte", "Bioko Sur", "Centro Sur", "Kié-Ntem", "Litoral", "Wele-Nzas"
  ],
  "Eritrea": [
    "Anseba", "Debub", "Debubawi Keyih Bahri", "Gash-Barka", "Maekel", "Semienawi Keyih Bahri"
  ],
  "Estonia": [
    "Harju County", "Hiiu County", "Ida-Viru County", "Jõgeva County", "Järva County", "Lääne County",
    "Lääne-Viru County", "Põlva County", "Pärnu County", "Rapla County", "Saare County", "Tartu County",
    "Valga County", "Viljandi County", "Võru County"
  ],
  "Eswatini": [
    "Hhohho", "Lubombo", "Manzini", "Shiselweni"
  ],
  "Ethiopia": [
    "Addis Ababa", "Afar Region", "Amhara Region", "Benishangul-Gumuz Region", "Dire Dawa", "Gambela Region",
    "Harari Region", "Oromia Region", "Sidama Region", "Somali Region", "Southern Nations, Nationalities, and Peoples' Region",
    "Tigray Region"
  ],
    "Fiji": [
    "Central Division",
    "Western Division",
    "Northern Division",
    "Eastern Division",
    "Rotuma"
  ],
  "Finland": [
    "Uusimaa",
    "Southwest Finland",
    "Satakunta",
    "Kanta-Häme",
    "Pirkanmaa",
    "Päijät-Häme",
    "Kymenlaakso",
    "South Karelia",
    "Southern Savonia",
    "Northern Savonia",
    "North Karelia",
    "Central Finland",
    "South Ostrobothnia",
    "Ostrobothnia",
    "Central Ostrobothnia",
    "North Ostrobothnia",
    "Kainuu",
    "Lapland",
    "Åland"
  ],
  "France": [
    "Auvergne-Rhône-Alpes",
    "Bourgogne-Franche-Comté",
    "Brittany",
    "Centre-Val de Loire",
    "Corsica",
    "Grand Est",
    "Hauts-de-France",
    "Île-de-France",
    "Normandy",
    "Nouvelle-Aquitaine",
    "Occitanie",
    "Pays de la Loire",
    "Provence-Alpes-Côte d’Azur"
  ],
  "Gabon": [
    "Estuaire",
    "Haut-Ogooué",
    "Moyen-Ogooué",
    "Ngounié",
    "Nyanga",
    "Ogooué-Ivindo",
    "Ogooué-Lolo",
    "Ogooué-Maritime",
    "Woleu-Ntem"
  ],
  "Gambia": [
    "Banjul",
    "Kanifing",
    "Brikama (West Coast Division)",
    "Mansakonko (Lower River Division)",
    "Kerewan (North Bank Division)",
    "Kuntaur (Central River Division - west)",
    "Janjanbureh (Central River Division - east)",
    "Basse (Upper River Division)"
  ],
  "Georgia": [
    "Tbilisi",
    "Adjara",
    "Guria",
    "Imereti",
    "Kakheti",
    "Kvemo Kartli",
    "Mtskheta-Mtianeti",
    "Racha-Lechkhumi and Kvemo Svaneti",
    "Samegrelo-Zemo Svaneti",
    "Samtskhe-Javakheti",
    "Shida Kartli"
  ],
  "Germany": [
    "Baden-Württemberg",
    "Bavaria",
    "Berlin",
    "Brandenburg",
    "Bremen",
    "Hamburg",
    "Hesse",
    "Lower Saxony",
    "Mecklenburg-Vorpommern",
    "North Rhine-Westphalia",
    "Rhineland-Palatinate",
    "Saarland",
    "Saxony",
    "Saxony-Anhalt",
    "Schleswig-Holstein",
    "Thuringia"
  ],
  "Ghana": [
    "Ahafo",
    "Ashanti",
    "Bono",
    "Bono East",
    "Central",
    "Eastern",
    "Greater Accra",
    "North East",
    "Northern",
    "Oti",
    "Savannah",
    "Upper East",
    "Upper West",
    "Volta",
    "Western",
    "Western North"
  ],
  "Greece": [
    "Attica",
    "Central Greece",
    "Central Macedonia",
    "Crete",
    "East Macedonia and Thrace",
    "Epirus",
    "Ionian Islands",
    "North Aegean",
    "Peloponnese",
    "South Aegean",
    "Thessaly",
    "Western Greece",
    "Western Macedonia"
  ],
  "Grenada": [
    "Saint Andrew",
    "Saint David",
    "Saint George",
    "Saint John",
    "Saint Mark",
    "Saint Patrick",
    "Carriacou and Petite Martinique"
  ],
  "Guatemala": [
    "Alta Verapaz",
    "Baja Verapaz",
    "Chimaltenango",
    "Chiquimula",
    "El Progreso",
    "Escuintla",
    "Guatemala",
    "Huehuetenango",
    "Izabal",
    "Jalapa",
    "Jutiapa",
    "Petén",
    "Quetzaltenango",
    "Quiché",
    "Retalhuleu",
    "Sacatepéquez",
    "San Marcos",
    "Santa Rosa",
    "Sololá",
    "Suchitepéquez",
    "Totonicapán",
    "Zacapa"
  ],
  "Guinea": [
    "Boké",
    "Conakry",
    "Faranah",
    "Kankan",
    "Kindia",
    "Labé",
    "Mamou",
    "Nzérékoré"
  ],
  "Guinea-Bissau": [
    "Bafatá",
    "Biombo",
    "Bissau",
    "Bolama",
    "Cacheu",
    "Gabú",
    "Oio",
    "Quinara",
    "Tombali"
  ],
  "Guyana": [
    "Barima-Waini",
    "Cuyuni-Mazaruni",
    "Demerara-Mahaica",
    "East Berbice-Corentyne",
    "Essequibo Islands-West Demerara",
    "Mahaica-Berbice",
    "Pomeroon-Supenaam",
    "Potaro-Siparuni",
    "Upper Demerara-Berbice",
    "Upper Takutu-Upper Essequibo"
  ],
  "Haiti": [
    "Artibonite",
    "Centre",
    "Grand'Anse",
    "Nippes",
    "Nord",
    "Nord-Est",
    "Nord-Ouest",
    "Ouest",
    "Sud",
    "Sud-Est"
  ],
  "Honduras": [
    "Atlántida",
    "Choluteca",
    "Colón",
    "Comayagua",
    "Copán",
    "Cortés",
    "El Paraíso",
    "Francisco Morazán",
    "Gracias a Dios",
    "Intibucá",
    "Islas de la Bahía",
    "La Paz",
    "Lempira",
    "Ocotepeque",
    "Olancho",
    "Santa Bárbara",
    "Valle",
    "Yoro"
  ],
  "Hungary": [
    "Bács-Kiskun",
    "Baranya",
    "Békés",
    "Borsod-Abaúj-Zemplén",
    "Csongrád-Csanád",
    "Fejér",
    "Győr-Moson-Sopron",
    "Hajdú-Bihar",
    "Heves",
    "Jász-Nagykun-Szolnok",
    "Komárom-Esztergom",
    "Nógrád",
    "Pest",
    "Somogy",
    "Szabolcs-Szatmár-Bereg",
    "Tolna",
    "Vas",
    "Veszprém",
    "Zala",
    "Budapest"
  ],
  "Iceland": [
    "Capital Region",
    "Southern Peninsula",
    "West",
    "Westfjords",
    "Northwest",
    "Northeast",
    "East",
    "South"
  ],
    "India": [
    "Andhra Pradesh",
    "Arunachal Pradesh",
    "Assam",
    "Bihar",
    "Chhattisgarh",
    "Goa",
    "Gujarat",
    "Haryana",
    "Himachal Pradesh",
    "Jharkhand",
    "Karnataka",
    "Kerala",
    "Madhya Pradesh",
    "Maharashtra",
    "Manipur",
    "Meghalaya",
    "Mizoram",
    "Nagaland",
    "Odisha",
    "Punjab",
    "Rajasthan",
    "Sikkim",
    "Tamil Nadu",
    "Telangana",
    "Tripura",
    "Uttar Pradesh",
    "Uttarakhand",
    "West Bengal",
    "Andaman and Nicobar Islands",
    "Chandigarh",
    "Dadra and Nagar Haveli and Daman and Diu",
    "Delhi",
    "Jammu and Kashmir",
    "Ladakh",
    "Lakshadweep",
    "Puducherry"
    ],

    "Indonesia": [
        "Aceh", "Bali", "Banten", "Bengkulu", "Central Java", "Central Kalimantan", "Central Sulawesi",
        "East Java", "East Kalimantan", "East Nusa Tenggara", "Gorontalo", "Jakarta", "Jambi", "Lampung",
        "Maluku", "North Kalimantan", "North Maluku", "North Sulawesi", "North Sumatra", "Papua", "Riau",
        "Riau Islands", "Southeast Sulawesi", "South Kalimantan", "South Sulawesi", "South Sumatra",
        "West Java", "West Kalimantan", "West Nusa Tenggara", "West Papua", "West Sulawesi", "West Sumatra",
        "Yogyakarta"
      ],
      "Iran": [
        "Tehran", "Isfahan", "Fars", "Razavi Khorasan", "East Azerbaijan", "West Azerbaijan", "Khuzestan",
        "Mazandaran", "Gilan", "Kerman", "Kermanshah", "Lorestan", "Golestan", "Hamadan", "Sistan and Baluchestan"
      ],
      "Iraq": [
        "Baghdad", "Basra", "Nineveh (Mosul)", "Erbil", "Kirkuk", "Anbar", "Dhi Qar", "Diyala",
        "Muthanna", "Najaf", "Wasit", "Babil", "Karbala", "Maysan", "Salahaddin", "Sulaymaniyah", "Duhok"
      ],
      "Ireland": [
        "Carlow", "Cavan", "Clare", "Cork", "Donegal", "Dublin", "Galway", "Kerry", "Kildare",
        "Kilkenny", "Laois", "Leitrim", "Limerick", "Longford", "Louth", "Mayo", "Meath", "Monaghan",
        "Offaly", "Roscommon", "Sligo", "Tipperary", "Waterford", "Westmeath", "Wexford", "Wicklow"
      ],
      "Israel": [
        "Jerusalem", "Tel Aviv", "Haifa", "Northern District", "Central District", "Southern District"
      ],
      "Italy": [
        "Abruzzo", "Aosta Valley", "Apulia", "Basilicata", "Calabria", "Campania", "Emilia-Romagna",
        "Friuli Venezia Giulia", "Lazio", "Liguria", "Lombardy", "Marche", "Molise", "Piedmont", "Sardinia",
        "Sicily", "Trentino-Alto Adige/Südtirol", "Tuscany", "Umbria", "Veneto"
      ],
      "Ivory Coast": [
        "Abidjan", "Bas-Sassandra", "Comoé", "Denguélé", "Gôh-Djiboua", "Lacs", "Lagunes",
        "Montagnes", "Sassandra-Marahoué", "Savanes", "Vallée du Bandama", "Woroba", "Yamoussoukro", "Zanzan"
      ],
      "Jamaica": [
        "Clarendon", "Hanover", "Kingston", "Manchester", "Portland", "Saint Andrew", "Saint Ann",
        "Saint Catherine", "Saint Elizabeth", "Saint James", "Saint Mary", "Saint Thomas", "Trelawny", "Westmoreland"
      ],
      "Japan": [
        "Hokkaido", "Aomori", "Iwate", "Miyagi", "Akita", "Yamagata", "Fukushima", "Ibaraki", "Tochigi", "Gunma",
        "Saitama", "Chiba", "Tokyo", "Kanagawa", "Niigata", "Toyama", "Ishikawa", "Fukui", "Yamanashi",
        "Nagano", "Gifu", "Shizuoka", "Aichi", "Mie", "Shiga", "Kyoto", "Osaka", "Hyogo", "Nara", "Wakayama",
        "Tottori", "Shimane", "Okayama", "Hiroshima", "Yamaguchi", "Tokushima", "Kagawa", "Ehime", "Kochi",
        "Fukuoka", "Saga", "Nagasaki", "Kumamoto", "Oita", "Miyazaki", "Kagoshima", "Okinawa"
      ],
      "Jordan": [
        "Amman", "Zarqa", "Irbid", "Aqaba", "Mafraq", "Balqa", "Jerash", "Ajloun", "Madaba", "Karak", "Tafilah", "Ma'an"
      ],
      "Kazakhstan": [
        "Akmola", "Aktobe", "Almaty", "Atyrau", "East Kazakhstan", "Jambyl", "Karaganda", "Kostanay",
        "Kyzylorda", "Mangystau", "North Kazakhstan", "Pavlodar", "Turkestan", "West Kazakhstan",
        "Astana", "Shymkent"
      ],
      "Kenya": [
        "Baringo", "Bomet", "Bungoma", "Busia", "Elgeyo-Marakwet", "Embu", "Garissa", "Homa Bay", "Isiolo",
        "Kajiado", "Kakamega", "Kericho", "Kiambu", "Kilifi", "Kirinyaga", "Kisii", "Kisumu", "Kitui", "Kwale",
        "Laikipia", "Lamu", "Machakos", "Makueni", "Mandera", "Marsabit", "Meru", "Migori", "Mombasa", "Murang'a",
        "Nairobi", "Nakuru", "Nandi", "Narok", "Nyamira", "Nyandarua", "Nyeri", "Samburu", "Siaya", "Taita-Taveta",
        "Tana River", "Tharaka-Nithi", "Trans-Nzoia", "Turkana", "Uasin Gishu", "Vihiga", "Wajir", "West Pokot"
      ],
      "Kiribati": [
        "Gilbert Islands", "Phoenix Islands", "Line Islands"
      ],
      "Kuwait": [
        "Al Ahmadi", "Al Asimah (Capital)", "Al Farwaniyah", "Al Jahra", "Hawalli", "Mubarak Al-Kabeer"
      ],
      "Kyrgyzstan": [
        "Batken Region", "Chuy Region", "Jalal-Abad Region", "Naryn Region", "Osh Region",
        "Talas Region", "Issyk-Kul Region", "Bishkek City", "Osh City"
      ],
      "Laos": [
        "Attapeu", "Bokeo", "Bolikhamsai", "Champasak", "Houaphanh", "Khammouane", "Luang Namtha",
        "Luang Prabang", "Oudomxay", "Phongsaly", "Savannakhet", "Sekong", "Vientiane Province",
        "Vientiane Prefecture", "Xaignabouli", "Xaisomboun", "Xekong", "Xiangkhouang"
      ],
      "Latvia": [
        "Aizkraukle", "Alūksne", "Balvi", "Bauska", "Cēsis", "Daugavpils", "Dobele", "Gulbene",
        "Jēkabpils", "Jelgava", "Jūrmala", "Krāslava", "Kuldīga", "Liepāja", "Limbaži", "Ludza",
        "Madona", "Ogre", "Preiļi", "Rēzekne", "Riga", "Saldus", "Talsi", "Tukums", "Valka", "Valmiera", "Ventspils"
      ],
      "Lebanon": [
        "Beirut", "Mount Lebanon", "North Governorate", "South Governorate", "Beqaa Governorate",
        "Nabatieh Governorate", "Akkar Governorate", "Baalbek-Hermel Governorate"
      ],
      "Lesotho": [
        "Berea", "Butha-Buthe", "Leribe", "Mafeteng", "Maseru", "Mohale’s Hoek", "Mokhotlong",
        "Qacha’s Nek", "Quthing", "Thaba-Tseka"
      ],
      "Liberia": [
        "Bomi", "Bong", "Gbarpolu", "Grand Bassa", "Grand Cape Mount", "Grand Gedeh", "Grand Kru",
        "Lofa", "Margibi", "Maryland", "Montserrado", "Nimba", "River Cess", "River Gee", "Sinoe"
      ],
      "Libya": [
        "Tripoli", "Benghazi", "Misrata", "Al Bayda", "Zawiya", "Sebha", "Derna", "Sirte", "Ajdabiya"
      ],
      "Liechtenstein": [
        "Balzers", "Eschen", "Gamprin", "Mauren", "Planken", "Ruggell", "Schaan", "Schellenberg", "Triesen", "Triesenberg", "Vaduz"
      ],
      "Lithuania": [
        "Alytus County", "Kaunas County", "Klaipėda County", "Marijampolė County", "Panevėžys County",
        "Šiauliai County", "Tauragė County", "Telšiai County", "Utena County", "Vilnius County"
      ],
      "Luxembourg": [
        "Diekirch", "Grevenmacher", "Luxembourg"
      ],
      "Madagascar": [
        "Alaotra-Mangoro", "Amoron'i Mania", "Analamanga", "Analanjirofo", "Androy", "Anosy",
        "Atsimo-Andrefana", "Atsimo-Atsinanana", "Atsinanana", "Betsiboka", "Boeny", "Bongolava",
        "Diana", "Haute Matsiatra", "Ihorombe", "Itasy", "Melaky", "Menabe", "Sava", "Sofia", "Vakinankaratra", "Vatovavy"
      ],
      "Malawi": [
        "Central Region", "Northern Region", "Southern Region"
      ],
      "Malaysia": [
        "Johor", "Kedah", "Kelantan", "Malacca", "Negeri Sembilan", "Pahang", "Penang",
        "Perak", "Perlis", "Sabah", "Sarawak", "Selangor", "Terengganu", "Kuala Lumpur", "Labuan", "Putrajaya"
      ],
      "Maldives": [
        "Addu City", "Fuvahmulah", "Greater Malé Region", "Kulhudhuffushi", "Thinadhoo"
      ],
      "Mali": [
        "Bamako", "Gao", "Kayes", "Kidal", "Koulikoro", "Mopti", "Ségou", "Sikasso", "Tombouctou", "Taoudénit", "Ménaka"
      ],
      "Malta": [
        "Attard", "Balzan", "Birgu", "Birkirkara", "Birżebbuġa", "Bormla", "Dingli", "Fgura", "Floriana", "Fontana",
        "Għajnsielem", "Għarb", "Għargħur", "Għasri", "Għaxaq", "Gudja", "Gżira", "Ħamrun", "Iklin", "Isla", "Kalkara",
        "Kerċem", "Kirkop", "Lija", "Luqa", "Marsa", "Marsaskala", "Marsaxlokk", "Mdina", "Mellieħa", "Mġarr", "Mosta",
        "Mqabba", "Msida", "Mtarfa", "Munxar", "Nadur", "Naxxar", "Paola", "Pembroke", "Pietà", "Qala", "Qormi",
        "Qrendi", "Rabat", "Safi", "San Ġiljan", "San Ġwann", "San Lawrenz", "Sannat", "Santa Luċija", "Santa Venera",
        "Siġġiewi", "Sliema", "St. Paul's Bay", "Swieqi", "Ta' Xbiex", "Tarxien", "Valletta", "Victoria", "Xagħra",
        "Xewkija", "Xgħajra", "Żabbar", "Żebbuġ (Gozo)", "Żebbuġ (Malta)", "Żejtun", "Żurrieq"
      ],
      "Marshall Islands": [
        "Majuro Atoll", "Kwajalein Atoll", "Arno", "Ailuk", "Enewetak", "Jaluit", "Wotho", "Wotje"
      ],
      "Mauritania": [
        "Adrar", "Assaba", "Brakna", "Dakhlet Nouadhibou", "Gorgol", "Guidimaka", "Hodh Ech Chargui", "Hodh El Gharbi",
        "Inchiri", "Nouakchott-Nord", "Nouakchott-Ouest", "Nouakchott-Sud", "Tagant", "Tiris Zemmour", "Trarza"
      ],
      "Mauritius": [
        "Black River", "Flacq", "Grand Port", "Moka", "Pamplemousses", "Plaines Wilhems", "Port Louis", "Rivière du Rempart", "Savanne"
      ],
      "Mexico": [
        "Aguascalientes", "Baja California", "Baja California Sur", "Campeche", "Chiapas", "Chihuahua", "Coahuila",
        "Colima", "Durango", "Guanajuato", "Guerrero", "Hidalgo", "Jalisco", "Mexico City", "Mexico State", "Michoacán",
        "Morelos", "Nayarit", "Nuevo León", "Oaxaca", "Puebla", "Querétaro", "Quintana Roo", "San Luis Potosí",
        "Sinaloa", "Sonora", "Tabasco", "Tamaulipas", "Tlaxcala", "Veracruz", "Yucatán", "Zacatecas"
      ],
      "Micronesia": [
        "Chuuk", "Kosrae", "Pohnpei", "Yap"
      ],
      "Moldova": [
        "Chișinău", "Bălți", "Tiraspol", "Cahul", "Ungheni", "Orhei", "Soroca", "Edineț", "Comrat", "Căușeni"
      ],
      "Monaco": [
        "Fontvieille", "La Condamine", "Monaco-Ville", "Monte Carlo", "Moneghetti", "Larvotto", "La Rousse", "Les Révoires"
      ],
      "Mongolia": [
        "Ulaanbaatar", "Arkhangai", "Bayan-Ölgii", "Bayankhongor", "Bulgan", "Darkhan-Uul", "Dornod", "Dornogovi",
        "Dundgovi", "Govi-Altai", "Govisümber", "Khentii", "Khovd", "Khövsgöl", "Ömnögovi", "Orkhon", "Övörkhangai",
        "Selenge", "Sükhbaatar", "Töv", "Uvs", "Zavkhan"
      ],
      "Montenegro": [
        "Podgorica", "Nikšić", "Herceg Novi", "Pljevlja", "Bijelo Polje", "Bar", "Budva", "Cetinje", "Berane", "Kotor"
      ],
      "Morocco": [
        "Casablanca-Settat", "Rabat-Salé-Kénitra", "Fès-Meknès", "Marrakech-Safi", "Tanger-Tetouan-Al Hoceima",
        "Souss-Massa", "Béni Mellal-Khénifra", "Drâa-Tafilalet", "Oriental", "Guelmim-Oued Noun",
        "Laâyoune-Sakia El Hamra", "Dakhla-Oued Ed-Dahab"
      ],
      "Mozambique": [
        "Cabo Delgado", "Gaza", "Inhambane", "Manica", "Maputo", "Nampula", "Niassa", "Sofala", "Tete", "Zambezia"
      ],
      "Myanmar (Burma)": [
        "Ayeyarwady Region", "Bago Region", "Chin State", "Kachin State", "Kayah State", "Kayin State",
        "Magway Region", "Mandalay Region", "Mon State", "Naypyidaw Union Territory", "Rakhine State",
        "Sagaing Region", "Shan State", "Tanintharyi Region", "Yangon Region"
      ],
      "Namibia": [
        "Erongo", "Hardap", "Karas", "Kavango East", "Kavango West", "Khomas", "Kunene", "Ohangwena",
        "Omaheke", "Omusati", "Oshana", "Oshikoto", "Otjozondjupa", "Zambezi"
      ],
      "Nauru": [
        "Aiwo", "Anabar", "Anetan", "Anibare", "Baiti", "Boe", "Buada", "Denigomodu", "Ewa", "Ijuw",
        "Meneng", "Nibok", "Uaboe", "Yaren"
      ],
      "Nepal": [
        "Province No. 1", "Madhesh Province", "Bagmati Province", "Gandaki Province", "Lumbini Province",
        "Karnali Province", "Sudurpashchim Province"
      ],
      "Netherlands": [
        "Drenthe", "Flevoland", "Friesland", "Gelderland", "Groningen", "Limburg", "North Brabant",
        "North Holland", "Overijssel", "South Holland", "Utrecht", "Zeeland"
      ],
      "New Zealand": [
        "Auckland", "Bay of Plenty", "Canterbury", "Gisborne", "Hawke's Bay", "Manawatū-Whanganui", "Marlborough",
        "Nelson", "Northland", "Otago", "Southland", "Taranaki", "Tasman", "Waikato", "Wellington", "West Coast"
      ],
      "Nicaragua": [
        "Boaco", "Carazo", "Chinandega", "Chontales", "Estelí", "Granada", "Jinotega", "León",
        "Madriz", "Managua", "Masaya", "Matagalpa", "Nueva Segovia", "Rivas", "Río San Juan", "South Caribbean Coast", "North Caribbean Coast"
      ],
      "Niger": [
        "Agadez", "Diffa", "Dosso", "Maradi", "Tahoua", "Tillabéri", "Zinder", "Niamey"
      ],
      "Nigeria": [
        "Abia", "Adamawa", "Akwa Ibom", "Anambra", "Bauchi", "Bayelsa", "Benue", "Borno", "Cross River",
        "Delta", "Ebonyi", "Edo", "Ekiti", "Enugu", "Gombe", "Imo", "Jigawa", "Kaduna", "Kano", "Katsina",
        "Kebbi", "Kogi", "Kwara", "Lagos", "Nasarawa", "Niger", "Ogun", "Ondo", "Osun", "Oyo", "Plateau",
        "Rivers", "Sokoto", "Taraba", "Yobe", "Zamfara", "FCT-Abuja"
      ],
      "North Korea": [
        "Pyongyang", "Chagang", "North Hamgyong", "South Hamgyong", "North Hwanghae", "South Hwanghae",
        "Kangwon", "North Pyongan", "South Pyongan", "Ryanggang", "Nampo", "Rason"
      ],
      "North Macedonia": [
        "Skopje", "Bitola", "Kumanovo", "Prilep", "Tetovo", "Gostivar", "Ohrid", "Veles", "Kavadarci", "Strumica"
      ],
      "Norway": [
        "Agder", "Innlandet", "Møre og Romsdal", "Nordland", "Oslo", "Rogaland", "Troms og Finnmark",
        "Trøndelag", "Vestfold og Telemark", "Vestland", "Viken"
      ],
      "Oman": [
        "Ad Dakhiliyah", "Al Batinah North", "Al Batinah South", "Al Buraimi", "Al Wusta", "Ash Sharqiyah North",
        "Ash Sharqiyah South", "Dhofar", "Musandam", "Muscat"
      ],
      "Pakistan": [
        "Balochistan", "Islamabad Capital Territory", "Khyber Pakhtunkhwa", "Punjab", "Sindh", "Gilgit-Baltistan", "Azad Jammu and Kashmir"
      ],
      "Palau": [
        "Aimeliik", "Airai", "Angaur", "Hatohobei", "Kayangel", "Koror", "Melekeok", "Ngaraard",
        "Ngarchelong", "Ngardmau", "Ngatpang", "Ngchesar", "Ngeremlengui", "Ngiwal", "Peleliu", "Sonsorol"
      ],
      "Palestine": [
        "Bethlehem", "Deir al-Balah", "Gaza", "Hebron", "Jenin", "Jericho", "Jerusalem", "Khan Yunis",
        "Nablus", "North Gaza", "Qalqilya", "Rafah", "Ramallah and Al-Bireh", "Salfit", "Tubas", "Tulkarm"
      ],
      "Panama": [
        "Bocas del Toro", "Chiriquí", "Coclé", "Colón", "Darién", "Herrera", "Los Santos", "Panamá", "Panamá Oeste",
        "Veraguas", "Emberá", "Guna Yala", "Ngäbe-Buglé"
      ],
      "Papua New Guinea": [
        "Bougainville", "Central", "Chimbu", "East New Britain", "East Sepik", "Eastern Highlands",
        "Enga", "Gulf", "Madang", "Manus", "Milne Bay", "Morobe", "New Ireland", "Northern", "Sandaun",
        "Southern Highlands", "West New Britain", "Western", "Western Highlands"
      ],
      "Paraguay": [
        "Alto Paraguay", "Alto Paraná", "Amambay", "Asunción", "Boquerón", "Caaguazú", "Caazapá", "Canindeyú",
        "Central", "Concepción", "Cordillera", "Guairá", "Itapúa", "Misiones", "Ñeembucú", "Paraguarí", "Presidente Hayes", "San Pedro"
      ],
      "Peru": [
        "Amazonas", "Áncash", "Apurímac", "Arequipa", "Ayacucho", "Cajamarca", "Callao", "Cusco",
        "Huancavelica", "Huánuco", "Ica", "Junín", "La Libertad", "Lambayeque", "Lima", "Loreto",
        "Madre de Dios", "Moquegua", "Pasco", "Piura", "Puno", "San Martín", "Tacna", "Tumbes", "Ucayali"
      ],
      "Philippines": [
        "Ilocos Region", "Cagayan Valley", "Central Luzon", "CALABARZON", "MIMAROPA", "Bicol Region",
        "Western Visayas", "Central Visayas", "Eastern Visayas", "Zamboanga Peninsula", "Northern Mindanao",
        "Davao Region", "SOCCSKSARGEN", "Caraga", "Bangsamoro", "National Capital Region"
      ],
      "Poland": [
        "Greater Poland", "Kuyavian-Pomeranian", "Lesser Poland", "Łódź", "Lower Silesian", "Lublin",
        "Lubusz", "Masovian", "Opole", "Podlaskie", "Pomeranian", "Silesian", "Subcarpathian",
        "Świętokrzyskie", "Warmian-Masurian", "West Pomeranian"
      ],
      "Portugal": [
        "Aveiro", "Beja", "Braga", "Bragança", "Castelo Branco", "Coimbra", "Évora", "Faro", "Guarda",
        "Leiria", "Lisbon", "Portalegre", "Porto", "Santarém", "Setúbal", "Viana do Castelo", "Vila Real", "Viseu", "Madeira", "Azores"
      ],
      "Qatar": [
        "Ad Dawhah", "Al Daayen", "Al Khor", "Al Rayyan", "Al Wakrah", "Ash Shamal", "Umm Salal"
      ],
      "Romania": [
        "Alba", "Arad", "Argeș", "Bacău", "Bihor", "Bistrița-Năsăud", "Botoșani", "Brașov", "Brăila", "Bucharest",
        "Buzău", "Călărași", "Caraș-Severin", "Cluj", "Constanța", "Covasna", "Dâmbovița", "Dolj", "Galați",
        "Giurgiu", "Gorj", "Harghita", "Hunedoara", "Ialomița", "Iași", "Ilfov", "Maramureș", "Mehedinți",
        "Mureș", "Neamț", "Olt", "Prahova", "Sălaj", "Satu Mare", "Sibiu", "Suceava", "Teleorman", "Timiș",
        "Tulcea", "Vâlcea", "Vaslui", "Vrancea"
      ],
      "Russia": [
        "Moscow", "Saint Petersburg", "Novosibirsk", "Yekaterinburg", "Kazan", "Nizhny Novgorod", "Chelyabinsk",
        "Samara", "Omsk", "Rostov-on-Don", "Ufa", "Krasnoyarsk", "Perm", "Voronezh", "Volgograd"
      ],
      "Rwanda": [
        "Eastern Province", "Kigali City", "Northern Province", "Southern Province", "Western Province"
      ],
      "Saint Kitts and Nevis": [
        "Saint George Basseterre", "Saint Paul Capisterre", "Saint Thomas Lowland", "Saint James Windward"
      ],
      "Saint Lucia": [
        "Castries Quarter", "Vieux Fort Quarter", "Soufrière Quarter", "Micoud Quarter", "Gros Islet Quarter"
      ],
      "Saint Vincent and the Grenadines": [
        "Charlotte", "Saint Andrew", "Saint David", "Saint George", "Saint Patrick", "Grenadines"
      ],
      "Samoa": [
        "A'ana", "Aiga-i-le-Tai", "Atua", "Fa'asaleleaga", "Gaga'emauga", "Gaga'ifomauga", "Palauli",
        "Satupa'itea", "Tuamasaga", "Va'a-o-Fonoti", "Vaisigano"
      ],
      "San Marino": [
        "Acquaviva", "Borgo Maggiore", "Chiesanuova", "Domagnano", "Faetano", "Fiorentino",
        "Montegiardino", "San Marino City", "Serravalle"
      ],
      "Sao Tome and Principe": [
        "Água Grande", "Cantagalo", "Caué", "Lembá", "Lobata", "Mé-Zóchi", "Principe"
      ],
      "Saudi Arabia": [
        "Riyadh", "Makkah", "Medina", "Eastern Province", "Asir", "Tabuk", "Hail", "Northern Borders",
        "Jazan", "Najran", "Al Bahah", "Al Jawf", "Al-Qassim"
      ],
      "Senegal": [
        "Dakar", "Diourbel", "Fatick", "Kaolack", "Kaffrine", "Kédougou", "Kolda", "Louga", "Matam",
        "Saint-Louis", "Sédhiou", "Tambacounda", "Thiès", "Ziguinchor"
      ],
      "Serbia": [
        "Belgrade", "Nišava District", "Pčinja District", "Podunavlje District", "Šumadija District", "South Bačka District",
        "Zaječar District", "West Bačka District", "Zlatibor District", "Jablanica District"
      ],
      "Seychelles": [
        "Anse aux Pins", "Anse Boileau", "Anse Etoile", "Anse Royale", "Baie Lazare", "Baie Sainte Anne",
        "Beau Vallon", "Bel Air", "Bel Ombre", "Cascade", "Glacis", "Grand'Anse Mahé", "Grand'Anse Praslin",
        "La Digue", "Les Mamelles", "Mont Buxton", "Mont Fleuri", "Plaisance", "Pointe La Rue", "Port Glaud",
        "Saint Louis", "Takamaka"
      ],
      "Sierra Leone": [
        "Eastern Province", "Northern Province", "North West Province", "Southern Province", "Western Area"
      ],
      "Singapore": [
        "Central Region", "East Region", "North Region", "North-East Region", "West Region"
      ],
      "Slovakia": [
        "Bratislava Region", "Trnava Region", "Trenčín Region", "Nitra Region", "Žilina Region",
        "Banská Bystrica Region", "Prešov Region", "Košice Region"
      ],
      "Slovenia": [
        "Ajdovščina", "Celje", "Koper", "Kranj", "Ljubljana", "Maribor", "Novo Mesto", "Nova Gorica", "Ptuj", "Velenje"
      ],
      "Solomon Islands": [
        "Central", "Choiseul", "Guadalcanal", "Honiara", "Isabel", "Makira-Ulawa", "Malaita", "Rennell and Bellona",
        "Temotu", "Western"
      ],
      "Somalia": [
        "Awdal", "Bakool", "Banaadir", "Bari", "Bay", "Galguduud", "Gedo", "Hiiraan", "Lower Juba",
        "Lower Shabelle", "Middle Juba", "Middle Shabelle", "Mudug", "Nugal", "Sanaag", "Sool", "Togdheer", "Woqooyi Galbeed"
      ],
      "South Africa": [
        "Eastern Cape", "Free State", "Gauteng", "KwaZulu-Natal", "Limpopo", "Mpumalanga", "North West", "Northern Cape", "Western Cape"
      ],
      "South Korea": [
        "Seoul", "Busan", "Daegu", "Incheon", "Gwangju", "Daejeon", "Ulsan", "Sejong", "Gyeonggi Province",
        "Gangwon Province", "North Chungcheong", "South Chungcheong", "North Jeolla", "South Jeolla",
        "North Gyeongsang", "South Gyeongsang", "Jeju"
      ],
      "South Sudan": [
        "Central Equatoria", "Eastern Equatoria", "Jonglei", "Lakes", "Northern Bahr el Ghazal",
        "Unity", "Upper Nile", "Warrap", "Western Bahr el Ghazal", "Western Equatoria"
      ],
      "Spain": [
        "Andalusia", "Aragon", "Asturias", "Balearic Islands", "Basque Country", "Canary Islands",
        "Cantabria", "Castile and León", "Castilla-La Mancha", "Catalonia", "Extremadura", "Galicia",
        "La Rioja", "Madrid", "Murcia", "Navarre", "Valencia"
      ],
      "Sri Lanka": [
        "Central Province", "Eastern Province", "Northern Province", "North Central Province",
        "North Western Province", "Sabaragamuwa Province", "Southern Province", "Uva Province", "Western Province"
      ],
      "Sudan": [
        "Blue Nile", "Central Darfur", "East Darfur", "Gedaref", "Gezira", "Kassala", "Khartoum",
        "North Darfur", "North Kordofan", "Northern", "Red Sea", "River Nile", "Sennar", "South Darfur",
        "South Kordofan", "West Darfur", "West Kordofan", "White Nile"
      ],
      "Suriname": [
        "Brokopondo", "Commewijne", "Coronie", "Marowijne", "Nickerie", "Paramaribo", "Saramacca", "Sipaliwini", "Wanica"
      ],
      "Sweden": [
        "Blekinge", "Dalarna", "Gävleborg", "Gotland", "Halland", "Jämtland", "Jönköping", "Kalmar",
        "Kronoberg", "Norrbotten", "Örebro", "Östergötland", "Skåne", "Södermanland", "Stockholm", "Uppsala",
        "Värmland", "Västerbotten", "Västernorrland", "Västmanland", "Västra Götaland"
      ],
      "Switzerland": [
        "Aargau", "Appenzell Ausserrhoden", "Appenzell Innerrhoden", "Basel-Landschaft", "Basel-Stadt", "Bern",
        "Fribourg", "Geneva", "Glarus", "Graubünden", "Jura", "Lucerne", "Neuchâtel", "Nidwalden", "Obwalden",
        "Schaffhausen", "Schwyz", "Solothurn", "St. Gallen", "Thurgau", "Ticino", "Uri", "Valais", "Vaud", "Zug", "Zurich"
      ],
      "Syria": [
        "Aleppo", "Damascus", "Daraa", "Deir ez-Zor", "Hama", "Homs", "Idlib", "Latakia", "Quneitra", "Raqqa", "Rif Dimashq", "Suwayda", "Tartus"
      ],
      "Taiwan": [
        "Taipei", "New Taipei", "Taoyuan", "Taichung", "Tainan", "Kaohsiung", "Hsinchu", "Keelung", "Chiayi"
      ],
      "Tajikistan": [
        "Dushanbe", "Sughd", "Khatlon", "Gorno-Badakhshan", "Districts of Republican Subordination"
      ],
      "Tanzania": [
        "Arusha", "Dar es Salaam", "Dodoma", "Geita", "Iringa", "Kagera", "Katavi", "Kigoma", "Kilimanjaro",
        "Lindi", "Manyara", "Mara", "Mbeya", "Morogoro", "Mtwara", "Mwanza", "Njombe", "Pemba North",
        "Pemba South", "Pwani", "Rukwa", "Ruvuma", "Shinyanga", "Simiyu", "Singida", "Tabora", "Tanga",
        "Zanzibar Central/South", "Zanzibar North", "Zanzibar Urban/West"
      ],
      "Thailand": [
        "Bangkok", "Chiang Mai", "Chiang Rai", "Phuket", "Krabi", "Nakhon Ratchasima", "Chonburi", "Khon Kaen", "Songkhla", "Udon Thani"
      ],
      "Timor-Leste": [
        "Aileu", "Ainaro", "Baucau", "Bobonaro", "Cova Lima", "Dili", "Ermera", "Lautem", "Liquiçá", "Manatuto", "Manufahi", "Oecusse", "Viqueque"
      ],
      "Togo": [
        "Centrale", "Kara", "Maritime", "Plateaux", "Savanes"
      ],
      "Tonga": [
        "Eua", "Ha'apai", "Niuas", "Tongatapu", "Vava'u"
      ],
      "Trinidad and Tobago": [
        "Arima", "Chaguanas", "Point Fortin", "Port of Spain", "San Fernando", "Diego Martin", "Mayaro-Rio Claro", "Penal-Debe", "Princes Town", "Sangre Grande", "Siparia", "Tunapuna-Piarco", "Tobago"
      ],
      "Tunisia": [
        "Tunis", "Ariana", "Ben Arous", "Manouba", "Nabeul", "Zaghouan", "Bizerte", "Beja", "Jendouba", "Kef",
        "Siliana", "Kairouan", "Kasserine", "Sidi Bouzid", "Sousse", "Monastir", "Mahdia", "Sfax", "Kebili",
        "Gabes", "Medenine", "Tataouine", "Tozeur", "Gafsa"
      ],
      "Turkey": [
        "Adana", "Ankara", "Antalya", "Aydın", "Bursa", "Diyarbakır", "Gaziantep", "Istanbul", "Izmir", "Kayseri", "Kocaeli", "Konya", "Mersin", "Samsun", "Şanlıurfa"
      ],
      "Turkmenistan": [
        "Ahal", "Ashgabat", "Balkan", "Dashoguz", "Lebap", "Mary"
      ],
      "Tuvalu": [
        "Funafuti", "Nanumea", "Nanumaga", "Niutao", "Nui", "Nukufetau", "Nukulaelae", "Vaitupu"
      ],
      "Uganda": [
        "Central Region", "Eastern Region", "Northern Region", "Western Region"
      ],
      "Ukraine": [
        "Cherkasy", "Chernihiv", "Chernivtsi", "Crimea", "Dnipropetrovsk", "Donetsk", "Ivano-Frankivsk", "Kharkiv", "Kherson", "Khmelnytskyi", "Kyiv", "Kirovohrad", "Luhansk", "Lviv", "Mykolaiv", "Odessa", "Poltava", "Rivne", "Sumy", "Ternopil", "Vinnytsia", "Volyn", "Zakarpattia", "Zaporizhzhia", "Zhytomyr"
      ],
      "United Arab Emirates": [
        "Abu Dhabi", "Dubai", "Sharjah", "Ajman", "Fujairah", "Ras Al Khaimah", "Umm Al Quwain"
      ],
      "United Kingdom": [
        "England", "Scotland", "Wales", "Northern Ireland"
      ],
      "United States": [
        "Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida",
        "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine",
        "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska",
        "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota",
        "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota",
        "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"
      ],
      "Uruguay": [
        "Artigas", "Canelones", "Cerro Largo", "Colonia", "Durazno", "Flores", "Florida", "Lavalleja", "Maldonado",
        "Montevideo", "Paysandú", "Río Negro", "Rivera", "Rocha", "Salto", "San José", "Soriano", "Tacuarembó", "Treinta y Tres"
      ],
      "Uzbekistan": [
        "Andijan", "Bukhara", "Fergana", "Jizzakh", "Karakalpakstan", "Kashkadarya", "Khorezm", "Namangan",
        "Navoiy", "Samarkand", "Sirdaryo", "Surxondaryo", "Tashkent", "Tashkent City"
      ],
      "Vanuatu": [
        "Malampa", "Penama", "Sanma", "Shefa", "Tafea", "Torba"
      ],
      "Vatican City": [
        "Vatican City"
      ],
      "Venezuela": [
        "Amazonas", "Anzoátegui", "Apure", "Aragua", "Barinas", "Bolívar", "Carabobo", "Cojedes", "Delta Amacuro",
        "Distrito Capital", "Falcón", "Guárico", "Lara", "Mérida", "Miranda", "Monagas", "Nueva Esparta", "Portuguesa",
        "Sucre", "Táchira", "Trujillo", "Vargas", "Yaracuy", "Zulia"
      ],
      "Vietnam": [
        "An Giang", "Bà Rịa–Vũng Tàu", "Bắc Giang", "Bắc Kạn", "Bạc Liêu", "Bắc Ninh", "Bến Tre", "Bình Định", "Bình Dương",
        "Bình Phước", "Bình Thuận", "Cà Mau", "Cần Thơ", "Cao Bằng", "Đà Nẵng", "Đắk Lắk", "Đắk Nông", "Điện Biên",
        "Đồng Nai", "Đồng Tháp", "Gia Lai", "Hà Giang", "Hà Nam", "Hà Nội", "Hà Tĩnh", "Hải Dương", "Hải Phòng",
        "Hậu Giang", "Hòa Bình", "Hưng Yên", "Khánh Hòa", "Kiên Giang", "Kon Tum", "Lai Châu", "Lâm Đồng",
        "Lạng Sơn", "Lào Cai", "Long An", "Nam Định", "Nghệ An", "Ninh Bình", "Ninh Thuận", "Phú Thọ", "Phú Yên",
        "Quảng Bình", "Quảng Nam", "Quảng Ngãi", "Quảng Ninh", "Quảng Trị", "Sóc Trăng", "Sơn La", "Tây Ninh",
        "Thái Bình", "Thái Nguyên", "Thanh Hóa", "Thừa Thiên–Huế", "Tiền Giang", "Trà Vinh", "Tuyên Quang",
        "Vĩnh Long", "Vĩnh Phúc", "Yên Bái"
      ],
      "Yemen": [
        "Aden", "Abyan", "Al Bayda", "Al Hudaydah", "Al Jawf", "Al Mahrah", "Al Mahwit", "Amran", "Dhamar",
        "Hadhramaut", "Hajjah", "Ibb", "Lahij", "Marib", "Raymah", "Saada", "Sana'a", "Shabwah", "Socotra", "Taiz"
      ],
      "Zambia": [
        "Central", "Copperbelt", "Eastern", "Luapula", "Lusaka", "Muchinga", "Northern", "North-Western", "Southern", "Western"
      ],
      "Zimbabwe": [
        "Bulawayo", "Harare", "Manicaland", "Mashonaland Central", "Mashonaland East", "Mashonaland West",
        "Masvingo", "Matabeleland North", "Matabeleland South", "Midlands"
      ]
};
        const countrySelect = document.getElementById("country-select");
        Object.keys(countryStateData).forEach((country) => {
            const option = document.createElement("option");
            option.value = country;
            option.textContent = country;
            countrySelect.appendChild(option);
        });

        // Load states when a country is selected
        countrySelect.addEventListener("change", function () {
            const selectedCountry = this.value;
            const stateSelect = document.getElementById("state-select");

            stateSelect.innerHTML = '<option value="">Select State / Province *</option>'; // Reset

            if (countryStateData[selectedCountry]) {
                countryStateData[selectedCountry].forEach((state) => {
                    const option = document.createElement("option");
                    option.value = state;
                    option.textContent = state;
                    stateSelect.appendChild(option);
                });
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            const saveBtn = document.getElementById("save-address-btn");
            const confirmBtn = document.getElementById("confirm-address-btn");
            const postalCodeEl = document.querySelector("#postal-code");
            const unitNumberEl = document.querySelector("input[name='unit_number']");
            const postalErrorEl = document.createElement("p");
            const unitErrorEl = document.createElement("p");

            postalErrorEl.style.color = "red";
            postalErrorEl.style.fontSize = "12px";
            postalErrorEl.style.marginTop = "5px";
            postalErrorEl.style.display = "none";
            postalCodeEl.insertAdjacentElement("afterend", postalErrorEl);

            unitErrorEl.style.color = "red";
            unitErrorEl.style.fontSize = "12px";
            unitErrorEl.style.marginTop = "5px";
            unitErrorEl.style.display = "none";
            unitNumberEl.insertAdjacentElement("afterend", unitErrorEl);

            function markInvalid(field) {
                if (field) {
                    const fieldValue = field.value.trim();

                    if (field.id === "postal-code") {
                        const postalCodeRegex = /^[a-zA-Z0-9]{6}$/;
                        if (fieldValue === "") {
                            field.style.border = "1px solid red";
                            return false;
                        }
                        if (!postalCodeRegex.test(fieldValue)) {
                            field.style.border = "1px solid red";
                            postalErrorEl.textContent = "Allow 6 alphanumeric characters.";
                            postalErrorEl.style.display = "block";
                            return false;
                        } else {
                            field.style.border = "";
                            postalErrorEl.style.display = "none";
                            return true;
                        }
                    }

                    if (field.name === "unit_number") {
                        const unitRegex = /^\d{5}$/; // Only 5-digit numbers
                        if (fieldValue === "") {
                            field.style.border = "1px solid red";
                            return false;
                        }
                        if (!unitRegex.test(fieldValue)) {
                            field.style.border = "1px solid red";
                            unitErrorEl.textContent = "Allow 5 digits.";
                            unitErrorEl.style.display = "block";
                            return false;
                        } else {
                            field.style.border = "";
                            unitErrorEl.style.display = "none";
                            return true;
                        }
                    }

                    if (fieldValue === "") {
                        field.style.border = "1px solid red";
                        return false;
                    }
                    return true;
                }
                return false;
            }

            // Remove border and error on selecting any gender
            document.querySelectorAll('input[name="sex"]').forEach((radio) => {
                radio.addEventListener("change", function () {
                    const genderBox = document.getElementById("genderBox"); // your container div
                    genderBox.style.border = "";
                    
                    // Also remove error message span if exists
                    const errorMsg = genderBox.querySelector(".field-error");
                    if (errorMsg) errorMsg.remove();
                });
            });


            function clearBorderOnFocus(field) {
                if (field) {
                    field.addEventListener("focus", function () {
                        field.style.border = "";
                        if (field.id === "postal-code") {
                            postalErrorEl.style.display = "none";
                        }
                        if (field.name === "unit_number") {
                            unitErrorEl.style.display = "none";
                        }
                    });
                    field.addEventListener("input", function () {
                        field.style.border = "";
                        if (field.id === "postal-code") {
                            postalErrorEl.style.display = "none";
                        }
                        if (field.name === "unit_number") {
                            unitErrorEl.style.display = "none";
                        }
                    });
                }
            }

            const fieldSelectors = [
                "#address-type",
                "#country-select",
                "input[name='street_name']",
                "input[name='unit_number']",
                "input[name='land_mark']",
                "input[name='town_area']",
                "input[name='google_plus_code']",
                "input[name='city']",
                "#state-select",
                "#postal-code",
            ];

            fieldSelectors.forEach((selector) => {
                const field = document.querySelector(selector);
                clearBorderOnFocus(field);
            });

            function handleAddressSaveOrConfirm(e) {
                const addressTypeEl = document.querySelector("#address-type");
                const countryEl = document.querySelector("#country-select");
                const streetNameEl = document.querySelector("input[name='street_name']");
                const unitNumberEl = document.querySelector("input[name='unit_number']");
                const landMarkEl = document.querySelector("input[name='land_mark']");
                const townAreaEl = document.querySelector("input[name='town_area']");
                const cityEl = document.querySelector("input[name='city']");
                const stateEl = document.querySelector("#state-select");
                const plusCodeEl = document.querySelector("#google-map-field");
                const isDefault = document.querySelector("input[name='set_default']")?.checked;

                const isValid =
                    markInvalid(addressTypeEl) &
                    markInvalid(countryEl) &
                    markInvalid(streetNameEl) &
                    markInvalid(unitNumberEl) &
                    markInvalid(landMarkEl) &
                    markInvalid(townAreaEl) &
                    markInvalid(plusCodeEl) &
                    markInvalid(cityEl) &
                    markInvalid(stateEl) &
                    markInvalid(postalCodeEl);

                if (!isValid) return false;

                const addressParts_2 = [
                    `streetName: ${streetNameEl?.value || ""}`,
                    `unitNumber: ${unitNumberEl?.value || ""}`,
                    `landMark: ${landMarkEl?.value || ""}`,
                    `townArea: ${townAreaEl?.value || ""}`,
                    `city: ${cityEl?.value || ""}`,
                    `state: ${stateEl?.value || ""}`,
                    `country: ${countryEl?.value || ""}`,
                    `postalCode: ${postalCodeEl?.value || ""}`,
                    `plusCode: ${plusCodeEl?.value || ""}`,
                    `addressType: ${addressTypeEl?.value || ""}`,
                    `isDefault: ${isDefault ? "Yes" : "No"}`,
                ];

                // Final string output
                const finalAddressString = addressParts_2.join(", ");

                const addressParts = [
                    streetNameEl?.value,
                    unitNumberEl?.value,
                    landMarkEl?.value,
                    // townAreaEl?.value,
                    // cityEl?.value,
                    stateEl?.value,
                    countryEl?.value ? countryEl.value + " -" : "",
                ].filter(Boolean);

                let addressText = addressParts.join(", ");
                if (postalCodeEl?.value) {
                    addressText += addressText ? " " + postalCodeEl.value : postalCodeEl.value;
                }

                const plusCode = plusCodeEl?.value || "";

                const newAddressHTML = `
                    <div class="default-address">
                        <div class="default-address-badge">
                            <i class="fa-solid fa-location-dot"></i>
                            <h6>Default</h6>
                        </div>
                        <div class="address-text-col-popup">
                            <div class="address-default-text">
                                <p>${addressText}</p>
                            </div>
                            <div class="address-default-btn-group">
                                <div class="icon-group-listing">
                                    <span><i class="fa-solid fa-angle-down accordion-toggle" data-bs-toggle="collapse" data-bs-target="#demo1"></i></span>
                                    <span><i class="fas fa-pen-nib"></i></span>
                                    <span><i class="fa fa-trash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        ${
                            plusCode
                                ? `
                        <div class="default-copy-address">
                            <img src="{{ asset('public/assets/latest/images/icon-c.png') }}" class="img-fluid" />
                            <h5>${plusCode}</h5>
                            <img src="{{ asset('public/assets/latest/images/icon-c1.png') }}" class="img-fluid" />
                        </div>`
                                : ""
                        }
                    </div>`;

                document.getElementById("full_address").value = finalAddressString;
                document.getElementById("show_address_input").value = addressText;
                document.getElementById("show_address").innerText = addressText;
                document.getElementById("manual_address_input").style.display = "none";
                document.getElementById("manual_address_input").removeAttribute("required");
                const addressBlock = document.getElementsByClassName("consultancy-form-address-feed-form")[0];
                addressBlock.classList.remove("d-none");

                const addressCol = document.querySelector(".address-popup-right-col");
                addressCol.innerHTML = `<h4>Address</h4>` + newAddressHTML;
                return true;
            }

            if (saveBtn) saveBtn.addEventListener("click", handleAddressSaveOrConfirm);
            if (confirmBtn) {
                confirmBtn.addEventListener("click", function () {
                    const isSuccess = handleAddressSaveOrConfirm();
                    if (isSuccess === true) {
                        var modalEl = document.getElementById("staticBackdrop");
                        var modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
                        modalInstance.hide();
                    }
                });
            }

            const formFields = document.querySelectorAll("#userManagmentForm input, #userManagmentForm select");

            formFields.forEach((field) => {
                field.addEventListener("focus", function () {
                    field.style.borderColor = "";

                    // For mobile_code fields
                    if (field.id === "mobile_code_client" || field.id === "mobile_code_2_client") {
                        const mobileParentDiv = field.closest(".telephone-form-col");
                        mobileParentDiv.querySelectorAll(".mobile-error").forEach((el) => el.remove());
                    }

                    // For consultancy_name field
                    if (field.id === "serving_client") {
                        const nextEl = field.nextElementSibling;
                        if (nextEl && nextEl.classList.contains("error-message")) {
                            nextEl.remove();
                        }
                    }
                });

                field.addEventListener("input", function () {
                    field.style.borderColor = "";

                    // For mobile_code fields
                    if (field.id === "mobile_code_client" || field.id === "mobile_code_2_client") {
                        const mobileParentDiv = field.closest(".telephone-form-col");
                        mobileParentDiv.querySelectorAll(".mobile-error").forEach((el) => el.remove());
                    }

                    // For consultancy_name field
                    if (field.id === "serving_client") {
                        const nextEl = field.nextElementSibling;
                        if (nextEl && nextEl.classList.contains("error-message")) {
                            nextEl.remove();
                        }
                    }
                });
            });
        });



        $(document).on("click", ".edit-user", function () {
            $('input[name="edit_id"]').val($(this).data("id"));
            $('input[name="emp_name"]').val($(this).data("emp_name"));
            $('input[name="emp_code"]').val($(this).data("emp_code"));
            $('input[name="full_address"]').val($(this).data("full_address"));
            $('input[name="reset_password"]').prop('checked', $(this).data('reset_password') == 1);
            const mobileNumber = $(this).data("mobile_number");

            $("#mobile_number").val(mobileNumber); 
            setIntlTelInput("#mobile_number", $(this).data("mobile_number_code"));

            const sex = $(this).data("sex");   
            const dob = $(this).data("dob");

            // --- Set SEX ---
            if (sex.startsWith("Other:")) {
                const customValue = sex.split("Other:")[1];
                $("#sex_others").prop("checked", true);         // Check "Others"
                $("#otherGenderInput").show();                  // Show textbox
                $("#custom_sex").val(customValue);              // Fill custom gender
            } else {
                $(`input[name="sex"][value="${sex}"]`).prop("checked", true); // Check Male/Female
                $("#otherGenderInput").hide();                  // Hide custom input if not Others
                $("#custom_sex").val("");                       // Clear value
            }

            $("#dob").val(dob);  

            const joiningDate = $(this).data("joining_date");
            const resignationDate = $(this).data("resignation_date");

            // Delay to ensure date input is ready (especially if modal just opened)
            setTimeout(() => {
                // Set joining date and manually update table
                $("#startDate").val(joiningDate);
                updateStartDateTable(joiningDate); // custom function below

                // Set resignation date and manually update table
                $("#endDate").val(resignationDate);
                updateEndDateTable(resignationDate);
            }, 100);

            let fullAddressStr = $(this).data("full_address"); // get the string
            let addressObj = {};

            fullAddressStr.split(",").forEach(function (item) {
                let parts = item.split(":");
                if (parts.length === 2) {
                    let key = $.trim(parts[0]);
                    let value = $.trim(parts[1]);
                    addressObj[key] = value;
                }
            });

            $('select[name="address_type"]').val(addressObj.addressType);
            $('select[name="country"]').val(addressObj.country);
            $('input[name="postal_code"]').val(addressObj.postalCode);
            $('input[name="street_name"]').val(addressObj.streetName);
            $('input[name="unit_number"]').val(addressObj.unitNumber);
            $('input[name="land_mark"]').val(addressObj.landMark);
            $('input[name="town_area"]').val(addressObj.townArea);
            $('input[name="city"]').val(addressObj.city);

            // Step 1: Set country dropdown value
            $('select[name="country"]').val(addressObj.country);

            // Step 2: Load corresponding states
            let states = countryStateData[addressObj.country] || [];

            // Step 3: Clear existing state options
            let $stateSelect = $('select[name="state"]');
            $stateSelect.empty();

            // Step 4: Add default option
            $stateSelect.append('<option value="" disabled selected>Select State / Province *</option>');

            // Step 5: Populate state options
            states.forEach(function (state) {
                let selected = state === addressObj.state ? "selected" : "";
                $stateSelect.append('<option value="' + state + '" ' + selected + ">" + state + "</option>");
            });

            // Step 6: If the state is NOT in the countryStateData list, add and select it
            if (!states.includes(addressObj.state)) {
                $stateSelect.append('<option value="' + addressObj.state + '" selected>' + addressObj.state + "</option>");
            }

            $('input[name="google_plus_code"]').val(addressObj.plusCode);

            // Set default checkbox
            if (addressObj.isDefault && addressObj.isDefault.toLowerCase() === "yes") {
                $('input[name="set_default"]').prop("checked", true);
            } else {
                $('input[name="set_default"]').prop("checked", false);
            }


            $('input[name="show_address_input"]').val($(this).data("show_address_input"));

            let receiptPath = $(this).data("receipt_file");

            if (receiptPath) {
                const pathParts = window.location.pathname.split('/');
                const basePath = pathParts.length > 1 ? '/' + pathParts[1] : '';
                const baseUrl = window.location.origin + basePath;

                let imageUrl = baseUrl + '/' + receiptPath;

                uploadedImgSrc = imageUrl;
                previewBox.innerHTML = '<p style="cursor: pointer; color: green;">Click here to preview</p>'; // Show text only
                previewHint.style.display = 'none'; // Hide any additional hints
            } else {
                uploadedImgSrc = "";
                previewBox.innerHTML = ""; // No text if no image
                previewHint.style.display = 'none';
            }

            $('input[name="login_email"]').val($(this).data("login_email"));
            $('input[name="email"]').val($(this).data("email"));
            $('input[name="dob"]').val($(this).data("dob"));
        
            $('select[name="designation"]').val($(this).data("designation"));
            $('select[name="status"]').val($(this).data("status"));

            $(".table-hj-list-section").hide();
            $(".filter-section-consultancy").hide();
            $(".add-user-form-section").show(); // use toggle() if you don’t want slide effect

            document.querySelector(".search-section").setAttribute("style", "display: none !important;");
            const addressBlock = document.getElementsByClassName("consultancy-form-address-feed-form")[0];
            addressBlock.classList.remove("d-none");
            document.getElementById("manual_address_input").style.display = "none";
            document.getElementById("manual_address_input").removeAttribute("required");
            var addressText = $('input[name="show_address_input"]').val();
            document.getElementById("show_address").innerText = addressText;
            $("#consultancy_form_heading").text("Edit Consultancy");

            const streetNameEl = document.querySelector('input[name="street_name"]');
            const unitNumberEl = document.querySelector('input[name="unit_number"]');
            const landMarkEl = document.querySelector('input[name="land_mark"]');
            const stateEl = document.querySelector('select[name="state"]');
            const countryEl = document.querySelector('select[name="country"]');
            const postalCodeEl = document.querySelector('input[name="postal_code"]');
            const plusCodeEl = document.querySelector('input[name="google_plus_code"]');

            const addressParts = [streetNameEl?.value, unitNumberEl?.value, landMarkEl?.value, stateEl?.value, countryEl?.value ? countryEl.value + " -" : ""].filter(Boolean);

            let addressText_edit = addressParts.join(", ");
            if (postalCodeEl?.value) {
                addressText_edit += addressText_edit ? " " + postalCodeEl.value : postalCodeEl.value;
            }

            const plusCode = plusCodeEl?.value || "";

            $('input[name="address_text"]').val(addressText_edit);
            $('input[name="google_plus_code"]').val(plusCode);

            const newAddressHTML = `
                <div class="default-address">
                    <div class="default-address-badge">
                        <i class="fa-solid fa-location-dot"></i>
                        <h6>Default</h6>
                    </div>
                    <div class="address-text-col-popup">
                        <div class="address-default-text">
                            <p>${addressText_edit}</p>
                        </div>
                        <div class="address-default-btn-group">
                            <div class="icon-group-listing">
                                <span><i class="fa-solid fa-angle-down accordion-toggle" data-bs-toggle="collapse" data-bs-target="#demo1"></i></span>
                                <span><i class="fas fa-pen-nib"></i></span>
                                <span><i class="fa fa-trash" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    ${
                        plusCode
                            ? `
                    <div class="default-copy-address">
                        <img src="{{ asset('public/assets/latest/images/icon-c.png') }}" class="img-fluid" />
                        <h5>${plusCode}</h5>
                        <img src="{{ asset('public/assets/latest/images/icon-c1.png') }}" class="img-fluid" />
                    </div>`
                            : ""
                    }
                </div>`;

            const addressCol = document.querySelector(".address-popup-right-col");
            addressCol.innerHTML = `<h4>Address</h4>` + newAddressHTML;
        });

    </script>
</div>
