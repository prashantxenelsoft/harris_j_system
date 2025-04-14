@extends('layouts.custom_layout') @section('content')
<!-- Add Consultancy Form (Initially Hidden) -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('public/assets/latest/js/country-state-data.js') }}"></script>
<section class="bom-screen-parent">
    <header class="bom-header">
        <div class="container">
            <div class="row py-2">
                <div class="col-lg-2">
                    <div class="header-logo">
                        @php use Illuminate\Support\Facades\Storage; $logo = optional($consultancy)->consultancy_logo; @endphp @if($logo && Storage::disk('public')->exists($logo))
                        <img src="{{ asset('storage/' . $logo) }}" alt="Consultancy Logo" width="60" />
                        @endif
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="tabs-bom">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="user-management-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">User Management</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#Clients" type="button" role="tab" aria-controls="contact" aria-selected="false">Clients</button>
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
                                    const action = selectedOption.getAttribute("data-url");

                                    if (action === "logout") {
                                        document.getElementById("logout-form").submit(); // submit logout form
                                    } else if (action && action !== "#") {
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
                    <div class="tab-pane fade" id="home" role="tabpanel">
                        <p>Dashboard Section</p>
                    </div>

                    <div class="tab-pane fade show active" id="profile" role="tabpanel">
                        @include('consultancy.user-management')
                    </div>

                    <div class="tab-pane fade" id="Clients" role="tabpanel">
                        @include('consultancy.client')
                    </div>

                    <div class="tab-pane fade" id="reports" role="tabpanel">
                        <p>Reports Section</p>
                    </div>

                    <div class="tab-pane fade" id="static-settings" role="tabpanel">
                        <p>Static settings Section</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- jQuery -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $(".show-add-user-form").on("click", function (e) {
            $(".table-bom-list-section").hide();
            $(".filter-section-consultancy").hide();
            // e.preventDefault();
            $(".add-user-form-section").show(); // use toggle() if you don’t want slide effect
        });

        $("#user-management-tab").on("click", function (e) {
            $(".table-bom-list-section").show();
            $(".filter-section-consultancy").show();
            $(".add-user-form-section").hide();
        });

        $(".show-add-client-form").on("click", function (e) {
            $(".client-list-consultancy-flow").hide();
            $(".filter-client-section-consultancy").hide();
            // e.preventDefault();
            $(".add-clinet-form-section").show(); // use toggle() if you don’t want slide effect
        });

        $("#contact-tab").on("click", function (e) {
            $(".client-list-consultancy-flow").show();
            $(".filter-client-section-consultancy").show();
            $(".add-clinet-form-section").hide();
        });
    });
</script>

@endsection
