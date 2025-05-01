<div class="row filter-client-section-consultancy">
    <div class="col-lg-6 d-flex search-section">
        <div class="search-bar-bom">
            <input type="text" id="searchInput" placeholder="Search ..." />
        </div>

        <div class="active-status-select-bom">
            <select id="statusFilter">
                <option value="">All</option>
                <option value="active">Active</option>
                <option value="Disabled">Disabled</option>
                <!-- <option value="Block">Block</option>
                <option value="Deleted">Deleted</option> -->
            </select>
        </div>

        <!-- <div class="active-status-select-bom consultancy-designation-filter">
            <select id="statusFilter">
                <option value="">Client Type</option>
                <option value="active">Client Type 1</option>
                <option value="inactive">Client Type 2</option>
            </select>
        </div> -->
    </div>

    <div class="col-lg-6">
        <div class="bom-btn-group">
            <div class="add-consultancy-btn">
                <a href="#" class="show-add-client-form">
                    <img src="{{ asset('public/assets/latest/images/circle-add-button.png ') }}" class="img-fluid" />
                    Add Client
                </a>
            </div>
        </div>
    </div>
</div>

<div class="table-bom-list-section client-list-consultancy-flow mt-5">
    <div class="container p-0">
        <div class="col-md-12">
            <table class="table table-condensed table-striped">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Serving Client</th>
                        <th>Country</th>
                        <th>Primary Contact Person</th>
                        <th>Primary Email</th>
                        <th>Primary Contact No</th>
                        <th>Consultants</th>
                        <th>Agreement Expiry & Status Datails</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                </tbody>

                <tbody>
                    @foreach ($client as $index => $item)
                        @php
                            // Extract country from full_address using regex
                            preg_match('/country:\s*([^,]+)/', $item['full_address'], $matches);
                            $country = $matches[1] ?? '-';
                        @endphp
                        <tr>
                            <td>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $item['serving_client'] ?? '-' }}</td>
                            <td>{{ $country }}</td>
                            <td>{{ $item['primary_contact'] ?? '-' }}</td>
                            <td>{{ $item['primary_email'] ?? '-' }}</td>
                            <td>{{ $item['primary_mobile_country_code'] ?? '' }} {{ $item['primary_mobile'] ?? '-' }}</td>
                            <td>
                                <span class="active-badge">
                                    {{ $item['client_status'] ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <p>
                                    <span>
                                        {{ \Carbon\Carbon::parse($item['created_at'])->format('d / m / Y') }}
                                    </span>
                                    <span>
                                        {{ \Carbon\Carbon::parse($item['created_at'])->format('h : i : s A') }}
                                    </span>
                                </p>
                            </td>
                            <td>
                                <div class="icon-group-listing">
                                    <span>
                                        <i class="fa-solid fa-angle-down accordion-toggle" data-bs-toggle="collapse" data-bs-target="#demo{{ $item['id'] }}"></i>
                                    </span>
                                    <span
                                        class="edit-client"
                                        data-id="{{ $item['id'] }}"
                                        data-serving_client="{{ $item['serving_client'] }}"
                                        data-client_id="{{ $item['client_id'] }}"
                                        data-primary_contact="{{ $item['primary_contact'] }}"
                                        data-primary_mobile="{{ $item['primary_mobile'] }}"
                                        data-primary_email="{{ $item['primary_email'] }}"
                                        data-primary_mobile_country_code="{{ $item['primary_mobile_country_code'] }}"
                                        data-secondary_contact="{{ $item['secondary_contact'] }}"
                                        data-secondary_mobile="{{ $item['secondary_mobile'] }}"
                                        data-secondary_email="{{ $item['secondary_email'] }}"
                                        data-secondary_mobile_country_code="{{ $item['secondary_mobile_country_code'] }}"
                                        data-full_address="{{ $item['full_address'] }}"
                                        data-show_address_input="{{ $item['show_address_input'] }}"
                                        data-client_status="{{ $item['client_status'] }}"
                                        data-description="{{ $item['description'] }}"
                                        data-reset_password="{{ $item['reset_password'] }}"
                                    >
                                        <i class="fas fa-pen-nib"></i>
                                    </span>
                                    <span
                                        class="delete-client"
                                        data-id="{{ $item['id'] }}"
                                    >
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="12" class="hiddenRow">
                                <div class="accordion-body collapse" id="demo{{ $item['id'] }}">
                                    <div class="bom-list-row-expand">
                                        <h5>Consultant Information</h5>

                                        <div class="table-bom-list-section mt-5">
                                            <div class="container p-0">
                                                <div class="col-md-12">

                                                    <table class="table table-condensed table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>Consultant Name</th>
                                                            <th>Email Address</th>
                                                            <th>Contact No</th>
                                                            <th>Join Date</th>
                                                            <th>Designation</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>


                                                    <tbody>
                                                        <tr>
                                                            <td>01</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <!-- <img src="assets/images/user1.jpg" alt="Desirae" class="rounded-circle me-2" width="30" height="30"> -->
                                                                    <span>Desirae Press</span>
                                                                </div>
                                                            </td>
                                                            <td>desirae@gmail.com</td>
                                                            <td>+65 7863 0063</td>
                                                            <td>23 / 01 / 2024</td>
                                                            <td>Associate Consultant</td>
                                                            <td><span class="badge bg-success">● Active</span></td>
                                                            <td>
                                                                <div class="icon-group-listing">
                                                                    <span><i class="fa-solid fa-angle-down"></i></span>
                                                                    <span><i class="fas fa-pen-nib"></i></span>
                                                                    <span><i class="fa fa-trash"></i></span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>02</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <!-- <img src="assets/images/user2.jpg" alt="Maren" class="rounded-circle me-2" width="30" height="30"> -->
                                                                    <span>Maren Carder</span>
                                                                </div>
                                                            </td>
                                                            <td>maren89@gmail.com</td>
                                                            <td>+65 9765 1234</td>
                                                            <td>03 / 02 / 2024</td>
                                                            <td>IT Support</td>
                                                            <td><span class="badge bg-success">● Active</span></td>
                                                            <td>
                                                                <div class="icon-group-listing">
                                                                    <span><i class="fa-solid fa-angle-down"></i></span>
                                                                    <span><i class="fas fa-pen-nib"></i></span>
                                                                    <span><i class="fa fa-trash"></i></span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>03</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <!-- <img src="assets/images/user3.jpg" alt="Jaxson" class="rounded-circle me-2" width="30" height="30"> -->
                                                                    <span>Jaxson Saris</span>
                                                                </div>
                                                            </td>
                                                            <td>jaxson@gmail.com</td>
                                                            <td>+65 6376 4321</td>
                                                            <td>07 / 03 / 2024</td>
                                                            <td>Senior Consultant</td>
                                                            <td><span class="badge bg-danger">● Inactive</span></td>
                                                            <td>
                                                                <div class="icon-group-listing">
                                                                    <span><i class="fa-solid fa-angle-down"></i></span>
                                                                    <span><i class="fas fa-pen-nib"></i></span>
                                                                    <span><i class="fa fa-trash"></i></span>
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>
</div>

<div class="add-clinet-form-section" style="display: none;">
    <div class="bom-add-consultancy-screen">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 d-flex align-items-center">
                    <h2 id="consultancy_form_heading">Add Client</h2>
                </div>

                <div class="col-lg-8">
                    <div class="add-consultancy-btn-group">
                        <ul>
                            <li>
                                <a href="javascript:void(0);" onclick="clearClientForm();">
                                    <img src="{{ asset('public/assets/latest/images/clear-icon.png') }}" class="img-fluid" />
                                    Clear
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0);" onclick="submitClientForm();">
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
                    <form id="clientForm" method="POST" action="#" enctype="multipart/form-data">
                        @csrf

                        <h3>General & Contact Information</h3>
                        <div class="form-row-consultancy">
                            <div class="consultancy-form-col">
                                <input type="text" id="serving_client" name="serving_client" placeholder="Serving Client *" required />
                            </div>
                            <input type="hidden" name="edit_id" value="" />

                            <div class="consultancy-form-col">
                                <input type="text" name="client_id" placeholder="Client ID *" required />
                            </div>

                            <div class="consultancy-form-col">
                                <input type="text" name="primary_contact" placeholder="Primary Contact Person" required />
                            </div>

                            <div class="consultancy-form-col telephone-form-col">
                                <input type="tel" id="mobile_code_client" name="primary_mobile" placeholder="Mobile Number" required />
                            </div>

                            <div class="consultancy-form-col">
                                <input type="email" name="primary_email" placeholder="Primary Email Address *" required />
                            </div>

                            <div class="consultancy-form-col">
                                <input type="text" name="secondary_contact" placeholder="Secondary Contact Person" required />
                            </div>

                            <div class="consultancy-form-col telephone-form-col">
                                <input type="tel" id="mobile_code_2_client" name="secondary_mobile" placeholder="Mobile Number" required />
                            </div>

                            <div class="consultancy-form-col">
                                <input type="email" name="secondary_email" placeholder="Secondary Email Address" required />
                            </div>

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

                            <div class="consultancy-form-col">
                                <select name="client_status" required>
                                    <option value="" selected disabled>Client Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Disabled">Disabled</option>
                                    <!-- <option value="Block">Block</option>
                                    <option value="Deleted">Deleted</option> -->
                                </select>
                            </div>

                            <div class="consultancy-form-col" style="flex: 1 1 100%; margin-top: 10px;display: block;">
                                <label for="description" style="font-weight: 600; display: block; margin-bottom: 5px;">Description</label>
                                <textarea name="description" id="description" rows="10"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
                <script>
                    CKEDITOR.replace('description', {
                        height: 200,
                        width: '100%',
                        toolbar: [
                            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                            { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
                            { name: 'clipboard', items: ['Undo', 'Redo'] },
                            { name: 'editing', items: ['Scayt'] },
                            { name: 'styles', items: ['Format'] },
                            { name: 'font', items: ['FontSize'] },
                        ],
                        on: {
                            key: function(evt) {
                                const editor = evt.editor;
                                const plainText = editor.document.getBody().getText().trim();

                                const keyCode = evt.data.keyCode;
                                const isAllowedKey = [8, 46, 37, 38, 39, 40].includes(keyCode); // backspace, delete, arrows

                                if (plainText.length >= 800 && !isAllowedKey) {
                                    alert("Only 800 characters allowed.");
                                    evt.cancel(); // block typing
                                }
                            },
                            paste: function(evt) {
                                const editor = evt.editor;
                                const plainText = editor.document.getBody().getText().trim();
                                const clipboardData = evt.data.dataValue.replace(/<[^>]*>/g, '').trim();

                                if ((plainText.length + clipboardData.length) > 800) {
                                    alert("Pasting would exceed 10 characters limit.");
                                    evt.cancel(); // block paste
                                }
                            }
                        }
                    });
                </script>




                <!-- Address Modal -->
                <div class="bom-add-address-screen">
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

<script>
    let iti1, iti2;
    $(document).ready(function () {
        iti1 = $("#mobile_code_client").intlTelInput({
            initialCountry: "sg",
            separateDialCode: true,
        });

        iti2 = $("#mobile_code_2_client").intlTelInput({
            initialCountry: "sg",
            separateDialCode: true,
        });

        $(".show-add-client-form").on("click", function (e) {
            $(".client-list-consultancy-flow").hide();
            $(".filter-client-section-consultancy").hide();
            // e.preventDefault();
            $(".add-clinet-form-section").show(); // use toggle() if you don’t want slide effect
        });

        
        function filterTable() {
            var searchText = $("#searchInput").val().toLowerCase().trim();
            var selectedStatus = $("#statusFilter").val().toLowerCase();

            $("table tbody tr").each(function () {
                // Only main data rows (not expandable rows)
                if ($(this).find("td").length > 1) {
                    var rowText = $(this).text().toLowerCase();

                    // Find status text specifically from span class
                    var statusSpan = $(this).find("span.active-badge, span.inactive-badge");
                    var statusText = statusSpan.length > 0 ? statusSpan.text().toLowerCase().trim() : "";

                    var searchMatch = searchText === "" || rowText.includes(searchText);
                    var statusMatch = selectedStatus === "" || statusText === selectedStatus;

                    if (searchMatch && statusMatch) {
                        $(this).show();
                        $(this).next("tr").show(); // expandable row
                    } else {
                        $(this).hide();
                        $(this).next("tr").hide(); // expandable row
                    }
                }
            });
        }

        $("#searchInput").on("keyup", filterTable);
        $("#statusFilter").on("change", filterTable);
    });

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

        const formFields = document.querySelectorAll("#clientForm input, #clientForm select");

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

    function clearClientForm() {
        
        document.getElementById("manual_address_input").style.display = "block";
        document.getElementById("manual_address_input").setAttribute("required", "required");
        const addressBlock = document.getElementsByClassName("consultancy-form-address-feed-form")[0];
        addressBlock.classList.add("d-none");
        const form2 = document.getElementById("address_form");
        form2.reset();

        const addressCol = document.querySelector(".address-popup-right-col");
        addressCol.innerHTML = `<h4>Address</h4><div class="blank-address-content"><img src="{{ asset('public/assets/latest/images/no-data-2.png') }}" class="img-fluid" /><h5>Add Address</h5></div>`;
        $("#state-select").empty().append('<option value="" selected disabled>Select State / Province *</option>');
        document.getElementById("clientForm").reset();
    }

    function submitClientForm() {
        var editId = $('input[name="edit_id"]').val();
        const form = document.getElementById("clientForm");
        let valid = true;

        const consultancyInput = document.getElementById("serving_client");
        const value = consultancyInput.value.trim();

        const specialCharRegex = /[^a-zA-Z0-9 ]/; // Anything that's NOT a letter, number, or space

        if (value.length < 2) {
            const error = document.createElement("small");
            error.className = "error-message";
            error.style.marginTop = "50px";
            error.style.position = "absolute";
            error.style.color = "red";
            error.style.fontSize = "10px";
            error.textContent = "Minimum 2 characters required";

            consultancyInput.parentNode.insertBefore(error, consultancyInput.nextSibling);
            valid = false;

        } else if (value.length > 60) {
            const error = document.createElement("small");
            error.className = "error-message";
            error.style.marginTop = "50px";
            error.style.position = "absolute";
            error.style.color = "red";
            error.style.fontSize = "10px";
            error.textContent = "Maximum 60 characters allowed";

            consultancyInput.parentNode.insertBefore(error, consultancyInput.nextSibling);
            valid = false;

        } else if (specialCharRegex.test(value)) {
            const error = document.createElement("small");
            error.className = "error-message";
            error.style.marginTop = "50px";
            error.style.position = "absolute";
            error.style.color = "red";
            error.style.fontSize = "10px";
            error.textContent = "Special characters not allowed";

            consultancyInput.parentNode.insertBefore(error, consultancyInput.nextSibling);
            valid = false;
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
        var mobileInput = document.getElementById("mobile_code_client");
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

        // Digit check for mobile_code_2
        var mobileInput2 = document.getElementById("mobile_code_2_client");
        var mobileValue2 = mobileInput2.value.trim();
        var mobileParentDiv2 = mobileInput2.closest(".telephone-form-col");

        // Remove any existing error message
        var existingError2 = mobileParentDiv2.querySelector(".mobile-error");
        if (existingError2) {
            existingError2.remove();
        }

        if (!/^\d{11}$/.test(mobileValue2)) {
            mobileInput2.style.borderColor = "red";
            valid = false;

            var errorMsg2 = document.createElement("span");
            errorMsg2.classList.add("mobile-error");
            errorMsg2.style.marginTop = "50px";
            errorMsg2.style.position = "absolute";
            errorMsg2.style.color = "red";
            errorMsg2.style.fontSize = "10px";
            errorMsg2.textContent = "Mobile number must be exactly 11 digits";
            mobileParentDiv2.appendChild(errorMsg2);
        } else {
            mobileInput2.style.borderColor = ""; // Reset border color if valid
        }


        if (!valid) return false;
        CKEDITOR.instances.description.updateElement();

        // Proceed with AJAX Submission
        let formData = new FormData(form);

        const dialCode1 = "+" + iti1.intlTelInput("getSelectedCountryData").dialCode;
        const dialCode2 = "+" + iti2.intlTelInput("getSelectedCountryData").dialCode;
        formData.append("primary_mobile_country_code", dialCode1);
        formData.append("secondary_mobile_country_code", dialCode2);
        formData.append('reset_password', $('input[name="reset_password"]').is(':checked') ? '1' : '0');
        
        // Determine whether to Add or Update
        var actionUrl = "";
        var httpMethod = "";

        if (editId) {
            // If edit_id exists, it's an Update
            actionUrl = "{{ url('consultancies/update-client') }}/" + editId;
            formData.append("_method", "PUT");
        } else {
            // Add new record
            actionUrl = "{{ route('consultancy.add_client') }}"; // 
        }

        //console.log(Object.fromEntries(formData.entries()));


        $.ajax({
            url: actionUrl,
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
                if (xhr.status === 400) {
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
    
    $(document).on("click", ".edit-client", function () {
        $('input[name="edit_id"]').val($(this).data("id"));
        $('input[name="serving_client"]').val($(this).data("serving_client"));
        $('input[name="client_id"]').val($(this).data("client_id"));
        CKEDITOR.instances.description.setData($(this).data("description"));
        $('input[name="full_address"]').val($(this).data("full_address"));
        $('input[name="reset_password"]').prop('checked', $(this).data('reset_password') == 1);

        setIntlTelInput("#mobile_code_client", $(this).data("primary_mobile_country_code"));
        setIntlTelInput("#mobile_code_2_client", $(this).data("secondary_mobile_country_code"));

        let fullAddressStr = $(this).data("full_address"); // get the string
        let addressObj = {};

        // Split by comma and process each key-value pair
        fullAddressStr.split(",").forEach(function (item) {
            let parts = item.split(":");
            if (parts.length === 2) {
                let key = $.trim(parts[0]);
                let value = $.trim(parts[1]);
                addressObj[key] = value;
            }
        });

        // Populate form fields
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
        $('input[name="primary_contact"]').val($(this).data("primary_contact"));
        $('input[name="primary_mobile_country_code"]').val($(this).data("primary_mobile_country_code"));
        $('input[name="primary_mobile"]').val($(this).data("primary_mobile"));
        $('input[name="primary_email"]').val($(this).data("primary_email"));
        $('input[name="secondary_contact"]').val($(this).data("secondary_contact"));
        $('input[name="secondary_email"]').val($(this).data("secondary_email"));
        $('input[name="secondary_mobile_country_code"]').val($(this).data("secondary_mobile_country_code"));
        $('input[name="secondary_mobile"]').val($(this).data("secondary_mobile"));
        $('select[name="client_status"]').val($(this).data("client_status"));
        

        $(".client-list-consultancy-flow").hide();
        $(".filter-client-section-consultancy").hide();
        $(".add-clinet-form-section").show(); 


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

    $(document).on('click', '.delete-client', function () {
    let clientId = $(this).data('id');

    Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ url('consultancies/delete-client') }}/" + clientId,
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Deleted!",
                        text: response.message,
                        confirmButtonColor: "#3085d6",
                    }).then(() => {
                        location.reload(); // OR remove row from table if you're not reloading
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops!",
                        text: "Something went wrong while deleting.",
                        confirmButtonColor: "#d33",
                    });
                }
            });
        }
    });
});

</script>
