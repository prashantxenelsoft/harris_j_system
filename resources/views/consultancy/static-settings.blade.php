<div class="static-setting-screen">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Settings</h2>
            </div>
        </div>

        <div class="row static-tab-screen-inner">
            <div class="col-lg-3">
                <div class="static-setting-search-bar">
                    <input type="text" placeholder="Search" />
                </div>

                <div class="vertical-tabs-switches">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-system-consultancy" data-bs-toggle="pill" data-bs-target="#v-pills-consultancy" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                            <i class="fa-solid fa-house-chimney-window"></i> Consultancy
                        </button>
                        <button
                            class="nav-link"
                            id="v-pills-system-holiday-management"
                            data-bs-toggle="pill"
                            data-bs-target="#v-pills-consultancy-holiday-management"
                            type="button"
                            role="tab"
                            aria-controls="v-pills-messages"
                            aria-selected="false"
                        >
                            <i class="fa-solid fa-umbrella"></i> Holiday Management
                        </button>
                        <button class="nav-link" id="v-pills-system-tab" data-bs-toggle="pill" data-bs-target="#v-pills-system" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                            <i class="fa-solid fa-sliders"></i> System Properties
                        </button>
                        <button
                            class="nav-link"
                            id="v-pills-system-holiday-management"
                            data-bs-toggle="pill"
                            data-bs-target="#v-pills-roles-privilages"
                            type="button"
                            role="tab"
                            aria-controls="v-pills-messages"
                            aria-selected="false"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="512" height="512">
                                <path
                                    d="M1.1,10.759a4.943,4.943,0,0,1,1-1.975L9.012,1.2A3.985,3.985,0,0,1,11,0V13.662Zm11.9,2.9,9.888-2.9a5.068,5.068,0,0,0-1.016-2L14.994,1.206A4,4,0,0,0,13,0Zm-2,2.085L1,12.815a5.079,5.079,0,0,0,1.127,2.433l6.9,7.538A3.994,3.994,0,0,0,11,23.987Zm2,0V24a3.97,3.97,0,0,0,2.01-1.209l6.9-7.582A4.966,4.966,0,0,0,23,12.813Z"
                                />
                            </svg>
                            Roles & Privilages
                        </button>
                        <button class="nav-link" id="v-pills-app-settings" data-bs-toggle="pill" data-bs-target="#v-app-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                            <i class="fa-solid fa-globe"></i> App Settings
                        </button>
                    </div>
                </div>

                <div class="static-setting-left-profile-wrap">
                    <img src="{{ asset('public/assets/latest/images/circle.png') }}" class="img-fluid" />
                    <p>Jane Cooper</p>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-consultancy" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="static-tab-one">
                            <div class="static-setting-tab-heading-row">
                                <h3>Consultancy</h3>
                            </div>

                            <div class="system-properties-screens-parent">
                                <div class="static-tab-content-inner">
                                <!-- <div class="add-lockup-btn-wrapper"><a href="#">Edit/Update</a></div> -->
                                    <div class="bom-add-consultancy-screen">
                                        <div class="container p-0">
                                            <div class="row add-consultancy-form">
                                                <div class="col-lg-12">
                                                    <h3>General & Contact Information</h3>
                                                    <div class="form-row-consultancy">
                                                    <div class="consultancy-form-col">
                                                        <input type="text" name="consultancy_name" placeholder="Consultancy Name" value="{{ $dataConsultancy->consultancy_name ?? '' }}" />
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <input type="text" name="consultancy_id" placeholder="Consultancy ID" value="{{ $dataConsultancy->consultancy_id ?? '' }}" />
                                                    </div>

                                                    <div class="consultancy-form-col">
                                                        <input type="text" name="uen_number" placeholder="UEN Number" value="{{ $dataConsultancy->uen_number ?? '' }}" />
                                                    </div>

                                                      
                                                        <div class="consultancy-form-col">
                                                            <div class="blank-form-feild d-none"></div>
                                                            <div class="consultancy-form-address-feed-form">
                                                                <div class="default-address-badge">
                                                                    <i class="fa-solid fa-location-dot"></i>
                                                                    <h6>Default</h6>
                                                                </div>
                                                                <div class="address-text-col-popup">
                                                                    <div class="address-default-text"><p>{{ $dataConsultancy->show_address_input ?? '' }}</p></div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Preview Logo Text -->
                                                        <div class="consultancy-form-col">
                                                          
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#logoPreviewModal">Consultancy Logo</a>
                                                        </div>

                                                       <!-- Modal for Logo Preview -->
                                                        <div class="modal fade" id="logoPreviewModal" tabindex="-1" aria-labelledby="logoPreviewLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                                                <div class="modal-content" style="padding: 10px;">
                                                                    <div class="modal-header py-2 px-3">
                                                                        <h6 class="modal-title" id="logoPreviewLabel" style="font-size: 14px;">Consultancy Logo</h6>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 10px;"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center p-2">
                                                                        @if(!empty($dataConsultancy->consultancy_logo))
                                                                            <img src="{{ asset('/' . $dataConsultancy->consultancy_logo) }}" alt="Consultancy Logo" class="img-fluid" style="max-width: 100px;" />
                                                                        @else
                                                                            <p style="font-size: 12px;">No logo uploaded.</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="consultancy-form-col"><input type="text" name="primary_contact" placeholder="Primary Contact Person" value="{{ $dataConsultancy->primary_contact ?? '' }}" /></div>
                                                        <div class="consultancy-form-col telephone-form-col"><input type="tel" id="mobile_code" placeholder="Mobile Number" value="{{ $dataConsultancy->primary_mobile ?? '' }}" />
                                                        </div>
                                                        <div class="consultancy-form-col"><input type="email" name="primary_email" placeholder="Primary Email Address" value="{{ $dataConsultancy->primary_email ?? '' }}" /></div>
                                                        <div class="consultancy-form-col"><input type="text" placeholder="Secondary Contact Person" value="{{ $dataConsultancy->secondary_contact ?? '' }}"  /></div>
                                                        <div class="consultancy-form-col"><input type="email" placeholder="Secondary Email Address" value="{{ $dataConsultancy->secondary_email ?? '' }}" /></div>
                                                        <div class="consultancy-form-col telephone-form-col"><input type="tel" id="mobile_code_2" value="{{ $dataConsultancy->secondary_mobile ?? '' }}" placeholder="Mobile Number" /></div>
                                                        <script>
                                                            let iti1;
                                                            $(document).ready(function () {
                                                                // Inject PHP variables into the JavaScript
                                                                setIntlTelInput("#mobile_code", "{{ $dataConsultancy->primary_mobile_country_code ?? '' }}");
                                                                setIntlTelInput("#mobile_code_2", "{{ $dataConsultancy->secondary_mobile_country_code ?? '' }}");
                                                            });

                                                            function setIntlTelInput(selector, dialCode) {
                                                                // Ensure a default country is selected if no country code is passed
                                                                let countryISO = Object.keys(countryCode).find(key => countryCode[key] === dialCode) || "in";
                                                                $(selector).intlTelInput("destroy").intlTelInput({
                                                                    initialCountry: countryISO,
                                                                    separateDialCode: true,
                                                                });
                                                            }
                                                        </script>

                                                        
                                                        <div class="consultancy-form-col">
                                                            <select name="consultancy_type">
                                                                <option value="" disabled selected>Consultancy Type</option>
                                                                <option value="type1" {{ $dataConsultancy->consultancy_type == 'type1' ? 'selected' : '' }}>Consultancy Type 1</option>
                                                                <option value="type2" {{ $dataConsultancy->consultancy_type == 'type2' ? 'selected' : '' }}>Consultancy Type 2</option>
                                                                <!-- Add more options as needed -->
                                                            </select>
                                                        </div>

                                                        <div class="consultancy-form-col">
                                                            <select name="consultancy_status">
                                                                <option value="" disabled selected>Consultancy Status</option>
                                                                <option value="Active" {{ $dataConsultancy->consultancy_status == 'Active' ? 'selected' : '' }}>Active</option>
                                                                <option value="Disabled" {{ $dataConsultancy->consultancy_status == 'Disabled' ? 'selected' : '' }}>Disabled</option>
                                                                <option value="Block" {{ $dataConsultancy->consultancy_status == 'Block' ? 'selected' : '' }}>Block</option>
                                                                <option value="Deleted" {{ $dataConsultancy->consultancy_status == 'Deleted' ? 'selected' : '' }}>Deleted</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <h3>Subscription Information</h3>
                                                    <div class="form-row-consultancy">
                                                        <div class="consultancy-form-col">
                                                            <label for="license_start_date">License Start Date:</label>
                                                            <input type="date" name="license_start_date" value="{{ $dataConsultancy->license_start_date ?? '' }}" />
                                                        </div>

                                                        <div class="consultancy-form-col">
                                                            <label for="license_end_date">License End Date:</label>
                                                            <input type="date" name="license_end_date" value="{{ $dataConsultancy->license_end_date ?? '' }}" />
                                                        </div>

                                                        <div class="consultancy-form-col">
                                                            <input type="text" name="license_number" placeholder="License Number" value="{{ $dataConsultancy->license_number ?? '' }}" />
                                                        </div>

                                                        <div class="consultancy-form-col">
                                                            <select name="fees_structure">
                                                                <option value="" disabled selected>Fees Structure</option>
                                                                <option value="structure1" {{ $dataConsultancy->fees_structure == 'structure1' ? 'selected' : '' }}>Fees Structure 1</option>
                                                                <option value="structure2" {{ $dataConsultancy->fees_structure == 'structure2' ? 'selected' : '' }}>Fees Structure 2</option>
                                                                <!-- Add more options as needed -->
                                                            </select>
                                                        </div>

                                                        <div class="consultancy-form-col">
                                                            <select name="last_paid_status">
                                                                <option value="" disabled selected>Last Paid Status</option>
                                                                <option value="Pending" {{ $dataConsultancy->last_paid_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="Paid" {{ $dataConsultancy->last_paid_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                                            </select>
                                                        </div>

                                                        <div class="consultancy-form-col"><label> Last Paid Date / Payment mode : -- </label></div>
                                                    </div>
                                                    <h3>Admin Credentials</h3>
                                                    <div class="form-row-consultancy">
                                                        <div class="consultancy-form-col">
                                                            <input type="email" name="user_email" placeholder="User Id / Email" value="{{ $dataConsultancy->user_email ?? '' }}" />
                                                        </div>
                                                        <div class="consultancy-form-col">
                                                        <div class="show-hide-password-col w-100">
                                                            <input id="password-field" type="password" class="form-control" name="user_password" value="{{ old('user_password') ?? '' }}" />
                                                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                        </div>

                                                        <script>
                                                            // Password visibility toggle functionality
                                                            const togglePassword = document.querySelector(".toggle-password");
                                                            const passwordField = document.querySelector("#password-field");

                                                            togglePassword.addEventListener("click", function () {
                                                                // Toggle the password visibility
                                                                const type = passwordField.type === "password" ? "text" : "password";
                                                                passwordField.type = type;

                                                                // Toggle the eye icon
                                                                this.classList.toggle("fa-eye-slash");
                                                            });
                                                        </script>

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

                    <div class="tab-pane fade" id="v-pills-consultancy-holiday-management" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="static-tab-one">
                            <div class="static-setting-tab-heading-row">
                                <h3>Holiday Management</h3>
                            </div>

                            <div class="static-tab-content-inner">
                                <div class="bom-add-lookup">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="table-half-lookup">
                                                <div class="search-bar-lookup">
                                                    <input type="text" placeholder="Search..." />
                                                </div>
                                                <div class="table-bom-list-section mt-3">
                                                    <div class="container p-0">
                                                        <div class="col-md-12"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row lookup-options-wrapper mt-3">
                                        <div class="col-lg-6">
                                            <div class="table-half-lookup">
                                                <div class="search-bar-lookup">
                                                    <input type="text" placeholder="Search..." />
                                                </div>
                                                <div class="table-bom-list-section mt-3">
                                                    <div class="container p-0">
                                                        <div class="col-md-12"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-system" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="static-tab-one">
                            <div class="static-setting-tab-heading-row">
                                <h3>System Properties</h3>
                            </div>

                            <div class="static-tab-content-inner">
                                <div class="bom-add-lookup">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="table-half-lookup">
                                                <div class="search-bar-lookup">
                                                    <input type="text" placeholder="Search..." />
                                                </div>
                                                <div class="table-bom-list-section mt-3">
                                                    <div class="container p-0">
                                                        <div class="col-md-12"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row lookup-options-wrapper mt-3">
                                        <div class="col-lg-6">
                                            <div class="table-half-lookup">
                                                <div class="search-bar-lookup">
                                                    <input type="text" placeholder="Search..." />
                                                </div>
                                                <div class="table-bom-list-section mt-3">
                                                    <div class="container p-0">
                                                        <div class="col-md-12"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-roles-privilages" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="static-tab-one">
                            <div class="static-setting-tab-heading-row">
                                <h3>Roles & Privilages</h3>
                            </div>

                            <div class="static-tab-content-inner">
                                <div class="bom-add-lookup">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="table-half-lookup">
                                                <div class="search-bar-lookup">
                                                    <input type="text" placeholder="Search..." />
                                                </div>
                                                <div class="table-bom-list-section mt-3">
                                                    <div class="container p-0">
                                                        <div class="col-md-12"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row lookup-options-wrapper mt-3">
                                        <div class="col-lg-6">
                                            <div class="table-half-lookup">
                                                <div class="search-bar-lookup">
                                                    <input type="text" placeholder="Search..." />
                                                </div>
                                                <div class="table-bom-list-section mt-3">
                                                    <div class="container p-0">
                                                        <div class="col-md-12"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-app-settings" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="static-tab-one">
                            <div class="static-setting-tab-heading-row">
                                <h3>App Settings</h3>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
