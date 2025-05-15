<div class="add-consultants-wrapper">
   <div id="consultantListView">
      <div class=" pt-4">
         <div class="row">
            <div class="col-lg-4 col-xxl-3">
               <div class="add-consultant-clients-wrapper">
                  <h4>Clients</h4>
                  <div class="clients-tabs-consultants pt-3">
                     <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                           <div class="clients-tab-switch">
                              <div class="clients-img-name">
                                 <img src="{{ asset('public/assets/images/client-icon-1.png')}}" class="img-fluid"> 
                                 <h6>Encore Films</h6>
                              </div>
                              <div class="clients-numbers-tab-switch"> <span> (<em>10</em>,<em>23</em>,<em>12</em>) <b>/ 45 </b> </span> </div>
                           </div>
                        </button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                           <div class="clients-tab-switch">
                              <div class="clients-img-name">
                                 <img src="{{ asset('public/assets/images/client-icon-2.png')}}" class="img-fluid"> 
                                 <h6>Encore Films</h6>
                              </div>
                              <div class="clients-numbers-tab-switch"> <span> (<em>10</em>,<em>23</em>,<em>12</em>) <b>/ 45 </b> </span> </div>
                           </div>
                        </button>
                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                           <div class="clients-tab-switch">
                              <div class="clients-img-name">
                                 <img src="{{ asset('public/assets/images/client-icon-3.png')}}" class="img-fluid"> 
                                 <h6>Bank of America</h6>
                              </div>
                              <div class="clients-numbers-tab-switch"> <span> (<em>10</em>,<em>23</em>,<em>12</em>) <b>/ 45 </b> </span> </div>
                           </div>
                        </button>
                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                           <div class="clients-tab-switch">
                              <div class="clients-img-name">
                                 <img src="{{ asset('public/assets/images/client-icon-4.png')}}" class="img-fluid"> 
                                 <h6>Citi Bank</h6>
                              </div>
                              <div class="clients-numbers-tab-switch"> <span> (<em>10</em>,<em>23</em>,<em>12</em>) <b>/ 45 </b> </span> </div>
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
                                 <input type="text" placeholder="Search..."> 
                                 <select>
                                    <option> Designation </option>
                                 </select>
                                 <select>
                                    <option> Status </option>
                                 </select>
                              </div>
                              <div class="clients-tab-header-right-col"> <a href="javascript:void(0);" onclick="showAddConsultantForm();" class="add-consultants-btn">
                                 <img src="{{ asset('public/assets/images/circle-add-button.png') }}" class="img-fluid"> 
                                 Add Consultants
                                 </a> 
                              </div>
                           </div>
                           <div class="table-hj-list-section mt-3">
                              <div class="container p-0">
                                 <div class="col-md-12">
                                    <table class="table table-condensed table-striped">
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
                                          @forelse ($consultants as $index => $consultant)
                                          <tr>
                                             <td>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                             <td>{{ $consultant->emp_code ?? 'N/A' }}</td>
                                             <td>
                                                <div class="country-wrap">
                                                   @php
                                                   $isMale = strtolower($consultant->sex ?? '') === 'male';
                                                   $icon = $isMale ? 'male-icon.png' : 'female-icon.png';
                                                   @endphp
                                                   <img src="{{ asset('public/assets/images/' . $icon) }}" class="img-fluid"> 
                                                   <p>{{ $consultant->emp_name ?? $consultant->name ?? 'N/A' }}</p>
                                                </div>
                                             </td>
                                             <td>{{ $consultant->email ?? 'N/A' }}</td>
                                             <td>
                                                @php
                                                $resCode = strtoupper(substr($consultant->designation ?? 'NA', 0, 3));
                                                $badgeClass = 'blue-badge';
                                                if ($resCode === 'SPR') $badgeClass = 'red-badge';
                                                elseif ($resCode === 'PP') $badgeClass = 'orange-badge';
                                                @endphp
                                                <span class="{{ $badgeClass }}"><strong>{{ $resCode }}</strong></span>
                                             </td>
                                             <td><span class="{{ $badgeClass }}">{{ $consultant->designation ?? 'N/A' }}</span></td>
                                             <td>
                                                <p>
                                                   <span>
                                                   {{ !empty($consultant->joining_date) ? \Carbon\Carbon::parse($consultant->joining_date)->format('d / m / Y') : 'N/A' }}
                                                   </span>
                                                </p>
                                             </td>
                                             <td>
                                                <span class="{{ strtolower($consultant->status ?? '') === 'active' ? 'active-badge' : 'inactive-badge' }}">
                                                {{ ucfirst($consultant->status ?? 'Inactive') }}
                                                </span>
                                             </td>
                                             <td>
                                                <div class="icon-group-listing">
                                                   <span><i class="fas fa-pen-nib"></i></span> 
                                                   <span>
                                                      <i class="fa fa-trash" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $consultant->id }}"></i>
                                                      <div class="modal fade delete-popup" id="deleteModal-{{ $consultant->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                         <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                               <img src="{{ asset('public/assets/images/close-icon-popup.png') }}" data-bs-dismiss="modal" aria-label="Close" class="delete-popup-close-btn"> 
                                                               <div class="modal-body">
                                                                  <div class="delete-popup-row">
                                                                     <div class="delete-icon-row"><span><i class="fa fa-trash"></i></span></div>
                                                                     <div class="delete-row-text">
                                                                        <h6>Are you sure you want to delete this user?</h6>
                                                                        <p>This action cannot be undone. The user's data will be permanently removed.</p>
                                                                     </div>
                                                                  </div>
                                                                  <div class="delete-popup-btn-group">
                                                                     <a href="#" data-bs-dismiss="modal">No, cancel</a>
                                                                     <a href="#">Yes, confirm</a>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </span>
                                                </div>
                                             </td>
                                          </tr>
                                          @empty
                                          <tr>
                                             <td colspan="9" class="text-center text-muted">No consultants found.</td>
                                          </tr>
                                          @endforelse
                                       </tbody>
                                    </table>
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
   <!-- <div id="addConsultantForm" style="display: none;">
      <div class="hj-add-consultancy-screen add-consulatant-add px-3">
         <div class="mt-2">
            <div class="row">
               <div class="col-lg-4 d-flex align-items-center">
                  <h2>Add Consultants </h2>
               </div>
               <div class="col-lg-8">
                  <div class="add-consultancy-btn-group">
                     <ul>
                        <li>
                           <a href="javascript:void(0);" onclick="showConsultantList();">
                           <img src="{{ asset('public/assets/images/back-arrow.png') }}" class="img-fluid">
                           Back to List
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <img src="{{ asset('public/assets/images/clear-icon.png')}}" class="img-fluid"> 
                           Clear
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <img src="{{ asset('public/assets/images/save-icon.png')}}" class="img-fluid"> 
                           Save
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="row add-consultancy-form">
               <div class="col-lg-12">
                  <h3>General &amp; Contact Information</h3>
                  <div class="form-row-consultancy">
                     <div class="consultancy-form-col"> <input type="text" placeholder="Name *"> </div>
                     <div class="consultancy-form-col"> <input type="text" placeholder="Employee Code"> </div>
                     <div class="consultancy-form-col sex-option-wrap"> <label>Sex : </label> <span> <input type="checkbox"> <label>Male<b style="color: blue; font-weight: 800;">&#9794;</b></label> </span> <span> <input type="checkbox"> <label>Female</label> </span> <span> <input type="checkbox"> <label>Others</label> </span> </div>
                     <div class="consultancy-form-col"> <label>Date Of Birth :</label> <input type="date"> </div>
                     <div class="consultancy-form-col telephone-form-col"> <input type="tel" id="mobile_code" placeholder="Mobile Number"> </div>
                     <div class="consultancy-form-col"> <input type="email" placeholder="Email Address"> </div>
                     <div class="consultancy-form-col upload-pic-col"> <input type="file" placeholder="Upload Profile Picture"> <label>*Recommended Minimum Resolution 512 x 512 px. (Max.file size: 1MB)</label> </div>
                     <div class="consultancy-form-col">
                        <div class="blank-form-feild text-center d-flex align-items-center justify-content-center">
                           <label>Profile Picture Preview</label> 
                           <p>*rxmed.png size : 512kb</p>
                        </div>
                     </div>
                     <div class="consultancy-form-col add-address-col" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fa-solid fa-house"></i> 
                        <p>Add Address</p>
                     </div>
                     <div class="consultancy-form-col consultancy-form-address-feed-form">
                        <div class="default-address-badge">
                           <i class="fa-solid fa-location-dot"></i> 
                           <h6>Default</h6>
                        </div>
                        <div class="address-text-col-popup">
                           <div class="address-default-text">
                              <p> Design Avenue , #765, av super mall ( near ), Singapore - 569933 </p>
                           </div>
                           <div class="address-default-btn-group">
                              <div class="icon-group-listing"> <span> <i class="fa-solid fa-angle-down accordion-toggle" data-bs-toggle="collapse" data-bs-target="#demo1"> </i> </span> <span> <i class="fas fa-pen-nib"></i> </span> <span> <i class="fa fa-trash" aria-hidden="true"></i> </span> </div>
                           </div>
                        </div>
                     </div>
                     <div class="consultancy-form-col"> <input type="date" class="w-100"> </div>
                     <div class="consultancy-form-col"> <input type="date" class="w-100"> </div>
                     <div class="consultancy-form-col">
                        <select>
                           <option> Select Client </option>
                           <option> Select Client </option>
                        </select>
                     </div>
                     <div class="consultancy-form-col">
                        <select>
                           <option> Select Employment Status </option>
                        </select>
                     </div>
                     <div class="consultancy-form-col">
                        <select>
                           <option> Select Holiday Profile </option>
                        </select>
                     </div>
                  </div>
                  <h3>Designation</h3>
                  <div class="form-row-consultancy">
                     <div class="consultancy-form-col">
                        <select>
                           <option> Designation * </option>
                           <option> Designation </option>
                        </select>
                     </div>
                  </div>
                  <h3>User Credentials</h3>
                  <div class="form-row-consultancy">
                     <div class="consultancy-form-col"> <input type="email" placeholder="User Id / Email *"> </div>
                     <div class="consultancy-form-col">
                        <div class="reset-password"> <input type="checkbox"> <label> Reset Password </label> </div>
                     </div>
                  </div>
               </div>
               <div class="hj-add-address-screen">
                  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel"> <img src="{{ asset('public/assets/images/location-icon.png')}}" class="img-fluid"> Add Address </h5>
                              <button aria-label="Close"> <img src="{{ asset('public/assets/images/close-btn-address-popup.png')}}" class="img-fluid" data-bs-dismiss="modal"> </button> 
                           </div>
                           <div class="modal-body">
                              <div class="row">
                                 <div class="col-lg-8">
                                    <h3>Address Information</h3>
                                    <div class="address-single-col">
                                       <select>
                                          <option> Address Type </option>
                                       </select>
                                    </div>
                                    <div class="address-form-popup">
                                       <div class="address-form-col">
                                          <select>
                                             <option> Country * </option>
                                          </select>
                                       </div>
                                       <div class="address-form-col"> <input type="text" placeholder="Postal Code *" id="postal-code"> </div>
                                       <div class="address-form-col"> <input type="text" placeholder="Apartment Name / Street Name *"> </div>
                                       <div class="address-form-col address-form-col-group"> <input type="num" placeholder="Unit Number"> <input type="text" placeholder="Land Mark"> </div>
                                       <div class="address-form-col"> <input type="text" placeholder="Town / Area * "> </div>
                                       <div class="address-form-col"> <input type="text" placeholder="City / District *"> </div>
                                       <div class="address-form-col">
                                          <select>
                                             <option> State / Province * </option>
                                          </select>
                                       </div>
                                       <div class="address-form-col google-map-plus-field"> <input type="text" placeholder="Google map plus code" id="google-map-field"> </div>
                                       <div class="bottom-address-form-row">
                                          <div class="set-default-address"> <input type="checkbox"> <label>Set as Default</label> </div>
                                          <div class="address-form-btn-group">
                                             <ul>
                                                <li> <a href="#"> Cancel </a> </li>
                                                <li> <a href="#"> Save </a> </li>
                                                <li> <a href="#"> Confirm </a> </li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-4">
                                    <div class="address-popup-right-col">
                                       <h4>Address</h4>
                                       <div class="default-address d-none">
                                          <div class="default-address-badge">
                                             <i class="fa-solid fa-location-dot"></i> 
                                             <h6>Default</h6>
                                          </div>
                                          <div class="address-text-col-popup">
                                             <div class="address-default-text">
                                                <p> Design Avenue , #765, av super mall ( near ), Singapore - 569933 </p>
                                             </div>
                                             <div class="address-default-btn-group">
                                                <div class="icon-group-listing"> <span> <i class="fa-solid fa-angle-down accordion-toggle" data-bs-toggle="collapse" data-bs-target="#demo1"> </i> </span> <span> <i class="fas fa-pen-nib"></i> </span> <span> <i class="fa fa-trash" aria-hidden="true"></i> </span> </div>
                                             </div>
                                          </div>
                                          <div class="default-copy-address">
                                             <img src="{{ asset('public/assets/images/icon-c.png')}}" class="img-fluid"> 
                                             <h5>W772+M6 Chennai, Tamil Nadu</h5>
                                             <img src="{{ asset('public/assets/images/icon-c1.png')}}" class="img-fluid"> 
                                          </div>
                                       </div>
                                       <div class="blank-address-content">
                                          <img src="{{ asset('public/assets/images/no-data-2.png')}}" class="img-fluid"> 
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
      -->
   <form id="addConsultantFormData" enctype="multipart/form-data">
      <div id="addConsultantForm" style="display: none;">
         <div class="hj-add-consultancy-screen add-consulatant-add px-3">
            <div class="mt-2">
               <div class="row">
                  <div class="col-lg-4 d-flex align-items-center">
                     <h2>Add Consultants </h2>
                  </div>
                  <div class="col-lg-8">
                     <div class="add-consultancy-btn-group">
                        <ul>
                           <li>
                              <a href="javascript:void(0);" onclick="showConsultantList();">
                              <img src="{{ asset('public/assets/images/back-arrow.png') }}" class="img-fluid">
                              Back to List
                              </a>
                           </li>
                           <li>
                              <a href="#"><img src="{{ asset('public/assets/images/clear-icon.png')}}" class="img-fluid"> Clear</a>
                           </li>
                           <li>
                              <a href="#" onclick="submitAddConsultantForm();">
                              <img src="{{ asset('public/assets/images/save-icon.png')}}" class="img-fluid"> Save
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="row add-consultancy-form">
                  <div class="col-lg-12">
                     <h3>General &amp; Contact Information</h3>
                     <div class="form-row-consultancy">
                        <div class="consultancy-form-col"><input type="text" name="emp_name" placeholder="Name *"></div>
                        <div class="consultancy-form-col"><input type="text" name="emp_code" placeholder="Employee Code"></div>
                        <div class="consultancy-form-col sex-option-wrap">
                           <label>Sex : </label>
                           <span>
                           <input type="radio" name="sex" value="Male" onchange="toggleOtherGender(this)" checked>
                           <label>Male<b style="color: blue; font-weight: 800;">&#9794;</b></label>
                           </span>
                           <span>
                           <input type="radio" name="sex" value="Female" onchange="toggleOtherGender(this)">
                           <label>Female</label>
                           </span>
                           <span>
                           <input type="radio" name="sex" value="Others" onchange="toggleOtherGender(this)">
                           <label>Others</label>
                           </span>
                        </div>
                        <div class="consultancy-form-col" id="otherGenderWrapper" style="display: none;">
                           <input type="text" name="other_gender" id="otherGenderInput" placeholder="Specify Gender *" class="w-100">
                        </div>
                        <div class="consultancy-form-col"><label>Date Of Birth :</label><input type="date" name="dob"></div>
                        <div class="consultancy-form-col telephone-form-col"><input type="tel" name="mobile_number" placeholder="Mobile Number"></div>
                        <div class="consultancy-form-col"><input type="email" name="email" placeholder="Email Address"></div>
                        <!-- Upload Input -->
                        <div class="consultancy-form-col upload-pic-col">
                           <input type="file" id="profile_image" name="profile_image" accept="image/*" onchange="previewUploadedProfile(this)" hidden>
                           <label for="profile_image" class="upload-btn-box">
                           <i class="fa fa-upload"></i> Upload Profile Picture<br>
                           *Recommended Minimum Resolution 512 x 512 px. (Max.file size: 1MB)
                           </label>
                        </div>
                        <!-- Always Visible Preview Box -->
                        <div class="consultancy-form-col">
                           <div id="imagePreviewBox" class="image-preview-box">
                              <label>Profile Picture Preview</label>
                              <p>*rxmed.png size : 512kb</p>
                           </div>
                        </div>
                        <!-- Lightbox Modal -->
                        <div class="modal fade" id="lightboxModal" tabindex="-1" aria-labelledby="lightboxLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content bg-transparent border-0 position-relative">
                                 <!-- Close Button -->
                                 <button type="button" class="btn-close btn-white position-absolute top-0 end-0 m-3 z-3" 
                                    data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1); z-index: 1056;">
                                 </button>
                                 <!-- Image Content -->
                                 <div class="modal-body text-center p-0">
                                    <img id="lightboxImage" src="" class="img-fluid rounded shadow" alt="Preview">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="consultancy-form-col add-address-col" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                           <i class="fa-solid fa-house"></i>
                           <p>Add Address</p>
                        </div>
                        <div class="consultancy-form-col consultancy-form-address-feed-form">
                           <div class="default-address-badge">
                              <i class="fa-solid fa-location-dot"></i>
                              <h6>Default</h6>
                           </div>
                           <div class="address-text-col-popup">
                              <div class="address-default-text">
                                 <p> Design Avenue , #765, av super mall ( near ), Singapore - 569933 </p>
                              </div>
                              <div class="address-default-btn-group">
                                 <div class="icon-group-listing">
                                    <span><i class="fa-solid fa-angle-down accordion-toggle" data-bs-toggle="collapse" data-bs-target="#demo1"></i></span>
                                    <span><i class="fas fa-pen-nib"></i></span>
                                    <span><i class="fa fa-trash" aria-hidden="true"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
<div class="consultancy-form-col">
    <input type="date" name="joining_date" id="joining_date" class="form-control w-100" placeholder="Start Date / Joining Date">
</div>

<div class="consultancy-form-col">
    <input type="date" name="resignation_date" id="resignation_date" class="form-control w-100" placeholder="Select Expire / Last working date">
</div>


                        <div class="consultancy-form-col">
                           <select name="client_id">
                              <option value="">Select Client</option>
                              <!-- dynamically filled -->
                           </select>
                        </div>
                        <div class="consultancy-form-col">
                           <select name="status">
                              <option value="">Select Employment Status</option>
                              <option value="Active">Active</option>
                              <option value="Inactive">Inactive</option>
                              <option value="Notice">Notice Period</option>
                           </select>
                        </div>
                        <div class="consultancy-form-col">
                           <select name="holiday_profile">
                              <option value="">Select Holiday Profile</option>
                           </select>
                        </div>
                     </div>
                     <h3>Designation</h3>
                     <div class="form-row-consultancy">
                        <div class="consultancy-form-col">
                           <select name="designation">
                              <option value="">Designation *</option>
                           </select>
                        </div>
                     </div>
                     <h3>User Credentials</h3>
                     <div class="form-row-consultancy">
                        <div class="consultancy-form-col"><input type="email" name="login_email" placeholder="User Id / Email *"></div>
                        <div class="consultancy-form-col">
                           <div class="reset-password">
                              <input type="checkbox" name="reset_password" value="1"> <label> Reset Password </label>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </form>
   <script>
      function toggleOtherGender(el) {
          const value = el.value;
          const otherWrapper = document.getElementById('otherGenderWrapper');
          const input = document.getElementById('otherGenderInput');
      
          if (value === 'Others' && el.checked) {
              otherWrapper.style.display = 'block';
          } else {
              otherWrapper.style.display = 'none';
              input.value = '';
          }
      }
      
      function submitAddConsultantForm() {
          const formData = new FormData(document.getElementById("addConsultantFormData"));
          $.ajax({
              url: '',
              type: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              success: function (response) {
                  alert('Consultant added successfully!');
                  showConsultantList();
              },
              error: function (xhr) {
                  alert('Error occurred while saving consultant.');
              }
          });
      }
   </script>
</div>
<script>
   function showAddConsultantForm() {
       document.getElementById('consultantListView').style.display = 'none';
       document.getElementById('addConsultantForm').style.display = 'block';
   }
   
   function showConsultantList() {
       document.getElementById('addConsultantForm').style.display = 'none';
       document.getElementById('consultantListView').style.display = 'block';
   }
</script>
<style>
   .upload-btn-box {
   display: inline-block;
   border: 1px solid #ccc;
   padding: 10px 20px;
   cursor: pointer;
   border-radius: 6px;
   color: #555;
   background: #fff;
   font-weight: 500;
   transition: all 0.2s ease-in-out;
   }
   .upload-btn-box:hover {
   background-color: #f5f5f5;
   }
   .image-preview-box {
   border: 2px dashed #bbb;
   color: #444;
   font-weight: 600;
   text-align: center;
   padding: 16px;
   border-radius: 10px;
   cursor: default;
   width: 100%;
   }
   .image-preview-box.active {
   border-color: green;
   color: green;
   }
   .upload-pic-col label {
   font-size: 7px !important;
   line-height: normal;
   position: absolute;
   top: 10px;
   left: 0;
   }
   .upload-btn-box {
   display: inline-block;
   border: 1px solid #ccc;
   padding: 10px 20px;
   cursor: pointer;
   border-radius: 6px;
   color: #555;
   background: #fff;
   font-weight: 500;
   }
   .image-preview-box {
   border: 2px dashed #bbb;
   color: #444;
   font-weight: 600;
   text-align: center;
   padding: 16px;
   border-radius: 10px;
   cursor: default;
   transition: 0.3s ease;
   }
   .image-preview-box.active {
   border-color: green;
   color: green;
   cursor: pointer;
   }
   .btn-close-white {
   filter: brightness(0) invert(1) !important;
   z-index: 1056 !important;
   }
</style>
<script>
   function previewUploadedProfile(input) {
       if (input.files && input.files[0]) {
           const reader = new FileReader();
           reader.onload = function () {
               const previewBox = document.getElementById('imagePreviewBox');
               previewBox.classList.add('active');
               previewBox.innerHTML = `
                   <label>Profile Picture Preview</label>
                   <p>Click to view uploaded image</p>
               `;
               previewBox.onclick = function () {
                   document.getElementById('lightboxImage').src = reader.result;
                   const modal = new bootstrap.Modal(document.getElementById('lightboxModal'));
                   modal.show();
               };
           };
           reader.readAsDataURL(input.files[0]);
       }
   }
   
   
</script>