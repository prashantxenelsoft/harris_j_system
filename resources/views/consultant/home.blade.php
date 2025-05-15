<section class="add-consultant-parent">
    <section class="login-as-consultant">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-dashboard-top-bar">
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
                            <div class="date-container">
                                <input id="date" type="text" />
                                <i class="date-icon fa fa-calendar" aria-hidden="true"></i>
                                <span class="date-text">August - 2024</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pb-5">
                <div class="col-lg-9 col-xxl-8">
                    <div class="consultant-dashboard-left-col">
                        <div class="dashboard-consultant-wrapper-graph">
                            <div class="graph-one-col-dashboard-consultant">
                                <div class="total-label">
                                    Total Timesheets: <span class="total-count">290</span>
                                </div>
                                <canvas id="timesheetChart"></canvas>
                                
                                <div class="labels">
                                    <div class="label-item submitted">Submitted: 290</div>
                                    <div class="label-item approved">Approved: 240</div>
                                    <div class="label-item rejected">Rejected: 0</div>
                                </div>
                            </div>

                            <div class="graph-two-col-dashboard-consultant">
                                <div class="title">
                                    Working log:
                                    <span class="log-count">168 hrs</span>
                                </div>
                                
                                <canvas id="workingChart" width="180" height="180"></canvas>
                                
                                <div class="labels">
                                    <div class="label-item forecasted">Hours Forecasted: 168</div>
                                    <div class="label-item logged">Hours Logged: 168</div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="claim-summary-dashboard-consultant">
                            <div class="claim-header-consultant">
                                <h4>
                                    Claims Summary
                                </h4>

                                <div class="view-all-cta">
                                    <a href="#">
                                        <!-- <img src="assets{{ asset('public/assets/images/save-icon-circle.png"> -->
                                        View All
                                    </a>
                                </div>
                            </div>

                            <div class="claim-form-conusltant-dashboard">
                                <div class="heading-wrap-claim">
                                    <h3>Claim Form</h3>
                                    <h6>#CLF08982</h6>
                                </div>

                                <div class="draft-badge-wrap">
                                    <div class="draft-badge">
                                        <span></span>
                                        Draft
                                    </div>
                                </div>

                                <div class="claim-tab-dummy-consulatnt">
                                    <a href="#">
                                        Individual Claims ( 03 )
                                    </a>

                                    <a href="#">
                                        Total Work Hours
                                    </a>
                                </div>
                            </div>

                            <div class="table-dashboard-consultant">

                                <div class="expense-card">
                                    <div class="expense-header">
                                    <div class="expense-item">
                                        <strong>Date & Time</strong>
                                        <span>Sunday, 5th Aug, 2024</span>
                                    </div>
                                    <div class="expense-item">
                                        <strong>Expense Type</strong>
                                        <span>Taxi</span>
                                    </div>
                                    <div class="expense-item">
                                        <strong>Amount</strong>
                                        <span>$ 250.34</span>
                                    </div>
                                    <div class="actions">
                                    
                                    </div>
                                    </div>
                                
                                    <div class="expense-body">
                                    <div class="expense-item">
                                        <strong>Particulars</strong>
                                        <span>PA082073NU978</span>
                                    </div>
                                    <div class="expense-item">
                                        <strong>Location From</strong>
                                        <span>Jurong East</span>
                                    </div>
                                    <div class="expense-item">
                                        <strong>Location To</strong>
                                        <span>Changi</span>
                                    </div>
                                    <div class="actions">
                                        
                                    </div>
                                    </div>
                                </div> 

                                <div class="dashboard-remark-section">
                                    <h4>Remarks</h4>
                                    <p>Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's . Lorem Ipsum has been the industry's .</p>
                                </div>

                            </div>

                        
                        
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-xxl-4">
                    <div class="timesheet-overview-consultant">
                        <div class="timeline-container">
                            <div class="timeline-title"><i class="fas fa-caret-down"></i> Encore Films</div>
                        
                            <div class="timeline-item">
                            <div class="timeline-dot dot-blue"></div>
                            <div class="timeline-line blue-timeline"></div>
                            <div class="timeline-content">
                                <h4>Timesheet Overview</h4>
                                <div class="badge blue">Draft</div>
                            </div>
                            </div>
                        
                            <div class="timeline-item">
                            <div class="timeline-dot dot-green"></div>
                            <div class="timeline-line green-timeline"></div>
                            <div class="timeline-content">
                                <h4>Timesheet Overview</h4>
                                <div class="badge green">Auto Approved</div>
                            </div>
                            </div>
                        
                            <div class="timeline-item">
                            <div class="timeline-dot dot-yellow"></div>
                            <div class="timeline-line yellow-timeline"></div>
                            <div class="timeline-content">
                                <h4>Timesheet Overview</h4>
                                <div class="badge yellow">Submitted</div>
                            </div>
                            </div>
                        
                            <div class="timeline-item">
                            <div class="timeline-dot dot-blue"></div>
                            <div class="timeline-line blue-timeline"></div>
                            <div class="timeline-content">
                                <h4>Timesheet Overview</h4>
                                <div class="badge blue">Draft</div>
                            </div>
                            </div>
                        
                            <div class="timeline-item">
                            <div class="timeline-dot dot-green"></div>
                            <div class="timeline-line green-timeline"></div>
                            <div class="timeline-content">
                                <h4>Timesheet Overview</h4>
                                <div class="badge green">Auto Approved</div>
                            </div>
                            </div>
                        
                            <div class="timeline-item">
                            <div class="timeline-dot dot-yellow"></div>
                            <div class="timeline-content">
                                <h4>Timesheet Overview</h4>
                                <div class="badge yellow">Submitted</div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>