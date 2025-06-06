<div class="reports-tab-inner">
   <div class="container mw-100 p-0 m-0">
      <div class="row">
         <div class="col-lg-4 col-xl-3">
            <div class="reports-consultancy-listing-wrapper">
               <h5>Consultancy Lisiting</h5>
               <div class="clients-tabs-consultants pt-3">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                     @foreach ($clients as $index => $client)
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

                        <button class="nav-link {{ $isActive }}"
                           id="v-pills-{{ $tabId }}-tab"
                           data-client-id="{{ $client->id }}"
                           data-bs-toggle="pill"
                           data-bs-target="#v-pills-{{ $tabId }}"
                           type="button"
                           role="tab"
                           aria-controls="v-pills-{{ $tabId }}"
                           aria-selected="{{ $isActive ? 'true' : 'false' }}">
                           
                           <div class="clients-tab-switch">
                                 <div class="clients-img-name">
                                    <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="{{ $client->serving_client }}" />
                                    <h6 class="{{ $isActive ? 'fw-bold' : '' }} truncate-text">{{ $client->serving_client }}</h6>
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
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-8 col-xl-9">
            <div class="reports-inner-col">
               <div class="header">
                  <h4>Reports</h4>
                  <div class="search-box-wrapper">
                     <div class="search-box"> <input type="text" placeholder="Search ..." /> </div>
                     <div class="buttons-reports"> <a href="#"><img src="{{ asset('public/assets/images/download-icon.png')}}" class="img-fluid"> Download</a> <a href="#"><img src="{{ asset('public/assets/images/msg-iconn.png')}}" class="img-fluid">Email</a> </div>
                  </div>
               </div>
               <table>
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Report</th>
                        <th>Created</th>
                        <th>Created By</th>
                        <th>Modified On</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>01</td>
                        <td>Per Consultancy Data Summary</td>
                        <td>1/3/2025<br />2:41:42 PM</td>
                        <td>Lorem Ipsum</td>
                        <td>2/3/2025<br />2:41:42 PM</td>
                        <td>
                           <div class="report-table-col-btn-group"> <button class="delete-btn"><img src="{{ asset('public/assets/images/delete-icon-2.png')}}"></button> <button class="csv-btn">Download CSV</button> </div>
                        </td>
                     </tr>
                     <tr>
                        <td>02</td>
                        <td>All Consultancy Data Summary</td>
                        <td>1/3/2025<br />2:41:42 PM</td>
                        <td>Lorem Ipsum</td>
                        <td>2/3/2025<br />2:41:42 PM</td>
                        <td>
                           <div class="report-table-col-btn-group"> <button class="delete-btn"><img src="{{ asset('public/assets/images/delete-icon-2.png')}}"></button> <button class="csv-btn">Download CSV</button> </div>
                        </td>
                     </tr>
                     <tr>
                        <td>03</td>
                        <td>Offboarded Consultancy Data Summary</td>
                        <td>1/3/2025<br />2:41:42 PM</td>
                        <td>Lorem Ipsum</td>
                        <td>2/3/2025<br />2:41:42 PM</td>
                        <td>
                           <div class="report-table-col-btn-group"> <button class="delete-btn"><img src="{{ asset('public/assets/images/delete-icon-2.png')}}"></button> <button class="csv-btn">Download CSV</button> </div>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>