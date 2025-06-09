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
                  @php
                     $nationalityCount = $consultants->where('residential_status', 'SR')->count();
                     $prCount = $consultants->where('residential_status', 'SPR')->count();
                     $epCount = $consultants->where('residential_status', 'EP')->count();
                     $ppCount = $consultants->where('residential_status', 'PP')->count(); // optional if needed
                  @endphp
                  <h4>My Dashboard</h4>
                  <div class="hr-my-dashboard">
                     <div class="total">Residential Status: <span class="text-primary fw-bold">{{ count($consultants) }}</span></div>
                     <div class="d-flex justify-content-center gap-5">
                        <div class="info">
                           <p><span class="green">Nationality: {{ $nationalityCount }}</span></p>
                           <p><span class="orange">Permanent Resident: {{ $prCount }}</span></p>
                           <p><span class="red">Employment Pass holders: {{ $epCount }}</span></p>
                           <p><span class="pink">Passport Holders: {{ $ppCount }}</span></p>

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
                  @php
                     $totalWorking = $consultants->where('status', 'Inactive')->count(); // Red
                     $totalNew = $consultants->where('status', 'Active')->count();       // Blue
                     $totalRelieving = $consultants->where('status', 'Notice Period')->count(); // Gray
                  @endphp
                  <ul>
                     <li>
                        <div class="hr-dashboard-activity-card">
                           <div class="activity-card-icon">
                              <img src="{{ asset('public/assets/images/activity-card-icon-1.png')}}" class="img-fluid">
                           </div>
                           <div class="activity-card-text">
                              <h5>{{ $totalWorking }}</h5>
                              <p>Total Number of employees</p>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="hr-dashboard-activity-card">
                           <div class="activity-card-icon">
                              <img src="{{ asset('public/assets/images/activity-card-icon-2.png')}}" class="img-fluid">
                           </div>
                           <div class="activity-card-text">
                              <h5>{{ $totalNew }}</h5>
                              <p>Total Number of New Employees</p>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="hr-dashboard-activity-card">
                           <div class="activity-card-icon">
                              <img src="{{ asset('public/assets/images/activity-card-icon-3.png')}}" class="img-fluid">
                           </div>
                           <div class="activity-card-text">
                              <h5>{{ $totalRelieving }}</h5>
                              <p>Total Number of Relieving Employees</p>
                           </div>
                        </div>
                     </li>

                      <li>
                        <div class="hr-dashboard-activity-card">
                           <div class="activity-card-icon">
                              <img src="{{ asset('public/assets/latest/images/activity-card-icon-4.png')}}" class="img-fluid">
                           </div>
                           <div class="activity-card-text">
                              <h5>{{ $totalRelieving }}</h5>
                              <p>Total Number Of Future Joining Employees</p>
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
<!-- <script src="{{ asset('public/assets/js/graphs.js')}}"></script> -->

   
<script>
const createPieChart = (ctx, labels, data, backgroundColors) => {
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        data: data,
        backgroundColor: backgroundColors,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
};

const residenceEl = document.getElementById('residenceChart');
if (residenceEl) {
  const hrchart = residenceEl.getContext('2d');

  const labels = ['Nationality', 'Permanent Resident', 'Employment Pass holders', 'Passport Holders'];
  const data = [
    {{ $nationalityCount ?? 0 }},
    {{ $prCount ?? 0 }},
    {{ $epCount ?? 0 }},
    {{ $ppCount ?? 0 }}
  ];
  const backgroundColors = ['#28a745', '#fd7e14', '#dc3545', '#007bff'];

  const total = data.reduce((a, b) => a + b, 0);

  if (total > 0) {
    createPieChart(hrchart, labels, data, backgroundColors);
  } else {
    // Show an empty/blank chart or maybe a placeholder dataset with 0
    createPieChart(hrchart, ['No Data'], [1], ['#dcdcdc']);
  }
}
 </script>
