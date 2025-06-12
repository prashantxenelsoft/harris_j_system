<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                           $filtered = $consultants->filter(fn($c) => $c->client_id == $client->id);
                           $inactive = $filtered->where('status', 'Inactive')->count();
                           $active = $filtered->where('status', 'Active')->count();
                           $notice = $filtered->where('status', 'Notice Period')->count();
                           $total = $filtered->count();
                        @endphp

                        <button class="nav-link {{ $isActive }}"
                           id="v-pills-{{ $tabId }}-tab"
                           data-bs-toggle="pill"
                           data-bs-target="#v-pills-{{ $tabId }}"
                           type="button"
                           role="tab"
                           aria-controls="v-pills-{{ $tabId }}"
                           aria-selected="{{ $isActive === 'active' ? 'true' : 'false' }}"
                           data-client-id="{{ $client->id }}">
                           <div class="clients-tab-switch">
                              <div class="clients-img-name">
                                 <img src="https://i.pravatar.cc/24" class="rounded-circle me-2" title="{{ $client->serving_client }}" />
                                 <h6 class="{{ $isActive ? 'fw-bold' : '' }} truncate-text">{{ Str::limit($client->serving_client, 16) }}</h6>
                              </div>
                              <div class="clients-numbers-tab-switch">
                                 <span>
                                    (<em style="color: red;">{{ $inactive }}</em>,
                                     <em style="color: blue;">{{ $active }}</em>,
                                     <em style="color: gray;">{{ $notice }}</em>) 
                                     <b>/ {{ $total }}</b>
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
                     <div class="search-box">
                        <input type="text" placeholder="Search ..." />
                     </div>
                     <div class="buttons-reports">
                        <a href="#"><img src="{{ asset('public/assets/images/download-icon.png')}}" class="img-fluid"> Download</a>
                        <a href="#"><img src="{{ asset('public/assets/images/msg-iconn.png')}}" class="img-fluid">Email</a>
                     </div>
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
                  <tbody id="reportTableBody">
                     <tr>
                        <td colspan="6" class="text-center">Select a client to view reports.</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

{{-- Pass PHP data to JS --}}
<script>
   window.allRemarks = @json($remarks);
   window.allConsultants = @json($consultants->groupBy('client_id'));
</script>

<script>
   $(document).ready(function () {
      $('.nav-link').on('click', function () {
         const clientId = $(this).data('client-id');
         const consultants = window.allConsultants[clientId] || [];
         const consultantIds = consultants.map(c => c.id);

         const matchedRemarks = window.allRemarks.filter(r =>
            consultantIds.includes(r.consultant_id)
         );

         const tbody = $('#reportTableBody');
         tbody.empty();
         const storageBaseUrl = "{{ asset('storage/app/public/') }}";

         if (matchedRemarks.length === 0) {
            tbody.html(`<tr><td colspan="6" class="text-danger text-center">Report not found</td></tr>`);
         } else {
            matchedRemarks.forEach((item, index) => {
               const rawLink = item.pdf_link.replace(/^storage\//, '');
               const fileLink = `${storageBaseUrl}/${rawLink}`;
               tbody.append(`
                  <tr>
                     <td>${(index + 1).toString().padStart(2, '0')}</td>
                     <td>${item.remark}</td>
                     <td>${formatDate(item.created_at)}</td>
                     <td>${item.given_by ?? 'System'}</td>
                     <td>${formatDate(item.updated_at)}</td>
                     <td>
                        <div class="report-table-col-btn-group">
                           <button class="delete-btn">
                              <img src="{{ asset('public/assets/images/delete-icon-2.png')}}">
                           </button>
                           <a href="${fileLink}" download class="csv-btn">Download CSV</a>
                        </div>
                     </td>
                  </tr>
               `);
            });
         }
      });

      function formatDate(datetime) {
         const d = new Date(datetime);
         return `${d.getDate()}/${d.getMonth()+1}/${d.getFullYear()}<br>${d.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}`;
      }
   });
</script>
