<div class="static-setting-screen">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Settings</h2>
            </div>
        </div>

        <div class="row static-tab-screen-inner">
            <div class="col-lg-3">
                <div class="static-setting-side-logo">
                    <a href="#">
                        <img src="{{ asset('public/assets/latest/images/Bom_logo.png') }}" class="img-fluid" />
                    </a>
                    <div class="side-arrow">
                        <i class="fa-solid fa-angle-left"></i>
                    </div>
                </div>

                <div class="static-setting-search-bar">
                    <input type="text" placeholder="Search" />
                </div>

                <div class="vertical-tabs-switches">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-system-tab" data-bs-toggle="pill" data-bs-target="#v-pills-system" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                            <i class="fa-solid fa-sliders"></i> System Properties
                        </button>
                        <button class="nav-link" id="v-pills-roles-tab" data-bs-toggle="pill" data-bs-target="#v-pills-roles" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="512" height="512">
                                <path d="M1.1,10.759a4.943,4.943,0,0,1,1-1.975L9.012,1.2A3.985,3.985,0,0,1,11,0V13.662Zm11.9,2.9,9.888-2.9a5.068,5.068,0,0,0-1.016-2L14.994,1.206A4,4,0,0,0,13,0Zm-2,2.085L1,12.815a5.079,5.079,0,0,0,1.127,2.433l6.9,7.538A3.994,3.994,0,0,0,11,23.987Zm2,0V24a3.97,3.97,0,0,0,2.01-1.209l6.9-7.582A4.966,4.966,0,0,0,23,12.813Z" />
                            </svg>
                            App Settings
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
                    <div class="tab-pane fade show active" id="v-pills-system" role="tabpanel" aria-labelledby="v-pills-home-tab">
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

                                        <form id="lookupForm">
                                            <div class="col-lg-6">
                                                <div class="lookup-header-col">
                                                    <h2><b style="color: red;">LookUp header</b></h2>
                                                    <div class="lookup-header-form-col">
                                                        <div class="input-col-lookup">
                                                            <label for="property_name">Property Name *</label>
                                                            <input type="text" id="property_name" name="property_name" placeholder="Claim Type" required />
                                                        </div>
                                                        <div class="status-col-lookup">
                                                            <p>Status:</p>
                                                            <label class="toggle">
                                                                <span class="onoff">Inactive</span>
                                                                <input type="checkbox" id="status" name="status" />
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="lookup-header-form-col">
                                                        <div class="input-col-lookup">
                                                            <label for="property_description">Property Description *</label>
                                                            <input type="text" id="property_description" name="property_description" placeholder="Claim Category" required />
                                                        </div>
                                                        <div class="color-picker-col-lookup">
                                                            <div class="color-picker-wrap">
                                                                <div class="current-color-code">
                                                                    <p>Hex:</p>
                                                                    <code id="colorCode">#ffffff</code>
                                                                </div>
                                                                <div class="color-picker-inner">
                                                                    <input type="color" id="colorPicker" name="color" value="#ffffff" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="lookup-header-button-group">
                                                        <ul>
                                                            <li><a href="#" id="clearBtn" class="disabled-btn">Clear</a></li>
                                                            <li><a href="#" id="saveBtn" class="active-btn">Save</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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

                                        <form id="lookupOptionForm" style="display: contents;">
                                            <div class="col-lg-6">
                                                <div class="lookup-header-col">
                                                    <h2>LookUp Options</h2>

                                                    <div class="lookup-header-form-col">
                                                        <div class="input-col-lookup">
                                                            <label>Property Name *</label>
                                                            <input type="text" id="property_name_Option" name="property_name_Option" placeholder="Claim Type" />
                                                        </div>
                                                        <div class="lookup-option-small-input-col-lookup">
                                                            <input type="text" id="option_value1_Option" name="option_value1_Option" placeholder="Option Value" />
                                                        </div>
                                                    </div>

                                                    <div class="lookup-header-form-col">
                                                        <div class="input-col-lookup">
                                                            <input type="text" id="option_name_Option" name="option_name_Option" placeholder="Option Name *" />
                                                        </div>
                                                        <div class="lookup-option-small-input-col-lookup">
                                                            <input type="text" id="Sequence_Option" name="Sequence_Option" placeholder="Sequence" />
                                                        </div>
                                                    </div>

                                                    <div class="lookup-header-form-col">
                                                        <div class="input-col-lookup">
                                                            <input type="text" id="option_description_Option" name="option_description_Option" placeholder="Option Description *" />
                                                        </div>
                                                        <div class="lookup-option-small-input-col-lookup">
                                                            <div class="color-picker-col-lookup" style="float: right;">
                                                                <div class="color-picker-wrap">
                                                                    <div class="current-color-code">
                                                                        <p>Hex:</p>
                                                                        <code id="colorCodeOption">#ffffff</code>
                                                                    </div>
                                                                    <div class="color-picker-inner">
                                                                        <input type="color" id="color_Option" name="color_Option" value="#ffffff" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex">
                                                        <div class="lookup-option-small-input-col-lookup d-flex mt-3">
                                                            <div class="status-col-lookup me-3">
                                                                <p>Status:</p>
                                                                <label class="toggle">
                                                                    <span class="onoff">Inactive</span>
                                                                    <input type="checkbox" id="status_Option" name="status_Option" />
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>

                                                            <div class="status-col-lookup">
                                                                <p>Visibility:</p>
                                                                <label class="toggle">
                                                                    <span class="onoff">Show</span>
                                                                    <input type="checkbox" id="visibility_Option" name="visibility_Option" />
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="lookup-header-button-group">
                                                        <!-- Buttons can be added here if needed -->
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        ...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
