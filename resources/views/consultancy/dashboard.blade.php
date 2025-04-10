@extends('layouts.custom_layout') @section('content')

<section class="bom-screen-parent">
    <header class="bom-header">
        <div class="container">
            <div class="row py-2">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <img src="{{ asset('/' . $consultancy->consultancy_logo) }}" alt="Consultancy Logo" width="60" />
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="tabs-bom">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">User Management</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#finances" type="button" role="tab" aria-controls="contact" aria-selected="false">Clients</button>
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
                    <div class="bom-right-col">
                        <div class="bell-icon-col">
                            <i class="fa-solid fa-bell"></i>
                            <span>1</span>
                        </div>

                        <div class="bom-col-country-dropdown">
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

                        <div class="bom-profile-col">
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
                                <div class="search-bar-bom">
                                    <input type="text" id="searchInput" placeholder="Search ..." />
                                </div>

                                <div class="active-status-select-bom">
                                    <select id="statusFilter">
                                        <option value="">All</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="bom-btn-group">
                                    <div class="add-consultancy-btn">
                                        <a href="#" class="show-consultancy-form">
                                            <img src="{{ asset('public/assets/latest/images/circle-add-button.png ') }}" class="img-fluid" />
                                            Add User
                                        </a>
                                    </div>

                                    <!-- <div class="data-access-btn-bom">
                                        <img src="{{ asset('public/assets/latest/images/file-spreadsheet.png ') }}" class="img-fluid" />
                                        <p>Data Access</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="table-bom-list-section mt-5">
                            <div class="container p-0">
                                <div class="col-md-12">
                                    <table class="table table-condensed table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>User ID</th>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Designation</th>
                                                <th>Status</th>
                                                <th>Last Activity</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Add Consultancy Form (Initially Hidden) -->
                        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />

                        <div class="consultancy-form-section" style="display: none;">
                            <div class="bom-add-consultancy-screen">
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
                                                        <input type="text" name="consultancy_name" placeholder="Consultancy Name *" required />
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
                    </div>

                    <div class="tab-pane fade" id="finances" role="tabpanel" aria-labelledby="contact-tab"><p>Finances Section</p></div>
                    
                    <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="contact-tab"><p>Reports Section</p></div>

                    <div class="tab-pane fade" id="static-settings" role="tabpanel" aria-labelledby="contact-tab">
                    <p>Static settings Section</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('public/assets/latest/js/country-state-data.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@endsection
