<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   document.addEventListener("DOMContentLoaded", function () {
      // Set default month/year if not already set
      if (!localStorage.getItem("timesheetMonth") || !localStorage.getItem("timesheetYear")) {
         const now = new Date();
         localStorage.setItem("timesheetMonth", now.getMonth()); // 0-based (Jan = 0)
         localStorage.setItem("timesheetYear", now.getFullYear());
      }
   });
</script>
<script>
   const claimsData = @json($dataClaims);
   document.addEventListener("DOMContentLoaded", function () {
      const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
      const selectedYear = parseInt(localStorage.getItem("timesheetYear"));
      const submitBtn = document.getElementById("submit_icon");
      const save_icon = document.getElementById("save_icon");
      const edit_icon =  document.getElementById("edit_icon");
      const reporting_fileds_data = document.getElementById("reporting_fileds_data");
      
      let hasData = false;
      let hasDraft = false;

      claimsData.forEach(item => {
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
            edit_icon.style.display = "none"; 
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
                              <input type="text" placeholder="Enter Your Corporate Email-id">
                              </li>

                              <li>
                              <input type="text" placeholder="Enter Reporting Manager Email-Id">
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
                              <ul id="claimStatus">
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
                       <div id="backDateClaim">
                         Backdated Claims
                        </div>
                        <div class="modal fade common_modal" data-bs-backdrop="static" data-bs-keyboard="false" id="otherModal" tabindex="-1" aria-labelledby="cExpenseModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered modal-xl">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <div class="model_employee">
                                       <div class="model_emp_img">
                                          <!-- <img src="assets/images/emp-icon1.png" alt="" /> -->
                                       </div>
                                       <span class="model_emp_name">{{ $consultant->emp_name ?? 'N/A' }}</span>
                                    </div>
                                    <button type="button" class="btn-close ml-close-btn" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload()">
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
                                                            <input type="text" placeholder="Invoice number" class="form-control" id="eParticulars" />
                                                            <script>
                                                               const remarkBox = document.getElementById("eParticulars");

                                                               remarkBox.addEventListener("focus", function () {
                                                                  this.placeholder = "";
                                                               });

                                                               remarkBox.addEventListener("blur", function () {
                                                                  if (this.value.trim() === "") {
                                                                     this.placeholder = "Invoice number";
                                                                  }
                                                               });
                                                            </script>
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
                                                   <script>
                                                      const remarkBox1 = document.getElementById("customRemark");

                                                      remarkBox1.addEventListener("focus", function () {
                                                         this.placeholder = "";
                                                      });

                                                      remarkBox1.addEventListener("blur", function () {
                                                         if (this.value.trim() === "") {
                                                            this.placeholder = "Max 200 words are allowed";
                                                         }
                                                      });
                                                   </script>
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
                                                   <button type="button" id="closeBtn" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload()">Close</button>
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
                              if (!deleteBtn) return;

                              e.preventDefault();
                              const id = deleteBtn.dataset.id;
                              const card = deleteBtn.closest(".tab_lists");

                              // ✅ SweetAlert confirmation
                              Swal.fire({
                                 title: "Are you sure?",
                                 text: "This claim will be permanently deleted.",
                                 icon: "warning",
                                 showCancelButton: true,
                                 confirmButtonColor: "#d33",
                                 cancelButtonColor: "#3085d6",
                                 confirmButtonText: "Yes, delete it!",
                                 cancelButtonText: "Cancel"
                              }).then((result) => {
                                 if (result.isConfirmed) {
                                    fetch("{{ route('consultant.claim.delete') }}", {
                                       method: "POST",
                                       headers: {
                                          "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').getAttribute("content"),
                                          "Content-Type": "application/json"
                                       },
                                       body: JSON.stringify({ id: id })
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                       if (data.success) {
                                          card.remove();
                                          Swal.fire("Deleted!", "Your claim has been deleted.", "success");
                                       } else {
                                          Swal.fire("Failed", "Failed to delete the claim.", "error");
                                       }
                                    })
                                    .catch((err) => {
                                       console.error("Error:", err);
                                       Swal.fire("Error", "An error occurred while deleting.", "error");
                                    });
                                 }
                              });
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

                              if (!date) return alert("Please select a date.");
                              if (!type) return alert("Please select an expense type.");
                              if (!particulars) return alert("Please enter particulars.");
                              if (!amount || isNaN(amount) || parseFloat(amount) <= 0) return alert("Please enter a valid amount.");
                              if (!remarks) return alert("Please enter remarks.");
                              
                              const remarksWordCount = remarks.trim().split(/\s+/).length;
                              if (remarksWordCount > 200) return alert("Remarks cannot exceed 200 words.");

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

                              if (type === "Others") {
                                 if (!otherExpense) return alert("Please specify the other expense type.");
                                 if (!locationFrom || !locationTo) return alert("Please enter both From and To locations.");
                              }

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

                              if (editMode && editTarget) {
                                 editTarget.outerHTML = claimHTML;
                              } else {
                                 listContainer.insertAdjacentHTML("beforeend", claimHTML);
                              }

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

                              const routeURL = (editMode && editTarget)
                                 ? "{{ route('consultant.data.save') }}"
                                 : "{{ route('consultant.claim.add') }}";

                              fetch(routeURL, {
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

                                 document.getElementById("eParticulars").value = "";
                                 document.getElementById("eAmount").value = "";
                                 document.getElementById("customRemark").value = "";
                                 document.getElementById("uploadFile").value = "";

                                 editMode = false;
                                 editTarget = null;
                                 document.getElementById("claimForm").style.boxShadow = "";
                                 document.getElementById("claimForm").style.border = "";
                              })
                              .catch(err => console.error("Error:", err));
                           });

                           // Handle edit, delete, preview
                           document.querySelector(".tab_type_list").addEventListener("click", function (e) {
                               if (e.target.closest(".delete-claim")) {
                                   e.preventDefault();
                                  // e.target.closest(".tab_lists").remove();
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
                                   console.log("asdasda",url);
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
                              renderCalendar();  // if calendar is shown for claims
                              fetchClaimStatus();
                           });

                           // Store to claim-specific localStorage on change
                           document.getElementById("monthSelect").addEventListener("change", function () {
                              localStorage.setItem("timesheetMonth", this.value);
                              localStorage.setItem("timesheetYear", document.getElementById("yearSelect").value);
                              fetchClaimStatus();
                           });

                           document.getElementById("yearSelect").addEventListener("change", function () {
                              localStorage.setItem("timesheetYear", this.value);
                              localStorage.setItem("timesheetMonth", document.getElementById("monthSelect").value);
                              fetchClaimStatus();
                           });

                           function fetchClaimStatus() {
                              const month = document.getElementById("monthSelect").value;
                              const year = document.getElementById("yearSelect").value;

                              fetch(`{{ route('get-claim-status') }}?month=${month}&year=${year}`) // <-- updated route
                                 .then(response => response.json())
                                 .then(data => {
                                       updateClaimStatusIcon(data.status);
                                 })
                                 .catch(error => {
                                       console.error("Claim status fetch error:", error);
                                 });
                           }

                           function updateClaimStatusIcon(status) {
                              const statusMap = {
                                 draft: 0,
                                 submitted: 1,
                                 approved: 2,
                                 reviewed: 3,
                                 finalized: 4,
                                 paid: 5
                              };

                              const index = statusMap[status];

                              // 🔹 Claim status update
                              const claimIcons = document.querySelectorAll("#claimStatus li span");
                              claimIcons.forEach(span => span.classList.remove("active"));
                              if (index !== undefined) {
                                 for (let i = 0; i <= index; i++) {
                                    claimIcons[i]?.classList.add("active");
                                 }
                              }

                              // 🔸 TimeSheet status update
                              const timeIcons = document.querySelectorAll("#timeSheetStatus li span");
                              timeIcons.forEach(span => span.classList.remove("active"));
                              if (index !== undefined) {
                                 for (let i = 0; i <= index; i++) {
                                    timeIcons[i]?.classList.add("active");
                                 }
                              }
                           }


                           let calendarEnabled = false;
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
                           
                                       if (day === 0 || day === 6 || !calendarEnabled) {
                                     //  if (day === 0 || day === 6 ) {
                                 
                                          cell.classList.add("disabled");
                                       } else {
                                          cell.addEventListener("click", (e) => showInputDropdown(e, cell, date));
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

                           function generateClaimCodeFromDate(dateStr) {
                              // Remove slashes and spaces, e.g., "02 / 04 / 2025" → "02042025"
                              const clean = dateStr.replace(/\D/g, '');
                              // Create a numeric hash and convert to base36, then uppercase
                              let hash = 0;
                              for (let i = 0; i < clean.length; i++) {
                                 hash = (hash << 5) - hash + clean.charCodeAt(i);
                                 hash |= 0; // Keep 32-bit
                              }
                              return "CF" + Math.abs(hash).toString(36).substring(0, 5).toUpperCase();
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
                                         
                                       document.getElementById("claimForm").reset();
                                       const formattedDate = new Date(date);
                                       const today = new Date();
                                       today.setHours(0, 0, 0, 0);
                                       formattedDate.setHours(0, 0, 0, 0);

                                       // ✅ Prevent future date
                                       if (formattedDate > today) {
                                          alert("Claims cannot be added for a future date.");
                                          return;
                                       }

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

                                        const finalDatenew = generateClaimCodeFromDate(finalDate);
                                        const claimSpan = document.querySelector("#otherModal .ml_duty_time span span");
                                        if (claimSpan) claimSpan.textContent = finalDatenew;

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

                              // ✅ Get/create tag holder
                              let holder = cell.querySelector(".tag-bar-holder");
                              if (!holder) {
                                 holder = document.createElement("div");
                                 holder.className = "tag-bar-holder";
                                 holder.style.position = "absolute";
                                 holder.style.top = "0";
                                 holder.style.left = "0";
                                 holder.style.width = "100%";
                                 holder.style.height = "100%";
                                 holder.style.display = "flex";
                                 holder.style.zIndex = "0"; // keep behind date
                                 holder.style.borderRadius = "inherit";
                                 cell.style.position = "relative";
                                 cell.appendChild(holder);
                              }

                              // ✅ Add the color segment
                              const segment = document.createElement("div");
                              segment.className = `tag-bar-${label} tag-bar`;
                              segment.style.backgroundColor = color;
                              segment.style.flex = "1";
                              segment.style.height = "100%";
                              holder.appendChild(segment);

                              // ✅ Make sure date stays on top
                              const dateLabel = cell.querySelector(".cell-date");
                              if (dateLabel) {
                                 dateLabel.style.zIndex = "1";
                                 dateLabel.style.color = "#000"; // keep it visible
                              }
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


                           
                           function closeAllDropdowns() {
                               document.querySelectorAll(".dropdown").forEach((d) => d.remove());
                           }
                           
                           document.getElementById("monthSelect").addEventListener("change", function () {
                              localStorage.setItem("timesheetMonth", this.value);
                              localStorage.setItem("timesheetYear", document.getElementById("yearSelect").value);
                              fetchClaimStatus();
                              renderCalendar();
                           });

                           document.getElementById("yearSelect").addEventListener("change", function () {
                              localStorage.setItem("timesheetYear", this.value);
                              localStorage.setItem("timesheetMonth", document.getElementById("monthSelect").value);
                              fetchClaimStatus();
                              renderCalendar();
                           });

                           document.addEventListener("click", function (e) {
                               if (!e.target.closest(".calendar-cell")) closeAllDropdowns();
                           });
                           
                           populateMonthYearSelectors();
                           renderCalendar();
                           
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
                                 calendarEnabled = true;
                                 renderCalendar();
                                 Swal.close(); 
                              }, 1500);
                           });

                           function saveClaimData(statusValue = 'Submitted') {
                              const selectedMonth = parseInt(document.getElementById("monthSelect").value); // 0-based
                              const selectedYear = parseInt(document.getElementById("yearSelect").value);

                              const entries = Array.from(document.querySelectorAll(".tab_type_list .tab_lists")).filter(entry => {
                                 const applyOnCell = entry.getAttribute("data-applyoncell");
                                 if (!applyOnCell) return false;

                                 const [day, month, year] = applyOnCell.split(" / ").map(Number);
                                 return month === (selectedMonth + 1) && year === selectedYear;
                              });

                              const promises = [];
                              let hasData = entries.length > 0;

                              entries.forEach(entry => {
                                 const type = entry.getAttribute("data-type");
                                 const applyOnCell = entry.getAttribute("data-applyoncell");

                                 const date = entry.querySelector(".list_date")?.innerText.split(" ").pop().trim() || "";
                                 const particulars = entry.querySelector(".list_particulars")?.innerText.replace("Particulars : ", "").trim() || "";
                                 const amount = entry.querySelector(".list_e_amount")?.innerText.replace("Amount : $", "").trim() || "";
                                 const remarks = entry.querySelector(".edit-claim")?.getAttribute("data-remarks") || "";
                                 const locationFrom = entry.querySelector(".edit-claim")?.getAttribute("data-locationfrom") || "";
                                 const locationTo = entry.querySelector(".edit-claim")?.getAttribute("data-locationto") || "";
                                 const otherExpense = entry.querySelector(".edit-claim")?.getAttribute("data-otherexpense") || "";
                                 const claim_no = document.querySelector("#otherModal .ml_duty_time span span")?.textContent.trim() || "";

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

                                 const formData = new FormData();
                                 formData.append("type", "claims");
                                 formData.append("user_id", "{{ $userData['id'] ?? '' }}");
                                 formData.append("client_id", "{{ $consultant->client_id ?? '' }}");
                                 formData.append("client_name", "{{ $consultant->client_name ?? '' }}");
                                 formData.append("status", statusValue);
                                 formData.append("record", JSON.stringify(recordData));

                                 const promise = fetch("{{ route('consultant.data.save') }}", {
                                       method: "POST",
                                       headers: {
                                          "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').getAttribute("content")
                                       },
                                       body: formData
                                 }).then(res => res.json());

                                 promises.push(promise);
                              });

                              if (!hasData) {
                                 Swal.fire("No Data!", "Does not have data for this month for claim", "info");
                                 return;
                              }

                              Promise.all(promises)
                                 .then(() => {
                                       Swal.fire(
                                          statusValue === 'Submitted' ? "Submitted!" : "Saved!",
                                          `All claim entries ${statusValue.toLowerCase()} successfully!`,
                                          "success"
                                       ).then(() => location.reload());
                                 })
                                 .catch(error => {
                                       console.error("Bulk claim update failed:", error);
                                       Swal.fire("Error", "Some claims failed to save.", "error");
                                 });
                           }

                           document.getElementById("save_icon").addEventListener("click", function (e) {
                              e.preventDefault();
                              saveClaimData("Draft");
                           });

                           document.getElementById("submit_icon").addEventListener("click", function (e) {
                              e.preventDefault();
                              saveClaimData("Submitted");
                           });
                                                                                 
                        </script>
                     </div>
                  </div>
               </div>
                <div class="calendar-legend" style="margin-top: 20px;">
                  <ul style="list-style: none; padding-left: 0; display: flex; gap: 20px; flex-wrap: wrap;">
                     <li style="display: flex; align-items: center; gap: 8px;">
                           <span style="width: 16px; height: 16px; background-color: #EBF9F1; border: 1px solid #ccc; display: inline-block;"></span>
                           Taxi
                     </li>
                     <li style="display: flex; align-items: center; gap: 8px;">
                           <span style="width: 16px; height: 16px; background-color: #FBE7E8; border: 1px solid #ccc; display: inline-block;"></span>
                           Dining
                     </li>
                     <li style="display: flex; align-items: center; gap: 8px;">
                           <span style="width: 16px; height: 16px; background-color: #FF961B; border: 1px solid #ccc; display: inline-block;"></span>
                           Others
                     </li>
                  </ul>
               </div>

            </div>
            <div class="col-xl-4">
               <div class="db_sidebar">
                  <div class="d-flex align-items-center justify-content-between">
                     <ul class="nav nav-tabs" id="clickTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                           <button class="nav-link tab_btn active" data-bs-toggle="tab" data-bs-target="#claimContent123" type="button" role="tab">Claim</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link tab_btn" data-bs-toggle="tab" data-bs-target="#gCopiesContent" type="button" role="tab">Get Copies</button>
                        </li>
                     </ul>
                     </button>
                  </div>
                  <div class="tab-content tab_content_body" id="clickTabsContent">
                     <div class="tab-pane fade show active" id="claimContent123" role="tabpanel" aria-labelledby="claim-tab">
                        <div class="timeline">

                            @php
                              $claimsByDate = [];

                              foreach ($dataClaims as $entry) {
                                 $record = json_decode($entry->record ?? '{}', true);
                                 $date = $record['date'] ?? '';
                                 $claim_no = $record['claim_no'] ?? '';
                                 $record['certificate_path'] = $record['certificate_path'] ?? '';
                                 $status = strtolower($entry->status ?? 'draft');

                                 if ($date && $claim_no) {
                                    $claimsByDate[$date][$claim_no][] = [
                                       'record' => $record,
                                       'status' => $status,
                                    ];
                                 }
                              }
                           @endphp

                           @foreach ($claimsByDate as $date => $claimsGroup)
                              @foreach ($claimsGroup as $claimNo => $claims)
                                 @php
                                    $parsedDate = \Carbon\Carbon::parse($date);
                                    $formattedDate = $parsedDate->format('d/m/Y');
                                    $month = $parsedDate->month;
                                    $year = $parsedDate->year;

                                    $firstClaim = $claims[0]['record'];
                                    $certificate = $firstClaim['certificate_path'] ?? null;
                                    $statusRaw = $claims[0]['status'] ?? 'draft';
                                    $status = ucfirst($statusRaw);
                                    $totalClaims = count($claims);

                                    $badgeClass = match(strtolower($statusRaw)) {
                                       'submitted' => 'badge submitted',
                                       'approved'  => 'badge approved',
                                       'rejected'  => 'badge bg-danger',
                                       'draft'     => 'badge draft',
                                       default     => 'badge bg-light text-dark',
                                    };
                                 @endphp

                                 <div id="ctab" class="timeline-item d-flex mb-3"
                                    data-month="{{ $month }}"
                                    data-year="{{ $year }}">
                                    <div class="me-2">
                                       <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                       <div class="line bg-primary"></div>
                                    </div>
                                    <div>
                                       <div class="d-flex align-items-center mb-1 tl-header">
                                          <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" />
                                          <span class="text-primary fw-bold">
                                             Claim No # - {{ strtoupper($claimNo) }}
                                          </span>
                                       </div>
                                       <div class="tl_details">
                                          <span>{{ $formattedDate }} -</span>
                                          <span class="{{ $badgeClass }}">{{ $status }}</span>
                                          <span>- {{ $totalClaims }} individual {{ $totalClaims > 1 ? 'claims' : 'claim' }} -</span>

                                          @if ($certificate)
                                             <a href="{{ url('/download-pdf') }}" download class="badge_icon">
                                                <i class="fa-solid fa-cloud-arrow-down"></i>
                                             </a>
                                          @endif

                                          <a href="#"
                                             class="badge_icon open-claim-modal"
                                             data-bs-toggle="modal"
                                             data-bs-target="#claimModal"
                                             data-applyoncell="{{ $firstClaim['applyOnCell'] ?? '' }}">
                                             <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              @endforeach
                           @endforeach

                           <p id="noClaimMessage" class="text-muted px-3 py-2 d-none">No entries found for this month</p>

                           <script>
                              document.addEventListener("DOMContentLoaded", function () {
                                 setTimeout(() => {
                                    const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                                    const selectedYear = parseInt(localStorage.getItem("timesheetYear"));

                                    const items = document.querySelectorAll("#ctab");
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

                                    const noMsg = document.getElementById("noClaimMessage");
                                    if (noMsg) noMsg.classList.toggle("d-none", visibleCount > 0);
                                 }, 200);
                              });
                           </script>
                        </div>
                     </div>
                     <script>
                        // ✅ Your full claim collection exposed from backend
                        window.allClaims = @json($dataClaims);

                        // ✅ Attach event on claim open buttons
                        document.querySelectorAll('.open-claim-modal').forEach(button => {
                           button.addEventListener('click', function () {
                              const applyOnCell = this.dataset.applyoncell;
                              const container = document.querySelector('#claimModal .modal_body_inner .container-fluid');
                              
                              // Clear old content
                              container.innerHTML = '';

                              // ✅ Filter claims
                              const claims = window.allClaims.filter(item => {
                                 try {
                                    const record = JSON.parse(item.record || '{}');
                                    return record.applyOnCell === applyOnCell;
                                 } catch (e) {
                                    return false;
                                 }
                              });

                              // ✅ Now add the dynamic header update here
                              const first = claims[0] || {};
                              const record = JSON.parse(first.record || '{}');
                              const claimNo = record.claim_no || 'N/A';
                              const claimStatus = (first.status || 'Draft').toLowerCase();
                              const claimCount = claims.length;

                              // 🔄 Update claim number
                              document.querySelector('.model_c_form h4').textContent = 'Claim Form';
                              document.querySelector('.model_c_form span').textContent = claimNo;

                              // 🔄 Update status button
                              const statusBtn = document.querySelector('.modal-header .draft_btn');
                              if (statusBtn) {
                                 const colorMap = {
                                    draft: { text: 'Draft', bg: '#007bff' },
                                    submitted: { text: 'Submitted', bg: '#f1c40f' },
                                    approved: { text: 'Approved', bg: '#28a745' },
                                    rejected: { text: 'Rejected', bg: '#dc3545' }
                                 };
                                 const color = colorMap[claimStatus] || colorMap['draft'];
                                 statusBtn.innerHTML = `<span class="dot" style="background-color:${color.bg}"></span> ${color.text}`;
                              }

                              // 🔄 Update claim count
                              document.querySelector('.claim_hour_title .text-danger').textContent = `Individual Claims ( ${claimCount} )`;

                              // Update count
                              document.querySelector('.claim_hour_title .text-danger').innerHTML = `Individual Claims ( ${claims.length} )`;
                              const pathParts = window.location.pathname.split('/');
                              const basePath = pathParts.length > 1 ? '/' + pathParts[1] : '';
                              const baseUrl = window.location.origin + basePath;

                              claims.forEach(c => {
                                 const r = JSON.parse(c.record || '{}');
                                 const html = `
                                    <div class="row tabs_type_row mb-4">
                                       <div class="col-md-6 p-0">
                                          <div class="top_ic_details detial_row">
                                             <div class="d_n_t">
                                                <span class="fw-bold">Date & Time</span>
                                                <span>${r.date || '-'}</span>
                                             </div>
                                             <div class="e_n_t">
                                                <span class="fw-bold">Expense Type </span>
                                                <span>${r.expenseType || '-'}</span>
                                             </div>
                                             <div class="e_amt">
                                                <span class="fw-bold">Amount</span>
                                                <span>$ ${r.amount || '0.00'}</span>
                                             </div>
                                             <div class="u_icons">

                                                <a href="#" class="badge_icon trigger-claim-edit"
                                                   data-id="${c.id}"
                                                   data-date="${r.date || ''}"
                                                   data-type="${r.expenseType || ''}"
                                                   data-particulars="${r.particulars || ''}"
                                                   data-amount="${r.amount || ''}"
                                                   data-remarks="${r.remarks || ''}"
                                                   data-locationfrom="${r.locationFrom || ''}"
                                                   data-locationto="${r.locationTo || ''}"
                                                   data-otherexpense="${r.otherExpense || ''}">
                                                   <i class="fa-solid fa-pen-nib"></i>
                                                </a>

                                                <a href="#" class="badge_icon trigger-claim-delete"
                                                   data-id="${c.id}">
                                                   <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                             </div>
                                          </div>
                                          <div class="bottom_ic_details detial_row">
                                             <div class="e_particular">
                                                <span class="fw-bold">Particulars</span>
                                                <span>${r.particulars || '-'}</span>
                                             </div>
                                             ${r.locationFrom ? `
                                             <div class="e_location_from">
                                                <span class="fw-bold">Location From</span>
                                                <span>${r.locationFrom}</span>
                                             </div>
                                             ` : ''}

                                             ${r.locationTo ? `
                                             <div class="e_location_to">
                                                <span class="fw-bold">Location To</span>
                                                <span>${r.locationTo}</span>
                                             </div>
                                             ` : ''}

                                          </div>
                                       </div>
                                       <div class="col-md-3 p-0">
                                          <div class="e_invoice_box">
                                             <div class="e_invoice_box_inner">
                                                <img src="${baseUrl}/${r.certificate_path || 'public/assets/latest/images/no-data-2.png'}" />
                                                <p class="mt-2">
                                                   <span>Add Invoice</span>
                                                </p>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-3 p-0">
                                          <div class="e_remark_box">
                                             <div class="e_remark_box_inner">
                                                <span class="fw-bold">Remarks</span>
                                                <p class="mt-2">
                                                   <span>${r.remarks || ''}</span>
                                                </p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>`;

                                 container.insertAdjacentHTML('beforeend', html);
                              });
                           });
                        });
                     </script>
                     <script>
                           document.addEventListener("click", function (e) {
                              const btn = e.target.closest(".trigger-claim-edit");
                              if (btn) {
                                 e.preventDefault();

                                 // 🟢 Fill modal form fields from data attributes
                                 document.getElementById("eDate").value = btn.dataset.date || "";
                                 document.getElementById("expenseType").value = btn.dataset.type || "";
                                 document.getElementById("eParticulars").value = btn.dataset.particulars || "";
                                 document.getElementById("eAmount").value = btn.dataset.amount || "";
                                 document.getElementById("customRemark").value = btn.dataset.remarks || "";
                                 document.getElementById("eLocationFrom").value = btn.dataset.locationfrom || "";
                                 document.getElementById("eLocationTo").value = btn.dataset.locationto || "";
                                 document.getElementById("otherExpense").value = btn.dataset.otherexpense || "";

                                 // 🟢 Dispatch change for dropdowns (if dependent)
                                 document.getElementById("expenseType").dispatchEvent(new Event("change"));

                                 // 🟢 Optional: highlight form if needed
                                 const form = document.getElementById("claimForm");
                                 if (form) {
                                    form.style.boxShadow = "0 0 10px #ff7f50";
                                    form.style.border = "2px solid #ff7f50";
                                 }

                              // 🟢 Hide currently open claimModal (safely)
                                 const claimModalInstance = bootstrap.Modal.getInstance(document.getElementById("claimModal"));
                                 if (claimModalInstance) claimModalInstance.hide();

                                 // 🟢 Show otherModal
                                 const otherModal = new bootstrap.Modal(document.getElementById("otherModal"));
                                 otherModal.show();

                                 // Optional: track for editing
                                 window.editMode = true;
                                 window.editTarget = btn.closest(".tabs_type_row");
                              }
                           });
                     </script>

                     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                     <script>
                        document.addEventListener("click", function (e) {
                           const btn = e.target.closest(".trigger-claim-delete");
                           if (!btn) return;

                           e.preventDefault();

                           const id = btn.dataset.id;
                           const card = btn.closest(".tabs_type_row"); // or .tab_lists if outer wrapper is that

                           Swal.fire({
                              title: "Are you sure?",
                              text: "This claim will be permanently deleted.",
                              icon: "warning",
                              showCancelButton: true,
                              confirmButtonColor: "#d33",
                              cancelButtonColor: "#3085d6",
                              confirmButtonText: "Yes, delete it!",
                              cancelButtonText: "Cancel"
                           }).then((result) => {
                              if (result.isConfirmed) {
                                 fetch("{{ route('consultant.claim.delete') }}", {
                                    method: "POST",
                                    headers: {
                                       "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').getAttribute("content"),
                                       "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify({ id: id })
                                 })
                                 .then(res => res.json())
                                 .then(data => {
                                    if (data.success) {
                                       card.remove();
                                       Swal.fire("Deleted!", "The claim has been deleted.", "success");
                                    } else {
                                       Swal.fire("Failed", "Could not delete the claim.", "error");
                                    }
                                 })
                                 .catch(() => {
                                    Swal.fire("Error", "An error occurred while deleting.", "error");
                                 });
                              }
                           });
                        });
                     </script>



                     <div class="tab-pane fade" id="gCopiesContent" role="tabpanel" aria-labelledby="gCopies-tab">
                        <div class="db_sidebar_title_box">
                           <span>Total Work Hours</span>
                           <span>Total Work Hours</span>
                        </div>
                        <form id="claimDownloadForm">
                           <div class="timeline tile_shape_box">
                              @php
                                 $groupedClaims = [];

                                 foreach ($dataClaims as $claim) {
                                    $record = json_decode($claim->record ?? '{}', true);
                                    $claimNo = $record['claim_no'] ?? null;

                                    if ($claimNo) {
                                       if (!isset($groupedClaims[$claimNo])) {
                                          $groupedClaims[$claimNo] = [
                                             'claim_no' => $claimNo,
                                             'amount' => 0,
                                             'items' => []
                                          ];
                                       }

                                       $groupedClaims[$claimNo]['amount'] += (float) ($record['amount'] ?? 0);
                                       $groupedClaims[$claimNo]['items'][] = $record;
                                    }
                                 }
                              @endphp

                              @if(count($groupedClaims) === 0)
                                 <p class="text-muted px-3 py-2">No entries found for this month</p>
                              @endif

                              @foreach($groupedClaims as $claim)
                                 @php
                                    $claimNo = $claim['claim_no'];
                                    $amount = number_format($claim['amount'], 2);
                                    $count = str_pad(count($claim['items']), 2, '0', STR_PAD_LEFT);
                                 @endphp

                                 <div class="timeline-item d-flex mb-3">
                                    <div class="select_box">
                                       <input type="checkbox"
                                          class="claim-checkbox"
                                          value="{{ $claimNo }}">
                                    </div>

                                    <div class="timeline_right">
                                       <div class="d-flex align-items-center mb-3 tl-header">
                                          <span class="c_form_no">Claim Form : #{{ strtoupper($claimNo) }}</span>
                                          <span class="c_amount">Amount : $ {{ $amount }}</span>
                                       </div>
                                       <div class="d-flex align-items-center tl-header">
                                          <span class="ind_claim">individual claims ( {{ $count }} )</span>
                                          <span>
                                             <a href="{{ url('/download-pdf') }}?claim={{ $claimNo }}" class="badge_icon" download>
                                                <i class="fa-solid fa-cloud-arrow-down"></i>
                                             </a>
                                             <!-- <a href="javascript:void(0)" class="badge_icon open-claim-modal"
                                                data-bs-toggle="modal"
                                                data-bs-target="#claimModal"
                                                data-claim="{{ $claimNo }}">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                             </a> -->
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              @endforeach
                           </div>

                           @if(count($groupedClaims) > 0)
                              <div class="g_cpoies_submit_btn r_update_btn">
                                 <button type="button" id="downloadSelected">Submit</button>
                              </div>
                           @endif

                           
                        </form>

                        <script>
                           document.getElementById('downloadSelected').addEventListener('click', function () {
                              const checkboxes = document.querySelectorAll('.claim-checkbox:checked');

                              if (checkboxes.length === 0) {
                                 alert("Please select claims.");
                                 return;
                              }

                              checkboxes.forEach(checkbox => {
                                 const claimNo = checkbox.value;

                                 const link = document.createElement("a");
                                 link.href = `{{ url('/download-pdf') }}?claim=${claimNo}`;
                                 link.download = '';
                                 document.body.appendChild(link);
                                 link.click();
                                 document.body.removeChild(link);
                              });
                           });
                        </script>
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
                                    <span>1234</span>
                                 </div>
                              </div>
                              <a href="#" class="draft_btn"><span class="dot"></span> Draft</a>
                              <div class="claim_hour_title">
                                 <span class="text-danger me-4 fw-bold">Individual Claims ( 03 )</span>
                                 <!-- <span class="fw-bold">Total Work Hours</span> -->
                              </div>
                              <button type="button" class="btn-close ml-close-btn" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload()">
                                 <i class="fa-solid fa-xmark"></i>
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="step_icons mb-4">
                                 <div class="calender-wrap-parent" style="box-shadow:none">
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
                                 </div>
                               
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
                     <div class="timeline" id="remarkTimeline">
                        @php
                           $hasData = false;
                        @endphp

                        @foreach ($dataClaims as $item)
                           @php
                              $record = json_decode($item->record ?? '{}', true);
                              $date = $record['date'] ?? null;
                              $parsed = $date ? \Carbon\Carbon::parse($date) : null;
                           @endphp

                           @if ($parsed)
                              @php
                                 $hasData = true;
                                 $month = $parsed->month;
                                 $year = $parsed->year;
                              @endphp

                              <div class="remark-item mb-3"
                                 data-month="{{ $month }}"
                                 data-year="{{ $year }}">
                                 <div class="d-flex">
                                    <div class="me-2 text-primary">
                                       <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                       <div class="line bg-primary"></div>
                                    </div>
                                    <div>
                                       <div class="d-flex align-items-center mb-1">
                                          <img src="{{ $item->profile_image ?? 'https://i.pravatar.cc/24' }}" class="rounded-circle me-2" title="{{ $item->user_name ?? 'User' }}" />
                                          <small class="text-muted">
                                             Claim No # - {{ $record['claim_no'] ?? '' }} On {{ $parsed->format('d/m/Y') }}
                                          </small>
                                       </div>
                                       <p>{{ $record['remarks'] ?? '' }}</p>
                                    </div>
                                 </div>
                              </div>
                           @endif
                        @endforeach

                        <p id="noRemarksMessage" class="text-muted px-3 py-2 d-none">No entries found for this month</p>
                     </div>

                     <script>
                     document.addEventListener("DOMContentLoaded", function () {
                        setTimeout(() => {
                           const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                           const selectedYear = parseInt(localStorage.getItem("timesheetYear"));

                           const items = document.querySelectorAll("#remarkTimeline .remark-item");
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

                           const msg = document.getElementById("noRemarksMessage");
                           if (msg) msg.classList.toggle("d-none", visibleCount > 0);
                        }, 200);
                     });
                     </script>
                  </div>
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
                                <div class="timeline" id="remarkTimeline123">
                                    @php
                                       $hasData = false;
                                    @endphp

                                    @foreach ($dataClaims as $item)
                                       @php
                                          $record = json_decode($item->record ?? '{}', true);
                                          $date = $record['date'] ?? null;
                                          $parsed = $date ? \Carbon\Carbon::parse($date) : null;
                                       @endphp

                                       @if ($parsed)
                                          @php
                                             $hasData = true;
                                             $month = $parsed->month;
                                             $year = $parsed->year;
                                          @endphp

                                          <div class="remark-item mb-3"
                                             data-month="{{ $month }}"
                                             data-year="{{ $year }}">
                                             <div class="d-flex">
                                                <div class="me-2 text-primary">
                                                   <div class="dot bg-primary rounded-circle" style="width: 10px; height: 10px;"></div>
                                                   <div class="line bg-primary"></div>
                                                </div>
                                                <div>
                                                   <div class="d-flex align-items-center mb-1">
                                                      <img src="{{ $item->profile_image ?? 'https://i.pravatar.cc/24' }}" class="rounded-circle me-2" title="{{ $item->user_name ?? 'User' }}" />
                                                      <small class="text-muted">
                                                         Claim No # - {{ $record['claim_no'] ?? '' }} On {{ $parsed->format('d/m/Y') }}
                                                      </small>
                                                   </div>
                                                   <p>{{ $record['remarks'] ?? '' }}</p>
                                                </div>
                                             </div>
                                          </div>
                                       @endif
                                    @endforeach

                                    <p id="noRemarksMessage123" class="text-muted px-3 py-2 d-none">No entries found for this month</p>
                                 </div>

                                 <script>
                                 document.addEventListener("DOMContentLoaded", function () {
                                    setTimeout(() => {
                                       const selectedMonth = parseInt(localStorage.getItem("timesheetMonth")) + 1;
                                       const selectedYear = parseInt(localStorage.getItem("timesheetYear"));

                                       const items = document.querySelectorAll("#remarkTimeline123 .remark-item");
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

                                       const msg = document.getElementById("noRemarksMessage123");
                                       if (msg) msg.classList.toggle("d-none", visibleCount > 0);
                                    }, 200);
                                 });
                                 </script> 
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