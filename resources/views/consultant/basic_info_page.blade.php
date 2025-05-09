@extends('layouts.custom_layout') 
@section('content')

<section class="basic-info-page-wrapper py-3 d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="basic-info-right-col">
                    <h2>Basic Information</h2>
                    <p>Please fill out following details to proceed further</p>

                    <form name="basicInfoForm" method="POST" action="{{ route('consultant.update.basic.details') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $consultant->id }}">

                        <!-- Upload Profile Image -->
                        <div class="basic-info-upload-image">
                            <label for="profileImage" style="cursor: pointer;">
                                <div class="basic-info-image-upload-box">
                                    <img id="profilePreview" 
                                         src="{{ $consultant->profile_image ? asset('storage/app/public/' . $consultant->profile_image) : asset('public/assets/latest/images/upload-image-basic-info.png') }}" 
                                         class="img-fluid"
                                         style="object-fit: cover; width: 82px; height: 82px; border-radius: 50%; box-shadow: 0 0 8px rgba(0,0,0,0.2);" />
                                </div>
                            </label>
                            <input type="file" id="profileImage" name="profile_image" accept="image/jpeg,image/jpg,image/png" hidden>
                            <label for="profileImage" style="cursor: pointer;">Upload Profile Image</label>
                        </div>

                        <!-- Name Fields -->
                        <div class="basic-info-row name-row-basic-info">
                            <input type="text" name="first_name" placeholder="First Name" required value="{{ old('first_name', $consultant->first_name) }}">
                            <input type="text" name="middle_name" placeholder="Middle Name" value="{{ old('middle_name', $consultant->middle_name) }}">
                            <input type="text" name="last_name" placeholder="Last Name" required value="{{ old('last_name', $consultant->last_name) }}">
                        </div>

                        <!-- DOB -->
                        <div class="basic-info-row-dob">
                            <label for="dob">Date of birth</label>
                            <input type="date" id="dob" name="dob" required value="{{ old('dob', \Carbon\Carbon::parse($consultant->dob)->format('Y-m-d')) }}">
                        </div>

                        <!-- Other Fields -->
                        <div class="basic-info-row">
                            <input type="text" name="citizen" placeholder="Citizen/SPR/EP" required value="{{ old('citizen_status', $consultant->citizen) }}">
                        </div>

                        <div class="basic-info-row">
                            <input type="text" name="nationality" placeholder="Nationality" required value="{{ old('nationality', $consultant->nationality) }}">
                        </div>

                        <div class="basic-info-row">
                            <input type="text" name="address_by_user" placeholder="Address" required value="{{ old('address', $consultant->address_by_user) }}">
                        </div>

                        <div class="basic-info-row">
                            <input type="text" name="mobile_number" placeholder="Contact No." required pattern="[0-9]{10,15}" value="{{ old('contact_no', $consultant->mobile_number) }}">
                        </div>

                        <!-- Upload Resume -->
                        <div class="basic-info-row-upload-file">
                            <input type="file" name="resume_file" id="resume-upload" accept=".pdf,.csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,image/jpeg,image/jpg,image/png" hidden>
                            <label for="resume-upload" class="upload-label">
                                <span>Upload Resume</span>
                                <img src="{{ asset('public/assets/latest/images/small-upload.png') }}" alt="Upload Icon" class="upload-icon">
                            </label>

                            @if ($consultant->resume_file)
                                <div class="preview_link" style="margin-top: 5px;">
                                    <a href="{{ asset('storage/app/public/' . $consultant->resume_file) }}" target="_blank" style="text-decoration: underline; color:darkred;">Preview</a>
                                </div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="basic-info-row">
                            <button type="submit" class="btn btn-danger w-100">GO !</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Profile Image Preview Script -->
<script>
    document.getElementById('profileImage').addEventListener('change', function (event) {
        const reader = new FileReader();
        reader.onload = function () {
            const img = document.getElementById('profilePreview');
            img.src = reader.result;
            img.style.width = "82px";
            img.style.height = "82px";
            img.style.objectFit = "cover";
            img.style.borderRadius = "50%";
            img.style.boxShadow = "0 0 8px rgba(0,0,0,0.2)";
        };

        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>

@endsection
