<div class="hr-inner-tab">
   <div class="add-consultant-clients-wrapper">
      <h4>Turn – in – rate : 90 / 100</h4>
      <h4>Client – Wise Dossiers</h4>
      <div class="clients-tabs-consultants pt-3">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
         @forelse ($clients as $index => $client)
           @php
               $isActive = $index === 0 ? 'active' : '';
               $tabId = 'client-' . $client->id;

               // ✅ Filter consultants by client ID (make sure consultants.select_client is numeric)
               $filtered = $consultants->filter(fn($c) => $c->client_id == $client->id);

               $inactive = $filtered->where('status', 'Inactive')->count();
               $active = $filtered->where('status', 'Active')->count();
               $notice = $filtered->where('status', 'Notice Period')->count();
               $total = $filtered->count();
            @endphp
            <button 
                  class="nav-link"
            >
                  <div class="clients-tab-switch">
                     <div class="clients-img-name">
                        <img src="{{ asset('public/assets/images/client-icon-' . (($index % 4) + 1) . '.png') }}" class="img-fluid" alt="Client Icon">
                        <h6>{{ $client->serving_client ?? $client->name ?? 'Client' }}</h6>
                     </div>
                         <div class="clients-numbers-tab-switch">
                              <span>
                                 (
                                 <em style="color: red;">{{ $inactive }}</em>,
                                 <em style="color: blue;">{{ $active }}</em>,
                                 <em style="color: gray;">{{ $notice }}</em>
                                 ) <b>/ {{ $total }}</b>
                              </span>
                           </div>
                  </div>
            </button>
         @empty
            <p class="text-muted px-3">No clients found.</p>
         @endforelse
</div>


      </div>
      <div class="clients-consultants-tags">
         <ul>
            <li>
               <span></span> 
               <p>Working Employees</p>
            </li>
            <li>
               <span></span> 
               <p>New Onboardings</p>
            </li>
            <li>
               <span></span> 
               <p>Relieving Employees</p>
            </li>
         </ul>
      </div>
   </div>
   <div class="hr-consultants-clients-tabs-content">
      <div class="tab-content" id="v-pills-tabContent">
         <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <div class="hr-dashboard-wrapper">
               <div class="hr-my-dashboard-wrapper">
                  <h4>My Dashboard</h4>
                  <div class="hr-my-dashboard">
                     <div class="total">Residential Status: <span>300</span></div>
                     <div class="d-flex justify-content-center gap-5">
                        <div class="info">
                           <p><span class="green">Nationality: 200</span></p>
                           <p><span class="orange">Permanent Resident: 20</span></p>
                           <p><span class="red">Employment Pass holders</span></p>
                        </div>
                        <canvas id="residenceChart"></canvas>
                     </div>
                  </div>
               </div>
               <div class="hr-dashboard-my-activities">
                  <div class="d-flex justify-content-between">
                     <h4>Total Activity</h4>
                     <div class="select-activity-hr-dashboard">
                        <select>
                           <option> Monthly </option>
                           <option> Monthly </option>
                        </select>
                     </div>
                  </div>
                  <ul>
                     <li>
                        <div class="hr-dashboard-activity-card">
                           <div class="activity-card-icon"> <img src="{{ asset('public/assets/images/activity-card-icon-1.png')}}" class="img-fluid"> </div>
                           <div class="activity-card-text">
                              <h5>200</h5>
                              <p>Total Number of employees</p>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="hr-dashboard-activity-card">
                           <div class="activity-card-icon"> <img src="{{ asset('public/assets/images/activity-card-icon-2.png')}}" class="img-fluid"> </div>
                           <div class="activity-card-text">
                              <h5>200</h5>
                              <p>Total Number of New Employees </p>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="hr-dashboard-activity-card">
                           <div class="activity-card-icon"> <img src="{{ asset('public/assets/images/activity-card-icon-3.png')}}" class="img-fluid"> </div>
                           <div class="activity-card-text">
                              <h5>200</h5>
                              <p>Total Number of Relieving Employees</p>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('public/assets/js/graphs.js')}}"></script>
