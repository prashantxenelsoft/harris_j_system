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
                        <ul class="nav nav-tabs" id="AddConsultantTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="home-tab-consultant" data-bs-toggle="tab" data-bs-target="#homeconsultant" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.8989 2.78873L7.39912 0.427536C6.55405 -0.142512 5.44745 -0.142512 4.60188 0.427536L1.10209 2.78823C0.413034 3.25327 0 4.03034 0 4.8614V9.49979C0 10.8804 1.11959 12 2.50021 12H4.08734C4.39737 12 4.67489 11.8095 4.7869 11.5205L5.56896 9.49979H4.19135C3.6483 9.49979 3.32178 8.89774 3.6178 8.4427L6.09401 4.7619C6.20152 4.59788 6.38453 4.49937 6.58055 4.49937C6.97158 4.49937 7.2511 4.87691 7.13759 5.25094L6.45304 7.49962H7.88816C8.30969 7.49962 8.60572 7.91516 8.46821 8.31369L7.45212 11.3409C7.34361 11.665 7.58463 12 7.92616 12H9.50129C10.8819 12 12.0015 10.8804 12.0015 9.49979V4.8619C12.0015 4.03084 11.5885 3.25377 10.8994 2.78873H10.8989Z"
                                            fill="#8D91A0"
                                        />
                                    </svg>
                                    Home
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="consultants-tab-consultant" data-bs-toggle="tab" data-bs-target="#consultantsconsultant" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill="#aaa6a6"
                                            d="M7.5 7.5C5.43187 7.5 3.75 5.81813 3.75 3.75C3.75 1.68187 5.43187 0 7.5 0C9.56813 0 11.25 1.68187 11.25 3.75C11.25 5.81813 9.56813 7.5 7.5 7.5ZM5.83313 8.75H5C3.27688 8.75 1.875 10.1519 1.875 11.875V15H6.25L7.11563 10.6731L5.83313 8.75ZM10 8.75H9.16687L7.885 10.6731L8.75063 15H13.1256V11.875C13.1256 10.1519 11.7231 8.75 10 8.75Z"
                                            fill="#FF1901"
                                        />
                                    </svg>
                                    Timesheet
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="hr-tab-consultant" data-bs-toggle="tab" data-bs-target="#hrconsultant" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_40814_9071)">
                                            <path
                                                d="M4 6C2.3455 6 1 4.6545 1 3C1 1.3455 2.3455 0 4 0C5.6545 0 7 1.3455 7 3C7 4.6545 5.6545 6 4 6ZM3.5 10.5V7.5C3.5 7.338 3.5185 7.181 3.548 7.0275C1.555 7.253 0 8.9475 0 11V11.5C0 11.776 0.224 12 0.5 12H4C4.004 12 4.007 11.998 4.011 11.998C3.6945 11.5795 3.5 11.064 3.5 10.5ZM9.75 8.7H9.3V7.8H9.75C9.998 7.8 10.2 8.002 10.2 8.25C10.2 8.498 9.998 8.7 9.75 8.7ZM12 7.5V10.5C12 11.3285 11.3285 12 10.5 12H6C5.1715 12 4.5 11.3285 4.5 10.5V7.5C4.5 6.6715 5.1715 6 6 6H10.5C11.3285 6 12 6.6715 12 7.5ZM7.6 7C7.379 7 7.2 7.179 7.2 7.4V8.5975H6.3V7.4C6.3 7.179 6.121 7 5.9 7C5.679 7 5.5 7.179 5.5 7.4V10.6C5.5 10.821 5.679 11 5.9 11C6.121 11 6.3 10.821 6.3 10.6V9.3975H7.2V10.6C7.2 10.821 7.379 11 7.6 11C7.821 11 8 10.821 8 10.6V7.4C8 7.179 7.821 7 7.6 7ZM10.4665 9.272C10.828 9.018 11.0505 8.579 10.99 8.091C10.911 7.454 10.325 7 9.6835 7H8.9C8.679 7 8.5 7.179 8.5 7.4V10.6C8.5 10.821 8.679 11 8.9 11C9.121 11 9.3 10.821 9.3 10.6V9.5H9.692L10.0445 10.7115C10.094 10.8825 10.2505 11 10.4285 11H10.46C10.7285 11 10.921 10.7405 10.8425 10.4835L10.473 9.2685C10.4845 9.26 10.485 9.2605 10.494 9.254C10.4845 9.26 10.4785 9.2645 10.4665 9.2715V9.272Z"
                                                fill="#8D91A0"
                                            />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_40814_9071">
                                                <rect width="12" height="12" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    Claims
                                </button>
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
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade" id="homeconsultant" role="tabpanel" aria-labelledby="pills-home-tab">...</div>

            <div class="tab-pane fade show active" id="consultantsconsultant" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="container my-4">
                    <div class="row">
                        <div class="col-lg-9 col-xl-8">
                            <div class="calender-wrap-parent">
                                <div class="login-dashboard-top-bar mb-0">
                                    <div class="left-col-top-bar">
                                        <div class="employee-details-consultant">
                                            <ul>
                                                <li>
                                                    <h6>Employee ID</h6>
                                                    <p>:Emp14982</p>
                                                </li>
                                                <li>
                                                    <h6>Employee Name</h6>
                                                    <p>: Bruce Lee</p>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="client-details-consultant">
                                            <ul>
                                                <li>
                                                    <h6>Client Name</h6>
                                                    <p>:Encore Films</p>
                                                </li>
                                                <li>
                                                    <h6>Reporting Manager</h6>
                                                    <p>:Miss.Tiana Calzoni (tiana@gmail.com)</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="right-col-top-bar">
                                        <div class="calendar-top-header-btn-group">
                                            <a href="#" class="edit-icon">
                                                <i class="fa fa-pen"></i>
                                            </a>

                                            <a href="#" class="save-btn">
                                                <img src="{{ asset('public/assets/latest/images/save-icon-circle.png') }}" class="img-fluid" />
                                                Save
                                            </a>

                                            <a href="#" class="submit-btn">
                                                Submit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                           
                                    <div class="calendar-container">
                                        <!-- <div class="calender-top-steps-wrapper">
                                            <div class="progress-steps-calender">
                                                <ul>
                                                    <li>
                                                        <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_41157_9825)">
                                                                    <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                                                </g>
                                                                <g clip-path="url(#clip1_41157_9825)">
                                                                    <path
                                                                        d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                        fill="black"
                                                                    />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_41157_9825">
                                                                        <rect width="32" height="32" fill="white" />
                                                                    </clipPath>
                                                                    <clipPath id="clip1_41157_9825">
                                                                        <rect width="15" height="15" fill="white" transform="translate(8 8)" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </span>
                                                    </li>

                                                    <li>
                                                        <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_41157_9825)">
                                                                    <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                                                </g>
                                                                <g clip-path="url(#clip1_41157_9825)">
                                                                    <path
                                                                        d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                        fill="black"
                                                                    />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_41157_9825">
                                                                        <rect width="32" height="32" fill="white" />
                                                                    </clipPath>
                                                                    <clipPath id="clip1_41157_9825">
                                                                        <rect width="15" height="15" fill="white" transform="translate(8 8)" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </span>
                                                    </li>

                                                    <li>
                                                        <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_41157_9825)">
                                                                    <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                                                </g>
                                                                <g clip-path="url(#clip1_41157_9825)">
                                                                    <path
                                                                        d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                        fill="black"
                                                                    />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_41157_9825">
                                                                        <rect width="32" height="32" fill="white" />
                                                                    </clipPath>
                                                                    <clipPath id="clip1_41157_9825">
                                                                        <rect width="15" height="15" fill="white" transform="translate(8 8)" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </span>
                                                    </li>

                                                    <li>
                                                        <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_41157_9825)">
                                                                    <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                                                </g>
                                                                <g clip-path="url(#clip1_41157_9825)">
                                                                    <path
                                                                        d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                        fill="black"
                                                                    />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_41157_9825">
                                                                        <rect width="32" height="32" fill="white" />
                                                                    </clipPath>
                                                                    <clipPath id="clip1_41157_9825">
                                                                        <rect width="15" height="15" fill="white" transform="translate(8 8)" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </span>
                                                    </li>

                                                    <li>
                                                        <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_41157_9825)">
                                                                    <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                                                </g>
                                                                <g clip-path="url(#clip1_41157_9825)">
                                                                    <path
                                                                        d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                        fill="black"
                                                                    />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_41157_9825">
                                                                        <rect width="32" height="32" fill="white" />
                                                                    </clipPath>
                                                                    <clipPath id="clip1_41157_9825">
                                                                        <rect width="15" height="15" fill="white" transform="translate(8 8)" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_41157_9825)">
                                                                    <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                                                </g>
                                                                <g clip-path="url(#clip1_41157_9825)">
                                                                    <path
                                                                        d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                        fill="black"
                                                                    />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_41157_9825">
                                                                        <rect width="32" height="32" fill="white" />
                                                                    </clipPath>
                                                                    <clipPath id="clip1_41157_9825">
                                                                        <rect width="15" height="15" fill="white" transform="translate(8 8)" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_41157_9825)">
                                                                    <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                                                </g>
                                                                <g clip-path="url(#clip1_41157_9825)">
                                                                    <path
                                                                        d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                        fill="black"
                                                                    />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_41157_9825">
                                                                        <rect width="32" height="32" fill="white" />
                                                                    </clipPath>
                                                                    <clipPath id="clip1_41157_9825">
                                                                        <rect width="15" height="15" fill="white" transform="translate(8 8)" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="calendar-header">
                                                <select id="monthSelect"></select>
                                                <select id="yearSelect"></select>
                                            </div>
                                        </div> -->

                                        <!-- <div class="calendar" id="calendar"></div> -->

                                        <div class="calendar">
                                            <div class="calendar-nav">
                                                <div class="calendar-tools">
                                                <i>A</i>
                                                <i>&#9992;</i>
                                                <i>&#x25C9;</i>
                                                <i>&#9998;</i>
                                                <i>&#128197;</i>
                                                <i>&#x1F5C3;</i>
                                                </div>
                                                <div class="month-controls">
                                                <button onclick="changeMonth(-1)">&#x25C0;</button>
                                                <select id="monthSelect"></select>
                                                <select id="yearSelect"></select>
                                                <button onclick="changeMonth(1)">&#x25B6;</button>
                                                </div>
                                            </div>
                                            <div class="calendar-grid" id="calendarDays">
                                                <div class="day-label">Sunday</div>
                                                <div class="day-label">Monday</div>
                                                <div class="day-label">Tuesday</div>
                                                <div class="day-label">Wednesday</div>
                                                <div class="day-label">Thursday</div>
                                                <div class="day-label">Friday</div>
                                                <div class="day-label">Saturday</div>
                                            </div>
                                        </div>

                                        <script>
                                            const calendarDays = document.getElementById("calendarDays");
                                            const monthSelect = document.getElementById("monthSelect");
                                            const yearSelect = document.getElementById("yearSelect");
                                            const dropdownSuggestions = [
                                                { label: "PH", icon: "&#128170;" },
                                                { label: "AL", icon: "&#127873;" },
                                                { label: "ML", icon: "&#128154;" },
                                                { label: "PDO", icon: "&#128100;&#8205;&#9794;️" },
                                                { label: "Custom", icon: "&#128295;" }
                                            ];

                                            let currentDate = new Date();
                                            let highlightedCell = null;

                                            function populateMonthYearSelectors() {
                                                const months = Array.from({ length: 12 }, (_, i) => new Date(0, i).toLocaleString('default', { month: 'long' }));
                                                months.forEach((m, i) => {
                                                const opt = new Option(m, i);
                                                if (i === currentDate.getMonth()) opt.selected = true;
                                                monthSelect.appendChild(opt);
                                                });

                                                for (let y = 1970; y <= 2100; y++) {
                                                const opt = new Option(y, y);
                                                if (y === currentDate.getFullYear()) opt.selected = true;
                                                yearSelect.appendChild(opt);
                                                }
                                            }

                                            monthSelect.addEventListener("change", () => {
                                                currentDate.setMonth(+monthSelect.value);
                                                renderCalendar();
                                            });

                                            yearSelect.addEventListener("change", () => {
                                                currentDate.setFullYear(+yearSelect.value);
                                                renderCalendar();
                                            });

                                            function renderCalendar() {
                                                const year = currentDate.getFullYear();
                                                const month = currentDate.getMonth();

                                                calendarDays.querySelectorAll(".calendar-cell").forEach(e => e.remove());

                                                const firstDay = new Date(year, month, 1).getDay();
                                                const daysInMonth = new Date(year, month + 1, 0).getDate();

                                                for (let i = 0; i < firstDay; i++) {
                                                calendarDays.innerHTML += `<div class="calendar-cell disabled"></div>`;
                                                }

                                                for (let i = 1; i <= daysInMonth; i++) {
                                                const date = new Date(year, month, i);
                                                const cell = document.createElement("div");
                                                cell.classList.add("calendar-cell");
                                                if (i === 16 && month === 7 && year === 2024) {
                                                    cell.classList.add("highlighted");
                                                    highlightedCell = cell;
                                                }

                                                const dateLabel = document.createElement("div");
                                                dateLabel.classList.add("cell-date");
                                                dateLabel.innerText = i;
                                                cell.appendChild(dateLabel);

                                                const day = date.getDay();
                                                if (day === 0 || day === 6) {
                                                    cell.classList.add("disabled");
                                                } else {
                                                    cell.addEventListener("click", (e) => showInputDropdown(e, cell));
                                                }

                                                // Add example tags with blue color
                                                const tagRules = {
                                                "3-2025": [  // April 2025
                                                    { index: 1, label: "PDO" },
                                                    { index: 2, label: "8" },
                                                    { index: 8, label: "5" },
                                                    { index: 9, label: "PH" },
                                                    { index: 15, label: "ML" },
                                                    { index: 16, label: "AL" },
                                                    { index: 25, label: "6" },
                                                ],
                                                "4-2025": [
                                                    { index: 2, label: "PH" },
                                                    { index: 20, label: "8" },
                                                ]
                                            };

                                            // Example: current month = 4, year = 2025
                                            const currentKey = `${month}-${year}`;
                                            if (tagRules[currentKey]) {
                                                tagRules[currentKey].forEach(rule => {
                                                    if (i === rule.index) {
                                                        applyTag(cell, rule.label, "#007bff");
                                                    }
                                                });
                                            }


                                                calendarDays.appendChild(cell);
                                                }
                                            }

                                            function showInputDropdown(event, cell) {
                                                closeAllDropdowns();

                                                const dropdown = document.createElement("div");
                                                dropdown.classList.add("dropdown");

                                                const cellRect = cell.getBoundingClientRect();
                                                const dropdownWidth = 180;
                                                const leftPosition = (cellRect.width - dropdownWidth) / 2;
                                                dropdown.style.left = `${leftPosition}px`;

                                                const input = document.createElement("input");
                                                input.placeholder = 'Type label...';

                                                const suggestionBox = document.createElement("div");
                                                suggestionBox.className = 'suggestions';

                                                function updateSuggestions(val) {
                                                suggestionBox.innerHTML = "";
                                                dropdownSuggestions
                                                    .filter(s => s.label.toLowerCase().includes(val.toLowerCase()))
                                                    .forEach(item => {
                                                    const opt = document.createElement("div");
                                                    opt.innerHTML = `<span style="margin-right: 8px;">${item.icon}</span>${item.label}`;
                                                    opt.onclick = () => {
                                                        // console.log("check item",item);
                                                        applyTag(cell, item.label, "#007bff");
                                                        dropdown.remove();
                                                    }
                                                    suggestionBox.appendChild(opt);
                                                    });
                                                }

                                                input.addEventListener("input", () => updateSuggestions(input.value));
                                                input.addEventListener("keydown", e => {
                                                if (e.key === "Enter") {
                                                    if (input.value.trim() !== "") {
                                                    applyTag(cell, input.value.trim(), "#007bff");
                                                    dropdown.remove();
                                                    }
                                                }
                                                });

                                                dropdown.appendChild(input);
                                                dropdown.appendChild(suggestionBox);
                                                cell.appendChild(dropdown);
                                                input.focus();
                                                updateSuggestions("");
                                            }

                                            function applyTag(cell, label, color = "#007bff") {
                                                cell.querySelectorAll(".tag").forEach(t => t.remove());

                                                const tag = Object.assign(document.createElement("div"), {
                                                    className: "tag",
                                                    innerText: label
                                                });

                                                if (["PDO", "PH", "AL", "ML"].includes(label)) {
                                                    tag.style.color = "blue";
                                                } else if (!isNaN(label) && parseInt(label) < 8) {
                                                    tag.style.color = "red";
                                                }

                                                cell.appendChild(tag);
                                            }



                                            function closeAllDropdowns() {
                                                document.querySelectorAll(".dropdown").forEach(d => d.remove());
                                            }

                                            function changeMonth(delta) {
                                                currentDate.setMonth(currentDate.getMonth() + delta);
                                                monthSelect.value = currentDate.getMonth();
                                                yearSelect.value = currentDate.getFullYear();
                                                renderCalendar();
                                            }

                                            document.addEventListener("click", function(e) {
                                                if (!e.target.closest(".calendar-cell")) closeAllDropdowns();
                                            });

                                            populateMonthYearSelectors();
                                            renderCalendar();
                                        </script>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-xl-4">
                            <div class="timeline-parent-col">
                                <h6>
                                    <i class="fa-solid fa-caret-down"></i>
                                    Encore Films
                                </h6>

                                <div class="timelines-inner">
                                    <ul>
                                        <li>
                                            <div class="timeline-item">
                                                <div class="timeline-icon blue"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-title">Timesheet Overview</div>
                                                    <span class="badge draft">Draft</span>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="timeline-item">
                                                <div class="timeline-icon green"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-title">Timesheet Overview</div>
                                                    <span class="badge approved">Auto Approved</span>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="timeline-item line">
                                                <div class="timeline-icon yellow"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-title">Timesheet Overview</div>
                                                    <span class="badge submitted">Submitted</span>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="timeline-item">
                                                <div class="timeline-icon blue"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-title">Timesheet Overview</div>
                                                    <span class="badge draft">Draft</span>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="timeline-item">
                                                <div class="timeline-icon green"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-title">Timesheet Overview</div>
                                                    <span class="badge approved">Auto Approved</span>
                                                </div>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="timeline-item line">
                                                <div class="timeline-icon yellow"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-title">Timesheet Overview</div>
                                                    <span class="badge submitted">Submitted</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 bottom-remark-timesheet-group">
                            <div class="col-lg-4">
                                <div class="work-summary">
                                    <!-- Expand Button -->
                                    <button class="expand-btn" data-bs-toggle="modal" data-bs-target="#workSummaryModal">
                                        <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" />
                                    </button>

                                    <!-- Tabs -->
                                    <ul class="nav nav-tabs" id="workTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="leave-tab" data-bs-toggle="tab" data-bs-target="#leave" type="button" role="tab">Leave Log</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="summary-tab" data-bs-toggle="tab" data-bs-target="#summary" type="button" role="tab">Work summery</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content border border-top-0 p-3" id="workTabsContent">
                                        <div class="tab-pane fade" id="leave" role="tabpanel" aria-labelledby="leave-tab">
                                            <p>Leave log content goes here...</p>
                                        </div>
                                        <div class="tab-pane fade show active" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                                            <div class="stats-box">
                                                <div>
                                                    <div class="stats-number">168</div>
                                                    <div class="stats-label">Hours Forecasted</div>
                                                </div>
                                                <div>
                                                    <div class="stats-number">168</div>
                                                    <div class="stats-label">Hours Logged</div>
                                                </div>
                                            </div>

                                            <div class="bottom-stats">
                                                <div>15</div>
                                                <div>10</div>
                                                <div>03</div>
                                                <div>02</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="workSummaryModal" tabindex="-1" aria-labelledby="workSummaryModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="workSummaryModalLabel">Work Summary</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Reuse same tab structure inside modal -->
                                                <ul class="nav nav-tabs" id="modalTabs" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="modal-leave-tab" data-bs-toggle="tab" data-bs-target="#modal-leave" type="button" role="tab">Leave Log</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="modal-summary-tab" data-bs-toggle="tab" data-bs-target="#modal-summary" type="button" role="tab">Work summery</button>
                                                    </li>
                                                </ul>

                                                <div class="tab-content border border-top-0 p-3">
                                                    <div class="tab-pane fade" id="modal-leave" role="tabpanel">
                                                        <div class="leave-log w-100">
                                                            <table class="w-100">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Type Of Leave</th>
                                                                        <th>From</th>
                                                                        <th>To</th>
                                                                        <th>Days</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td><span class="leave-type pdo">PDO</span></td>
                                                                        <td>05/05/2024</td>
                                                                        <td>05/05/2024</td>
                                                                        <td class="half-day">1/2</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="leave-type ml">ML <small>HD1</small></span>
                                                                        </td>
                                                                        <td>09/05/2024</td>
                                                                        <td>09/05/2024</td>
                                                                        <td class="half-day">1/2</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><span class="leave-type ul">UL</span></td>
                                                                        <td>11/05/2024</td>
                                                                        <td>11/05/2024</td>
                                                                        <td class="half-day">1/2</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <span class="leave-type ul-hd">UL <small>HD1</small></span>
                                                                        </td>
                                                                        <td>22/05/2024</td>
                                                                        <td>22/05/2024</td>
                                                                        <td class="half-day">1/2</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade show active" id="modal-summary" role="tabpanel">
                                                        <div class="stats-box">
                                                            <div>
                                                                <div class="stats-number">168</div>
                                                                <div class="stats-label">Hours Forecasted</div>
                                                            </div>
                                                            <div>
                                                                <div class="stats-number">168</div>
                                                                <div class="stats-label">Hours Logged</div>
                                                            </div>
                                                        </div>

                                                        <div class="bottom-stats">
                                                            <div>15</div>
                                                            <div>10</div>
                                                            <div>03</div>
                                                            <div>02</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="remark-section card p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6>Remarks</h6>
                                        <div class="btn-group-remark">
                                            <button class="btn btn-link p-0 text-danger" data-bs-toggle="modal" data-bs-target="#remarksModal">
                                                <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" />
                                            </button>
                                        </div>
                                    </div>

                                    <div class="remark-timeline">
                                        <div class="remark-item mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2 text-primary">
                                                    <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                    <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                        <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small>
                                                    </div>
                                                    <p>This is Approved, Thank you for the excellent contribution</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="remark-item mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2 text-primary">
                                                    <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                    <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                        <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small>
                                                    </div>
                                                    <p>This is Approved, Thank you for the excellent contribution</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="remark-item mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2 text-primary">
                                                    <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                    <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                        <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small>
                                                    </div>
                                                    <p>This is Approved, Thank you for the excellent contribution</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="remark-item mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="me-2 text-primary">
                                                    <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                    <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                </div>
                                                <div>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                        <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small>
                                                    </div>
                                                    <p>This is Approved, Thank you for the excellent contribution</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for Expanded View -->
                                <div class="modal fade" id="remarksModal" tabindex="-1" aria-labelledby="remarksModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="remarksModalLabel">Remarks</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- You can repeat the same timeline markup from above here -->
                                                <div class="remark-timeline">
                                                    <!-- Copy remarks here (same as above inside modal) -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="timesheet-section card p-2">
                                    <!-- Tabs -->
                                    <div class="timesheet-header d-flex">
                                        <ul class="nav nav-tabs mb-3" id="timesheetTabs">
                                            <li class="nav-item">
                                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#overviewTab">Timesheet Overview</button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#extraTimeTab">Extra Time Log</button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#payOffTab">Pay-Off Log</button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#compOffTab">Comp-off log</button>
                                            </li>
                                        </ul>

                                        <div class="button-group">
                                            <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" />
                                        </div>
                                    </div>

                                    <!-- Tab Contents -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="overviewTab">
                                            <div class="timeline">
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                        <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1">
                                                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                            <span class="fw-bold text-primary">PH - (1)</span>
                                                        </div>
                                                        <div>
                                                            <span>Sat, 15 Aug - </span>
                                                            <span class="badge bg-primary text-white">PH</span>
                                                            <span class="text-primary fw-bold"> - Paid day off</span>
                                                            <span> - 3 hours off</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                        <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1">
                                                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                            <span class="fw-bold text-primary">PH - (1)</span>
                                                        </div>
                                                        <div>
                                                            <span>Sat, 15 Aug - </span>
                                                            <span class="badge bg-primary text-white">PH</span>
                                                            <span class="text-primary fw-bold"> - Paid day off</span>
                                                            <span> - 3 hours off</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                        <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1">
                                                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                            <span class="fw-bold text-primary">PH - (1)</span>
                                                        </div>
                                                        <div>
                                                            <span>Sat, 15 Aug - </span>
                                                            <span class="badge bg-primary text-white">PH</span>
                                                            <span class="text-primary fw-bold"> - Paid day off</span>
                                                            <span> - 3 hours off</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline-item d-flex align-items-start mb-3">
                                                    <div class="me-2">
                                                        <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                        <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-1">
                                                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                            <span class="fw-bold text-primary">PH - (1)</span>
                                                        </div>
                                                        <div>
                                                            <span>Sat, 15 Aug - </span>
                                                            <span class="badge bg-primary text-white">PH</span>
                                                            <span class="text-primary fw-bold"> - Paid day off</span>
                                                            <span> - 3 hours off</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Other tabs can be filled similarly -->
                                        <div class="tab-pane fade" id="extraTimeTab">Extra Time Content</div>
                                        <div class="tab-pane fade" id="payOffTab">Pay-Off Content</div>
                                        <div class="tab-pane fade" id="compOffTab">Comp-Off Content</div>
                                        <div class="tab-pane fade" id="copiesTab">Get Copies Content</div>
                                    </div>
                                </div>

                                <!-- Modal for Expanded View -->
                                <div class="modal fade" id="timesheetModal" tabindex="-1" aria-labelledby="timesheetModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="timesheetModalLabel">Timesheet Overview</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Copy the full content of timesheet-section here or load dynamically -->
                                                <p>Same content as above or dynamically injected...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="hrconsultant" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
        </div>
    </section>
</section>
<!-- Add Consultant Screen End-->

@endsection
