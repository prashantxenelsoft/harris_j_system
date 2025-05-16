<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      // Set default month/year if not already set
      if (!localStorage.getItem("timesheetMonth") || !localStorage.getItem("timesheetYear")) {
         const now = new Date();
         localStorage.setItem("timesheetMonth", now.getMonth()); // 0-based (Jan = 0)
         localStorage.setItem("timesheetYear", now.getFullYear());
      }

   
   
       const mainTabs = document.querySelectorAll("#timesheetTabsMain .nav-link");

         mainTabs.forEach(tab => {
            tab.addEventListener("click", function () {
               const targetId = tab.getAttribute("data-bs-target"); // e.g. "#overviewTab"
               const suffix = targetId.replace("#", "").replace("Tab", ""); // e.g. "overview"
               const modalTarget = `#model${suffix}Tab`;

               // Set modal tab as active immediately
               document.querySelectorAll("#timesheetTabsModal .nav-link").forEach(btn => {
                  const isActive = btn.getAttribute("data-bs-target") === modalTarget;
                  btn.classList.toggle("active", isActive);
               });

               // Set modal tab-pane as active immediately
               document.querySelectorAll("#timesheetModal .tab-pane").forEach(pane => {
                  const isVisible = `#${pane.id}` === modalTarget;
                  pane.classList.toggle("show", isVisible);
                  pane.classList.toggle("active", isVisible);
               });
            });
         });

   });
</script>

<script>
   const timesheetData = @json($dataTimesheet);

   document.addEventListener("DOMContentLoaded", function () {
      const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
      const selectedYear = parseInt(localStorage.getItem("timesheetYear"));
      const submitBtn = document.getElementById("submit_icon");
      const save_icon = document.getElementById("save_icon");
      const reporting_fileds_data = document.getElementById("reporting_fileds_data");
      

      let hasData = false;
      let hasDraft = false;

      timesheetData.forEach(item => {
         const record = JSON.parse(item.record || '{}');
         const applyOnCell = record.applyOnCell || '';
         const status = item.status?.toLowerCase() || '';

         if (!applyOnCell || !status) return;

         const parts = applyOnCell.split(" / ");
         if (parts.length !== 3) return;

         const month = parseInt(parts[1]);
         const year = parseInt(parts[2]);

         if (month === selectedMonth && year === selectedYear) {
            hasData = true;
            if (status === 'draft') {
               hasDraft = true;
            }
         }
      });

      if (submitBtn) {
         if (!hasData || hasDraft) {
            submitBtn.style.display = "grid"; 
            reporting_fileds_data.style.display = "block"; 
            save_icon.style.display = "flex"; 
         } else {
            submitBtn.style.display = "none"; 
            reporting_fileds_data.style.display = "none"; 
            save_icon.style.display = "none"; 
         }
      }
   });
</script>



<div class="tab-content" id="pills-tabContent">
   <div class="tab-pane fade" id="homeconsultant" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
   <div class="tab-pane fade show active" id="consultantsconsultant" role="tabpanel" aria-labelledby="pills-profile-tab">
      <div class="container my-4">
         <div class="row">
            <div class="col-lg-9 col-xl-8">
               <div class="calender-wrap-parent">
                  <div class="login-dashboard-top-bar mb-0">
                     <div class="left-col-top-bar">
                      <div class="left-col-top-bar">
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

                                 <li>
                                    <h6>Client Name</h6>
                                    <p>: {{ $consultant->client_name ?? 'N/A' }}</p>
                                 </li>
                           </ul>
                        </div>

                        <div id="reporting_fileds_data" class="client-details-consultant">
                           <ul>
                                 <li>
                                    <input type="text" placeholder="Enter Corporate Email Of Consultant">
                                    </li>

                                    <li>
                                    <input type="text" placeholder="Enter Reporting Manager Email Id">
                                    </li>
                              
                           </ul>
                        </div>
                     </div>
                     </div>
                     <div class="right-col-top-bar">
                        <div class="calendar-top-header-btn-group">
                           <a href="#" class="edit-icon" id="edit_icon">
                           <i class="fa fa-pen"></i>
                           </a>
                           <a href="#" class="save-btn" id="save_icon">
                           <img src="{{ asset('public/assets/latest/images/save-icon-circle.png') }}" class="img-fluid" />
                           Save
                           </a>
                           <a href="#" class="submit-btn" id="submit_icon">
                           Submit
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="calender-custom">
                     <div class="calendar-container">
                        <div class="calender-top-steps-wrapper">
                              <div class="progress-steps-calender">
                                    <ul id="timeSheetStatus">
                                       <li>
                                          <span>
                                                <svg width="83" height="96" viewBox="0 0 83 96" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M63.508 56.7614V47.5231L55.9182 55.9137L43.4382 60.3551C42.7468 60.5934 42.028 60.4566 41.489 59.9645C41.0007 59.5231 40.778 58.9059 40.8679 58.2653L11.8169 58.2614C10.9575 58.2614 10.2661 57.57 10.2661 56.7223C10.2661 55.8629 10.9575 55.1715 11.8169 55.1715H41.6179L44.0671 45.2106L63.5081 23.7226V11.3006C63.5081 9.14036 61.9573 7.32006 59.9183 6.90216V10.4803C59.9183 13.91 57.1175 16.7108 53.6878 16.7108C50.2581 16.7108 47.4573 13.91 47.4573 10.4803V6.80056H45.2854V10.4725C45.2854 13.9022 42.4846 16.703 39.0549 16.703C35.6252 16.703 32.8361 13.9022 32.8361 10.4725L32.84 6.80056H30.6681V10.4725C30.6681 13.9022 27.8673 16.703 24.4493 16.703C21.0196 16.703 18.2188 13.9022 18.2188 10.4725V6.80056H16.0391V10.4725C16.0391 13.9022 13.25 16.703 9.8203 16.703C6.3906 16.703 3.5898 13.9022 3.5898 10.4725V6.89826C1.5507 7.32013 0 9.13656 0 11.2967V84.9767C0 87.4572 2.0195 89.4767 4.5 89.4767H45.762C43.5901 86.1564 42.3323 82.1876 42.3323 77.9257C42.3401 66.2377 51.8086 56.7614 63.508 56.7614ZM11.817 22.2384H51.688C52.5474 22.2384 53.2388 22.9298 53.2388 23.7775C53.2388 24.6369 52.5474 25.3283 51.688 25.3283H11.817C10.9576 25.3283 10.2662 24.6369 10.2662 23.7775C10.2701 22.9415 10.9576 22.2384 11.817 22.2384ZM11.817 28.3595H36.645C37.5044 28.3595 38.1958 29.0509 38.1958 29.9103C38.1958 30.7618 37.5044 31.4494 36.645 31.4494H11.817C10.9576 31.4494 10.2662 30.758 10.2662 29.9103C10.2701 29.0587 10.9576 28.3595 11.817 28.3595ZM11.817 38.6995H44.426C45.2854 38.6995 45.9768 39.3909 45.9768 40.2503C45.9768 41.1018 45.2854 41.7894 44.426 41.7894H11.817C10.9576 41.7894 10.2662 41.098 10.2662 40.2503C10.2701 39.3909 10.9576 38.6995 11.817 38.6995ZM11.817 44.8206H36.645C37.5044 44.8206 38.1958 45.512 38.1958 46.3714C38.1958 47.223 37.5044 47.9222 36.645 47.9222H11.817C10.9576 47.9222 10.2662 47.223 10.2662 46.3714C10.2701 45.512 10.9576 44.8206 11.817 44.8206ZM11.817 61.2696H36.645C37.5044 61.2696 38.1958 61.961 38.1958 62.8204C38.1958 63.6798 37.5044 64.3712 36.645 64.3712H11.817C10.9576 64.3712 10.2662 63.6798 10.2662 62.8204C10.2701 61.961 10.9576 61.2696 11.817 61.2696ZM36.649 80.8286H11.817C10.9576 80.8286 10.2662 80.1372 10.2662 79.2895C10.2662 78.4301 10.9576 77.7387 11.817 77.7387H36.645C37.5044 77.7387 38.1958 78.4301 38.1958 79.2895C38.1997 80.141 37.5084 80.8286 36.649 80.8286ZM40.0279 74.7114H11.8169C10.9575 74.7114 10.2661 74.02 10.2661 73.1606C10.2661 72.309 10.9575 71.6215 11.8169 71.6215H40.0279C40.8794 71.6215 41.5787 72.3129 41.5787 73.1606C41.5787 74.02 40.8795 74.7114 40.0279 74.7114ZM70.5589 20.5314L73.0394 22.7697C65.5003 31.1095 57.9614 39.4497 50.4104 47.7897L47.9299 45.5514L70.5589 20.5314ZM81.9069 22.5392L79.8678 24.8009L75.5787 20.922L75.1099 20.4923L72.6294 18.254L74.6685 15.9923C75.2779 15.3204 76.3169 15.2736 76.9888 15.8712L81.7974 20.2228C82.4693 20.8283 82.5202 21.8712 81.9069 22.5392ZM49.9579 51.5392L50.6298 52.1486L52.4892 53.8283L49.2783 54.9689L44.4189 56.6994L45.6572 51.6877L46.4658 48.3869L49.9579 51.5392ZM55.1688 52.1095L52.6883 49.8595L75.3173 24.8395L77.7978 27.0778L55.1688 52.1095ZM63.5086 59.8517C53.5477 59.8517 45.4386 67.9728 45.4386 77.9217C45.4386 87.8706 53.5597 95.9917 63.5086 95.9917C73.4578 95.9917 81.5786 87.8706 81.5786 77.9217C81.5786 67.9686 73.4575 59.8517 63.5086 59.8517ZM63.5086 90.6407C56.5086 90.6407 50.7976 84.9298 50.7976 77.9297C50.7976 70.9296 56.5085 65.2187 63.5086 65.2187C70.5087 65.2187 76.2196 70.9296 76.2196 77.9297C76.2196 84.9298 70.5087 90.6407 63.5086 90.6407ZM21.3176 10.4687V3.1289C21.3176 1.4101 22.7278 0 24.4465 0C26.1692 0 27.5676 1.4102 27.5676 3.1289V10.4805C27.5676 12.1993 26.1574 13.6094 24.4387 13.6094C22.7278 13.6016 21.3176 12.1991 21.3176 10.4687ZM6.68858 10.4687V3.1289C6.68858 1.4101 8.09878 0 9.81748 0C11.5362 0 12.9464 1.4102 12.9464 3.1289V10.4805C12.9464 12.1993 11.5362 13.6094 9.81748 13.6094C8.09868 13.6016 6.68858 12.1991 6.68858 10.4687ZM35.9386 10.4687V3.1289C35.9386 1.4101 37.3488 0 39.0675 0C40.7862 0 42.1964 1.4102 42.1964 3.1289V10.4805C42.1964 12.1993 40.7862 13.6094 39.0675 13.6094C37.3487 13.6016 35.9386 12.1991 35.9386 10.4687ZM50.5596 10.4687V3.1289C50.5596 1.4101 51.9698 0 53.6885 0C55.4072 0 56.8174 1.4102 56.8174 3.1289V10.4805C56.8174 12.1993 55.4072 13.6094 53.6885 13.6094C51.9697 13.6016 50.5596 12.1991 50.5596 10.4687ZM72.6296 77.9297C72.6296 78.7891 71.9382 79.4805 71.0788 79.4805H63.5085C62.6491 79.4805 61.9577 78.7891 61.9577 77.9297V69.918C61.9577 69.0664 62.6491 68.3672 63.5085 68.3672C64.36 68.3672 65.0593 69.0664 65.0593 69.918V76.3789H71.0788C71.9303 76.3789 72.6296 77.0703 72.6296 77.9297Z" fill="black"></path>
                                                </svg>
                                          </span>
                                       </li>

                                       <li>
                                          <span>
                                                <svg width="91" height="95" viewBox="0 0 91 95" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M70.2 45.3V5.2C70.2 2.4 67.9 0 65 0H5.2C2.4 0 0 2.3 0 5.2V84.5C0 86.3 1.1 88 2.8 88.6C3.3 88.8 3.8 88.9 4.3 88.9C5.5 88.9 6.7 88.4 7.6 87.4L18.6 74.7H40.7C42.9 86.3 53.1 95 65.3 95C79.1 95 90.4 83.7 90.4 69.9C90.5 57.7 81.7 47.5 70.2 45.3ZM14.9 14.8C14.9 14.7 15 14.6 15.1 14.6H55.2C55.3 14.6 55.4 14.7 55.4 14.8V21.2C55.4 21.3 55.3 21.4 55.2 21.4H15.1C15 21.4 14.9 21.3 14.9 21.2V14.8ZM14.9 34.1C14.9 34 15 33.9 15.1 33.9H55.2C55.3 33.9 55.4 34 55.4 34.1V40.5C55.4 40.6 55.3 40.7 55.2 40.7H15.1C15 40.7 14.9 40.6 14.9 40.5V34.1ZM15.1 60.1C15 60.1 14.9 60 14.9 59.9V53.5C14.9 53.4 15 53.3 15.1 53.3H46.8C45 55.3 43.5 57.6 42.4 60.1H15.1ZM65.4 88C55.4 88 47.3 79.9 47.3 69.9C47.3 59.9 55.4 51.8 65.4 51.8C75.4 51.8 83.5 59.9 83.5 69.9C83.5 79.9 75.4 88 65.4 88Z" fill="black"></path>
                                                   <path d="M70.1996 62.5L63.0996 70.6L59.7996 67.3C58.3996 65.9 56.1996 65.9 54.8996 67.3C53.4996 68.7 53.4996 70.9 54.8996 72.2L60.7996 78.1C61.4996 78.8 62.2996 79.1 63.2996 79.1H63.3996C64.3996 79.1 65.2996 78.6 65.8996 77.9L75.4996 67C76.7996 65.5 76.5996 63.3 75.1996 62.1C73.6996 60.9 71.4996 61 70.1996 62.5Z" fill="black"></path>
                                                </svg>
                                          </span>
                                       </li>

                                       <li>
                                          <span>
                                                <svg width="83" height="93" viewBox="0 0 83 93" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M8.5855 90.0079H63.0935C62.8044 91.422 61.5505 92.4923 60.0505 92.4923H3.1055C1.3946 92.4923 0 91.0978 0 89.3868V8.5858C0 6.8749 1.3945 5.4803 3.1055 5.4803H11.8633L4.2735 13.0701C3.1055 14.2381 2.4883 15.7342 2.4883 17.3826V83.9056C2.48439 87.2689 5.2222 90.0079 8.5855 90.0079ZM82.8905 69.0429C82.8905 76.914 76.5116 83.2929 68.6405 83.2929C60.7694 83.2929 54.3905 76.914 54.3905 69.0429C54.3905 61.1718 60.7694 54.7929 68.6405 54.7929C76.5077 54.7929 82.8905 61.1718 82.8905 69.0429ZM76.8046 62.9374C75.8046 61.9452 74.1913 61.9491 73.1991 62.9491L66.4569 69.7538L64.0507 67.41C63.0429 66.4295 61.4257 66.4491 60.4452 67.4608C59.4647 68.4686 59.4843 70.0858 60.496 71.0663L64.7108 75.1718C65.7108 76.1445 67.3124 76.1327 68.2967 75.1405L76.8123 66.5428C77.8045 65.5468 77.8007 63.9296 76.8046 62.9374ZM67.5624 86.2574C67.0194 86.7261 66.3085 87.0152 65.5351 87.0152L8.5861 87.0113C6.8752 87.0113 5.4806 85.6168 5.4806 83.9058V19.0938H18.7736C21.9689 19.0938 24.5744 16.4922 24.5744 13.293V0H65.5314C67.2423 0 68.6369 1.3945 68.6369 3.1055L68.6408 51.7965C66.1642 51.7965 63.8127 52.3199 61.6838 53.2574C62.0901 52.9918 62.3596 52.5269 62.3596 52.0035C62.3596 51.1754 61.6877 50.5074 60.8635 50.5074H22.4845C21.6564 50.5074 20.9884 51.1793 20.9884 52.0035C20.9884 52.8316 21.6603 53.4996 22.4845 53.4996H60.8635C61.0041 53.4996 61.1408 53.4801 61.2697 53.4449C58.5275 54.7418 56.1877 56.7418 54.4689 59.2105L22.4809 59.2144C21.6528 59.2144 20.9848 59.8863 20.9848 60.7105C20.9848 61.5386 21.6567 62.2066 22.4809 62.2066H52.7969C52.0313 63.9761 51.5547 65.898 51.4258 67.9175L22.4808 67.9214C21.6527 67.9214 20.9847 68.5933 20.9847 69.4175C20.9847 70.2456 21.6566 70.9136 22.4808 70.9136H51.4928C51.7116 72.9448 52.2819 74.8667 53.1451 76.6245H22.4811C21.653 76.6245 20.985 77.2964 20.985 78.1206C20.985 78.9487 21.6569 79.6167 22.4811 79.6167H55.0161C57.9653 83.4136 62.4646 85.941 67.5624 86.2574ZM17.5274 78.1246C17.5274 77.2965 16.8555 76.6285 16.0313 76.6285H13.2618C12.4337 76.6285 11.7657 77.3004 11.7657 78.1246C11.7657 78.9527 12.4376 79.6207 13.2618 79.6207H16.0313C16.8594 79.6246 17.5274 78.9527 17.5274 78.1246ZM17.5274 69.4176C17.5274 68.5895 16.8555 67.9215 16.0313 67.9215H13.2618C12.4337 67.9215 11.7657 68.5934 11.7657 69.4176C11.7657 70.2457 12.4376 70.9137 13.2618 70.9137H16.0313C16.8594 70.9176 17.5274 70.2457 17.5274 69.4176ZM17.5274 60.7145C17.5274 59.8864 16.8555 59.2184 16.0313 59.2184H13.2618C12.4337 59.2184 11.7657 59.8903 11.7657 60.7145C11.7657 61.5426 12.4376 62.2106 13.2618 62.2106H16.0313C16.8594 62.2106 17.5274 61.5387 17.5274 60.7145ZM17.5274 52.0075C17.5274 51.1794 16.8555 50.5114 16.0313 50.5114H13.2618C12.4337 50.5114 11.7657 51.1833 11.7657 52.0075C11.7657 52.8356 12.4376 53.5036 13.2618 53.5036H16.0313C16.8594 53.5036 17.5274 52.8356 17.5274 52.0075ZM27.7814 15.5425C27.7814 20.6675 31.9337 24.8198 37.0587 24.8198C42.1837 24.8198 46.336 20.6675 46.336 15.5425C46.336 10.4175 42.1837 6.2652 37.0587 6.2652C31.9376 6.2652 27.7814 10.4175 27.7814 15.5425ZM21.1369 43.8545H52.9809C53.6801 43.8545 54.227 43.2686 54.1762 42.5693C53.5121 33.7216 46.0668 26.6903 37.0592 26.6903C28.0514 26.6903 20.6062 33.7215 19.9422 42.5693C19.8914 43.2685 20.4377 43.8545 21.1369 43.8545ZM5.7499 16.0965H18.7769C20.3199 16.0965 21.5816 14.8387 21.5816 13.2918L21.5777 0.268796C21.2496 0.421136 20.9449 0.632076 20.6675 0.909416L6.39053 15.1864C6.11319 15.4638 5.90224 15.7645 5.7499 16.0965Z" fill="black"></path>
                                                </svg>
                                          </span>
                                       </li>

                                       <li>
                                          <span>
                                                <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path fill-rule="evenodd" clip-rule="evenodd" d="M8 26.3823V20.4995C14.1523 18.8862 19.016 14.105 20.742 7.99951H51.258C52.9846 14.105 57.8478 18.8865 64 20.4995V26.3823C64 39.7453 56.668 52.0303 44.906 58.3783L35.9998 63.183L27.0936 58.3783C15.3316 52.0306 8 39.7453 8 26.3823ZM29.637 24.019C28.8558 23.2378 27.5901 23.2378 26.8089 24.019C26.0277 24.8003 26.0276 26.0659 26.8089 26.8471L31.7581 31.8002C32.1331 32.1752 32.344 32.683 32.344 33.2143C32.344 33.7417 32.1331 34.2534 31.7581 34.6284L26.8089 39.5776C26.0276 40.3589 26.0276 41.6245 26.8089 42.4057C27.5901 43.1869 28.8558 43.187 29.637 42.4057L34.5862 37.4565C35.3675 36.6753 36.6331 36.6753 37.4143 37.4565L42.3635 42.4057C43.1447 43.187 44.4104 43.187 45.1916 42.4057C45.9728 41.6245 45.9729 40.3588 45.1916 39.5776L40.2424 34.6284C39.4612 33.8472 39.4612 32.5776 40.2424 31.8003L45.1916 26.8472C45.9729 26.066 45.9729 24.8003 45.1916 24.0191C44.4104 23.2379 43.1447 23.2379 42.3635 24.0191L37.4143 28.9683C37.0393 29.3433 36.5315 29.5543 36.0002 29.5543C35.4689 29.5543 34.9611 29.3433 34.5861 28.9683L29.637 24.019Z" fill="black"></path>
                                                   <path fill-rule="evenodd" clip-rule="evenodd" d="M18.1759 62.1875C19.7931 63.3711 21.504 64.4531 23.297 65.418L35.051 71.7618C35.6447 72.0782 36.3557 72.0782 36.9494 71.7618L48.7034 65.418C63.0554 57.6758 72.0004 42.688 72.0004 26.383V16.203C72.0004 14.4803 70.6059 13.0858 68.8832 13.0858H68.5746C66.5394 13.0858 64.6488 12.4764 63.0707 11.4335C62.5394 11.0819 62.0434 10.6835 61.5863 10.2382C59.7308 8.4218 58.5785 5.8905 58.5785 3.0898C58.5785 1.3828 57.1957 0 55.4887 0H16.5117C14.8047 0 13.4219 1.3828 13.4219 3.0898C13.4219 8.6093 8.94529 13.0859 3.42579 13.0859H3.1172C1.3945 13.0859 0 14.4804 0 16.2031V26.3831C0 40.6491 6.84758 53.9095 18.1759 62.1875ZM54.6099 3.9995H17.3909C17.3792 4.17528 17.3674 4.34716 17.3479 4.51903C16.6526 11.3901 10.9846 16.792 3.99991 17.074V26.3826C3.99991 41.2146 12.1405 54.8556 25.1949 61.8986L35.9999 67.7267L46.8049 61.8986C59.8599 54.8556 67.9999 41.2146 67.9999 26.3826V17.074C67.7108 17.0623 67.4257 17.0428 67.1444 17.0115C60.3827 16.3279 55.0469 10.8279 54.6099 3.9995Z" fill="black"></path>
                                                </svg>

                                          </span>
                                       </li>

                                       <li>
                                          <span>
                                                <svg width="73" height="73" viewBox="0 0 73 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M36.5012 0.00234544C37.6059 0.00234544 38.6075 0.628562 39.4917 1.79656C39.9444 2.38525 40.3713 3.13343 40.7771 4.02467C41.401 3.26946 42.0085 2.65732 42.5925 2.20231C43.7442 1.30403 44.8771 0.959261 45.9466 1.24774C47.0138 1.53388 47.8184 2.39698 48.3743 3.75496C48.6581 4.44215 48.8785 5.27476 49.0404 6.23637C49.8402 5.66644 50.5837 5.23255 51.2663 4.94641L51.3672 4.90888C52.6713 4.38117 53.8159 4.35772 54.7518 4.89481L54.8315 4.94641C55.7392 5.51165 56.2693 6.53423 56.4476 7.93912C56.5414 8.67791 56.5391 9.54101 56.4476 10.5097C57.3623 10.1696 58.195 9.94207 58.9315 9.84122C60.381 9.64421 61.5303 9.90924 62.3114 10.6902C63.0925 11.4713 63.3599 12.6205 63.1605 14.0699C63.0596 14.8064 62.8345 15.639 62.492 16.5537C63.4654 16.4599 64.3262 16.4575 65.058 16.549L65.1659 16.5678C66.5592 16.7624 67.5631 17.316 68.1049 18.2494C68.6608 19.2063 68.6209 20.3861 68.0533 21.737C67.7648 22.4218 67.3332 23.1653 66.7679 23.9604C67.7296 24.1222 68.5646 24.3427 69.2495 24.6218L69.3527 24.6687C70.6498 25.2199 71.4778 26.0126 71.7545 27.054C72.0407 28.1211 71.6982 29.2493 70.8022 30.4055C70.3496 30.9919 69.7374 31.5993 68.9774 32.2232C69.864 32.6289 70.6146 33.0582 71.2057 33.5085C72.3714 34.3927 73 35.3965 73 36.4988C73 37.6035 72.3737 38.605 71.2057 39.4915C70.6169 39.9442 69.8687 40.3711 68.9798 40.7768C69.7374 41.4007 70.3496 42.0081 70.8022 42.5898C71.6982 43.7437 72.043 44.8742 71.7545 45.9437C71.4684 47.0132 70.6029 47.8223 69.2471 48.3758C68.5599 48.6549 67.7272 48.8754 66.7632 49.0396C67.3285 49.8347 67.7624 50.5782 68.0509 51.263C68.6185 52.6093 68.6584 53.7913 68.1049 54.7482C67.5537 55.7052 66.5123 56.2587 65.0627 56.4416C64.3239 56.5378 63.4631 56.5331 62.4897 56.4416C62.8321 57.3563 63.0573 58.1913 63.1581 58.9254C63.3575 60.3748 63.0901 61.524 62.3091 62.3051L62.2223 62.3825C61.4412 63.1025 60.3224 63.3464 58.9268 63.1564C58.1903 63.0556 57.3576 62.8304 56.4429 62.4903C56.5367 63.4637 56.5391 64.3221 56.4476 65.0562L56.4288 65.1641C56.2341 66.5572 55.6806 67.5611 54.7471 68.1028C53.7901 68.6587 52.6103 68.6165 51.2616 68.0512C50.5767 67.7628 49.8332 67.3312 49.038 66.766C48.8762 67.7299 48.6557 68.5625 48.3766 69.2497L48.3297 69.3529C47.7785 70.6499 46.9857 71.4778 45.9443 71.7546C44.8771 72.0407 43.7489 71.6983 42.5925 70.8024C42.0061 70.3497 41.3986 69.7376 40.7724 68.9777C40.3666 69.8642 39.9374 70.6124 39.4894 71.2058C38.6075 72.3738 37.6059 73 36.4988 73C35.3941 73 34.3925 72.3738 33.5083 71.2058C33.0556 70.6171 32.6287 69.8689 32.2229 68.9777C31.599 69.7329 30.9915 70.345 30.4075 70.8C29.2558 71.6983 28.1229 72.0431 27.0534 71.7546C25.9885 71.4685 25.1816 70.6054 24.6257 69.2474C24.3419 68.5602 24.1215 67.7276 23.9596 66.766C23.1598 67.3359 22.4163 67.7698 21.7337 68.0559L21.6328 68.0935C20.3287 68.6212 19.1841 68.647 18.2482 68.1075L18.1685 68.0559C17.2608 67.4907 16.7307 66.4681 16.5524 65.0632C16.4586 64.3244 16.4609 63.4613 16.5524 62.4903C15.6377 62.8328 14.805 63.0579 14.0685 63.1588C12.619 63.3558 11.4697 63.0908 10.6886 62.3097C9.90753 61.5287 9.64014 60.3795 9.83951 58.9301C9.94037 58.1936 10.1655 57.361 10.508 56.4463C9.53459 56.5401 8.67378 56.5425 7.94197 56.451L7.83408 56.4322C6.44083 56.2376 5.43694 55.684 4.89513 54.7506C4.33923 53.7937 4.37911 52.6116 4.94673 51.263C5.23523 50.5782 5.66681 49.8347 6.23208 49.0396C5.27041 48.8778 4.4354 48.6573 3.75051 48.3782L3.6473 48.3313C2.35022 47.7801 1.52225 46.985 1.24548 45.946C0.959323 44.8789 1.30177 43.7507 2.19776 42.5945C2.65045 42.0081 3.26264 41.4007 4.02259 40.7768C3.13598 40.3711 2.38541 39.9418 1.79433 39.4915C0.626257 38.6073 0 37.6035 0 36.5012C0 35.3965 0.626257 34.395 1.79433 33.5085C2.38306 33.0558 3.13129 32.6289 4.02024 32.2232C3.26264 31.5993 2.65045 30.9919 2.19776 30.4102C1.30177 29.2563 0.956977 28.1235 1.24548 27.0563C1.53163 25.9845 2.39713 25.1777 3.75285 24.6242C4.44009 24.3451 5.27276 24.1246 6.23677 23.9604C5.6715 23.1653 5.23757 22.4218 4.94907 21.737C4.38145 20.3907 4.34158 19.2087 4.89513 18.2518C5.44633 17.2948 6.49009 16.7413 7.93728 16.5584C8.67612 16.4622 9.53693 16.4669 10.5103 16.5584C10.1679 15.6437 9.94271 14.8087 9.84185 14.0746C9.64248 12.6252 9.90987 11.476 10.6909 10.6949L10.7777 10.6175C11.5588 9.89751 12.6776 9.65359 14.0732 9.84357C14.8097 9.94442 15.6424 10.1696 16.5571 10.5097C16.4633 9.53632 16.4609 8.67791 16.5524 7.94381L16.5712 7.83592C16.7659 6.44276 17.3194 5.43894 18.2529 4.89716C19.2099 4.3413 20.3897 4.38352 21.7384 4.94875C22.4233 5.23724 23.1668 5.66879 23.962 6.23402C24.1238 5.27007 24.3443 4.43746 24.6234 3.75027L24.6703 3.64707C25.2215 2.35007 26.0143 1.52215 27.0557 1.2454C28.1229 0.959261 29.2511 1.30169 30.4075 2.19762C30.9939 2.65028 31.6014 3.26243 32.2276 4.02233C32.6334 3.13578 33.0626 2.3876 33.5106 1.79422C34.3925 0.626217 35.3941 0 36.5012 0V0.00234544ZM19.6086 39.3086L27.1331 48.221C27.6679 48.8566 28.3059 49.3398 29.0166 49.6611C29.7273 49.9801 30.5083 50.1372 31.3387 50.1185C32.1713 50.102 32.9477 49.9097 33.642 49.5603C34.3409 49.2085 34.9555 48.6972 35.4621 48.0405L53.4242 24.7696C53.8182 24.2583 53.7244 23.5242 53.2131 23.1302C52.7018 22.7361 51.9676 22.8299 51.5736 23.3412L33.6115 46.6121C33.3206 46.9897 32.9758 47.2805 32.5888 47.4729C32.2018 47.6675 31.7655 47.7754 31.2917 47.7848C30.8156 47.7942 30.3723 47.7074 29.9782 47.5315C29.5842 47.3533 29.2277 47.0788 28.9181 46.7153L21.3936 37.8029C20.9761 37.3103 20.2373 37.2494 19.7447 37.6645C19.2521 38.082 19.1911 38.8208 19.6063 39.3133L19.6086 39.3086Z" fill="black"></path>
                                                </svg>
                                          </span>
                                       </li>
                                       <li>
                                          <span>
                                                <svg width="66" height="81" viewBox="0 0 66 81" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M62.2 0H13.7L0 13.7V76.8C0 78.7 1.6 80.3 3.5 80.3H62.1C64 80.3 65.6 78.7 65.6 76.8V3.60001C65.7 1.70001 64.1 0 62.2 0ZM14.6 15H2.7L14.6 3.10001V15ZM17.5 30.6C17.5 30.2 17.7 29.9 17.8 29.7V29.6C17.8 29.5 18 29.3 18.1 29.2L25.2 22.1C26 21.3 27.1 21.3 27.9 22.1C28.3 22.4 28.5 22.9 28.5 23.4C28.5 23.8 28.2 24.4 27.9 24.7L24 28.6H44.9C46 28.6 46.8 29.4 46.8 30.5V36.4C46.8 37.5 46 38.3 44.9 38.3C43.8 38.3 43 37.5 43 36.4V32.4H24L27.9 36.3C28.3 36.6 28.5 37.2 28.5 37.6C28.5 38 28.2 38.6 27.9 38.9C27.6 39.3 27 39.5 26.6 39.5C26.2 39.5 25.6 39.2 25.3 38.9L18.2 31.8C17.9 31.6 17.7 31.1 17.5 30.6ZM47.8 52.7V52.8C47.8 53 47.7 53.1 47.5 53.2L40.4 60.3C40.1 60.6 39.5 60.9 39.1 60.9C38.7 60.9 38.1 60.7 37.8 60.3C37.4 59.9 37.2 59.4 37.2 59C37.2 58.5 37.4 58 37.8 57.7L41.7 53.8H20.8C19.7 53.8 18.9 53 18.9 51.9V46C18.9 44.9 19.7 44.1 20.8 44.1C21.9 44.1 22.7 44.9 22.7 46V50H41.7L37.8 46.1C37.5 45.8 37.2 45.2 37.2 44.8C37.2 44.4 37.4 43.8 37.8 43.5C38.5 42.8 39.7 42.7 40.4 43.4L47.5 50.5C47.8 50.8 48.1 51.4 48.1 51.8C48.1 52.2 47.9 52.5 47.8 52.7Z" fill="black"></path>
                                                </svg>
                                          </span>
                                       </li>

                                    </ul>
                              </div>

                           <!-- <div class="month-controls">
                              <button onclick="changeMonth(-1)">&#x25C0;</button>
                              <select id="monthSelect"></select>
                              <select id="yearSelect"></select>
                              <button onclick="changeMonth(1)">&#x25B6;</button>
                           </div> -->

                           <!-- HTML -->
                           <div class="month-year-wrapper">
                              <div class="month-year-picker" onclick="toggleMonthYearMenu()">
                                 <img src="{{ asset('public/assets/latest/images/calender.png') }}" class="img-fluid" />
                                 <span id="monthYearLabel"></span>
                              </div>

                              <div id="monthYearDropdown" class="dropdown-hidden">
                                 <select id="monthSelect" onchange="onMonthYearChange()"></select>
                                 <select id="yearSelect" onchange="onMonthYearChange()"></select>
                              </div>
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

                        <div class="modal fade" id="extralogmodal" tabindex="-1" aria-labelledby="extralogmodal" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <div class="model_employee">
                                       <div class="model_emp_img">
                                          <img src="{{ asset('public/assets/latest/images/emp-icon1.png') }}" alt="" />
                                       </div>
                                       <span class="model_emp_name">{{ $consultant->emp_name ?? 'N/A' }}</span>
                                    </div>
                                    </button>
                                    <button type="button" class="btn-close ml-close-btn" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload();">
                                    <i class="fa-solid fa-xmark"></i>
                                    </button>
                                 </div>
                                 <div class="modal-body p-0">
                                    <div class="modal_body_inner">
                                       <div class="mb_left">
                                          <div class="ml_date_box">
                                             <div class="ml_date">
                                                <span>Date: <span id="extralogDisplay"></span></span>
                                             </div>
                                             <div class="ml_duty_time">
                                                <span id="extralog_custom_pop_time">
                                                   Time On Duty : <span id="logHourSlot">--</span><span>.00 / 8.00</span>
                                                </span>
                                             </div>
                                          </div>
                                          <div class="ml_leave_detail">
                                             <div class="leave_type">
                                                <span>Select leave type :</span>
                                             </div>
                                             <div class="leave_type_options">
                                                <div><a href="#" data-type="comp_off">Comp - Off</a></div>
                                                <div><a href="#" data-type="pay_off">Pay - Off</a></div>
                                                <div><a href="#" data-type="ignore">Ignore</a></div>
                                             </div>
                                             <input type="hidden" id="selectedLeaveType" />
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
                                                <span>Extra Hours : <span id="show_extra_hours"></span> Hours</span>
                                             </div>
                                             <div class="leave_slot_selector">
                                                <span>Total Working Hours : <span id="show_total_hours"></span> Hours</span>
                                             </div>
                                             <div class="leave_slot_selector">
                                                <span>Select Leave Slot :</span>
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
                                                <button class="ml_cancel_btn"
                                                   data-bs-dismiss="modal"
                                                   aria-label="Close"
                                                   onclick="location.reload();">
                                                Cancel
                                             </button>

                                                <button class="ml_clockit_btn">Clock It</button>
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
    const modal = document.getElementById("extralogmodal");
    if (!modal) return;

    const rangeInput = modal.querySelectorAll(".range-input input");
    const range = modal.querySelector(".range-selected");
    const minTooltip = modal.querySelector(".min-tooltip");
    const maxTooltip = modal.querySelector(".max-tooltip");
    const dateRange = modal.querySelector("#dateRange");
    const clockItBtn = modal.querySelector(".ml_clockit_btn");
    const leaveTypeButtons = modal.querySelectorAll(".leave_type_options a");
    const selectedLeaveTypeInput = modal.querySelector("#selectedLeaveType");
    const remarkInput = modal.querySelector("#customRemark");
    const displayDate = modal.querySelector("#extralogDisplay");

    const timeLabels = Array.from({ length: 48 }, (_, i) => {
        const hours = Math.floor(i / 2);
        const minutes = i % 2 === 0 ? "00" : "30";
        const suffix = hours >= 12 ? "PM" : "AM";
        const displayHours = hours % 12 === 0 ? 12 : hours % 12;
        return `${displayHours}:${minutes} ${suffix}`;
    });

    function setSlider(minIndex, maxIndex, disable = true) {
        rangeInput[0].value = minIndex;
        rangeInput[1].value = maxIndex;
        updateSlider();
        rangeInput.forEach(input => input.disabled = disable);
        range.style.pointerEvents = disable ? "none" : "auto";
    }

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
        if (parseInt(modal.getAttribute("data-full-hour") || "0") === 24) {
            maxTooltip.textContent = "12:00 AM"; // 👈 manually override
         }
    }

    modal.addEventListener("shown.bs.modal", function () {
      const clickedDate = modal.getAttribute("data-date")?.trim() || "";
      const fullHour = parseInt(modal.getAttribute("data-full-hour") || "0");

      displayDate.innerText = clickedDate;
      dateRange.value = clickedDate;
      dateRange.setAttribute("readonly", true);
      dateRange.style.cursor = "not-allowed";
      dateRange.style.backgroundColor = "#f9f9f9";

      // ✅ Set slider dynamically based on fullHour
      if (fullHour > 0) {
         const startIndex = 18;
         const endIndex = Math.min(47, startIndex + fullHour * 2);
         setSlider(startIndex, endIndex, true);
      } else {
         setSlider(15, 32, false); // fallback
      }

      // ✅ Auto-select "Custom" leave hour when fullHour is passed
      if (fullHour > 8) {
         const customRadio = modal.querySelector('#customDay');
         if (customRadio) customRadio.checked = true;
      }
   });



    leaveTypeButtons.forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            leaveTypeButtons.forEach(b => b.classList.remove("active"));
            this.classList.add("active");
            selectedLeaveTypeInput.value = this.dataset.type;
        });
    });

    if (clockItBtn) {
    clockItBtn.addEventListener("click", function () {
        const selectedDate = dateRange.value.trim();
        const remark = remarkInput.value.trim();
        const fullHour = modal.getAttribute("data-full-hour") || "";

        if (!selectedDate) return alert("Date is missing.");

        // ✅ Validate leave type selection
        const selectedLeaveType = modal.querySelector(".leave_type_options a.active");
        if (!selectedLeaveType) {
            alert("Please select a leave type.");
            return;
        }

        // ✅ Validate remarks input
        if (!remark) {
            alert("Please enter a remark.");
            remarkInput.focus();
            return;
        }

         const extraHours = fullHour > 8 ? fullHour - 8 : 0;

         const recordData = {
            date: "",
            workingHours: fullHour,
            applyOnCell: modal.getAttribute("data-date"),
            remarks: remark,
            type: selectedLeaveType.dataset.type,
            extraHours: extraHours
         };

        const formData = new FormData();
        formData.append("type", "timesheet");
        formData.append("user_id", "{{ $userData['id'] ?? '' }}");
        formData.append("client_id", "{{ $consultant->client_id ?? '' }}");
        formData.append("client_name", "{{ $consultant->client_name ?? '' }}");
        formData.append("record", JSON.stringify(recordData));
        formData.append('status', "Draft");

        for (let pair of formData.entries()) {
            console.log(`${pair[0]}:`, pair[1]);
        }

        fetch("{{ route('consultant.data.save') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').getAttribute("content")
            },
            body: formData
        })
        .then(res => {
            if (!res.ok) throw new Error("Server error");
            return res.json();
        })
        .then(data => {
            console.log("Saved:", data);
            location.reload();
        })
        .catch(error => {
            console.error("Failed to save:", error);
            alert("Failed to save working hours.");
        });
    });
}


    // Active style
    const style = document.createElement("style");
    style.textContent = `
        .leave_type_options a.active {
            background-color: #007bff;
            color: white;
            border-radius: 6px;
            padding: 4px 10px;
        }
    `;
    document.head.appendChild(style);
})();
</script>












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
                                                <span id="medical_pop_time">Time On Duty : <span> -- / 8:30</span></span>
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
                                                <button class="ml_clockit_btn" >
                                                Clock It
                                                </button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <script>
                           document.addEventListener("DOMContentLoaded", () => {
                               const uploadInput = document.getElementById("uploadFile");
                               const uploadCertificateDiv = uploadInput.closest(".upload_certificate");
                               let selectedFile = null;
                           
                               // Create Preview Modal once
                               document.body.insertAdjacentHTML("beforeend", `
                                   <div class="modal fade" id="previewModal" tabindex="-1">
                                       <div class="modal-dialog modal-dialog-centered">
                                           <div class="modal-content">
                                               <div class="modal-header">
                                                   <h5 class="modal-title">Image Preview</h5>
                                                   <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                               </div>
                                               <div class="modal-body text-center" id="previewModalBody"></div>
                                           </div>
                                       </div>
                                   </div>
                               `);
                           
                               const previewModalBody = document.getElementById("previewModalBody");
                           
                               uploadInput.addEventListener("change", (e) => {
                                   selectedFile = e.target.files[0];
                           
                                   // Remove old Preview link
                                   uploadCertificateDiv.querySelector("#previewTrigger")?.remove();
                           
                                   if (selectedFile && (selectedFile.type.startsWith('image/') || selectedFile.type === "application/pdf")) {
                                       const targetPara = [...uploadCertificateDiv.querySelectorAll("p")]
                                           .find(p => p.innerText.includes("Allow to upload file"));
                           
                                       if (targetPara) {
                                           const previewLink = document.createElement("span");
                                           previewLink.id = "previewTrigger";
                                           previewLink.textContent = " Preview";
                                           Object.assign(previewLink.style, {
                                               color: "blue",
                                               textDecoration: "underline",
                                               cursor: "pointer"
                                           });
                           
                                           previewLink.onclick = () => {
                                               if (selectedFile.type.startsWith('image/')) {
                                                   previewModalBody.innerHTML = `<img src="${URL.createObjectURL(selectedFile)}" style="width:100%;max-height:500px;object-fit:contain;">`;
                                                   new bootstrap.Modal(document.getElementById("previewModal")).show();
                                               } else {
                                                   window.open(URL.createObjectURL(selectedFile), "_blank");
                                               }
                                           };
                           
                                           targetPara.appendChild(previewLink);
                                       }
                                   }
                               });
                           });
                           
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

                              const fullDay = modal.querySelector("#fullDay");
                              const fHalfDay = modal.querySelector("#fHalfDay");
                              const sHalfDay = modal.querySelector("#sHalfDay");
                              const customDay = modal.querySelector("#customDay");

                              function setSlider(minIndex, maxIndex, disable = true) {
                                 rangeInput[0].value = minIndex;
                                 rangeInput[1].value = maxIndex;

                                 updateSlider();
                                 rangeInput.forEach(input => input.disabled = disable);
                                 range.style.pointerEvents = disable ? "none" : "auto";
                              }



                              // ✅ Handle radio button selection changes
                              [fullDay, fHalfDay, sHalfDay, customDay].forEach(radio => {
                                 if (radio) {
                                    const popTime = modal.querySelector("#medical_pop_time");
                                    radio.addEventListener("change", function () {
                                          if (this.checked) {
                                             switch (this.id) {
                                                case "fullDay":
                                                      setSlider(18, 37, true); // 9:00 AM – 6:30 PM
                                                      if (popTime) {
                                                         popTime.innerHTML = `Time On Duty : <span>-- / 8:30</span>`;
                                                      }
                                                      break;
                                                case "fHalfDay":
                                                      setSlider(18, 26, true); // 9:00 AM – 1:00 PM
                                                      if (popTime) {
                                                         popTime.innerHTML = `Time On Duty : <span>4:30 / 8:30</span>`;
                                                      }
                                                      break;
                                                case "sHalfDay":
                                                      setSlider(28, 37, true); // 2:00 PM – 6:30 PM
                                                      if (popTime) {
                                                         popTime.innerHTML = `Time On Duty : <span>4:30 / 8:30</span>`;
                                                      }
                                                      break;
                                                case "customDay":
                                                      setSlider(+rangeInput[0].value, +rangeInput[1].value, false); // Enable handles
                                                      if (popTime) {
                                                         popTime.innerHTML = `Time On Duty : <span>-- / 8:30</span>`;
                                                      }
                                                      break;
                                             }
                                          }
                                    });
                                 }
                              });

                           
                               let editingBlock = null;
                               const timeLabels = Array.from({ length: 48 }, (_, i) => {
                                   const hours = Math.floor(i / 2);
                                   const minutes = i % 2 === 0 ? "00" : "30";
                                   const suffix = hours >= 12 ? "PM" : "AM";
                                   const displayHours = hours % 12 === 0 ? 12 : hours % 12;
                                   return `${displayHours}:${minutes} ${suffix}`;
                               });
                           
                               let dateRangeInstance = null;
                           
                               document.addEventListener('DOMContentLoaded', function () {
                                   modal.addEventListener('shown.bs.modal', function () {
                                       if (dateRangeInstance) {
                                           dateRangeInstance.destroy();
                                       }
                           
                                       const dateText = document.getElementById("medicalLeaveDateDisplay").innerText.trim();
                                       let defaultDate = new Date();
                                       if (dateText && dateText.includes("/")) {
                                           const [day, month, year] = dateText.split(" / ").map(Number);
                                           defaultDate = new Date(year, month - 1, day);
                                       }
                           
                                       dateRangeInstance = flatpickr(dateRange, {
                                       mode: "range",
                                       dateFormat: "d / m / Y",
                                       defaultDate: [defaultDate],
                                       minDate: defaultDate,
                                       disable: [
                                           function (date) {
                                               const startDate = new Date(defaultDate.getFullYear(), defaultDate.getMonth(), defaultDate.getDate());
                                               const today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                           
                                             //   if (today.getDay() === 0 || today.getDay() === 6) {
                                             //       return true; // Disable Saturday/Sunday
                                             //   }
                                               if (today < startDate) {
                                                   return true; // Disable past dates
                                               }
                                               return false;
                                           }
                                       ],
                                       onChange: function (selectedDates, dateStr, instance) {
                                           const isRange = dateStr.includes("to");
                                           rangeInput.forEach(input => input.disabled = isRange);
                                           range.style.backgroundColor = isRange ? "transparent" : "#037EFF";
                           
                                           // ✅ Now validate selected dates include defaultDate (clicked cell date)
                                           if (selectedDates.length > 0) {
                                               let isValid = selectedDates.some(date => {
                                                   return date.getDate() === defaultDate.getDate() &&
                                                       date.getMonth() === defaultDate.getMonth() &&
                                                       date.getFullYear() === defaultDate.getFullYear();
                                               });
                           
                                               if (!isValid) {
                                                   Swal.fire({
                                                       icon: "error",
                                                       title: "Invalid Selection",
                                                       text: "You must include the clicked date ( " + defaultDate.toLocaleDateString() + " )",
                                                   });
                                                   instance.clear(); // ❌ Clear wrong selection
                                               }
                                           }
                                       }
                                   });
                           
                           
                           
                                       // ✅ Auto Fill data if editingRecord available
                                       if (window.editingRecord) {
                                           const record = window.editingRecord;
                           
                                           if (record.date && record.date.includes("to")) {
                                               rangeInput.forEach(input => input.disabled = true);  // ✅ Multi date -> disable
                                               range.style.backgroundColor = "transparent";
                                               dateRange.value = record.date.replaceAll("\\/", "/");
                                           } 
                           
                                           // Set leave hour radio
                                           if (record.leaveHourId) {
                                               const leaveHourInput = modal.querySelector(`#${record.leaveHourId}`);
                                               if (leaveHourInput) leaveHourInput.checked = true;
                                           }
                           
                                           // Set slider
                                           if (record.rangeMin && record.rangeMax) {
                                               const minIndex = timeLabels.findIndex(t => t === record.rangeMin);
                                               const maxIndex = timeLabels.findIndex(t => t === record.rangeMax);
                                               if (minIndex >= 0 && maxIndex >= 0) {
                                                   rangeInput[0].value = minIndex;
                                                   rangeInput[1].value = maxIndex;
                                                   updateSlider();
                                               }
                                           }
                           
                                           // Remove old preview
                                           const oldPreview = modal.querySelector(".preview-upload");
                                           if (oldPreview) oldPreview.remove();
                           
                                           // Show certificate preview
                                           if (record.certificate_path) {
                                               const previewContainer = document.createElement("div");
                                               previewContainer.className = "preview-upload";
                                               previewContainer.style.marginTop = "10px";
                           
                                               const path = `{{ asset('') }}` + record.certificate_path;
                           
                                               const previewLink = document.createElement("a");
                                               previewLink.href = "javascript:void(0)";
                                               previewLink.innerText = "Preview";
                                               previewLink.style.color = "#007bff";
                                               previewLink.style.fontWeight = "600";
                                               previewLink.style.textDecoration = "underline";
                                               previewLink.style.marginLeft = "5px";
                           
                                               previewLink.onclick = function () {
                                                   // Pehle se koi modal hai to remove karo
                                                   const oldModal = document.getElementById("dynamicPreviewModal");
                                                   if (oldModal) oldModal.remove();
                           
                                                   // Modal structure create
                                                   const modalDiv = document.createElement("div");
                                                   modalDiv.className = "modal fade";
                                                   modalDiv.id = "dynamicPreviewModal";
                                                   modalDiv.tabIndex = -1;
                                                   modalDiv.setAttribute("aria-hidden", "true");
                                                   modalDiv.innerHTML = `
                                                       <div class="modal-dialog modal-dialog-centered modal-lg">
                                                           <div class="modal-content">
                                                               <div class="modal-header">
                                                                   <h5 class="modal-title">Preview Certificate</h5>
                                                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                               </div>
                                                               <div class="modal-body text-center" id="previewModalContent"></div>
                                                           </div>
                                                       </div>
                                                   `;
                                                   document.body.appendChild(modalDiv);
                           
                                                   // Content inject karo (image or pdf)
                                                   const previewContent = document.getElementById("previewModalContent");
                                                   previewContent.innerHTML = "";
                           
                                                   if (/\.(jpeg|jpg|png|gif|png)$/i.test(record.certificate_path)) {
                                                       const img = document.createElement("img");
                                                       img.src = path;
                                                       img.style.maxWidth = "100%";
                                                       img.style.height = "auto";
                                                       previewContent.appendChild(img);
                                                   } else if (/\.pdf$/i.test(record.certificate_path)) {
                                                       const iframe = document.createElement("iframe");
                                                       iframe.src = path;
                                                       iframe.style.width = "100%";
                                                       iframe.style.height = "500px";
                                                       iframe.style.border = "none";
                                                       previewContent.appendChild(iframe);
                                                   }
                           
                                                   // Bootstrap Modal show karo
                                                   const dynamicModal = new bootstrap.Modal(document.getElementById('dynamicPreviewModal'));
                                                   dynamicModal.show();
                                               };
                           
                                               previewContainer.appendChild(previewLink);
                                               modal.querySelector(".upload_certificate").appendChild(previewContainer);
                                           }
                           
                           
                           
                                           modal.classList.add("editing-mode");
                                       } else {
                                           modal.classList.remove("editing-mode");
                                       }
                                   });
                           
                                   modal.addEventListener("hidden.bs.modal", function () {
                                       if (dateRange._flatpickr) dateRange._flatpickr.clear();
                                       modal.querySelectorAll('input[name="Day"]').forEach(input => input.checked = false);
                                       rangeInput[0].value = 15;
                                       rangeInput[1].value = 32;
                                       updateSlider();
                                       fileInput.value = "";
                                       editingBlock = null;
                                       modal.classList.remove("editing-mode");
                           
                                       const oldPreview = modal.querySelector(".preview-upload");
                                       if (oldPreview) oldPreview.remove();
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
                           
                                       // Image Upload Validation
                                       const fileInput = modal.querySelector('input[type="file"]'); // ✅ Your file input inside modal
                                       if (fileInput && fileInput.files.length === 0) {
                                             alert("Please upload a certificate/image before proceeding.");
                                             fileInput.focus();
                                             return;
                                       }
                                                            
                                       const selectedDate = dateRange.value.includes("to") ? dateRange.value : dateRange.value.trim();
                                       const leaveHourText = modal.querySelector(`label[for="${selectedRadio.id}"]`)?.textContent.trim();
                                       const selectedRadioId = selectedRadio.id;
                                       const rangeMin = parseInt(rangeInput[0].value);
                                       const rangeMax = parseInt(rangeInput[1].value);
                                       const formattedRangeMin = timeLabels[rangeMin];
                                       const formattedRangeMax = timeLabels[rangeMax];
                                       const file = fileInput.files[0];
                           
                                       const formData = new FormData();
                                       formData.append("type", "timesheet");
                                       formData.append("user_id", "{{ $userData['id'] ?? '' }}");
                                       formData.append("client_id", "{{ $consultant->client_id ?? '' }}");
                                       formData.append("client_name", "{{ $consultant->client_name ?? '' }}");
                                       formData.append('status', "Draft");
                           
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
                           
                                          
                                           Swal.close();
                           
                                           // ✅ First: Remove old "ML" tags
                                           document.querySelectorAll(".calendar-cell").forEach(cell => {
                                               const tag = cell.querySelector(".tag");
                                               if (tag && tag.innerText === "ML") {
                                                   tag.remove();
                                                   cell.classList.remove("disabled");
                                               }
                                           });
                           
                           
                                           // ✅ Update editingRecord
                                           if (!window.editingRecord) window.editingRecord = {};
                                           window.editingRecord.date = selectedDate;
                                           window.editingRecord.leaveHour = leaveHourText;
                                           window.editingRecord.leaveHourId = selectedRadioId;
                           
                                           if (!selectedDate.includes("to")) {
                                               window.editingRecord.rangeMin = formattedRangeMin;
                                               window.editingRecord.rangeMax = formattedRangeMax;
                                           } else {
                                               delete window.editingRecord.rangeMin;
                                               delete window.editingRecord.rangeMax;
                                           }
                           
                                           if (file) {
                                               window.editingRecord.certificate_path = ""; 
                                           }
                           
                                           // ✅ Reset UI after Save
                                           rangeInput[0].value = 15;
                                           rangeInput[1].value = 32;
                                           updateSlider();
                           
                                           if (dateRange._flatpickr) {
                                               dateRange._flatpickr.clear();
                                           }
                                           fileInput.value = "";
                                           modal.querySelectorAll('input[name="Day"]').forEach(input => input.checked = false);
                           
                                           const oldPreview = modal.querySelector(".preview-upload");
                                           if (oldPreview) oldPreview.remove();
                           
                                           modal.classList.add("editing-mode");
                           
                                           // ✅ After everything — Reload page
                                           setTimeout(() => {
                                               location.reload();
                                           }, 500); // Thoda smooth karne ke liye 500ms ka delay
                                       })
                                       .catch(error => {
                                           console.error("Fetch error:", error);
                           
                                           // ✅ Hide loader even on error
                                           Swal.close();
                                       });
                           
                                   });
                               }
                           
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
                                                <span id="custom_pop_time">Time On Duty : <span> -- / 8.30</span></span>
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
                                                <div><a href="#" data-type="COMP-OFF">Comp - Off</a></div>
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
                                                <input type="text" id="dateRange" placeholder="dd / mm / yyyy - dd / mm / yyyy" />
                                             </div>
                                             <div class="leave_slot_selector">
                                                <span>Select Leave Slot :</span>
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
                                                <button class="ml_cancel_btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                <button class="ml_clockit_btn">Clock It</button>
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

                           const fullDay = modal.querySelector("#fullDay");
                           const fHalfDay = modal.querySelector("#fHalfDay");
                           const sHalfDay = modal.querySelector("#sHalfDay");
                           const customDay = modal.querySelector("#customDay");

                           function setSlider(minIndex, maxIndex, disable = true) {
                                 rangeInput[0].value = minIndex;
                                 rangeInput[1].value = maxIndex;

                                 updateSlider();
                                 rangeInput.forEach(input => input.disabled = disable);
                                 range.style.pointerEvents = disable ? "none" : "auto";
                              }



                              // ✅ Handle radio button selection changes
                              [fullDay, fHalfDay, sHalfDay, customDay].forEach(radio => {
                                 if (radio) {
                                    const popTime = modal.querySelector("#custom_pop_time");
                                    radio.addEventListener("change", function () {
                                          if (this.checked) {
                                             switch (this.id) {
                                                case "fullDay":
                                                      setSlider(18, 37, true); // 9:00 AM – 6:30 PM
                                                      if (popTime) {
                                                         popTime.innerHTML = `Time On Duty : <span>-- / 8:30</span>`;
                                                      }
                                                      break;
                                                case "fHalfDay":
                                                      setSlider(18, 26, true); // 9:00 AM – 1:00 PM
                                                      if (popTime) {
                                                         popTime.innerHTML = `Time On Duty : <span>4:30 / 8:30</span>`;
                                                      }
                                                      break;
                                                case "sHalfDay":
                                                      setSlider(28, 37, true); // 2:00 PM – 6:30 PM
                                                      if (popTime) {
                                                         popTime.innerHTML = `Time On Duty : <span>4:30 / 8:30</span>`;
                                                      }
                                                      break;
                                                case "customDay":
                                                      setSlider(+rangeInput[0].value, +rangeInput[1].value, false); // Enable handles
                                                      if (popTime) {
                                                         popTime.innerHTML = `Time On Duty : <span>-- / 8:30</span>`;
                                                      }
                                                      break;
                                             }
                                          }
                                    });
                                 }
                              });
                           
                           let dateRangeInstance = null;
                           
                           const timeLabels = Array.from({ length: 48 }, (_, i) => {
                           const hours = Math.floor(i / 2);
                           const minutes = i % 2 === 0 ? "00" : "30";
                           const suffix = hours >= 12 ? "PM" : "AM";
                           const displayHours = hours % 12 === 0 ? 12 : hours % 12;
                           return `${displayHours}:${minutes} ${suffix}`;
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
                           
                           rangeInput.forEach(input => input.addEventListener("input", updateSlider));
                           updateSlider();
                           
                           document.addEventListener('DOMContentLoaded', function () {
                           leaveTypeBtns.forEach(btn => {
                           btn.addEventListener("click", function (e) {
                           e.preventDefault();
                           leaveTypeBtns.forEach(b => b.classList.remove("active"));
                           this.classList.add("active");
                           selectedTypeInput.value = this.dataset.type;
                           });
                           });
                           });
                           
                           modal.addEventListener('shown.bs.modal', function () {
                           if (dateRangeInstance) dateRangeInstance.destroy();
                           
                           const dateText = document.getElementById("customLeaveDisplay").innerText.trim();
                           let defaultDate = new Date();
                           
                           if (dateText && dateText.includes("/")) {
                           const [day, month, year] = dateText.split(" / ").map(Number);
                           defaultDate = new Date(year, month - 1, day);
                           }
                           
                           dateRangeInstance = flatpickr(dateRange, {
                           mode: "range",
                           dateFormat: "d / m / Y",
                           defaultDate: [defaultDate],
                           minDate: defaultDate,
                           disable: [
                           function (date) {
                           const startDate = new Date(defaultDate.getFullYear(), defaultDate.getMonth(), defaultDate.getDate());
                           const today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                           
                           // if (today.getDay() === 0 || today.getDay() === 6) {
                           // return true;
                           // }
                           if (today < startDate) {
                           return true;
                           }
                           return false;
                           }
                           ],
                           onChange: function (selectedDates, dateStr, instance) {
                           const isRange = dateStr.includes("to");
                           rangeInput.forEach(input => input.disabled = isRange);
                           range.style.backgroundColor = isRange ? "transparent" : "#037EFF";
                           
                           if (selectedDates.length > 0) {
                           let isValid = selectedDates.some(date => {
                           return date.getDate() === defaultDate.getDate() &&
                           date.getMonth() === defaultDate.getMonth() &&
                           date.getFullYear() === defaultDate.getFullYear();
                           });
                           
                           if (!isValid) {
                           Swal.fire({
                           icon: "error",
                           title: "Invalid Selection",
                           text: "You must include the clicked date ( " + defaultDate.toLocaleDateString() + " )",
                           });
                           instance.clear();
                           }
                           }
                           }
                           });
                           
                           if (window.editingRecord) {
                           const record = window.editingRecord;
                           
                           if (record.date) dateRange.value = record.date.replaceAll("\\/", "/");
                           
                           leaveTypeBtns.forEach(btn => {
                           if (record.leaveType.includes(btn.dataset.type)) {
                           btn.classList.add("active");
                           selectedTypeInput.value = btn.dataset.type;
                           } else {
                           btn.classList.remove("active");
                           }
                           });
                           
                           if (record.leaveHourId) {
                           const leaveHourInput = modal.querySelector(`#${record.leaveHourId}`);
                           if (leaveHourInput) leaveHourInput.checked = true;
                           }
                           
                           if (record.rangeMin && record.rangeMax) {
                           rangeInput[0].value = record.rangeMin;
                           rangeInput[1].value = record.rangeMax;
                           updateSlider();
                           }
                           
                           if (record.remarks) {
                           remarkInput.value = record.remarks;
                           }
                           }
                           });
                           
                           clockItBtn.addEventListener("click", function () {
                           const selectedDate = dateRange.value.trim();
                           const selectedRadio = modal.querySelector('input[name="Day"]:checked');
                           const leaveHourText = selectedRadio ? modal.querySelector(`label[for="${selectedRadio.id}"]`)?.textContent.trim() : "";
                           const selectedRadioId = selectedRadio?.id || "";
                           const leaveType = selectedTypeInput.value.trim();
                           const remark = remarkInput.value.trim();
                           const rangeMin = rangeInput[0].value;
                           const rangeMax = rangeInput[1].value;
                           
                           if (!leaveType || !selectedRadioId || !selectedDate || !remark) {
                           alert("All fields are mandatory!");
                           return;
                           }
                           
                           const formData = new FormData();
                           formData.append("type", "timesheet");
                           formData.append("user_id", "{{ $userData['id'] ?? '' }}");
                           formData.append("client_id", "{{ $consultant->client_id ?? '' }}");
                           formData.append("client_name", "{{ $consultant->client_name ?? '' }}");
                           formData.append('status', "Draft");
                           
                           const recordData = {
                           date: selectedDate,
                           leaveType: `Custom ${leaveType}`,
                           leaveHour: leaveHourText,
                           leaveHourId: selectedRadioId,
                           applyOnCell: document.getElementById("customLeaveDisplay").innerText.trim(),
                           remarks: remark
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
                           .then(res => res.json())
                           .then(data => {
                           console.log("Saved:", data);
                           // applyTag(lastClickedCell, "Custom", "#007bff");
                           modal.classList.remove("editing-mode");
                           modal.querySelectorAll('input[name="Day"]').forEach(input => input.checked = false);
                           leaveTypeBtns.forEach(btn => btn.classList.remove("active"));
                           selectedTypeInput.value = "";
                           remarkInput.value = "";
                           rangeInput[0].value = 15;
                           rangeInput[1].value = 32;
                           updateSlider();
                           if (dateRange._flatpickr) dateRange._flatpickr.clear();
                           setTimeout(() => {
                           location.reload();
                           }, 500);
                           })
                           .catch(err => {
                           console.error(err);
                           });
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
                          document.addEventListener("DOMContentLoaded", function () {
                           const monthSelect = document.getElementById("monthSelect");
                           const yearSelect = document.getElementById("yearSelect");

                           const savedMonth = localStorage.getItem("timesheetMonth");
                           const savedYear = localStorage.getItem("timesheetYear");

                           if (savedMonth !== null && savedYear !== null) {
                              monthSelect.value = savedMonth;
                              yearSelect.value = savedYear;

                              currentDate.setMonth(parseInt(savedMonth));
                              currentDate.setFullYear(parseInt(savedYear));
                           } else {
                              const now = new Date();
                              currentDate.setMonth(now.getMonth());
                              currentDate.setFullYear(now.getFullYear());
                              monthSelect.value = now.getMonth();
                              yearSelect.value = now.getFullYear();
                           }
                           updateMonthYearLabel();
                           renderCalendar();
                           fetchStatus();
                        });

                           
                           document.getElementById("monthSelect").addEventListener("change", fetchStatus);
                           document.getElementById("yearSelect").addEventListener("change", fetchStatus);

                           function fetchStatus() {
                              const month = document.getElementById("monthSelect").value;
                              const year = document.getElementById("yearSelect").value;

                              fetch(`{{ route('get-timesheet-status') }}?month=${month}&year=${year}`)
                                 .then(response => response.json())
                                 .then(data => {
                                       updateStatusIcon(data.status);  
                                 })
                                 .catch(error => {
                                       console.error("Status fetch error:", error);
                                 });
                           }
                           function updateStatusIcon(status) {
                              const iconList = document.querySelectorAll("#timeSheetStatus li span");

                              // Remove any existing .active class
                              iconList.forEach(span => span.classList.remove("active"));

                              // Match status and activate correct icon
                              switch (status) {
                                 case "draft":
                                       iconList[0].classList.add("active");
                                       break;
                                 case "submitted":
                                       iconList[1].classList.add("active");
                                       break;
                                 case "approved":
                                       iconList[2].classList.add("active");
                                       break;
                                 case "reviewed":
                                       iconList[3].classList.add("active");
                                       break;
                                 case "finalized":
                                       iconList[4].classList.add("active");
                                       break;
                                 case "paid":
                                       iconList[5].classList.add("active");
                                       break;
                                 default:
                                       // No status = no active icon
                                       break;
                              }
                           }

                           const publicHolidays = @json($publicHolidays);
                           const calendarDays = document.getElementById("calendarDays");
                           let calendarEditable = false;
                           const monthSelect = document.getElementById("monthSelect");
                           const yearSelect = document.getElementById("yearSelect");
                           const dropdownSuggestions = [
                              { label: "ML", icon: `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M10.2685 1.94359C10.418 2.07202 10.5662 2.20173 10.7032 2.34356C10.827 2.28952 10.9011 2.22834 10.9913 2.12872C11.5639 1.5477 12.3371 1.19516 13.1251 1.01543C13.1563 1.00825 13.1875 1.00106 13.2196 0.993652C13.5263 0.930101 13.8282 0.922238 14.1407 0.922661C14.1807 0.922692 14.1807 0.922692 14.2214 0.922725C15.4615 0.927264 16.5272 1.3895 17.4353 2.23751C17.9638 2.77688 18.2745 3.41941 18.4767 4.14043C18.4967 4.21022 18.4967 4.21022 18.5171 4.28143C18.6919 5.02626 18.6645 5.93996 18.4767 6.6795C18.4691 6.70967 18.4616 6.73985 18.4538 6.77094C18.1352 8.00358 17.5103 9.04811 16.6798 9.99981C16.6445 10.041 16.6445 10.041 16.6084 10.0831C16.2199 10.5338 15.815 10.9794 15.3628 11.3668C15.271 11.4473 15.1818 11.5301 15.0926 11.6134C14.8832 11.8089 14.6704 11.9963 14.4468 12.1756C14.3646 12.2423 14.2837 12.3097 14.2033 12.3785C14.1807 12.3978 14.1581 12.4172 14.1349 12.4371C14.0912 12.4746 14.0476 12.5122 14.0041 12.5499C13.8863 12.6509 13.7685 12.7368 13.6329 12.8123C13.6145 12.7713 13.596 12.7302 13.5769 12.688C13.3166 12.1274 13.0137 11.7867 12.422 11.5623C12.1195 11.4736 11.8444 11.4789 11.5378 11.5303C11.5055 11.5355 11.4733 11.5407 11.4402 11.5461C11.2044 11.5857 10.9723 11.6365 10.7396 11.6911C9.81663 11.903 8.92494 11.9887 7.98084 11.9781C7.89606 11.9774 7.8113 11.9772 7.72652 11.9772C7.56641 11.977 7.40657 11.9733 7.24652 11.9691C7.19895 11.969 7.15137 11.9688 7.10236 11.9686C6.7384 11.9534 6.57176 11.8237 6.32825 11.5623C6.27957 11.5195 6.2304 11.4772 6.18039 11.436C5.96449 11.2476 5.76335 11.0437 5.56087 10.8412C5.49133 10.7718 5.42148 10.7026 5.35161 10.6335C5.08605 10.3692 4.84105 10.0995 4.6095 9.8045C4.57442 9.76179 4.5392 9.71918 4.50375 9.67678C4.10168 9.19116 4.10168 9.19116 4.10168 9.06231C4.04997 9.06384 4.04997 9.06384 3.99721 9.06541C3.86871 9.06875 3.74026 9.07119 3.61173 9.07304C3.55622 9.07402 3.50072 9.07535 3.44522 9.07704C3.36521 9.07943 3.28527 9.08052 3.20523 9.08138C3.13312 9.08292 3.13312 9.08292 3.05956 9.08448C2.89331 9.05607 2.8371 8.99819 2.7345 8.867C2.70764 8.73028 2.70764 8.73028 2.7345 8.59356C2.89064 8.42614 2.99822 8.37601 3.22552 8.3672C3.25523 8.36697 3.28494 8.36674 3.31555 8.36651C3.34617 8.36553 3.37678 8.36454 3.40833 8.36353C3.48317 8.36125 3.55806 8.3601 3.63293 8.35918C3.61355 8.32358 3.59416 8.28798 3.57419 8.2513C2.87867 6.93937 2.61154 5.34666 3.04504 3.9075C3.39039 2.83669 4.11781 1.96396 5.11131 1.43681C5.42849 1.27465 5.75007 1.14974 6.09387 1.0545C6.13823 1.04201 6.1826 1.02952 6.2283 1.01665C7.61648 0.693196 9.17402 1.02602 10.2685 1.94359ZM9.96106 4.84356C9.91712 4.93578 9.88437 5.01799 9.85394 5.1144C9.84451 5.14243 9.83508 5.17046 9.82537 5.19934C9.79349 5.29459 9.76254 5.39011 9.73157 5.48565C9.70891 5.55392 9.68619 5.62218 9.66342 5.69041C9.61102 5.84776 9.55903 6.00524 9.50726 6.1628C9.39877 6.49255 9.28865 6.82176 9.17859 7.15099C9.13733 7.27446 9.09607 7.39794 9.05482 7.52141C9.04458 7.55205 9.03435 7.5827 9.0238 7.61427C8.91329 7.94514 8.80313 8.27613 8.69305 8.60714C8.68396 8.6345 8.67486 8.66186 8.66548 8.69005C8.61556 8.84017 8.56565 8.9903 8.51575 9.14043C8.43464 9.03723 8.37024 8.93637 8.31305 8.81832C8.29727 8.78599 8.28149 8.75366 8.26522 8.72035C8.2485 8.68576 8.23177 8.65117 8.21454 8.61553C8.17844 8.54198 8.14233 8.46843 8.1062 8.39489C8.0496 8.27926 7.99314 8.16357 7.93702 8.04771C7.88265 7.93567 7.82769 7.82392 7.77264 7.71221C7.75608 7.67762 7.73951 7.64303 7.72244 7.60739C7.63365 7.42831 7.56046 7.29277 7.38293 7.18731C7.26173 7.17767 7.26173 7.17767 7.14856 7.22637C7.03604 7.35216 6.95306 7.48339 6.87421 7.6321C6.85286 7.67201 6.83151 7.71191 6.80951 7.75303C6.78766 7.79434 6.7658 7.83566 6.74329 7.87823C6.59986 8.14816 6.45458 8.41448 6.29229 8.67364C6.24382 8.74669 6.24382 8.74669 6.25012 8.82793C6.05481 8.63262 6.05481 8.63262 5.9718 8.54473C5.8505 8.43152 5.74009 8.43249 5.58161 8.43287C5.52062 8.43288 5.52062 8.43288 5.4584 8.43288C5.41457 8.43309 5.37075 8.43329 5.32559 8.43349C5.28067 8.43355 5.23575 8.43361 5.18947 8.43366C5.04579 8.43388 4.90211 8.43437 4.75842 8.43487C4.6611 8.43506 4.56377 8.43524 4.46645 8.4354C4.22767 8.43583 3.9889 8.43649 3.75012 8.43731C3.79696 8.52369 3.84436 8.60963 3.89287 8.69508C3.93561 8.77134 3.97568 8.84908 4.01493 8.92718C4.09736 9.03896 4.09736 9.03896 4.25245 9.04538C4.31337 9.04355 4.37426 9.04063 4.43509 9.03683C4.50205 9.03545 4.56901 9.03416 4.63597 9.03294C4.74087 9.02972 4.8456 9.02573 4.95041 9.02019C5.52204 8.99273 5.52204 8.99273 5.69965 9.11261C5.84467 9.24734 5.94953 9.40361 6.05481 9.57012C6.12784 9.65852 6.12784 9.65852 6.2428 9.66534C6.41013 9.64237 6.45205 9.57861 6.56262 9.45293C6.61711 9.36618 6.66665 9.28177 6.71429 9.19155C6.72761 9.16705 6.74093 9.14256 6.75465 9.11732C6.79676 9.03975 6.83841 8.96194 6.88 8.88409C6.92196 8.80614 6.96401 8.72826 7.00619 8.65044C7.04434 8.57998 7.0822 8.50937 7.12004 8.43875C7.17638 8.33986 7.23571 8.25374 7.30481 8.16387C7.31727 8.18915 7.32974 8.21442 7.34258 8.24046C7.46007 8.47858 7.57787 8.71655 7.696 8.95435C7.75672 9.07661 7.81733 9.19893 7.87767 9.32138C7.94704 9.46215 8.01692 9.60266 8.08682 9.74316C8.11924 9.8092 8.11924 9.8092 8.15231 9.87657C8.17263 9.91724 8.19296 9.9579 8.2139 9.99979C8.23168 10.0357 8.24946 10.0716 8.26779 10.1086C8.31859 10.2058 8.31859 10.2058 8.43762 10.2732C8.55316 10.2928 8.55316 10.2928 8.672 10.2732C8.82246 10.1555 8.87583 10.0184 8.93292 9.84203C8.94251 9.81368 8.9521 9.78534 8.96199 9.75613C8.99435 9.66009 9.02603 9.56384 9.05774 9.46758C9.08072 9.39898 9.10375 9.33039 9.12681 9.26182C9.1942 9.06099 9.26093 8.85994 9.32756 8.65886C9.37963 8.50183 9.43182 8.34484 9.48405 8.18787C9.49353 8.15937 9.50301 8.13088 9.51278 8.10153C9.56173 7.95441 9.61069 7.80731 9.65968 7.66021C9.67935 7.60113 9.69902 7.54205 9.71869 7.48297C9.7333 7.43909 9.7333 7.43909 9.74821 7.39433C9.80714 7.21729 9.8659 7.04018 9.92452 6.86303C9.96148 6.75138 9.99853 6.63977 10.0356 6.52816C10.0531 6.47549 10.0705 6.42281 10.0879 6.37012C10.1118 6.29771 10.1358 6.22535 10.1599 6.15299C10.1734 6.11211 10.1869 6.07123 10.2009 6.02911C10.2345 5.93731 10.2345 5.93731 10.2736 5.89825C10.3583 6.10137 10.443 6.30451 10.5276 6.50765C10.5993 6.67954 10.671 6.8514 10.7428 7.02323C10.8987 7.39678 11.0545 7.77033 11.2056 8.14587C11.227 8.19876 11.2484 8.25164 11.2698 8.30453C11.3079 8.39885 11.3455 8.49333 11.3828 8.58802C11.4077 8.64975 11.4077 8.64975 11.4332 8.71273C11.4471 8.74764 11.4609 8.78255 11.4752 8.81852C11.5323 8.9218 11.5794 8.96173 11.6798 9.02325C11.781 9.0414 11.781 9.0414 11.8923 9.03965C11.9348 9.04027 11.9773 9.04089 12.0211 9.04153C12.0668 9.04154 12.1125 9.04155 12.1595 9.04156C12.2066 9.04185 12.2537 9.04215 12.3023 9.04246C12.4018 9.04288 12.5014 9.04299 12.6009 9.04282C12.7535 9.04278 12.9059 9.0444 13.0584 9.04613C13.1551 9.04634 13.2518 9.04644 13.3485 9.04644C13.3942 9.04708 13.4399 9.04772 13.487 9.04838C13.7321 9.05196 13.7321 9.05196 13.9362 8.93299C14.0031 8.78753 13.9932 8.70612 13.9454 8.5545C13.7674 8.39649 13.5623 8.42232 13.338 8.42587C13.2984 8.42603 13.2588 8.4262 13.218 8.42637C13.0918 8.42702 12.9656 8.42849 12.8395 8.42999C12.7538 8.43057 12.6681 8.43111 12.5824 8.43159C12.3727 8.43288 12.163 8.43484 11.9532 8.43731C11.9462 8.41267 11.9392 8.38803 11.932 8.36264C11.8698 8.14904 11.7994 7.94426 11.7112 7.74014C11.6993 7.71206 11.6874 7.68399 11.6751 7.65507C11.6362 7.56336 11.597 7.47177 11.5577 7.38018C11.5016 7.24834 11.4456 7.11643 11.3896 6.98452C11.3679 6.93343 11.3679 6.93343 11.3457 6.8813C11.2379 6.62721 11.1324 6.37227 11.0276 6.11691C11.0127 6.0805 10.9977 6.04409 10.9823 6.00657C10.8649 5.72065 10.8649 5.72065 10.8069 5.57822C10.7667 5.47932 10.7262 5.38055 10.6855 5.28179C10.6738 5.25268 10.6621 5.22357 10.65 5.19357C10.5795 5.023 10.5034 4.87321 10.3907 4.72637C10.1891 4.64915 10.1098 4.69813 9.96106 4.84356Z" fill="black"/>
                           <path d="M12.7343 12.344C12.9411 12.5517 13.075 12.8063 13.0909 13.1016C13.0822 13.2589 13.0685 13.3327 12.9668 13.4588C12.8279 13.5745 12.697 13.633 12.5292 13.6965C12.4961 13.7093 12.4629 13.7222 12.4288 13.7354C11.0304 14.2667 9.64902 14.5658 8.16394 14.7268C8.52156 14.7338 8.87919 14.7402 9.23683 14.7461C9.40299 14.7488 9.56915 14.7517 9.7353 14.755C11.1282 14.7825 12.1703 14.667 13.4408 14.0593C13.5728 13.9963 13.7052 13.9342 13.8376 13.872C13.8651 13.8591 13.8926 13.8461 13.921 13.8328C13.9772 13.8064 14.0334 13.78 14.0896 13.7536C14.1749 13.7135 14.2601 13.6733 14.3453 13.6332C14.7877 13.4247 15.2307 13.2178 15.6746 13.0128C15.856 12.9289 16.0368 12.8438 16.2172 12.7579C16.2629 12.7364 16.3085 12.7149 16.3555 12.6927C16.4416 12.652 16.5275 12.6111 16.6133 12.5698C17.0683 12.3561 17.4881 12.275 17.9735 12.4441C18.328 12.6011 18.5999 12.8851 18.7499 13.2424C18.7816 13.3936 18.7704 13.5122 18.7025 13.6536C18.622 13.765 18.5517 13.8115 18.432 13.8782C18.3914 13.9012 18.3508 13.9242 18.309 13.9479C18.2651 13.9721 18.2213 13.9963 18.1761 14.0212C18.1302 14.047 18.0843 14.0729 18.0385 14.0989C17.9441 14.1522 17.8497 14.2053 17.7551 14.2583C17.5498 14.3737 17.3466 14.4929 17.1434 14.612C17.0659 14.6573 16.9884 14.7026 16.9109 14.7478C16.8338 14.7929 16.7567 14.838 16.6796 14.883C16.525 14.9734 16.3703 15.0637 16.2157 15.154C16.1771 15.1765 16.1386 15.1991 16.0988 15.2223C15.7714 15.4133 15.4428 15.6023 15.1141 15.7913C14.8513 15.9428 14.5899 16.0964 14.3294 16.2517C12.9335 17.0835 11.6518 17.7937 9.98615 17.7859C9.95611 17.7858 9.92607 17.7858 9.89512 17.7857C9.18646 17.7837 8.48336 17.727 7.77785 17.665C7.48639 17.6394 7.19486 17.6146 6.90326 17.5905C6.85706 17.5867 6.85706 17.5867 6.80992 17.5828C5.62223 17.4862 4.54078 17.5367 3.47644 18.1252C3.48817 18.1507 3.49991 18.1762 3.51199 18.2024C3.66678 18.5582 3.66678 18.5582 3.59363 18.7502C3.40429 18.9793 3.10507 19.0513 2.83435 19.1506C2.80548 19.1613 2.7766 19.1719 2.74686 19.1829C2.27575 19.3545 1.83175 19.467 1.328 19.3752C1.14807 19.2888 1.14807 19.2888 1.09363 19.1799C1.08973 19.1085 1.08835 19.0369 1.08814 18.9654C1.08792 18.9199 1.0877 18.8743 1.08747 18.8273C1.08742 18.7771 1.08738 18.7269 1.08733 18.6751C1.08715 18.6218 1.08696 18.5686 1.08675 18.5153C1.08623 18.3705 1.08598 18.2256 1.08581 18.0807C1.08569 17.9902 1.08553 17.8998 1.08536 17.8093C1.08482 17.5264 1.08445 17.2434 1.0843 16.9605C1.08412 16.6336 1.08344 16.3068 1.0823 15.98C1.08146 15.7275 1.08107 15.475 1.08101 15.2225C1.08097 15.0716 1.08074 14.9208 1.08004 14.7699C1.0794 14.628 1.07932 14.4861 1.07966 14.3442C1.0797 14.2672 1.07917 14.1903 1.07861 14.1134C1.07883 14.0676 1.07905 14.0218 1.07927 13.9746C1.07922 13.9348 1.07916 13.895 1.0791 13.854C1.09606 13.7328 1.12413 13.6797 1.21082 13.594C1.35486 13.5647 1.35486 13.5647 1.48425 13.5549C1.69557 13.8559 1.81888 14.1913 1.953 14.5315C2.14925 14.4637 2.31864 14.3557 2.49499 14.2483C2.52895 14.2278 2.5629 14.2072 2.59788 14.1861C2.78521 14.0728 2.97203 13.9587 3.15875 13.8444C4.57407 12.9782 4.57407 12.9782 5.38074 12.7273C5.40998 12.718 5.43922 12.7087 5.46935 12.6991C5.57264 12.6684 5.67629 12.6424 5.78113 12.6174C5.82589 12.6063 5.87066 12.5952 5.91678 12.5838C6.30688 12.4982 6.691 12.4947 7.0885 12.5039C7.12999 12.5048 7.12999 12.5048 7.17232 12.5058C7.28829 12.5084 7.40426 12.5111 7.52023 12.5139C8.85223 12.5446 10.0649 12.4215 11.3636 12.1144C11.8641 11.999 12.3177 12.0091 12.7343 12.344ZM2.38269 18.1643C2.38007 18.3161 2.38707 18.3993 2.49011 18.5134C2.59734 18.564 2.65616 18.5754 2.77332 18.5549C2.87613 18.4778 2.92125 18.4224 2.96374 18.301C2.96939 18.1882 2.95424 18.1395 2.8905 18.0471C2.66922 17.8996 2.53653 17.9516 2.38269 18.1643Z" fill="black"/>
                           </svg>` },
                           
                           { label: "AL", icon: `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <g clip-path="url(#clip0_41720_7480)">
                           <path d="M0.624785 6.875C6.81229 6.875 12.9998 6.875 19.3748 6.875C19.378 8.68291 19.3812 10.4908 19.3846 12.3535C19.386 12.9243 19.3874 13.4952 19.3889 14.0833C19.3896 14.7804 19.3896 14.7804 19.3897 15.1068C19.3898 15.3347 19.3904 15.5626 19.3913 15.7905C19.3923 16.0536 19.3927 16.3166 19.3925 16.5797C19.3924 16.7141 19.3926 16.8486 19.3934 16.9831C19.3942 17.1274 19.394 17.2717 19.3936 17.4161C19.394 17.4575 19.3945 17.499 19.395 17.5418C19.3907 18.0847 19.1805 18.5033 18.8157 18.8965C18.3576 19.33 17.8529 19.3926 17.2475 19.3901C17.1824 19.3903 17.1173 19.3905 17.0522 19.3908C16.874 19.3913 16.6959 19.3912 16.5178 19.3909C16.3253 19.3907 16.1329 19.3912 15.9405 19.3916C15.5638 19.3923 15.1872 19.3923 14.8105 19.3921C14.5043 19.3919 14.1981 19.392 13.8919 19.3922C13.8482 19.3922 13.8046 19.3923 13.7597 19.3923C13.6711 19.3924 13.5825 19.3924 13.4939 19.3925C12.6633 19.393 11.8328 19.3928 11.0022 19.3923C10.2428 19.392 9.48329 19.3925 8.72381 19.3934C7.94356 19.3944 7.16331 19.3947 6.38305 19.3945C5.94517 19.3943 5.50729 19.3944 5.0694 19.3951C4.69664 19.3957 4.32389 19.3957 3.95112 19.395C3.76103 19.3947 3.57095 19.3946 3.38086 19.3952C3.20665 19.3957 3.03245 19.3956 2.85823 19.3948C2.79541 19.3947 2.73259 19.3948 2.66977 19.3952C2.03923 19.399 1.57228 19.251 1.1033 18.8159C0.725082 18.4163 0.606296 17.9628 0.610693 17.4255C0.610593 17.3802 0.610492 17.335 0.610389 17.2885C0.61023 17.1638 0.610594 17.0391 0.611183 16.9145C0.611697 16.7777 0.611523 16.6409 0.611439 16.5041C0.611377 16.2389 0.611916 15.9737 0.612669 15.7086C0.613515 15.4016 0.613606 15.0947 0.613699 14.7878C0.614313 13.978 0.61595 13.1682 0.617461 12.3584C0.619878 10.5489 0.622295 8.73936 0.624785 6.875ZM9.96072 9.49219C9.85998 9.71437 9.75929 9.93658 9.65865 10.1588C9.62453 10.2341 9.5904 10.3094 9.55626 10.3847C9.50667 10.4941 9.45712 10.6035 9.40759 10.7129C9.38536 10.7619 9.38536 10.7619 9.36267 10.8119C9.22056 11.126 9.08333 11.4419 8.9451 11.7578C8.08143 11.7707 7.21775 11.7836 6.32791 11.7969C6.40341 11.9479 6.48939 12.0504 6.60379 12.1704C6.74473 12.3209 6.8801 12.4732 7.00906 12.6343C7.15894 12.8206 7.31831 12.9952 7.48168 13.1695C7.64243 13.3421 7.79224 13.521 7.93954 13.7053C8.00649 13.7906 8.00649 13.7906 8.08572 13.8672C8.07522 14.1578 7.99639 14.4292 7.91835 14.7081C7.89578 14.7888 7.87356 14.8696 7.85143 14.9505C7.7965 15.1509 7.74104 15.3511 7.68547 15.5513C7.6383 15.7214 7.59138 15.8915 7.54484 16.0617C7.52295 16.1413 7.50069 16.2207 7.47842 16.3002C7.45866 16.3724 7.45866 16.3724 7.4385 16.4461C7.42674 16.4885 7.41497 16.5309 7.40285 16.5745C7.37306 16.683 7.37306 16.683 7.42166 16.7969C8.00133 16.4595 8.57956 16.12 9.15262 15.7715C9.17544 15.7576 9.19825 15.7437 9.22176 15.7294C9.28729 15.6896 9.35278 15.6497 9.41827 15.6097C9.47799 15.5736 9.47799 15.5736 9.53891 15.5367C9.6075 15.4941 9.67522 15.45 9.74151 15.4038C9.82324 15.3473 9.82324 15.3473 9.96072 15.2734C10.1238 15.3191 10.2657 15.4115 10.4101 15.4982C10.4469 15.5201 10.4469 15.5201 10.4844 15.5424C10.5647 15.5901 10.6448 15.6381 10.7249 15.686C10.7805 15.7192 10.8362 15.7524 10.8918 15.7855C11.1712 15.9521 11.4499 16.12 11.7277 16.2892C11.7529 16.3046 11.7782 16.3199 11.8042 16.3358C11.9242 16.4089 12.0442 16.4823 12.1639 16.5559C12.2065 16.5819 12.2491 16.608 12.293 16.6348C12.3303 16.6577 12.3675 16.6806 12.4059 16.7042C12.5006 16.7623 12.5006 16.7623 12.617 16.7969C12.5649 16.4702 12.485 16.1559 12.3945 15.8379C12.3735 15.7628 12.3524 15.6878 12.3314 15.6127C12.2801 15.4296 12.2284 15.2466 12.1766 15.0636C12.1473 14.9602 12.1182 14.8568 12.0893 14.7532C12.0622 14.6563 12.0348 14.5594 12.0071 14.4625C11.9949 14.4186 11.9826 14.3746 11.97 14.3293C11.9537 14.2717 11.9537 14.2717 11.937 14.2129C11.9121 14.0931 11.9048 13.9892 11.9138 13.8672C11.9869 13.7654 11.9869 13.7654 12.0872 13.6646C12.1235 13.627 12.1598 13.5893 12.196 13.5515C12.2143 13.5325 12.2327 13.5136 12.2515 13.494C12.3311 13.4091 12.4029 13.3186 12.4754 13.2275C12.6262 13.0404 12.7864 12.8648 12.9507 12.6896C13.1078 12.521 13.2538 12.3463 13.3968 12.1655C13.4763 12.0703 13.4763 12.0703 13.5839 11.9653C13.6807 11.8866 13.6807 11.8866 13.6717 11.7969C12.808 11.784 11.9443 11.7711 11.0545 11.7578C10.9449 11.5145 10.8353 11.2712 10.7224 11.0205C10.6716 10.9077 10.6716 10.9077 10.6198 10.7927C10.4249 10.3598 10.2312 9.92627 10.0388 9.49219C10.0131 9.49219 9.98729 9.49219 9.96072 9.49219Z" fill="black"/>
                           <path d="M2.49496 1.86701C2.54901 1.86718 2.54901 1.86718 2.60414 1.86735C2.71836 1.86778 2.83256 1.86876 2.94678 1.86976C3.02457 1.87015 3.10237 1.87051 3.18016 1.87083C3.37011 1.87168 3.56005 1.87303 3.75 1.87464C3.75225 1.91738 3.75451 1.96012 3.75683 2.00415C3.76004 2.06088 3.76325 2.1176 3.76648 2.17432C3.76793 2.20242 3.76939 2.23051 3.77089 2.25945C3.78632 2.52431 3.8096 2.75691 4.00635 2.94886C4.19481 3.06484 4.3511 3.07076 4.57031 3.04652C4.74485 2.96084 4.84018 2.87124 4.92188 2.69495C4.97574 2.42561 4.98287 2.14878 5 1.87464C6.44375 1.87464 7.8875 1.87464 9.375 1.87464C9.38789 2.08089 9.40078 2.28714 9.41406 2.49964C9.47253 2.75561 9.47253 2.75561 9.63135 2.94886C9.81981 3.06484 9.9761 3.07076 10.1953 3.04652C10.3698 2.96084 10.4652 2.87124 10.5469 2.69495C10.6007 2.42561 10.6079 2.14878 10.625 1.87464C12.0687 1.87464 13.5125 1.87464 15 1.87464C15.0129 2.08089 15.0258 2.28714 15.0391 2.49964C15.0975 2.75561 15.0975 2.75561 15.2563 2.94886C15.4448 3.06484 15.6011 3.07076 15.8203 3.04652C15.9948 2.96084 16.0902 2.87124 16.1719 2.69495C16.2151 2.5232 16.2233 2.35104 16.2329 2.17493C16.2346 2.14601 16.2363 2.11708 16.238 2.08727C16.2421 2.0164 16.2461 1.94552 16.25 1.87464C16.4736 1.86976 16.6972 1.86624 16.9209 1.86391C16.9968 1.86294 17.0726 1.86161 17.1484 1.85991C17.7283 1.8472 18.2472 1.86928 18.71 2.26756C19.0531 2.59676 19.2439 2.90002 19.375 3.35902C19.375 4.10667 19.375 4.85433 19.375 5.62464C13.1875 5.62464 7 5.62464 0.625 5.62464C0.625 2.94068 0.625 2.94068 1.17569 2.37666C1.55849 2.01343 1.97454 1.86093 2.49496 1.86701Z" fill="black"/>
                           <path d="M15.8596 0.624692C16.0406 0.708759 16.1726 0.829298 16.2502 1.01532C16.2689 1.16413 16.2649 1.30998 16.2599 1.45965C16.2567 1.59662 16.2535 1.73358 16.2502 1.87469C15.8377 1.87469 15.4252 1.87469 15.0002 1.87469C14.997 1.73773 14.9937 1.60077 14.9904 1.45965C14.989 1.41692 14.9876 1.37419 14.9861 1.33016C14.9834 1.09375 14.9988 0.960482 15.1564 0.780942C15.3623 0.585326 15.5903 0.588451 15.8596 0.624692Z" fill="black"/>
                           <path d="M10.2346 0.624692C10.4156 0.708759 10.5476 0.829298 10.6252 1.01532C10.6439 1.16413 10.6399 1.30998 10.6349 1.45965C10.6317 1.59662 10.6285 1.73358 10.6252 1.87469C10.2127 1.87469 9.80018 1.87469 9.37518 1.87469C9.37196 1.73773 9.36873 1.60077 9.36541 1.45965C9.36399 1.41692 9.36257 1.37419 9.3611 1.33016C9.35841 1.09375 9.37376 0.960482 9.53143 0.780942C9.73734 0.585326 9.96534 0.588451 10.2346 0.624692Z" fill="black"/>
                           <path d="M4.60955 0.624692C4.79062 0.708759 4.92257 0.829298 5.00018 1.01532C5.01888 1.16413 5.01493 1.30998 5.00994 1.45965C5.00672 1.59662 5.0035 1.73358 5.00018 1.87469C4.58768 1.87469 4.17518 1.87469 3.75018 1.87469C3.74696 1.73773 3.74373 1.60077 3.74041 1.45965C3.73899 1.41692 3.73757 1.37419 3.7361 1.33016C3.73341 1.09375 3.74876 0.960482 3.90643 0.780942C4.11234 0.585326 4.34034 0.588451 4.60955 0.624692Z" fill="black"/>
                           </g>
                           <defs>
                           <clipPath id="clip0_41720_7480">
                           <rect width="20" height="20" fill="white"/>
                           </clipPath>
                           </defs>
                           </svg>` },
                           
                           {
                              label: "PDO",
                              icon: `
                                 <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <g clip-path="url(#clip0_15_71895)">
                                    <path d="M11.465 4.16667C11.4017 4.20333 6.66667 7.435 6.66667 7.435V14.1667H0V6.21917C0 5.4075 0.366667 4.65583 1.00583 4.15667L5.86917 0.35C6.53833 -0.173333 7.49167 -0.105 8.29667 0.525L10.8567 2.50417C10.925 3.11417 11.1392 3.68 11.4642 4.16583L11.465 4.16667ZM5 8.33333H2.5V10.8333H5V8.33333ZM14.5833 0C13.4325 0 12.5 0.9325 12.5 2.08333C12.5 3.23417 13.4325 4.16667 14.5833 4.16667C15.7342 4.16667 16.6667 3.23417 16.6667 2.08333C16.6667 0.9325 15.7342 0 14.5833 0ZM8.33333 8.31V12.5H10V9.19L11.6667 8.04V11.1725C11.6667 11.9875 12.0658 12.7533 12.7333 13.2208L16.6858 15.8608L16.6667 19.9958L18.3333 20.0042L18.3567 14.9725L15.8333 13.2875L15.8475 10.1108L19.0108 12.1733L19.9208 10.7767L17.2825 9.0575L16.25 6.6675C15.9442 5.68583 14.92 5.00083 14.1667 5.00083C12.9167 5.00083 12.1233 5.72167 12.1233 5.72167L8.33333 8.31ZM12.2175 14.7033L10.085 20H11.8867L13.615 15.6883C13.615 15.6883 12.2617 14.735 12.2175 14.7033Z" fill="black"/>
                                 </g>
                                 <defs>
                                    <clipPath id="clip0_15_71895">
                                       <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                 </defs>
                                 </svg>
                              `
                           },
                              { label: "PH", icon: `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <g clip-path="url(#clip0_15_71871)">
                           <path d="M8.01781 0.300171C8.06207 0.299038 8.10633 0.297905 8.15193 0.296738C8.40251 0.294828 8.56133 0.296929 8.75023 0.468628C8.95379 0.693247 8.90648 0.900715 8.90648 1.21082C9.33187 1.21082 9.75726 1.21082 10.1955 1.21082C10.1955 1.04324 10.1955 0.875659 10.1955 0.703003C10.2786 0.520935 10.3995 0.389483 10.5862 0.312378C10.7493 0.289398 10.91 0.290565 11.0744 0.292847C11.118 0.292242 11.1616 0.291638 11.2064 0.291016C11.4527 0.29219 11.6131 0.298255 11.7971 0.468628C11.9868 0.696318 11.9534 0.911607 11.9534 1.21082C12.3787 1.21082 12.8041 1.21082 13.2424 1.21082C13.2424 1.04324 13.2424 0.875659 13.2424 0.703003C13.3132 0.561401 13.3132 0.561401 13.3987 0.468628C13.4188 0.445264 13.4389 0.421899 13.4597 0.397827C13.6309 0.256432 13.9029 0.300335 14.1116 0.297729C14.1772 0.295539 14.1772 0.295539 14.2442 0.293304C14.5242 0.290328 14.678 0.311173 14.883 0.50769C15.0241 0.73571 15.0002 0.938095 15.0002 1.21082C15.4256 1.21082 15.851 1.21082 16.2893 1.21082C16.2893 1.04324 16.2893 0.875659 16.2893 0.703003C16.4846 0.377482 16.4846 0.377482 16.6799 0.312378C16.84 0.30122 17.0004 0.301532 17.1609 0.300171C17.205 0.299038 17.249 0.297905 17.2945 0.296738C17.544 0.294829 17.7035 0.296407 17.8909 0.468628C18.0632 0.700402 18.0525 0.933822 18.0471 1.21082C18.0946 1.2081 18.0946 1.2081 18.1431 1.20532C18.582 1.19101 18.9176 1.27811 19.2579 1.56299C19.5309 1.83329 19.6992 2.17334 19.7036 2.55881C19.7033 2.5897 19.7031 2.62059 19.7029 2.65242C19.7032 2.70289 19.7032 2.70289 19.7035 2.75439C19.7041 2.86641 19.7038 2.97842 19.7035 3.09045C19.7037 3.17107 19.704 3.25168 19.7043 3.3323C19.705 3.55077 19.705 3.76925 19.7048 3.98772C19.7046 4.17032 19.7049 4.35291 19.7051 4.5355C19.7057 4.96638 19.7056 5.39725 19.7052 5.82812C19.7047 6.27217 19.7053 6.71621 19.7063 7.16026C19.7072 7.54193 19.7074 7.92361 19.7072 8.30529C19.7071 8.53306 19.7072 8.76082 19.7078 8.98858C19.7084 9.20283 19.7083 9.41706 19.7075 9.63131C19.7074 9.70975 19.7075 9.7882 19.7079 9.86665C19.7123 10.7799 19.7123 10.7799 19.3707 11.1317C19.3399 11.164 19.309 11.1963 19.2772 11.2295C19.2451 11.262 19.213 11.2945 19.1799 11.328C19.1486 11.3606 19.1173 11.3932 19.0851 11.4268C18.8726 11.6472 18.6564 11.864 18.4405 12.0811C18.362 12.1602 18.2837 12.2395 18.2057 12.3191C18.1102 12.4165 18.0143 12.5134 17.918 12.61C17.8645 12.6639 17.8115 12.7182 17.7585 12.7726C17.4108 13.1191 17.0944 13.2862 16.6011 13.2858C16.574 13.2859 16.5469 13.2859 16.5189 13.2859C16.4283 13.286 16.3377 13.2858 16.2471 13.2856C16.182 13.2856 16.1169 13.2856 16.0518 13.2856C15.8754 13.2856 15.6989 13.2854 15.5224 13.2851C15.3379 13.2848 15.1534 13.2848 14.9689 13.2848C14.6196 13.2847 14.2703 13.2843 13.9209 13.2839C13.5232 13.2835 13.1255 13.2833 12.7278 13.2831C11.9098 13.2827 11.0917 13.282 10.2737 13.2811C10.2867 13.3255 10.2997 13.3698 10.3131 13.4155C10.3613 13.5799 10.4093 13.7444 10.4572 13.9089C10.478 13.9801 10.4989 14.0513 10.5198 14.1225C10.5498 14.2247 10.5796 14.327 10.6094 14.4294C10.6188 14.4612 10.6282 14.4931 10.6378 14.5259C10.6733 14.6482 10.7034 14.7547 10.7034 14.8827C10.7291 14.8698 10.7549 14.8569 10.7815 14.8436C10.9959 14.8197 11.1902 14.8186 11.3757 14.943C11.6413 15.1593 11.926 15.4006 11.9633 15.7593C11.9572 15.9934 11.8844 16.1231 11.7239 16.2889C11.6643 16.345 11.604 16.4002 11.5432 16.455C11.511 16.4848 11.4787 16.5146 11.4455 16.5453C11.4149 16.5719 11.3843 16.5986 11.3528 16.626C11.2764 16.7177 11.2764 16.7177 11.2939 16.8479C11.341 17.045 11.3974 17.2386 11.4556 17.4327C11.4884 17.5968 11.4935 17.6908 11.4455 17.8514C11.3662 17.9673 11.2707 18.0642 11.1721 18.1639C11.1402 18.1971 11.1082 18.2302 11.0753 18.2643C10.9693 18.3734 10.8621 18.4812 10.7546 18.5887C10.7177 18.6262 10.6807 18.6636 10.6438 18.701C10.6085 18.7364 10.5732 18.7717 10.5369 18.8082C10.5051 18.8401 10.4733 18.8721 10.4405 18.905C10.322 19.0108 10.2374 19.0561 10.0808 19.0795C9.91261 19.0554 9.87013 19.0008 9.76585 18.8671C9.6949 18.7394 9.63116 18.6093 9.57054 18.4764C9.53429 18.5014 9.49803 18.5264 9.46068 18.5521C9.28191 18.6678 9.11717 18.7027 8.90648 18.6718C8.70574 18.5917 8.57549 18.4748 8.42796 18.3226C8.40732 18.3021 8.38667 18.2816 8.3654 18.2605C8.1897 18.0823 8.11409 17.9701 8.11058 17.7196C8.11735 17.4632 8.19439 17.3484 8.3802 17.1715C8.4161 17.1373 8.45201 17.103 8.489 17.0677C8.54194 17.0199 8.54194 17.0199 8.59596 16.9712C8.68156 16.8846 8.68156 16.8846 8.66816 16.793C8.61739 16.629 8.53929 16.483 8.4597 16.3314C8.44251 16.2981 8.42531 16.2648 8.4076 16.2306C8.35277 16.1246 8.29761 16.0188 8.24241 15.913C8.18728 15.8069 8.13221 15.7007 8.07723 15.5945C8.04303 15.5285 8.00874 15.4626 7.97433 15.3967C7.95882 15.3668 7.9433 15.3369 7.92732 15.3062C7.91365 15.28 7.89997 15.2537 7.88588 15.2267C7.85179 15.1561 7.85179 15.1561 7.81273 15.0389C7.79413 15.0526 7.77554 15.0663 7.75638 15.0805C7.73001 15.0999 7.70364 15.1193 7.67647 15.1393C7.64682 15.1612 7.61718 15.183 7.58663 15.2055C7.51983 15.2548 7.45303 15.304 7.38621 15.3531C7.21973 15.4757 7.05339 15.5984 6.88759 15.7219C6.29607 16.1617 5.69322 16.5856 5.07835 16.9921C5.08276 17.0244 5.08276 17.0244 5.08725 17.0573C5.09141 17.0878 5.09558 17.1184 5.09987 17.1498C5.10457 17.1842 5.10928 17.2186 5.11413 17.254C5.12455 17.3308 5.13486 17.4075 5.14504 17.4842C5.17211 17.6868 5.20113 17.8887 5.23491 18.0902C5.24099 18.1284 5.24706 18.1666 5.25332 18.2059C5.26502 18.279 5.27745 18.3519 5.29073 18.4247C5.32042 18.6163 5.3276 18.7484 5.21243 18.9168C5.09696 19.056 4.97119 19.183 4.84154 19.309C4.81341 19.3369 4.78529 19.3648 4.75632 19.3936C4.45242 19.6929 4.45242 19.6929 4.1851 19.7092C4.03819 19.6707 3.94431 19.5535 3.86616 19.4265C3.82742 19.3521 3.7914 19.2768 3.75618 19.2006C3.73634 19.1591 3.73634 19.1591 3.7161 19.1167C3.67419 19.0288 3.63284 18.9406 3.59154 18.8524C3.54999 18.7645 3.50832 18.6767 3.46655 18.5889C3.44071 18.5345 3.415 18.4801 3.38946 18.4255C3.30906 18.2551 3.22049 18.0922 3.12523 17.9296C3.09456 17.962 3.0639 17.9945 3.0323 18.028C2.99087 18.0709 2.94942 18.1138 2.90794 18.1566C2.88788 18.178 2.86781 18.1994 2.84714 18.2214C2.68157 18.3911 2.52844 18.4889 2.29042 18.5324C2.07041 18.5329 1.89728 18.4929 1.71898 18.3593C1.5381 18.1618 1.46851 17.9775 1.47453 17.7103C1.51402 17.3448 1.81788 17.1119 2.07054 16.8749C1.96569 16.8185 1.86072 16.7623 1.7556 16.7064C1.72297 16.6891 1.69034 16.6717 1.65672 16.6538C1.35009 16.4925 1.0377 16.3443 0.722112 16.2013C0.685709 16.1844 0.649307 16.1675 0.611801 16.1501C0.579498 16.1354 0.547196 16.1207 0.513915 16.1055C0.417825 16.0472 0.370765 15.9941 0.312728 15.8983C0.285314 15.7658 0.275961 15.7113 0.312728 15.5858C0.41435 15.4398 0.537682 15.3196 0.664291 15.1952C0.697978 15.1597 0.731664 15.1242 0.766372 15.0876C0.930671 14.9163 1.06554 14.7761 1.28929 14.6874C1.39571 14.6904 1.48551 14.6988 1.58897 14.7173C1.6313 14.7239 1.6313 14.7239 1.67449 14.7306C1.76432 14.7448 1.85394 14.76 1.94359 14.7753C2.03251 14.7897 2.12146 14.804 2.21041 14.8182C2.26764 14.8273 2.32486 14.8366 2.38206 14.8459C2.59042 14.8797 2.79776 14.9042 3.00804 14.9218C3.02097 14.9027 3.0339 14.8837 3.04722 14.8642C3.50765 14.1879 3.97802 13.5207 4.46501 12.8632C4.57058 12.7204 4.67556 12.5772 4.7805 12.434C4.79888 12.4089 4.81727 12.3838 4.83621 12.358C4.87787 12.3011 4.91952 12.2442 4.96117 12.1874C4.93314 12.1765 4.90511 12.1657 4.87623 12.1545C4.76891 12.1105 4.66606 12.0619 4.5623 12.0101C4.50424 11.9811 4.50424 11.9811 4.445 11.9515C4.40425 11.9311 4.3635 11.9106 4.32152 11.8895C4.25888 11.8583 4.25888 11.8583 4.19498 11.8264C4.00905 11.7332 3.82391 11.6394 3.64189 11.5387C3.61517 11.524 3.58845 11.5092 3.56092 11.494C3.49132 11.4552 3.42209 11.4156 3.35289 11.3761C3.25027 11.3231 3.25027 11.3231 3.16246 11.3265C3.04492 11.389 2.9611 11.4832 2.87132 11.5795C2.60669 11.861 2.60669 11.861 2.39921 11.888C2.36326 11.8885 2.32731 11.889 2.29027 11.8895C2.25452 11.8906 2.21876 11.8917 2.18193 11.8929C1.94166 11.854 1.77817 11.6722 1.61156 11.5062C1.59277 11.4881 1.57399 11.4699 1.55464 11.4512C1.39193 11.2887 1.33421 11.1675 1.31615 10.9398C1.32115 10.7357 1.41254 10.5962 1.52367 10.4296C1.48791 10.4112 1.45216 10.3928 1.41533 10.3739C1.36842 10.3493 1.32153 10.3248 1.27464 10.3002C1.25108 10.2881 1.22751 10.2761 1.20323 10.2636C1.07903 10.1981 1.01721 10.1582 0.937728 10.0389C0.909792 9.82942 0.9716 9.73666 1.09398 9.57019C1.16715 9.48997 1.24042 9.41277 1.31737 9.33643C1.33845 9.31527 1.35954 9.29411 1.38126 9.27231C1.42555 9.22797 1.46994 9.18372 1.51442 9.13957C1.58234 9.07206 1.64983 9.00415 1.7173 8.93619C1.76056 8.89298 1.80384 8.8498 1.84715 8.80664C1.86722 8.78642 1.88728 8.7662 1.90795 8.74536C2.09451 8.56122 2.09451 8.56122 2.22679 8.5155C2.49905 8.52429 2.74045 8.59855 2.99889 8.68182C3.13523 8.71311 3.19204 8.72551 3.32054 8.67175C3.44442 8.56581 3.55174 8.444 3.66196 8.32423C3.82379 8.15391 3.94815 8.05942 4.1906 8.03943C4.58325 8.07446 4.79642 8.34159 5.04768 8.62216C5.15269 8.75566 5.16185 8.86111 5.16136 9.02576C5.16151 9.07719 5.16151 9.07719 5.16167 9.12967C5.15648 9.21863 5.15648 9.21863 5.11742 9.29675C5.23343 9.32253 5.34945 9.34832 5.46898 9.37488C5.45609 8.25339 5.4432 7.13191 5.42992 5.97644C5.30101 6.06667 5.1721 6.15691 5.03929 6.24988C4.30517 6.69296 3.44073 6.77718 2.61478 6.5821C1.77253 6.36207 1.09521 5.79787 0.656051 5.05603C0.285447 4.34395 0.182431 3.47262 0.371322 2.69031C0.533975 2.18922 0.775658 1.75521 1.13304 1.36707C1.15409 1.34244 1.17514 1.31782 1.19682 1.29245C1.69698 0.740769 2.50636 0.421174 3.23616 0.382568C4.29075 0.362162 5.05548 0.721526 5.82054 1.44519C5.85982 1.48404 5.89898 1.52301 5.93773 1.56238C5.96351 1.53982 5.98929 1.51726 6.01585 1.49402C6.30045 1.28057 6.55135 1.20478 6.90697 1.20837C6.95233 1.20873 6.9977 1.20908 7.04445 1.20944C7.07884 1.2099 7.11323 1.21035 7.14867 1.21082C7.14731 1.1797 7.14595 1.14858 7.14455 1.11652C7.13365 0.690039 7.13365 0.690039 7.26585 0.50769C7.51183 0.285708 7.69707 0.302871 8.01781 0.300171ZM7.81273 0.937378C7.81273 1.453 7.81273 1.96863 7.81273 2.49988C7.95452 2.49988 8.09632 2.49988 8.24241 2.49988C8.24241 1.98425 8.24241 1.46863 8.24241 0.937378C8.10062 0.937378 7.95882 0.937378 7.81273 0.937378ZM10.8596 0.937378C10.8596 1.453 10.8596 1.96863 10.8596 2.49988C11.0014 2.49988 11.1432 2.49988 11.2893 2.49988C11.2893 1.98425 11.2893 1.46863 11.2893 0.937378C11.1475 0.937378 11.0057 0.937378 10.8596 0.937378ZM13.9065 0.937378C13.9065 1.453 13.9065 1.96863 13.9065 2.49988C14.0483 2.49988 14.1901 2.49988 14.3362 2.49988C14.3362 1.98425 14.3362 1.46863 14.3362 0.937378C14.1944 0.937378 14.0526 0.937378 13.9065 0.937378ZM16.9534 0.937378C16.9534 1.453 16.9534 1.96863 16.9534 2.49988C17.0951 2.49988 17.2369 2.49988 17.383 2.49988C17.383 1.98425 17.383 1.46863 17.383 0.937378C17.2412 0.937378 17.0994 0.937378 16.9534 0.937378ZM1.54411 1.9057C1.04994 2.5321 0.916668 3.16614 0.976791 3.94519C1.07036 4.60601 1.46868 5.12439 1.968 5.54187C2.45289 5.89499 3.07324 6.08009 3.6721 6.0155C4.4073 5.88895 5.02193 5.56779 5.46654 4.95837C5.85924 4.35165 5.97287 3.74487 5.88173 3.03134C5.74218 2.38389 5.35136 1.85204 4.8217 1.46564C3.75185 0.794833 2.39176 0.95109 1.54411 1.9057ZM6.3369 2.08286C6.27933 2.14703 6.27933 2.14703 6.29677 2.23819C6.33153 2.35424 6.36747 2.46983 6.40404 2.58533C6.4846 2.8905 6.4846 2.8905 6.56273 3.59363C10.6877 3.59363 14.8127 3.59363 19.0627 3.59363C19.1269 2.75282 19.1269 2.75282 18.7832 2.05707C18.5548 1.85097 18.3403 1.86079 18.0471 1.87488C18.0456 1.92483 18.0442 1.97478 18.0427 2.02625C18.0401 2.09298 18.0375 2.15971 18.0349 2.22644C18.034 2.25922 18.0331 2.292 18.0322 2.32578C18.021 2.58945 17.9903 2.83262 17.7932 3.02478C17.5887 3.15258 17.3896 3.13344 17.156 3.13464C17.1175 3.13545 17.079 3.13625 17.0393 3.13708C16.8271 3.13823 16.6622 3.13718 16.4846 3.00769C16.2888 2.80206 16.3028 2.57782 16.2991 2.30945C16.2958 2.16604 16.2926 2.02263 16.2893 1.87488C15.8639 1.87488 15.4385 1.87488 15.0002 1.87488C14.9921 2.11965 14.9921 2.11965 14.9851 2.36447C14.9742 2.62599 14.944 2.8345 14.7463 3.02234C14.5445 3.15352 14.3444 3.13482 14.1116 3.13708C14.0734 3.13822 14.0352 3.13935 13.9959 3.14052C13.7492 3.14268 13.5948 3.12347 13.3987 2.96863C13.247 2.76539 13.2602 2.53376 13.2546 2.28992C13.2506 2.15295 13.2466 2.01599 13.2424 1.87488C12.817 1.87488 12.3916 1.87488 11.9534 1.87488C11.9452 2.11965 11.9452 2.11965 11.9382 2.36447C11.9273 2.62599 11.8972 2.8345 11.6994 3.02234C11.4976 3.15352 11.2975 3.13482 11.0647 3.13708C11.0265 3.13822 10.9883 3.13935 10.949 3.14052C10.7023 3.14268 10.548 3.12347 10.3518 2.96863C10.2001 2.76539 10.2133 2.53376 10.2077 2.28992C10.2037 2.15295 10.1997 2.01599 10.1955 1.87488C9.77015 1.87488 9.34476 1.87488 8.90648 1.87488C8.8983 2.13427 8.8983 2.13427 8.89132 2.3937C8.88112 2.65186 8.85015 2.83714 8.65257 3.0199C8.45239 3.15502 8.2509 3.13481 8.01781 3.13708C7.97964 3.13822 7.94147 3.13935 7.90214 3.14052C7.65542 3.14268 7.5011 3.12347 7.30492 2.96863C7.15324 2.76535 7.16638 2.53395 7.16087 2.28992C7.15887 2.23002 7.15887 2.23002 7.15683 2.16891C7.15362 2.07091 7.15092 1.97291 7.14867 1.87488C7.08072 1.87295 7.01277 1.87159 6.94481 1.87045C6.90697 1.86963 6.86913 1.86881 6.83014 1.86796C6.63347 1.8802 6.4916 1.96785 6.3369 2.08286ZM6.4846 4.25769C6.36859 4.56707 6.36859 4.56707 6.25023 4.88269C6.21156 4.96003 6.17288 5.03738 6.13304 5.11707C6.11618 5.21518 6.11618 5.21518 6.11895 5.31431C6.11879 5.3521 6.11863 5.38989 6.11846 5.42883C6.11888 5.46962 6.1193 5.51042 6.11974 5.55246C6.11972 5.59592 6.1197 5.63939 6.11968 5.68418C6.11977 5.82748 6.12068 5.97077 6.1216 6.11407C6.12181 6.21358 6.12198 6.31309 6.1221 6.41259C6.1225 6.64749 6.12342 6.88239 6.1246 7.11729C6.12591 7.38482 6.12656 7.65235 6.12714 7.91989C6.12837 8.46999 6.13043 9.02009 6.13304 9.57019C6.18232 9.58902 6.23164 9.60776 6.28097 9.62647C6.30843 9.63691 6.33589 9.64736 6.36419 9.65812C6.47427 9.69771 6.58572 9.72616 6.69945 9.7533C6.74013 9.76311 6.78082 9.77293 6.82274 9.78305C6.85295 9.79015 6.88316 9.79725 6.91429 9.80457C7.05705 9.66893 7.12195 9.58065 7.13431 9.38168C7.13545 9.3064 7.13552 9.23111 7.13474 9.15583C7.13526 9.09395 7.13526 9.09395 7.13579 9.03083C7.13672 8.8948 7.13628 8.75881 7.13585 8.62277C7.13626 8.52811 7.13677 8.43346 7.13736 8.3388C7.13869 8.08977 7.1389 7.84075 7.13884 7.59172C7.13897 7.24064 7.14064 6.88955 7.14212 6.53847C7.1429 6.35153 7.14326 6.1646 7.14329 5.97767C7.14344 5.89234 7.14359 5.80701 7.14374 5.72169C7.14366 5.68294 7.14358 5.6442 7.1435 5.60428C7.1436 5.56853 7.1437 5.53277 7.1438 5.49593C7.1438 5.46502 7.1438 5.4341 7.14379 5.40225C7.14911 5.30424 7.16638 5.21276 7.18773 5.11707C7.29915 5.07993 7.36808 5.07301 7.48361 5.07276C7.52049 5.07259 7.55736 5.07241 7.59536 5.07223C7.63595 5.07224 7.67654 5.07225 7.71836 5.07225C7.76142 5.07211 7.80447 5.07197 7.84884 5.07182C7.99386 5.07139 8.13888 5.07124 8.28391 5.07109C8.38758 5.07084 8.49125 5.07059 8.59493 5.07031C8.90651 5.06954 9.2181 5.06915 9.52968 5.0688C9.67635 5.06863 9.82302 5.06842 9.96968 5.06821C10.4571 5.06755 10.9445 5.06698 11.4319 5.0667C11.5583 5.06662 11.6848 5.06655 11.8113 5.06647C11.8584 5.06644 11.8584 5.06644 11.9065 5.06642C12.4162 5.06609 12.9258 5.0651 13.4354 5.06383C13.9584 5.06254 14.4814 5.06184 15.0044 5.06171C15.2981 5.06163 15.5919 5.06129 15.8856 5.06029C16.1357 5.05944 16.3857 5.05913 16.6358 5.05951C16.7634 5.05968 16.891 5.05952 17.0187 5.05885C17.1569 5.05817 17.2951 5.05843 17.4334 5.05895C17.4739 5.05852 17.5144 5.05809 17.5561 5.05765C17.8246 5.06009 17.8246 5.06008 17.9549 5.14581C18.0154 5.24646 18.0275 5.30151 18.0274 5.41835C18.0277 5.4552 18.028 5.49206 18.0283 5.53004C18.0279 5.5702 18.0275 5.61036 18.027 5.65174C18.0272 5.69425 18.0273 5.73676 18.0275 5.78055C18.0278 5.92119 18.0269 6.06179 18.026 6.20242C18.026 6.30001 18.0259 6.39759 18.0259 6.49518C18.0258 6.69972 18.0252 6.90426 18.0241 7.1088C18.0229 7.3453 18.0225 7.58178 18.0225 7.81828C18.0226 8.04583 18.0222 8.27337 18.0215 8.50092C18.0213 8.59775 18.0211 8.69458 18.0211 8.79141C18.0209 8.92655 18.0202 9.06168 18.0194 9.19682C18.0194 9.23706 18.0195 9.2773 18.0195 9.31876C18.0192 9.35551 18.0188 9.39226 18.0185 9.43012C18.0184 9.46207 18.0182 9.49402 18.0181 9.52694C18.008 9.60925 18.008 9.60925 17.9299 9.72644C17.82 9.76308 17.7485 9.77134 17.6345 9.77352C17.5985 9.7743 17.5625 9.77508 17.5255 9.77588C17.4674 9.77686 17.4674 9.77686 17.4082 9.77786C17.3685 9.77867 17.3288 9.77949 17.2879 9.78032C17.1609 9.78288 17.0339 9.78518 16.907 9.78748C16.8209 9.78916 16.7349 9.79087 16.6489 9.79259C16.4379 9.79677 16.2269 9.80075 16.0159 9.80457C16.0154 9.83695 16.0154 9.83695 16.0149 9.86998C16.0115 10.095 16.0076 10.3199 16.0035 10.5449C16.002 10.6288 16.0006 10.7127 15.9994 10.7966C15.9976 10.9174 15.9953 11.0381 15.993 11.1588C15.9925 11.1962 15.9921 11.2337 15.9916 11.2722C15.9842 11.6086 15.9842 11.6086 15.8987 11.7577C15.8065 11.8038 15.7536 11.801 15.6509 11.7998C15.6153 11.7995 15.5796 11.7992 15.5429 11.7989C15.5037 11.7984 15.4645 11.7979 15.424 11.7973C15.3386 11.7966 15.2531 11.7958 15.1676 11.7951C15.0993 11.7945 15.0993 11.7945 15.0296 11.7938C14.7383 11.7914 14.447 11.7914 14.1557 11.791C13.8996 11.7904 13.6436 11.7891 13.3876 11.7859C13.14 11.7829 12.8926 11.7822 12.645 11.783C12.5508 11.7829 12.4566 11.782 12.3625 11.7802C11.8396 11.7478 11.8396 11.7478 11.3741 11.938C11.2633 12.0485 11.1804 12.1744 11.094 12.3046C10.9969 12.3975 10.9969 12.3975 10.9109 12.4681C10.8672 12.5041 10.8238 12.5405 10.7815 12.578C10.7815 12.5909 10.7815 12.6038 10.7815 12.6171C12.7537 12.6171 14.726 12.6171 16.758 12.6171C16.7709 11.9983 16.7838 11.3796 16.7971 10.7421C16.9766 10.4279 16.9766 10.4279 17.1455 10.3692C17.3113 10.333 17.4774 10.3326 17.6466 10.3315C17.6861 10.3308 17.7256 10.33 17.7662 10.3293C17.8916 10.3272 18.017 10.3259 18.1423 10.3246C18.2276 10.3233 18.313 10.3219 18.3983 10.3205C18.6067 10.3172 18.8152 10.3146 19.0237 10.3124C19.6619 8.39768 19.0627 6.27596 19.0627 4.25769C14.9119 4.25769 10.7612 4.25769 6.4846 4.25769ZM7.77367 5.703C7.77367 6.15417 7.77367 6.60535 7.77367 7.07019C8.23773 7.07019 8.70179 7.07019 9.17992 7.07019C9.17992 6.61902 9.17992 6.16785 9.17992 5.703C8.71585 5.703 8.25179 5.703 7.77367 5.703ZM9.84398 5.703C9.84398 6.15417 9.84398 6.60535 9.84398 7.07019C10.2951 7.07019 10.7463 7.07019 11.2112 7.07019C11.2112 6.61902 11.2112 6.16785 11.2112 5.703C10.76 5.703 10.3088 5.703 9.84398 5.703ZM11.8752 5.703C11.8752 6.15417 11.8752 6.60535 11.8752 7.07019C12.3393 7.07019 12.8034 7.07019 13.2815 7.07019C13.2815 6.61902 13.2815 6.16785 13.2815 5.703C12.8174 5.703 12.3534 5.703 11.8752 5.703ZM13.9455 5.703C13.9455 6.15417 13.9455 6.60535 13.9455 7.07019C14.4096 7.07019 14.8737 7.07019 15.3518 7.07019C15.3518 6.61902 15.3518 6.16785 15.3518 5.703C14.8877 5.703 14.4237 5.703 13.9455 5.703ZM16.0159 5.703C16.0159 6.15417 16.0159 6.60535 16.0159 7.07019C16.467 7.07019 16.9182 7.07019 17.383 7.07019C17.383 6.61902 17.383 6.16785 17.383 5.703C16.9319 5.703 16.4807 5.703 16.0159 5.703ZM7.77367 7.73425C7.77367 8.0823 7.77367 8.43035 7.77367 8.78894C8.0022 8.61782 8.0022 8.61782 8.22533 8.43982C8.50568 8.22815 8.85489 8.09541 9.17992 7.96863C9.17992 7.89128 9.17992 7.81394 9.17992 7.73425C8.71585 7.73425 8.25179 7.73425 7.77367 7.73425ZM9.84398 7.73425C9.84398 7.78582 9.84398 7.83738 9.84398 7.8905C9.87802 7.89196 9.91206 7.89342 9.94713 7.89493C10.4052 7.92021 10.7979 8.00324 11.2112 8.203C11.2112 8.04832 11.2112 7.89363 11.2112 7.73425C10.76 7.73425 10.3088 7.73425 9.84398 7.73425ZM11.8752 7.73425C11.8736 7.93728 11.872 8.14031 11.8703 8.34949C11.8696 8.41332 11.8689 8.47716 11.8682 8.54293C11.868 8.5933 11.8678 8.64366 11.8676 8.69556C11.8672 8.74711 11.8668 8.79866 11.8664 8.85177C11.8673 8.99351 11.8673 8.99351 11.9534 9.1405C12.3916 9.1405 12.8299 9.1405 13.2815 9.1405C13.2815 8.67644 13.2815 8.21238 13.2815 7.73425C12.8174 7.73425 12.3534 7.73425 11.8752 7.73425ZM13.9455 7.73425C13.9455 8.19832 13.9455 8.66238 13.9455 9.1405C14.4096 9.1405 14.8737 9.1405 15.3518 9.1405C15.3518 8.67644 15.3518 8.21238 15.3518 7.73425C14.8877 7.73425 14.4237 7.73425 13.9455 7.73425ZM16.0159 7.73425C16.0159 8.19832 16.0159 8.66238 16.0159 9.1405C16.467 9.1405 16.9182 9.1405 17.383 9.1405C17.383 8.67644 17.383 8.21238 17.383 7.73425C16.9319 7.73425 16.4807 7.73425 16.0159 7.73425ZM8.00041 9.5264C7.92195 9.61861 7.84066 9.70783 7.75902 9.79724C7.60673 9.966 7.46214 10.1397 7.31926 10.3165C7.23914 10.4145 7.15748 10.5108 7.07497 10.6068C6.86869 10.8471 6.67456 11.0947 6.48364 11.3473C6.33905 11.5381 6.19012 11.7244 6.03783 11.9091C5.8016 12.1962 5.58156 12.494 5.36247 12.7944C5.25624 12.9398 5.14748 13.0828 5.03685 13.225C4.79513 13.5373 4.56527 13.8579 4.33617 14.1796C4.30166 14.2279 4.30166 14.2279 4.26645 14.2772C3.72586 14.912 3.72586 14.912 3.39867 15.6249C3.44942 15.6225 3.50018 15.62 3.55247 15.6176C3.77286 15.6186 3.98973 15.6496 4.1645 15.7938C4.38456 16.0397 4.38442 16.2904 4.37523 16.6014C4.67797 16.4444 4.95891 16.2687 5.23704 16.0717C5.2954 16.0307 5.2954 16.0307 5.35493 15.9888C5.4713 15.9069 5.58739 15.8246 5.70335 15.7421C5.73622 15.7187 5.76909 15.6953 5.80295 15.6712C6.21724 15.3757 6.62593 15.0729 7.03148 14.7655C7.06389 14.741 7.0963 14.7164 7.12969 14.6911C7.53425 14.3844 7.93722 14.076 8.33523 13.7609C8.40002 13.7097 8.46507 13.659 8.5302 13.6083C9.19267 13.0921 9.8421 12.5567 10.4618 11.9896C10.521 11.9371 10.5822 11.8867 10.6448 11.8383C11.0602 11.4955 11.3677 10.9637 11.4455 10.4296C11.4893 9.91032 11.4714 9.39376 11.1234 8.97433C10.7885 8.64087 10.4109 8.54394 9.9514 8.53748C9.14001 8.54326 8.51562 8.9174 8.00041 9.5264ZM4.17992 8.74988C4.11546 8.82722 4.05101 8.90457 3.9846 8.98425C4.1973 9.04226 4.1973 9.04226 4.41429 9.10144C4.43154 8.9518 4.43154 8.9518 4.36302 8.88721C4.34127 8.87089 4.31952 8.85458 4.2971 8.83777C4.25843 8.80876 4.21976 8.77976 4.17992 8.74988ZM2.36388 9.27242C2.33954 9.29696 2.3152 9.32151 2.29011 9.3468C2.2638 9.37324 2.23749 9.39967 2.21039 9.42691C2.18277 9.45486 2.15515 9.4828 2.12669 9.5116C2.09892 9.53954 2.07115 9.56749 2.04254 9.59628C1.97366 9.66562 1.90487 9.73505 1.83617 9.80457C1.9852 9.92872 2.15435 10.0092 2.32643 10.0962C2.35934 10.1129 2.39224 10.1297 2.42615 10.147C2.49652 10.1829 2.56692 10.2187 2.63735 10.2544C2.82052 10.3473 3.00345 10.4408 3.18642 10.5341C3.22224 10.5523 3.25807 10.5706 3.29498 10.5894C3.56137 10.7252 3.82707 10.8622 4.09202 11.0009C4.14294 11.0274 4.14294 11.0274 4.19489 11.0544C4.37174 11.1468 4.54766 11.2406 4.72298 11.3358C4.76088 11.3562 4.79878 11.3766 4.83784 11.3976C4.90985 11.4363 4.98166 11.4755 5.05321 11.5151C5.08503 11.5322 5.11684 11.5492 5.14961 11.5668C5.17744 11.582 5.20527 11.5972 5.23394 11.6129C5.33176 11.6472 5.37423 11.6424 5.46898 11.6014C5.52934 11.5443 5.52934 11.5443 5.58021 11.4702C5.60045 11.443 5.62069 11.4157 5.64154 11.3876C5.66274 11.3583 5.68395 11.3289 5.70579 11.2987C5.88831 11.0517 6.07573 10.8137 6.28289 10.5868C6.34009 10.5238 6.34009 10.5238 6.40648 10.4296C6.38714 10.3716 6.38714 10.3716 6.36742 10.3124C6.2587 10.2666 6.2587 10.2666 6.12216 10.2323C6.08364 10.2216 6.08364 10.2216 6.04434 10.2107C5.95862 10.187 5.87273 10.164 5.78682 10.141C5.72643 10.1245 5.66604 10.1079 5.60568 10.0912C5.44547 10.0472 5.28512 10.0037 5.12472 9.96039C4.96602 9.91743 4.80746 9.87401 4.64889 9.83058C4.46281 9.77964 4.27672 9.72871 4.09056 9.67803C3.65221 9.55858 3.21502 9.43547 2.77857 9.30924C2.73696 9.29722 2.69535 9.28521 2.65248 9.27283C2.59811 9.25703 2.59811 9.25703 2.54264 9.24092C2.44091 9.20644 2.44091 9.20644 2.36388 9.27242ZM12.1096 9.80457C12.1064 9.9085 12.1032 10.0124 12.0998 10.1195C12.0867 10.421 12.0345 10.6905 11.9471 10.9787C11.9089 11.0925 11.9089 11.0925 11.9143 11.2108C12.3655 11.2108 12.8166 11.2108 13.2815 11.2108C13.2815 10.7468 13.2815 10.2827 13.2815 9.80457C12.8948 9.80457 12.508 9.80457 12.1096 9.80457ZM13.9455 9.80457C13.9455 10.2686 13.9455 10.7327 13.9455 11.2108C14.4096 11.2108 14.8737 11.2108 15.3518 11.2108C15.3518 10.7468 15.3518 10.2827 15.3518 9.80457C14.8877 9.80457 14.4237 9.80457 13.9455 9.80457ZM2.08275 10.8397C2.06583 10.8591 2.04891 10.8784 2.03148 10.8983C2.08972 11.0466 2.17824 11.1175 2.30492 11.2108C2.38226 11.1206 2.4596 11.0303 2.53929 10.9374C2.49659 10.9116 2.45389 10.8858 2.4099 10.8593C2.38588 10.8448 2.36186 10.8302 2.33711 10.8153C2.2304 10.7641 2.17251 10.7599 2.08275 10.8397ZM17.4221 10.9764C17.4221 11.3503 17.4221 11.7241 17.4221 12.1093C17.5925 11.9632 17.7526 11.8229 17.9102 11.6654C17.9289 11.6467 17.9476 11.6281 17.9669 11.6089C18.0057 11.57 18.0446 11.5311 18.0833 11.4922C18.143 11.4323 18.2029 11.3726 18.2628 11.313C18.3007 11.275 18.3386 11.237 18.3765 11.1991C18.4108 11.1648 18.4451 11.1305 18.4804 11.0951C18.5594 11.0289 18.5594 11.0289 18.5549 10.9764C18.1811 10.9764 17.8073 10.9764 17.4221 10.9764ZM9.32396 13.8036C9.06277 14.0318 8.79324 14.2448 8.51585 14.453C8.48534 14.4759 8.45482 14.4988 8.42338 14.5224C8.40234 14.5382 8.38129 14.554 8.3596 14.5702C8.3835 14.7652 8.47002 14.9201 8.55965 15.0917C8.576 15.1235 8.59236 15.1553 8.60922 15.188C8.66169 15.2898 8.7145 15.3914 8.76732 15.493C8.80149 15.5593 8.83565 15.6255 8.86978 15.6917C9.05475 16.0501 9.2419 16.4074 9.43005 16.7641C9.58421 17.0566 9.73631 17.3501 9.88792 17.6439C9.91437 17.6951 9.94082 17.7463 9.96727 17.7975C10.0304 17.9196 10.0934 18.0418 10.1565 18.1639C10.3171 18.0307 10.4685 17.8933 10.6156 17.7451C10.6468 17.7137 10.678 17.6823 10.7102 17.65C10.7337 17.6263 10.7572 17.6025 10.7815 17.578C10.5802 16.8206 10.3705 16.0658 10.1579 15.3115C10.1134 15.1535 10.069 14.9953 10.0246 14.8372C9.99002 14.7139 9.95531 14.5906 9.92057 14.4673C9.90414 14.409 9.88774 14.3506 9.87138 14.2922C9.8487 14.2113 9.82588 14.1304 9.80304 14.0496C9.79016 14.0038 9.77728 13.958 9.764 13.9109C9.73081 13.8021 9.69281 13.6984 9.64867 13.5936C9.51211 13.5936 9.42217 13.7163 9.32396 13.8036ZM1.37901 15.4503C1.3491 15.4884 1.3491 15.4884 1.31859 15.5272C1.29824 15.5526 1.2779 15.578 1.25694 15.6041C1.24184 15.6239 1.22673 15.6436 1.21117 15.6639C1.61168 15.8666 2.01455 16.0618 2.4221 16.2499C2.49945 16.0307 2.57679 15.8116 2.65648 15.5858C2.41954 15.5288 2.18136 15.4848 1.94115 15.4442C1.91034 15.4389 1.87953 15.4337 1.84778 15.4282C1.81832 15.4233 1.78885 15.4184 1.7585 15.4134C1.7321 15.409 1.7057 15.4046 1.67849 15.4C1.51542 15.3747 1.51542 15.3747 1.37901 15.4503ZM10.9377 15.5468C10.8827 15.6568 10.9179 15.7098 10.9548 15.8251C10.966 15.8606 10.9773 15.8962 10.9888 15.9328C10.9978 15.9601 11.0067 15.9874 11.0159 16.0155C11.1319 15.9188 11.1319 15.9188 11.2502 15.8202C11.2131 15.7744 11.1756 15.7289 11.1379 15.6835C11.1171 15.6581 11.0962 15.6327 11.0748 15.6066C11.0553 15.5868 11.0359 15.5671 11.0159 15.5468C10.9901 15.5468 10.9643 15.5468 10.9377 15.5468ZM3.63304 16.2499C3.1432 16.7397 2.65335 17.2296 2.14867 17.7343C2.16156 17.7729 2.17445 17.8116 2.18773 17.8514C2.31205 17.7966 2.39529 17.7316 2.49081 17.6354C2.51895 17.6072 2.54709 17.5791 2.57609 17.5501C2.60604 17.5197 2.63599 17.4893 2.66685 17.4581C2.69785 17.427 2.72884 17.3959 2.76077 17.3638C2.85965 17.2645 2.95826 17.1649 3.05687 17.0653C3.12389 16.9979 3.19092 16.9305 3.25798 16.8631C3.42227 16.698 3.58633 16.5326 3.75023 16.3671C3.71156 16.3284 3.67288 16.2897 3.63304 16.2499ZM4.06029 17.4608C4.03065 17.472 4.00102 17.4832 3.97049 17.4947C3.89705 17.5224 3.82363 17.5502 3.75023 17.578C4.02008 18.1949 4.02008 18.1949 4.33617 18.7889C4.44583 18.7236 4.53274 18.6573 4.6096 18.5546C4.62951 18.4084 4.60187 18.2759 4.57298 18.1322C4.56681 18.0952 4.56065 18.0582 4.55429 18.0201C4.51536 17.793 4.46577 17.5682 4.41429 17.3436C4.30018 17.3436 4.16818 17.4199 4.06029 17.4608ZM9.02367 17.4608C8.98264 17.5054 8.94297 17.5511 8.90404 17.5975C8.87194 17.6356 8.87194 17.6356 8.83919 17.6744C8.82272 17.6942 8.80625 17.7139 8.78929 17.7343C8.86663 17.8116 8.94398 17.8889 9.02367 17.9686C9.11524 17.9332 9.16816 17.9103 9.21898 17.8246C9.21898 17.6778 9.14048 17.5833 9.06273 17.4608C9.04984 17.4608 9.03695 17.4608 9.02367 17.4608Z" fill="black"/>
                           <path d="M15.3884 13.5045C15.4257 13.504 15.463 13.5035 15.5014 13.5029C15.5612 13.5028 15.5612 13.5028 15.6223 13.5027C15.6845 13.5023 15.6845 13.5023 15.7479 13.5019C15.8355 13.5015 15.9232 13.5013 16.0108 13.5013C16.1443 13.5012 16.2777 13.4997 16.4112 13.4983C16.4965 13.498 16.5819 13.4979 16.6672 13.4978C16.7068 13.4972 16.7465 13.4967 16.7873 13.4961C17.0716 13.4979 17.2832 13.5523 17.5011 13.7403C17.6626 13.9424 17.7382 14.0788 17.7361 14.3427C17.7358 14.378 17.7356 14.4133 17.7354 14.4497C17.7351 14.4766 17.7348 14.5036 17.7345 14.5314C17.7818 14.5306 17.8291 14.5298 17.8778 14.5289C18.0538 14.5261 18.2299 14.5243 18.4059 14.5228C18.482 14.5221 18.5581 14.521 18.6341 14.5196C18.7437 14.5177 18.8533 14.5169 18.9629 14.5162C18.9967 14.5154 19.0305 14.5146 19.0653 14.5137C19.2786 14.5136 19.4044 14.541 19.5705 14.6877C19.7168 14.8589 19.7053 15.0352 19.7046 15.25C19.7048 15.2854 19.705 15.3208 19.7052 15.3572C19.7055 15.432 19.7054 15.5067 19.7051 15.5815C19.7047 15.6952 19.7059 15.8088 19.7071 15.9225C19.7072 15.9954 19.7071 16.0682 19.707 16.1411C19.7075 16.1747 19.7079 16.2084 19.7084 16.2431C19.7054 16.5066 19.6433 16.7242 19.4533 16.9142C19.4414 17.0084 19.4414 17.0084 19.4433 17.119C19.443 17.1617 19.4428 17.2045 19.4425 17.2486C19.4425 17.3183 19.4425 17.3183 19.4426 17.3894C19.4418 17.4874 19.441 17.5854 19.4402 17.6834C19.4393 17.8382 19.4386 17.993 19.4384 18.1479C19.438 18.2971 19.4367 18.4462 19.4353 18.5955C19.4355 18.6414 19.4357 18.6874 19.4359 18.7348C19.4322 19.0404 19.3955 19.2584 19.187 19.4947C19.1645 19.5124 19.142 19.5302 19.1188 19.5485C19.0962 19.567 19.0736 19.5855 19.0503 19.6045C18.9192 19.6924 18.8019 19.6928 18.649 19.6934C18.6035 19.6937 18.558 19.694 18.5112 19.6943C18.4613 19.6944 18.4114 19.6945 18.3599 19.6946C18.3069 19.6948 18.2538 19.6951 18.2007 19.6954C18.0264 19.6962 17.8521 19.6966 17.6778 19.697C17.6177 19.6971 17.5577 19.6973 17.4976 19.6975C17.2154 19.6982 16.9333 19.6988 16.6511 19.6991C16.3256 19.6995 16.0001 19.7005 15.6746 19.7021C15.4228 19.7033 15.1711 19.7038 14.9194 19.704C14.7691 19.7041 14.6188 19.7044 14.4685 19.7054C14.3271 19.7063 14.1856 19.7065 14.0442 19.7061C13.9678 19.706 13.8913 19.7068 13.8149 19.7076C13.5115 19.7058 13.3281 19.6781 13.0975 19.4718C12.9462 19.2788 12.881 19.1283 12.8814 18.8831C12.8813 18.8402 12.8811 18.7973 12.881 18.7531C12.8811 18.7071 12.8813 18.6611 12.8815 18.6138C12.8809 18.516 12.8802 18.4181 12.8796 18.3203C12.8789 18.1665 12.8786 18.0126 12.8788 17.8587C12.8789 17.71 12.8778 17.5613 12.8766 17.4126C12.877 17.3668 12.8774 17.3209 12.8778 17.2737C12.8744 16.9932 12.8415 16.8528 12.6564 16.6408C12.6213 16.5354 12.6119 16.4718 12.6104 16.3634C12.6099 16.3313 12.6094 16.2993 12.6089 16.2662C12.6086 16.2317 12.6083 16.1971 12.608 16.1615C12.6077 16.1258 12.6074 16.0901 12.6071 16.0534C12.6065 15.9778 12.6061 15.9023 12.6058 15.8267C12.6051 15.7115 12.6034 15.5963 12.6017 15.4811C12.6013 15.4076 12.601 15.3341 12.6007 15.2606C12.6 15.2263 12.5993 15.192 12.5986 15.1567C12.5994 14.9432 12.6241 14.8131 12.7736 14.6486C12.9679 14.5133 13.1448 14.5158 13.3726 14.52C13.407 14.5201 13.4413 14.5203 13.4767 14.5205C13.5858 14.5211 13.6948 14.5226 13.8039 14.5241C13.8781 14.5247 13.9523 14.5252 14.0265 14.5257C14.2078 14.527 14.3891 14.529 14.5705 14.5314C14.5698 14.5052 14.569 14.4789 14.5683 14.4518C14.5678 14.4171 14.5672 14.3823 14.5666 14.3465C14.5656 14.295 14.5656 14.295 14.5645 14.2425C14.5781 14.0113 14.693 13.8483 14.861 13.6965C15.0212 13.5634 15.1805 13.5063 15.3884 13.5045ZM15.2345 14.258C15.2345 14.3482 15.2345 14.4385 15.2345 14.5314C15.8404 14.5314 16.4462 14.5314 17.0705 14.5314C17.0705 14.4412 17.0705 14.351 17.0705 14.258C16.9772 14.1647 16.9575 14.17 16.8305 14.1698C16.7805 14.1694 16.7805 14.1694 16.7294 14.169C16.6753 14.1692 16.6753 14.1692 16.62 14.1695C16.583 14.1694 16.546 14.1693 16.5079 14.1693C16.4297 14.1692 16.3514 14.1694 16.2731 14.1697C16.153 14.1701 16.0329 14.1697 15.9128 14.1692C15.8368 14.1692 15.7609 14.1693 15.685 14.1695C15.6489 14.1693 15.6128 14.1692 15.5756 14.169C15.5422 14.1693 15.5089 14.1695 15.4745 14.1698C15.4303 14.1698 15.4303 14.1698 15.3853 14.1699C15.303 14.1737 15.303 14.1737 15.2345 14.258ZM13.2814 15.1955C13.2769 15.3589 13.273 15.522 13.2707 15.6854C13.2697 15.7409 13.2684 15.7965 13.2667 15.8519C13.2643 15.932 13.2632 16.0119 13.2623 16.0919C13.2613 16.14 13.2603 16.1881 13.2592 16.2376C13.2876 16.4036 13.3486 16.4572 13.4767 16.5627C13.9581 16.8936 14.773 17.0517 15.3517 16.9924C15.4322 16.9307 15.4322 16.9307 15.4884 16.8434C15.6077 16.6953 15.7071 16.5979 15.8986 16.5627C16.203 16.5307 16.4528 16.5209 16.7012 16.7153C16.7565 16.7658 16.7565 16.7658 16.8361 16.758C16.8751 16.8361 16.9142 16.9142 16.9533 16.9924C17.5883 16.9748 18.5203 16.9336 18.9845 16.4455C19.0612 16.2935 19.0719 16.1695 19.0703 16.0004C19.07 15.9534 19.0698 15.9065 19.0695 15.8581C19.0689 15.8094 19.0682 15.7608 19.0675 15.7106C19.0672 15.6612 19.0668 15.6118 19.0665 15.5609C19.0655 15.4391 19.0641 15.3173 19.0626 15.1955C18.7662 15.1955 18.4697 15.1955 18.1642 15.1955C18.161 15.293 18.1578 15.3905 18.1544 15.4909C18.142 15.7296 18.1272 15.9048 17.9689 16.0939C17.765 16.2469 17.585 16.2552 17.335 16.2565C17.2928 16.2568 17.2928 16.2568 17.2497 16.2571C17.1567 16.2576 17.0638 16.2579 16.9708 16.2581C16.906 16.2583 16.8412 16.2586 16.7764 16.2588C16.6406 16.2592 16.5047 16.2594 16.3689 16.2596C16.1952 16.2598 16.0216 16.2607 15.848 16.2618C15.7141 16.2626 15.5802 16.2628 15.4463 16.2628C15.3823 16.2629 15.3183 16.2632 15.2544 16.2638C15.1646 16.2644 15.0749 16.2644 14.9851 16.2641C14.9342 16.2642 14.8832 16.2644 14.8307 16.2645C14.5964 16.241 14.4104 16.1631 14.258 15.9767C14.1602 15.8289 14.1627 15.6698 14.1554 15.4982C14.1506 15.3983 14.1458 15.2984 14.1408 15.1955C13.8572 15.1955 13.5736 15.1955 13.2814 15.1955ZM14.8048 15.1955C14.8048 15.3373 14.8048 15.4791 14.8048 15.6252C15.6943 15.6252 16.5837 15.6252 17.5001 15.6252C17.5001 15.4834 17.5001 15.3416 17.5001 15.1955C16.6107 15.1955 15.7212 15.1955 14.8048 15.1955ZM15.9401 17.2536C15.8898 17.3631 15.8748 17.4203 15.8986 17.5392C15.9802 17.637 15.9802 17.637 16.0939 17.6955C16.207 17.6928 16.266 17.6716 16.36 17.61C16.4292 17.5045 16.4218 17.428 16.4064 17.3049C16.3698 17.226 16.3698 17.226 16.2892 17.1877C16.0986 17.1614 16.0986 17.1614 15.9401 17.2536ZM13.5548 17.3439C13.5539 17.5706 13.5532 17.7972 13.5527 18.0239C13.5525 18.101 13.5522 18.1782 13.5519 18.2553C13.5514 18.3661 13.5512 18.4768 13.551 18.5875C13.5507 18.6395 13.5507 18.6395 13.5504 18.6925C13.5449 18.8634 13.5449 18.8634 13.5939 19.0236C13.7107 19.0625 13.7876 19.0677 13.9095 19.0679C13.9505 19.0681 13.9915 19.0682 14.0338 19.0684C14.0788 19.0684 14.1238 19.0684 14.1701 19.0683C14.2412 19.0685 14.2412 19.0685 14.3137 19.0687C14.4438 19.0691 14.5738 19.0692 14.7038 19.0692C14.8123 19.0692 14.9209 19.0694 15.0294 19.0695C15.2854 19.0698 15.5415 19.0699 15.7975 19.0699C16.0617 19.0699 16.3258 19.0703 16.59 19.0709C16.8168 19.0714 17.0435 19.0716 17.2703 19.0716C17.4058 19.0716 17.5412 19.0717 17.6767 19.0721C17.8277 19.0726 17.9788 19.0724 18.1298 19.0722C18.1747 19.0724 18.2196 19.0726 18.2659 19.0728C18.307 19.0727 18.3482 19.0725 18.3905 19.0723C18.4262 19.0724 18.4619 19.0724 18.4987 19.0724C18.6086 19.0668 18.6086 19.0668 18.7501 18.9846C18.7501 18.4431 18.7501 17.9017 18.7501 17.3439C18.6261 17.3737 18.502 17.4035 18.3742 17.4343C18.1327 17.492 17.8952 17.5421 17.6479 17.5659C17.5898 17.5718 17.5898 17.5718 17.5306 17.5777C17.4563 17.5845 17.3818 17.5899 17.3072 17.5938C17.2043 17.6033 17.1253 17.6132 17.0314 17.6564C16.9711 17.743 16.9382 17.8222 16.9063 17.9225C16.8469 18.0855 16.7171 18.1634 16.5686 18.241C16.3189 18.3487 16.0715 18.3602 15.8131 18.2741C15.6602 18.2081 15.546 18.1294 15.4298 18.008C15.4115 17.9492 15.394 17.8901 15.3773 17.8308C15.3406 17.7343 15.3406 17.7343 15.2736 17.6564C15.1054 17.5912 14.9349 17.5803 14.756 17.5661C14.6622 17.5568 14.5684 17.5472 14.4746 17.5373C14.4038 17.5297 14.4038 17.5297 14.3314 17.5221C14.0675 17.484 13.8118 17.4142 13.5548 17.3439Z" fill="black"/>
                           <path d="M3.47668 1.52818C3.50327 1.5307 3.52986 1.53321 3.55725 1.53581C3.66808 1.57469 3.69393 1.6147 3.75012 1.71861C3.75165 1.83707 3.74702 1.94748 3.73715 2.06498C3.66442 2.78611 3.66442 2.78611 3.87875 3.44586C4.09979 3.63148 4.34954 3.7327 4.62017 3.82608C4.76779 3.88286 4.85397 3.94642 4.96106 4.06236C5.00244 4.18183 4.9817 4.24481 4.96106 4.37486C4.88185 4.49367 4.83191 4.52413 4.69403 4.55964C4.46735 4.57895 4.29308 4.44534 4.10168 4.3358C4.06748 4.31625 4.03329 4.29671 3.99805 4.27657C3.88176 4.20971 3.76582 4.14229 3.65002 4.07456C3.61188 4.05228 3.57373 4.02999 3.53444 4.00703C3.49841 3.98566 3.46238 3.96429 3.42526 3.94227C3.39285 3.9231 3.36045 3.90393 3.32706 3.88418C3.1969 3.79787 3.136 3.74344 3.08606 3.59361C3.08211 3.53532 3.08026 3.47688 3.07976 3.41846C3.07939 3.38312 3.07901 3.34778 3.07862 3.31138C3.07846 3.27329 3.07829 3.2352 3.07812 3.19596C3.0779 3.15671 3.07768 3.11745 3.07745 3.07701C3.07708 2.99394 3.07682 2.91086 3.07667 2.82779C3.07629 2.70082 3.07508 2.57387 3.07385 2.44691C3.07359 2.36619 3.07339 2.28547 3.07324 2.20475C3.07276 2.16682 3.07227 2.1289 3.07178 2.08982C3.07288 1.75565 3.07288 1.75565 3.20324 1.60142C3.32507 1.52021 3.34142 1.5123 3.47668 1.52818Z" fill="black"/>
                           <path d="M8.93799 9.22852C9.23716 9.29891 9.48262 9.63307 9.69467 9.84573C9.73809 9.88909 9.73809 9.88909 9.78238 9.93333C9.84292 9.99385 9.90342 10.0544 9.96387 10.115C10.0567 10.2081 10.1498 10.3009 10.2428 10.3938C10.3018 10.4528 10.3608 10.5118 10.4198 10.5708C10.4476 10.5986 10.4755 10.6264 10.5042 10.655C10.5426 10.6936 10.5426 10.6936 10.5817 10.7329C10.6043 10.7555 10.6269 10.7781 10.6501 10.8014C10.7263 10.8847 10.7417 10.9342 10.7568 11.0474C10.7422 11.1719 10.7422 11.1719 10.6616 11.2842C10.5469 11.3672 10.5469 11.3672 10.4175 11.3965C10.2688 11.3663 10.235 11.3453 10.1276 11.2478C10.1003 11.2229 10.0729 11.1981 10.0447 11.1725C9.91076 11.0466 9.77965 10.918 9.64981 10.7878C9.62173 10.7598 9.59366 10.7317 9.56473 10.7028C9.50602 10.6442 9.44737 10.5854 9.38876 10.5267C9.29874 10.4364 9.20852 10.3464 9.11827 10.2564C9.06106 10.1992 9.00387 10.1419 8.94669 10.0847C8.91967 10.0578 8.89266 10.0308 8.86482 10.0031C8.84003 9.97814 8.81523 9.95322 8.78968 9.92755C8.76781 9.90565 8.74594 9.88375 8.72341 9.86118C8.64105 9.7709 8.63227 9.72175 8.61816 9.59717C8.63281 9.45312 8.63281 9.45312 8.71582 9.33838C8.82812 9.25781 8.82812 9.25781 8.93799 9.22852Z" fill="black"/>
                           </g>
                           <defs>
                           <clipPath id="clip0_15_71871">
                           <rect width="20" height="20" fill="white"/>
                           </clipPath>
                           </defs>
                           </svg>` },
                                                      
                           { label: "Custom", icon: `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <g clip-path="url(#clip0_41755_1899)">
                           <path d="M15.8333 0H4.16667C1.86917 0 0 1.86917 0 4.16667V15.8333C0 18.1308 1.86917 20 4.16667 20H15.8333C18.1308 20 20 18.1308 20 15.8333V4.16667C20 1.86917 18.1308 0 15.8333 0ZM18.3333 15.8333C18.3333 17.2117 17.2117 18.3333 15.8333 18.3333H4.16667C2.78833 18.3333 1.66667 17.2117 1.66667 15.8333V4.16667C1.66667 2.78833 2.78833 1.66667 4.16667 1.66667H15.8333C17.2117 1.66667 18.3333 2.78833 18.3333 4.16667V15.8333ZM15.8333 6.66667C15.8333 7.1275 15.4608 7.5 15 7.5H8.33333V8.33333C8.33333 8.79417 7.96083 9.16667 7.5 9.16667C7.03917 9.16667 6.66667 8.79417 6.66667 8.33333V7.5H5C4.53917 7.5 4.16667 7.1275 4.16667 6.66667C4.16667 6.20583 4.53917 5.83333 5 5.83333H6.66667V5C6.66667 4.53917 7.03917 4.16667 7.5 4.16667C7.96083 4.16667 8.33333 4.53917 8.33333 5V5.83333H15C15.4608 5.83333 15.8333 6.20583 15.8333 6.66667ZM15.8333 13.3333C15.8333 13.7942 15.4608 14.1667 15 14.1667H13.3333V15C13.3333 15.4608 12.9608 15.8333 12.5 15.8333C12.0392 15.8333 11.6667 15.4608 11.6667 15V14.1667H5C4.53917 14.1667 4.16667 13.7942 4.16667 13.3333C4.16667 12.8725 4.53917 12.5 5 12.5H11.6667V11.6667C11.6667 11.2058 12.0392 10.8333 12.5 10.8333C12.9608 10.8333 13.3333 11.2058 13.3333 11.6667V12.5H15C15.4608 12.5 15.8333 12.8725 15.8333 13.3333Z" fill="black"/>
                           </g>
                           <defs>
                           <clipPath id="clip0_41755_1899">
                           <rect width="20" height="20" fill="white"/>
                           </clipPath>
                           </defs>
                           </svg>` }
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
                                 today.setHours(0, 0, 0, 0);

                                 const cellDate = new Date(date);
                                 cellDate.setHours(0, 0, 0, 0);
                                 const dayOfWeek = cellDate.getDay(); // 0=Sunday, 6=Saturday

                                 // 🔴 Public Holiday check
                                 const dateStr = `${year}-${(month + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;
                                 const isPublicHoliday = publicHolidays.some(h => h.date === dateStr);
                                 if (isPublicHoliday) {
                                    applyTag(cell, "PH", "#dc3545"); // red color tag
                                    // cell.classList.add("disabled");
                                    // cell.style.pointerEvents = 'none';
                                 }

                                 
                                 if (!isPublicHoliday && cellDate < today && dayOfWeek !== 0 && dayOfWeek !== 6) {
                                    applyTag(cell, "8", "#000000"); 
                                 }

                                 //if (dayOfWeek === 0 || dayOfWeek === 6 || !calendarEditable) {

                                  if (dayOfWeek === 0 || dayOfWeek === 6 ) {
                                 // if (dayOfWeek === 0 || dayOfWeek === 6  ) {
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
                                 $leaveLabel = $record['leaveType'] ?? null;
                                 $workingLabel = $record['workingHours'] ?? null;
                                 if ($leaveLabel) {
                                    $label = \Illuminate\Support\Str::startsWith($leaveLabel, 'Custom')
                                    ? trim(Str::replaceFirst('Custom', '', $leaveLabel))
                                    : $leaveLabel;
                                 } else {
                                    $label = $workingLabel;
                                 }
                                 $rangeDate = $record['date'] ?? '';
                                 @endphp

                                 @php $rangeParts = explode(' to ', $rangeDate); @endphp

                                 @if (count($rangeParts) === 2 && $label)
                                    @php
                                    try {
                                          $start = \Carbon\Carbon::createFromFormat('d / m / Y', trim($rangeParts[0]));
                                          $end = \Carbon\Carbon::createFromFormat('d / m / Y', trim($rangeParts[1]));
                                          $first = \Carbon\Carbon::createFromFormat('d / m / Y', trim($rangeParts[0]));

                                          while ($start->lte($end)) {
                                             $isWeekend = in_array($start->dayOfWeek, [\Carbon\Carbon::SATURDAY, \Carbon\Carbon::SUNDAY]);
                                             $isPH = in_array(
                                                $start->format('Y-m-d'),
                                                array_column(($publicHolidays ?? collect())->toArray(), 'date')
                                             );


                                             if ($label === 'ML' && ($isPH || $isWeekend)) {
                                                // Skip this ML entry on public holiday or weekend
                                                $start->addDay();
                                                continue;
                                             }

                                             $monthYear = ($start->month - 1) . '-' . $start->year;
                                             $index = $start->day;
                                             $clickable = $start->equalTo($first);
                                             $labelMain = $label;
                                             $labelSub = '';

                                             if (isset($record['leaveHour'])) {
                                                if (\Illuminate\Support\Str::contains($record['leaveHour'], 'HD1')) {
                                                   $labelSub = 'HD1';
                                                } elseif (\Illuminate\Support\Str::contains($record['leaveHour'], 'HD2')) {
                                                   $labelSub = 'HD2';
                                                }
                                                elseif (\Illuminate\Support\Str::contains($record['leaveHour'], 'Custom')) {
                                                   $labelSub = 'Custom';
                                                }
                                                
                                             }

                                             $combinedLabel = $labelMain;
                                             if ($labelSub) {
                                                $combinedLabel .= '<sup style="font-size:10px;">' . $labelSub . '</sup>';
                                             }

                                             $labelJson = json_encode($combinedLabel);


                                             echo "if (!tagRules[\"$monthYear\"]) tagRules[\"$monthYear\"] = [];\n";
                                             echo "tagRules[\"$monthYear\"].push({ index: $index, label: $labelJson, clickable: " . ($clickable ? 'true' : 'false') . " });\n";

                                             $start->addDay();
                                          }

                                    } catch (\Exception $e) {}
                                    @endphp

                                 @elseif ($applyDate && $label)
                                    @php
                                    try {
                                          $dt = \Carbon\Carbon::createFromFormat('d / m / Y', $applyDate);
                                          $monthYear = ($dt->month - 1) . '-' . $dt->year;
                                          $index = $dt->day;
                                          $labelMain = $label;
                                          $labelSub = '';

                                          if (isset($record['leaveHour'])) {
                                             if (\Illuminate\Support\Str::contains($record['leaveHour'], 'HD1')) {
                                                $labelSub = 'HD1';
                                             } elseif (\Illuminate\Support\Str::contains($record['leaveHour'], 'HD2')) {
                                                $labelSub = 'HD2';
                                             } elseif (\Illuminate\Support\Str::contains($record['leaveHour'], 'Custom')) {
                                                   $labelSub = 'Custom';
                                             }
                                          }

                                          $combinedLabel = $labelMain;
                                          if ($labelSub) {
                                             $combinedLabel .= '<sup style="font-size:10px;">' . $labelSub . '</sup>';
                                          }

                                          $labelJson = json_encode($combinedLabel);


                                          echo "if (!tagRules[\"$monthYear\"]) tagRules[\"$monthYear\"] = [];\n";
                                          echo "tagRules[\"$monthYear\"].push({ index: $index, label: $labelJson, clickable: true });\n";
                                    } catch (\Exception $e) {}
                                    @endphp
                                 @endif
                                 @endforeach

                                 const currentKey = `${month}-${year}`;
                                 if (tagRules[currentKey]) {
                                    tagRules[currentKey].forEach((rule) => {
                                          if (i === rule.index) {
                                             applyTag(cell, rule.label, "#007bff");
                                             if (!rule.clickable) {
                                                cell.classList.add("disabled");
                                             }
                                          }
                                    });
                                 }

                                 calendarDays.appendChild(cell);
                              }

                              const totalFilled = firstDay + daysInMonth;
                              const extraCells = totalFilled % 7 === 0 ? 0 : 7 - (totalFilled % 7);

                              for (let i = 0; i < extraCells; i++) {
                                 const trailingCell = document.createElement("div");
                                 trailingCell.classList.add("calendar-cell", "disabled");
                                 calendarDays.appendChild(trailingCell);
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
                                           opt.innerHTML = `<span style="">${item.icon}</span>${item.label}`;
                                           opt.onclick = () => {
                                               //console.log("check item",item.label);
                                               const formattedDate = new Date(date);
                                               const day = String(formattedDate.getDate()).padStart(2, "0");
                                               const month = String(formattedDate.getMonth() + 1).padStart(2, "0"); // 0-based index
                                               const year = formattedDate.getFullYear();
                                               const finalDate = `${day} / ${month} / ${year}`;
                                               
                                               if (item.label === "ML") {
                                                   const modalElement = document.getElementById("medicalLeave");
                                                   const rangeInput = modalElement.querySelectorAll(".range-input input");
                                                   const dateDisplay = document.getElementById("medicalLeaveDateDisplay");
                                                   const range = document.querySelector("#medicalLeave").querySelector(".range-selected");
                           
                                                   dateDisplay.innerText = finalDate;
                                                   window.lastClickedCell = cell;
                                                   window.lastClickedItemLabel = item.label;
                           
                                                   // Clear previous editing record
                                                   window.editingRecord = null;
                           
                                                   const allData = @json($dataTimesheet); // Injected Laravel data into JS
                                                   const matchRecord = allData.find(entry => {
                                                       const record = JSON.parse(entry.record || '{}');
                                                       return record.applyOnCell === finalDate && record.leaveType === 'ML';
                                                   });
                           
                                                   if (matchRecord) {
                                                       window.editingRecord = JSON.parse(matchRecord.record);
                                                   }
                           
                                                   const modal = new bootstrap.Modal(modalElement);
                                                   modal.show();
                                                   //console.log(dateDisplay.innerText);
                           
                                                   // ✅ Enable/Disable range based on date format
                                                   if (dateDisplay.innerText.includes("to")) {
                                                       // Multi date selected -> Disable range
                                                       rangeInput.forEach(input => input.disabled = true);
                                                   } else {
                                                       // Single date selected -> Enable range
                                                       rangeInput.forEach(input => input.disabled = false);
                                                       range.style.backgroundColor = "#037EFF";
                                                   }
                                               }
                           
                                               if (["Custom"].includes(item.label)) {
                                                const modalElement = document.getElementById("customLeave");
                                                const rangeInput = modalElement.querySelectorAll(".range-input input");
                                                const dateDisplay = document.getElementById("customLeaveDisplay");
                                                const range = modalElement.querySelector(".range-selected");

                                                dateDisplay.innerText = finalDate;
                                                window.lastClickedCell = cell;
                                                window.lastClickedItemLabel = item.label;
                                                window.editingRecord = null;

                                                // Laravel-injected dataTimesheet
                                                const allData = @json($dataTimesheet);
                                                const matchRecord = allData.find(entry => {
                                                   const record = JSON.parse(entry.record || '{}');
                                                   return record.applyOnCell === finalDate && typeof record.leaveType === "string" && record.leaveType.startsWith('Custom');
                                                });

                                                if (matchRecord) {
                                                   window.editingRecord = JSON.parse(matchRecord.record);
                                                }

                                                // 👉 Update leave type tab selection and hidden input
                                                const leaveTypeLinks = modalElement.querySelectorAll(".leave_type_options a");
                                                const selectedTypeInput = modalElement.querySelector("#selectedLeaveType");

                                                leaveTypeLinks.forEach(link => {
                                                   link.classList.remove("active");

                                                   if (link.getAttribute("data-type") === item.label) {
                                                         link.classList.add("active");
                                                         if (selectedTypeInput) {
                                                            selectedTypeInput.value = item.label;
                                                         }
                                                   }
                                                });

                                                // Show the modal
                                                const modal = new bootstrap.Modal(modalElement);
                                                modal.show();

                                                // Enable/Disable slider
                                                if (dateDisplay.innerText.includes("to")) {
                                                   rangeInput.forEach(input => input.disabled = true);
                                                } else {
                                                   rangeInput.forEach(input => input.disabled = false);
                                                   range.style.backgroundColor = "#037EFF";
                                                }
                                             }

                                            if (["AL", "PDO"].includes(item.label)) {
                                             const formattedDate = `${String(date.getDate()).padStart(2, '0')} / ${String(date.getMonth() + 1).padStart(2, '0')} / ${date.getFullYear()}`;

                                             const recordData = {
                                                date: formattedDate,
                                                applyOnCell: formattedDate,
                                                leaveType: item.label,
                                                leaveHour: "Full Day",
                                                leaveHourId: "fullDay",
                                                remarks: ""
                                             };

                                             const formData = new FormData();
                                             formData.append("type", "timesheet");
                                             formData.append("user_id", "{{ $userData['id'] ?? '' }}");
                                             formData.append("client_id", "{{ $consultant->client_id ?? '' }}");
                                             formData.append("client_name", "{{ $consultant->client_name ?? '' }}");
                                             formData.append("record", JSON.stringify(recordData));
                                              formData.append('status', "Draft");

                                             fetch("{{ route('consultant.data.save') }}", {
                                                method: "POST",
                                                headers: {
                                                      "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').getAttribute("content")
                                                },
                                                body: formData
                                             })
                                             .then(res => {
                                                if (!res.ok) throw new Error("Server error");
                                                return res.json();
                                             })
                                             .then(data => {
                                                console.log("Saved:", data);
                                                location.reload();
                                             })
                                             .catch(error => {
                                                console.error("Failed to save:", error);
                                                alert("Failed to submit leave.");
                                             });
                                          }


                                         if (["PH"].includes(item.label)) {
                                             const formattedDate = `${String(date.getDate()).padStart(2, '0')} / ${String(date.getMonth() + 1).padStart(2, '0')} / ${date.getFullYear()}`;

                                             const overlay = document.createElement("div");
                                             overlay.style.position = "fixed";
                                             overlay.style.top = "0";
                                             overlay.style.left = "0";
                                             overlay.style.width = "100vw";
                                             overlay.style.height = "100vh";
                                             overlay.style.backgroundColor = "rgba(0,0,0,0.4)";
                                             overlay.style.display = "flex";
                                             overlay.style.justifyContent = "center";
                                             overlay.style.alignItems = "center";
                                             overlay.style.zIndex = "9999";

                                             const popup = document.createElement("div");
                                             popup.style.background = "#fff";
                                             popup.style.padding = "25px 30px";
                                             popup.style.borderRadius = "12px";
                                             popup.style.boxShadow = "0 4px 20px rgba(0,0,0,0.25)";
                                             popup.style.width = "400px";
                                             popup.style.maxWidth = "95%";

                                             popup.innerHTML = `
                                                <div style="font-size: 20px; font-weight: 700; margin-bottom: 16px;">
                                                   Enter Remark for <span style="color:#dc3545;">PH</span>
                                                </div>
                                                <textarea id="phPopupRemark" placeholder="Type your remark..." rows="4"
                                                   style="
                                                      width: 100%;
                                                      padding: 12px 14px;
                                                      border: 2px solid #ced4da;
                                                      border-radius: 8px;
                                                      font-size: 15px;
                                                      resize: none;
                                                      outline: none;
                                                      transition: border-color 0.2s;
                                                   "></textarea>
                                                <div id="phPopupError" style="color: red; font-size: 13px; margin-top: 6px; display: none;">
                                                   Remark is required.
                                                </div>
                                                <div style="margin-top: 20px; text-align: right;">
                                                   <button id="phSubmitBtn" style="
                                                      background-color: #28a745;
                                                      color: white;
                                                      border: none;
                                                      padding: 8px 20px;
                                                      border-radius: 6px;
                                                      font-size: 14px;
                                                      margin-right: 10px;
                                                      cursor: pointer;
                                                   ">Submit</button>
                                                   <button id="phCancelBtn" style="
                                                      background-color: #6c757d;
                                                      color: white;
                                                      border: none;
                                                      padding: 8px 20px;
                                                      border-radius: 6px;
                                                      font-size: 14px;
                                                      cursor: pointer;
                                                   ">Cancel</button>
                                                </div>
                                             `;

                                             overlay.appendChild(popup);
                                             document.body.appendChild(overlay);

                                             // Hide placeholder on focus
                                             const remarkInput = popup.querySelector("#phPopupRemark");
                                             remarkInput.addEventListener("focus", () => {
                                                remarkInput.placeholder = "";
                                             });
                                             remarkInput.addEventListener("blur", () => {
                                                if (!remarkInput.value.trim()) {
                                                   remarkInput.placeholder = "Type your remark...";
                                                }
                                             });

                                             document.getElementById("phSubmitBtn").onclick = function () {
                                                const remarkVal = remarkInput.value.trim();
                                                const errorDiv = document.getElementById("phPopupError");

                                                if (!remarkVal) {
                                                   errorDiv.style.display = "block";
                                                   return;
                                                }

                                                errorDiv.style.display = "none";

                                                const recordData = {
                                                   date: formattedDate,
                                                   applyOnCell: formattedDate,
                                                   leaveType: "PH",
                                                   leaveHour: "Full Day",
                                                   leaveHourId: "fullDay",
                                                   remarks: remarkVal
                                                };

                                                const formData = new FormData();
                                                formData.append("type", "timesheet");
                                                formData.append("user_id", "{{ $userData['id'] ?? '' }}");
                                                formData.append("client_id", "{{ $consultant->client_id ?? '' }}");
                                                formData.append("client_name", "{{ $consultant->client_name ?? '' }}");
                                                formData.append("record", JSON.stringify(recordData));
                                                formData.append('status', "Draft");

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
                                                // document.body.removeChild(overlay);
                                                   location.reload();
                                                })
                                                .catch(err => {
                                                   alert("Failed to save: " + err.message);
                                                });
                                             };

                                             document.getElementById("phCancelBtn").onclick = function () {
                                                document.body.removeChild(overlay);
                                             };

                                             return;
                                          }
                          
                                               
                                               dropdown.remove();
                                           };
                                           suggestionBox.appendChild(opt);
                                       });
                               }
                           
                               input.addEventListener("input", () => updateSuggestions(input.value));
                               let alertShown = false; // define globally if not already

                              function saveWorkingHour(val) {
                                 val = val.trim();
                                 const hourVal = parseInt(val, 10);

                                    const today = new Date(); // today
                                    const selectedDate = new Date(date); // 'date' is assumed to be defined earlier in scope
                                    selectedDate.setHours(0, 0, 0, 0); // ignore time part
                                    today.setHours(0, 0, 0, 0);

                                 // Invalid input or above 24
                               if (isNaN(hourVal) || hourVal > 24 || hourVal < 0 || selectedDate > today) {
                                    if (!alertShown) {
                                       let message = '';

                                       if (isNaN(hourVal) || hourVal > 24 || hourVal < 0) {
                                          message = 'Only numbers 0 to 24 are allowed for working hours.';
                                       } else if (selectedDate > today) {
                                          message = 'Working hours cannot be added for a future date.';
                                       }

                                       alert(message);
                                       alertShown = true;
                                    }

                                    location.reload();
                                    return false;
                                 }


                                 // Valid, reset alert
                                 alertShown = false;

                                 // If between 9 to 24 → Show modal only
                                 if (hourVal >= 9 && hourVal <= 24) {
                                    const formattedDate = `${String(date.getDate()).padStart(2, '0')} / ${String(date.getMonth() + 1).padStart(2, '0')} / ${date.getFullYear()}`;
                                    const modalElement = document.getElementById("extralogmodal");

                                    document.getElementById("extralogDisplay").innerText = formattedDate;
                                    document.getElementById("dateRange").value = formattedDate;
                                    document.getElementById("show_extra_hours").innerText = hourVal - 8;
                                     document.getElementById("show_total_hours").innerText = hourVal;
                                     document.getElementById("logHourSlot").innerText = hourVal;

                                    modalElement.setAttribute("data-date", formattedDate);
                                    modalElement.setAttribute("data-full-hour", hourVal); // ✅ Pass full hour

                                    const modal = new bootstrap.Modal(modalElement);
                                    modal.show();

                                    return false;
                                 }

                                 // If between 0 to 8 → Save via AJAX
                                 const formattedDate = `${String(date.getDate()).padStart(2, '0')} / ${String(date.getMonth() + 1).padStart(2, '0')} / ${date.getFullYear()}`;

                                 const recordData = {
                                    date: '',
                                    workingHours: val,
                                    applyOnCell: formattedDate
                                 };

                                 const formData = new FormData();
                                 formData.append("type", "timesheet");
                                 formData.append("user_id", "{{ $userData['id'] ?? '' }}");
                                 formData.append("client_id", "{{ $consultant->client_id ?? '' }}");
                                 formData.append("client_name", "{{ $consultant->client_name ?? '' }}");
                                 formData.append("record", JSON.stringify(recordData));
                                 formData.append('status', "Draft");

                                 fetch("{{ route('consultant.data.save') }}", {
                                    method: "POST",
                                    headers: {
                                          "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').getAttribute("content")
                                    },
                                    body: formData
                                 })
                                 .then(res => {
                                    if (!res.ok) throw new Error("Server error");
                                    return res.json();
                                 })
                                 .then(data => {
                                    console.log("Saved:", data);
                                    location.reload();
                                 })
                                 .catch(error => {
                                    console.error("Failed to save:", error);
                                    alert("Failed to save working hours.");
                                 });
                              }



                           
                              // ✅ Save on Enter key
                              input.addEventListener("keydown", (e) => {
                                 if (e.key === "Enter") {
                                    saveWorkingHour(input.value);
                                 }
                              });
                           
                              // ✅ Save on input blur (user clicks outside)
                              input.addEventListener("blur", () => {
                                 if (input.value.trim() !== "") {
                                    saveWorkingHour(input.value);
                                 }
                              });
                           
                              // ✅ Render suggestions (clickable)
                              dropdownSuggestions.forEach((item) => {
                                 const opt = document.createElement("div");
                                 opt.innerHTML = `<span style="">${item.icon}</span>${item.label}`;
                                 opt.onclick = () => {
                                    saveWorkingHour(item.label);
                                 };
                                 suggestionBox.appendChild(opt);
                              });
                           
                           
                           
                               dropdown.appendChild(input);
                               dropdown.appendChild(suggestionBox);
                               cell.appendChild(dropdown);
                               input.focus();
                               updateSuggestions("");
                           }
                           
                           function applyTag(cell, label, color = "#000000") { // Default fallback black
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
                            tag.innerHTML = label;
                           
                            // Style the tag
                            tag.style.fontSize = "13px";
                            tag.style.margin = "0";
                            tag.style.padding = "0";
                            tag.style.lineHeight = "1";
                           
                            // Set color logic
                            if (["PDO", "PH", "AL", "ML"].includes(label)) {
                                tag.style.color = "blue";
                            } else if (!isNaN(label)) {
                                const num = parseInt(label);
                                if (num >= 1 && num <= 5) {
                                    tag.style.color = "red"; 
                                } else if (num >= 6 && num <= 7) {
                                    tag.style.color = "red"; // ✅ 6-7 → Orange
                                } else if (num == 8) {
                                    tag.style.color = "black"; // ✅ 8 or more → Black
                                }else if (num > 9) {
                                    tag.style.color = "red"; // ✅ 8 or more → Black
                                } else {
                                    tag.style.color = color; // fallback
                                }
                            } else {
                                tag.style.color = color; // fallback if label is not a number
                            }
                           
                            // Append the tag
                            cell.appendChild(tag);
                           }
                           
                           
                           
                           function closeAllDropdowns() {
                               document.querySelectorAll(".dropdown").forEach((d) => d.remove());
                           }

                           const monthNames = [
               "January", "February", "March", "April", "May", "June",
               "July", "August", "September", "October", "November", "December"
            ];

            //const currentDate = new Date();

            function populateDropdowns() {
               const monthSelect = document.getElementById("monthSelect");
               const yearSelect = document.getElementById("yearSelect");

               // Months
               monthSelect.innerHTML = monthNames
                  .map((m, i) => `<option value="${i}">${m}</option>`)
                  .join("");
               monthSelect.value = currentDate.getMonth();

               // Years
               const thisYear = new Date().getFullYear();
               let options = "";
               for (let y = 2007; y <= thisYear + 5; y++) {
                  options += `<option value="${y}">${y}</option>`;
               }
               yearSelect.innerHTML = options;
               yearSelect.value = currentDate.getFullYear();

               updateMonthYearLabel();
            }

            function toggleMonthYearMenu() {
               const dropdown = document.getElementById("monthYearDropdown");
               const trigger = document.querySelector(".month-year-picker");

               const isOpening = dropdown.classList.contains("dropdown-hidden");
               dropdown.classList.toggle("dropdown-hidden");
               if (!isOpening) return;

               dropdown.innerHTML = "";

               // Inject styles once
               if (!document.getElementById("monthYearStyles")) {
                  const style = document.createElement("style");
                  style.id = "monthYearStyles";
                  style.textContent = `
                     #monthYearDropdown {
                        width: 260px !important;
                        background: #fff !important;
                        border-radius: 12px !important;
                        padding: 16px !important;
                        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
                        font-family: 'Segoe UI', sans-serif !important;
                        z-index: 1000 !important;
                        position: absolute !important;
                     }

                     #monthYearDropdown > div:first-child {
                        display: flex !important;
                        justify-content: center !important;
                        align-items: center !important;
                        gap: 20px !important;
                        font-weight: 600 !important;
                        font-size: 18px !important;
                        color: #1976d2 !important;
                        margin-bottom: 18px !important;
                     }

                     #monthYearDropdown > div:first-child span {
                        cursor: pointer !important;
                        font-size: 22px !important;
                        user-select: none !important;
                        color: #1976d2 !important;
                     }

                     #monthYearDropdown > div:last-child {
                        display: grid !important;
                        grid-template-columns: repeat(3, 1fr) !important;
                        gap: 10px !important;
                     }

                     #monthYearDropdown > div:last-child button {
                        padding: 10px 0 !important;
                        border: none !important;
                        border-radius: 12px !important;
                        background-color: #f0f0f0 !important;
                        font-weight: 600 !important;
                        color: #444 !important;
                        cursor: pointer !important;
                        font-size: 14px !important;
                        transition: all 0.2s ease !important;
                     }

                     #monthYearDropdown > div:last-child button:hover {
                        background-color: #e0e0e0 !important;
                     }

                     #monthYearDropdown > div:last-child button[data-selected="true"] {
                        background-color: #1976d2 !important;
                        color: white !important;
                     }
                  `;
                  document.head.appendChild(style);
               }

               // Create hidden selects if missing
               let monthSelect = document.getElementById("monthSelect");
               if (!monthSelect) {
                  monthSelect = document.createElement("select");
                  monthSelect.id = "monthSelect";
                  monthSelect.style.display = "none";
                  for (let i = 0; i < 12; i++) {
                     const opt = document.createElement("option");
                     opt.value = i;
                     opt.textContent = i;
                     monthSelect.appendChild(opt);
                  }
                  document.body.appendChild(monthSelect);
               }

               let yearSelect = document.getElementById("yearSelect");
               if (!yearSelect) {
                  yearSelect = document.createElement("select");
                  yearSelect.id = "yearSelect";
                  yearSelect.style.display = "none";
                  for (let y = 2000; y <= 2100; y++) {
                     const opt = document.createElement("option");
                     opt.value = y;
                     opt.textContent = y;
                     yearSelect.appendChild(opt);
                  }
                  document.body.appendChild(yearSelect);
               }

               // Get selected values from localStorage (actual visible month/year)
               const selectedMonth = parseInt(localStorage.getItem("timesheetMonth") ?? new Date().getMonth());
               const selectedYear = parseInt(localStorage.getItem("timesheetYear") ?? new Date().getFullYear());
               let currentYear = selectedYear;

               // === Year header ===
               const yearHeader = document.createElement("div");

               const prevBtn = document.createElement("span");
               prevBtn.innerHTML = "&#10094;";
               prevBtn.onclick = () => {
                  currentYear--;
                  yearText.textContent = currentYear;
               };

               const nextBtn = document.createElement("span");
               nextBtn.innerHTML = "&#10095;";
               nextBtn.onclick = () => {
                  currentYear++;
                  yearText.textContent = currentYear;
               };

               const yearText = document.createElement("span");
               yearText.textContent = currentYear;

               yearHeader.appendChild(prevBtn);
               yearHeader.appendChild(yearText);
               yearHeader.appendChild(nextBtn);
               dropdown.appendChild(yearHeader);

               // === Month grid ===
               const monthGrid = document.createElement("div");
               const monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];

               monthNames.forEach((name, index) => {
                  const btn = document.createElement("button");
                  btn.textContent = name;

                  // ✅ selected state from localStorage values
                  if (index === selectedMonth && currentYear === selectedYear) {
                     btn.setAttribute("data-selected", "true");
                  }

                  btn.onclick = () => {
                     monthSelect.value = index;
                     yearSelect.value = currentYear;

                     // ✅ Save values to localStorage
                     localStorage.setItem("timesheetMonth", index);
                     localStorage.setItem("timesheetYear", currentYear);

                     // ✅ Trigger full update
                     if (typeof onMonthYearChange === "function") {
                        onMonthYearChange();
                     }

                     dropdown.classList.add("dropdown-hidden");
                     document.removeEventListener("click", outsideClickHandler);
                  };

                  monthGrid.appendChild(btn);
               });

               dropdown.appendChild(monthGrid);

               // Outside click handler
               const outsideClickHandler = (e) => {
                  if (!dropdown.contains(e.target) && !trigger.contains(e.target)) {
                     dropdown.classList.add("dropdown-hidden");
                     document.removeEventListener("click", outsideClickHandler);
                  }
               };

               setTimeout(() => {
                  document.addEventListener("click", outsideClickHandler);
               }, 0);
            }

            function onMonthYearChange() {
               document.getElementById("monthYearDropdown").classList.add("dropdown-hidden");
               const month = parseInt(document.getElementById("monthSelect").value);
               const year = parseInt(document.getElementById("yearSelect").value);

               currentDate.setMonth(month);
               currentDate.setFullYear(year);

               localStorage.setItem("timesheetMonth", month);
               localStorage.setItem("timesheetYear", year);

               updateMonthYearLabel();
               // renderCalendar(); // ← Call your existing render function
               // fetchStatus();
               location.reload();
            }

            function updateMonthYearLabel() {
               const label = document.getElementById("monthYearLabel");
               label.textContent = `${monthNames[currentDate.getMonth()]} - ${currentDate.getFullYear()}`;
            }

                           document.getElementById("monthSelect").addEventListener("change", function () {
                              localStorage.setItem("timesheetMonth", this.value);
                              localStorage.setItem("timesheetYear", document.getElementById("yearSelect").value);
                              fetchStatus();
                              renderCalendar(); // optional if needed
                           });

                           document.getElementById("yearSelect").addEventListener("change", function () {
                              localStorage.setItem("timesheetYear", this.value);
                              localStorage.setItem("timesheetMonth", document.getElementById("monthSelect").value);
                              fetchStatus();
                              renderCalendar(); // optional if needed
                           });


                           
                           document.addEventListener("click", function (e) {
                               if (!e.target.closest(".calendar-cell")) closeAllDropdowns();
                           });
                           
                           populateMonthYearSelectors();
                           renderCalendar();
                           function saveCalendarData(statusValue = 'Submitted') {
                              const cells = document.querySelectorAll(".calendar-cell");
                              const promises = [];
                              let hasData = false; // ← to check if there's anything to save

                              cells.forEach(cell => {
                                 const dateElement = cell.querySelector(".cell-date");
                                 const tagElement = cell.querySelector(".tag");

                                 if (dateElement && tagElement) {
                                       hasData = true; // ✔️ At least one cell has data

                                       const day = dateElement.innerText.trim();
                                       const month = monthSelect.value; // 0-based
                                       const year = yearSelect.value;

                                       const formattedDate = `${day.padStart(2, '0')} / ${(parseInt(month) + 1).toString().padStart(2, '0')} / ${year}`;
                                       const label = tagElement.innerText.trim();
                                       if (label.startsWith("ML") || label.startsWith("Custom")|| label.startsWith("AL")|| label.startsWith("COMP-OFF")|| label.startsWith("PDO")|| label.startsWith("UL") ||  (!isNaN(label) && parseFloat(label) > 8)) return;

                                       const recordData = {};

                                       if (["PH"].includes(label)) {
                                          recordData.date = '';
                                          recordData.leaveType = label;
                                          recordData.applyOnCell = formattedDate;
                                       } else {
                                          recordData.date = '';
                                          recordData.workingHours = label;
                                          recordData.applyOnCell = formattedDate;
                                       }

                                       const formData = new FormData();
                                       formData.append('type', 'timesheet');
                                       formData.append('record', JSON.stringify(recordData));
                                       formData.append('user_id', "{{ $userData['id'] ?? '' }}");
                                       formData.append('client_id', "{{ $consultant->client_id ?? '' }}");
                                       formData.append('client_name', "{{ $consultant->client_name ?? '' }}");
                                       formData.append('status', statusValue);

                                       const promise = fetch("{{ route('consultant.data.save') }}", {
                                          method: "POST",
                                          headers: {
                                             "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                                          },
                                          body: formData
                                       })
                                       .then(response => {
                                          if (!response.ok) throw new Error('Server error');
                                          return response.json();
                                       });

                                       promises.push(promise);
                                 }
                              });

                              
                              if (!hasData) {
                                 Swal.fire("No Data!", "Does not have data for this month", "info");
                                 return;
                              }

                              // ✅ Proceed to submit if data found
                              Promise.all(promises)
                                 .then(results => {
                                       Swal.close(); // ✅ Hide loader
                                       if (statusValue === 'Submitted') {
                                          Swal.fire("Submitted!", "All details submitted successfully!", "success").then(() => location.reload());
                                       } else {
                                          Swal.fire("Saved!", "All details saved as Draft!", "success").then(() => location.reload());
                                       }
                                 })
                                 .catch(error => {
                                       console.error("Error saving records:", error);
                                       alert("Failed to save some records.");
                                 });
                           }

                           
                           // 🔵 Submit button (Submitted status)
                           document.getElementById("submit_icon").addEventListener("click", function (e) {
                               e.preventDefault();
                               saveCalendarData('Submitted');
                           });
                           
                           // 🟠 Save button (Draft status or Submitted as per your wish)
                           document.getElementById("save_icon").addEventListener("click", function (e) {
                              e.preventDefault();
                              saveCalendarData('Draft'); // 👉 If you want save to keep editable, use 'Draft' here
                           });

                           document.getElementById("edit_icon").addEventListener("click", function (e) {
                              e.preventDefault();

                              // 🌀 Show loader
                              Swal.fire({
                                 title: 'Please wait...',
                                 text: 'Enabling edit mode',
                                 allowOutsideClick: false,
                                 didOpen: () => {
                                    Swal.showLoading();
                                 }
                              });

                              // ✅ Wait 2 seconds, then enable editing
                              setTimeout(() => {
                                 calendarEditable = true;
                                 renderCalendar();
                                 Swal.close(); // ❌ Close loader
                              }, 1500);
                           });

                           document.getElementById("save_icon").addEventListener("click", function (e) {
                              e.preventDefault();
                              calendarEditable = false;
                              renderCalendar();
                           });
                           
                           
                           
                        </script>
                     </div>
                  </div>
               </div>
            </div>

            


           <div class="col-xl-4 col-lg-3">
               <div class="timesheet-overview-consultant">
                  <div class="timeline-container">
                     <div class="timeline-title">
                        <i class="fa-solid fa-caret-down"></i> {{ $consultant->client_name ?? 'N/A' }}
                     </div>

                     @php
                        use Carbon\Carbon;

                        $monthGroups = [];

                        foreach ($dataTimesheet as $item) {
                           $record = json_decode($item->record ?? '{}', true);
                           if (!isset($record['applyOnCell'])) continue;

                           $parts = explode(' / ', $record['applyOnCell']);
                           if (count($parts) !== 3) continue;

                           [$day, $month, $year] = $parts;
                           $key = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
                           $monthGroups[$key][] = strtolower(trim($item->status));
                        }

                        $monthlyStatus = [];
                        foreach ($monthGroups as $monthKey => $statuses) {
                           if (in_array('draft', $statuses)) {
                              $monthlyStatus[$monthKey] = 'Draft';
                           } elseif (count(array_unique($statuses)) === 1) {
                              $monthlyStatus[$monthKey] = ucfirst($statuses[0]);
                           } else {
                              $monthlyStatus[$monthKey] = 'Mixed';
                           }
                        }

                        krsort($monthlyStatus);
                        $monthlyStatus = array_slice($monthlyStatus, 0, 6, true);
                     @endphp

                     @if (!empty($monthlyStatus))
                        @foreach ($monthlyStatus as $monthKey => $status)
                           @php
                              $monthTitle = Carbon::createFromFormat('Y-m', $monthKey)->format('F - Y');
                              $statusLower = strtolower($status);

                              $dotClass = match($statusLower) {
                                 'draft' => 'dot-blue',
                                 'submitted' => 'dot-yellow',
                                 'auto approved', 'approved' => 'dot-green',
                                 'rejected' => 'dot-red',
                                 default => 'dot-gray',
                              };

                              $lineClass = match($statusLower) {
                                 'draft' => 'blue-timeline',
                                 'submitted' => 'yellow-timeline',
                                 'auto approved', 'approved' => 'green-timeline',
                                 'rejected' => 'red-timeline',
                                 default => 'gray-timeline',
                              };

                              $badgeClass = match($statusLower) {
                                 'draft' => 'badge blue',
                                 'submitted' => 'badge yellow',
                                 'auto approved', 'approved' => 'badge green',
                                 'rejected' => 'badge red',
                                 default => 'badge gray',
                              };

                              $icon = match($statusLower) {
                                 'auto approved', 'approved' => '<i class="fa-solid fa-check"></i>',
                                 'submitted' => '<i class="fa-solid fa-xmark"></i>',
                                 default => '',
                              };
                           @endphp

                           <div class="timeline-item">
                              <div class="timeline-dot {{ $dotClass }}">{!! $icon !!}</div>
                              <div class="timeline-line {{ $lineClass }}"></div>
                              <div class="timeline-content">
                                 <h4>Timesheet Overview ({{ $monthTitle }})</h4>
                                 <div class="{{ $badgeClass }}">{{ ucwords($status) }}</div>
                              </div>
                           </div>
                        @endforeach
                     @else
                        <p class="text-muted" style="padding: 0.5rem 1rem;">Timesheet Overview not found</p>
                     @endif
                  </div>
               </div>
               <div class="col-lg-12 col-xl-12 mb-4 mb-xl-none position-relative mt-4">
                     <div class="work-summary write-summary">
                        <!-- Expand Button -->
                        <button class="expand-btn" data-bs-toggle="modal" data-bs-target="#workSummaryModalclaim">
                           <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" class="img-fluid" />
                        </button>

                        <div class="remark-bottom-col">
                           <div class="remark-heading">
                                 <span></span>
                                 <h4>Feedbacks</h4>
                           </div>

                           <div class="remark-item">
                                 <p>
                                    This platform is very useful in tracking the timesheets and logs.
                                 </p>

                                 <a href="javascript:void(0)" class="remark-pop-btn" id="toggleBtnFeedback">
                                    <img src="{{ asset('public/assets/latest/images/3-dot-image.png') }}" class="img-fluid" />
                                 </a>



                           </div>

                           <div class="write-remark">
                                 <input type="text" placeholder="Write your remarks here...">
                           </div>
                        </div>

                     </div>
                     <div class="edit-delete-popup d-none edit-feedback">
                        <ul>
                           <li><img src="{{ asset('public/assets/latest/images/black-edit-icon.png') }}">Edit  
                           </li>
                           <li><img src="{{ asset('public/assets/latest/images/black-delete-icon.png') }}">Delete
                           </li>
                        </ul>
                     </div>

                     <script>
                     document.addEventListener("DOMContentLoaded", function () {
                        const toggleBtn = document.getElementById("toggleBtnFeedback");
                        const popup = document.querySelector(".edit-feedback");

                        toggleBtn.addEventListener("click", function (e) {
                           e.stopPropagation(); // Prevent outside click from firing immediately
                           popup.classList.toggle("d-none");
                        });

                        // Optional: hide popup if clicking outside
                        document.addEventListener("click", function (e) {
                           if (!popup.contains(e.target) && e.target !== toggleBtn) {
                              popup.classList.add("d-none");
                           }
                        });
                     });
                  </script>


                     <!-- Modal -->
                     <div class="modal fade" id="workSummaryModalclaim" tabindex="-1" aria-labelledby="workSummaryModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                           <div class="modal-content">
                                 <div class="modal-header ">
                                    <button type="button" class="btn-close popup-expand-btn " data-bs-dismiss="modal" aria-label="Close">
                                       <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                                    </button>
                                 </div>
                                 <div class="modal-body ">
                                    <div class="write-summary-popup-body">
                                       <h4>Remarks</h4>
                                       <div class="write-summary-expand-row mt-2">
                                             <div class="write-summary-expand-item">
                                                <p>
                                                   I have been working with
                                                   the production team and
                                                   supporting
                                                   in the release
                                                   activities. This was an
                                                   unexpected support call
                                                </p>

                                                <a href="javascript:void(0)" class="remark-pop-btn" id="toggleBtnexpandFeedback">
                                                   <img src="{{ asset('public/assets/latest/images/3-dot-image.png') }}" class="img-fluid" />
                                                </a>
                                             </div>

                                             <div class="write-remark mt-4">
                                                <input type="text" placeholder="Write your remarks here...">
                                             </div>
                                       </div>

                                       <div class="edit-delete-popup-expand feedback-expend d-none">
                                             <ul>
                                                 <li><img src="{{ asset('public/assets/latest/images/black-edit-icon.png') }}">Edit  
                                                </li>
                                                <li><img src="{{ asset('public/assets/latest/images/black-delete-icon.png') }}">Delete
                                                </li>
                                             </ul>
                                       </div>
                                       <script>
                                          document.addEventListener("DOMContentLoaded", function () {
                                             const toggleBtn2 = document.getElementById("toggleBtnexpandFeedback");
                                             const popup2 = document.querySelector(".feedback-expend");

                                             toggleBtn2.addEventListener("click", function (e) {
                                                e.stopPropagation(); // Prevent the document click from hiding it immediately
                                                popup2.classList.toggle("d-none");
                                             });

                                             // Optional: hide when clicking outside
                                             document.addEventListener("click", function (e) {
                                                if (!popup2.contains(e.target) && e.target !== toggleBtn2) {
                                                   popup2.classList.add("d-none");
                                                }
                                             });
                                          });
                                       </script>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>

               </div>
               
            </div>

            <div class="row mt-2 bottom-remark-timesheet-group">
               <div class="col-lg-6 col-xl-4 mb-4 mb-xl-none" id="bottom-box-1">
                  <div class="work-summary">
                     <!-- Expand Button -->
                     <button class="expand-btn" data-bs-toggle="modal" data-bs-target="#workSummaryModal">
                     <img src="{{ asset('public/assets/latest/images/expand-icon.png') }}" class="img-fluid" />
                     </button>
                     <!-- Tabs -->
                     <ul class="nav nav-tabs" id="workTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                           <button class="nav-link active" id="leave-tab" data-bs-toggle="tab" data-bs-target="#leave" type="button" role="tab">Leave Log</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="summary-tab" data-bs-toggle="tab" data-bs-target="#summary" type="button" role="tab">Work summery</button>
                        </li>
                     </ul>
                     <div class="tab-content tab_content_body border border-top-0 p-1 p-xxl-3" id="workTabsContent">
                        <div class="tab-pane fade show active" id="leave" role="tabpanel" aria-labelledby="leave-tab">
                           <div class="leave-log w-100">
                              <table class="w-100">
                                 <thead>
                                    <tr>
                                       <th>Type Of Leave</th>
                                       <th>From</th>
                                       <th>To</th>
                                       <th>Days/Hours</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @php $hasData = false; @endphp

                                    @foreach ($dataTimesheet as $entry)
                                       @php
                                          $record = json_decode($entry->record);

                                          if (!isset($record->leaveType)) continue;

                                          $leaveType = $record->leaveType ?? '';
                                          $date = $record->date ?? '';
                                          $applyOnCell = $record->applyOnCell ?? '';
                                          $leaveHourId = $record->leaveHourId ?? '';

                                          $from = $to = '';
                                          $days = '1';

                                          if (empty($date) && !empty($applyOnCell)) {
                                             $from = $to = trim($applyOnCell);
                                             $days = ($leaveHourId === 'fHalfDay' || $leaveHourId === 'sHalfDay') ? '1/2' : '1';
                                          } elseif (strpos($date, 'to') !== false) {
                                             [$from, $to] = array_map('trim', explode('to', $date));
                                             if ($leaveHourId === 'fHalfDay' || $leaveHourId === 'sHalfDay') {
                                                $days = '1/2';
                                             } else {
                                                try {
                                                   $fromDate = \Carbon\Carbon::createFromFormat('d / m / Y', $from);
                                                   $toDate = \Carbon\Carbon::createFromFormat('d / m / Y', $to);
                                                   $days = $fromDate->diffInDays($toDate) + 1;
                                                } catch (\Exception $e) {
                                                   $days = '1';
                                                }
                                             }
                                          } else {
                                             $from = $to = trim($date);
                                             $days = ($leaveHourId === 'fHalfDay' || $leaveHourId === 'sHalfDay') ? '1/2' : '1';
                                          }

                                          $badgeClass = match($leaveType) {
                                             'PDO' => 'badge bg-primary text-white',
                                             'ML' => 'badge bg-info text-white',
                                             'UL' => 'badge bg-warning text-dark',
                                             'PH' => 'badge bg-success text-white',
                                             default => 'badge bg-secondary text-white',
                                          };

                                          $leaveShort = '';
                                          if ($leaveHourId === 'fHalfDay') $leaveShort = 'HD1';
                                          elseif ($leaveHourId === 'sHalfDay') $leaveShort = 'HD2';
                                          elseif ($leaveHourId === 'customDay') $leaveShort = 'custom';

                                          $parts = explode(' / ', $from);
                                          $rowMonth = isset($parts[1]) ? (int) $parts[1] : null;
                                          $rowYear = isset($parts[2]) ? (int) $parts[2] : null;

                                          $hasData = true;
                                       @endphp

                                       <tr data-month="{{ $rowMonth }}" data-year="{{ $rowYear }}">
                                          <td>
                                             <span class="{{ $badgeClass }}">
                                                {{ \Illuminate\Support\Str::replaceFirst('Custom', '', $leaveType) }}
                                                @if ($leaveShort)
                                                   <small><strong>{{ $leaveShort }}</strong></small>
                                                @endif
                                             </span>
                                          </td>
                                          <td>{{ $from }}</td>
                                          <td>{{ $to }}</td>
                                          <td><span style="color:red;">{{ $days }}</span></td>
                                       </tr>
                                    @endforeach

                                    @if (!$hasData)
                                       <tr data-month="{{ request('month') ?? date('n') }}" data-year="{{ request('year') ?? date('Y') }}">
                                          <td colspan="4" class="text-center text-muted">No entries found for this month</td>
                                       </tr>
                                    @endif
                                 </tbody>
                              </table>

                           </div>
                        </div>
                        <div class="tab-pane fade" id="summary" role="tabpanel" aria-labelledby="summary-tab">
                           <div class="stats-box">
                              <div>
                                 <div class="stats-number" id="forecastedHours"></div>
                                 <div class="stats-label">Hours Forecasted</div>
                              </div>
                              <div>
                                 <div class="stats-number" id="loggedHours"></div>
                                 <div class="stats-label">Hours Logged</div>
                              </div>
                           </div>

                           <!-- ✅ Dynamic Update Script -->
                           <script>
                              document.addEventListener("DOMContentLoaded", function () {
                                 const dataTimesheet = @json($dataTimesheet);
                                 const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")); // 0-based
                                 const selectedYear = parseInt(localStorage.getItem("timesheetYear"));

                                 let totalHours = 0;
                                 let countRows = 0;

                                 dataTimesheet.forEach(item => {
                                    const record = JSON.parse(item.record || '{}');

                                    if (!record.workingHours || isNaN(record.workingHours)) return;

                                    const dateStr = record.applyOnCell || '';
                                    const parts = dateStr.split(' / ');
                                    if (parts.length !== 3) return;

                                    const [day, monthStr, yearStr] = parts;
                                    const month = parseInt(monthStr);
                                    const year = parseInt(yearStr);
                                    const hours = parseFloat(record.workingHours);

                                    if (month === (selectedMonth + 1) && year === selectedYear) {
                                       countRows++;           // ✅ count of working days
                                       totalHours += hours;   // ✅ actual logged hours
                                    }
                                 });

                                 // ✅ Update values in DOM
                                 document.getElementById("forecastedHours").innerText = countRows * 8;
                                 document.getElementById("loggedHours").innerText = totalHours.toFixed(0);
                                 document.getElementById("base_w_h").innerText = countRows * 8;
                                 document.getElementById("total_b_w_h").innerText = totalHours.toFixed(0);
                              });
                           </script>


                           <div class="bottom-stats">
                              <div>15 <span>Leave Log</span></div>
                              <div>10 <span>AL</span></div>
                              <div>03 <span>ML</span></div>
                              <div>02 <span>Comp Off</span></div>
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
                                    <button class="nav-link tab_btn active" id="modal-leave-tab" data-bs-toggle="tab" data-bs-target="#modal-leave" type="button" role="tab">Leave Log</button>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                    <button class="nav-link tab_btn" id="modal-summary-tab" data-bs-toggle="tab" data-bs-target="#modal-summary" type="button" role="tab">Work Log Summary</button>
                                 </li>
                              </ul>
                              <div class="tab-content tab_content_body">
                                 <div class="tab-pane fade show active" id="modal-leave" role="tabpanel">
                                    <div class="leave-log w-100">
                                       <table class="w-100">
                                          <thead>
                                             <tr>
                                                <th>Type Of Leave</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Days/Hours</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             @php $hasData = false; @endphp

                                             @foreach ($dataTimesheet as $entry)
                                                @php
                                                   $record = json_decode($entry->record);

                                                   if (!isset($record->leaveType)) continue;

                                                   $leaveType = $record->leaveType ?? '';
                                                   $date = $record->date ?? '';
                                                   $applyOnCell = $record->applyOnCell ?? '';
                                                   $leaveHourId = $record->leaveHourId ?? '';

                                                   $from = $to = '';
                                                   $days = '1';

                                                   if (empty($date) && !empty($applyOnCell)) {
                                                      $from = $to = trim($applyOnCell);
                                                      $days = ($leaveHourId === 'fHalfDay' || $leaveHourId === 'sHalfDay') ? '1/2' : '1';
                                                   } elseif (strpos($date, 'to') !== false) {
                                                      [$from, $to] = array_map('trim', explode('to', $date));
                                                      if ($leaveHourId === 'fHalfDay' || $leaveHourId === 'sHalfDay') {
                                                         $days = '1/2';
                                                      } else {
                                                         try {
                                                            $fromDate = \Carbon\Carbon::createFromFormat('d / m / Y', $from);
                                                            $toDate = \Carbon\Carbon::createFromFormat('d / m / Y', $to);
                                                            $days = $fromDate->diffInDays($toDate) + 1;
                                                         } catch (\Exception $e) {
                                                            $days = '1';
                                                         }
                                                      }
                                                   } else {
                                                      $from = $to = trim($date);
                                                      $days = ($leaveHourId === 'fHalfDay' || $leaveHourId === 'sHalfDay') ? '1/2' : '1';
                                                   }

                                                   $badgeClass = match($leaveType) {
                                                      'PDO' => 'badge bg-primary text-white',
                                                      'ML' => 'badge bg-info text-white',
                                                      'UL' => 'badge bg-warning text-dark',
                                                      'PH' => 'badge bg-success text-white',
                                                      default => 'badge bg-secondary text-white',
                                                   };

                                                   $leaveShort = '';
                                                   if ($leaveHourId === 'fHalfDay') $leaveShort = 'HD1';
                                                   elseif ($leaveHourId === 'sHalfDay') $leaveShort = 'HD2';
                                                   elseif ($leaveHourId === 'customDay') $leaveShort = 'custom';

                                                   $parts = explode(' / ', $from);
                                                   $rowMonth = isset($parts[1]) ? (int) $parts[1] : null;
                                                   $rowYear = isset($parts[2]) ? (int) $parts[2] : null;

                                                   $hasData = true;
                                                @endphp

                                                <tr data-month="{{ $rowMonth }}" data-year="{{ $rowYear }}">
                                                   <td>
                                                      <span class="{{ $badgeClass }}">
                                                         {{ \Illuminate\Support\Str::replaceFirst('Custom', '', $leaveType) }}
                                                         @if ($leaveShort)
                                                            <small><strong>{{ $leaveShort }}</strong></small>
                                                         @endif
                                                      </span>
                                                   </td>
                                                   <td>{{ $from }}</td>
                                                   <td>{{ $to }}</td>
                                                   <td><span style="color:red;">{{ $days }}</span></td>
                                                </tr>
                                             @endforeach

                                             @if (!$hasData)
                                                <tr data-month="{{ request('month') ?? date('n') }}" data-year="{{ request('year') ?? date('Y') }}">
                                                   <td colspan="4" class="text-center text-muted">No entries found for this month</td>
                                                </tr>
                                             @endif
                                          </tbody>
                                       </table>

                                       
                                       <script>
                                          document.addEventListener("DOMContentLoaded", function () {
                                             const month = parseInt(localStorage.getItem("timesheetMonth")) + 1; // JS 0-indexed
                                             const year = parseInt(localStorage.getItem("timesheetYear"));

                                             const rows = document.querySelectorAll("table tbody tr");
                                             rows.forEach(row => {
                                                const rowMonth = parseInt(row.dataset.month);
                                                const rowYear = parseInt(row.dataset.year);

                                                if (rowMonth === month && rowYear === year) {
                                                   row.style.display = "";
                                                } else {
                                                   row.style.display = "none";
                                                }
                                             });
                                          });
                                       </script>

                                    </div>
                                 </div>
                                 <div class="tab-pane fade" id="modal-summary" role="tabpanel">
                                    <div class="stats-box">



                                       <div>
                                          
                                          <div class="stats-number" id="base_w_h"></div>
                                          <div class="stats-label">Hours Forecasted</div>
                                       </div>
                                       <div>
                                       
                                          <div class="stats-number" id="total_b_w_h"></div>
                                          <div class="stats-label">Hours Logged</div>
                                       </div>
                                    </div>
                                    <div class="bottom-stats">
                                       <div class="stats_score">
                                          <span class="w_hrs">06.30</span>
                                          / <span class="tw_hrs">15</span>
                                          <p>Leave Log</p>
                                       </div>
                                       <div class="stats_score">
                                          <span class="w_hrs">05.30</span>
                                          / <span class="tw_hrs">15</span>
                                          <p>AL</p>
                                       </div>
                                       <div class="stats_score">
                                          <span class="w_hrs">01.45</span>
                                          / <span class="tw_hrs">14</span>
                                          <p>ML</p>
                                       </div>
                                       <div class="stats_score">
                                          <span class="w_hrs">01.30</span>
                                          / <span class="tw_hrs">15</span>
                                          <p>UL</p>
                                       </div>
                                       <div class="stats_score">
                                          <span class="w_hrs">0.30</span>
                                          / <span class="tw_hrs">15</span>
                                          <p>PDO</p>
                                       </div>
                                       <div class="stats_score">
                                          <span class="w_hrs">0.30</span>
                                          / <span class="tw_hrs">15</span>
                                          <p>Comp Off</p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <script>
               document.addEventListener("DOMContentLoaded", function () {
                  const expandBtn = document.querySelector("#bottom-box-1 .expand-btn");

                  expandBtn.addEventListener("click", function () {
                     // Get the active tab in the small box
                     const activeSmallTab = document.querySelector("#bottom-box-1 .nav-tabs .nav-link.active");
                     const smallTabId = activeSmallTab?.id;

                     // Map small tab IDs to modal tab button IDs
                     const tabMap = {
                        'leave-tab': 'modal-leave-tab',
                        'summary-tab': 'modal-summary-tab'
                     };

                     // Modal tab buttons
                     const modalLeaveTab = document.getElementById("modal-leave-tab");
                     const modalSummaryTab = document.getElementById("modal-summary-tab");

                     // Modal tab panes
                     const modalLeavePane = document.getElementById("modal-leave");
                     const modalSummaryPane = document.getElementById("modal-summary");

                     // Remove active classes
                     [modalLeaveTab, modalSummaryTab].forEach(btn => btn.classList.remove("active"));
                     [modalLeavePane, modalSummaryPane].forEach(pane => {
                        pane.classList.remove("show", "active");
                     });

                     // Determine which tab to activate
                     const modalTargetTabId = tabMap[smallTabId] ?? 'modal-leave-tab';
                     const modalTargetTab = document.getElementById(modalTargetTabId);
                     const modalTargetPaneId = modalTargetTab?.getAttribute("data-bs-target")?.substring(1);
                     const modalTargetPane = document.getElementById(modalTargetPaneId);

                     // Activate correct tab
                     modalTargetTab?.classList.add("active");
                     modalTargetPane?.classList.add("show", "active");
                  });
               });
               </script>

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
                    <div class="remark-timeline" id="remarkTimeline">
                           @php
                              
                              $timelineItems = [];

                              // ✅ Sort by updated_at DESC (latest activity first)
                              $sortedTimesheet = $dataTimesheet->sortByDesc('updated_at');

                              foreach ($sortedTimesheet as $entry) {
                                    $record = json_decode($entry->record, true);
                                    $leaveType = $record['leaveType'] ?? null;
                                    $workingHours = $record['workingHours'] ?? null;
                                    $leaveHourId = $record['leaveHourId'] ?? null;
                                    $applyOnCell = $record['applyOnCell'] ?? null;
                                    $dateRange = $record['date'] ?? '';
                                    $remarks = $record['remarks'] ?? null;

                                    $leaveShort = '';
                                    if ($leaveHourId === 'fHalfDay') $leaveShort = 'HD1';
                                    elseif ($leaveHourId === 'sHalfDay') $leaveShort = 'HD2';
                                    elseif ($leaveHourId === 'customDay') $leaveShort = 'custom';

                                    $badgeText = $leaveType ? ($leaveShort ? "$leaveType $leaveShort" : $leaveType) : null;

                                    $dates = [];

                                    if ($dateRange && str_contains($dateRange, 'to')) {
                                       try {
                                          [$start, $end] = array_map('trim', explode('to', $dateRange));
                                          $startDate = Carbon::createFromFormat('d / m / Y', $start);
                                          $endDate = Carbon::createFromFormat('d / m / Y', $end);

                                          while ($startDate->lte($endDate)) {
                                                $dates[] = $startDate->copy();
                                                $startDate->addDay();
                                          }
                                       } catch (\Exception $e) {}
                                    } elseif ($applyOnCell) {
                                       try {
                                          $dates[] = Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                                       } catch (\Exception $e) {}
                                    }

                                    foreach ($dates as $date) {
                                       if (in_array($date->dayOfWeek, [0, 6])) continue;

                                       $timelineItems[] = [
                                          'date' => $date,
                                          'formatted' => $date->format('D, d M Y'),
                                          'badge' => $badgeText,
                                          'workingHours' => $workingHours,
                                          'leaveType' => $leaveType,
                                          'remarks' => $remarks,
                                          'month' => $date->month,
                                          'year' => $date->year
                                       ];
                                    }
                              }
                           @endphp

                           <div id="timelineContainer" class="remark-container">
                              @foreach ($timelineItems as $item)
                                    <div class="remark-item mb-3" data-month="{{ $item['month'] }}" data-year="{{ $item['year'] }}">
                                       <div class="d-flex align-items-start">
                                          <div class="me-2 text-primary">
                                                <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                          </div>
                                          <div>
                                                <div class="d-flex align-items-center mb-1">
                                                   <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                   <small class="text-muted">
                                                      {{ $item['formatted'] }} -
                                                      @if ($item['badge'])
                                                            <span class="badge bg-light text-dark">{{ \Illuminate\Support\Str::replaceFirst('Custom', '', $item['badge']) }}</span>
                                                      @elseif ($item['workingHours'])
                                                            {{ $item['workingHours'] }} hours
                                                      @endif
                                                   </small>
                                                </div>

                                                @if ($item['leaveType'] === 'ML')
                                                   <p>{{ $consultant->emp_name }} has applied for medical leave</p>
                                                @elseif (!empty($item['remarks']))
                                                   <p>{{ $item['remarks'] }}</p>
                                                @endif
                                          </div>
                                       </div>
                                    </div>
                              @endforeach

                                 <div id="noRemarksMessage" class="text-center text-muted p-3 d-none">
                                       <strong>No entries found for this month</strong>
                                 </div>
                              </div>
                           </div>

                           <script>
                           document.addEventListener("DOMContentLoaded", function () {
                              const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                              const selectedYear = parseInt(localStorage.getItem("timesheetYear"));

                              const remarkItems = document.querySelectorAll("#timelineContainer .remark-item");
                              let visibleCount = 0;

                              remarkItems.forEach(item => {
                                 const month = parseInt(item.getAttribute("data-month"));
                                 const year = parseInt(item.getAttribute("data-year"));

                                 if (month === selectedMonth && year === selectedYear) {
                                       item.style.display = "";
                                       visibleCount++;
                                 } else {
                                       item.style.display = "none";
                                 }
                              });

                              const noRemarks = document.getElementById("noRemarksMessage");
                              noRemarks.classList.toggle("d-none", visibleCount > 0);
                           });
                           </script>


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
                                <div class="remark-timeline" id="remarkTimeline">
                                    @php
                                       
                                       $timelineItems = [];

                                       // ✅ Sort by updated_at DESC (latest activity first)
                                       $sortedTimesheet = $dataTimesheet->sortByDesc('updated_at');

                                       foreach ($sortedTimesheet as $entry) {
                                             $record = json_decode($entry->record, true);
                                             $leaveType = $record['leaveType'] ?? null;
                                             $workingHours = $record['workingHours'] ?? null;
                                             $leaveHourId = $record['leaveHourId'] ?? null;
                                             $applyOnCell = $record['applyOnCell'] ?? null;
                                             $dateRange = $record['date'] ?? '';
                                             $remarks = $record['remarks'] ?? null;

                                             $leaveShort = '';
                                             if ($leaveHourId === 'fHalfDay') $leaveShort = 'HD1';
                                             elseif ($leaveHourId === 'sHalfDay') $leaveShort = 'HD2';
                                             elseif ($leaveHourId === 'customDay') $leaveShort = 'custom';

                                             $badgeText = $leaveType ? ($leaveShort ? "$leaveType $leaveShort" : $leaveType) : null;

                                             $dates = [];

                                             if ($dateRange && str_contains($dateRange, 'to')) {
                                                try {
                                                   [$start, $end] = array_map('trim', explode('to', $dateRange));
                                                   $startDate = Carbon::createFromFormat('d / m / Y', $start);
                                                   $endDate = Carbon::createFromFormat('d / m / Y', $end);

                                                   while ($startDate->lte($endDate)) {
                                                         $dates[] = $startDate->copy();
                                                         $startDate->addDay();
                                                   }
                                                } catch (\Exception $e) {}
                                             } elseif ($applyOnCell) {
                                                try {
                                                   $dates[] = Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                                                } catch (\Exception $e) {}
                                             }

                                             foreach ($dates as $date) {
                                                if (in_array($date->dayOfWeek, [0, 6])) continue;

                                                $timelineItems[] = [
                                                   'date' => $date,
                                                   'formatted' => $date->format('D, d M Y'),
                                                   'badge' => $badgeText,
                                                   'workingHours' => $workingHours,
                                                   'leaveType' => $leaveType,
                                                   'remarks' => $remarks,
                                                   'month' => $date->month,
                                                   'year' => $date->year
                                                ];
                                             }
                                       }
                                    @endphp

                                    <div id="timelineContainer123" class="remark-container">
                                       @foreach ($timelineItems as $item)
                                             <div class="remark-item mb-3" data-month="{{ $item['month'] }}" data-year="{{ $item['year'] }}">
                                                <div class="d-flex align-items-start">
                                                   <div class="me-2 text-primary">
                                                         <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                         <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                   </div>
                                                   <div>
                                                         <div class="d-flex align-items-center mb-1">
                                                            <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="Alena" />
                                                            <small class="text-muted">
                                                               {{ $item['formatted'] }} -
                                                               @if ($item['badge'])
                                                                     <span class="badge bg-light text-dark">{{ \Illuminate\Support\Str::replaceFirst('Custom', '', $item['badge']) }}</span>
                                                               @elseif ($item['workingHours'])
                                                                     {{ $item['workingHours'] }} hours
                                                               @endif
                                                            </small>
                                                         </div>

                                                         @if ($item['leaveType'] === 'ML')
                                                            <p>{{ $consultant->emp_name }} has applied for medical leave</p>
                                                         @elseif (!empty($item['remarks']))
                                                            <p>{{ $item['remarks'] }}</p>
                                                         @endif
                                                   </div>
                                                </div>
                                             </div>
                                       @endforeach

                                       <div id="remarksEmptyMsg" class="text-center text-muted p-3 d-none">
                                             <strong>No entries found for this month</strong>
                                       </div>
                                    </div>
                                 </div>

                                 <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                       const month = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                                       const year = parseInt(localStorage.getItem("timesheetYear"));

                                       const remarkRows = document.querySelectorAll("#timelineContainer123 .remark-item");
                                       const emptyMsg = document.getElementById("remarksEmptyMsg");

                                       let visibleCount = 0;

                                       remarkRows.forEach(row => {
                                          const rowMonth = parseInt(row.getAttribute("data-month"));
                                          const rowYear = parseInt(row.getAttribute("data-year"));

                                          if (rowMonth === month && rowYear === year) {
                                             row.style.display = "";
                                             visibleCount++;
                                          } else {
                                             row.style.display = "none";
                                          }
                                       });

                                       if (visibleCount === 0) {
                                          emptyMsg.classList.remove("d-none");
                                       } else {
                                          emptyMsg.classList.add("d-none");
                                       }
                                    });
                                 </script>
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
                        <ul class="nav nav-tabs" id="timesheetTabsMain">
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
                              @php
                                 
                                 $timelineItems = [];

                                 // Sort by updated_at descending
                                 $sortedTimesheet = $dataTimesheet->sortByDesc('updated_at');

                                 foreach ($sortedTimesheet as $entry) {
                                       $record = json_decode($entry->record, true);
                                       $leaveType = $record['leaveType'] ?? null;
                                       $workingHours = $record['workingHours'] ?? null;
                                       $leaveHourId = $record['leaveHourId'] ?? null;
                                       $applyOnCell = $record['applyOnCell'] ?? null;
                                       $dateRange = $record['date'] ?? '';

                                       $leaveShort = '';
                                       if ($leaveHourId === 'fHalfDay') $leaveShort = 'HD1';
                                       elseif ($leaveHourId === 'sHalfDay') $leaveShort = 'HD2';
                                       elseif ($leaveHourId === 'customDay') $leaveShort = 'custom';

                                       $badgeText = $leaveType ? ($leaveShort ? "$leaveType $leaveShort" : $leaveType) : null;

                                       $dates = [];

                                       if ($dateRange && str_contains($dateRange, 'to')) {
                                          try {
                                             [$start, $end] = array_map('trim', explode('to', $dateRange));
                                             $startDate = Carbon::createFromFormat('d / m / Y', $start);
                                             $endDate = Carbon::createFromFormat('d / m / Y', $end);

                                             while ($startDate->lte($endDate)) {
                                                   $dates[] = $startDate->copy();
                                                   $startDate->addDay();
                                             }
                                          } catch (\Exception $e) {}
                                       } elseif ($applyOnCell) {
                                          try {
                                             $dates[] = Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                                          } catch (\Exception $e) {}
                                       }

                                       foreach ($dates as $date) {
                                          if (in_array($date->dayOfWeek, [0, 6])) continue;

                                          $timelineItems[] = [
                                             'date' => $date,
                                             'formatted' => $date->format('D, d M Y'),
                                             'badge' => $badgeText,
                                             'workingHours' => $workingHours,
                                             'month' => $date->month,
                                             'year' => $date->year
                                          ];
                                       }
                                 }
                              @endphp

                              
                                @foreach ($dataTimesheet->sortByDesc('updated_at') as $entry)
                                       @php
                                          $record = json_decode($entry->record, true);
                                          $leaveType = $record['leaveType'] ?? null;
                                          $subType = $record['type'] ?? null;
                                          $extraHours = $record['extraHours'] ?? null;
                                          $applyOnCell = $record['applyOnCell'] ?? null;

                                          try {
                                                $date = \Carbon\Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                                                $formattedDate = $date->format('D, d M');
                                                $month = $date->month;
                                                $year = $date->year;
                                          } catch (\Exception $e) {
                                                continue;
                                          }

                                          $labelMap = [
                                                'PH' => 'Public Holiday',
                                                'ML' => 'Medical Leave',
                                                'AL' => 'Annual Leave',
                                                'UL' => 'Unpaid Leave',
                                                'PDO' => 'Paid day off',
                                                'Custom COMP-OFF' => 'Comp off',
                                                'pay_off' => 'Pay off',
                                                'comp_off' => 'Comp off',
                                                'ignore' => 'Ignore',
                                          ];

                                          $topLabel = $leaveType ?? ucfirst(str_replace('_', ' ', $subType));
                                          $mainLabel = $labelMap[$leaveType] ?? $labelMap[$subType] ?? null;
                                       @endphp

                                       <div id="littletimesheet" class="timeline-item d-flex align-items-start mb-3"
                                             data-month="{{ $month }}"
                                             data-year="{{ $year }}">
                                          <div class="me-2">
                                                <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                          </div>

                                          <div>
                                                {{-- 🔷 TOP ROW: Image + leaveType --}}
                                                <div class="d-flex align-items-center mb-1">
                                                   <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" width="24" height="24" />
                                                   <span class="fw-bold text-primary" style="font-size: 14px;">
                                                      {{ strtoupper($topLabel) }} - (1)
                                                   </span>
                                                </div>

                                                {{-- 🧾 SECOND ROW: Date + Label + Hours --}}
                                                <div class="d-flex align-items-center flex-wrap gap-2 ms-4">
                                                   <span>{{ $formattedDate }}</span>

                                                   @if ($mainLabel)
                                                      <span class="badge bg-info text-white">{{ $mainLabel }}</span>
                                                   @endif

                                                   @if (!empty($extraHours))
                                                      <span class="fw-semibold">- {{ $extraHours }} hours off</span>
                                                   @elseif (!empty($record['workingHours']) && is_numeric($record['workingHours']))
                                                      <span class="fw-semibold">- {{ $record['workingHours'] }} hours</span>
                                                   @endif
                                                </div>
                                          </div>
                                       </div>
                                 @endforeach
                                 
                                 <div id="noTimelineMessage" class="text-center text-muted p-2 d-none">
                                       <strong>No entries found for this month</strong>
                                 </div>
                              
                           </div>

                           <script>
                              // Delay execution to ensure DOM and localStorage are ready
                              document.addEventListener("DOMContentLoaded", function () {
                                 setTimeout(function () {
                                    const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                                    const selectedYear = parseInt(localStorage.getItem("timesheetYear"));
                                    
                                    const items = document.querySelectorAll("#littletimesheet");
                                    let visibleCount = 0;

                                    items.forEach(item => {
                                       const month = parseInt(item.getAttribute("data-month"));
                                       const year = parseInt(item.getAttribute("data-year"));
                                    
                                       if (month === selectedMonth && year === selectedYear) {
                                          item.style.display = "";
                                          visibleCount++;
                                       } else {
                                          item.style.setProperty("display", "none", "important");
                                       }
                                    });

                                    const noMessage = document.querySelector("#noTimelineMessage");
                                    if (noMessage) {
                                       noMessage.classList.toggle("d-none", visibleCount > 0);
                                    }
                                 }, 200);
                              });
                           </script>



                        </div>
                        <!-- Other tabs can be filled similarly -->
                        <div class="tab-pane fade" id="extraTimeTab">

                            <div id="filteredTimeline">
                                 @foreach ($dataTimesheet as $item)
                                    @php
                                       $record = json_decode($item->record ?? '{}', true);
                                       $type = $record['type'] ?? null;

                                       // Label map
                                       $labelMap = [
                                             'comp_off' => ['label' => 'Comp - Off', 'color' => '#d35400'],
                                             'pay_off'  => ['label' => 'Pay - Off',  'color' => '#2980b9'],
                                             'ignore'   => ['label' => 'Ignored',    'color' => '#7f8c8d'],
                                       ];

                                       // Extract date parts
                                       $month = null;
                                       $year = null;
                                       if (!empty($record['applyOnCell'])) {
                                             try {
                                                $dt = \Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell']);
                                                $month = $dt->month;
                                                $year = $dt->year;
                                             } catch (\Exception $e) {}
                                       }
                                    @endphp

                                    @if (isset($labelMap[$type]) && $month && $year)
                                       <div class="timeline-item d-flex align-items-start mb-3"
                                             data-month="{{ $month }}"
                                             data-year="{{ $year }}">
                                             <div class="me-2">
                                                <div class="dot rounded-circle" style="width: 10px; height: 10px; background-color: #007bff;"></div>
                                                <div class="line" style="width: 2px; height: 100%; margin-left: 4px; background-color: #007bff;"></div>
                                             </div>
                                             <div>
                                                <div class="d-flex align-items-center mb-1 tl-header">
                                                   <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                   <span style="color: {{ $labelMap[$type]['color'] }}; font-weight: bold;">
                                                         {{ $labelMap[$type]['label'] }}
                                                   </span>
                                                </div>
                                                <div class="tl_details">
                                                   <span>{{ $record['applyOnCell'] ?? '--/--/----' }} - </span>
                                                   <span class="badge" style="background-color: #ffe0b3; color: {{ $labelMap[$type]['color'] }}; font-weight: bold;">
                                                         {{ $labelMap[$type]['label'] }}
                                                   </span>
                                                   <span>- {{ str_pad($record['extraHours'] ?? '0', 2, '0', STR_PAD_LEFT) }} : 00 hours</span>
                                                </div>
                                             </div>
                                       </div>
                                    @endif
                                 @endforeach
                            </div>
                            <div id="noEntriesMessage" class="text-muted text-center p-2 d-none">
                              <strong>No entries found for this month</strong>
                            </div>
                           <script>
                              document.addEventListener("DOMContentLoaded", function () {
                                 setTimeout(() => {
                                    const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                                    const selectedYear = parseInt(localStorage.getItem("timesheetYear"));

                                    const items = document.querySelectorAll("#filteredTimeline .timeline-item");
                                    let visibleCount = 0;

                                    items.forEach(item => {
                                          const month = parseInt(item.getAttribute("data-month"));
                                          const year = parseInt(item.getAttribute("data-year"));

                                          if (month === selectedMonth && year === selectedYear) {
                                             item.style.display = "";
                                             visibleCount++;
                                          } else {
                                             item.style.setProperty("display", "none", "important");
                                          }
                                    });

                                    const noMessage = document.getElementById("noEntriesMessage");
                                    if (noMessage) {
                                          noMessage.classList.toggle("d-none", visibleCount > 0);
                                    }
                                 }, 200);
                              });
                           </script>

                        </div>
                        <div class="tab-pane fade" id="payOffTab">
                           <div class="timeline">

                              <div id="payoffTimeline">
                              @foreach ($dataTimesheet as $item)
                                 @php
                                    $record = json_decode($item->record ?? '{}', true);

                                    $month = null;
                                    $year = null;
                                    if (!empty($record['applyOnCell'])) {
                                          try {
                                             $dt = \Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell']);
                                             $month = $dt->month;
                                             $year = $dt->year;
                                          } catch (\Exception $e) {}
                                    }
                                 @endphp

                                 @if (isset($record['type']) && $record['type'] === 'pay_off' && $month && $year)
                                    <div class="timeline-item d-flex align-items-start mb-3"
                                          data-month="{{ $month }}"
                                          data-year="{{ $year }}">
                                          <div class="me-2">
                                             <div class="dot rounded-circle" style="width: 10px; height: 10px; background-color: #007bff;"></div>
                                             <div class="line" style="width: 2px; height: 100%; margin-left: 4px; background-color: #007bff;"></div>
                                          </div>
                                          <div>
                                             <div class="d-flex align-items-center mb-1 tl-header">
                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                <div class="pay_off_log">
                                                      <span>{{ $record['applyOnCell'] ?? '--/--/----' }} - </span>
                                                      <span>{{ str_pad($record['extraHours'] ?? '0', 2, '0', STR_PAD_LEFT) }} : 00 hours</span>
                                                </div>
                                             </div>
                                          </div>
                                    </div>
                                 @endif
                              @endforeach
                              </div>

                              {{-- Hidden "no data" message --}}
                              <div id="noPayoffMessage" class="text-muted text-center p-2 d-none">
                                 <strong>No entries found for this month</strong>
                              </div>

                              <script>
                                 document.addEventListener("DOMContentLoaded", function () {
                                    setTimeout(() => {
                                       const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                                       const selectedYear = parseInt(localStorage.getItem("timesheetYear"));

                                       const items = document.querySelectorAll("#payoffTimeline .timeline-item");
                                       let visibleCount = 0;

                                       items.forEach(item => {
                                             const month = parseInt(item.getAttribute("data-month"));
                                             const year = parseInt(item.getAttribute("data-year"));

                                             if (month === selectedMonth && year === selectedYear) {
                                                item.style.display = "";
                                                visibleCount++;
                                             } else {
                                                item.style.setProperty("display", "none", "important");
                                             }
                                       });

                                       const noMessage = document.getElementById("noPayoffMessage");
                                       if (noMessage) {
                                             noMessage.classList.toggle("d-none", visibleCount > 0);
                                       }
                                    }, 200);
                                 });
                              </script>

                           </div>
                        </div>
                        <div class="tab-pane fade" id="compOffTab">
                           <div class="timeline">

                              <div id="compOffTimeline">
                              @foreach ($dataTimesheet as $item)
                                 @php
                                    $record = json_decode($item->record ?? '{}', true);

                                    $month = null;
                                    $year = null;
                                    if (!empty($record['applyOnCell'])) {
                                          try {
                                             $dt = \Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell']);
                                             $month = $dt->month;
                                             $year = $dt->year;
                                          } catch (\Exception $e) {}
                                    }

                                    $leaveType = $record['leaveType'] ?? '';
                                    $extraHours = (int) ($record['extraHours'] ?? 0);
                                    $leaveHour = $record['leaveHour'] ?? '';

                                    $subLabel = '';
                                    if (Str::contains($leaveHour, 'HD1')) {
                                          $subLabel = 'HD1';
                                    } elseif (Str::contains($leaveHour, 'HD2')) {
                                          $subLabel = 'HD2';
                                    }

                                    $displayLabel = 'Comp - Off' . ($subLabel ? " $subLabel" : '');
                                 @endphp

                                 @if ($leaveType === 'Custom COMP-OFF' && $month && $year)
                                    <div class="timeline-item d-flex align-items-start mb-3"
                                          data-month="{{ $month }}"
                                          data-year="{{ $year }}">
                                          <div class="me-2">
                                             <div class="dot rounded-circle" style="width: 10px; height: 10px; background-color: #007bff;"></div>
                                             <div class="line" style="width: 2px; height: 100%; margin-left: 4px; background-color: #007bff;"></div>
                                          </div>
                                          <div>
                                             <div class="d-flex align-items-center mb-1 tl-header">
                                                <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                <div class="comp_off_log d-flex align-items-center flex-wrap gap-2">
                                                      <span>{{ $record['applyOnCell'] ?? '--/--/----' }} - </span>
                                                      <span class="badge" style="background-color:#f9e79f; color:#d35400; font-weight: bold;">
                                                         {{ $displayLabel }}
                                                      </span>
                                                      @if ($extraHours > 0)
                                                         <span>{{ str_pad($extraHours, 2, '0', STR_PAD_LEFT) }} : 00 hours</span>
                                                      @endif
                                                </div>
                                             </div>
                                          </div>
                                    </div>
                                 @endif
                              @endforeach
                              </div>

                              <div id="noCompOffMessage" class="text-muted text-center p-2 d-none">
                                 <strong>No entries found for this month</strong>
                              </div>

                              <script>
                              document.addEventListener("DOMContentLoaded", function () {
                                 setTimeout(() => {
                                    const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                                    const selectedYear = parseInt(localStorage.getItem("timesheetYear"));

                                    const items = document.querySelectorAll("#compOffTimeline .timeline-item");
                                    let visibleCount = 0;

                                    items.forEach(item => {
                                          const month = parseInt(item.getAttribute("data-month"));
                                          const year = parseInt(item.getAttribute("data-year"));

                                          if (month === selectedMonth && year === selectedYear) {
                                             item.style.display = "";
                                             visibleCount++;
                                          } else {
                                             item.style.setProperty("display", "none", "important");
                                          }
                                    });

                                    const noMessage = document.getElementById("noCompOffMessage");
                                    if (noMessage) {
                                          noMessage.classList.toggle("d-none", visibleCount > 0);
                                    }
                                 }, 200);
                              });
                              </script>

                           </div>
                        </div>
                        <div class="tab-pane fade" id="copiesTab">
                            <div class="timeline">
                              <div class="timeline-item d-flex mb-3">
                                    <div class="me-2">
                                       <div class="dot bg-primary rounded-circle"
                                          style="width:10px; height:10px;"></div>
                                       <div class="line bg-primary"></div>
                                    </div>
                                    <div class="w-100 d-flex">
                                       <div class="d-flex mb-1 tl-header">
                                          <img src="https://i.pravatar.cc/24"
                                                class="rounded-circle me-2">

                                       </div>
                                       <div class="tl_details w-100">
                                          <span class=" text-primary">Timesheet Overview</span>
                                          <div class=" d-flex justify-content-between mt-2">
                                                <span>12/08/2024</span>
                                               <a href="{{ url('/download-pdf') }}" class="badge_icon">
                                                   <i class="fa-solid fa-cloud-arrow-down"></i>
                                                </a>


                                          </div>
                                       </div>

                                    </div>
                              </div>
                              <div class="timeline-item d-flex mb-3">
                                    <div class="me-2">
                                       <div class="dot bg-primary rounded-circle"
                                          style="width:10px; height:10px;"></div>
                                       <div class="line bg-primary"></div>
                                    </div>
                                    <div class="w-100 d-flex">
                                       <div class="d-flex mb-1 tl-header">
                                          <img src="https://i.pravatar.cc/24"
                                                class="rounded-circle me-2">

                                       </div>
                                       <div class="tl_details w-100">
                                          <span class=" text-primary">Timesheet Overview</span>
                                          <div class=" d-flex justify-content-between mt-2">
                                                <span>12/08/2024</span>
                                                  <a href="{{ url('/download-pdf') }}" class="badge_icon">
                                                   <i class="fa-solid fa-cloud-arrow-down"></i>
                                                </a>
                                          </div>
                                       </div>

                                    </div>
                              </div>
                            </div>
                        </div>
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
                                 <ul class="nav nav-tabs popup_tabs" id="timesheetTabsModal">
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
                                       @php
                                          
                                          $timelineItems = [];

                                          // Sort by updated_at descending
                                          $sortedTimesheet = $dataTimesheet->sortByDesc('updated_at');

                                          foreach ($sortedTimesheet as $entry) {
                                                $record = json_decode($entry->record, true);
                                                $leaveType = $record['leaveType'] ?? null;
                                                $workingHours = $record['workingHours'] ?? null;
                                                $leaveHourId = $record['leaveHourId'] ?? null;
                                                $applyOnCell = $record['applyOnCell'] ?? null;
                                                $dateRange = $record['date'] ?? '';

                                                $leaveShort = '';
                                                if ($leaveHourId === 'fHalfDay') $leaveShort = 'HD1';
                                                elseif ($leaveHourId === 'sHalfDay') $leaveShort = 'HD2';
                                                elseif ($leaveHourId === 'customDay') $leaveShort = 'custom';

                                                $badgeText = $leaveType ? ($leaveShort ? "$leaveType $leaveShort" : $leaveType) : null;

                                                $dates = [];

                                                if ($dateRange && str_contains($dateRange, 'to')) {
                                                   try {
                                                      [$start, $end] = array_map('trim', explode('to', $dateRange));
                                                      $startDate = Carbon::createFromFormat('d / m / Y', $start);
                                                      $endDate = Carbon::createFromFormat('d / m / Y', $end);

                                                      while ($startDate->lte($endDate)) {
                                                            $dates[] = $startDate->copy();
                                                            $startDate->addDay();
                                                      }
                                                   } catch (\Exception $e) {}
                                                } elseif ($applyOnCell) {
                                                   try {
                                                      $dates[] = Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                                                   } catch (\Exception $e) {}
                                                }

                                                foreach ($dates as $date) {
                                                   if (in_array($date->dayOfWeek, [0, 6])) continue;

                                                   $timelineItems[] = [
                                                      'date' => $date,
                                                      'formatted' => $date->format('D, d M Y'),
                                                      'badge' => $badgeText,
                                                      'workingHours' => $workingHours,
                                                      'month' => $date->month,
                                                      'year' => $date->year
                                                   ];
                                                }
                                          }
                                       @endphp

                                       <div class="timeline-wrapper">
                                       @foreach ($dataTimesheet->sortByDesc('updated_at') as $entry)
                                             @php
                                                $record = json_decode($entry->record, true);
                                                $leaveType = $record['leaveType'] ?? null;
                                                $subType = $record['type'] ?? null;
                                                $extraHours = $record['extraHours'] ?? null;
                                                $applyOnCell = $record['applyOnCell'] ?? null;

                                                try {
                                                      $date = \Carbon\Carbon::createFromFormat('d / m / Y', trim($applyOnCell));
                                                      $formattedDate = $date->format('D, d M');
                                                      $month = $date->month;
                                                      $year = $date->year;
                                                } catch (\Exception $e) {
                                                      continue;
                                                }

                                                $labelMap = [
                                                      'PH' => 'Public Holiday',
                                                      'ML' => 'Medical Leave',
                                                      'AL' => 'Annual Leave',
                                                      'UL' => 'Unpaid Leave',
                                                      'PDO' => 'Paid day off',
                                                      'Custom COMP-OFF' => 'Comp off',
                                                      'pay_off' => 'Pay off',
                                                      'comp_off' => 'Comp off',
                                                      'ignore' => 'Ignore',
                                                ];

                                                $topLabel = $leaveType ?? ucfirst(str_replace('_', ' ', $subType));
                                                $mainLabel = $labelMap[$leaveType] ?? $labelMap[$subType] ?? null;
                                             @endphp

                                             <div id="littletimesheet" class="timeline-item d-flex align-items-start mb-3"
                                                   data-month="{{ $month }}"
                                                   data-year="{{ $year }}">
                                                <div class="me-2">
                                                      <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                      <div class="line bg-primary" style="width: 2px; height: 100%; margin-left: 4px;"></div>
                                                </div>

                                                <div>
                                                      {{-- 🔷 TOP ROW: Image + leaveType --}}
                                                      <div class="d-flex align-items-center mb-1">
                                                         <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" width="24" height="24" />
                                                         <span class="fw-bold text-primary" style="font-size: 14px;">
                                                            {{ strtoupper($topLabel) }} - (1)
                                                         </span>
                                                      </div>

                                                      {{-- 🧾 SECOND ROW: Date + Label + Hours --}}
                                                      <div class="d-flex align-items-center flex-wrap gap-2 ms-4">
                                                         <span>{{ $formattedDate }}</span>

                                                         @if ($mainLabel)
                                                            <span class="badge bg-info text-white">{{ $mainLabel }}</span>
                                                         @endif

                                                         @if (!empty($extraHours))
                                                            <span class="fw-semibold">- {{ $extraHours }} hours off</span>
                                                         @elseif (!empty($record['workingHours']) && is_numeric($record['workingHours']))
                                                            <span class="fw-semibold">- {{ $record['workingHours'] }} hours</span>
                                                         @endif
                                                      </div>
                                                </div>
                                             </div>
                                          @endforeach
                                          <div id="noTimelineMessage12" class="text-center text-muted p-2 d-none">
                                                <strong>No entries found for this month</strong>
                                          </div>
                                       </div>
                                    </div>

                                    <script>
                                       // Delay execution to ensure DOM and localStorage are ready
                                       document.addEventListener("DOMContentLoaded", function () {
                                          setTimeout(function () {
                                             const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                                             const selectedYear = parseInt(localStorage.getItem("timesheetYear"));
                                             
                                             const items = document.querySelectorAll("#littletimesheet");
                                             let visibleCount = 0;

                                             items.forEach(item => {
                                                const month = parseInt(item.getAttribute("data-month"));
                                                const year = parseInt(item.getAttribute("data-year"));
                                             
                                                if (month === selectedMonth && year === selectedYear) {
                                                   item.style.display = "";
                                                   visibleCount++;
                                                } else {
                                                   item.style.setProperty("display", "none", "important");
                                                }
                                             });

                                             const noMessage = document.querySelector("#noTimelineMessage12");
                                             if (noMessage) {
                                                noMessage.classList.toggle("d-none", visibleCount > 0);
                                             }
                                          }, 200);
                                       });
                                    </script>
                                 </div>
                                 <!-- Other tabs can be filled similarly -->
                                 <div class="tab-pane fade" id="modelextraTimeTab">

                                       <div id="filteredTimeline">
                                             @foreach ($dataTimesheet as $item)
                                                @php
                                                   $record = json_decode($item->record ?? '{}', true);
                                                   $type = $record['type'] ?? null;

                                                   // Label map
                                                   $labelMap = [
                                                         'comp_off' => ['label' => 'Comp - Off', 'color' => '#d35400'],
                                                         'pay_off'  => ['label' => 'Pay - Off',  'color' => '#2980b9'],
                                                         'ignore'   => ['label' => 'Ignored',    'color' => '#7f8c8d'],
                                                   ];

                                                   // Extract date parts
                                                   $month = null;
                                                   $year = null;
                                                   if (!empty($record['applyOnCell'])) {
                                                         try {
                                                            $dt = \Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell']);
                                                            $month = $dt->month;
                                                            $year = $dt->year;
                                                         } catch (\Exception $e) {}
                                                   }
                                                @endphp

                                                @if (isset($labelMap[$type]) && $month && $year)
                                                   <div class="timeline-item d-flex align-items-start mb-3"
                                                         data-month="{{ $month }}"
                                                         data-year="{{ $year }}">
                                                         <div class="me-2">
                                                            <div class="dot rounded-circle" style="width: 10px; height: 10px; background-color: #007bff;"></div>
                                                            <div class="line" style="width: 2px; height: 100%; margin-left: 4px; background-color: #007bff;"></div>
                                                         </div>
                                                         <div>
                                                            <div class="d-flex align-items-center mb-1 tl-header">
                                                               <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                               <span style="color: {{ $labelMap[$type]['color'] }}; font-weight: bold;">
                                                                     {{ $labelMap[$type]['label'] }}
                                                               </span>
                                                            </div>
                                                            <div class="tl_details">
                                                               <span>{{ $record['applyOnCell'] ?? '--/--/----' }} - </span>
                                                               <span class="badge" style="background-color: #ffe0b3; color: {{ $labelMap[$type]['color'] }}; font-weight: bold;">
                                                                     {{ $labelMap[$type]['label'] }}
                                                               </span>
                                                               <span>- {{ str_pad($record['extraHours'] ?? '0', 2, '0', STR_PAD_LEFT) }} : 00 hours</span>
                                                            </div>
                                                         </div>
                                                   </div>
                                                @endif
                                             @endforeach
                                       </div>
                                       <div id="noEntriesMessage354" class="text-muted text-center p-2 d-none">
                                          <strong>No entries found for this month</strong>
                                       </div>
                                       <script>
                                          document.addEventListener("DOMContentLoaded", function () {
                                             setTimeout(() => {
                                                const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                                                const selectedYear = parseInt(localStorage.getItem("timesheetYear"));

                                                const items = document.querySelectorAll("#filteredTimeline .timeline-item");
                                                let visibleCount = 0;

                                                items.forEach(item => {
                                                      const month = parseInt(item.getAttribute("data-month"));
                                                      const year = parseInt(item.getAttribute("data-year"));

                                                      if (month === selectedMonth && year === selectedYear) {
                                                         item.style.display = "";
                                                         visibleCount++;
                                                      } else {
                                                         item.style.setProperty("display", "none", "important");
                                                      }
                                                });

                                                const noMessage = document.getElementById("noEntriesMessage354");
                                                if (noMessage) {
                                                      noMessage.classList.toggle("d-none", visibleCount > 0);
                                                }
                                             }, 200);
                                          });
                                       </script>
                                 
                                 </div>
                                 <div class="tab-pane fade" id="modelpayOffTab">
                                    <div class="timeline">

                                       <div id="payoffTimeline">
                                       @foreach ($dataTimesheet as $item)
                                          @php
                                             $record = json_decode($item->record ?? '{}', true);

                                             $month = null;
                                             $year = null;
                                             if (!empty($record['applyOnCell'])) {
                                                   try {
                                                      $dt = \Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell']);
                                                      $month = $dt->month;
                                                      $year = $dt->year;
                                                   } catch (\Exception $e) {}
                                             }
                                          @endphp

                                          @if (isset($record['type']) && $record['type'] === 'pay_off' && $month && $year)
                                             <div class="timeline-item d-flex align-items-start mb-3"
                                                   data-month="{{ $month }}"
                                                   data-year="{{ $year }}">
                                                   <div class="me-2">
                                                      <div class="dot rounded-circle" style="width: 10px; height: 10px; background-color: #007bff;"></div>
                                                      <div class="line" style="width: 2px; height: 100%; margin-left: 4px; background-color: #007bff;"></div>
                                                   </div>
                                                   <div>
                                                      <div class="d-flex align-items-center mb-1 tl-header">
                                                         <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                         <div class="pay_off_log">
                                                               <span>{{ $record['applyOnCell'] ?? '--/--/----' }} - </span>
                                                               <span>{{ str_pad($record['extraHours'] ?? '0', 2, '0', STR_PAD_LEFT) }} : 00 hours</span>
                                                         </div>
                                                      </div>
                                                   </div>
                                             </div>
                                          @endif
                                       @endforeach
                                       </div>

                                       {{-- Hidden "no data" message --}}
                                       <div id="noPayoffMessage12" class="text-muted text-center p-2 d-none">
                                          <strong>No entries found for this month</strong>
                                       </div>

                                       <script>
                                          document.addEventListener("DOMContentLoaded", function () {
                                             setTimeout(() => {
                                                const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                                                const selectedYear = parseInt(localStorage.getItem("timesheetYear"));

                                                const items = document.querySelectorAll("#payoffTimeline .timeline-item");
                                                let visibleCount = 0;

                                                items.forEach(item => {
                                                      const month = parseInt(item.getAttribute("data-month"));
                                                      const year = parseInt(item.getAttribute("data-year"));

                                                      if (month === selectedMonth && year === selectedYear) {
                                                         item.style.display = "";
                                                         visibleCount++;
                                                      } else {
                                                         item.style.setProperty("display", "none", "important");
                                                      }
                                                });

                                                const noMessage = document.getElementById("noPayoffMessage12");
                                                if (noMessage) {
                                                      noMessage.classList.toggle("d-none", visibleCount > 0);
                                                }
                                             }, 200);
                                          });
                                       </script>

                                       
                                    </div>
                                 </div>
                                 <div class="tab-pane fade" id="modelcompOffTab">
                                    <div class="timeline">
                                        <div id="compOffTimeline">
                                       @foreach ($dataTimesheet as $item)
                                          @php
                                             $record = json_decode($item->record ?? '{}', true);

                                             $month = null;
                                             $year = null;
                                             if (!empty($record['applyOnCell'])) {
                                                   try {
                                                      $dt = \Carbon\Carbon::createFromFormat('d / m / Y', $record['applyOnCell']);
                                                      $month = $dt->month;
                                                      $year = $dt->year;
                                                   } catch (\Exception $e) {}
                                             }

                                             $leaveType = $record['leaveType'] ?? '';
                                             $extraHours = (int) ($record['extraHours'] ?? 0);
                                             $leaveHour = $record['leaveHour'] ?? '';

                                             $subLabel = '';
                                             if (Str::contains($leaveHour, 'HD1')) {
                                                   $subLabel = 'HD1';
                                             } elseif (Str::contains($leaveHour, 'HD2')) {
                                                   $subLabel = 'HD2';
                                             }

                                             $displayLabel = 'Comp - Off' . ($subLabel ? " $subLabel" : '');
                                          @endphp

                                          @if ($leaveType === 'Custom COMP-OFF' && $month && $year)
                                             <div class="timeline-item d-flex align-items-start mb-3"
                                                   data-month="{{ $month }}"
                                                   data-year="{{ $year }}">
                                                   <div class="me-2">
                                                      <div class="dot rounded-circle" style="width: 10px; height: 10px; background-color: #007bff;"></div>
                                                      <div class="line" style="width: 2px; height: 100%; margin-left: 4px; background-color: #007bff;"></div>
                                                   </div>
                                                   <div>
                                                      <div class="d-flex align-items-center mb-1 tl-header">
                                                         <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                                         <div class="comp_off_log d-flex align-items-center flex-wrap gap-2">
                                                               <span>{{ $record['applyOnCell'] ?? '--/--/----' }} - </span>
                                                               <span class="badge" style="background-color:#f9e79f; color:#d35400; font-weight: bold;">
                                                                  {{ $displayLabel }}
                                                               </span>
                                                               @if ($extraHours > 0)
                                                                  <span>{{ str_pad($extraHours, 2, '0', STR_PAD_LEFT) }} : 00 hours</span>
                                                               @endif
                                                         </div>
                                                      </div>
                                                   </div>
                                             </div>
                                          @endif
                                       @endforeach
                                       </div>

                                       <div id="noCompOffMessage12" class="text-muted text-center p-2 d-none">
                                          <strong>No entries found for this month</strong>
                                       </div>

                                       <script>
                                       document.addEventListener("DOMContentLoaded", function () {
                                          setTimeout(() => {
                                             const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                                             const selectedYear = parseInt(localStorage.getItem("timesheetYear"));

                                             const items = document.querySelectorAll("#compOffTimeline .timeline-item");
                                             let visibleCount = 0;

                                             items.forEach(item => {
                                                   const month = parseInt(item.getAttribute("data-month"));
                                                   const year = parseInt(item.getAttribute("data-year"));

                                                   if (month === selectedMonth && year === selectedYear) {
                                                      item.style.display = "";
                                                      visibleCount++;
                                                   } else {
                                                      item.style.setProperty("display", "none", "important");
                                                   }
                                             });

                                             const noMessage = document.getElementById("noCompOffMessage12");
                                             if (noMessage) {
                                                   noMessage.classList.toggle("d-none", visibleCount > 0);
                                             }
                                          }, 200);
                                       });
                                       </script>
                                    </div>
                                 </div>
                                 <div class="tab-pane fade" id="modelcopiesTab">
                                    <div class="timeline">
                                       <div class="timeline-item d-flex mb-3">
                                             <div class="me-2">
                                                <div class="dot bg-primary rounded-circle"
                                                   style="width:10px; height:10px;"></div>
                                                <div class="line bg-primary"></div>
                                             </div>
                                             <div class="w-100 d-flex">
                                                <div class="d-flex mb-1 tl-header">
                                                   <img src="https://i.pravatar.cc/24"
                                                         class="rounded-circle me-2">

                                                </div>
                                                <div class="tl_details w-100">
                                                   <span class=" text-primary">Timesheet Overview</span>
                                                   <div class=" d-flex justify-content-between mt-2">
                                                         <span>12/08/2024</span>
                                                         <a href="{{ url('/download-pdf') }}" class="badge_icon">
                                                            <i class="fa-solid fa-cloud-arrow-down"></i>
                                                         </a>
                                                   </div>
                                                </div>

                                             </div>
                                       </div>
                                       <div class="timeline-item d-flex mb-3">
                                             <div class="me-2">
                                                <div class="dot bg-primary rounded-circle"
                                                   style="width:10px; height:10px;"></div>
                                                <div class="line bg-primary"></div>
                                             </div>
                                             <div class="w-100 d-flex">
                                                <div class="d-flex mb-1 tl-header">
                                                   <img src="https://i.pravatar.cc/24"
                                                         class="rounded-circle me-2">

                                                </div>
                                                <div class="tl_details w-100">
                                                   <span class=" text-primary">Timesheet Overview</span>
                                                   <div class=" d-flex justify-content-between mt-2">
                                                         <span>12/08/2024</span>
                                                       <a href="{{ url('/download-pdf') }}" class="badge_icon">
                                                         <i class="fa-solid fa-cloud-arrow-down"></i>
                                                      </a>
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
   </div>
   <div class="tab-pane fade" id="claims" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
</div>


