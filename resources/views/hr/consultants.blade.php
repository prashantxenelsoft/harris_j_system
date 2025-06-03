<div class="add-consultants-wrapper">
    <div class="pt-4">
        <div class="row">
            <div class="col-lg-4 col-xxl-3">
                <div class="add-consultant-clients-wrapper">
                    <h4>Clients</h4>

                    <div class="clients-tabs-consultants pt-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                           @foreach ($clients as $index => $client)
                              @php
                                  $isActive = $index === 0 ? 'active' : '';
                                  $tabId = 'client-' . $client->id;
                              @endphp

                              <button class="nav-link {{ $isActive }}"
                                  id="v-pills-{{ $tabId }}-tab"
                                  data-bs-toggle="pill"
                                  data-bs-target="#v-pills-{{ $tabId }}"
                                  type="button"
                                  role="tab"
                                  aria-controls="v-pills-{{ $tabId }}"
                                  aria-selected="{{ $isActive ? 'true' : 'false' }}">
                                  
                                  <div class="clients-tab-switch">
                                      <div class="clients-img-name">
                                          <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="{{ $client->serving_client }}" />
                                          <h6 class="{{ $isActive ? 'fw-bold' : '' }}">{{ $client->serving_client }}</h6>
                                      </div>

                                      <div class="clients-numbers-tab-switch">
                                          <span>
                                              (<em>10</em>,<em>23</em>,<em>12</em>) <b>/ 45</b>
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
                                            <option value="" selected disabled>Designation</option>
                                            <option value="Designation 1">Designation 1</option>
                                            <option value="Designation 2">Designation 2</option>
                                            <option value="Designation 3">Designation 3</option>
                                        </select>
                                        <select>
                                          <option value="" selected disabled>Select User Status</option>
                                          <option value="Active">Active</option>
                                          <option value="Inactive">Inactive</option> 
                                          <option value="Notice Period">Notice Period</option>
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
        $(document).ready(function () {
            $(".add-consultants-btn").on("click", function (e) {
                e.preventDefault();
                $(".add-user-form-section").removeClass("d-none"); // ✅ Show the form
                $(".pt-4").addClass("d-none"); // ✅ Optionally hide wrapper (if needed)
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
                                    <input type="text" name="emp_name" placeholder="Employee Name *" required />
                                </div>
                                <input type="hidden" name="edit_id" value="" />

                                <div class="consultancy-form-col">
                                    <input type="text" name="emp_code" placeholder="Employee Code" required />
                                </div>

                                <div class="consultancy-form-col gender_selection_box" id="genderBox">
                                    <span>Sex :</span>
                                    <span>
                                        <input type="radio" name="sex" value="Male" id="sex_male" required />
                                        <label for="sex_male">Male</label>
                                        <i class="fa-solid fa-mars"></i>
                                    </span>
                                    <span>
                                        <input type="radio" name="sex" value="Female" id="sex_female" />
                                        <label for="sex_female">Female</label>
                                        <i class="fa-solid fa-venus"></i>
                                    </span>
                                    <span>
                                        <input type="radio" name="sex" value="Others" id="sex_others" />
                                        <label for="sex_others">Others</label>
                                    </span>
                                </div>

                                <!-- Custom "Others" Input (Initially Hidden) -->
                                <div class="consultancy-form-col" id="otherGenderInput" style="display: none;">
                                    <input type="text" id="custom_sex" placeholder="Specify gender" />
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
                                    <input type="date" name="dob" required />
                                    <span class="ms-1 ms-xxl-3">Age :-</span>
                                </div>

                                <div class="consultancy-form-col telephone-form-col">
                                    <input type="tel" id="mobile_number" name="mobile_number" placeholder="Mobile Number" required />
                                </div>

                                <div class="consultancy-form-col">
                                    <input type="email" name="email" placeholder="Email Address *" required />
                                </div>

                                <div class="consultancy-form-col">
                                    <div class="upload_certificate">
                                        <div class="file_input">
                                            <i class="fa-solid fa-arrow-up-from-bracket me-3"></i>
                                            <p>Upload Profile Picture</p>
                                        </div>
                                        <input type="file" name="profile_image" id="uploadFile" />
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
                                    <img id="imageModalContent" />
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
                                        background-color: rgba(0, 0, 0, 0.8);
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
                                    const previewBox = document.getElementById("previewBox");
                                    const previewHint = document.getElementById("previewHint");

                                    document.getElementById("uploadFile").addEventListener("change", function (event) {
                                        const file = event.target.files[0];

                                        if (file && file.type.startsWith("image/")) {
                                            const reader = new FileReader();
                                            reader.onload = function (e) {
                                                uploadedImgSrc = e.target.result;

                                                // Highlight preview box
                                                previewBox.classList.add("active");
                                                previewHint.style.display = "block";
                                            };
                                            reader.readAsDataURL(file);
                                        } else {
                                            alert("Please upload a valid image file.");
                                        }
                                    });

                                    // Show modal on preview click
                                    previewBox.addEventListener("click", function () {
                                        if (uploadedImgSrc !== "") {
                                            document.getElementById("imageModal").style.display = "block";
                                            document.getElementById("imageModalContent").src = uploadedImgSrc;
                                        } else {
                                            alert("Please upload an image first.");
                                        }
                                    });

                                    // Close modal on click
                                    document.getElementById("closeModal").addEventListener("click", function () {
                                        document.getElementById("imageModal").style.display = "none";
                                    });

                                    // Click outside to close
                                    window.addEventListener("click", function (event) {
                                        const modal = document.getElementById("imageModal");
                                        if (event.target === modal) {
                                            modal.style.display = "none";
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
                                    <input type="date" id="startDate" name="joining_date" placeholder="Start Date / Joining Date" style="margin-left: 0px;" />
                                    <table id="dateTable" border="1">
                                        <thead>
                                            <tr>
                                                <th>Start Date / Joining Date</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>

                                <!-- End Date -->
                                <div class="consultancy-form-col full_width end-date-col" onclick="document.getElementById('endDate').showPicker()">
                                    <input type="date" id="endDate" name="resignation_date" placeholder="Select Expire / Last working date" style="margin-left: 0px;" />
                                    <table id="enddateTable" border="1">
                                        <thead>
                                            <tr>
                                                <th>Select Expire / Last working date</th>
                                            </tr>
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
                                        <option value="Inactive">Inactive</option> 
                                        <option value="Notice Period">Notice Period</option>
                                        <!-- <option value="Block">Block</option>
                                        <option value="Deleted">Deleted</option> -->
                                    </select>
                                </div>
                                <div class="consultancy-form-col">
                                    <select name="select_client" required>
                                        <option value="" selected disabled>Select Client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->serving_client }}</option>
                                        @endforeach
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
                                        <option value="Designation 1">Designation 1</option>
                                        <option value="Designation 2">Designation 2</option>
                                        <option value="Designation 3">Designation 3</option>
                                        <!-- <option value="Consultant">Consultant</option> -->
                                    </select>
                                </div>
                            </div>

                            <h3>User Credentials</h3>
                            <div class="form-row-consultancy">
                                <div class="consultancy-form-col">
                                    <input type="email" name="login_email" placeholder="User Id / Email *" required />
                                </div>

                                <div class="consultancy-form-col">
                                    <div class="reset-password">
                                        <input type="checkbox" name="reset_password" value="1" />
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" />

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

                    const matchesSearch = name.includes(searchValue) || userId.includes(searchValue) || designation.includes(searchValue);

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
            formData.append("reset_password", $('input[name="reset_password"]').is(":checked") ? "1" : "0");

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
            let countryISO = Object.keys(countryCode).find((key) => countryCode[key] === dialCode) || "in";
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
            $('input[name="reset_password"]').prop("checked", $(this).data("reset_password") == 1);
            const mobileNumber = $(this).data("mobile_number");

            $("#mobile_number").val(mobileNumber);
            setIntlTelInput("#mobile_number", $(this).data("mobile_number_code"));

            const sex = $(this).data("sex");
            const dob = $(this).data("dob");

            // --- Set SEX ---
            if (sex.startsWith("Other:")) {
                const customValue = sex.split("Other:")[1];
                $("#sex_others").prop("checked", true); // Check "Others"
                $("#otherGenderInput").show(); // Show textbox
                $("#custom_sex").val(customValue); // Fill custom gender
            } else {
                $(`input[name="sex"][value="${sex}"]`).prop("checked", true); // Check Male/Female
                $("#otherGenderInput").hide(); // Hide custom input if not Others
                $("#custom_sex").val(""); // Clear value
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

            let receiptPath = $(this).data("profile_image");

            if (receiptPath) {
                const pathParts = window.location.pathname.split("/");
                const basePath = pathParts.length > 1 ? "/" + pathParts[1] : "";
                const baseUrl = window.location.origin + basePath;

                let imageUrl = baseUrl + "/" + receiptPath;

                uploadedImgSrc = imageUrl;
                previewBox.innerHTML = '<p style="cursor: pointer; color: green;">Click here to preview</p>'; // Show text only
                previewHint.style.display = "none"; // Hide any additional hints
            } else {
                uploadedImgSrc = "";
                previewBox.innerHTML = ""; // No text if no image
                previewHint.style.display = "none";
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
