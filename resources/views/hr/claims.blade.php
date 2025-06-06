<div class="add-consultants-wrapper">
   <div class="pt-4">
      <div class="row">
         <div class="col-lg-12 col-xxl-12">
            <div class="hr-inner-tab">
               <div class="add-consultant-clients-wrapper">
                  <h4>Turn – in – rate : 90 / 100</h4>
                  <h4>Client – Wise Dossiers</h4>
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
                           <p>Manual Review</p>
                        </li>
                        <li>
                           <span></span> 
                           <p>Auto Approved</p>
                        </li>
                        <li>
                           <span></span> 
                           <p>Draft</p>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="hr-consultants-clients-tabs-content">
                  <div class="tab-content" id="v-pills-tabContent">
                     <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="hr-tab-inner">
                           <div class="hr-table">
                              <div class="hr-table-inner">
                                 <div class="hr-table-header">
                                    <div class="calendar-display" onclick="toggleGrid()">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <span id="calendarLabel"></span>
                                    </div>
                                    <div class="month-grid-popup" id="gridPopup">
                                    <div class="month-grid-header">
                                       <button onclick="chgYr(-1)">&#8592;</button>
                                       <span id="yrLbl"></span>
                                       <button onclick="chgYr(1)">&#8594;</button>
                                    </div>
                                    <div class="month-grid" id="gridMonths"></div>
                                    </div>
                                 </div>
                                 <table>
                                    <thead>
                                       <tr>
                                          <th>Name <span class="sort-icon"><i class="fa fa-search" aria-hidden="true"></i> </span> </th>
                                          <th>Queue <span class="sort-icon"><i class="fa-solid fa-filter"></i></span> </th>
                                          <th>Hours Logged / Hours Forecasted <span class="sort-icon"><i class="fa-solid fa-sort"></i></span> </th>
                                          <th>Logged Time-off <span class="sort-icon"><i class="fa-solid fa-sort"></i></span> </th>
                                          <th>AL Overview <span class="sort-icon"><i class="fa-solid fa-sort"></i></span> </th>
                                          <th>ML Overview <span class="sort-icon"><i class="fa-solid fa-sort"></i></span> </th>
                                          <th>PDO Overview <span class="sort-icon"><i class="fa-solid fa-sort"></i></span> </th>
                                          <th>UL Overview <span class="sort-icon"><i class="fa-solid fa-sort"></i></span> </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>Bruce Lee</td>
                                          <td><span class="queue-dot blue"></span> </td>
                                          <td>0/160</td>
                                          <td>5/2/2</td>
                                          <td>8/12</td>
                                          <td>2/12</td>
                                          <td>1/2</td>
                                          <td>3</td>
                                       </tr>
                                       <tr>
                                          <td>Allison Schleifer</td>
                                          <td><span class="queue-dot yellow"></span> </td>
                                          <td>100/160</td>
                                          <td>6/3/2</td>
                                          <td>8/12</td>
                                          <td>3/12</td>
                                          <td>2/2</td>
                                          <td>4</td>
                                       </tr>
                                       <tr>
                                          <td>Charlie Vetrovs</td>
                                          <td><span class="queue-dot green"></span> </td>
                                          <td>160/160</td>
                                          <td>7/3/2</td>
                                          <td>8/12</td>
                                          <td>3/12</td>
                                          <td>2/2</td>
                                          <td>2</td>
                                       </tr>
                                       <tr>
                                          <td>Lincoln Geidt</td>
                                          <td><span class="queue-dot red"></span></td>
                                          <td>0/160</td>
                                          <td>10/2/2</td>
                                          <td>8/12</td>
                                          <td>2/12</td>
                                          <td>1/2</td>
                                          <td>3</td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="selected-row">◉ Selected Row</div>
                           </div>
                           <div class="calendar-ui">
                              <div class="hr-tab-inner-top-profile-row">
                                 <div class="profile-header">
                                    <img src="{{ asset('public/assets/images/profile-icon-img.png')}}" alt="Profile Picture" class="profile-pic" data-bs-toggle="modal" data-bs-target="#hr-profile-modal-claim" /> 
                                    <div>
                                       <h3>Bruce Lee</h3>
                                       <p>Employee Id : Emp14982</p>
                                    </div>
                                 </div>
                                 <div class="icons-bar">
                                    <span class="icon">
                                       <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <g clip-path="url(#clip0_41157_9825)">
                                             <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                          </g>
                                          <g clip-path="url(#clip1_41157_9825)">
                                             <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black" />
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
                                    <span class="icon">
                                       <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <g clip-path="url(#clip0_41157_9825)">
                                             <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                          </g>
                                          <g clip-path="url(#clip1_41157_9825)">
                                             <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black" />
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
                                    <span class="icon">
                                       <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <g clip-path="url(#clip0_41157_9825)">
                                             <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                          </g>
                                          <g clip-path="url(#clip1_41157_9825)">
                                             <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black" />
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
                                    <span class="icon">
                                       <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <g clip-path="url(#clip0_41157_9825)">
                                             <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                          </g>
                                          <g clip-path="url(#clip1_41157_9825)">
                                             <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black" />
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
                                    <span class="icon">
                                       <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <g clip-path="url(#clip0_41157_9825)">
                                             <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                          </g>
                                          <g clip-path="url(#clip1_41157_9825)">
                                             <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black" />
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
                                    <span class="icon">
                                       <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <g clip-path="url(#clip0_41157_9825)">
                                             <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                          </g>
                                          <g clip-path="url(#clip1_41157_9825)">
                                             <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black" />
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
                                    <span class="icon">
                                       <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <g clip-path="url(#clip0_41157_9825)">
                                             <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2" />
                                          </g>
                                          <g clip-path="url(#clip1_41157_9825)">
                                             <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black" />
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
                                 </div>
                                 <div class="modal fade" id="hr-profile-modal-claim" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-body">
                                             <div class="modal-profile">
                                                <div class="profile-modal-row-top">
                                                   <div class="profile-img-wrap">
                                                      <div class="profile-img-inner" data-bs-target="#staticBackdrop"> <img src="{{ asset('public/assets/images/profile-icon-img.png')}}" alt="Profile Picture" class="profile-pic" /> </div>
                                                      <div>
                                                         <h3>Bruce Lee</h3>
                                                         <p>Emp14982</p>
                                                      </div>
                                                   </div>
                                                   <div class="badge-wrap-modal">
                                                      <div class="active-badge"> Active </div>
                                                   </div>
                                                </div>
                                                <div class="consultancy-info-row-modal">
                                                   <div class="consultancy-info-inner">
                                                      <h3> <img src="{{ asset('public/assets/images/client-icon-1.png')}}"> Encore Films </h3>
                                                      <h6>Information Security Analyst </h6>
                                                   </div>
                                                   <div class="consultancy-info-joining-modal">
                                                      <h5><span>Joining Date :</span>12 / 02 / 2022 </h5>
                                                   </div>
                                                </div>
                                                <div class="consultancy-info-modal-listing">
                                                   <ul>
                                                      <li>
                                                         <div class="img-icon"> <img src="{{ asset('public/assets/images/phn-circle-icon-1.png')}}" class="img-fluid"> </div>
                                                         <p>+65 9876 4763 </p>
                                                      </li>
                                                      <li>
                                                         <div class="img-icon"> <img src="{{ asset('public/assets/images/msg-circle-icon-1.png')}}" class="img-fluid"> </div>
                                                         <p>brucelee@gmail.com </p>
                                                      </li>
                                                      <li>
                                                         <div class="img-icon"> <img src="{{ asset('public/assets/images/location-circle-icon-1.png')}}" class="img-fluid"> </div>
                                                         <p>101 Marlow Street , #12-05 Clife Parkview, Singapore - 059020 </p>
                                                      </li>
                                                      <li>
                                                         <div class="img-icon"> <img src="{{ asset('public/assets/images/dots-circle-icon-1.png')}}" class="img-fluid"> </div>
                                                         <p>W772+M6 Chennai, Tamil Nadu </p>
                                                      </li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="calender-small-hr">
                                 <div class="status-buttons"> <button class="status good"><img src="{{ asset('public/assets/images/tick-circle-icon.png')}}" class="img-fluid"> Good To Go</button> <button class="status hold"><img src="{{ asset('public/assets/images/pause-circle-icon.png')}}" class="img-fluid"> Hold</button> <button class="status rework"><img src="{{ asset('public/assets/images/recycle-circle-icon.png')}}" class="img-fluid"> Rework</button> </div>
                                 <div class="calendar" id="show_calendar">
                                    <div class="weekdays">
                                       <div>SUN</div>
                                       <div>MON</div>
                                       <div>TUE</div>
                                       <div>WED</div>
                                       <div>THU</div>
                                       <div>FRI</div>
                                       <div>SAT</div>
                                    </div>
                                    <div class="days">
                                       <!-- <div class="empty">28</div>
                                       <div>29</div>
                                       <div>30</div>
                                       <div>31</div>
                                       <div>1<br><span class="leave">PDO</span></div>
                                       <div>2<br>8</div>
                                       <div>3</div>
                                       <div>4</div>
                                       <div>5<br><span class="leave">ML</span></div>
                                       <div class="red">6</div>
                                       <div>7<br>8</div>
                                       <div>8<br>8</div>
                                       <div>9<br><span class="leave">PH</span></div>
                                       <div>10</div>
                                       <div>11</div>
                                       <div>12<br>8</div>
                                       <div>13<br>8</div>
                                       <div>14<br><span class="leave red">UL</span> </div>
                                       <div>15<br><span class="leave">ML HD1</span> </div>
                                       <div>16<br>8</div>
                                       <div>17</div>
                                       <div>18</div>
                                       <div>19<br>8</div>
                                       <div>20<br>8</div>
                                       <div>21<br><span class="leave">AL HD1</span> </div>
                                       <div>22<br>8</div>
                                       <div>23<br>8</div>
                                       <div>24</div>
                                       <div>25</div>
                                       <div>26<br>8</div>
                                       <div>27<br>8</div>
                                       <div>28<br>8</div>
                                       <div>29<br>8</div>
                                       <div>30<br class="red">11</div>
                                       <div>1</div> -->
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row mt-4 bottom-remark-timesheet-group">
                              <div class="col-lg-6 col-xl-4 mb-4 mb-xl-none position-relative">
                                 <div class="work-summary write-summary">
                                    <button class="expand-btn" data-bs-toggle="modal" data-bs-target="#workSummaryModalclaim"> <img src="{{ asset('public/assets/images/expand-icon.png')}}"> </button> 
                                    <div class="remark-bottom-col">
                                       <div class="remark-heading">
                                          <span></span> 
                                          <h4>Remarks</h4>
                                       </div>
                                       <div class="remark-item">
                                          <p> I have been working with the production team and supporting in the release activities. This was an unexpected support call </p>
                                          <a href="javascript:void(0)" class="remark-pop-btn" id="toggleBtn"> <img src="{{ asset('public/assets/images/3-dot-image.png')}}" class="img-fluid"> </a> 
                                       </div>
                                       <div class="write-remark"> <input type="text" placeholder="Write your remarks here..."> </div>
                                    </div>
                                 </div>
                                 <div class="edit-delete-popup d-none">
                                    <ul>
                                       <li><img src="{{ asset('public/assets/images/black-edit-icon.png')}}">Edit </li>
                                       <li><img src="{{ asset('public/assets/images/black-delete-icon.png')}}">Delete </li>
                                    </ul>
                                 </div>
                                 <div class="modal fade" id="workSummaryModalclaim" tabindex="-1" aria-labelledby="workSummaryModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                       <div class="modal-content">
                                          <div class="modal-header "> <button type="button" class="btn-close popup-expand-btn " data-bs-dismiss="modal" aria-label="Close"> <i class="fa-solid fa-up-right-and-down-left-from-center"></i> </button> </div>
                                          <div class="modal-body ">
                                             <div class="write-summary-popup-body">
                                                <h4>Remarks</h4>
                                                <div class="write-summary-expand-row mt-2">
                                                   <div class="write-summary-expand-item">
                                                      <p> I have been working with the production team and supporting in the release activities. This was an unexpected support call </p>
                                                      <a href="javascript:void(0)" class="remark-pop-btn" id="toggleBtnexpand"> <img src="{{ asset('public/assets/images/3-dot-image.png')}}" class="img-fluid"> </a> 
                                                   </div>
                                                   <div class="write-remark mt-4"> <input type="text" placeholder="Write your remarks here..."> </div>
                                                </div>
                                                <div class="edit-delete-popup-expand d-none">
                                                   <ul>
                                                      <li><img src="{{ asset('public/assets/images/black-edit-icon.png')}}">Edit </li>
                                                      <li><img src="{{ asset('public/assets/images/black-delete-icon.png')}}">Delete </li>
                                                   </ul>
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
                                       <div class="btn-group-remark"> <button class="btn btn-link p-0 text-danger" data-bs-toggle="modal" data-bs-target="#editRemarksModal"> <img src="{{ asset('public/assets/images/expand-icon.png')}}"> </button> <button class="flow-edit-btn" data-bs-toggle="modal" data-bs-target="#editRemarksModal"> <i class="fa-solid fa-pen-nib"></i> </button> </div>
                                    </div>
                                    <div class="remark-timeline">
                                       <div class="remark-item mb-3">
                                          <div class="d-flex align-items-start">
                                             <div class="me-2 text-primary">
                                                <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"> </div>
                                                <div class="line bg-primary" style="width:2px; height:100%; margin-left:4px;"> </div>
                                             </div>
                                             <div>
                                                <div class="d-flex align-items-center mb-1"> <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena"> <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small> </div>
                                                <p>This is Approved, Thank you for the excellent contribution </p>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="remark-item mb-3">
                                          <div class="d-flex align-items-start">
                                             <div class="me-2 text-primary">
                                                <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"> </div>
                                                <div class="line bg-primary" style="width:2px; height:100%; margin-left:4px;"> </div>
                                             </div>
                                             <div>
                                                <div class="d-flex align-items-center mb-1"> <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena"> <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small> </div>
                                                <p>This is Approved, Thank you for the excellent contribution </p>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="remark-item mb-3">
                                          <div class="d-flex align-items-start">
                                             <div class="me-2 text-primary">
                                                <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"> </div>
                                                <div class="line bg-primary" style="width:2px; height:100%; margin-left:4px;"> </div>
                                             </div>
                                             <div>
                                                <div class="d-flex align-items-center mb-1"> <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena"> <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small> </div>
                                                <p>This is Approved, Thank you for the excellent contribution </p>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="remark-item mb-3">
                                          <div class="d-flex align-items-start">
                                             <div class="me-2 text-primary">
                                                <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"> </div>
                                                <div class="line bg-primary" style="width:2px; height:100%; margin-left:4px;"> </div>
                                             </div>
                                             <div>
                                                <div class="d-flex align-items-center mb-1"> <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena"> <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small> </div>
                                                <p>This is Approved, Thank you for the excellent contribution </p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal fade" id="#remarksModalclaim" tabindex="-1" aria-labelledby="remarksModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="remarksModalLabel">Remarks</h5>
                                             <button type="button" class="btn-close popup-expand-btn" data-bs-dismiss="modal" aria-label="Close"> <i class="fa-solid fa-up-right-and-down-left-from-center"></i> </button> 
                                          </div>
                                          <div class="modal-body">
                                             <div class="remark-timeline">
                                                <div class="remark-item mb-3">
                                                   <div class="d-flex align-items-start">
                                                      <div class="me-3 text-primary">
                                                         <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"> </div>
                                                         <div class="line bg-primary" style="width:2px; height:100%; margin-left:4px;"> </div>
                                                      </div>
                                                      <div>
                                                         <div class="d-flex align-items-center mb-2"> <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena"> <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small> </div>
                                                         <p>This is Approved, Thank you for the excellent contribution </p>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="remark-item mb-3">
                                                   <div class="d-flex align-items-start">
                                                      <div class="me-3 text-primary">
                                                         <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"> </div>
                                                         <div class="line bg-primary" style="width:2px; height:100%; margin-left:4px;"> </div>
                                                      </div>
                                                      <div>
                                                         <div class="d-flex align-items-center mb-2"> <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena"> <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small> </div>
                                                         <p>This is Approved, Thank you for the excellent contribution </p>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="remark-item mb-3">
                                                   <div class="d-flex align-items-start">
                                                      <div class="me-3 text-primary">
                                                         <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"> </div>
                                                         <div class="line bg-primary" style="width:2px; height:100%; margin-left:4px;"> </div>
                                                      </div>
                                                      <div>
                                                         <div class="d-flex align-items-center mb-2"> <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena"> <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small> </div>
                                                         <p>This is Approved, Thank you for the excellent contribution </p>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="remark-item mb-3">
                                                   <div class="d-flex align-items-start">
                                                      <div class="me-3 text-primary">
                                                         <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"> </div>
                                                         <div class="line bg-primary" style="width:2px; height:100%; margin-left:4px;"> </div>
                                                      </div>
                                                      <div>
                                                         <div class="d-flex align-items-center mb-2"> <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena"> <small class="text-muted">Approved On 31 / 05 / 2024 09 : 45 AM</small> </div>
                                                         <p>This is Approved, Thank you for the excellent contribution </p>
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
                                          <div class="modal-header ">
                                             <div class="remark_popup_detial">
                                                <div class="r_img"> <img src="{{ asset('public/assets/images/emp-icon1.png')}}" alt=""> </div>
                                                <div class="r_detail">
                                                   <span class="r_name">Bruce Lee</span> 
                                                   <p class="r_id">Employee Id : Emp14982 </p>
                                                </div>
                                             </div>
                                             <div class="remark_popup_detial">
                                                <div class="r_img"> <img src="{{ asset('public/assets/images/emp-icon1.png')}}" alt=""> </div>
                                                <div class="r_detail">
                                                   <span class="r_name">Erin</span> 
                                                   <p class="r_id">HR</p>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="modal-body ">
                                             <div class="rc_detail_box">
                                                <div class="rc_left_detail">
                                                   <div class="rc_box">
                                                      <div class="rc_img"> <img src="{{ asset('public/assets/images/client-icon-1.png')}}" alt=""> </div>
                                                      <span class="rc_name">Encore Films</span> 
                                                   </div>
                                                   <p class="rc_status">Remarks For : <span>Approved <i class="fa-solid fa-check"></i></span> </p>
                                                </div>
                                                <div class="rc_right_detail">
                                                   <p>Designation : <span>Information Security Analyst</span> </p>
                                                </div>
                                             </div>
                                             <div class="r_text_area"> <textarea name="r_update" id="" placeholder="Your timesheet was Approved."></textarea> </div>
                                             <div class="r_update_btn"> <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"> Cancel </button> <button type="button" class="r_submit_btn"> Submit </button> </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-xl-4">
                                 <div class="db_sidebar">
                                    <div class="d-flex align-items-center justify-content-between">
                                       <ul class="nav nav-tabs" id="clickTabs" role="tablist">
                                          <li class="nav-item" role="presentation"> <button class="nav-link tab_btn active" data-bs-toggle="tab" data-bs-target="#claimContent" type="button" role="tab">Claim</button> </li>
                                          <li class="nav-item" role="presentation"> <button class="nav-link tab_btn " data-bs-toggle="tab" data-bs-target="#gCopiesContent" type="button" role="tab">Get Copies</button> </li>
                                       </ul>
                                       <button class="expand-btn" data-bs-toggle="modal" data-bs-target="#claimModal"> <img src="{{ asset('public/assets/images/expand-icon.png')}}"> </button> 
                                    </div>
                                    <div class="tab-content tab_content_body" id="clickTabsContent">
                                       <div class="tab-pane fade show active" id="claimContent" role="tabpanel" aria-labelledby="claim-tab">
                                          <div class="timeline">
                                             <div class="timeline-item d-flex mb-3">
                                                <div class="me-2">
                                                   <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"> </div>
                                                   <div class="line bg-primary"> </div>
                                                </div>
                                                <div>
                                                   <div class="d-flex align-items-center mb-1 tl-header"> <img src="https://i.pravatar.cc/24" class="rounded-circle me-2"> <span class=" text-primary">Claim No # - Cl04892F12 </span> </div>
                                                   <div class="tl_details"> <span>12/08/2024 -</span> <span class="badge"><span class="badge_dot"></span>Submitted</span> <span>- 3 individual claims -</span> <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a> </div>
                                                </div>
                                             </div>
                                             <div class="timeline-item d-flex mb-3">
                                                <div class="me-2">
                                                   <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"> </div>
                                                   <div class="line bg-primary"> </div>
                                                </div>
                                                <div>
                                                   <div class="d-flex align-items-center mb-1 tl-header"> <img src="https://i.pravatar.cc/24" class="rounded-circle me-2"> <span class=" text-primary">Claim No # - Cl04892F12 </span> </div>
                                                   <div class="tl_details"> <span>12/08/2024 -</span> <span class="badge"><span class="badge_dot"></span>Submitted</span> <span>- 3 individual claims -</span> <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a> </div>
                                                </div>
                                             </div>
                                             <div class="timeline-item d-flex mb-3">
                                                <div class="me-2">
                                                   <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"> </div>
                                                   <div class="line bg-primary"> </div>
                                                </div>
                                                <div>
                                                   <div class="d-flex align-items-center mb-1 tl-header"> <img src="https://i.pravatar.cc/24" class="rounded-circle me-2"> <span class=" text-primary">Claim No # - Cl04892F12 </span> </div>
                                                   <div class="tl_details"> <span>12/08/2024 -</span> <span class="badge"><span class="badge_dot"></span>Submitted</span> <span>- 3 individual claims -</span> <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a> </div>
                                                </div>
                                             </div>
                                             <div class="timeline-item d-flex mb-3">
                                                <div class="me-2">
                                                   <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"> </div>
                                                   <div class="line bg-primary"> </div>
                                                </div>
                                                <div>
                                                   <div class="d-flex align-items-center mb-1 tl-header"> <img src="https://i.pravatar.cc/24" class="rounded-circle me-2"> <span class=" text-primary">Claim No # - Cl04892F12 </span> </div>
                                                   <div class="tl_details"> <span>12/08/2024 -</span> <span class="badge"><span class="badge_dot"></span>Submitted</span> <span>- 3 individual claims -</span> <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a> </div>
                                                </div>
                                             </div>
                                             <div class="timeline-item d-flex mb-3">
                                                <div class="me-2">
                                                   <div class="dot bg-primary rounded-circle" style="width:10px; height:10px;"> </div>
                                                   <div class="line bg-primary"> </div>
                                                </div>
                                                <div>
                                                   <div class="d-flex align-items-center mb-1 tl-header"> <img src="https://i.pravatar.cc/24" class="rounded-circle me-2"> <span class=" text-primary">Claim No # - Cl04892F12 </span> </div>
                                                   <div class="tl_details"> <span>12/08/2024 -</span> <span class="badge"><span class="badge_dot"></span>Submitted</span> <span>- 3 individual claims -</span> <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a> </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="tab-pane fade" id="gCopiesContent" role="tabpanel" aria-labelledby="gCopies-tab">
                                          <div class="db_sidebar_title_box"> <span>Total Work Hours</span> <span>Total Work Hours</span> </div>
                                          <div class="timeline tile_shape_box">
                                             <div class="timeline-item d-flex mb-3">
                                                <div class="select_box"> <input type="checkbox" value=""> </div>
                                                <div class="timeline_right">
                                                   <div class="d-flex align-items-center mb-3 tl-header"> <span class="c_form_no">Claim Form : #2948</span> <span class="c_amount">Amount : $ 1800.00</span> </div>
                                                   <div class="d-flex align-items-center tl-header"> <span class="ind_claim">individual claims ( 03 )</span> <span> <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a> </span> </div>
                                                </div>
                                             </div>
                                             <div class="timeline-item d-flex mb-3">
                                                <div class="select_box"> <input type="checkbox" value=""> </div>
                                                <div class="timeline_right">
                                                   <div class="d-flex align-items-center mb-3 tl-header"> <span class="c_form_no">Claim Form : #2948</span> <span class="c_amount">Amount : $ 1800.00</span> </div>
                                                   <div class="d-flex align-items-center tl-header"> <span class="ind_claim">individual claims ( 03 )</span> <span> <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a> </span> </div>
                                                </div>
                                             </div>
                                             <div class="timeline-item d-flex mb-3">
                                                <div class="select_box"> <input type="checkbox" value=""> </div>
                                                <div class="timeline_right">
                                                   <div class="d-flex align-items-center mb-3 tl-header"> <span class="c_form_no">Claim Form : #2948</span> <span class="c_amount">Amount : $ 1800.00</span> </div>
                                                   <div class="d-flex align-items-center tl-header"> <span class="ind_claim">individual claims ( 03 )</span> <span> <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a> </span> </div>
                                                </div>
                                             </div>
                                             <div class="timeline-item d-flex mb-3">
                                                <div class="select_box"> <input type="checkbox" value=""> </div>
                                                <div class="timeline_right">
                                                   <div class="d-flex align-items-center mb-3 tl-header"> <span class="c_form_no">Claim Form : #2948</span> <span class="c_amount">Amount : $ 1800.00</span> </div>
                                                   <div class="d-flex align-items-center tl-header"> <span class="ind_claim">individual claims ( 03 )</span> <span> <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a> </span> </div>
                                                </div>
                                             </div>
                                             <div class="timeline-item d-flex mb-3">
                                                <div class="select_box"> <input type="checkbox" value=""> </div>
                                                <div class="timeline_right">
                                                   <div class="d-flex align-items-center mb-3 tl-header"> <span class="c_form_no">Claim Form : #2948</span> <span class="c_amount">Amount : $ 1800.00</span> </div>
                                                   <div class="d-flex align-items-center tl-header"> <span class="ind_claim">individual claims ( 03 )</span> <span> <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a> </span> </div>
                                                </div>
                                             </div>
                                             <div class="timeline-item d-flex mb-3">
                                                <div class="select_box"> <input type="checkbox" value=""> </div>
                                                <div class="timeline_right">
                                                   <div class="d-flex align-items-center mb-3 tl-header"> <span class="c_form_no">Claim Form : #2948</span> <span class="c_amount">Amount : $ 1800.00</span> </div>
                                                   <div class="d-flex align-items-center tl-header"> <span class="ind_claim">individual claims ( 03 )</span> <span> <a href="#" class="badge_icon"><i class="fa-solid fa-cloud-arrow-down"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></a> </span> </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="g_cpoies_submit_btn r_update_btn"> <button type="submit">Submit</button> </div>
                                       </div>
                                    </div>
                                    <div class="modal fade" id="claimModal" tabindex="-1" aria-labelledby="claimModalLabel" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered modal-xl">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <div class="emp_n_c_form">
                                                   <div class="model_employee">
                                                      <div class="model_emp_img"> <img src="{{ asset('public/assets/images/emp-icon1.png')}}" alt=""> </div>
                                                      <div class="name_n_id"> <span class="model_emp_name">Bruce Lee</span> <span class="model_emp_id">Employee Id : Emp14982 </span> </div>
                                                   </div>
                                                   <div class="model_c_form">
                                                      <h4>Claim Form</h4>
                                                      <span>#CLF08982</span> 
                                                   </div>
                                                </div>
                                                <a href="#" class="draft_btn"><span class="dot"></span> Draft</a> 
                                                <div class="claim_hour_title"> <span class="text-danger me-4 fw-bold">Individual Claims ( 03 )</span> <span class="fw-bold">Total Work Hours</span> </div>
                                                <button type="button" class="btn-close ml-close-btn" data-bs-dismiss="modal" aria-label="Close"> <i class="fa-solid fa-xmark"></i> </button> 
                                             </div>
                                             <div class="modal-body">
                                                <div class="step_icons mb-4">
                                                   <ul>
                                                      <li>
                                                         <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                               <g clip-path="url(#clip0_41157_9825)">
                                                                  <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"> </circle>
                                                               </g>
                                                               <g clip-path="url(#clip1_41157_9825)">
                                                                  <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"> </path>
                                                               </g>
                                                               <defs>
                                                                  <clipPath id="clip0_41157_9825">
                                                                     <rect width="32" height="32" fill="white"> </rect>
                                                                  </clipPath>
                                                                  <clipPath id="clip1_41157_9825">
                                                                     <rect width="15" height="15" fill="white" transform="translate(8 8)"> </rect>
                                                                  </clipPath>
                                                               </defs>
                                                            </svg>
                                                         </span>
                                                      </li>
                                                      <li>
                                                         <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                               <g clip-path="url(#clip0_41157_9825)">
                                                                  <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"> </circle>
                                                               </g>
                                                               <g clip-path="url(#clip1_41157_9825)">
                                                                  <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"> </path>
                                                               </g>
                                                               <defs>
                                                                  <clipPath id="clip0_41157_9825">
                                                                     <rect width="32" height="32" fill="white"> </rect>
                                                                  </clipPath>
                                                                  <clipPath id="clip1_41157_9825">
                                                                     <rect width="15" height="15" fill="white" transform="translate(8 8)"> </rect>
                                                                  </clipPath>
                                                               </defs>
                                                            </svg>
                                                         </span>
                                                      </li>
                                                      <li>
                                                         <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                               <g clip-path="url(#clip0_41157_9825)">
                                                                  <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"> </circle>
                                                               </g>
                                                               <g clip-path="url(#clip1_41157_9825)">
                                                                  <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"> </path>
                                                               </g>
                                                               <defs>
                                                                  <clipPath id="clip0_41157_9825">
                                                                     <rect width="32" height="32" fill="white"> </rect>
                                                                  </clipPath>
                                                                  <clipPath id="clip1_41157_9825">
                                                                     <rect width="15" height="15" fill="white" transform="translate(8 8)"> </rect>
                                                                  </clipPath>
                                                               </defs>
                                                            </svg>
                                                         </span>
                                                      </li>
                                                      <li>
                                                         <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                               <g clip-path="url(#clip0_41157_9825)">
                                                                  <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"> </circle>
                                                               </g>
                                                               <g clip-path="url(#clip1_41157_9825)">
                                                                  <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"> </path>
                                                               </g>
                                                               <defs>
                                                                  <clipPath id="clip0_41157_9825">
                                                                     <rect width="32" height="32" fill="white"> </rect>
                                                                  </clipPath>
                                                                  <clipPath id="clip1_41157_9825">
                                                                     <rect width="15" height="15" fill="white" transform="translate(8 8)"> </rect>
                                                                  </clipPath>
                                                               </defs>
                                                            </svg>
                                                         </span>
                                                      </li>
                                                      <li>
                                                         <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                               <g clip-path="url(#clip0_41157_9825)">
                                                                  <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"> </circle>
                                                               </g>
                                                               <g clip-path="url(#clip1_41157_9825)">
                                                                  <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"> </path>
                                                               </g>
                                                               <defs>
                                                                  <clipPath id="clip0_41157_9825">
                                                                     <rect width="32" height="32" fill="white"> </rect>
                                                                  </clipPath>
                                                                  <clipPath id="clip1_41157_9825">
                                                                     <rect width="15" height="15" fill="white" transform="translate(8 8)"> </rect>
                                                                  </clipPath>
                                                               </defs>
                                                            </svg>
                                                         </span>
                                                      </li>
                                                      <li>
                                                         <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                               <g clip-path="url(#clip0_41157_9825)">
                                                                  <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"> </circle>
                                                               </g>
                                                               <g clip-path="url(#clip1_41157_9825)">
                                                                  <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"> </path>
                                                               </g>
                                                               <defs>
                                                                  <clipPath id="clip0_41157_9825">
                                                                     <rect width="32" height="32" fill="white"> </rect>
                                                                  </clipPath>
                                                                  <clipPath id="clip1_41157_9825">
                                                                     <rect width="15" height="15" fill="white" transform="translate(8 8)"> </rect>
                                                                  </clipPath>
                                                               </defs>
                                                            </svg>
                                                         </span>
                                                      </li>
                                                      <li>
                                                         <span>
                                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                               <g clip-path="url(#clip0_41157_9825)">
                                                                  <circle cx="16" cy="16" r="15" fill="white" stroke="#A1AEBE" stroke-width="2"> </circle>
                                                               </g>
                                                               <g clip-path="url(#clip1_41157_9825)">
                                                                  <path d="M22.9094 22.0494L20.0687 17.4012C20.5837 17.105 21.0775 16.7594 21.5387 16.355C21.7981 16.1275 21.8237 15.7325 21.5962 15.4731C21.3675 15.2131 20.9737 15.1887 20.7137 15.4156C20.3075 15.7719 19.8719 16.075 19.4169 16.3344L17.5137 13.22C17.8169 12.8063 18.0012 12.3012 18.0012 11.7506C18.0012 10.5894 17.2019 9.61875 16.1262 9.33937V8.625C16.1262 8.28 15.8469 8 15.5012 8C15.1556 8 14.8762 8.28 14.8762 8.625V9.33875C13.8006 9.61812 13.0012 10.5887 13.0012 11.75C13.0012 12.3006 13.1856 12.8056 13.4887 13.2194L11.5856 16.3331C11.1306 16.0744 10.695 15.7712 10.2887 15.4144C10.0287 15.1869 9.635 15.2119 9.40625 15.4719C9.17875 15.7312 9.20437 16.1256 9.46375 16.3544C9.92437 16.7587 10.4181 17.105 10.9337 17.4006L8.09187 22.0494C7.91187 22.3444 8.00437 22.7288 8.29937 22.9088C8.40125 22.9713 8.51375 23 8.625 23C8.83562 23 9.04125 22.8937 9.15875 22.7006L12.0637 17.9469C13.1637 18.3906 14.3306 18.62 15.5 18.62C16.6694 18.62 17.8362 18.3906 18.9362 17.9469L21.8412 22.7006C21.9587 22.8937 22.165 23 22.375 23C22.4862 23 22.5981 22.9706 22.7006 22.9088C22.9956 22.7288 23.0881 22.3444 22.9081 22.0494H22.9094ZM15.5006 10.5C16.19 10.5 16.7506 11.0606 16.7506 11.75C16.7506 12.4394 16.19 13 15.5006 13C14.8112 13 14.2506 12.4394 14.2506 11.75C14.2506 11.0606 14.8112 10.5 15.5006 10.5ZM12.7225 16.8694L14.4644 14.0188C14.7806 14.1638 15.1294 14.25 15.5 14.25C15.8706 14.25 16.2194 14.1638 16.5356 14.0188L18.2781 16.87C16.4912 17.5369 14.5094 17.5369 12.7225 16.87V16.8694Z" fill="black"> </path>
                                                               </g>
                                                               <defs>
                                                                  <clipPath id="clip0_41157_9825">
                                                                     <rect width="32" height="32" fill="white"> </rect>
                                                                  </clipPath>
                                                                  <clipPath id="clip1_41157_9825">
                                                                     <rect width="15" height="15" fill="white" transform="translate(8 8)"> </rect>
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
                                                               <div class="d_n_t"> <span class="fw-bold">Date &amp; Time</span> <span>Sunday, 5th Aug, 2024</span> </div>
                                                               <div class="e_n_t"> <span class="fw-bold">Expense Type </span> <span>Taxi</span> </div>
                                                               <div class="e_amt"> <span class="fw-bold">Amount</span> <span>$ 250. 34</span> </div>
                                                               <div class="u_icons"> <a href="#" class="badge_icon"><i class="fa-solid fa-pen-nib"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-trash-can"></i></a> </div>
                                                            </div>
                                                            <div class="bottom_ic_details detial_row">
                                                               <div class="e_particular"> <span class="fw-bold">Particulars</span> <span>PA082073NU978</span> </div>
                                                               <div class="e_location_from"> <span class="fw-bold">Location From</span> <span>Jurong East</span> </div>
                                                               <div class="e_location_to"> <span class="fw-bold">Location To</span> <span>Changi</span> </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-3 p-0">
                                                            <div class="e_invoice_box">
                                                               <div class="e_invoice_box_inner">
                                                                  <img src="{{ asset('public/assets/images/no-data-2.png')}}" alt=""> 
                                                                  <p class="mt-2"> <span> Add Invoice </span> </p>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-3 p-0">
                                                            <div class="e_remark_box">
                                                               <div class="e_remark_box_inner">
                                                                  <span class="fw-bold">Remarks</span> 
                                                                  <p class="mt-2"> <span>Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's .</span> </p>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="row tabs_type_row mb-4">
                                                         <div class="col-md-6 p-0">
                                                            <div class="top_ic_details detial_row">
                                                               <div class="d_n_t"> <span class="fw-bold">Date &amp; Time</span> <span>Sunday, 5th Aug, 2024</span> </div>
                                                               <div class="e_n_t"> <span class="fw-bold">Expense Type </span> <span>Taxi</span> </div>
                                                               <div class="e_amt"> <span class="fw-bold">Amount</span> <span>$ 250. 34</span> </div>
                                                               <div class="u_icons"> <a href="#" class="badge_icon"><i class="fa-solid fa-pen-nib"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-trash-can"></i></a> </div>
                                                            </div>
                                                            <div class="bottom_ic_details detial_row">
                                                               <div class="e_particular"> <span class="fw-bold">Particulars</span> <span>PA082073NU978</span> </div>
                                                               <div class="e_location_from"> <span class="fw-bold">Location From</span> <span>Jurong East</span> </div>
                                                               <div class="e_location_to"> <span class="fw-bold">Location To</span> <span>Changi</span> </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-3 p-0">
                                                            <div class="e_invoice_box">
                                                               <div class="e_invoice_box_inner">
                                                                  <img src="{{ asset('public/assets/images/no-data-2.png')}}" alt=""> 
                                                                  <p class="mt-2"> <span> Add Invoice </span> </p>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-3 p-0">
                                                            <div class="e_remark_box">
                                                               <div class="e_remark_box_inner">
                                                                  <span class="fw-bold">Remarks</span> 
                                                                  <p class="mt-2"> <span>Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's .</span> </p>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="row tabs_type_row mb-4">
                                                         <div class="col-md-6 p-0">
                                                            <div class="top_ic_details detial_row">
                                                               <div class="d_n_t"> <span class="fw-bold">Date &amp; Time</span> <span>Sunday, 5th Aug, 2024</span> </div>
                                                               <div class="e_n_t"> <span class="fw-bold">Expense Type </span> <span>Taxi</span> </div>
                                                               <div class="e_amt"> <span class="fw-bold">Amount</span> <span>$ 250. 34</span> </div>
                                                               <div class="u_icons"> <a href="#" class="badge_icon"><i class="fa-solid fa-pen-nib"></i></a> <a href="#" class="badge_icon"><i class="fa-solid fa-trash-can"></i></a> </div>
                                                            </div>
                                                            <div class="bottom_ic_details detial_row">
                                                               <div class="e_particular"> <span class="fw-bold">Particulars</span> <span>PA082073NU978</span> </div>
                                                               <div class="e_location_from"> <span class="fw-bold">Location From</span> <span>Jurong East</span> </div>
                                                               <div class="e_location_to"> <span class="fw-bold">Location To</span> <span>Changi</span> </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-3 p-0">
                                                            <div class="e_invoice_box">
                                                               <div class="e_invoice_box_inner">
                                                                  <img src="{{ asset('public/assets/images/no-data-2.png')}}" alt=""> 
                                                                  <p class="mt-2"> <span> Add Invoice </span> </p>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-3 p-0">
                                                            <div class="e_remark_box">
                                                               <div class="e_remark_box_inner">
                                                                  <span class="fw-bold">Remarks</span> 
                                                                  <p class="mt-2"> <span>Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's .</span> </p>
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
                     <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"> </div>
                     <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"> </div>
                     <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"> </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
const months = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
let today = new Date(), selMonth = today.getMonth(), selYear = today.getFullYear();
const grid = document.getElementById("gridPopup"), lbl = document.getElementById("calendarLabel"),
      yrLbl = document.getElementById("yrLbl"), gridMonths = document.getElementById("gridMonths");

function toggleGrid() {
   grid.style.display = grid.style.display === "block" ? "none" : "block";
   renderGrid();
}

function chgYr(d) {
   selYear += d;
   yrLbl.innerText = selYear;
   renderGrid();
}

function renderGrid() {
   yrLbl.innerText = selYear;
   gridMonths.innerHTML = months.map((m, i) => {
      const selected = (i === selMonth && selYear === today.getFullYear()) ? 'selected' : '';
      return `<button class="${selected}" onclick="setMonth(${i})">${m}</button>`;
   }).join("");
}

function setMonth(m) {
   selMonth = m;
   const full = new Date(selYear, selMonth).toLocaleString('default', { month: 'long' });
   lbl.innerText = `${full} - ${selYear}`;
   grid.style.display = "none";
   renderCalendar(selMonth, selYear);
}

function renderCalendar(month, year) {
   const daysDiv = document.querySelector("#show_calendar .days");
   const startDate = new Date(year, month, 1);
   const startDay = startDate.getDay();
   const daysInMonth = new Date(year, month + 1, 0).getDate();
   let html = "";

   // Blank cells for days before the 1st
   for (let i = 0; i < startDay; i++) {
      html += `<div class="empty"></div>`;
   }

   // Current month days
   for (let i = 1; i <= daysInMonth; i++) {
      html += `<div>${i}</div>`;
   }

   // Fill remaining boxes after the month's last day
   const total = startDay + daysInMonth;
   const trailingBlanks = 7 - (total % 7);
   if (trailingBlanks < 7) {
      for (let i = 0; i < trailingBlanks; i++) {
         html += `<div class="empty"></div>`;
      }
   }

   daysDiv.innerHTML = html;
}


window.addEventListener("click", e => {
   if (!e.target.closest(".calendar-display") && !e.target.closest(".month-grid-popup"))
      grid.style.display = "none";
});

setMonth(selMonth); // Init on load
</script>