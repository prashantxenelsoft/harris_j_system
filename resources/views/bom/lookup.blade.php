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
          <input type="text" placeholder="Search">
        </div>

        <div class="vertical-tabs-switches">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
           


            <button class="nav-link active" id="v-pills-system-tab" data-bs-toggle="pill" data-bs-target="#v-pills-system" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
              <i class="fa-solid fa-sliders"></i>
              System Properties
            </button>


            <button class="nav-link " id="v-pills-roles-tab" data-bs-toggle="pill" data-bs-target="#v-pills-roles" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">
              <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                <path d="M1.1,10.759a4.943,4.943,0,0,1,1-1.975L9.012,1.2A3.985,3.985,0,0,1,11,0V13.662Zm11.9,2.9,9.888-2.9a5.068,5.068,0,0,0-1.016-2L14.994,1.206A4,4,0,0,0,13,0Zm-2,2.085L1,12.815a5.079,5.079,0,0,0,1.127,2.433l6.9,7.538A3.994,3.994,0,0,0,11,23.987Zm2,0V24a3.97,3.97,0,0,0,2.01-1.209l6.9-7.582A4.966,4.966,0,0,0,23,12.813Z"></path>
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
                            <div class="col-md-12">
                              <table class="table table-condensed table-striped" id="lookupTable">
                                <thead>
                                  <tr>
                                    <th>Property Name</th>
                                    <th>Property Description</th>
                                    <th>Property Description</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>

                                <tbody>
                                      @foreach($bom_static_settings as $setting)
                                      @php
                                          $lookup = json_decode($setting->lookup_header);
                                      @endphp
                                      <tr data-color="{{ $lookup->color ?? '#ffffff' }}"> 
                                          <td>{{ $lookup->property_name }}</td>
                                          <td>{{ $lookup->property_description }}</td>
                                          <td>
                                              <span class="{{ $lookup->status ? 'active-badge' : 'inactive-badge' }}">
                                                  {{ $lookup->status ? 'Active' : 'Inactive' }}
                                              </span>
                                          </td>
                                          <td>
                                              <div class="icon-group-listing">
                                                  <span onclick="editRecordLookupHeader({{ $setting->id }})">
                                                      <i class="fas fa-pen-nib"></i>
                                                  </span>
                                                  <span onclick="deleteRecordLookupHeader({{ $setting->id }})">
                                                      <i class="fa fa-trash" aria-hidden="true"></i>
                                                  </span>
                                              </div>
                                          </td>
                                      </tr>
                                      @endforeach
                                  </tbody>

                              </table>
                            </div>
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
                              <li>
                                <a href="#" id="clearBtn" class="disabled-btn">Clear</a>
                              </li>
                              <li>
                                <a href="#" id="saveBtn" class="active-btn">Save</a>
                              </li>
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
                            <div class="col-md-12">
                                <table class="table table-condensed table-striped" id="lookupTableOption">
                                    <thead>
                                        <tr>
                                            <th>Option Name</th>
                                            <th>Option Description</th>
                                            <th>Status</th>
                                            <th>Option Value</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                      @foreach ($bom_static_settings_header_option as $option)
                                          @php
                                              $data = json_decode($option->lookup_option, true);
                                          @endphp
                                          <tr data-property-name="{{ $data['property_name'] ?? '' }}"
                                              data-sequence="{{ $data['sequence'] ?? '' }}"
                                              data-visibility="{{ $data['visibility'] ?? '' }}"
                                              data-color="{{ $data['color_hex'] ?? '#ffffff' }}">
                                              <td>{{ $data['option_name'] ?? '-' }}</td>
                                              <td>{{ $data['option_description'] ?? '-' }}</td>
                                              <td>
                                                  @if(isset($data['status']) && $data['status'] == 1)
                                                      <span class="active-badge">Active</span>
                                                  @else
                                                      <span class="inactive-badge">Inactive</span>
                                                  @endif
                                              </td>
                                              <td>{{ $data['option_value1'] ?? '-' }}</td>
                                              <td>
                                                  <div class="icon-group-listing">
                                                      <span onclick="editRecordLookupOption({{ $option->id }})">
                                                          <i class="fas fa-pen-nib"></i>
                                                      </span>
                                                      <span onclick="deleteRecordLookupOption({{ $option->id }})">
                                                          <i class="fa fa-trash" aria-hidden="true"></i>
                                                      </span>
                                                  </div>
                                              </td>
                                          </tr>
                                      @endforeach
                                    </tbody>
                                </table>

                            </div>
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
                                        <div class="color-picker-col-lookup" style="float:right;">
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
                                    <ul>
                                        <li><a href="#" id="cancelButton">Cancel</a></li>
                                        <li><a href="#" id="saveButton">Save</a></li>
                                        <!-- <li><a href="#" id="saveAddButton">Save &amp; Add</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>


          </div>


          <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>

        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $("#saveBtn").click(function (e) {
            e.preventDefault();

            // Remove previous error borders
            $("#property_name, #property_description").css("border", "");

            // Get values
            let propertyName = $("#property_name").val().trim();
            let propertyDescription = $("#property_description").val().trim();
            let status = $("#status").is(":checked") ? 1 : 0;
            let color = $("#colorPicker").val();
            let edit_id = $("#edit_id").val();

            let isValid = true;

            // Validation check
            if (propertyName === "") {
                $("#property_name").css("border", "1px solid red");
                isValid = false;
            }

            if (propertyDescription === "") {
                $("#property_description").css("border", "1px solid red");
                isValid = false;
            }

            if (edit_id) {
                isValid = false;
            }

            if (!isValid) {
                return;
            }

            $.ajax({
                url: "{{ route('lookup.store') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    property_name: propertyName,
                    property_description: propertyDescription,
                    status: status,
                    color: color,
                },
                success: function (response) {
                    //console.log(response);
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        confirmButtonColor: "#3085d6",
                    });

                    // Naya row ka HTML create karna
                    let newRow = `
                    <tr data-color=${color}>
                        <td>${response.property_name}</td>
                        <td>${response.property_description}</td>
                        <td>
                            <span class="${response.status ? "active-badge" : "inactive-badge"}">
                                ${response.status ? "Active" : "Inactive"}
                            </span>
                        </td>
                        <td>
                            <div class="icon-group-listing">
                                <span onclick="editRecordLookupHeader(${response.id})">
                                    <i class="fas fa-pen-nib"></i>
                                </span>
                                <span onclick="deleteRecordLookupHeader(${response.id})">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </span>
                            </div>
                        </td>
                    </tr>`;

                    // Sirf `#lookupTable` ke top pe new row add karega
                    $("#lookupTable tbody").prepend(newRow);

                    // Form reset karna
                    $("#lookupForm")[0].reset();
                    $("#colorCode").text("#ffffff"); // Reset color preview
                },
                error: function (xhr) {
                    alert("Error saving data.");
                },
            });
        });

        // Clear Button Functionality
        $("#clearBtn").click(function (e) {
            e.preventDefault();
            $("#lookupForm")[0].reset();
            $("#property_name, #property_description").css("border", ""); // Remove red border
            $("#colorCode").text("#ffffff"); // Reset color preview
        });

        // Color Picker Updates Hex Code
        $("#colorPicker").on("input", function () {
            $("#colorCode").text($(this).val());
        });

        // Remove red border when clicking on input field
        $("#property_name, #property_description").on("click", function () {
            $(this).css("border", "");
        });
    });

    function editRecordLookupHeader(id) {
        let row = $(`span[onclick='editRecordLookupHeader(${id})']`).closest("tr");

        let propertyName = row.find("td:eq(0)").text().trim();
        let propertyDescription = row.find("td:eq(1)").text().trim();
        let statusText = row.find("td:eq(2) span").text().trim();
        let status = statusText === "Active" ? 1 : 0;
        let color = row.attr("data-color") || "#ffffff";

        $("#property_name").val(propertyName);
        $("#property_description").val(propertyDescription);
        $("#status").prop("checked", status);
        $(".onoff").text(status ? "Active" : "Inactive");

        $("#colorPicker").val(color);
        $("#colorCode").text(color);

        // Hidden field for edit mode
        $("#lookupForm").append(`<input type="hidden" id="edit_id" value="${id}">`);

        $("#saveBtn").text("Update").attr("onclick", "updateLookupHeader()");
    }

    function deleteRecordLookupHeader(id) {
      if (confirm("Are you sure you want to delete this record?")) {
          $.ajax({
              url: "{{ route('lookup-header.destroy', ':id') }}".replace(':id', id),
              type: "DELETE",
              data: {
                  _token: "{{ csrf_token() }}"
              },
              success: function(response) {
                  if (response.success) {
                      Swal.fire({
                          icon: "success",
                          title: "Deleted Successfully!",
                          confirmButtonColor: "#3085d6",
                      });

                      // Table se row remove karne ke liye
                      $("tr").filter(function() {
                          return $(this).find("span[onclick='deleteRecordLookupHeader(" + id + ")']").length > 0;
                      }).remove();
                  } else {
                      alert("Something went wrong!");
                  }
              },
              error: function(xhr) {
                  alert("Error: " + xhr.responseText);
              }
          });
      }
    }


    function updateLookupHeader() {
        let isValid = true;

        // Validation check
        if ($("#property_name").val().trim() === "") {
            $("#property_name").css("border", "1px solid red");
            isValid = false;
        }

        if ($("#property_description").val().trim() === "") {
            $("#property_description").css("border", "1px solid red");
            isValid = false;
        }

        if (!isValid) {
            return;
        }

        let id = $("#edit_id").val();
        let propertyName = $("#property_name").val();
        let propertyDescription = $("#property_description").val();
        let status = $("#status").prop("checked") ? 1 : 0;
        let color = $("#colorPicker").val();

        $.ajax({
            url: "{{ route('lookup.update') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                property_name: propertyName,
                property_description: propertyDescription,
                status: status,
                color: color,
            },
            success: function (response) {
                //console.log("check update response",response.data.property_description);
                Swal.fire({
                    icon: "success",
                    title: "Updated Successfully!",
                    confirmButtonColor: "#3085d6",
                });

                // Table row update
                let row = $(`span[onclick='editRecordLookupHeader(${id})']`).closest("tr");
                row.find("td:eq(0)").text(propertyName);
                row.find("td:eq(1)").text(propertyDescription);
                row.find("td:eq(2) span")
                    .text(status ? "Active" : "Inactive")
                    .removeClass("active-badge inactive-badge")
                    .addClass(status ? "active-badge" : "inactive-badge");

                row.attr("data-color", color); // Color attribute update

                // Form reset
                $("#lookupForm")[0].reset();
                $("#edit_id").remove();
                $("#saveBtn").text("Save");
                $("#colorCode").text("#ffffff"); // Reset color preview
            },
            error: function () {
                alert("Error updating data.");
            },
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.querySelector(".search-bar-lookup input");
        const tableRows = document.querySelectorAll("#lookupTable tbody tr");

        searchInput.addEventListener("keyup", function () {
            const searchText = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                let textFound = false;
                row.querySelectorAll("td").forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchText)) {
                        textFound = true;
                    }
                });

                row.style.display = textFound ? "" : "none";
            });
        });
    });

</script>
<script>
    $(document).ready(function () {
      $("#property_name_Option, #option_name_Option, #option_description_Option, #option_value1_Option, #Sequence_Option, #color_Option").on("focus", function () {
          $(this).css("border", "");
      });
        // Update color code text when color picker changes
        $("#color_Option").on("input", function () {
            $("#colorCodeOption").text($(this).val());
        });

        // Toggle Status Text (Active/Inactive)
        $("#status_Option").change(function () {
            $(this).siblings(".onoff").text(this.checked ? "Active" : "Inactive");
        });

        // Toggle Visibility Text (Show/Hide)
        $("#visibility_Option").change(function () {
            $(this).siblings(".onoff").text(this.checked ? "Show" : "Hide");
        });

        // Function to save form data
        function saveLookupOption() {
            let isValid = true;
            let fields = ["#property_name_Option", "#option_name_Option", "#option_description_Option", "#option_value1_Option", "#Sequence_Option"];

            fields.forEach(field => {
                if ($(field).val().trim() === "") {
                    $(field).css("border", "1px solid red");
                    isValid = false;
                }
            });
            let edit_id = $("#edit_id_option").val();

            if (edit_id) {
                isValid = false;
            }

            if (!isValid) return;

            let formData = {
                _token: "{{ csrf_token() }}",
                property_name: $("#property_name_Option").val().trim(),
                option_name: $("#option_name_Option").val().trim(),
                option_description: $("#option_description_Option").val().trim(),
                option_value1: $("#option_value1_Option").val().trim(),
                sequence: $("#Sequence_Option").val().trim(),
                color_hex: $("#color_Option").val(),
                status: $("#status_Option").is(":checked") ? 1 : 0,
                visibility: $("#visibility_Option").is(":checked") ? 1 : 0
            };

            //console.log("check form data option",formData);

            $.post("{{ route('lookup_option.store') }}", formData, function(response) {
                Swal.fire({ icon: "success", title: "Saved Successfully!", confirmButtonColor: "#3085d6" });

                $("#lookupTableOption tbody").prepend(`
                    <tr data-property-name="${$("#property_name_Option").val().trim()}" data-sequence="${$("#Sequence_Option").val().trim()}" data-visibility="${$("#visibility_Option").is(":checked") ? 1 : 0}" data-color=${$("#color_Option").val()}>
                        <td>${response.option_name ?? '-'}</td>
                        <td>${response.option_description ?? '-'}</td>
                        <td><span class="${response.status == 1 ? 'active-badge' : 'inactive-badge'}">${response.status == 1 ? 'Active' : 'Inactive'}</span></td>
                        <td>${response.option_value1 ?? '-'}</td>
                        <td>
                            <div class="icon-group-listing">
                                <span onclick="editRecordLookupOption(${response.id})">
                                    <i class="fas fa-pen-nib"></i>
                                </span>
                                <span onclick="deleteRecordLookupOption(${response.id})">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </span>
                            </div>
                        </td>
                    </tr>
                `);

                $("#lookupOptionForm")[0].reset();
                $("#colorCodeOption").text("#ffffff");
                $(".onoff").text("Inactive").text("Show");
            }).fail(() => alert("Error saving data."));
        }


        // Save Button Click
        $("#saveButton").click(function (e) {
            e.preventDefault();
            saveLookupOption();
        });

        // Cancel Button Click (Resets Form)
        $("#cancelButton").click(function (e) {
            e.preventDefault();
            $("#lookupOptionForm")[0].reset();
            $("#colorCode").text("#ffffff"); // Reset color code
            $(".onoff").text("Inactive"); // Reset Status
            $(".onoff").text("Show"); // Reset Visibility
        });

        // Remove error border on focus
        $(document).on("click", "input", function () {
            $(this).removeClass("error");
        });
    });

    function deleteRecordLookupOption(id) {
      if (confirm("Are you sure you want to delete this record?")) {
          $.ajax({
              url: "{{ route('lookup-header.destroy', ':id') }}".replace(':id', id),
              type: "DELETE",
              data: {
                  _token: "{{ csrf_token() }}"
              },
              success: function(response) {
                  if (response.success) {
                      Swal.fire({
                          icon: "success",
                          title: "Deleted Successfully!",
                          confirmButtonColor: "#3085d6",
                      });

                      // Table se row remove karne ke liye
                      $("tr").filter(function() {
                          return $(this).find("span[onclick='deleteRecordLookupOption(" + id + ")']").length > 0;
                      }).remove();
                      $("#lookupOptionForm")[0].reset();
                      $("#colorCodeOption").text("#ffffff");
                  } else {
                      alert("Something went wrong!");
                  }
              },
              error: function(xhr) {
                  alert("Error: " + xhr.responseText);
              }
          });
      }
    }

    function editRecordLookupOption(id) {
        let row = $(`span[onclick='editRecordLookupOption(${id})']`).closest("tr");

        // Extract data from the row
        let optionName = row.find("td:eq(0)").text().trim();
        let optionDescription = row.find("td:eq(1)").text().trim();
        let statusText = row.find("td:eq(2) span").text().trim();
        let status = statusText === "Active" ? 1 : 0;
        let optionValue1 = row.find("td:eq(3)").text().trim();

        // Extract additional hidden data from data- attributes
        let propertyName = row.data("property-name") || "";
        let sequence = row.data("sequence") || "";
        let visibility = row.data("visibility") == "1" ? true : false;
        let color = row.data("color") || "#ffffff";

        // Fill the form fields with extracted values
        $("#property_name_Option").val(propertyName);
        $("#option_name_Option").val(optionName);
        $("#option_description_Option").val(optionDescription);
        $("#option_value1_Option").val(optionValue1);
        $("#Sequence_Option").val(sequence);
        $("#color_Option").val(color);
        $("#colorCodeOption").text(color);
        $("#status_Option").prop("checked", status);
        $(".onoff").text(status ? "Active" : "Inactive");
        $("#visibility_Option").prop("checked", visibility);
        $(".visibility-onoff").text(visibility ? "Show" : "Hide");

        // Store the ID for update operation
        if (!$("#lookupOptionForm").find("#edit_id_option").length) {
            $("#lookupOptionForm").append(`<input type="hidden" id="edit_id_option" value="${id}">`);
        } else {
            $("#edit_id_option").val(id);
        }
        $("#saveButton").text("Update").attr("onclick", "updateLookupOption()");
    }

    function updateLookupOption() {
        // Get the form data
        let formData = {
            id: $("#edit_id_option").val(),
            property_name: $("#property_name_Option").val(),
            option_name: $("#option_name_Option").val(),
            option_description: $("#option_description_Option").val(),
            option_value1: $("#option_value1_Option").val(),
            sequence: $("#Sequence_Option").val(),
            color: $("#color_Option").val(),
            status: $("#status_Option").prop("checked") ? 1 : 0,
            visibility: $("#visibility_Option").prop("checked") ? 1 : 0,
        };

        $.ajax({
            url: '/update-lookup-option', // Your route URL to handle the update request
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Get CSRF token from meta tag
            },
            data: formData, // Send form data
            success: function(response) {
                //console.log("Response from server:", response);  // Debugging response
                if (response.success) {
                  Swal.fire({
                      icon: "success",
                      title: "Updated Successfully!",
                      confirmButtonColor: "#3085d6",
                  });
                  let row = $(`span[onclick='editRecordLookupOption(${formData.id})']`).closest("tr");

                  // Update the data in the table row
                  row.find("td:eq(0)").text(response.data.option_name); // Update Option Name
                  row.find("td:eq(1)").text(response.data.option_description); // Update Option Description
                  row.find("td:eq(2) span")
                      .text(response.data.status === 1 ? "Active" : "Inactive")
                      .removeClass("active-badge inactive-badge")
                      .addClass(response.data.status === 1 ? "active-badge" : "inactive-badge"); // Update Status

                  row.find("td:eq(3)").text(response.data.option_value1); // Update Option Value
                  row.attr("data-color", response.data.color); // Update the Color Attribute

                    // Optionally close the modal or reset the form
                    $("#lookupOptionForm")[0].reset();
                    $("#edit_id_option").remove(); // Remove the hidden ID field
                    $("#saveButton").text("Save");
                } else {
                    alert('Error updating the option!');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // This function will catch errors
                console.log("AJAX Error: ", jqXHR);  // View complete error response object
                console.log("Text Status: ", textStatus);  // Status of the request (e.g., "timeout", "error", etc.)
                console.log("Error Thrown: ", errorThrown);  // Error details
                alert('Something went wrong. Please try again.');
            }
        });

    }



</script>


