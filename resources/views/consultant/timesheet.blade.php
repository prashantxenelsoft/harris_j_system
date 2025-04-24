<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade" id="homeconsultant" role="tabpanel" aria-labelledby="pills-home-tab">...</div>

    <div class="tab-pane fade show active" id="timesheet" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="container my-4">
            <div class="row">
                <div class="col-lg-9 col-xl-8">
                    <div class="calender-wrap-parent">
                        <div class="login-dashboard-top-bar mb-0">
                            <div class="left-col-top-bar">
                                @if($consultant)
                                <div class="employee-details-consultant">
                                    <ul>
                                        <li>
                                            <h6>Employee ID</h6>
                                            <p>: {{ $consultant->emp_code ?? 'N/A' }}</p>
                                        </li>
                                        <li>
                                            <h6>Employee Name</h6>
                                            <p>: {{ $consultant->emp_name ?? 'N/A' }}</p>
                                        </li>
                                    </ul>
                                </div>

                                <div class="client-details-consultant">
                                    <ul>
                                        <li>
                                            <h6>Client Name</h6>
                                            <p>: {{ $consultant->client_name ?? 'N/A' }}</p>
                                        </li>
                                        <li>
                                            <h6>Reporting Manager</h6>
                                            <p>: {{ $consultant->designation ?? 'N/A' }}</p>
                                        </li>
                                    </ul>
                                </div>
                                @else
                                <p>No consultant data found.</p>
                                @endif
                            </div>

                            <div class="right-col-top-bar">
                                <div class="calendar-top-header-btn-group">
                                   
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


                        <div class="calender-custom">
                            <div class="calendar-container">
                                <div class="calender-top-steps-wrapper">
                                    <div class="progress-steps-calender">
                                        <ul>
                                            <li>
                                                <span>
                                                    <svg width="32" height="32" viewBox="0 0 32 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_41157_9825)">
                                                            <circle cx="16" cy="16" r="15" fill="white"
                                                                stroke="#A1AEBE" stroke-width="2" />
                                                        </g>
                                                        <g clip-path="url(#clip1_41157_9825)">
                                                            <path
                                                                d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                fill="black" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_41157_9825">
                                                                <rect width="32" height="32" fill="white" />
                                                            </clipPath>
                                                            <clipPath id="clip1_41157_9825">
                                                                <rect width="15" height="15" fill="white"
                                                                    transform="translate(8 8)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </li>

                                            <li>
                                                <span>
                                                    <svg width="32" height="32" viewBox="0 0 32 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_41157_9825)">
                                                            <circle cx="16" cy="16" r="15" fill="white"
                                                                stroke="#A1AEBE" stroke-width="2" />
                                                        </g>
                                                        <g clip-path="url(#clip1_41157_9825)">
                                                            <path
                                                                d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                fill="black" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_41157_9825">
                                                                <rect width="32" height="32" fill="white" />
                                                            </clipPath>
                                                            <clipPath id="clip1_41157_9825">
                                                                <rect width="15" height="15" fill="white"
                                                                    transform="translate(8 8)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </li>

                                            <li>
                                                <span>
                                                    <svg width="32" height="32" viewBox="0 0 32 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_41157_9825)">
                                                            <circle cx="16" cy="16" r="15" fill="white"
                                                                stroke="#A1AEBE" stroke-width="2" />
                                                        </g>
                                                        <g clip-path="url(#clip1_41157_9825)">
                                                            <path
                                                                d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                fill="black" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_41157_9825">
                                                                <rect width="32" height="32" fill="white" />
                                                            </clipPath>
                                                            <clipPath id="clip1_41157_9825">
                                                                <rect width="15" height="15" fill="white"
                                                                    transform="translate(8 8)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </li>

                                            <li>
                                                <span>
                                                    <svg width="32" height="32" viewBox="0 0 32 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_41157_9825)">
                                                            <circle cx="16" cy="16" r="15" fill="white"
                                                                stroke="#A1AEBE" stroke-width="2" />
                                                        </g>
                                                        <g clip-path="url(#clip1_41157_9825)">
                                                            <path
                                                                d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                fill="black" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_41157_9825">
                                                                <rect width="32" height="32" fill="white" />
                                                            </clipPath>
                                                            <clipPath id="clip1_41157_9825">
                                                                <rect width="15" height="15" fill="white"
                                                                    transform="translate(8 8)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </li>

                                            <li>
                                                <span>
                                                    <svg width="32" height="32" viewBox="0 0 32 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_41157_9825)">
                                                            <circle cx="16" cy="16" r="15" fill="white"
                                                                stroke="#A1AEBE" stroke-width="2" />
                                                        </g>
                                                        <g clip-path="url(#clip1_41157_9825)">
                                                            <path
                                                                d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                fill="black" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_41157_9825">
                                                                <rect width="32" height="32" fill="white" />
                                                            </clipPath>
                                                            <clipPath id="clip1_41157_9825">
                                                                <rect width="15" height="15" fill="white"
                                                                    transform="translate(8 8)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </li>
                                            <li>
                                                <span>
                                                    <svg width="32" height="32" viewBox="0 0 32 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_41157_9825)">
                                                            <circle cx="16" cy="16" r="15" fill="white"
                                                                stroke="#A1AEBE" stroke-width="2" />
                                                        </g>
                                                        <g clip-path="url(#clip1_41157_9825)">
                                                            <path
                                                                d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                fill="black" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_41157_9825">
                                                                <rect width="32" height="32" fill="white" />
                                                            </clipPath>
                                                            <clipPath id="clip1_41157_9825">
                                                                <rect width="15" height="15" fill="white"
                                                                    transform="translate(8 8)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </li>
                                            <li>
                                                <span>
                                                    <svg width="32" height="32" viewBox="0 0 32 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_41157_9825)">
                                                            <circle cx="16" cy="16" r="15" fill="white"
                                                                stroke="#A1AEBE" stroke-width="2" />
                                                        </g>
                                                        <g clip-path="url(#clip1_41157_9825)">
                                                            <path
                                                                d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                                fill="black" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_41157_9825">
                                                                <rect width="32" height="32" fill="white" />
                                                            </clipPath>
                                                            <clipPath id="clip1_41157_9825">
                                                                <rect width="15" height="15" fill="white"
                                                                    transform="translate(8 8)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="month-controls">
                                        <button onclick="changeMonth(-1)">&#x25C0;</button>
                                        <select id="monthSelect"></select>
                                        <select id="yearSelect"></select>
                                        <button onclick="changeMonth(1)">&#x25B6;</button>
                                    </div>
                                </div>

                                <div class="calendar-container">
                                    <div class="calendar">
                                        
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
                                </div>

                                <div class="modal fade" id="medicalLeave" tabindex="-1" aria-labelledby="medicalLeaveModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="model_employee">
                                                    <div class="model_emp_img">
                                                        <img src="{{ asset('public/assets/latest/images/emp-icon1.png') }}" alt="" />
                                                    </div>
                                                    <span class="model_emp_name">{{ $consultant->emp_name ?? 'N/A' }}</span>
                                                </div>
                                                <button type="button" class="btn-close ml-close-btn" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <div class="modal_body_inner">
                                                    <div class="mb_left">
                                                        <div class="ml_date_box">
                                                            <div class="ml_date">
                                                                <span>Date: <span id="medicalLeaveDateDisplay"></span></span>
                                                            </div>
                                                            <div class="ml_duty_time">
                                                                <span>Time On Duty : <span> -- / 8.30</span></span>
                                                            </div>
                                                        </div>
                                                        <div class="ml_leave_detail">
                                                            <div class="leave_type">
                                                                <span>Leave type :</span>
                                                                <h2>Medical Leave (ML)</h2>
                                                            </div>
                                                            <div class="select_leave_hour">
                                                                <span>ML leave hours :</span>
                                                            </div>
                                                            <div class="ml_leave_hour">
                                                                <ul>
                                                                    <li>
                                                                        <input type="radio" name="Day" id="fullDay" />
                                                                        <img src="{{ asset('public/assets/latest/images/night-day.png') }}" alt="" />
                                                                        <label for="fullDay">Full Day</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="radio" name="Day" id="sHalfDay" />
                                                                        <img src="{{ asset('public/assets/latest/images/night-day.png') }}" alt="" />
                                                                        <label for="sHalfDay">Second half workday (HD2)</label>
                                                                    </li>
                                                                </ul>
                                                                <ul>
                                                                    <li>
                                                                        <input type="radio" name="Day" id="fHalfDay" />
                                                                        <img src="{{ asset('public/assets/latest/images/night-day.png') }}" alt="" />
                                                                        <label for="fHalfDay">First half workday (HD1)</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="radio" name="Day" id="customDay" />
                                                                        <img src="{{ asset('public/assets/latest/images/custom-wheel.png') }}" alt="" />
                                                                        <label for="customDay">Custom</label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="date_selector">
                                                                <span>Select date :</span>
                                                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
                                                                <style>
                                                                    #dateRange {
                                                                        border-radius: 8px;
                                                                        padding: 10px 12px;
                                                                        border: 1px solid #ccc;
                                                                        width: 100%;
                                                                        font-size: 14px;
                                                                        margin-top: 10px;
                                                                    }
                                                                </style>
                                                                <input type="text" id="dateRange" placeholder="dd / mm / yyyy - dd / mm / yyyy" />
                                                            </div>

                                                            <div class="leave_slot_selector">
                                                                <span>Select Leave Slot :</span>
                                                                <div class="day_and_night_selector">
                                                                    <div class="day_night">
                                                                        <span>Mid - Night</span>
                                                                        <div class="mid_night_img">
                                                                            <img src="{{ asset('public/assets/latest/images/moon.png') }}" alt="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="day_night">
                                                                        <span>Noon</span>
                                                                        <div class="mid_night_img">
                                                                            <img src="{{ asset('public/assets/latest/images/sun.png') }}" alt="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="day_night">
                                                                        <span>Mid - Night</span>
                                                                        <div class="mid_night_img">
                                                                            <img src="{{ asset('public/assets/latest/images/moon.png') }}" alt="" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="range_selector">
                                                                    <div class="range">
                                                                        <div class="range-slider">
                                                                            <span class="range-selected"></span>
                                                                            <span class="tooltips min-tooltip">7:30 AM</span>
                                                                            <span class="tooltips max-tooltip">4:00 PM</span>
                                                                        </div>

                                                                        <div class="range-input">
                                                                            <input type="range" class="min" min="0" max="47" value="15" step="1" />
                                                                            <input type="range" class="max" min="0" max="47" value="32" step="1" />
                                                                        </div>
                                                                    </div>

                                                                    @include('consultant.range-scale')
                                                                </div>
                                                            </div>
                                                            <div class="upload_certificate">
                                                                <div class="file_input">
                                                                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                                                    <p>Upload Medical Leave Certificate</p>
                                                                </div>
                                                                <input type="file" name="" id="uploadFile" />
                                                                <p>*Allow to upload file <span>PNG,JPG,PDF</span> (Max.file size: 1MB)</p>
                                                            </div>
                                                            <div class="clock_it_btn">
                                                                <button class="ml_cancel_btn" data-bs-dismiss="modal" aria-label="Close">
                                                                    Cancel
                                                                </button>
                                                                <button class="ml_clockit_btn">
                                                                    Clock It
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-right">
                                                        <h3 class="mb_right_title">
                                                            Documents List
                                                        </h3>
                                                        <div class="ml_document_list">
                                                            @forelse($dataTimesheet as $item)
                                                                @php
                                                                    $record = json_decode($item->record);
                                                                @endphp
                                                                @if($record->leaveType === "ML")
                                                                <div 
                                                                    class="expense-block"
                                                                    data-leave-date="{{ $record->date }}"
                                                                    data-leave-hour-id="{{ $record->leaveHourId }}"
                                                                    data-range-min="{{ $record->rangeMin ?? '' }}"
                                                                    data-range-max="{{ $record->rangeMax ?? '' }}"
                                                                    style="background:white;border-radius:10px;box-shadow:0 2px 5px rgba(0,0,0,0.1);padding:15px;margin:12px;margin-top:15px;position:relative;"
                                                                >
                                                                    <div class="ml_card" style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;font-size:10px;">
                                                                        <div style="display:flex;align-items:center;gap:8px;">
                                                                            <i class="fa-solid fa-calendar-days"></i>
                                                                            <span><strong>{{ $record->date }}</strong></span>
                                                                        </div>
                                                                        <div style="text-align:right;">
                                                                            <p style="margin:0;"><strong>Leave Type :</strong> Medical Leave (ML)</p>
                                                                            <p style="margin:0;"><strong>ML leave hours :</strong> {{ $record->leaveHour }}</p>
                                                                        </div>
                                                                        <div style="margin-left:auto;margin-top:10px;display:flex;gap:10px;">
                                                                            <button title="Preview" class="preview-btn" style="border:none;background:none;cursor:pointer;">
                                                                                <i class="fa-solid fa-paperclip" style="color:#ff6f00;"></i>
                                                                            </button>
                                                                            <button title="Edit" class="edit-btn" style="border:none;background:none;cursor:pointer;">
                                                                                <i class="fa-solid fa-pen-to-square" style="color:#ff6f00;"></i>
                                                                            </button>
                                                                            <button title="Delete" class="close-expense" style="border:none;background:none;cursor:pointer;">
                                                                                <i class="fa-solid fa-trash" style="color:red;"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @empty
                                                                <div class="ml_no_data">
                                                                    <img src="{{ asset('public/assets/latest/images/no-file.png') }}" alt="" />
                                                                </div>
                                                            @endforelse
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    (function () {
                                        const modal = document.querySelector("#medicalLeave");
                                        if (!modal) return;

                                        const rangeInput = modal.querySelectorAll(".range-input input");
                                        const range = modal.querySelector(".range-selected");
                                        const minTooltip = modal.querySelector(".min-tooltip");
                                        const maxTooltip = modal.querySelector(".max-tooltip");
                                        const dateRange = modal.querySelector("#dateRange");
                                        const clockItBtn = modal.querySelector(".ml_clockit_btn");
                                        const fileInput = modal.querySelector("#uploadFile");

                                        let editingBlock = null;

                                        const timeLabels = Array.from({ length: 48 }, (_, i) => {
                                            const hours = Math.floor(i / 2);
                                            const minutes = i % 2 === 0 ? "00" : "30";
                                            const suffix = hours >= 12 ? "PM" : "AM";
                                            const displayHours = hours % 12 === 0 ? 12 : hours % 12;
                                            return `${displayHours}:${minutes} ${suffix}`;
                                        });

                                        let dateRangeInstance = null; // ✅ Make this global

                                            document.addEventListener('DOMContentLoaded', function () {
                                               

                                                modal.addEventListener('shown.bs.modal', function () {
                                                    if (dateRangeInstance) {
                                                        dateRangeInstance.destroy();
                                                    }

                                                    // ✅ Get selected date from #medicalLeaveDateDisplay
                                                    const dateText = document.getElementById("medicalLeaveDateDisplay").innerText.trim();
                                                    let defaultDate = new Date(); // fallback: today

                                                    if (dateText && dateText.includes("/")) {
                                                        const [day, month, year] = dateText.split(" / ").map(Number);
                                                        defaultDate = new Date(year, month - 1, day);
                                                    }

                                                    dateRangeInstance = flatpickr(dateRange, {
                                                        mode: "range",
                                                        dateFormat: "d / m / Y",
                                                        minDate: "today",
                                                        defaultDate: [defaultDate], // ✅ auto-set to clicked calendar cell
                                                        disable: [
                                                            function (date) {
                                                                return (date.getDay() === 0 || date.getDay() === 6); // Sunday/Saturday
                                                            }
                                                        ],
                                                        onReady: function (selectedDates, dateStr, instance) {
                                                            const isRange = dateStr.includes("to");
                                                            rangeInput.forEach(input => input.disabled = isRange);
                                                            range.style.backgroundColor = isRange ? "transparent" : "#037EFF";
                                                        },
                                                        onClose: function (_, dateStr) {
                                                            const isRange = dateStr.includes("to");
                                                            rangeInput.forEach(input => input.disabled = isRange);
                                                            range.style.backgroundColor = isRange ? "transparent" : "#037EFF";
                                                        }
                                                    });
                                                });
                                            });



                                        function updateSlider() {
                                            let minVal = parseInt(rangeInput[0].value);
                                            let maxVal = parseInt(rangeInput[1].value);
                                            if (minVal > maxVal) [minVal, maxVal] = [maxVal, minVal];

                                            const percent1 = (minVal / 47) * 100;
                                            const percent2 = (maxVal / 47) * 100;

                                            range.style.left = percent1 + "%";
                                            range.style.width = percent2 - percent1 + "%";
                                            minTooltip.style.left = percent1 + "%";
                                            minTooltip.textContent = timeLabels[minVal];
                                            maxTooltip.style.left = percent2 + "%";
                                            maxTooltip.textContent = timeLabels[maxVal];
                                        }

                                        rangeInput.forEach(input => input.disabled = true);
                                        range.style.backgroundColor = "transparent";
                                        rangeInput.forEach(input => input.addEventListener("input", updateSlider));
                                        updateSlider();

                                        if (dateRange) {
                                            flatpickr(dateRange, {
                                                mode: "range",
                                                dateFormat: "d / m / Y",
                                                onClose: function (_, dateStr) {
                                                    const disable = dateStr.includes("to");
                                                    rangeInput.forEach(input => input.disabled = disable);
                                                    range.style.backgroundColor = disable ? "transparent" : "#037EFF";
                                                }
                                            });
                                        }

                                        if (clockItBtn) {
                                            clockItBtn.addEventListener("click", function () {
                                                if (!dateRange.value.trim()) {
                                                    alert("Please select a date range before proceeding.");
                                                    dateRange.focus();
                                                    return;
                                                }

                                                const selectedRadio = modal.querySelector('input[name="Day"]:checked');
                                                if (!selectedRadio) {
                                                    alert("Please select ML leave hours before proceeding.");
                                                    return;
                                                }

                                                const docList = modal.querySelector(".ml_document_list");
                                                const noDataImg = docList.querySelector(".ml_no_data");
                                                if (noDataImg) noDataImg.remove();

                                                const selectedDate = dateRange.value.includes("to") ? dateRange.value : dateRange.value.trim();
                                                const leaveHourText = modal.querySelector(`label[for="${selectedRadio.id}"]`)?.textContent.trim();
                                                const selectedRadioId = selectedRadio.id;
                                                const rangeMin = parseInt(rangeInput[0].value);
                                                const rangeMax = parseInt(rangeInput[1].value);
                                                const formattedRangeMin = timeLabels[rangeMin];
                                                const formattedRangeMax = timeLabels[rangeMax];
                                                const file = fileInput.files[0];

                                                const blockHTML = `
                                                    <div class="ml_card" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; font-size: 10px;">
                                                        <div style="display: flex; align-items: center; gap: 8px;">
                                                            <i class="fa-solid fa-calendar-days"></i>
                                                            <span><strong>${selectedDate}</strong></span>
                                                        </div>
                                                        <div style="text-align: right;">
                                                            <p style="margin: 0;"><strong>Leave Type :</strong> Medical Leave (ML)</p>
                                                            <p style="margin: 0;"><strong>ML leave hours :</strong> ${leaveHourText}</p>
                                                        </div>
                                                        <div style="margin-left: auto; margin-top: 10px; display: flex; gap: 10px;">
                                                            <button title="Preview" class="preview-btn" style="border: none; background: none; cursor: pointer;">
                                                                <i class="fa-solid fa-paperclip" style="color: #ff6f00;"></i>
                                                            </button>
                                                            <button title="Edit" class="edit-btn" style="border: none; background: none; cursor: pointer;">
                                                                <i class="fa-solid fa-pen-to-square" style="color: #ff6f00;"></i>
                                                            </button>
                                                            <button title="Delete" class="close-expense" style="border: none; background: none; cursor: pointer;">
                                                                <i class="fa-solid fa-trash" style="color: red;"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                `;

                                                let expenseBlock = editingBlock || document.createElement("div");
                                                expenseBlock.classList.add("expense-block");
                                                expenseBlock.style.cssText = `
                                                    background: white;
                                                    border-radius: 10px;
                                                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                                                    padding: 15px;
                                                    margin: 12px;
                                                    margin-top: 15px;
                                                    position: relative;
                                                `;
                                                expenseBlock.innerHTML = blockHTML;
                                                expenseBlock.dataset.leaveDate = selectedDate;
                                                expenseBlock.dataset.leaveHourId = selectedRadioId;
                                                expenseBlock.dataset.rangeMin = rangeMin;
                                                expenseBlock.dataset.rangeMax = rangeMax;

                                                if (!editingBlock) {
                                                    docList.appendChild(expenseBlock);
                                                }

                                                editingBlock = null;
                                                modal.classList.remove("editing-mode");

                                                const formData = new FormData();
                                                formData.append("type", "timesheet");
                                                formData.append("user_id", "{{ $userData['id'] ?? '' }}");
                                                formData.append("client_id", "{{ $consultant->client_id ?? '' }}");
                                                formData.append("client_name", "{{ $consultant->client_name ?? '' }}");

                                                const recordData = {
                                                    date: selectedDate,
                                                    leaveType: "ML",
                                                    leaveHour: leaveHourText,
                                                    leaveHourId: selectedRadioId,
                                                    applyOnCell: document.getElementById("medicalLeaveDateDisplay").innerText.trim()
                                                };

                                                if (!selectedDate.includes("to")) {
                                                    recordData.rangeMin = formattedRangeMin;
                                                    recordData.rangeMax = formattedRangeMax;
                                                }

                                                formData.append("record", JSON.stringify(recordData));
                                                if (file) {
                                                    formData.append("certificate", file);
                                                }

                                                console.log("Submitting via FormData:");
                                                for (let pair of formData.entries()) {
                                                    console.log(pair[0]+ ':', pair[1]);
                                                }

                                                fetch("{{ route('consultant.data.save') }}", {
                                                    method: "POST",
                                                    headers: {
                                                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                                                    },
                                                    body: formData
                                                })
                                                .then(res => {
                                                    if (!res.ok) throw new Error("Server error " + res.status);
                                                    return res.json();
                                                })
                                                .then(data => {
                                                    console.log("Saved successfully:", data);
                                                    //bootstrap.Modal.getInstance(document.getElementById("medicalLeave")).hide();

                                                    // Now call applyTag
                                                    applyTag(lastClickedCell, "ML", "#007bff");
                                                })
                                                .catch(error => {
                                                    console.error("Fetch error:", error);
                                                });


                                                expenseBlock.querySelector(".edit-btn").addEventListener("click", function () {
                                                    editingBlock = expenseBlock;
                                                    dateRange._flatpickr.setDate(expenseBlock.dataset.leaveDate.split(" to "), true, "d / m / Y");
                                                    const radio = modal.querySelector(`input[id="${expenseBlock.dataset.leaveHourId}"]`);
                                                    if (radio) radio.checked = true;
                                                    rangeInput[0].value = expenseBlock.dataset.rangeMin;
                                                    rangeInput[1].value = expenseBlock.dataset.rangeMax;

                                                    const disable = !expenseBlock.dataset.leaveDate.includes("to") ? false : true;
                                                    rangeInput.forEach(input => input.disabled = disable);
                                                    range.style.backgroundColor = disable ? "transparent" : "#037EFF";

                                                    updateSlider();
                                                    modal.classList.add("editing-mode");
                                                    modal.scrollIntoView({ behavior: "smooth" });
                                                });

                                                expenseBlock.querySelector(".close-expense").addEventListener("click", function () {
                                                    expenseBlock.remove();
                                                    if (!modal.querySelector(".ml_document_list .expense-block")) {
                                                        const img = document.createElement("img");
                                                        img.src = "{{ asset('public/assets/latest/images/no-file.png') }}";
                                                        img.alt = "";
                                                        img.classList.add("ml_no_data");
                                                        modal.querySelector(".ml_document_list").appendChild(img);
                                                    }
                                                });
                                            });
                                        }

                                        modal.addEventListener("hidden.bs.modal", function () {
                                            if (dateRange._flatpickr) dateRange._flatpickr.clear();
                                            modal.querySelectorAll('input[name="Day"]').forEach(input => input.checked = false);
                                            rangeInput[0].value = 15;
                                            rangeInput[1].value = 32;
                                            updateSlider();
                                            fileInput.value = "";
                                            editingBlock = null;
                                            modal.classList.remove("editing-mode");
                                        });

                                        const style = document.createElement("style");
                                        style.textContent = `
                                            #medicalLeave.editing-mode .modal-content {
                                                outline: 2px dashed #ffc107;
                                                outline-offset: -6px;
                                                box-shadow: 0 0 0 3px rgba(255,193,7,0.25);
                                            }
                                        `;
                                        document.head.appendChild(style);
                                    })();

                                </script>



                                <!-- Custom Leave Model -->
                                <div class="modal fade" id="customLeave" tabindex="-1" aria-labelledby="customLeaveModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="model_employee">
                                                    <div class="model_emp_img">
                                                        <img src="{{ asset('public/assets/latest/images/emp-icon1.png') }}" alt="" />
                                                    </div>
                                                    <span class="model_emp_name">{{ $consultant->emp_name ?? 'N/A' }}</span>
                                                </div>
                                                <button type="button" class="btn-close ml-close-btn" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <div class="modal_body_inner">
                                                    <div class="mb_left">
                                                        <div class="ml_date_box">
                                                            <div class="ml_date">
                                                                <span>Date: <span id="customLeaveDisplay"></span></span>
                                                            </div>
                                                            <div class="ml_duty_time">
                                                                <span>Time On Duty : <span> -- / 8.30</span></span>
                                                            </div>
                                                        </div>
                                                        <div class="ml_leave_detail">
                                                            <div class="leave_type">
                                                                <span>Select leave type :</span>
                                                            </div>
                                                            <div class="leave_type_options">
                                                                <div><a href="#" data-type="AL">AL</a></div>
                                                                <div><a href="#" data-type="UL">UL</a></div>
                                                                <div><a href="#" data-type="PDO">PDO</a></div>
                                                            </div>
                                                            <input type="hidden" id="selectedLeaveType" />

                                                            <div class="select_leave_hour">
                                                                <span>Select leave hours :</span>
                                                            </div>
                                                            <div class="ml_leave_hour">
                                                                <ul>
                                                                    <li>
                                                                        <input type="radio" name="Day" id="fullDay" />
                                                                        <img src="{{ asset('public/assets/latest/images/night-day.png') }}" alt="" />
                                                                        <label for="fullDay">Full Day</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="radio" name="Day" id="sHalfDay" />
                                                                        <img src="{{ asset('public/assets/latest/images/night-day.png') }}" alt="" />
                                                                        <label for="sHalfDay">Second half workday (HD2)</label>
                                                                    </li>
                                                                </ul>
                                                                <ul>
                                                                    <li>
                                                                        <input type="radio" name="Day" id="fHalfDay" />
                                                                        <img src="{{ asset('public/assets/latest/images/night-day.png') }}" alt="" />
                                                                        <label for="fHalfDay">First half workday (HD1)</label>
                                                                    </li>
                                                                    <li>
                                                                        <input type="radio" name="Day" id="customDay" />
                                                                        <img src="{{ asset('public/assets/latest/images/custom-wheel.png') }}" alt="" />
                                                                        <label for="customDay">Custom</label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="date_selector">
                                                                <span>Select date :</span>
                                                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
                                                                <style>
                                                                    #dateRange {
                                                                        border-radius: 8px;
                                                                        padding: 10px 12px;
                                                                        border: 1px solid #ccc;
                                                                        width: 100%;
                                                                        font-size: 14px;
                                                                        margin-top: 10px;
                                                                    }
                                                                </style>
                                                                <input type="text" id="dateRange" placeholder="dd / mm / yyyy - dd / mm / yyyy" />
                                                            
                                                            
                                                            </div>

                                                            <div class="leave_slot_selector">
                                                                <span>Select Leave Slot :</span>
                                                                <div class="day_and_night_selector">
                                                                    <div class="day_night">
                                                                        <span>Mid - Night</span>
                                                                        <div class="mid_night_img">
                                                                            <img src="{{ asset('public/assets/latest/images/moon.png') }}" alt="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="day_night">
                                                                        <span>Noon</span>
                                                                        <div class="mid_night_img">
                                                                            <img src="{{ asset('public/assets/latest/images/sun.png') }}" alt="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="day_night">
                                                                        <span>Mid - Night</span>
                                                                        <div class="mid_night_img">
                                                                            <img src="{{ asset('public/assets/latest/images/moon.png') }}" alt="" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="range_selector">
                                                                    <div class="range">
                                                                        <div class="range-slider">
                                                                            <span class="range-selected"></span>
                                                                            <span class="tooltips min-tooltip">7:30 AM</span>
                                                                            <span class="tooltips max-tooltip">4:00 PM</span>
                                                                        </div>

                                                                        <div class="range-input">
                                                                            <input type="range" class="min" min="0" max="47" value="15" step="1" />
                                                                            <input type="range" class="max" min="0" max="47" value="32" step="1" />
                                                                        </div>
                                                                    </div>
                                                                    @include('consultant.range-scale')
                                                                </div>
                                                            </div>
                                                            <div class="add_remark">
                                                                <span>Remarks</span>
                                                                <textarea name="remarks" id="customRemark" rows="6" placeholder="Write your remarks.."></textarea>
                                                            </div>
                                                            <div class="clock_it_btn">
                                                                <button class="ml_cancel_btn" data-bs-dismiss="modal" aria-label="Close">
                                                                    Cancel
                                                                </button>
                                                                <button class="ml_clockit_btn">
                                                                    Clock It
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-right">
                                                        <h3 class="mb_right_title">
                                                            Documents List
                                                        </h3>
                                                        <div class="ml_document_list">
                                                            <div class="ml_no_data">
                                                                <img src="{{ asset('public/assets/latest/images/no-file.png') }}" alt="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <script>
                                (function () {
                                    const modal = document.querySelector("#customLeave");
                                    if (!modal) return;

                                    const rangeInput = modal.querySelectorAll(".range-input input");
                                    const range = modal.querySelector(".range-selected");
                                    const minTooltip = modal.querySelector(".min-tooltip");
                                    const maxTooltip = modal.querySelector(".max-tooltip");
                                    const dateRange = modal.querySelector("#dateRange");
                                    const remarkInput = modal.querySelector("#customRemark");
                                    const clockItBtn = modal.querySelector(".ml_clockit_btn");
                                    const leaveTypeBtns = modal.querySelectorAll(".leave_type_options a");
                                    const selectedTypeInput = modal.querySelector("#selectedLeaveType");

                                    let editingBlock = null;

                                    const timeLabels = Array.from({ length: 48 }, (_, i) => {
                                        const hours = Math.floor(i / 2);
                                        const minutes = i % 2 === 0 ? "00" : "30";
                                        const suffix = hours >= 12 ? "PM" : "AM";
                                        const displayHours = hours % 12 === 0 ? 12 : hours % 12;
                                        return `${displayHours}:${minutes} ${suffix}`;
                                    });

                                    let dateRangeInstance = null; // ✅ Make this global

                                    document.addEventListener('DOMContentLoaded', function () {
                                    

                                        modal.addEventListener('shown.bs.modal', function () {
                                            if (dateRangeInstance) {
                                                dateRangeInstance.destroy();
                                            }

                                            // ✅ Get selected date from #customLeaveDisplay
                                            const dateText = document.getElementById("customLeaveDisplay").innerText.trim();
                                            let defaultDate = new Date(); // fallback: today

                                            if (dateText && dateText.includes("/")) {
                                                const [day, month, year] = dateText.split(" / ").map(Number);
                                                defaultDate = new Date(year, month - 1, day);
                                            }

                                            dateRangeInstance = flatpickr(dateRange, {
                                                mode: "range",
                                                dateFormat: "d / m / Y",
                                                minDate: "today",
                                                defaultDate: [defaultDate], // ✅ auto-set to clicked calendar cell
                                                disable: [
                                                    function (date) {
                                                        return (date.getDay() === 0 || date.getDay() === 6); // Sunday/Saturday
                                                    }
                                                ],
                                                onReady: function (selectedDates, dateStr, instance) {
                                                    const isRange = dateStr.includes("to");
                                                    rangeInput.forEach(input => input.disabled = isRange);
                                                    range.style.backgroundColor = isRange ? "transparent" : "#037EFF";
                                                },
                                                onClose: function (_, dateStr) {
                                                    const isRange = dateStr.includes("to");
                                                    rangeInput.forEach(input => input.disabled = isRange);
                                                    range.style.backgroundColor = isRange ? "transparent" : "#037EFF";
                                                }
                                            });
                                        });
                                    });

                                    function updateSlider() {
                                        let minVal = parseInt(rangeInput[0].value);
                                        let maxVal = parseInt(rangeInput[1].value);
                                        if (minVal > maxVal) [minVal, maxVal] = [maxVal, minVal];
                                        const percent1 = (minVal / 47) * 100;
                                        const percent2 = (maxVal / 47) * 100;
                                        range.style.left = percent1 + "%";
                                        range.style.width = percent2 - percent1 + "%";
                                        minTooltip.style.left = percent1 + "%";
                                        minTooltip.textContent = timeLabels[minVal];
                                        maxTooltip.style.left = percent2 + "%";
                                        maxTooltip.textContent = timeLabels[maxVal];
                                    }

                                    rangeInput.forEach(input => input.disabled = true);
                                    range.style.backgroundColor = "transparent";
                                    rangeInput.forEach(input => input.addEventListener("input", updateSlider));
                                    updateSlider();

                                    if (dateRange) {
                                        flatpickr(dateRange, {
                                            mode: "range",
                                            dateFormat: "d / m / Y",
                                            onClose: function (_, dateStr) {
                                                const disable = dateStr.includes("to");
                                                rangeInput.forEach(input => input.disabled = disable);
                                                range.style.backgroundColor = disable ? "transparent" : "#037EFF";
                                            }
                                        });
                                    }

                                    leaveTypeBtns.forEach(btn => {
                                        btn.addEventListener("click", function (e) {
                                            e.preventDefault();
                                            leaveTypeBtns.forEach(b => b.classList.remove("active"));
                                            this.classList.add("active");
                                            selectedTypeInput.value = this.dataset.type;
                                        });
                                    });

                                    if (clockItBtn) {
                                        clockItBtn.addEventListener("click", function () {
                                            const docList = modal.querySelector(".ml_document_list");
                                            const noDataImg = docList.querySelector(".ml_no_data");
                                            if (noDataImg) noDataImg.remove();

                                            const selectedDate = dateRange.value.trim();
                                            const selectedRadio = modal.querySelector('input[name="Day"]:checked');
                                            const leaveHourText = selectedRadio ? modal.querySelector(`label[for="${selectedRadio.id}"]`)?.textContent.trim() : "";
                                            const selectedRadioId = selectedRadio?.id || "";
                                            const leaveType = selectedTypeInput.value;
                                            const remark = remarkInput.value.trim();
                                            const rangeMin = rangeInput[0].value;
                                            const rangeMax = rangeInput[1].value;

                                            if (!selectedRadio) {
                                                alert("Please select leave hours.");
                                                return;
                                            }
                                            if (!leaveType) {
                                                alert("Please select a leave type.");
                                                return;
                                            }

                                            const blockHTML = `
                                                <div class="ml_card" style="display: flex; flex-direction: column; font-size: 10px; gap: 5px;">
                                                    <div style="display: flex; align-items: center; gap: 8px;">
                                                        <i class="fa-solid fa-calendar-days"></i>
                                                        <span><strong>${selectedDate}</strong></span>
                                                    </div>
                                                    <div><strong>Leave Type:</strong> ${leaveType}</div>
                                                    <div><strong>ML leave hours:</strong> ${leaveHourText}</div>
                                                    <div style="margin-left: auto; margin-top: 8px; display: flex; gap: 10px;">
                                                        <button title="Edit" class="edit-btn" style="border: none; background: none; cursor: pointer;">
                                                            <i class="fa-solid fa-pen-to-square" style="color: #ff6f00;"></i>
                                                        </button>
                                                        <button title="Delete" class="close-expense" style="border: none; background: none; cursor: pointer;">
                                                            <i class="fa-solid fa-trash" style="color: red;"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            `;

                                            let expenseBlock = editingBlock || document.createElement("div");
                                            expenseBlock.classList.add("expense-block");
                                            expenseBlock.style.cssText = `
                                                background: white;
                                                border-radius: 10px;
                                                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                                                padding: 15px;
                                                margin: 12px;
                                                margin-top: 12px;
                                                position: relative;
                                            `;
                                            expenseBlock.innerHTML = blockHTML;

                                            expenseBlock.dataset.leaveDate = selectedDate;
                                            expenseBlock.dataset.leaveHourId = selectedRadioId;
                                            expenseBlock.dataset.leaveType = leaveType;
                                            expenseBlock.dataset.rangeMin = rangeMin;
                                            expenseBlock.dataset.rangeMax = rangeMax;
                                            expenseBlock.dataset.remark = remark;

                                            if (!editingBlock) {
                                                docList.appendChild(expenseBlock);
                                            }

                                            editingBlock = null;
                                            modal.classList.remove("editing-mode");

                                            const formData = new FormData();
                                                formData.append("type", "timesheet");
                                                formData.append("user_id", "{{ $userData['id'] ?? '' }}");
                                                formData.append("client_id", "{{ $consultant->client_id ?? '' }}");
                                                formData.append("client_name", "{{ $consultant->client_name ?? '' }}");

                                                const recordData = {
                                                    date: selectedDate,
                                                    leaveType: `Custom ${leaveType}`,
                                                    leaveHour: leaveHourText,
                                                    leaveHourId: selectedRadioId,
                                                    applyOnCell: document.getElementById("customLeaveDisplay").innerText.trim()
                                                };


                                                if (!selectedDate.includes("to")) {
                                                    recordData.rangeMin = rangeMin;
                                                    recordData.rangeMax = rangeMax;
                                                }

                                                formData.append("record", JSON.stringify(recordData));
                                              

                                                fetch("{{ route('consultant.data.save') }}", {
                                                    method: "POST",
                                                    headers: {
                                                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                                                    },
                                                    body: formData
                                                })
                                                .then(res => {
                                                    if (!res.ok) throw new Error("Server error " + res.status);
                                                    return res.json();
                                                })
                                                .then(data => {
                                                    console.log("Saved successfully:", data);
                                                    //bootstrap.Modal.getInstance(document.getElementById("medicalLeave")).hide();

                                                    // Now call applyTag
                                                    applyTag(lastClickedCell, "Custom", "#007bff");
                                                })
                                                .catch(error => {
                                                    console.error("Fetch error:", error);
                                                });

                                            expenseBlock.querySelector(".edit-btn").addEventListener("click", function () {
                                                editingBlock = expenseBlock;
                                                dateRange._flatpickr.setDate(expenseBlock.dataset.leaveDate.split(" to "), true, "d / m / Y");

                                                const radio = modal.querySelector(`input[id="${expenseBlock.dataset.leaveHourId}"]`);
                                                if (radio) radio.checked = true;

                                                const disable = expenseBlock.dataset.leaveDate.includes("to");
                                                rangeInput.forEach(input => input.disabled = disable);
                                                range.style.backgroundColor = disable ? "transparent" : "#037EFF";
                                                if (expenseBlock.dataset.rangeMin && expenseBlock.dataset.rangeMax) {
                                                    rangeInput[0].value = expenseBlock.dataset.rangeMin;
                                                    rangeInput[1].value = expenseBlock.dataset.rangeMax;
                                                    updateSlider();
                                                }

                                                leaveTypeBtns.forEach(b => {
                                                    b.classList.toggle("active", b.dataset.type === expenseBlock.dataset.leaveType);
                                                });
                                                selectedTypeInput.value = expenseBlock.dataset.leaveType;
                                                remarkInput.value = expenseBlock.dataset.remark || "";

                                                modal.classList.add("editing-mode");
                                                modal.scrollIntoView({ behavior: "smooth" });
                                            });

                                            expenseBlock.querySelector(".close-expense").addEventListener("click", function () {
                                                expenseBlock.remove();
                                                if (!docList.querySelector(".expense-block")) {
                                                    const img = document.createElement("img");
                                                    img.src = "{{ asset('public/assets/latest/images/no-file.png') }}";
                                                    img.alt = "";
                                                    img.classList.add("ml_no_data");
                                                    docList.appendChild(img);
                                                }
                                            });
                                        });
                                    }

                                    modal.addEventListener("hidden.bs.modal", function () {
                                        if (dateRange._flatpickr) {
                                            dateRange._flatpickr.clear();
                                        }
                                        modal.querySelectorAll('input[name="Day"]').forEach(input => input.checked = false);
                                        rangeInput[0].value = 15;
                                        rangeInput[1].value = 32;
                                        updateSlider();
                                        leaveTypeBtns.forEach(btn => btn.classList.remove("active"));
                                        selectedTypeInput.value = "";
                                        remarkInput.value = "";
                                        modal.classList.remove("editing-mode");
                                        editingBlock = null;
                                    });

                                    const style = document.createElement("style");
                                    style.innerHTML = `
                                        #customLeave.editing-mode .modal-content {
                                            outline: 2px dashed #ffc107;
                                            outline-offset: -6px;
                                            box-shadow: 0 0 0 3px rgba(255,193,7,0.25);
                                        }
                                        .leave_type_options a.active {
                                            background-color: #037eff;
                                            color: white;
                                            padding: 10px 20px;
                                            border-radius: 12px;
                                            display: inline-block;
                                        }
                                    `;
                                    document.head.appendChild(style);
                                })();
                                </script>


                                <script>
                                    const calendarDays = document.getElementById("calendarDays");
                                    const monthSelect = document.getElementById("monthSelect");
                                    const yearSelect = document.getElementById("yearSelect");
                                    const dropdownSuggestions = [
                                        { label: "PH", icon: "&#128170;" },
                                        { label: "AL", icon: "&#127873;" },
                                        { label: "ML", icon: "&#128154;" },
                                        { label: "PDO", icon: "&#128100;&#8205;&#9794;️" },
                                        { label: "Custom", icon: "&#128295;" },
                                    ];

                                    let currentDate = new Date();
                                    let highlightedCell = null;

                                    function populateMonthYearSelectors() {
                                        const months = Array.from({ length: 12 }, (_, i) => new Date(0, i).toLocaleString("default", { month: "long" }));
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

                                        calendarDays.querySelectorAll(".calendar-cell").forEach((e) => e.remove());

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
                                            const today = new Date();
                                                today.setHours(0, 0, 0, 0); // Normalize time

                                                if (day === 0 || day === 6 || date < today) {
                                                    cell.classList.add("disabled");
                                                } else {
                                                    cell.addEventListener("click", (e) => showInputDropdown(e, cell, date));
                                                }


                                            // Add example tags with blue color
                                            const tagRules = {};

                                            @foreach ($dataTimesheet as $item)
                                                @php
                                                    $record = json_decode($item->record ?? '{}', true);
                                                    $applyDate = $record['applyOnCell'] ?? null;
                                                    $rawLabel = $record['leaveType'] ?? null;

                                                    // Normalize label: if it starts with "Custom", only use "Custom"
                                                    $label = Str::startsWith($rawLabel, 'Custom') ? 'Custom' : $rawLabel;

                                                    if ($applyDate && $label) {
                                                        try {
                                                            $dt = \Carbon\Carbon::createFromFormat('d / m / Y', $applyDate);
                                                            $monthYear = ($dt->month - 1) . '-' . $dt->year; // Zero-based month
                                                            $index = $dt->day;
                                                        } catch (Exception $e) {
                                                            $monthYear = null;
                                                            $index = null;
                                                        }
                                                    }
                                                @endphp

                                                @php
                                                    $rangeParts = explode(' to ', $record['date'] ?? '');
                                                @endphp

                                                @if (count($rangeParts) === 2)
                                                    @php
                                                        try {
                                                            $start = \Carbon\Carbon::createFromFormat('d / m / Y', trim($rangeParts[0]));
                                                            $end = \Carbon\Carbon::createFromFormat('d / m / Y', trim($rangeParts[1]));
                                                            for ($day = $start->copy(); $day->lte($end); $day->addDay()) {
                                                                $monthYear = ($day->month - 1) . '-' . $day->year;
                                                                $index = $day->day;
                                                                $clickable = $day->equalTo($start); // only start date clickable
                                                                echo "if (!tagRules['$monthYear']) tagRules['$monthYear'] = [];";
                                                                echo "tagRules['$monthYear'].push({ index: $index, label: '$label', clickable: " . ($clickable ? 'true' : 'false') . " });";
                                                            }
                                                        } catch (\Exception $e) {}
                                                    @endphp
                                                @elseif (isset($monthYear) && isset($index))
                                                    tagRules["{{ $monthYear }}"] = tagRules["{{ $monthYear }}"] || [];
                                                    tagRules["{{ $monthYear }}"].push({ index: {{ $index }}, label: "{{ $label }}", clickable: true });
                                                @endif
                                            @endforeach


                                           
                                            

                                            // Example: current month = 4, year = 2025
                                            const currentKey = `${month}-${year}`;
                                            if (tagRules[currentKey]) {
                                                tagRules[currentKey].forEach((rule) => {
                                                    if (i === rule.index) {
                                                        applyTag(cell, rule.label, "#007bff");

                                                        // if rule is not clickable, disable the cell
                                                        if (!rule.clickable) {
                                                            cell.classList.add("disabled");
                                                        }
                                                    }
                                                });
                                            }


                                            calendarDays.appendChild(cell);
                                        }
                                    }

                                    function showInputDropdown(event, cell, date) {
                                        closeAllDropdowns();

                                        const dropdown = document.createElement("div");
                                        dropdown.classList.add("dropdown");

                                        const cellRect = cell.getBoundingClientRect();
                                        const dropdownWidth = 180;
                                        const leftPosition = -0.3958;
                                        dropdown.style.left = `${leftPosition}px`;

                                        const input = document.createElement("input");
                                        input.placeholder = "Type label...";

                                        const suggestionBox = document.createElement("div");
                                        suggestionBox.className = "suggestions";

                                        function updateSuggestions(val) {
                                            suggestionBox.innerHTML = "";
                                            dropdownSuggestions
                                                .filter((s) => s.label.toLowerCase().includes(val.toLowerCase()))
                                                .forEach((item) => {
                                                    const opt = document.createElement("div");
                                                    opt.innerHTML = `<span style="margin-right: 8px;">${item.icon}</span>${item.label}`;
                                                    opt.onclick = () => {
                                                        const formattedDate = new Date(date);
                                                        const day = String(formattedDate.getDate()).padStart(2, "0");
                                                        const month = String(formattedDate.getMonth() + 1).padStart(2, "0"); // 0-based index
                                                        const year = formattedDate.getFullYear();
                                                        const finalDate = `${day} / ${month} / ${year}`;
                                                        //console.log("check item",item);
                                                        if (item.label === "ML") {
                                                            document.getElementById("medicalLeaveDateDisplay").innerText = finalDate;
                                                            window.lastClickedCell = cell;
                                                            window.lastClickedItemLabel = item.label;

                                                            const modal = new bootstrap.Modal(document.getElementById("medicalLeave"));
                                                            modal.show();
                                                        }
                                                        if (item.label === "Custom") {
                                                            document.getElementById("customLeaveDisplay").innerText = finalDate;
                                                            window.lastClickedCell = cell;
                                                            window.lastClickedItemLabel = item.label;

                                                            const modalCustomLeave = new bootstrap.Modal(document.getElementById("customLeave"));
                                                            modalCustomLeave.show();
                                                        }
                                                        if (item.label === "PH" || item.label === "AL" || item.label === "PDO") {

                                                            const formData = new FormData();
                                                            formData.append("type", "timesheet");
                                                            formData.append("user_id", "{{ $userData['id'] ?? '' }}");
                                                            formData.append("client_id", "{{ $consultant->client_id ?? '' }}");
                                                            formData.append("client_name", "{{ $consultant->client_name ?? '' }}");

                                                            const recordData = {
                                                                date: '',
                                                                leaveType: item.label,
                                                                applyOnCell: finalDate
                                                            };
                                                         
                                                            formData.append("record", JSON.stringify(recordData));
                                                            

                                                            fetch("{{ route('consultant.data.save') }}", {
                                                                method: "POST",
                                                                headers: {
                                                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                                                                },
                                                                body: formData
                                                            })
                                                            .then(res => {
                                                                if (!res.ok) throw new Error("Server error " + res.status);
                                                                return res.json();
                                                            })
                                                            .then(data => {
                                                                console.log("Saved successfully:", data);
                                                                bootstrap.Modal.getInstance(document.getElementById("medicalLeave")).hide();

                                                                // Now call applyTag
                                                                applyTag(lastClickedCell, "ML", "#007bff");
                                                            })
                                                            .catch(error => {
                                                                console.error("Fetch error:", error);
                                                            });


                                                            applyTag(cell, item.label, "#007bff");
                                                        }
                                                        dropdown.remove();
                                                    };
                                                    suggestionBox.appendChild(opt);
                                                });
                                        }

                                        input.addEventListener("input", () => updateSuggestions(input.value));
                                        input.addEventListener("keydown", (e) => {
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
                                        // Remove any existing tags
                                        cell.querySelectorAll(".tag").forEach((t) => t.remove());

                                        // Make cell flex-centered
                                        cell.style.display = "flex";
                                        cell.style.flexDirection = "column";
                                        cell.style.justifyContent = "center";
                                        cell.style.alignItems = "center";
                                        cell.style.textAlign = "center";
                                        cell.style.position = "relative";

                                        // Adjust the date (top text)
                                        const dateLabel = cell.querySelector(".cell-date");
                                        if (dateLabel) {
                                            dateLabel.style.marginBottom = "4px";
                                            dateLabel.style.fontSize = "12px";
                                        }

                                        // Create the tag
                                        const tag = document.createElement("div");
                                        tag.className = "tag";
                                        tag.innerText = label;

                                        // Style the tag
                                        tag.style.fontSize = "15px";
                                        tag.style.margin = "0";
                                        tag.style.padding = "0";
                                        tag.style.lineHeight = "1";

                                        // Set color logic
                                        if (["PDO", "PH", "AL", "ML"].includes(label)) {
                                            tag.style.color = "blue";
                                        } else if (!isNaN(label) && parseInt(label) < 8) {
                                            tag.style.color = "red";
                                        } else {
                                            tag.style.color = color; // fallback
                                        }

                                        // Append the tag
                                        cell.appendChild(tag);
                                    }


                                    function closeAllDropdowns() {
                                        document.querySelectorAll(".dropdown").forEach((d) => d.remove());
                                    }

                                    function changeMonth(delta) {
                                        currentDate.setMonth(currentDate.getMonth() + delta);
                                        monthSelect.value = currentDate.getMonth();
                                        yearSelect.value = currentDate.getFullYear();
                                        renderCalendar();
                                    }

                                    document.addEventListener("click", function (e) {
                                        if (!e.target.closest(".calendar-cell")) closeAllDropdowns();
                                    });

                                    populateMonthYearSelectors();
                                    renderCalendar();
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" col-xl-4">
                    <div class="timeline-parent-col">
                        <h6>
                            <i class="fa-solid fa-caret-down"></i>
                            {{ $consultant->client_name ?? 'N/A' }}
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
                        </div>
                        </li>
                        </ul>

                    </div>
                </div>

                <div class="row mt-3 bottom-remark-timesheet-group">
                    <div class="col-lg-6 col-xl-4 mb-4 mb-xl-none">
                        <div class="work-summary">
                            <!-- Expand Button -->
                            <button class="expand-btn" data-bs-toggle="modal" data-bs-target="#workSummaryModal">
                                <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" class="img-fluid" />
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

                            <div class="tab-content tab_content_body border border-top-0 p-1 p-xxl-3" id="workTabsContent">
                                <div class="tab-pane fade" id="leave" role="tabpanel" aria-labelledby="leave-tab">
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
                                                    <td><span class="leave-type pdo lt_btn1">PDO</span></td>
                                                    <td>05/05/2024</td>
                                                    <td>05/05/2024</td>
                                                    <td class="half-day">1/2</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="leave-type ml lt_btn1">ML <sup>HD1</sup></span>
                                                    </td>
                                                    <td>09/05/2024</td>
                                                    <td>09/05/2024</td>
                                                    <td class="half-day">1/2</td>
                                                </tr>
                                                <tr>
                                                    <td><span class="leave-type ul lt_btn2">UL</span></td>
                                                    <td>11/05/2024</td>
                                                    <td>11/05/2024</td>
                                                    <td class="half-day">1/2</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="leave-type ul-hd lt_btn2">UL <sup>HD1</sup></span>
                                                    </td>
                                                    <td>22/05/2024</td>
                                                    <td>22/05/2024</td>
                                                    <td class="half-day">1/2</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
                                    <div class="modal-header">
                                        <button type="button" class="btn-close popup-expand-btn" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Reuse same tab structure inside modal -->
                                        <ul class="nav nav-tabs popup_tabs" id="modalTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link tab_btn" id="modal-leave-tab" data-bs-toggle="tab" data-bs-target="#modal-leave" type="button" role="tab">Leave Log</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link tab_btn active" id="modal-summary-tab" data-bs-toggle="tab" data-bs-target="#modal-summary" type="button" role="tab">Work Log Summary</button>
                                            </li>
                                        </ul>

                                        <div class="tab-content tab_content_body">
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
                                                                <td><span class="leave-type pdo lt_btn1">PDO</span></td>
                                                                <td>05/05/2024</td>
                                                                <td>05/05/2024</td>
                                                                <td class="half-day">1/2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span class="leave-type ml lt_btn1">ML <sup>HD1</sup></span>
                                                                </td>
                                                                <td>09/05/2024</td>
                                                                <td>09/05/2024</td>
                                                                <td class="half-day">1/2</td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="leave-type ul lt_btn2">UL</span></td>
                                                                <td>11/05/2024</td>
                                                                <td>11/05/2024</td>
                                                                <td class="half-day">1/2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <span class="leave-type ul-hd lt_btn2">UL <sup>HD1</sup></span>
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
                                                        <div class="stats-label">Total Work Hours</div>
                                                    </div>
                                                    <div>
                                                        <div class="stats-number">168</div>
                                                        <div class="stats-label">Billed Work Hours</div>
                                                    </div>
                                                </div>

                                                <div class="bottom-stats">
                                                    <div class="stats_score">
                                                        <span class="w_hrs">06.30</span>
                                                        / <span class="tw_hrs">15</span>
                                                        <p>Total Work Hours</p>
                                                    </div>
                                                    <div class="stats_score">
                                                        <span class="w_hrs">05.30</span>
                                                        / <span class="tw_hrs">15</span>
                                                        <p>AL</p>
                                                    </div>
                                                    <div class="stats_score">
                                                        <span class="w_hrs">01.45</span>
                                                        / <span class="tw_hrs">14</span>
                                                        <p>MC</p>
                                                    </div>
                                                    <div class="stats_score">
                                                        <span class="w_hrs">01.30</span>
                                                        / <span class="tw_hrs">03</span>
                                                        <p>Total Work Hours</p>
                                                    </div>
                                                    <div class="stats_score">
                                                        <span class="w_hrs">0.30</span>
                                                        / <span class="tw_hrs">02</span>
                                                        <p>PDO</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-4 mb-4 mb-xl-none">
                        <div class="remark-section card p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6>Remarks</h6>
                                <div class="btn-group-remark">
                                    <button class="btn btn-link p-0 text-danger" data-bs-toggle="modal" data-bs-target="#remarksModal">
                                        <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" class="img-fluid" />
                                    </button>

                                    <!-- edit button -->
                                    <!-- <button class="flow-edit-btn" data-bs-toggle="modal" data-bs-target="#editRemarksModal">
                                        <i class="fa-solid fa-pen-nib"></i>
                                    </button> -->
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
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="remarksModalLabel">Remarks</h5>
                                        <button type="button" class="btn-close popup-expand-btn" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- You can repeat the same timeline markup from above here -->
                                        <div class="remark-timeline">
                                            <div class="remark-item mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="me-3 text-primary">
                                                        <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                        <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                            <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small>
                                                        </div>
                                                        <p>This is Approved, Thank you for the excellent contribution</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="remark-item mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="me-3 text-primary">
                                                        <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                        <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                            <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small>
                                                        </div>
                                                        <p>This is Approved, Thank you for the excellent contribution</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="remark-item mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="me-3 text-primary">
                                                        <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                        <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                            <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small>
                                                        </div>
                                                        <p>This is Approved, Thank you for the excellent contribution</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="remark-item mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="me-3 text-primary">
                                                        <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                        <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                            <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small>
                                                        </div>
                                                        <p>This is Approved, Thank you for the excellent contribution</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="editRemarksModal" tabindex="-1" aria-labelledby="editRemarksModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="remark_popup_detial">
                                            <div class="r_img">
                                                <img src="{{ asset('public/assets/latest/images/emp-icon1.png') }}" class="img-fluid" />
                                            </div>
                                            <div class="r_detail">
                                                <span class="r_name">{{ $consultant->emp_name ?? 'N/A' }}</span>
                                                <p class="r_id">Employee Id : {{ $consultant->emp_code ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <div class="remark_popup_detial">
                                            <div class="r_img">
                                                <img src="{{ asset('public/assets/latest/images/emp-icon1.png') }}" class="img-fluid" />
                                            </div>
                                            <div class="r_detail">
                                                <span class="r_name">Erin</span>
                                                <p class="r_id">HR</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="rc_detail_box">
                                            <div class="rc_left_detail">
                                                <div class="rc_box">
                                                    <div class="rc_img">
                                                        <img src="{{ asset('public/assets/latest/images/client-icon-1.png') }}" class="img-fluid" />
                                                    </div>
                                                    <span class="rc_name">{{ $consultant->client_name ?? 'N/A' }}</span>
                                                </div>
                                                <p class="rc_status">
                                                    Remarks For : <span>Approved <i class="fa-solid fa-check"></i></span>
                                                </p>
                                            </div>
                                            <div class="rc_right_detail">
                                                <p>Designation : <span>Information Security Analyst</span></p>
                                            </div>
                                        </div>
                                        <div class="r_text_area">
                                            <textarea name="r_update" id="" placeholder="Your timesheet was Approved."></textarea>
                                        </div>

                                        <div class="r_update_btn">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                Cancel
                                            </button>
                                            <button type="button" class="r_submit_btn">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-4">
                        <div class="timesheet-section card p-2">
                            <!-- Tabs -->
                            <div class="timesheet-header d-flex justify-content-between align-items-start">
                                <ul class="nav nav-tabs" id="timesheetTabs">
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
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#copiesTab">Get Copies</button>
                                    </li>
                                </ul>

                                <!-- model expand button -->
                                <button class="expand-btn" data-bs-toggle="modal" data-bs-target="#timesheetModal">
                                    <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" class="img-fluid" />
                                </button>
                            </div>

                            <!-- Tab Contents -->
                            <div class="tab-content tab_content_body p-2">
                                <div class="tab-pane fade show active" id="overviewTab">
                                    <div class="timeline">
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span class="text-primary">PH - (1)</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>Sat, 15 Aug - </span>
                                                    <span class="badge">PH</span>
                                                    <span>-</span>
                                                    <span class="text-primary badge badge bold_text"> Paid day off</span>
                                                    <span> - 3 hours off</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span class="text-primary">PH - (1)</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>Sat, 15 Aug - </span>
                                                    <span class="badge">PH</span>
                                                    <span>-</span>
                                                    <span class="text-primary badge badge bold_text"> Paid day off</span>
                                                    <span> - 3 hours off</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span class="text-primary">PH - (1)</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>Sat, 15 Aug - </span>
                                                    <span class="badge">PH</span>
                                                    <span>-</span>
                                                    <span class="text-primary badge bold_text"> Paid day off</span>
                                                    <span> - 3 hours off</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span class="text-primary">PH - (1)</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>Sat, 15 Aug - </span>
                                                    <span class="badge">PH</span>
                                                    <span>-</span>
                                                    <span class="text-primary badge bold_text"> Paid day off</span>
                                                    <span> - 3 hours off</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span class="text-primary">PH - (1)</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>Sat, 15 Aug - </span>
                                                    <span class="badge">PH</span>
                                                    <span>-</span>
                                                    <span class="text-primary badge bold_text"> Paid day off</span>
                                                    <span> - 3 hours off</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span class="text-primary">PH - (1)</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>Sat, 15 Aug - </span>
                                                    <span class="badge">PH</span>
                                                    <span>-</span>
                                                    <span class="text-primary badge bold_text"> Paid day off</span>
                                                    <span> - 3 hours off</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span class="text-primary">PH - (1)</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>Sat, 15 Aug - </span>
                                                    <span class="badge">PH</span>
                                                    <span>-</span>
                                                    <span class="text-primary badge bold_text"> Paid day off</span>
                                                    <span> - 3 hours off</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span class="text-primary">PH - (1)</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>Sat, 15 Aug - </span>
                                                    <span class="badge">PH</span>
                                                    <span>-</span>
                                                    <span class="text-primary badge bold_text"> Paid day off</span>
                                                    <span> - 3 hours off</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Other tabs can be filled similarly -->
                                <div class="tab-pane fade" id="extraTimeTab">
                                    <div class="timeline">
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span>Comp - Off</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>15/08/2024 -</span>
                                                    <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                    <span>- 4 : 00 hours</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span>Comp - Off</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>15/08/2024 -</span>
                                                    <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                    <span>- 4 : 00 hours</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span>Comp - Off</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>15/08/2024 -</span>
                                                    <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                    <span>- 4 : 00 hours</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span>Comp - Off</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>15/08/2024 -</span>
                                                    <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                    <span>- 4 : 00 hours</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span>Comp - Off</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>15/08/2024 -</span>
                                                    <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                    <span>- 4 : 00 hours</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="timeline">
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <span>Comp - Off</span>
                                                </div>
                                                <div class="tl_details">
                                                    <span>15/08/2024 -</span>
                                                    <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                    <span>- 4 : 00 hours</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="payOffTab">
                                    <div class="timeline">
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="pay_off_log">
                                                        <span>03/08/2024 - </span>
                                                        <span>4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="pay_off_log">
                                                        <span>03/08/2024 - </span>
                                                        <span>4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="pay_off_log">
                                                        <span>03/08/2024 - </span>
                                                        <span>4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="pay_off_log">
                                                        <span>03/08/2024 - </span>
                                                        <span>4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="pay_off_log">
                                                        <span>03/08/2024 - </span>
                                                        <span>4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="pay_off_log">
                                                        <span>03/08/2024 - </span>
                                                        <span>4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="pay_off_log">
                                                        <span>03/08/2024 - </span>
                                                        <span>4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="pay_off_log">
                                                        <span>03/08/2024 - </span>
                                                        <span>4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="compOffTab">
                                    <div class="timeline">
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="comp_off_log">
                                                        <span>03/08/2024 -</span>
                                                        <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                        <span>- 4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="comp_off_log">
                                                        <span>03/08/2024 -</span>
                                                        <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                        <span>- 4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="comp_off_log">
                                                        <span>03/08/2024 -</span>
                                                        <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                        <span>- 4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="comp_off_log">
                                                        <span>03/08/2024 -</span>
                                                        <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                        <span>- 4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="comp_off_log">
                                                        <span>03/08/2024 -</span>
                                                        <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                        <span>- 4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="comp_off_log">
                                                        <span>03/08/2024 -</span>
                                                        <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                        <span>- 4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item d-flex align-items-start mb-3">
                                            <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                    <div class="comp_off_log">
                                                        <span>03/08/2024 -</span>
                                                        <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                        <span>- 4 : 00 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="copiesTab">Get Copies Content</div>
                            </div>
                        </div>

                        <!-- Modal for Expanded View -->
                        <div class="modal fade" id="timesheetModal" tabindex="-1" aria-labelledby="timesheetModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close popup-expand-btn" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- You can repeat the same timeline markup from above here -->
                                        <!-- Tabs -->
                                        <div class="timesheet-header d-flex justify-content-between align-items-center">
                                            <ul class="nav nav-tabs popup_tabs" id="timesheetTabs">
                                                <li class="nav-item">
                                                    <button class="nav-link tab_btn active" data-bs-toggle="tab" data-bs-target="#modeloverviewTab">Timesheet Overview</button>
                                                </li>
                                                <li class="nav-item">
                                                    <button class="nav-link tab_btn" data-bs-toggle="tab" data-bs-target="#modelextraTimeTab">Extra Time Log</button>
                                                </li>
                                                <li class="nav-item">
                                                    <button class="nav-link tab_btn" data-bs-toggle="tab" data-bs-target="#modelpayOffTab">Pay-Off Log</button>
                                                </li>
                                                <li class="nav-item">
                                                    <button class="nav-link tab_btn" data-bs-toggle="tab" data-bs-target="#modelcompOffTab">Comp-off log</button>
                                                </li>
                                                <li class="nav-item">
                                                    <button class="nav-link tab_btn" data-bs-toggle="tab" data-bs-target="#modelcopiesTab">Get Copies</button>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Tab Contents -->
                                        <div class="tab-content tab_content_body">
                                            <div class="tab-pane fade show active" id="modeloverviewTab">
                                                <div class="timeline">
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span class="text-primary">PH - (1)</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>Sat, 15 Aug - </span>
                                                                <span class="badge">PH</span>
                                                                <span>-</span>
                                                                <span class="text-primary badge badge bold_text"> Paid day off</span>
                                                                <span> - 3 hours off</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span class="text-primary">PH - (1)</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>Sat, 15 Aug - </span>
                                                                <span class="badge">PH</span>
                                                                <span>-</span>
                                                                <span class="text-primary badge badge bold_text"> Paid day off</span>
                                                                <span> - 3 hours off</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span class="text-primary">PH - (1)</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>Sat, 15 Aug - </span>
                                                                <span class="badge">PH</span>
                                                                <span>-</span>
                                                                <span class="text-primary badge bold_text"> Paid day off</span>
                                                                <span> - 3 hours off</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span class="text-primary">PH - (1)</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>Sat, 15 Aug - </span>
                                                                <span class="badge">PH</span>
                                                                <span>-</span>
                                                                <span class="text-primary badge bold_text"> Paid day off</span>
                                                                <span> - 3 hours off</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span class="text-primary">PH - (1)</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>Sat, 15 Aug - </span>
                                                                <span class="badge">PH</span>
                                                                <span>-</span>
                                                                <span class="text-primary badge bold_text"> Paid day off</span>
                                                                <span> - 3 hours off</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span class="text-primary">PH - (1)</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>Sat, 15 Aug - </span>
                                                                <span class="badge">PH</span>
                                                                <span>-</span>
                                                                <span class="text-primary badge bold_text"> Paid day off</span>
                                                                <span> - 3 hours off</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span class="text-primary">PH - (1)</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>Sat, 15 Aug - </span>
                                                                <span class="badge">PH</span>
                                                                <span>-</span>
                                                                <span class="text-primary badge bold_text"> Paid day off</span>
                                                                <span> - 3 hours off</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span class="text-primary">PH - (1)</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>Sat, 15 Aug - </span>
                                                                <span class="badge">PH</span>
                                                                <span>-</span>
                                                                <span class="text-primary badge bold_text"> Paid day off</span>
                                                                <span> - 3 hours off</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Other tabs can be filled similarly -->
                                            <div class="tab-pane fade" id="modelextraTimeTab">
                                                <div class="timeline">
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span>Comp - Off</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>15/08/2024 -</span>
                                                                <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                <span>- 4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline">
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span>Comp - Off</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>15/08/2024 -</span>
                                                                <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                <span>- 4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline">
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span>Comp - Off</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>15/08/2024 -</span>
                                                                <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                <span>- 4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline">
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span>Comp - Off</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>15/08/2024 -</span>
                                                                <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                <span>- 4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline">
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span>Comp - Off</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>15/08/2024 -</span>
                                                                <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                <span>- 4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="timeline">
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span>Comp - Off</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>15/08/2024 -</span>
                                                                <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                <span>- 4 : 00 hours</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="modelpayOffTab">
                                                <div class="timeline">
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="pay_off_log">
                                                                    <span>03/08/2024 - </span>
                                                                    <span>4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="pay_off_log">
                                                                    <span>03/08/2024 - </span>
                                                                    <span>4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="pay_off_log">
                                                                    <span>03/08/2024 - </span>
                                                                    <span>4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="pay_off_log">
                                                                    <span>03/08/2024 - </span>
                                                                    <span>4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="pay_off_log">
                                                                    <span>03/08/2024 - </span>
                                                                    <span>4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="pay_off_log">
                                                                    <span>03/08/2024 - </span>
                                                                    <span>4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="pay_off_log">
                                                                    <span>03/08/2024 - </span>
                                                                    <span>4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="pay_off_log">
                                                                    <span>03/08/2024 - </span>
                                                                    <span>4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="modelcompOffTab">
                                                <div class="timeline">
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="comp_off_log">
                                                                    <span>03/08/2024 -</span>
                                                                    <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                    <span>- 4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="comp_off_log">
                                                                    <span>03/08/2024 -</span>
                                                                    <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                    <span>- 4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="comp_off_log">
                                                                    <span>03/08/2024 -</span>
                                                                    <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                    <span>- 4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="comp_off_log">
                                                                    <span>03/08/2024 -</span>
                                                                    <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                    <span>- 4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="comp_off_log">
                                                                    <span>03/08/2024 -</span>
                                                                    <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                    <span>- 4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="comp_off_log">
                                                                    <span>03/08/2024 -</span>
                                                                    <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                    <span>- 4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <div class="comp_off_log">
                                                                    <span>03/08/2024 -</span>
                                                                    <span class="badge">Comp - Off <sub>HD1</sub></span>
                                                                    <span>- 4 : 00 hours</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="modelcopiesTab">
                                                <div class="timeline">
                                                    <div class="timeline-item d-flex align-items-start mb-3">
                                                        <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                                <span class="text-primary">PH - (1)</span>
                                                            </div>
                                                            <div class="tl_details">
                                                                <span>Sat, 15 Aug - </span>
                                                                <span class="badge">PH</span>
                                                                <span>-</span>
                                                                <span class="text-primary badge badge bold_text"> Paid day off</span>
                                                                <span> - 3 hours off</span>
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
    </div>

    <div class="tab-pane fade" id="claims" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
</div>
