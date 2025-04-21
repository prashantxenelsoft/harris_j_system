@extends('layouts.custom_layout') @section('content')

<!-- Add Consultant Screen Start-->
<section class="add-consultant-parent">
    <header class="bom-header">
        <div class="container">
            <div class="row py-2">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <h2>LOGO</h2>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="tabs-bom">
                    @php $activeTab = request('tab', 'timesheet'); // default tab @endphp

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $activeTab == 'home' ? 'active' : '' }}" href="?tab=home">Home</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $activeTab == 'timesheet' ? 'active' : '' }}" href="?tab=timesheet">Timesheet</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $activeTab == 'claims' ? 'active' : '' }}" href="?tab=claims">Claims</a>
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
                            <img src="{{ asset('public/assets/latest/images/profile.png') }}" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="login-consultant">
    <div class="tab-content">
                        @if ($activeTab == 'home')
                        <p>Dashboard Section</p>
                        @elseif ($activeTab == 'timesheet') @include('consultant.timesheet')
                        @elseif ($activeTab == 'claims') @include('consultant.claims')
                        @endif
                    </div>
       
    </section>
</section>
<!-- Add Consultant Screen End-->

@endsection
