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
                        <div class="modal fade common_modal" id="otherModal" tabindex="-1" aria-labelledby="cExpenseModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered modal-xl">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <div class="model_employee">
                                       <div class="model_emp_img">
                                          <!-- <img src="assets/images/emp-icon1.png" alt="" /> -->
                                       </div>
                                       <span class="model_emp_name">{{ $consultant->emp_name ?? 'N/A' }}</span>
                                    </div>
                                    <button type="button" class="btn-close ml-close-btn" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-xmark"></i>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="modal_body_inner">
                                       <div class="mb_left">
                                          <div class="ml_date_box">
                                             <div class="ml_date">
                                                <span>Date: <span id="showCellDate"></span></span>
                                             </div>
                                             <div class="ml_duty_time">
                                                <span>Claim Form # : <span> </span></span>
                                             </div>
                                          </div>
                                          <div class="ml_leave_detail">
                                             <div class="leave_type">
                                                <span>Select Expense Type :</span>
                                                <h2 id="showClaimName">Taxi</h2>
                                             </div>
                                             <form id="claimForm">
                                                <div class="e_form_fields">
                                                   <div class="container-fluid p-0">
                                                      <div class="row">
                                                         <div class="col-md-6 mb-4">
                                                            <label for="eDate" class="form-label">Date</label>
                                                            <input type="date" class="form-control" id="eDate" />
                                                            <script>
                                                               const today = new Date().toISOString().split('T')[0];
                                                               document.getElementById("eDate").setAttribute("min", today);
                                                            </script>
                                                         </div>
                                                         <div class="col-md-6 mb-4">
                                                            <label for="expenseType" class="form-label">Expense Type</label>
                                                            <select name="expenseType" id="expenseType" class="form-control">
                                                               <option value="Taxi">Taxi</option>
                                                               <option value="Dining">Dining</option>
                                                               <option value="Others">Others</option>
                                                            </select>
                                                         </div>
                                                         <div class="col-md-12 mb-4" id="otherExpenseWrapper" style="display: none;">
                                                            <label for="otherExpense" class="form-label">Write Your Expense</label>
                                                            <div class="other_exp_field">
                                                               <input type="text" class="form-control" id="otherExpense" />
                                                               <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip"
                                                                  data-bs-placement="bottom"
                                                                  title="Define Eligible Expense Types..."></i>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-6 mb-4">
                                                            <label for="eParticulars" class="form-label">Particulars</label>
                                                            <input type="text" class="form-control" id="eParticulars" />
                                                         </div>
                                                         <div class="col-md-6 mb-4">
                                                            <label for="eAmount" class="form-label">Amount $</label>
                                                            <input type="number" class="form-control" id="eAmount" />
                                                         </div>
                                                         <div class="col-md-6 mb-4" id="location1">
                                                            <label for="eLocationFrom" class="form-label">Location From</label>
                                                            <input type="text" class="form-control" id="eLocationFrom" />
                                                         </div>
                                                         <div class="col-md-6 mb-4" id="location2">
                                                            <label for="eLocationTo" class="form-label">Location To</label>
                                                            <input type="text" class="form-control" id="eLocationTo" />
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="add_remark">
                                                   <span>Remarks *</span>
                                                   <textarea name="remarks" id="customRemark" rows="4" placeholder="Max 200 words are allowed"></textarea>
                                                </div>
                                                <div class="upload_certificate">
                                                   <div class="file_input">
                                                      <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                                      <p>Upload Invoice / Receipt</p>
                                                   </div>
                                                   <input type="file" id="uploadFile" />
                                                   <p>*Allow to upload file <span>PNG, JPG, PDF</span> (Max.file size: 1MB)</p>
                                                </div>
                                                <div class="clock_it_btn">
                                                   <button type="button" id="closeBtn" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                   <button type="submit" id="saveBtn">Save</button>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                       <div class="mb-right">
                                          <h3 class="mb_right_title">
                                             Individual Claims List
                                          </h3>
                                          <div class="tab_type_list">
                                             @foreach($dataClaims as $claim)
                                             @php
                                             $record = json_decode($claim->record, true);
                                             @endphp
                                             <div class="tab_lists"
                                                data-db-id="{{ $claim->id }}"
                                                data-type="{{ $record['expenseType'] ?? '' }}"
                                                data-applyoncell="{{ $record['applyOnCell'] ?? '' }}">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                                                   <span class="list_date"><i class="fa-solid fa-calendar-days me-2"></i>{{ $record['date'] ?? '' }}</span>
                                                   <span class="list_e_type">Expenses Type : {{ $record['expenseType'] ?? '' }}</span>
                                                </div>
                                                <div class="flex-wrap d-flex align-items-center justify-content-between mb-2">
                                                   <span class="list_particulars">Particulars : {{ $record['particulars'] ?? '' }}</span>
                                                   <span class="list_e_amount">Amount : $ {{ number_format($record['amount'] ?? 0, 2) }}</span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-end">
                                                   <span class="list_icons">
                                                   <a href="#" class="badge_icon preview-attach" data-img="{{ asset($record['certificate_path'] ?? '') }}"><i class="fa-solid fa-paperclip"></i></a>
                                                   <a href="#" class="badge_icon edit-claim"
                                                      data-id="{{ $claim->id }}"
                                                      data-date="{{ $record['date'] ?? '' }}"
                                                      data-type="{{ $record['expenseType'] ?? '' }}"
                                                      data-particulars="{{ $record['particulars'] ?? '' }}"
                                                      data-amount="{{ $record['amount'] ?? '' }}"
                                                      data-remarks="{{ $record['remarks'] ?? '' }}"
                                                      data-locationfrom="{{ $record['locationFrom'] ?? '' }}"
                                                      data-locationto="{{ $record['locationTo'] ?? '' }}"
                                                      data-otherexpense="{{ $record['otherExpense'] ?? '' }}">
                                                   <i class="fa-solid fa-pen-nib"></i>
                                                   </a>
                                                   <a href="#" class="badge_icon delete-claim" data-id="{{ $claim->id }}"><i class="fa-solid fa-trash-can"></i></a>
                                                   </span>
                                                </div>
                                             </div>
                                             @endforeach
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <script>
                           document.addEventListener("DOMContentLoaded", function () {
                               document.querySelector(".tab_type_list").addEventListener("click", function (e) {
                                   const deleteBtn = e.target.closest(".delete-claim");
                                   if (deleteBtn) {
                                       e.preventDefault();
                           
                                       const card = deleteBtn.closest(".tab_lists");
                                       const id = deleteBtn.dataset.id;
                           
                                       if (confirm("Are you sure you want to delete this claim?")) {
                                           fetch("{{ route('consultant.claim.delete') }}", {
                                               method: "POST",
                                               headers: {
                                                   "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                                                   "Content-Type": "application/json"
                                               },
                                               body: JSON.stringify({ id: id })
                                           })
                                           .then(res => res.json())
                                           .then(data => {
                                               if (data.success) {
                                                   card.remove();
                                                   console.log("Deleted successfully.");
                                               } else {
                                                   alert("Failed to delete the claim.");
                                               }
                                           })
                                           .catch(err => {
                                               console.error("Delete error:", err);
                                               alert("An error occurred while deleting.");
                                           });
                                       }
                                   }
                               });
                           });
                        </script>
                        <script>
                           let editMode = false;
                           let editTarget = null;
                           let uploadedFileURL = null;
                           let uploadedFile = null;
                           
                           // Toggle fields if "Others"
                           document.getElementById("expenseType").addEventListener("change", function () {
                               const selected = this.value;
                               document.getElementById("otherExpenseWrapper").style.display = selected === "Others" ? "block" : "none";
                               document.getElementById("location1").style.display = selected === "Others" ? "block" : "none";
                               document.getElementById("location2").style.display = selected === "Others" ? "block" : "none";
                           });
                           
                           // File upload preview
                           document.getElementById("uploadFile").addEventListener("change", function () {
                               uploadedFile = this.files[0];
                               if (uploadedFile) {
                                   uploadedFileURL = URL.createObjectURL(uploadedFile);
                               }
                           });
                           
                           // Preview modal
                           function ensurePreviewModalExists() {
                               if (!document.getElementById("imagePreviewModal")) {
                                   const modal = document.createElement("div");
                                   modal.id = "imagePreviewModal";
                                   modal.style.cssText = `
                                       display: none; position: fixed; z-index: 9999; top: 0; left: 0;
                                       width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6);
                                       justify-content: center; align-items: center;
                                   `;
                                   modal.innerHTML = `
                                       <div id="previewContent" style="
                                           background: white; padding: 20px; border-radius: 10px; position: relative;
                                           animation: fadeIn 0.3s ease-in-out; max-width: 90%; max-height: 90%;">
                                           <span id="closePreview" style="position: absolute; top: 5px; right: 10px; font-size: 24px; cursor: pointer;">&times;</span>
                                           <img id="previewImgTag" src="" style="max-width: 100%; max-height: 80vh; border-radius: 8px;" />
                                       </div>
                                   `;
                                   document.body.appendChild(modal);
                                   document.getElementById("closePreview").onclick = () => {
                                       modal.style.display = "none";
                                       document.getElementById("previewImgTag").src = "";
                                   };
                               }
                           }
                           
                           // Form submit
                            document.getElementById("claimForm").addEventListener("submit", function (e) {
                                e.preventDefault();

                                const date = document.getElementById("eDate").value;
                                const type = document.getElementById("expenseType").value;
                                const particulars = document.getElementById("eParticulars").value.trim();
                                const amount = document.getElementById("eAmount").value.trim();
                                const remarks = document.getElementById("customRemark").value.trim();
                                const locationFrom = document.getElementById("eLocationFrom")?.value.trim() || "";
                                const locationTo = document.getElementById("eLocationTo")?.value.trim() || "";
                                const otherExpense = document.getElementById("otherExpense")?.value.trim() || "";
                                const applyOnCell = document.getElementById("showCellDate").innerText.trim();
                                const fileInput = document.getElementById("uploadFile");

                                // ✅ Basic validations
                                if (!date) return alert("Please select a date.");
                                if (!type) return alert("Please select an expense type.");
                                if (!particulars) return alert("Please enter particulars.");
                                if (!amount || isNaN(amount) || parseFloat(amount) <= 0) return alert("Please enter a valid amount.");
                                if (!remarks) return alert("Please enter remarks.");

                                // ✅ Remarks word count check (max 200 words)
                                const remarksWordCount = remarks.trim().split(/\s+/).length;
                                if (remarksWordCount > 200) return alert("Remarks cannot exceed 200 words.");

                                // ✅ File upload validation
                                if (!fileInput || fileInput.files.length === 0) {
                                    return alert("Please upload an invoice or receipt (PNG, JPG, PDF, max 1MB).");
                                }

                                const file = fileInput.files[0];
                                const allowedTypes = ["image/png", "image/jpeg", "application/pdf"];
                                if (!allowedTypes.includes(file.type)) {
                                    return alert("Only PNG, JPG, or PDF files are allowed.");
                                }
                                if (file.size > 1048576) {
                                    return alert("File size must be less than or equal to 1MB.");
                                }

                                uploadedFile = file;
                                uploadedFileURL = URL.createObjectURL(file);

                                // ✅ Optional: validate "Others" fields
                                if (type === "Others") {
                                    if (!otherExpense) return alert("Please specify the other expense type.");
                                    if (!locationFrom || !locationTo) return alert("Please enter both From and To locations.");
                                }

                                // ✅ Add to right panel
                                const claimHTML = `
                                    <div class="tab_lists" data-type="${type}" data-applyoncell="${applyOnCell}">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                                            <span class="list_date"><i class="fa-solid fa-calendar-days me-2"></i>${date}</span>
                                            <span class="list_e_type">Expenses Type : ${type}</span>
                                        </div>
                                        <div class="flex-wrap d-flex align-items-center justify-content-between mb-2">
                                            <span class="list_particulars">Particulars : ${particulars}</span>
                                            <span class="list_e_amount">Amount : $ ${parseFloat(amount).toFixed(2)}</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end">
                                            <span class="list_icons">
                                                <a href="#" class="badge_icon preview-attach" data-img="${uploadedFileURL || ""}">
                                                    <i class="fa-solid fa-paperclip"></i>
                                                </a>
                                                <a href="#" class="badge_icon edit-claim"
                                                    data-date="${date}" data-type="${type}" data-particulars="${particulars}"
                                                    data-amount="${amount}" data-remarks="${remarks}"
                                                    data-locationfrom="${locationFrom}" data-locationto="${locationTo}" data-otherexpense="${otherExpense}">
                                                    <i class="fa-solid fa-pen-nib"></i>
                                                </a>
                                                <a href="#" class="badge_icon delete-claim"><i class="fa-solid fa-trash-can"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                `;

                                const listContainer = document.querySelector(".tab_type_list");
                                const existingCard = listContainer.querySelector(`.tab_lists[data-type="${type}"][data-applyoncell="${applyOnCell}"]`);

                                if (existingCard) {
                                    existingCard.outerHTML = claimHTML;
                                } else {
                                    listContainer.insertAdjacentHTML("beforeend", claimHTML);
                                }

                                // ✅ Prepare & send to backend
                                const claim_no = document.querySelector("#otherModal .ml_duty_time span span")?.textContent.trim() || "";
                                const formData = new FormData();
                                formData.append("type", "claims");
                                formData.append("user_id", "{{ $userData['id'] ?? '' }}");
                                formData.append("client_id", "{{ $consultant->client_id ?? '' }}");
                                formData.append("client_name", "{{ $consultant->client_name ?? '' }}");

                                const recordData = {
                                    date,
                                    expenseType: type,
                                    claim_no,
                                    applyOnCell,
                                    particulars,
                                    amount: parseFloat(amount).toFixed(2),
                                    remarks,
                                    locationFrom,
                                    locationTo,
                                    otherExpense
                                };

                                formData.append("record", JSON.stringify(recordData));
                                formData.append("certificate", uploadedFile);

                                fetch("{{ route('consultant.data.save') }}", {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                                    },
                                    body: formData
                                })
                                .then(res => res.json())
                                .then(data => {
                                    console.log("Saved:", data);
                                    uploadedFile = null;
                                    uploadedFileURL = null;
                                    applyTag(lastClickedCell, type, "#007bff");
                                })
                                .catch(err => console.error("Error:", err));

                                editMode = false;
                                editTarget = null;
                                document.getElementById("claimForm").style.boxShadow = "";
                                document.getElementById("claimForm").style.border = "";
                            });

                           
                           // Handle edit, delete, preview
                           document.querySelector(".tab_type_list").addEventListener("click", function (e) {
                               if (e.target.closest(".delete-claim")) {
                                   e.preventDefault();
                                   e.target.closest(".tab_lists").remove();
                               }
                           
                               if (e.target.closest(".edit-claim")) {
                                   e.preventDefault();
                                   const btn = e.target.closest(".edit-claim");
                           
                                   document.getElementById("eDate").value = btn.dataset.date;
                                   document.getElementById("expenseType").value = btn.dataset.type;
                                   document.getElementById("eParticulars").value = btn.dataset.particulars;
                                   document.getElementById("eAmount").value = btn.dataset.amount;
                                   document.getElementById("customRemark").value = btn.dataset.remarks;
                                   document.getElementById("eLocationFrom").value = btn.dataset.locationfrom || "";
                                   document.getElementById("eLocationTo").value = btn.dataset.locationto || "";
                                   document.getElementById("otherExpense").value = btn.dataset.otherexpense || "";
                                   document.getElementById("expenseType").dispatchEvent(new Event("change"));
                           
                                   editMode = true;
                                   editTarget = btn.closest(".tab_lists");
                           
                                   const form = document.getElementById("claimForm");
                                   form.style.boxShadow = "0 0 10px #ff7f50";
                                   form.style.border = "2px solid #ff7f50";
                               }
                           
                               if (e.target.closest(".preview-attach")) {
                                   e.preventDefault();
                                   ensurePreviewModalExists();
                                   const url = e.target.closest(".preview-attach").dataset.img;
                                   if (url) {
                                       document.getElementById("previewImgTag").src = url;
                                       document.getElementById("imagePreviewModal").style.display = "flex";
                                   } else {
                                       alert("No file attached!");
                                   }
                               }
                           });
                        </script>
                        <script>
                           const calendarDays = document.getElementById("calendarDays");
                           const monthSelect = document.getElementById("monthSelect");
                           const yearSelect = document.getElementById("yearSelect");
                           const dropdownSuggestions = [
                               { label: "Taxi", icon: "🚕" },
                               { label: "Dining", icon: "🍽️" },
                               { label: "Others", icon: "🔧" },
                           ];
                           
                           const labelColors = {
                               "Dining": "#FBE7E8",
                               "Medical": "#FF961B",
                               "Taxi": "#EBF9F1",
                               "Others": "#FF9F2D",
                               "Custom": "#FF9F2D",
                               "VISA/legal": "#D3F3FF",
                               "Relocation": "#0085FF",
                               "Logistics": "#F9EAFF"
                           };
                           
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
                               calendarDays.innerHTML = "";
                           
                               const firstDay = new Date(year, month, 1).getDay();
                               const daysInMonth = new Date(year, month + 1, 0).getDate();
                           
                               for (let i = 0; i < firstDay; i++) {
                                   calendarDays.innerHTML += `<div class="calendar-cell disabled"></div>`;
                               }
                           
                               const tagRules = {};
                               @foreach ($dataClaims as $item)
                                   @php
                                       $record = json_decode($item->record ?? '{}', true);
                                       $applyDate = $record['applyOnCell'] ?? null;
                                       $rawLabel = $record['expenseType'] ?? null;
                                       $label = Str::startsWith($rawLabel, 'Custom') ? 'Custom' : $rawLabel;
                           
                                       if ($applyDate && $label) {
                                           try {
                                               $dt = \Carbon\Carbon::createFromFormat('d / m / Y', $applyDate);
                                               $monthYear = ($dt->month - 1) . '-' . $dt->year;
                                               $index = $dt->day;
                                           } catch (Exception $e) {
                                               $monthYear = null;
                                               $index = null;
                                           }
                                       }
                                   @endphp
                                   @if (isset($monthYear) && isset($index))
                                       if (!tagRules["{{ $monthYear }}"]) tagRules["{{ $monthYear }}"] = [];
                                       tagRules["{{ $monthYear }}"].push({ index: {{ $index }}, label: "{{ $label }}" });
                                   @endif
                               @endforeach
                           
                               for (let i = 1; i <= daysInMonth; i++) {
                                   const date = new Date(year, month, i);
                                   const cell = document.createElement("div");
                                   cell.classList.add("calendar-cell");
                           
                                   const currentKey = `${month}-${year}`;
                                   if (tagRules[currentKey]) {
                                       const tagsForDay = tagRules[currentKey].filter(rule => rule.index === i);
                                       const uniqueLabels = [...new Set(tagsForDay.map(t => t.label))];
                           
                                       if (uniqueLabels.length > 0) {
                                           const total = uniqueLabels.length;
                                           const step = 100 / total;
                                           let gradientParts = [];
                                           uniqueLabels.forEach((label, i) => {
                                               const color = labelColors[label] || "#ccc";
                                               const start = (i * step).toFixed(2);
                                               const end = ((i + 1) * step).toFixed(2);
                                               gradientParts.push(`${color} ${start}%`, `${color} ${end}%`);
                                           });
                                           cell.style.background = `linear-gradient(90deg, ${gradientParts.join(", ")})`;
                                       }
                           
                                   }
                           
                                   const dateLabel = document.createElement("div");
                                   dateLabel.classList.add("cell-date");
                                   dateLabel.innerText = i;
                                   cell.appendChild(dateLabel);
                           
                                   // if (date.getDay() === 0 || date.getDay() === 6) {
                                   //     cell.classList.add("disabled");
                                   // } else {
                                   //     cell.addEventListener("click", (e) => showInputDropdown(e, cell, date));
                                   // }
                           
                                   const day = date.getDay();
                                   const today = new Date();
                                       today.setHours(0, 0, 0, 0); // Normalize time
                           
                                       if (day === 0 || day === 6 || date < today) {
                                           cell.classList.add("disabled");
                                       } else {
                                           cell.addEventListener("click", (e) => showInputDropdown(e, cell, date));
                                       }
                           
                                   calendarDays.appendChild(cell);
                               }
                           }
                           
                           function showInputDropdown(event, cell, date) {
                               closeAllDropdowns();
                           
                               const dropdown = document.createElement("div");
                               dropdown.classList.add("dropdown");
                               const input = document.createElement("input");
                               input.placeholder = "Type label...";
                               const suggestionBox = document.createElement("div");
                               suggestionBox.className = "suggestions";
                           
                               function updateSuggestions(val) {
                                   suggestionBox.innerHTML = "";
                                   dropdownSuggestions.filter(s => s.label.toLowerCase().includes(val.toLowerCase())).forEach(item => {
                                       const opt = document.createElement("div");
                                       opt.innerHTML = `<span style="margin-right: 8px;">${item.icon}</span>${item.label}`;
                                       opt.onclick = () => {
                                        const formattedDate = new Date(date);
                                        const day = String(formattedDate.getDate()).padStart(2, "0");
                                        const month = String(formattedDate.getMonth() + 1).padStart(2, "0");
                                        const year = formattedDate.getFullYear();
                                        const finalDate = `${day} / ${month} / ${year}`;

                                        document.getElementById("showClaimName").innerText = item.label;
                                        document.getElementById("showCellDate").innerText = finalDate;

                                        const expenseTypeInput = document.getElementById("expenseType");
                                        if (expenseTypeInput) {
                                            expenseTypeInput.value = item.label;
                                            expenseTypeInput.setAttribute("disabled", true); // 🔒 lock dropdown
                                            expenseTypeInput.style.pointerEvents = "none";   // also blocks manual clicks
                                            expenseTypeInput.style.backgroundColor = "#eee"; // optional visual cue
                                        }

                                        // Set and lock the date field
                                        const eDateInput = document.getElementById("eDate");
                                        if (eDateInput) {
                                            const formattedForInput = `${year}-${month}-${day}`; // yyyy-mm-dd
                                            eDateInput.value = formattedForInput;
                                            eDateInput.setAttribute("min", formattedForInput);
                                            eDateInput.setAttribute("max", formattedForInput);
                                            eDateInput.setAttribute("readonly", true);
                                            eDateInput.style.pointerEvents = "none";
                                            eDateInput.style.backgroundColor = "#eee"; // optional
                                        }

                                        const show = (item.label === "Others");
                                        document.getElementById("otherExpenseWrapper").style.display = show ? "block" : "none";
                                        document.getElementById("location1").style.display = show ? "block" : "none";
                                        document.getElementById("location2").style.display = show ? "block" : "none";

                                        const modalCustomLeave = new bootstrap.Modal(document.getElementById("otherModal"));
                                        modalCustomLeave.show();

                                        const claimNum = "CF" + Math.floor(1000 + Math.random() * 9000);
                                        const claimSpan = document.querySelector("#otherModal .ml_duty_time span span");
                                        if (claimSpan) claimSpan.textContent = " " + claimNum;

                                        const selectedApplyOnCell = document.getElementById("showCellDate").innerText.trim();
                                        const allClaims = document.querySelectorAll("#otherModal .tab_type_list .tab_lists");
                                        allClaims.forEach(card => {
                                            const cardCell = card.getAttribute("data-applyoncell")?.trim();
                                            card.style.display = (cardCell === selectedApplyOnCell) ? "block" : "none";
                                        });

                                        window.lastClickedCell = cell;
                                        window.lastClickedItemLabel = item.label;
                                        dropdown.remove();
                                    };

                                       suggestionBox.appendChild(opt);
                                   });
                               }
                           
                               input.addEventListener("input", () => updateSuggestions(input.value));
                               input.addEventListener("keydown", (e) => {
                                   if (e.key === "Enter" && input.value.trim() !== "") {
                                       applyTag(cell, input.value.trim());
                                       dropdown.remove();
                                   }
                               });
                           
                               dropdown.appendChild(input);
                               dropdown.appendChild(suggestionBox);
                               cell.appendChild(dropdown);
                               input.focus();
                               updateSuggestions("");
                           }
                           
                           function applyTag(cell, label) {
                                if (!cell) return;

                                const color = labelColors[label] || "#007bff";

                                // Don't duplicate same label
                                if (cell.querySelector(`.tag-bar-${label}`)) return;

                                // ✅ Create the segment
                                const segment = document.createElement("div");
                                segment.className = `tag-bar-${label} tag-bar`;
                                segment.style.backgroundColor = color;
                                segment.style.flex = "1"; // 🟢 Equal space for each tag
                                segment.style.height = "100%";

                                // ✅ Add container if not exists
                                let holder = cell.querySelector(".tag-bar-holder");
                                if (!holder) {
                                    holder = document.createElement("div");
                                    holder.className = "tag-bar-holder";
                                    holder.style.position = "absolute";
                                    holder.style.top = "0";
                                    holder.style.left = "0";
                                    holder.style.width = "100%";
                                    holder.style.height = "100%";
                                    holder.style.display = "flex"; // 🟢 Enable horizontal bar layout
                                    holder.style.zIndex = "2";
                                    holder.style.borderRadius = "inherit"; // optional
                                    cell.style.position = "relative";
                                    cell.appendChild(holder);
                                }

                                holder.appendChild(segment);
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
            <div class="col-xl-4">
               <div class="db_sidebar">
                  <div class="d-flex align-items-center justify-content-between">
                     <ul class="nav nav-tabs" id="clickTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                           <button class="nav-link tab_btn active" data-bs-toggle="tab" data-bs-target="#claimContent" type="button" role="tab">Claim</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link tab_btn" data-bs-toggle="tab" data-bs-target="#gCopiesContent" type="button" role="tab">Get Copies</button>
                        </li>
                     </ul>
                     <button class="expand-btn" data-bs-toggle="modal" data-bs-target="#claimModal">
                     <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" />
                     </button>
                  </div>
                  <div class="tab-content tab_content_body" id="clickTabsContent">
                     <div class="tab-pane fade show active" id="claimContent" role="tabpanel" aria-labelledby="claim-tab">
                        <div class="timeline">
                           <div class="timeline-item d-flex mb-3">
                              <div class="me-2">
                                 <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                 <div class="line bg-primary"></div>
                              </div>
                              <div>
                                 <div class="d-flex align-items-center mb-1 tl-header">
                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                    <span class="text-primary">Claim No # - Cl04892F12 </span>
                                 </div>
                                 <div class="tl_details">
                                    <span>12/08/2024 -</span>
                                    <span class="badge"><span class="badge_dot"></span>Submitted</span>
                                    <span>- 3 individual claims -</span>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                 </div>
                              </div>
                           </div>
                           <div class="timeline-item d-flex mb-3">
                              <div class="me-2">
                                 <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                 <div class="line bg-primary"></div>
                              </div>
                              <div>
                                 <div class="d-flex align-items-center mb-1 tl-header">
                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                    <span class="text-primary">Claim No # - Cl04892F12 </span>
                                 </div>
                                 <div class="tl_details">
                                    <span>12/08/2024 -</span>
                                    <span class="badge"><span class="badge_dot"></span>Submitted</span>
                                    <span>- 3 individual claims -</span>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                 </div>
                              </div>
                           </div>
                           <div class="timeline-item d-flex mb-3">
                              <div class="me-2">
                                 <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                 <div class="line bg-primary"></div>
                              </div>
                              <div>
                                 <div class="d-flex align-items-center mb-1 tl-header">
                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                    <span class="text-primary">Claim No # - Cl04892F12 </span>
                                 </div>
                                 <div class="tl_details">
                                    <span>12/08/2024 -</span>
                                    <span class="badge"><span class="badge_dot"></span>Submitted</span>
                                    <span>- 3 individual claims -</span>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                 </div>
                              </div>
                           </div>
                           <div class="timeline-item d-flex mb-3">
                              <div class="me-2">
                                 <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                 <div class="line bg-primary"></div>
                              </div>
                              <div>
                                 <div class="d-flex align-items-center mb-1 tl-header">
                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                    <span class="text-primary">Claim No # - Cl04892F12 </span>
                                 </div>
                                 <div class="tl_details">
                                    <span>12/08/2024 -</span>
                                    <span class="badge"><span class="badge_dot"></span>Submitted</span>
                                    <span>- 3 individual claims -</span>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                 </div>
                              </div>
                           </div>
                           <div class="timeline-item d-flex mb-3">
                              <div class="me-2">
                                 <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                 <div class="line bg-primary"></div>
                              </div>
                              <div>
                                 <div class="d-flex align-items-center mb-1 tl-header">
                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                    <span class="text-primary">Claim No # - Cl04892F12 </span>
                                 </div>
                                 <div class="tl_details">
                                    <span>12/08/2024 -</span>
                                    <span class="badge"><span class="badge_dot"></span>Submitted</span>
                                    <span>- 3 individual claims -</span>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="gCopiesContent" role="tabpanel" aria-labelledby="gCopies-tab">
                        <div class="db_sidebar_title_box">
                           <span>Total Work Hours</span>
                           <span>Total Work Hours</span>
                        </div>
                        <div class="timeline tile_shape_box">
                           <div class="timeline-item d-flex mb-3">
                              <div class="select_box">
                                 <input type="checkbox" value="" />
                              </div>
                              <div class="timeline_right">
                                 <div class="d-flex align-items-center mb-3 tl-header">
                                    <span class="c_form_no">Claim Form : #2948</span>
                                    <span class="c_amount">Amount : $ 1800.00</span>
                                 </div>
                                 <div class="d-flex align-items-center tl-header">
                                    <span class="ind_claim">individual claims ( 03 )</span>
                                    <span>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class="timeline-item d-flex mb-3">
                              <div class="select_box">
                                 <input type="checkbox" value="" />
                              </div>
                              <div class="timeline_right">
                                 <div class="d-flex align-items-center mb-3 tl-header">
                                    <span class="c_form_no">Claim Form : #2948</span>
                                    <span class="c_amount">Amount : $ 1800.00</span>
                                 </div>
                                 <div class="d-flex align-items-center tl-header">
                                    <span class="ind_claim">individual claims ( 03 )</span>
                                    <span>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class="timeline-item d-flex mb-3">
                              <div class="select_box">
                                 <input type="checkbox" value="" />
                              </div>
                              <div class="timeline_right">
                                 <div class="d-flex align-items-center mb-3 tl-header">
                                    <span class="c_form_no">Claim Form : #2948</span>
                                    <span class="c_amount">Amount : $ 1800.00</span>
                                 </div>
                                 <div class="d-flex align-items-center tl-header">
                                    <span class="ind_claim">individual claims ( 03 )</span>
                                    <span>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class="timeline-item d-flex mb-3">
                              <div class="select_box">
                                 <input type="checkbox" value="" />
                              </div>
                              <div class="timeline_right">
                                 <div class="d-flex align-items-center mb-3 tl-header">
                                    <span class="c_form_no">Claim Form : #2948</span>
                                    <span class="c_amount">Amount : $ 1800.00</span>
                                 </div>
                                 <div class="d-flex align-items-center tl-header">
                                    <span class="ind_claim">individual claims ( 03 )</span>
                                    <span>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class="timeline-item d-flex mb-3">
                              <div class="select_box">
                                 <input type="checkbox" value="" />
                              </div>
                              <div class="timeline_right">
                                 <div class="d-flex align-items-center mb-3 tl-header">
                                    <span class="c_form_no">Claim Form : #2948</span>
                                    <span class="c_amount">Amount : $ 1800.00</span>
                                 </div>
                                 <div class="d-flex align-items-center tl-header">
                                    <span class="ind_claim">individual claims ( 03 )</span>
                                    <span>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class="timeline-item d-flex mb-3">
                              <div class="select_box">
                                 <input type="checkbox" value="" />
                              </div>
                              <div class="timeline_right">
                                 <div class="d-flex align-items-center mb-3 tl-header">
                                    <span class="c_form_no">Claim Form : #2948</span>
                                    <span class="c_amount">Amount : $ 1800.00</span>
                                 </div>
                                 <div class="d-flex align-items-center tl-header">
                                    <span class="ind_claim">individual claims ( 03 )</span>
                                    <span>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a>
                                    <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                    </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="g_cpoies_submit_btn r_update_btn">
                           <button type="submit">Submit</button>
                        </div>
                     </div>
                  </div>
                  <!-- claim modal -->
                  <div class="modal fade" id="claimModal" tabindex="-1" aria-labelledby="claimModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                           <div class="modal-header">
                              <div class="emp_n_c_form">
                                 <div class="model_employee">
                                    <div class="model_emp_img">
                                       <!-- <img src="assets/images/emp-icon1.png" alt=""> -->
                                       <!-- <img src="{{ asset('public/assets/latest/images/emp-icon1.png') }}" /> -->
                                    </div>
                                    <div class="name_n_id">
                                       <span class="model_emp_name">{{ $consultant->emp_name ?? 'N/A' }}</span>
                                       <span class="model_emp_id">Employee Id : Emp14982 </span>
                                    </div>
                                 </div>
                                 <div class="model_c_form">
                                    <h4>Claim Form</h4>
                                    <span>#CLF08982</span>
                                 </div>
                              </div>
                              <a href="#" class="draft_btn"><span class="dot"></span> Draft</a>
                              <div class="claim_hour_title">
                                 <span class="text-danger me-4 fw-bold">Individual Claims ( 03 )</span>
                                 <span class="fw-bold">Total Work Hours</span>
                              </div>
                              <button type="button" class="btn-close ml-close-btn" data-bs-dismiss="modal" aria-label="Close">
                              <i class="fa-solid fa-xmark"></i>
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="step_icons mb-4">
                                 <ul>
                                    <li>
                                       <span>
                                          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <g clip-path="url(#clip0_41157_9825)">
                                                <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                             </g>
                                             <g clip-path="url(#clip1_41157_9825)">
                                                <path
                                                   d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                   fill="black"
                                                   ></path>
                                             </g>
                                             <defs>
                                                <clipPath id="clip0_41157_9825">
                                                   <rect width="32" height="32" fill="white"></rect>
                                                </clipPath>
                                                <clipPath id="clip1_41157_9825">
                                                   <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                </clipPath>
                                             </defs>
                                          </svg>
                                       </span>
                                    </li>
                                    <li>
                                       <span>
                                          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <g clip-path="url(#clip0_41157_9825)">
                                                <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                             </g>
                                             <g clip-path="url(#clip1_41157_9825)">
                                                <path
                                                   d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                   fill="black"
                                                   ></path>
                                             </g>
                                             <defs>
                                                <clipPath id="clip0_41157_9825">
                                                   <rect width="32" height="32" fill="white"></rect>
                                                </clipPath>
                                                <clipPath id="clip1_41157_9825">
                                                   <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                </clipPath>
                                             </defs>
                                          </svg>
                                       </span>
                                    </li>
                                    <li>
                                       <span>
                                          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <g clip-path="url(#clip0_41157_9825)">
                                                <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                             </g>
                                             <g clip-path="url(#clip1_41157_9825)">
                                                <path
                                                   d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                   fill="black"
                                                   ></path>
                                             </g>
                                             <defs>
                                                <clipPath id="clip0_41157_9825">
                                                   <rect width="32" height="32" fill="white"></rect>
                                                </clipPath>
                                                <clipPath id="clip1_41157_9825">
                                                   <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                </clipPath>
                                             </defs>
                                          </svg>
                                       </span>
                                    </li>
                                    <li>
                                       <span>
                                          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <g clip-path="url(#clip0_41157_9825)">
                                                <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                             </g>
                                             <g clip-path="url(#clip1_41157_9825)">
                                                <path
                                                   d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                   fill="black"
                                                   ></path>
                                             </g>
                                             <defs>
                                                <clipPath id="clip0_41157_9825">
                                                   <rect width="32" height="32" fill="white"></rect>
                                                </clipPath>
                                                <clipPath id="clip1_41157_9825">
                                                   <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                </clipPath>
                                             </defs>
                                          </svg>
                                       </span>
                                    </li>
                                    <li>
                                       <span>
                                          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <g clip-path="url(#clip0_41157_9825)">
                                                <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                             </g>
                                             <g clip-path="url(#clip1_41157_9825)">
                                                <path
                                                   d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                   fill="black"
                                                   ></path>
                                             </g>
                                             <defs>
                                                <clipPath id="clip0_41157_9825">
                                                   <rect width="32" height="32" fill="white"></rect>
                                                </clipPath>
                                                <clipPath id="clip1_41157_9825">
                                                   <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                </clipPath>
                                             </defs>
                                          </svg>
                                       </span>
                                    </li>
                                    <li>
                                       <span>
                                          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <g clip-path="url(#clip0_41157_9825)">
                                                <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                             </g>
                                             <g clip-path="url(#clip1_41157_9825)">
                                                <path
                                                   d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                   fill="black"
                                                   ></path>
                                             </g>
                                             <defs>
                                                <clipPath id="clip0_41157_9825">
                                                   <rect width="32" height="32" fill="white"></rect>
                                                </clipPath>
                                                <clipPath id="clip1_41157_9825">
                                                   <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                </clipPath>
                                             </defs>
                                          </svg>
                                       </span>
                                    </li>
                                    <li>
                                       <span>
                                          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <g clip-path="url(#clip0_41157_9825)">
                                                <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"></circle>
                                             </g>
                                             <g clip-path="url(#clip1_41157_9825)">
                                                <path
                                                   d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z"
                                                   fill="black"
                                                   ></path>
                                             </g>
                                             <defs>
                                                <clipPath id="clip0_41157_9825">
                                                   <rect width="32" height="32" fill="white"></rect>
                                                </clipPath>
                                                <clipPath id="clip1_41157_9825">
                                                   <rect width="15" height="15" fill="white" transform="translate(8 8)"></rect>
                                                </clipPath>
                                             </defs>
                                          </svg>
                                       </span>
                                    </li>
                                 </ul>
                              </div>
                              <div class="modal_body_inner">
                                 <div class="container-fluid">
                                    <div class="row tabs_type_row mb-4">
                                       <div class="col-md-6 p-0">
                                          <div class="top_ic_details detial_row">
                                             <div class="d_n_t">
                                                <span class="fw-bold">Date & Time</span>
                                                <span>Sunday, 5th Aug, 2024</span>
                                             </div>
                                             <div class="e_n_t">
                                                <span class="fw-bold">Expense Type </span>
                                                <span>Taxi</span>
                                             </div>
                                             <div class="e_amt">
                                                <span class="fw-bold">Amount</span>
                                                <span>$ 250. 34</span>
                                             </div>
                                             <div class="u_icons">
                                                <a href="#" class="badge_icon"><i class="fa-solid fa-pen-nib"></i></a>
                                                <a href="#" class="badge_icon"><i class="fa-solid fa-trash-can"></i></a>
                                             </div>
                                          </div>
                                          <div class="bottom_ic_details detial_row">
                                             <div class="e_particular">
                                                <span class="fw-bold">Particulars</span>
                                                <span>PA082073NU978</span>
                                             </div>
                                             <div class="e_location_from">
                                                <span class="fw-bold">Location From</span>
                                                <span>Jurong East</span>
                                             </div>
                                             <div class="e_location_to">
                                                <span class="fw-bold">Location To</span>
                                                <span>Changi</span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-3 p-0">
                                          <div class="e_invoice_box">
                                             <div class="e_invoice_box_inner">
                                                <img src="{{ asset('public/assets/latest/images/no-data-2.png') }}" />
                                                <p class="mt-2">
                                                   <span>
                                                   Add Invoice
                                                   </span>
                                                </p>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-3 p-0">
                                          <div class="e_remark_box">
                                             <div class="e_remark_box_inner">
                                                <span class="fw-bold">Remarks</span>
                                                <p class="mt-2">
                                                   <span>Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's .</span>
                                                </p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row tabs_type_row mb-4">
                                       <div class="col-md-6 p-0">
                                          <div class="top_ic_details detial_row">
                                             <div class="d_n_t">
                                                <span class="fw-bold">Date & Time</span>
                                                <span>Sunday, 5th Aug, 2024</span>
                                             </div>
                                             <div class="e_n_t">
                                                <span class="fw-bold">Expense Type </span>
                                                <span>Taxi</span>
                                             </div>
                                             <div class="e_amt">
                                                <span class="fw-bold">Amount</span>
                                                <span>$ 250. 34</span>
                                             </div>
                                             <div class="u_icons">
                                                <a href="#" class="badge_icon"><i class="fa-solid fa-pen-nib"></i></a>
                                                <a href="#" class="badge_icon"><i class="fa-solid fa-trash-can"></i></a>
                                             </div>
                                          </div>
                                          <div class="bottom_ic_details detial_row">
                                             <div class="e_particular">
                                                <span class="fw-bold">Particulars</span>
                                                <span>PA082073NU978</span>
                                             </div>
                                             <div class="e_location_from">
                                                <span class="fw-bold">Location From</span>
                                                <span>Jurong East</span>
                                             </div>
                                             <div class="e_location_to">
                                                <span class="fw-bold">Location To</span>
                                                <span>Changi</span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-3 p-0">
                                          <div class="e_invoice_box">
                                             <div class="e_invoice_box_inner">
                                                <img src="{{ asset('public/assets/latest/images/no-data-2.png') }}" />
                                                <p class="mt-2">
                                                   <span>
                                                   Add Invoice
                                                   </span>
                                                </p>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-3 p-0">
                                          <div class="e_remark_box">
                                             <div class="e_remark_box_inner">
                                                <span class="fw-bold">Remarks</span>
                                                <p class="mt-2">
                                                   <span>Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's .</span>
                                                </p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row tabs_type_row mb-4">
                                       <div class="col-md-6 p-0">
                                          <div class="top_ic_details detial_row">
                                             <div class="d_n_t">
                                                <span class="fw-bold">Date & Time</span>
                                                <span>Sunday, 5th Aug, 2024</span>
                                             </div>
                                             <div class="e_n_t">
                                                <span class="fw-bold">Expense Type </span>
                                                <span>Taxi</span>
                                             </div>
                                             <div class="e_amt">
                                                <span class="fw-bold">Amount</span>
                                                <span>$ 250. 34</span>
                                             </div>
                                             <div class="u_icons">
                                                <a href="#" class="badge_icon"><i class="fa-solid fa-pen-nib"></i></a>
                                                <a href="#" class="badge_icon"><i class="fa-solid fa-trash-can"></i></a>
                                             </div>
                                          </div>
                                          <div class="bottom_ic_details detial_row">
                                             <div class="e_particular">
                                                <span class="fw-bold">Particulars</span>
                                                <span>PA082073NU978</span>
                                             </div>
                                             <div class="e_location_from">
                                                <span class="fw-bold">Location From</span>
                                                <span>Jurong East</span>
                                             </div>
                                             <div class="e_location_to">
                                                <span class="fw-bold">Location To</span>
                                                <span>Changi</span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-3 p-0">
                                          <div class="e_invoice_box">
                                             <div class="e_invoice_box_inner">
                                                <img src="{{ asset('public/assets/latest/images/no-data-2.png') }}" />
                                                <p class="mt-2">
                                                   <span>
                                                   Add Invoice
                                                   </span>
                                                </p>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-3 p-0">
                                          <div class="e_remark_box">
                                             <div class="e_remark_box_inner">
                                                <span class="fw-bold">Remarks</span>
                                                <p class="mt-2">
                                                   <span>Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's .</span>
                                                </p>
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
               <div class="db_sidebar db_sidebar2">
                  <div class="remark-section card tab_content_body">
                     <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6>Remarks</h6>
                        <div class="btn-group-remark">
                           <button class="btn btn-link p-0 text-danger" data-bs-toggle="modal" data-bs-target="#remarksModal">
                           <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" />
                           </button>
                        </div>
                     </div>
                     <div class="timeline">
                        <div class="remark-item mb-3">
                           <div class="d-flex">
                              <div class="me-2 text-primary">
                                 <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                 <div class="line bg-primary"></div>
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
                           <div class="d-flex">
                              <div class="me-2 text-primary">
                                 <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                 <div class="line bg-primary"></div>
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
                           <div class="d-flex">
                              <div class="me-2 text-primary">
                                 <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                 <div class="line bg-primary"></div>
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
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="tab-pane fade" id="claims" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
</div>