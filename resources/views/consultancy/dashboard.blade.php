@extends('layouts.custom_layout') @section('content')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('public/assets/latest/js/country-state-data.js') }}"></script>
    <section class="hj-screen-parent">
        <header class="hj-header">
            <div class="container">
                <div class="row py-2">
                    <div class="col-lg-2">
                        <div class="header-logo">
                            
                            <!-- <img src="{{ asset('/' . $dataConsultancy->consultancy_logo) }}" alt="Consultancy Logo" width="60" /> -->
                           
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="tabs-hj">
                            @php $activeTab = request('tab', 'user-management'); // default tab @endphp

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $activeTab == 'user-management' ? 'active' : '' }}" href="?tab=user-management">User Management</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $activeTab == 'clients' ? 'active' : '' }}" href="?tab=clients">Clients</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $activeTab == 'reports' ? 'active' : '' }}" href="?tab=reports">Reports</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $activeTab == 'static-settings' ? 'active' : '' }}" href="?tab=static-settings">Static Settings</a>
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
                    <div class="tab-content">
                        @if ($activeTab == 'user-management') @include('consultancy.user-management')
                        @elseif ($activeTab == 'clients') @include('consultancy.client')
                        @elseif ($activeTab == 'reports') 
                        <p>Reports Section</p>
                        @elseif ($activeTab == 'static-settings')
                        @include('consultancy.static-settings')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
