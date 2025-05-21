@extends('layouts.custom_layout') @section('content')

<section class="hj-screen-parent">
    <header class="hj-header">
        <div class="container">
            <div class="row py-2">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <img src="{{ asset('public/assets/latest/images/Bom_logo.png') }}" style="width: 120px;" />
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="tabs-hj">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Consultancy</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#finances" type="button" role="tab" aria-controls="contact" aria-selected="false">Finances</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#reports" type="button" role="tab" aria-controls="contact" aria-selected="false">Reports</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#static-settings" type="button" role="tab" aria-controls="contact" aria-selected="false">Static Settings</button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="hj-right-col">
                        <div class="bell-icon-col">
                            <i class="fa-solid fa-bell"></i>
                            <span>1</span>
                        </div>

                        <div class="hj-col-country-dropdown">
                            <select id="action-dropdown" onchange="handleDropdown(this)">
                                <option selected disabled>{{ Auth::user()->name }}</option>
                                <option data-url="#">Profile</option>
                                <option data-url="logout">Logout</option>
                            </select>

                            <!-- Hidden logout form -->
                            <form id="logout-form" method="POST" action="{{ route('admin.logout') }}" style="display: none;">
                                @csrf
                            </form>

                            <script>
                                function handleDropdown(select) {
                                    const selectedOption = select.options[select.selectedIndex];
                                    const action = selectedOption.getAttribute('data-url');

                                    if (action === 'logout') {
                                        document.getElementById('logout-form').submit(); // submit logout form
                                    } else if (action && action !== '#') {
                                        window.location.href = action; // for other links
                                    }

                                    // Reset dropdown to default
                                    select.selectedIndex = 0;
                                }
                            </script>

                        </div>

                        <div class="hj-profile-col">
                            <img src="{{ asset('public/assets/latest/images/profile.png ') }}" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab"><p>Dashboard Section</p></div>

                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-lg-6 d-flex search-section">
                                <div class="search-bar-hj">
                                    <input type="text" id="searchInput" placeholder="Search ..." />
                                </div>

                                <div class="active-status-select-hj">
                                    <select id="statusFilter">
                                        <option value="">All</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="hj-btn-group">
                                    <div class="add-consultancy-btn">
                                        <a href="#" class="show-consultancy-form">
                                            <img src="{{ asset('public/assets/latest/images/circle-add-button.png ') }}" class="img-fluid" />
                                            Add Consultancy
                                        </a>
                                    </div>

                                    <!-- <div class="data-access-btn-hj">
                                        <img src="{{ asset('public/assets/latest/images/file-spreadsheet.png ') }}" class="img-fluid" />
                                        <p>Data Access</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="table-hj-list-section mt-5">
                            <div class="container p-0">
                                <div class="col-md-12">
                                    <table class="table table-condensed table-striped">
                                        <thead>
                                            <tr>
                                                <!-- <th>S.No</th> -->
                                                <th>Consultancy ID</th>
                                                <th>Consultancy Name</th>
                                                <th>Country</th>
                                                <th>Primary Contact Person</th>
                                                <th>Primary Email</th>
                                                <th>Primary Contact No</th>
                                                <th>License Expiry & Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($consultancies as $key => $consultancy) @php $country = 'N/A'; $postalCode = 'N/A'; $full_address_parts = explode(',', $consultancy['full_address']); foreach ($full_address_parts as
                                            $part) { if (stripos($part, 'country:') !== false) { $country = trim(str_ireplace('country:', '', $part)); } if (stripos($part, 'plusCode:') !== false) { $plusCode = trim(str_ireplace('plusCode:',
                                            '', $part)); } } @endphp

                                            <tr>
                                                <!-- <td>{{ $key + 1 }}</td> -->
                                                <td>{{ $consultancy['consultancy_id']  }}</td>
                                                <td>{{ $consultancy['consultancy_name'] ?? '-' }}</td>
                                                <td>
                                                    <div class="country-wrap d-flex align-items-center gap-2">
                                                        <img class="flag-img img-fluid" data-country="{{ $country }}" style="width: 20px; height: auto;" />
                                                        <p class="mb-0">{{ $country }}</p>
                                                    </div>
                                                </td>

                                                <td>{{ $consultancy['primary_contact'] ?? '-' }}</td>
                                                <td>{{ $consultancy['primary_email'] ?? '-' }}</td>
                                                <td>{{ $consultancy['primary_mobile_country_code'] ?? '' }} {{ $consultancy['primary_mobile'] ?? '' }}</td>
                                                <td>
                                                    <p>
                                                        <span>
                                                            {{ \Carbon\Carbon::parse($consultancy['license_end_date'])->format('d / m / Y') }}
                                                        </span>
                                                        <span>
                                                            {{ \Carbon\Carbon::parse($consultancy['license_end_date'])->format('h : i : s A') }}
                                                        </span>
                                                    </p>
                                                    <span class="{{ ['active' => 'active-badge', 'disabled' => 'disabled-badge', 'block' => 'blocked-badge', 'deleted' => 'deleted-badge'][strtolower($consultancy['consultancy_status'] ?? '')] ?? 'default-badge' }}">
                                                        {{ $consultancy['consultancy_status'] ?? '-' }}
                                                    </span>

                                                </td>
                                                <td>
                                                    <div class="icon-group-listing">
                                                        <span>
                                                            <i class="fa-solid fa-angle-down accordion-toggle" data-bs-toggle="collapse" data-bs-target="#demo{{ $key }}"></i>
                                                        </span>

                                                        <span
                                                            class="edit-consultancy"
                                                            data-id="{{ $consultancy['id'] }}"
                                                            data-consultancy_name="{{ $consultancy['consultancy_name'] }}"
                                                            data-consultancy_id="{{ $consultancy['consultancy_id'] }}"
                                                            data-uen_number="{{ $consultancy['uen_number'] }}"
                                                            data-full_address="{{ $consultancy['full_address'] }}"
                                                            data-show_address_input="{{ $consultancy['show_address_input'] }}"
                                                            data-primary_contact="{{ $consultancy['primary_contact'] }}"
                                                            data-primary_mobile="{{ $consultancy['primary_mobile'] }}"
                                                            data-primary_email="{{ $consultancy['primary_email'] }}"
                                                            data-primary_mobile_country_code="{{ $consultancy['primary_mobile_country_code'] }}"
                                                            data-secondary_mobile_country_code="{{ $consultancy['secondary_mobile_country_code'] }}"
                                                            data-secondary_contact="{{ $consultancy['secondary_contact'] }}"
                                                            data-secondary_email="{{ $consultancy['secondary_email'] }}"
                                                            data-secondary_mobile="{{ $consultancy['secondary_mobile'] }}"
                                                            data-consultancy_type="{{ $consultancy['consultancy_type'] }}"
                                                            data-consultancy_status="{{ $consultancy['consultancy_status'] }}"
                                                            data-license_start_date="{{ $consultancy['license_start_date'] }}"
                                                            data-license_end_date="{{ $consultancy['license_end_date'] }}"
                                                            data-license_number="{{ $consultancy['license_number'] }}"
                                                            data-consultancy_logo="{{ $consultancy['consultancy_logo'] }}"
                                                            data-fees_structure="{{ $consultancy['fees_structure'] }}"
                                                            data-last_paid_status="{{ $consultancy['last_paid_status'] }}"
                                                            data-admin_email="{{ $consultancy['admin_email'] }}"
                                                            data-reset_password="{{ $consultancy['reset_password'] }}"
                                                        >
                                                            <i class="fas fa-pen-nib"></i>
                                                        </span>

                                                        <span class="delete-consultancy" data-id="{{ $consultancy['id'] }}">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Expandable Row -->
                                            <tr>
                                                <td colspan="12" class="hiddenRow">
                                                    <div class="accordion-body collapse" id="demo{{ $key }}">
                                                        <div class="hj-list-row-expand">
                                                            <h5>Contact & Address Information</h5>
                                                            <div class="list-hj-cards">
                                                                <ul>
                                                                    <li>
                                                                        <div class="hj-expand-card">
                                                                            <h3>Primary Contact Person</h3>
                                                                            <h4>{{ $consultancy['primary_contact'] ?? '-' }}</h4>
                                                                            <ul>
                                                                                <li>
                                                                                    <span><i class="fa-solid fa-phone-volume"></i></span>
                                                                                    <a href="#">{{ $consultancy['primary_mobile_country_code'] ?? '' }} {{ $consultancy['primary_mobile'] ?? '' }}</a>
                                                                                </li>
                                                                                <li>
                                                                                    <span><i class="fa-solid fa-envelope-open"></i></span>
                                                                                    <a href="#">{{ $consultancy['primary_email'] ?? '-' }}</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="hj-expand-card">
                                                                            <h3>Secondary Contact Person</h3>
                                                                            <h4>{{ $consultancy['secondary_contact'] ?? '-' }}</h4>
                                                                            <ul>
                                                                                <li>
                                                                                    <span><i class="fa-solid fa-phone-volume"></i></span>
                                                                                    <a href="#">{{ $consultancy['secondary_mobile_country_code'] ?? '' }} {{ $consultancy['secondary_mobile'] ?? '' }}</a>
                                                                                </li>
                                                                                <li>
                                                                                    <span><i class="fa-solid fa-envelope-open"></i></span>
                                                                                    <a href="#">{{ $consultancy['secondary_email'] ?? '-' }}</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <div class="hj-expand-card">
                                                                            <h3>Admin Information</h3>
                                                                            <ul class="mt-3">
                                                                                <li>
                                                                                    <span><i class="fa-solid fa-envelope-open"></i></span>
                                                                                    <a href="#">{{ $consultancy['admin_email'] ?? '-' }}</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <div class="hj-expand-card">
                                                                            <h3>Address Information</h3>
                                                                            <ul class="mt-3">
                                                                                <li>
                                                                                    <span><i class="fa-solid fa-location-dot"></i></span>
                                                                                    <a href="#">{{ $consultancy['show_address_input'] ?? '' }}</a>
                                                                                </li>
                                                                                
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <h5>License Information</h5>
                                                            <div class="list-row-below-card">
                                                                <ul>
                                                                    <li>
                                                                        <p>License Number: <b>{{ $consultancy['license_number'] ?? '-' }}</b></p>
                                                                    </li>
                                                                    <li>
                                                                        <p>License Start Date: <b>{{ \Carbon\Carbon::parse($consultancy['license_start_date'])->format('d / m / Y') }}</b></p>
                                                                    </li>
                                                                    <li>
                                                                        <p>Fees Structure: <b>{{ $consultancy['fees_structure'] ?? '-' }}</b></p>
                                                                    </li>
                                                                    <li>
                                                                        <p>
                                                                            Last Paid Status:
                                                                            <span class="{{ strtolower($consultancy['last_paid_status']) == 'paid' ? 'paid-badge' : 'unpaid-badge' }}">
                                                                                <i class="fa-solid {{ strtolower($consultancy['last_paid_status']) == 'paid' ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
                                                                                {{ $consultancy['last_paid_status'] ?? '-' }}
                                                                            </span>
                                                                        </p>
                                                                    </li>
                                                                </ul>
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

                        <!-- Add Consultancy Form (Initially Hidden) -->
                        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />

                        <div class="consultancy-form-section" style="display: none;">
                            <div class="hj-add-consultancy-screen">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-4 d-flex align-items-center">
                                            <h2 id="consultancy_form_heading">Add Consultancy</h2>
                                        </div>

                                        <div class="col-lg-8">
                                            <div class="add-consultancy-btn-group">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:void(0);" onclick="clearConsultancyForm();">
                                                            <img src="{{ asset('public/assets/latest/images/clear-icon.png') }}" class="img-fluid" />
                                                            Clear
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0);" onclick="validateConsultancyForm();">
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
                                            <form id="consultancyForm" method="POST" action="{{ route('consultancy.store') }}" enctype="multipart/form-data">
                                                @csrf

                                                <h3>General & Contact Information</h3>
                                                <div class="form-row-consultancy">
                                                    <div class="consultancy-form-col">
                                                        <input type="text" id="consultancy_name" name="consultancy_name" placeholder="Consultancy Name *" required />
                                                    </div>
                                                    <input type="hidden" name="edit_id" value="" />

                                                    <div class="consultancy-form-col">
                                                        <input type="text" name="consultancy_id" placeholder="Consultancy ID *" required />
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <input type="text" name="uen_number" placeholder="UEN Number *" required />
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
                                                        <input type="text" name="primary_contact" placeholder="Primary Contact Person" required />
                                                    </div>

                                                    <div class="consultancy-form-col telephone-form-col">
                                                        <input type="tel" id="mobile_code" name="primary_mobile" placeholder="Mobile Number" required />
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <input type="email" name="primary_email" placeholder="Primary Email Address *" required />
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <input type="text" name="secondary_contact" placeholder="Secondary Contact Person" required />
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <input type="email" name="secondary_email" placeholder="Secondary Email Address" required />
                                                    </div>

                                                    <div class="consultancy-form-col telephone-form-col">
                                                        <input type="tel" id="mobile_code_2" name="secondary_mobile" placeholder="Mobile Number" required />
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <select name="consultancy_type" required>
                                                            <option value="" selected disabled>Consultancy Type</option>
                                                            <option value="type1">Primary Consultancy</option>
                                                            <option value="type2">Silver Consultancy</option>
                                                        </select>
                                                    </div>


                                                    <div class="consultancy-form-col">
                                                        <select name="consultancy_status" required>
                                                            <option value="" selected disabled>Consultancy Status</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Disabled">Disabled</option>
                                                            <option value="Block">Block</option>
                                                            <option value="Deleted">Deleted</option>
                                                        </select>
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <label for="consultancy_image">Upload Logo</label>
                                                        <input type="file" name="consultancy_image" id="consultancy_image" accept="image/*" required>
                                                        <span id="previewText" style="display:none; color: blue; text-decoration: underline; cursor: pointer; margin-left: 10px;">
                                                            Preview
                                                        </span>
                                                    </div>

                                                    <!-- Image Preview Modal -->
                                                    <div id="imagePreviewModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.7); z-index:1000; justify-content:center; align-items:center;">
                                                        <div style="position:relative; background:#fff; padding:20px; border-radius:8px;">
                                                            <span onclick="closeModal()" style="position:absolute; top:5px; right:10px; font-size:20px; cursor:pointer;">&times;</span>
                                                            <img id="previewImage" src="" alt="Image Preview" style="max-width:500px; max-height:400px;">
                                                        </div>
                                                    </div>

                                                </div>

                                                <h3>Subscription Information</h3>
                                                <div class="form-row-consultancy">
                                                    <div class="consultancy-form-col">
                                                        <label>License Start Date :</label>
                                                        <input type="date" name="license_start_date" required />
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <label>License End Date :</label>
                                                        <input type="date" name="license_end_date" required />
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <input type="text" name="license_number" placeholder="License Number" required />
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <select name="fees_structure" required>
                                                            <option value="" selected disabled>Fees Structure</option>
                                                            <option value="structure1">Structure 1</option>
                                                            <option value="structure2">Structure 2</option>
                                                        </select>
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <select name="last_paid_status" required>
                                                            <option value="" selected disabled>Last Paid Status</option>
                                                            <option value="Pending">Pending</option>
                                                            <!-- <option value="Paid">Paid</option>
                                                            <option value="Pending">Pending</option> -->
                                                        </select>
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <label>Last Paid Date / Payment mode: --</label>
                                                    </div>
                                                </div>

                                                <h3>Admin Credentials</h3>
                                                <div class="form-row-consultancy">
                                                    <div class="consultancy-form-col">
                                                        <input type="email" name="admin_email" placeholder="User Id / Email *" required />
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <div class="reset-password">
                                                            <input type="checkbox" name="reset_password" value="1">
                                                            <label>Reset Password</label>
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
                    </div>

                    <div class="tab-pane fade" id="finances" role="tabpanel" aria-labelledby="contact-tab"><p>Finances Section</p></div>
                    
                    <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="contact-tab"><p>Reports Section</p></div>

                    <div class="tab-pane fade" id="static-settings" role="tabpanel" aria-labelledby="contact-tab">
                        @include('bom.lookup')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
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
    });

</script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('public/assets/latest/js/country-state-data.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let iti1, iti2;
    $(document).ready(function () {
        iti1 = $("#mobile_code").intlTelInput({
            initialCountry: "sg",
            separateDialCode: true,
        });

        iti2 = $("#mobile_code_2").intlTelInput({
            initialCountry: "sg",
            separateDialCode: true,
        });

        $(".show-consultancy-form").click(function () {
            // Show consultancy form
            document.querySelector(".consultancy-form-section").style.display = "flex";
            $("#consultancy_form_heading").text("Add Consultancy");
            document.getElementById("manual_address_input").style.display = "block";
            document.getElementById("manual_address_input").setAttribute("required", "required");
            const addressBlock = document.getElementsByClassName("consultancy-form-address-feed-form")[0];
            addressBlock.classList.add("d-none");
            const form = document.getElementById("consultancyForm");
            form.reset();
            const form2 = document.getElementById("address_form");
            form2.reset();

            const addressCol = document.querySelector(".address-popup-right-col");
            addressCol.innerHTML = `<h4>Address</h4><div class="blank-address-content"><img src="{{ asset('public/assets/latest/images/no-data-2.png') }}" class="img-fluid" /><h5>Add Address</h5></div>`;
            $("#state-select").empty().append('<option value="" selected disabled>Select State / Province *</option>');

            // Hide other sections
            $(".table-hj-list-section").hide();
            document.querySelector(".search-section").setAttribute("style", "display: none !important;");
            $(".hj-btn-group").hide();
            let select = $('select[name="last_paid_status"]');
            select.find('option').each(function() {
                if ($(this).val().toLowerCase() === "paid") {
                    $(this).remove();
                }
            });
            select.val("Pending"); // "Pending" ensure karein
        });

        $(".back-to-list-btn").click(function () {
            $(".consultancy-form-section").hide();
            $(".table-hj-list-section").show();
            document.querySelector(".search-section").removeAttribute("style");
            $(".hj-btn-group").show();
        });

        $(".nav-tabs .nav-link").click(function () {
            $(".consultancy-form-section").hide();
            $(".table-hj-list-section").show();
            document.querySelector(".search-section").removeAttribute("style");
            $(".hj-btn-group").show();
        });

        $(".delete-consultancy").on("click", function () {
            let consultancyId = $(this).data("id");

            if (confirm("Are you sure you want to delete this consultancy?")) {
                $.ajax({
                    url: "{{ route('consultancy.delete', '') }}/" + consultancyId,
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Consultancy Deleted",
                            confirmButtonColor: "#3085d6",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function (xhr) {
                        alert("Something went wrong!");
                        console.log(xhr.responseText);
                    },
                });
            }
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
    function clearConsultancyForm() {
        
        document.getElementById("manual_address_input").style.display = "block";
        document.getElementById("manual_address_input").setAttribute("required", "required");
        const addressBlock = document.getElementsByClassName("consultancy-form-address-feed-form")[0];
        addressBlock.classList.add("d-none");
        const form2 = document.getElementById("address_form");
        form2.reset();

        const addressCol = document.querySelector(".address-popup-right-col");
        addressCol.innerHTML = `<h4>Address</h4><div class="blank-address-content"><img src="{{ asset('public/assets/latest/images/no-data-2.png') }}" class="img-fluid" /><h5>Add Address</h5></div>`;
        $("#state-select").empty().append('<option value="" selected disabled>Select State / Province *</option>');
        document.getElementById("consultancyForm").reset();
    }
    function validateConsultancyForm() {
        var editId = $('input[name="edit_id"]').val();
        const form = document.getElementById("consultancyForm");
        let valid = true;

        const consultancyInput = document.getElementById("consultancy_name");
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
        var mobileInput = document.getElementById("mobile_code");
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
        var mobileInput2 = document.getElementById("mobile_code_2");
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
            actionUrl = "{{ url('consultancies') }}/" + editId; 
            formData.append("_method", "PUT"); 
        } else {
            // Add new record
            actionUrl = "{{ route('consultancy.store') }}"; // 
        }

        console.log(Object.fromEntries(formData.entries()));


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

                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: response.message,
                    confirmButtonColor: "#3085d6",
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });

                document.addEventListener("DOMContentLoaded", function () {
                    if (localStorage.getItem("triggerProfileTab") === "true") {
                        document.getElementById("profile-tab").click();
                        localStorage.removeItem("triggerProfileTab"); // Flag hata de
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

    function clearConsultancyForm() {
        const form = document.getElementById("consultancyForm");
        form.reset();

        document.getElementById("manual_address_input").style.display = "block";
        document.getElementById("manual_address_input").setAttribute("required", "required");
        const addressBlock = document.getElementsByClassName("consultancy-form-address-feed-form")[0];
        addressBlock.classList.add("d-none");
        const form2 = document.getElementById("address_form");
        form2.reset();

        const addressCol = document.querySelector(".address-popup-right-col");
        addressCol.innerHTML = `<h4>Address</h4><div class="blank-address-content"><img src="{{ asset('public/assets/latest/images/no-data-2.png') }}" class="img-fluid" /><h5>Add Address</h5></div>`;
        $("#state-select").empty().append('<option value="" selected disabled>Select State / Province *</option>');

        form.querySelectorAll("input, select").forEach((field) => {
            field.style.borderColor = "";
        });

        document.querySelectorAll(".mobile-error").forEach((el) => el.remove());
        document.querySelectorAll(".has-error").forEach((el) => el.classList.remove("has-error"));
    }

    // Remove red border and error message on focus or input
    document.addEventListener("DOMContentLoaded", function () {
        const formFields = document.querySelectorAll("#consultancyForm input, #consultancyForm select");

        formFields.forEach((field) => {
            field.addEventListener("focus", function () {
                field.style.borderColor = "";

                // For mobile_code fields
                if (field.id === "mobile_code" || field.id === "mobile_code_2") {
                    const mobileParentDiv = field.closest(".telephone-form-col");
                    mobileParentDiv.querySelectorAll(".mobile-error").forEach((el) => el.remove());
                }

                // For consultancy_name field
                if (field.id === "consultancy_name") {
                    const nextEl = field.nextElementSibling;
                    if (nextEl && nextEl.classList.contains("error-message")) {
                        nextEl.remove();
                    }
                }
            });

            field.addEventListener("input", function () {
                field.style.borderColor = "";

                // For mobile_code fields
                if (field.id === "mobile_code" || field.id === "mobile_code_2") {
                    const mobileParentDiv = field.closest(".telephone-form-col");
                    mobileParentDiv.querySelectorAll(".mobile-error").forEach((el) => el.remove());
                }

                // For consultancy_name field
                if (field.id === "consultancy_name") {
                    const nextEl = field.nextElementSibling;
                    if (nextEl && nextEl.classList.contains("error-message")) {
                        nextEl.remove();
                    }
                }
            });
        });
    });

    // Populate all countries in country dropdown
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
        const flagImgs = document.querySelectorAll(".flag-img");
        flagImgs.forEach((img) => {
            const country = img.getAttribute("data-country");
            const isoCode = countryIsoMap[country] || null;
            if (isoCode) {
                img.src = `https://flagsapi.com/${isoCode}/flat/32.png`;
                img.alt = country;
            } else {
                img.src = "{{ asset('public/assets/latest/images/default-flag.png') }}";
                img.alt = "No Flag";
            }
        });
    });

    $(document).on("click", ".edit-consultancy", function () {
        $('input[name="edit_id"]').val($(this).data("id"));
        $('input[name="consultancy_name"]').val($(this).data("consultancy_name"));
        $('input[name="consultancy_id"]').val($(this).data("consultancy_id"));
        $('input[name="uen_number"]').val($(this).data("uen_number"));
        $('input[name="full_address"]').val($(this).data("full_address"));
        $('input[name="reset_password"]').prop('checked', $(this).data('reset_password') == 1);

        const rawPath = $(this).data("consultancy_logo");

        if (rawPath) {
            const filename = rawPath.split('consultancy/')[1];
            const pathParts = window.location.pathname.split('/');
            const basePath = pathParts.length > 1 ? '/' + pathParts[1] : '';
            const baseUrl = window.location.origin + basePath;

            const imageUrl = baseUrl + '/storage/app/public/consultancy/' + filename;


            $('#previewImage').attr('src', imageUrl);
            $('#previewText').show();
            $('#consultancy_image').removeAttr('required');
        } else {
            $('#previewImage').attr('src', '');
            $('#previewText').hide();
            $('#consultancy_image').attr('required', 'required');
        }

        setIntlTelInput("#mobile_code", $(this).data("primary_mobile_country_code"));
        setIntlTelInput("#mobile_code_2", $(this).data("secondary_mobile_country_code"));

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
        $('select[name="consultancy_status"]').val($(this).data("consultancy_status"));
        $('select[name="consultancy_type"]').val($(this).data("consultancy_type"));
        $('input[name="license_start_date"]').val($(this).data("license_start_date"));
        $('input[name="license_end_date"]').val($(this).data("license_end_date"));
        $('input[name="license_number"]').val($(this).data("license_number"));
        let select = $('select[name="last_paid_status"]');
        if (select.find('option[value="paid"]').length === 0) {
            select.append('<option value="paid">Paid</option>');
        }
        select.val($(this).data("last_paid_status"));

        $('input[name="payment_mode"]').val($(this).data("payment_mode"));
        $('select[name="fees_structure"]').val($(this).data("fees_structure"));
        $('input[name="admin_email"]').val($(this).data("admin_email"));
        $(".consultancy-form-section").show();
        $(".table-hj-list-section").hide();
        $(".hj-btn-group").hide();
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
    function setIntlTelInput(selector, dialCode) {
        let countryISO = Object.keys(countryCode).find(key => countryCode[key] === dialCode) || "in";
        $(selector).intlTelInput("destroy").intlTelInput({
            initialCountry: countryISO,
            separateDialCode: true,
        });
    }

    const fileInput = document.getElementById('consultancy_image');
    const previewText = document.getElementById('previewText');
    const previewImage = document.getElementById('previewImage');
    const imagePreviewModal = document.getElementById('imagePreviewModal');

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewText.style.display = 'inline';
            };
            reader.readAsDataURL(file);
        } else {
            previewText.style.display = 'none';
            previewImage.src = '';
        }
    });

    previewText.addEventListener('click', function () {
        imagePreviewModal.style.display = 'flex';
    });

    function closeModal() {
        imagePreviewModal.style.display = 'none';
    }
</script>

@endsection
