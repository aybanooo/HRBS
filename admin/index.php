<?php
  require_once("customFiles/php/directories/directories.php");
  require_once __F_LOGIN_HANDLER__;

  // Redirect to login page if token is invalid
  if (!isTokenValid()) {
    include("admin-login.php");
    exit();
  }
  session_start();
  setupUserSession();
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <?php 
    include __F_HEAD_CONTENTS__;
  ?>



  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ion Icons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- jsGrid -->
  <link rel="stylesheet" href="plugins/jsgrid/jsgrid.min.css">
  <link rel="stylesheet" href="plugins/jsgrid/jsgrid-theme.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Tempus Dominus -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css">
  <!-- Daterange Picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- Special Style-->
  <link rel="stylesheet" href="customFiles/specialStyle.css">
  <link rel="stylesheet" href="customFiles/overrideStyle.css">
  <style>
    #table-reservation tbody > tr:not(tr.child) {
      text-align: center;
    }

    #table-reservation tbody > tr:not(.child) td:nth-child(n+2):hover {
      cursor: pointer;
    }

    #table-reservation tbody > tr:not(.child):hover {
      color: var(--primary);
    }

    body .bootstrap-datetimepicker-widget.dropdown-menu.float-right:after {
      border-bottom-color: var(--light) !important;
    }

    body.dark-mode .bootstrap-datetimepicker-widget.dropdown-menu.float-right:after {
      border-bottom-color: var(--dark) !important;
    }

    .hoverable_row {
      transition-duration: 0.4s;
    }
    .hoverable_row:hover{
      cursor: pointer;
      transform: scale(1.1);
    }

    .background-darker {
      background-color: rgba(0, 0, 0, 0.025);
    }

    body.dark-mode .background-darker {
      background-color: rgba(0, 0, 0, 0.1);
    }

    .cursor-pointer {
      cursor: pointer;
    }

    .custom-btn-group-toggle {
      transition-duration: 0.4s;
    }

    .custom-btn-group-toggle > label.btn:not(.active) {
      opacity: 20%;
    }

    body.dark-mode :is(.daterangepicker, .daterangepicker .calendar-table, .daterangepicker .drp-buttons) {
      border-color: #454d55;
    }

    body.dark-mode .daterangepicker td:hover {
      background-color: rgba(0, 0, 0, 0.25);
    }

    body.dark-mode .daterangepicker *:not(.start-date, .in-range, .end-date, .btn)  {
      background-color: #454d55;
    }

    body.dark-mode .daterangepicker .end-date {
      background-color: #357ebd !important;
    }

    body.dark-mode .daterangepicker .in-range {
      background-color: rgba(0, 0, 0, 0.25);
    }

    body.dark-mode .daterangepicker .available {
      color: white;
    }

    body.dark-mode .daterangepicker .off.ends {
      color: gray;
    }

    body.dark-mode .daterangepicker .table-condensed thead > :is(tr:nth-child(2), .available), body.dark-mode .month {
      color: white;
    }

    body.dark-mode .daterangepicker .calendar-table .next span, body.dark-mode .daterangepicker .calendar-table .prev span {
      border-color: white;
    }

    body.dark-mode .daterangepicker :is(.off, .ends) {
      background-color: transparent !important;
    }
    
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed light-mode">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <?php include_once __F_NAVIGATION__?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reservations</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row d-none">
          <div class="col">
            <!-- LINE CHART -->
            <div class="card card-info reservationLargeCards">
              <div class="card-header">
                  <h3 class="card-title">
                    <div class="dropdown">
                      <button type="button" class="btn dropdown-toggle titleDropdown" data-toggle="dropdown">
                        Reservations
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item text-body" href="#">Reservations</a>
                        <a class="dropdown-item text-body" href="#">Cancelled</a>
                      </div>
                    </div>
                  </h3>
                  <span class="timetabCard head">
                    <button class="active" onclick="openTab(event, 1)">Today</button>
                    <button onclick="openTab(event, 2)">5d</button>
                    <button onclick="openTab(event, 3)">1m</button>
                    <button onclick="openTab(event, 4)">1y</button>
                    <button onclick="openTab(event, 5)">Max</button>
                  </span>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.row (Whole row) -->
        
        <div class="row">
          <div class="col-6 col-lg-3">
            <!-- small card -->
            <div class="small-box bg-info" id="rsrvtn-all">
              <div class="inner">
                <span class="timetabCard">
                  <button class="active" onclick="openTab(event, 1)">Today</button>
                  <button onclick="openTab(event, 2)">5d</button>
                  <button onclick="openTab(event, 3)">1m</button>
                  <button onclick="openTab(event, 4)">1y</button>
                  <button onclick="openTab(event, 5)">Max</button>
                </span>

                <h3 class="timetabCardContent active">
                  <span class="spinner-border mt-0 d-flex align-items-center" role="status" aria-hidden="true"></span>
                </h3>
                <h3 class="timetabCardContent">
                  <span class="spinner-border mt-0 d-flex align-items-center" role="status" aria-hidden="true"></span>
                </h3>
                <h3 class="timetabCardContent">
                  <span class="spinner-border mt-0 d-flex align-items-center" role="status" aria-hidden="true"></span>
                </h3>
                <h3 class="timetabCardContent">
                  <span class="spinner-border mt-0 d-flex align-items-center" role="status" aria-hidden="true"></span>
                </h3>
                <h3 class="timetabCardContent">
                  <span class="spinner-border mt-0 d-flex align-items-center" role="status" aria-hidden="true"></span>
                </h3>

                <p>Reservations</p>
              </div>
              <div class="icon">
                <i class="fas fa-book"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-6 col-lg-3">
            <!-- small card -->
            <div class="small-box bg-success" id="rsrvtn-paid">
              <div class="inner">
                <h3>
                  <span class="spinner-border mt-0 d-flex align-items-center" role="status" aria-hidden="true"></span>
                </h3>
                <p>Paid Reservations</p>
              </div>
              <div class="icon">
                <i class="fas fa-check-circle"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-6 col-lg-3">
            <!-- small card -->
            <div class="small-box bg-warning" id="rsrvtn-rooms-avail">
              <div class="inner">
                <h3>
                  <span class="spinner-border mt-0 d-flex align-items-center" role="status" aria-hidden="true"></span>
                </h3>

                <p>Available Room</p>
              </div>
              <div class="icon">
                <i class="fas fa-door-open"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-6 col-lg-3">
            <!-- small card -->
            <div class="small-box bg-danger" id="rsrvtn-cancelled">
              <div class="inner">
                <h3>
                  <span class="spinner-border mt-0 d-flex align-items-center" role="status" aria-hidden="true"></span>
                </h3>

                <p>Cancelled Reservations</p>
              </div>
              <div class="icon">
                <i class="fas fa-ban"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row (2 column row) -->

        <!-- Data Table -->
        <div class="card card-info reservationLargeCards">
          <div class="card-header">
              <h3 class="card-title">Reservations</h3>
          </div>
          <div class="card-body table-bg p-2">
            <table id="table-reservation" class="table table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th>Status</th>
                  <th>Reservation ID</th>
                  <th>Room #</th>
                  <th>Booked by</th>
                  <th>Date Created</th>
                  <th>Check-In Date</th>
                  <th>Check-Out Date</th>
                  <th>Check-In Time</th>
                  <th>Check-Out Time</th>
                  <th>Early Check-Out Date</th>
                  <th># of stay (per night)</th>
                  <th>Adults</th>
                  <th>Children</th>
                  <th>Contact</th>
                  <th>Email</th>
                  <th>TrxID</th> <!-- Hidden column starting here -->
                  <th>Currency</th>
                  <th>Payed Amount</th>
                  <th>Room Rate</th>
                  <th>Vat rate</th>
                  <th>Vat Amount</th>
                  <th>Service Charge Rate</th>
                  <th>Service Charge Amount</th>
                  <th>Voucher Discount Amount</th>
                  <th>PWD/Senior Discount</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <!-- Data Table End -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Reservation view modal -->
  <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="reservationModalTitle">
            <span class="text-muted">Reservation</span>
            <strong id="rsvtn-panel-id" data-index="">#</strong>
            <small class="text-muted">created at
              <span id="rsvtn-panel-created-date">n/a</span>
            </small>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row m-3">
            <div class="col-12 col-lg-6">
              <div class="row">
                <div class="col-6 mb-3">
                  <small class="d-block text-muted mb-0">Status</small>
                  <h4 id="rsvtn-panel-status" class="ml-2">
                    <span class="badge badge-danger">Unpaid</span>
                  </h4>
                </div>
                <div class="col-6 mb-3">
                  <small class="d-block text-muted mb-0">Room #</small>
                  <h5 id="rsvtn-panel-room-num" class="ml-2 mb-0">
                    n/a
                  </h5>
                  <small id="rsvtn-panel-roomname" class="d-block text-muted mb-0 ml-2">N/a</small>
                </div>
              </div>
              <div class="row">
                <div class="col-12 mb-3">
                  <small class="d-block text-muted mb-0">Booked by</small>
                  <h5 id="rsvtn-panel-bookedby" class="ml-2 mb-0">
                    N/A
                  </h5>
                  <small class="d-block text-muted mb-0 ml-2">For <strong><span id="rsvtn-panel-stay-count">n</span>
                      nights</strong></small>
                </div>
              </div>
              <div class="row">
                <div class="col-12 mb-3">
                  <small class="d-block text-muted mb-0">Number of guest</small>
                  <span id="rsvtn-panel-guest-total" class="ml-2">
                    n/a
                  </span>
                  <small class="d-block text-muted mb-0 ml-2"><strong id="rsvtn-panel-guest-adult">n</strong> Adults,
                    <strong id="rsvtn-panel-guest-children">n</strong> Children </small>
                </div>
              </div>
              <div class="row">
                <div class="col-12 mb-3">
                  <small class="d-block text-muted mb-0">Contact</small>
                  <span id="rsvtn-panel-contact-num" class="ml-2 d-block">
                    n/a
                  </span>
                  <span id="rsvtn-panel-contact-email" class="ml-2 d-block">
                    n/a
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-6 col-md-6 mb-3">
                  <small class="d-block text-muted mb-0">Check-In Date</small>
                  <span id="rsvtn-panel-check-in-date" class="ml-2 d-block">
                    n/a
                  </span>
                </div>
                <div class="col-6 col-md-6 mb-3">
                  <small class="d-block text-muted mb-0">Check-Out Date</small>
                  <span id="rsvtn-panel-check-out-date" class="ml-2 d-block">
                    n/a
                  </span>
                </div>
              </div>
              <div class="row hoverable_row">
                <div class="col-6 col-md-6 mb-3">
                  <small class="d-block text-muted mb-0">Check-In Time</small>
                  <span id="rsvtn-panel-check-in-time" class="ml-2 d-block">
                    n/a
                  </span>
                </div>
                <div class="col-6 col-md-6 mb-3">
                  <small class="d-block text-muted mb-0">Check-Out Time</small>
                  <span id="rsvtn-panel-check-out-time" class="ml-2 d-block">
                    n/a
                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="row">
                <div class="col">
                  <div class="card card collapsed-card shadow-none">
                    <div class="card-header cursor-pointer border-bottom" data-card-widget="collapse">
                      <h4 class="card-title">Payment</h4>
                      <div class="card-tools">
                        <i class="fas fa-chevron-down"></i>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body background-darker">
                      <div class="row">
                        <div class="col text-right">Transaction ID:</div>
                        <div class="col" id="rsvtn-panel-payment-xID"></div>
                        <div class="col d-none d-xl-block"></div>
                      </div>
                      <div class="row">
                        <div class="col text-right">Currency:</div>
                        <div class="col" id="rsvtn-panel-payment-currency"></div>
                        <div class="col d-none d-xl-block"></div>
                      </div>
                      <div class="row mb-3">
                        <div class="col text-right">Payed Amount:</div>
                        <div class="col" id="rsvtn-panel-payment-payedAmount"></div>
                        <div class="col d-none d-xl-block"></div>
                      </div>
                      <div class="row">
                        <div class="col text-right"><span class="fas fa-question-circle fa-xs mx-1" data-toggle='tooltip' title='This rate is (original&nbsp;rate&nbsp;-&nbsp;voucher)'></span>Room Rate:</div>
                        <div class="col" id="rsvtn-panel-payment-roomrate"></div>
                        <div class="col d-none d-xl-block"></div>
                      </div>
                      <div class="row">
                        <div class="col text-right">VAT (	<span id="rsvtn-panel-payment-vat-rate"></span>&#x25;):</div>
                        <div class="col" id="rsvtn-panel-payment-vat"></div>
                        <div class="col d-none d-xl-block"></div>
                      </div>
                      <div class="row">
                        <div class="col text-right">Service Charge (	<span id="rsvtn-panel-payment-serviceCharge-rate"></span>&#x25;):</div>
                        <div class="col" id="rsvtn-panel-payment-serviceCharge"></div>
                        <div class="col d-none d-xl-block"></div>
                      </div>
                      <div class="row">
                        <div class="col text-right">Voucher Discount:</div>
                        <div class="col" id="rsvtn-panel-payment-voucherValue"></div>
                        <div class="col d-none d-xl-block"></div>
                      </div>
                      <div class="row">
                        <div class="col text-right">Senior/PWD Discount:</div>
                        <div class="col" id="rsvtn-panel-payment-PoS"></div>
                        <div class="col d-none d-xl-block"></div>
                      </div>
                      <div class="row">
                        <div class="col text-right">Total:</div>
                        <div class="col" id="rsvtn-panel-payment-total"></div>
                        <div class="col d-none d-xl-block"></div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="card card collapsed-card shadow-none">
                    <div class="card-header cursor-pointer border-bottom" data-card-widget="collapse">
                      <h4 class="card-title">Check In/Out</h4>
                      <div class="card-tools">
                        <i class="fas fa-chevron-down"></i>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body background-darker">
                      <div class="row">
                        <div class='col-12 col-xl-6'>
                          <div class="form-group">
                            <small class="d-block text-muted mb-0">Check-In Time <a href="javascript:void(0)"
                                class="p-0 d-inline d-none" onclick="resetCheckIn()">Reset</a></small>
                            <div class="input-group date" id="input-datetime-checkIn" data-target-input="nearest">
                              <input readonly placeholder="Click the calendar button" type="text"
                                class="form-control datetimepicker-input" data-target="#input-datetime-checkIn" />
                              <div id="test" class="input-group-append" data-target="#input-datetime-checkIn"
                                data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class='col-12 col-xl-6'>
                          <div class="form-group">
                            <small class="d-block text-muted mb-0">Check-Out Time <a href="javascript:void(0)"
                                class="p-0 d-inline d-none" onclick="resetCheckOut()">Reset</a></small>
                            <div class="input-group date" id="input-datetime-checkOut" data-target-input="nearest">
                              <input placeholder="Click the calendar button" type="text"
                                class="form-control datetimepicker-input" data-target="#input-datetime-checkOut" />
                              <div class="input-group-append" data-target="#input-datetime-checkOut"
                                data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class='col-12'>
                          <div class="form-group">
                            <small class="d-block text-muted mb-0">Early Check-Out Date</small>
                            <div class="input-group date" id="input-date-earlyCheckOut" data-target-input="nearest">
                              <input placeholder="Click the calendar button" type="text"
                                class="form-control datetimepicker-input" data-target="#input-date-earlyCheckOut" />
                              <div class="input-group-append" data-target="#input-date-earlyCheckOut"
                                data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                            </div>
                            <div id="label-EarlyCheckout">
                              
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>
              </div>
              <div class="row d-none">
                <div class="col">
                  <div class="card card collapsed-card shadow-none">
                    <div class="card-header cursor-pointer border-bottom" data-card-widget="collapse">
                      <h4 class="card-title">Status</h4>
                      <div class="card-tools">
                        <i class="fas fa-chevron-down"></i>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body background-darker">
                      <div class="row">
                        <div class='col-12'>
                            <div class="btn-group custom-btn-group-toggle w-100">
                              <button type="button" class="btn btn-secondary" onclick="setPaid()">Paid</button>
                              <button type="button" class="btn btn-secondary" onclick="setUnpaid()">Unpaid</button>
                            </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" id="reservationModal-buttons">
                <div class="col">
                  <button type="button" class="btn btn-outline-danger float-right" onclick="setCancelled()">
                    Cancel Reservation
                  </button>
                  <button type="button" class="btn btn-outline-info float-left" onclick="resendEmail(this)">
                    Resend Email
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer d-flex justify-content-between">
            <span>
              <button id="btn-modal-rsvtn-prev" type="button" class="btn btn-secondary"
                onclick="prevRecord()">Prev</button>
              <button id="btn-modal-rsvtn-next" type="button" class="btn btn-secondary"
                onclick="nextRecord()">Next</button>
            </span>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Reservation view modal END-->
    
    <!-- Modal -->
    <div class="modal fade" id="modal-walk_in" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add A New Walk-In Reservation</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          <div class="modal-body">
            <form class="container-fluid" id="form-walk_in">
              <div class="row">
                <div class="col mr-2">
                  <div class="row">
                    <div class="col-12 col-lg-6">
                      <div class="form-group">
                        <label>Check-in and Check-out Date</label>
                        <input type="text" class="form-control" name="form-walk_in-bookingRange" id="form-walk_in-bookingRange" aria-describedby="helpId" placeholder="" autocomplete="off">
                        <!-- <small id="helpId" class="form-text text-muted">Help text</small> -->
                      </div>
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="form-group">
                          <label class="d-flex justify-content-between" for=""><span>Room Type</span><small class="align-self-end">PHP <span id="form-walk_in-label-roomrate"></span></small></label>
                          <select class="form-control" id="form-walk_in-select-roomtype" name="form-walk_in-select-roomtype" onchange="showRate()">
                            <option>No rooms available</option>
                          </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <label>Guest Info</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <div class="form-group">
                        <input id="form-walk_in-input-first_name" name="form-walk_in-input-first_name" type="text" class="form-control" placeholder="First name">
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="form-group">
                      <input id="form-walk_in-input-last_name" name="form-walk_in-input-last_name" type="text" class="form-control" placeholder="Last name">
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="form-group">
                      <input id="form-walk_in-input-contactNum" name="form-walk_in-input-contactNum" type="text" class="form-control" placeholder="(09)** *** ****">
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="form-group">
                      <input id="form-walk_in-input-email" name="form-walk_in-input-email" type="email" class="form-control" placeholder="Email Address">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <label>Guest Count <small class="text-muted">Max Adult: <span id="form-walk_in-label-guest-adult"></span> Max Child: <span id="form-walk_in-label-guest-child"></span></small></label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-md-6">
                      <div class="form-group">
                      <input id="form-walk_in-input-guest-adult" name="form-walk_in-input-guest-adult" type="number" min="1" class="form-control" placeholder="# of Adult/s">
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="form-group">
                      <input id="form-walk_in-input-guest-child" name="form-walk_in-input-guest-child" type="number" min="0" class="form-control" placeholder="# of Child/s">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>PWD/Senior ID (Optional)</label>
                        <input type="text"
                          class="form-control" name="form-walk_in-input-PoS" id="form-walk_in-input-PoS" aria-describedby="helpId" placeholder="PWD/Senior ID number">
                        <small id="helpId" class="form-text text-muted">You can leave this empty if not needed</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col ml-2">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="">Tansaction ID</label>
                        <input type="text"
                          class="form-control" name="form-walk_in-input-xID" id="form-walk_in-input-xID" placeholder="Transcation ID">
                      </div>
                    </div>
                  </div>
                  <div class="container background-darker p-3">
                    <div class="row">
                      <div class="col text-right"><span class="fas fa-question-circle fa-xs mx-1 d-none" data-toggle="tooltip" title="This rate is (original&nbsp;rate&nbsp;-&nbsp;voucher)"></span>Room Rate:</div>
                      <div class="col" id="form-walk_in-payment-roomrate">0</div>
                      <div class="col d-none d-xl-block"></div>
                    </div>
                    <div class="row">
                      <div class="col text-right">VAT (	<span id="form-walk_in-payment-vat-rate">0</span>%):</div>
                      <div class="col" id="form-walk_in-payment-vat">0</div>
                      <div class="col d-none d-xl-block"></div>
                    </div>
                    <div class="row">
                      <div class="col text-right">Service Charge (<span id="form-walk_in-payment-serviceCharge-rate">0</span>%):</div>
                      <div class="col" id="form-walk_in-payment-serviceCharge">0</div>
                      <div class="col d-none d-xl-block"></div>
                    </div>
                    <div class="row d-none">
                      <div class="col text-right">Voucher Discount:</div>
                      <div class="col" id="form-walk_in-payment-voucherValue">0</div>
                      <div class="col d-none d-xl-block"></div>
                    </div>
                    <div class="row mb-2">
                      <div class="col text-right">Senior/PWD Discount:</div>
                      <div class="col" id="form-walk_in-payment-PoS">0</div>
                      <div class="col d-none d-xl-block"></div>
                    </div>
                    <div class="row pt-2 border-top">
                      <h5 class="col text-right">Total:</h5>
                      <h5 class="col" id="form-walk_in-payment-total">0</h5>
                      <div class="col d-none d-xl-block"></div>
                    </div>
                  </div>
                </div>
              </div>
            <input type="submit" id="form-walk_in-submit" class="hidden" />
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <label id="form-walk_in-label-submit" for="form-walk_in-submit" tabindex="0" class="btn btn-primary">Submit</label>
          </div>
        </div>
      </div>
    </div>

  <!-- Main Footer -->
  <?php include(__F_MAIN_FOOTER__); ?>


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- jsGrid -->
<script src="plugins/jsgrid/jsgrid.min.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- Moment -->
<script src="plugins/moment/moment.min.js"></script>
<!-- Tempus Dominus -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Jquery Validation  -->
<script src="plugins/jquery-validation/jquery.validate.js"></script>
<!-- Daterange picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Special Script-->
<script src="customFiles/initialize Toastr.js"></script>
<script src="customFiles/reservation_incidentals.js"></script>
<script src="customFiles/buttonDisabler.js"></script>
<script src="customFiles/customScript.js"></script>


<!-- Walkin Reservation -->
<script>

$('#modal-walk_in').on('shown.bs.modal', function (e) {
  console.log('shown');
  runSelectUpdateInterval();
});

$(function () {

   $('#form-walk_in-bookingRange').daterangepicker({
    minDate: moment(),
    autoApply: true,
    startDate: moment(),
    endDate: moment().add(1, 'days')
  });
  dp_walkIn = $('#form-walk_in-bookingRange').data('daterangepicker');
  $('#form-walk_in-bookingRange').on('apply.daterangepicker', function(ev, picker) {
    if(picker.startDate.format('YYYY-MM-DD') == picker.endDate.format('YYYY-MM-DD')) {
      Swal.fire('You cannot select the same date for check-in and check-out');
      let x=picker.endDate.add(1, 'days').format('YYYY-MM-DD');
      picker.setEndDate(moment(x));
    }
  });
      
  $("#form-walk_in-input-guest-adult").change(()=> {
    calculatePayment();
  });
  $("#form-walk_in-input-guest-child").change(()=> {
    calculatePayment();
  });
  $("#form-walk_in-input-PoS").change(()=> {
    calculatePayment();
  });

});

$('#form-walk_in-bookingRange').on('apply.daterangepicker', function(ev, picker) {
  //do something, like clearing an input
  console.log("date changed");
  refreshSelectNode();
});

$("#form-walk_in-select-roomtype").change(()=>showRate());

selectNodeIsUpdating = false;
function refreshSelectNode() {
  if(selectNodeIsUpdating) {
    // console.log("still updating");
    return;
  };
  // console.log("pasok");
  let chkIn = dp_walkIn.startDate.format('YYYY-MM-DD');
  let chkOut = dp_walkIn.endDate.format('YYYY-MM-DD');
  let date = [chkIn, chkOut];
  let uriDate = encodeURIComponent(btoa(JSON.stringify(date)));
  // console.log(uriDate);
  selectNodeIsUpdating = true;
  $.get("/public_assets/modules/php/database/reservationControls/getAvailableRoomsAsSelect_FA.php", {d: uriDate},
      function (data, textStatus, jqXHR) {
          selectNodeIsUpdating = false;
          // console.log("done");
          let target = $("#form-walk_in-select-roomtype");
          let fetchedSelect = $(data);
          // console.log(data);
          if(!fetchedSelect[0].isEqualNode(target[0])) {
            // console.log("New");
            target.html(fetchedSelect.html());
            showRate();
          }
      },
      "html"
  );
}

const calculatePayment = () => {
  let requiredInputs = [
    '#form-walk_in-select-roomtype',
    '#form-walk_in-input-guest-adult',
    '#form-walk_in-input-guest-child',
    '#form-walk_in-input-PoS'
  ];
  let valid = requiredInputs.every( (e) => {
    return $(e).valid();
  } );
  if(!valid) return;
  let chkIn = dp_walkIn.startDate.format('YYYY-MM-DD');
  let chkOut = dp_walkIn.endDate.format('YYYY-MM-DD');
  let adult = $("#form-walk_in-input-guest-adult").val();
  let child = $("#form-walk_in-input-guest-child").val();
  let PoS = $("#form-walk_in-input-PoS").val();
  let rid;
  try {
    rid = atob($("#form-walk_in-select-roomtype option:selected").attr('data-rid'));
  } catch(e) {
    return;
  }
  console.log("proceed to post", rid);
  $.post("/public_assets/modules/php/database/reservationControls/getNewCalculation_All.php", {
    checkIn: chkIn,
    checkOut: chkOut,
    guest: {"adult": adult, "child": child},
    rid: rid,
    PoS_ID: PoS,
    voucher_code: ""
  },
    function (data, textStatus, jqXHR) {
      console.log(data);

      $("#form-walk_in-payment-vat-rate").text(parseFloat(data.details.tax) * 100);
      $("#form-walk_in-payment-serviceCharge-rate").text(parseFloat(data.details.serviceCharge) * 100);

      $("#form-walk_in-payment-roomrate").text(data.amount.subtotal);
      $("#form-walk_in-payment-vat").text(data.amount.VAT);
      $("#form-walk_in-payment-serviceCharge").text(data.amount.ServiceCharge);
      $("#form-walk_in-payment-PoS").text(data.amount.PoS_discount);
      $("#form-walk_in-payment-total").text(data.amount.total);
    },
    "json"
  );
}


const runSelectUpdateInterval = () => {
  refreshSelectNode();
  var i = 0;
  var intervalId = setInterval(function () {
      // if (i === 100) {
      //     clearInterval(intervalId);
      // }
      if (!(($("#modal-walk_in").data('bs.modal') || {})._isShown)) {
        console.log("Modal is close");
        clearInterval(intervalId);
        return;
      }
      refreshSelectNode();
      console.log(i);
      i+=5;
  }, 5000);
};

const showRate = () => {
  // console.log("show the rate");
  let target = $("#form-walk_in-select-roomtype option:selected");
  let rate = target.attr('data-rate');
  let maxAdult = target.attr('data-maxAdult') ?? "0";;
  let maxChildren = target.attr('data-maxChildren') ?? "0";
  // console.log('---', maxAdult, maxChildren);
  if(typeof target.attr('data-rid') != 'undefined') {
    $("#form-walk_in-select-roomtype").valid();
  }
  $("#form-walk_in-label-roomrate").text(rate);
  $('#form-walk_in-input-guest-adult').rules('add', {max: maxAdult});
  $('#form-walk_in-input-guest-child').rules('add', {max: maxChildren});
  $("#form-walk_in-label-guest-adult").html(maxAdult);
  $("#form-walk_in-label-guest-child").html(maxChildren);

  calculatePayment();
};

$("#form-walk_in").validate({
  rules: {
    "form-walk_in-bookingRange": {
      required: true
    },
    "form-walk_in-input-first_name": {
      required: true,
      regex: '^([A-z]\\s{0,1})+$'
    },
    "form-walk_in-select-roomtype": {
      isRoom: true
    },
    "form-walk_in-input-last_name": {
      required: true,
      regex: '^([A-z](\\s|\\.){0,1})+$'
    },
    "form-walk_in-input-contactNum": {
      required: true,
      regex: '^(09)\\d{9}$'
    },
    "form-walk_in-input-email": {
      required: true,
      email: true
    },
    "form-walk_in-input-guest-adult": {
      required: true,
      min: 1
    },
    "form-walk_in-input-guest-child": {
      required: true,
      min: 0
    },
    "form-walk_in-input-PoS": {
      regex: '^[\\w|\\d]+(-[\\w|\\d]+)*$'
    },
    "form-walk_in-input-xID": {
      required: true,
      remote: {
        url: "/admin/customFiles/php/database/reservationControls/checkTransactionID.php",
        type: "post",
        data: {
          xid: () => $("#form-walk_in-input-xID").val()
        }
      }
    }
  },
  messages: {
    "form-walk_in-input-first_name": {
      regex: "Allowed characters are only A-z"
    },
    "form-walk_in-input-last_name": {
      regex: "Allowed characters are only A-z and . (period)"
    }
  },
  errorElement: 'span',
  errorPlacement: function (error, element) {
    if($(element).attr('id')=='form-walk_in-select-roomtype') return;
    error.addClass('invalid-feedback');
    element.closest('.form-group').append(error);
  },
  highlight: function (element, errorClass, validClass) {
    $(element).addClass('is-invalid');
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).removeClass('is-invalid');
  },
  submitHandler: function (form, e) {

    let xID = $("#form-walk_in-input-xID").val();
    let fname = $("#form-walk_in-input-first_name").val();
    let lname = $("#form-walk_in-input-last_name").val();
    let contact = $("#form-walk_in-input-contactNum").val();
    let email = $("#form-walk_in-input-email").val();
    let chkIn = dp_walkIn.startDate.format('YYYY-MM-DD');
    let chkOut = dp_walkIn.endDate.format('YYYY-MM-DD');
    let adult = $("#form-walk_in-input-guest-adult").val();
    let child = $("#form-walk_in-input-guest-child").val();
    let PoS = $("#form-walk_in-input-PoS").val();
    let rid = $("#form-walk_in-select-roomtype option:selected").attr('data-rid');
    toggleButtonDisabled("#form-walk_in-label-submit", "#modal-walk_in", '');
    $.post("/public_assets/modules/php/database/reservationControls/createNewWalkin.php", {
        fname:  fname,
        lname:  fname,
        contact:  contact,
        email:  email,
        checkIn: chkIn,
        checkOut: chkOut,
        guest: {"adult": adult, "child": child},
        rid: rid,
        PoS_ID: PoS,
        voucher_code: "",
        xID: xID
    },
      function (response, textStatus, jqXHR) {
          toggleButtonDisabled("#form-walk_in-label-submit", "#modal-walk_in", '');
          console.log(response);
          Toast.fire({
            icon: response.status,
            title: response.message
          });
          if(response.isSuccessful) {
            $("#form-walk_in").trigger('reset');
          }
      },
      "json"
    );
    console.log("Submited");
  },
  error: function(XMLHttpRequest, textStatus, errorThrown) {
        Toast.fire({
            icon: 'error',
            title: 'Something went wrong while processing the reservation'
        });
        console.log(errorThrown);
  }
});

$.validator.addMethod(
  "isRoom",
  function(value, element, param) {
    // console.log( element );
    let z = $(element).find('option:selected').attr('data-rid');
    if(typeof z === 'undefined') return false;
    return true;
  },
  "No available rooms"
);

$.validator.addMethod(
  "regex",
  function(value, element, regexp) {
    var re = new RegExp(regexp);
    return this.optional(element) || re.test(value);
  },
  "Please check your input."
);


</script>

<script>


$(function () {
  
  $('#input-datetime-checkIn').datetimepicker({
      sideBySide: true,
      ignoreReadonly: true,
      useCurrent: false
  });
  $('#input-datetime-checkIn input').attr('readonly', true);
  $('#input-datetime-checkOut').datetimepicker({
      icons: { time: 'far fa-clock' },
      sideBySide: true,
      ignoreReadonly: true,
      useCurrent: false
  });

  $('#input-date-earlyCheckOut').datetimepicker({
      icons: { time: 'far fa-clock' },
      sideBySide: true,
      ignoreReadonly: true,
      useCurrent: false,
      format: 'L'
  });

  $('#input-date-earlyCheckOut input').attr('readonly', 'readonly');
  $('#input-datetime-checkOut input').attr('readonly', 'readonly');

  $("#input-datetime-checkIn").on("change.datetimepicker", function (e) {
      $('#input-datetime-checkOut').datetimepicker('minDate', e.date);
  });
  $("#input-datetime-checkOut").on("change.datetimepicker", function (e) {
      $('#input-datetime-checkIn').datetimepicker('maxDate', e.date);
  });

  $("#input-datetime-checkIn").on("show.datetimepicker", function (e) {
    let i = $("#rsvtn-panel-id").attr('data-index');
    let d = table_Reservation.rows().data()[i];
    console.log(moment().isSameOrAfter(moment(d.checkInDate)));
    if(moment().isSameOrAfter(moment(d.checkInDate))) {
      $('#input-datetime-checkIn').data('datetimepicker').date(moment());
    } else {
      console.log("pasok");
      $('#input-datetime-checkIn').data('datetimepicker').date(moment(d.checkInDate));
    }
    if(d)
    $('#input-datetime-checkIn').datetimepicker('minDate', moment(d.checkInDate));
  });

  $("#input-datetime-checkOut").on("show.datetimepicker", function (e) {
    let i = $("#rsvtn-panel-id").attr('data-index');
    let d = table_Reservation.rows().data()[i];
    //console.log(d);
    let checkInHaveVal = $('#input-datetime-checkIn').data('datetimepicker').date() != null;
    if(checkInHaveVal) {
      console.log(">>", moment(d.checkInTime).toString());
      if(moment().isSameOrAfter( $('#input-datetime-checkIn').data('datetimepicker').date() ))
        $('#input-datetime-checkOut').data('datetimepicker').date(moment());
      else
        $('#input-datetime-checkOut').data('datetimepicker').date( $('#input-datetime-checkIn').data('datetimepicker').date() );
    } else {
      $('#input-datetime-checkOut').data('datetimepicker').date(moment(d.checkOutDate));
    }
  });

  $('#input-datetime-checkIn').on("hide.datetimepicker", ({date, oldDate}) => {
    let i = $("#rsvtn-panel-id").attr('data-index');
    let d = table_Reservation.rows().data()[i];
    if(date==null) return;
    if(date.isSame(moment(d.checkInTime))) return;
    $.post("customFiles/php/database/reservationControls/setCheckInTime.php", {"date-checkIn": moment(date).format('YYYY-MM-DD HH:mm'), rsvid: d.reservationID},
      function (response, textStatus, jqXHR) {
        //console.log(response);        
        Toast.fire({
          icon: response.status,
          title: response.message
        });
        if(response.isSuccessful) {
          let target = table_Reservation.row("#"+d.reservationID);
          target.data().checkInTime = moment(date).format('YYYY-MM-DD HH:mm').toString();
          target.invalidate();
          console.log(date.format("MMM D YYYY h:mm a").toString());        
          $("#rsvtn-panel-check-in-time").html(date.format("h:mm a[<small class='d-block text-muted mb-0'>]MMM D YYYY [</small>]").toString());
        }
      },
      "json"
    );
  });

  $('#input-datetime-checkOut').on("hide.datetimepicker", ({date, oldDate}) => {  
    let i = $("#rsvtn-panel-id").attr('data-index');
    let d = table_Reservation.rows().data()[i];
    if(date==null) return;
    if(date.isSame(moment(d.checkOutTime))) return;
    $.post("customFiles/php/database/reservationControls/setCheckOutTime.php", {"date-checkOut": moment(date).format('YYYY-MM-DD HH:mm'), rsvid: d.reservationID},
      function (response, textStatus, jqXHR) {
        //console.log(response);        
        Toast.fire({
          icon: response.status,
          title: response.message
        });
        if(response.isSuccessful) {
          let target = table_Reservation.row("#"+d.reservationID);
          target.data().checkOutTime = moment(date).format('YYYY-MM-DD HH:mm').toString();
          target.invalidate();
          $("#rsvtn-panel-check-out-time").html(date.format("h:mm a[<small class='d-block text-muted mb-0'>]MMM D YYYY [</small>]").toString());
        }
      },
      "json"
    );
  });

  $('#input-date-earlyCheckOut').on("show.datetimepicker", ({date, oldDate}) => { 
    console.log("show");
    let i = $("#rsvtn-panel-id").attr('data-index');
    let d = table_Reservation.rows().data()[i];
    let rsvid = d.reservationID;
    console.log(rsvid);
    if( moment(d.checkOutDate).diff(moment(d.checkInDate), 'days') <= 1) {
      console.log("Invalid");
      $('#input-date-earlyCheckOut').datetimepicker('hide');
      return
    }
    console.log(moment().isBefore(d.checkInDate));
    if(moment().isBefore(d.checkInDate)) {
      $('#input-date-earlyCheckOut').data('datetimepicker').date(moment(d.checkInDate).add(1, 'days'));
    }
    $('#input-date-earlyCheckOut').datetimepicker('minDate', false);
    $('#input-date-earlyCheckOut').datetimepicker('maxDate', false);
    try {
      $('#input-date-earlyCheckOut').datetimepicker('minDate', moment(d.checkInDate).add(1, 'days'));
      $('#input-date-earlyCheckOut').datetimepicker('maxDate', moment(d.checkOutDate).subtract(1, 'days'));
    } catch(e) {
      console.log("error in early checkout");
    }
  });

  $('#input-date-earlyCheckOut').on("hide.datetimepicker", ({date, oldDate}) => { 
    let i = $("#rsvtn-panel-id").attr('data-index');
    let d = table_Reservation.rows().data()[i];
    let rsvid = d.reservationID;
    if( moment(d.checkOutDate).diff(moment(d.checkInDate), 'days') <= 1) {
      console.log("Cannot update");
      return;
    }
    // console.log(typeof date);
    if(date==null) return;
    let formatedDate = date.format('YYYY-MM-DD');
    initiateEarlyCheckout(formatedDate , rsvid);
  });

  /* ChartJS
    * -------
    * Here we will create a few charts using ChartJS
    */

  //--------------
  //- AREA CHART -
  //--------------

  // Get context with jQuery - using jQuery's .get() method.
  
  var labelToday = ["0:00","1:00","6:00","18:00","24:00"]
  var month = ['January', 'February', 'March', 'April', 'May', 'June', 'July']
  var areaChartData = {
    labels  : labelToday,
    datasets: [
      {
        label               : 'Reservations',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [5, 3, 10, 2, 0]
      },
      {
        label               : 'Cancelled',
        backgroundColor     : 'rgba(201, 143, 143, 0.9)',
        borderColor         : 'rgba(201, 143, 143, 0.8)',
        pointRadius         : false,
        pointColor          : 'rgba(201, 143, 143, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : [0, 0, 1, 0, 2]
      },
    ]
  }

  var areaChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: true
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : true,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        }
      }]
    }
  }

  //-------------
  //- LINE CHART -
  //--------------
  var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
  var lineChartOptions = $.extend(true, {}, areaChartOptions)
  var lineChartData = $.extend(true, {}, areaChartData)
  lineChartData.datasets[0].fill = false;
  lineChartData.datasets[1].fill = false;
  lineChartOptions.datasetFill = false

  var lineChart = new Chart(lineChartCanvas, {
    type: 'line',
    data: lineChartData,
    options: lineChartOptions
  })
});

const resetCheckInOutPicker = (option = 0) => {
  switch (option) {
    case 1:
      $('#input-datetime-checkIn').datetimepicker('clear');
      break;
    case 2:
      $('#input-datetime-checkOut').datetimepicker('clear');
      break;
    default:
      $('#input-datetime-checkIn').datetimepicker('clear');
      $('#input-datetime-checkOut').datetimepicker('clear');
      break;
  }
}

const resetCheckIn = () => {
    let i = $("#rsvtn-panel-id").attr('data-index');
    let d = table_Reservation.rows().data()[i];
    $.post("customFiles/php/database/reservationControls/removeCheckInTime.php", {rsvid: d.reservationID},
      function (response, textStatus, jqXHR) {
        console.log(response);
        Toast.fire({
          icon: response.status,
          title: response.message
        });
        if(response.isSuccessful){
          let target = table_Reservation.row("#"+d.reservationID);
          target.data().checkInTime = "";
          target.invalidate();
          $("#rsvtn-panel-check-in-time").html('N/a');
          resetCheckInOutPicker(1);
        }
      },
      "json"
    );
  }
  
const resetCheckOut = () => {
    let i = $("#rsvtn-panel-id").attr('data-index');
    let d = table_Reservation.rows().data()[i];
    $.post("customFiles/php/database/reservationControls/removeCheckOutTime.php", {rsvid: d.reservationID},
      function (response, textStatus, jqXHR) {
        console.log(response);
        Toast.fire({
          icon: response.status,
          title: response.message
        });
        if(response.isSuccessful){
          let target = table_Reservation.row("#"+d.reservationID);
          target.data().checkOutTime = "";
          target.invalidate();
          $("#rsvtn-panel-check-out-time").html('N/a');
          resetCheckInOutPicker(2);
        }
      },
      "json"
    );
  }

</script>

<!-- Table script -->
<script>

table_Reservation = $('#table-reservation').DataTable( {
  ajax: "customFiles/php/database/reservationControls/getReservations.php",
  dataSrc: 'data',
  rowId: 'reservationID',
  dom: "<'row mb-2' <'col'B>><'row'<'col'l><'col'f>>rtip",
  buttons: [
    {
        text: 'New Walk-In Reservation',
        attr: {
          class: "btn btn-primary",
          "data-toggle": "modal",
          "data-target": "#modal-walk_in"
        },
        action: function ( e, dt, node, config ) {

          // Swal.fire(
          //   'This feature is still in progress',
          //   'Nakakapagpasok na ng reservation. Aayusin na lang yung notif kapag successful or failed yung booking :D',
          //   'information'
          // );

        }
    }, {
        text: 'Refresh',
        action: function ( e, dt, node, config ) {
          toggleButtonDisabled("#btn-rsv-refresh", "#table-reservation_wrapper", "");
          dt.ajax.reload(()=>{          
            toggleButtonDisabled("#btn-rsv-refresh", "#table-reservation_wrapper", "");
          });
        },
        attr: {
          id: 'btn-rsv-refresh'
        }
    },  {
            extend: 'collection',
            text: 'Export',
            attr: {
                class: "btn btn-default dropdown-toggle"
            },
            buttons: [
                /*{
                    extend: "copyHtml5",
                    text: "Copy",
                    exportOptions: {
                        columns: [":not(:last-child)"]  
                    }
                }, {
                    extend: "print",
                    text: "Print",
                    exportOptions: {
                        columns: [":not(:last-child)"]
                    }
                },*/ {
                    extend: "excelHtml5",
                    text: "Excel",
                    exportOptions: {
                        columns: [":not(:first-child)"]
                    }
                }/*, {
                    extend: "csvHtml5",
                    text: "CSV",
                    exportOptions: {
                        columns: [":not(:last-child)"]
                    }
                }, {
                    extend: "pdfHtml5",
                    text: "PDF",
                    exportOptions: {
                        columns: [":not(:last-child)"]
                    },
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    customize : function(doc)
                    {
                        // Column width
                        doc.content.forEach(function(item)
                        {
                            if (item.table)
                            {
                                item.table.widths = [75, '*', '*', '*', '*', '*']
                            }
                        });
                    }
                }*/
            ]
        }
  ],
  responsive: {
    details: {
      type: 'column',
      target: 0
    }
  },
  "lengthChange": true, 
  "autoWidth": false,
  columns: [
    {
      data: null,
      defaultContent: "<span class='p-2'></span>",
      className: 'dtr-control',
      orderable: false
    }, {
      data: 'reservationStatus',
      render: function (data, type, row, meta) {
        return getReservationStatusBadge(data);
      }
    }, {
      data: 'reservationID',
      render: function (data, type, row, meta) {
        //console.log(row);
        return data;
      }
    }, {
      data: 'roomNo',
      className: 'None'
    }, {
      data: 'Name',
      className: 'None'
    }, {
      data: 'dateCreated'
    }, {
      data: 'checkInDate'
    }, {
      data: 'checkOutDate'
    }, {
      data: 'checkInTime',
      render:(data, type, row, meta) => {
        let valid = moment(data).isValid();
        return valid ? moment(data).format('YYYY-MM-DD HH:mm') : "";
      }
    }, {
      data: 'checkOutTime',
      render:(data, type, row, meta) => {
        let valid = moment(data).isValid();
        return valid ? moment(data).format('YYYY-MM-DD HH:mm') : "";
      }
    }, {
      data: 'earlyCheckout',
    }, {
      data: 'numberOfNightstay',
      className: 'none'
    }, {
      data: 'adults',
      className: 'none'
    }, {
      data: 'children',
      className: 'none'
    }, {
      data: 'contact',
      className: 'none'
    }, {
      data: 'email',
      className: 'none'
    }, { // hide -------------------------------------------------
      data: 'orderID',
      className: 'none'
    }, {
      data: 'currency',
      className: 'none'
    }, {
      data: 'payedValue',
      className: 'none'
    }, {
      data: 'roomRate',
      className: 'none'
    }, {
      data: 'vat_rate',
      className: 'none'
    }, {
      data: 'vat_value',
      className: 'none'
    }, {
      data: 'serviceCharge_rate',
      className: 'none'
    }, {
      data: 'serviceCharge_value',
      className: 'none'
    }, {
      data: 'voucher_value',
      className: 'none'
    }, {
      data: 'PoS_value',
      className: 'none'
    }, {
      data: 'total',
      className: 'none'
    }
  ],
  "columnDefs": [
    {orderable: false, targets: 0},
    {"className": "align-middle", "targets": "_all"},
    {
      targets: [15,16,17,18,19,20,21,22,23,24,25],
      searchable: true,
      // visible: false
    }
  ],
  order: [[2, 'desc']]
});
  //$('.dataTables_length').addClass('bs-select');

function getReservationStatusBadge(value) {
  value = parseInt(value);
  let statusText;
  let badgeColor;
  switch(value) {
    case 1:
      statusText = "Paid";
      badgeColor = "success";
      break;
    case 2:
      statusText = "Cancelled";
      badgeColor = "warning";
      break;
    default:
      statusText = "Unpaid";
      badgeColor = "danger";
      break;
  }
  return `<span class="badge badge-${badgeColor}">${statusText}</span>`; 
}

const updateStatsBox = (id, val) => $(`#${id} .inner h3`).html(val);

const updateStatsBox_timely = (id, val) => {
  if(typeof val !== 'object') throw new Error('Invalid value');
  if(typeof id !== 'string') throw new Error('Invalid id');

  $("#rsrvtn-all .inner > h3").each(function (index, element) {
    // element == this
    $(this).html(val[index]);
  });

}


async function updateReservationStats() {
  let stats = await $.getJSON("customFiles/php/database/reservationControls/getReservationStats.php", null,
    function (data, textStatus, jqXHR) {
      //console.log(data);
      return data;
    }
  );
  updateStatsBox_timely("rsrvtn-all", stats.rsrvtn_count);
  updateStatsBox("rsrvtn-paid", stats.rsrvtn_paid);
  updateStatsBox("rsrvtn-cancelled", stats.rsrvtn_cancelled);
  updateStatsBox("rsrvtn-rooms-avail", 'n/a');
}

  $(document).ready(function() {
  $("#incidentalTableSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#incidentalTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  updateReservationStats();
});

function updateRsvtnModal(data, rowIndex) {
  $("#rsvtn-panel-id").html(data.reservationID);
  $("#rsvtn-panel-id").attr('data-index', rowIndex)
  let dateCreated = moment(data.dateCreated).format('dddd, MMMM Do YYYY');
  $("#rsvtn-panel-created-date").html(dateCreated);
  $("#rsvtn-panel-status").html(getReservationStatusBadge(data.reservationStatus));
  $("#rsvtn-panel-room-num").html(data.roomNo);
  $("#rsvtn-panel-bookedby").html(data.Name);
  (data.Name.trim()==="") && $("#rsvtn-panel-bookedby").html("How is this possible????");
  $("#rsvtn-panel-stay-count").html(data.numberOfNightstay);
  let guestTotal = parseInt(data.children) + parseInt(data.adults); 
  $("#rsvtn-panel-guest-total").html(guestTotal);
  $("#rsvtn-panel-guest-adult").html(data.adults);
  $("#rsvtn-panel-guest-children").html(data.children);
  $("#rsvtn-panel-contact-num").html(data.contact);
  $("#rsvtn-panel-contact-email").html(data.email);
  if(data.contact.trim()==="" && data.email.trim()==="") {
    $("#rsvtn-panel-contact-num").html("No contact info");
  }
  //checkin related updates
  $("#rsvtn-panel-check-in-date").html(moment(data.checkInDate).format("MMMM Do YYYY [<small class='d-block text-muted mb-0'>]dddd[</small>]").toString());
  $("#rsvtn-panel-check-out-date").html(moment(data.checkOutDate).format("MMMM Do YYYY [<small class='d-block text-muted mb-0'>]dddd[</small>]").toString());

  if(moment(data.checkInTime).isValid())
    $("#rsvtn-panel-check-in-time").html(moment(data.checkInTime).format("h:mm a[<small class='d-block text-muted mb-0'>]MMM D YYYY [</small>]").toString());
  else
    $("#rsvtn-panel-check-in-time").html("N/a");

  if(moment(data.checkOutTime).isValid())
    $("#rsvtn-panel-check-out-time").html(moment(data.checkOutTime).format("h:mm a[<small class='d-block text-muted mb-0'>]MMM D YYYY [</small>]").toString());
  else
    $("#rsvtn-panel-check-out-time").html("N/a");
  // console.log(">>", data.checkInTime);
  if(data.checkInTime!="" && data.checkInTime!=null) {
    $('#input-datetime-checkIn').data('datetimepicker').date(moment(data.checkInTime));
    console.log("pasok", moment(data.checkInTime).format('YYYY-MM-DD'));
  }
  else
    resetCheckInOutPicker(1);
  if(data.checkOutTime!="" && data.checkOutTime!=null) {
    $('#input-datetime-checkOut').data('datetimepicker').date(moment(data.checkOutTime));
    
  }
  else
    resetCheckInOutPicker(2);

    $("#rsvtn-panel-roomname").html(data.roomname);

    $("#rsvtn-panel-payment-xID").html(data.orderID);
    $("#rsvtn-panel-payment-currency").html(data.currency);
    $("#rsvtn-panel-payment-payedAmount").html(data.payedValue);
    $("#rsvtn-panel-payment-roomrate").html(data.roomRate);
    $("#rsvtn-panel-payment-vat-rate").html(parseFloat(data.vat_rate) * 100);
    $("#rsvtn-panel-payment-vat").html(data.vat_value);
    $("#rsvtn-panel-payment-serviceCharge-rate").html(parseFloat(data.serviceCharge_rate) * 100);
    $("#rsvtn-panel-payment-serviceCharge").html(data.serviceCharge_value);
    $("#rsvtn-panel-payment-voucherValue").html(data.voucher_value);
    $("#rsvtn-panel-payment-PoS").html(data.PoS_value);
    $("#rsvtn-panel-payment-total").html(data.total);

    if( moment(data.checkOutDate).diff(moment(data.checkInDate), 'days') <= 1) {
      $('#input-date-earlyCheckOut').attr('disabled');
      $('#input-date-earlyCheckOut').addClass('d-none');
      $("#label-EarlyCheckout").text('Cannot have an early reservation due to having only 1 night stay');
    } else {
      if(data.earlyCheckout!="" && data.earlyCheckout!=null) {
        $('#input-date-earlyCheckOut').attr('disabled');
        $('#input-date-earlyCheckOut').addClass('d-none');
        $("#label-EarlyCheckout").text(moment(data.earlyCheckout).format('dddd, MMMM D YYYY'));
      } else {
        $("#label-EarlyCheckout").text('');
        $('#input-date-earlyCheckOut').attr('disabled', false);
        $('#input-date-earlyCheckOut').removeClass('d-none');
      }
    }


}

$("#table-reservation").on('click', 'tbody td:not(:first-child, .child)', function() {
  let target = $(this).parent();
  let data = table_Reservation.row( target ).data();
  let max = table_Reservation.rows().data().length;
  let rowIndex = table_Reservation.rows({ order: 'current' } ).nodes().indexOf(target[0]);
  updateRsvtnModal(data, rowIndex);
  $("#btn-modal-rsvtn-prev").attr('disabled','');
  $("#btn-modal-rsvtn-next").attr('disabled','');
  (rowIndex+1<max) &&  $("#btn-modal-rsvtn-next").removeAttr('disabled');
  (rowIndex-1>=0) &&  $("#btn-modal-rsvtn-prev").removeAttr('disabled');
  $("#reservationModal").modal('toggle');
});

function nextRecord() {
  let max = table_Reservation.rows().data().length;
  let currentIndex = parseInt($("#rsvtn-panel-id").attr('data-index'));
  $("#btn-modal-rsvtn-prev").removeAttr('disabled');
  if(currentIndex+2 >= max) {
    $("#btn-modal-rsvtn-next").attr('disabled','');
  } else {
    $("#btn-modal-rsvtn-next").removeAttr('disabled');
  }
  let data = table_Reservation.rows().data()[currentIndex+1];
  resetCheckInOutPicker();
  updateRsvtnModal(data, currentIndex+1);
}

function prevRecord() {
  let max = table_Reservation.rows().data().length;
  let currentIndex = parseInt($("#rsvtn-panel-id").attr('data-index'));
  $("#btn-modal-rsvtn-next").removeAttr('disabled');
  if(currentIndex-1 <= 0) {
    $("#btn-modal-rsvtn-prev").attr('disabled','');
  } else {
    $("#btn-modal-rsvtn-prev").removeAttr('disabled');
  }
  let data = table_Reservation.rows().data()[currentIndex-1];
  resetCheckInOutPicker();
  updateRsvtnModal(data, currentIndex-1);
}

function setPaid() {
  Swal.fire({
  title: 'Are you sure you want to update this reservation?',
  text: 'You are updating the status to paid',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes',
  cancelButtonText: 'No'
  }).then((result) => {
    if (result.isConfirmed) {
      let i = $("#rsvtn-panel-id").attr('data-index');
      let d = table_Reservation.rows().data()[i];
      let rsvID = d.reservationID;
      //console.log(rsvID );
      $.post("/admin/customFiles/php/database/reservationControls/setPaidStatus.php", {rsvid: rsvID},
        function (response, textStatus, jqXHR) {
          console.log(response);
          setTimeout(Toast.fire({
            icon: response.status,
            title: response.message
          }),1000);
          if(response.isSuccessful) {
            let target = table_Reservation.row("#"+d.reservationID);
            //console.log(">>>", target);
            target.data().reservationStatus = "1";
            target.invalidate();
            $("#rsvtn-panel-status").html(getReservationStatusBadge(1));
          }
        },
        "json"
      );
    }
  });
};

function setUnpaid() {
  Swal.fire({
  title: 'Are you sure you want to update this reservation?',
  text: 'You are updating the status to unpaid',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes',
  cancelButtonText: 'No'
  }).then((result) => {
    if (result.isConfirmed) {
      let i = $("#rsvtn-panel-id").attr('data-index');
      let d = table_Reservation.rows().data()[i];
      let rsvID = d.reservationID;
      //console.log(rsvID );
      $.post("/admin/customFiles/php/database/reservationControls/setUnPaidStatus.php", {rsvid: rsvID},
        function (response, textStatus, jqXHR) {
          console.log(response);
          setTimeout(Toast.fire({
            icon: response.status,
            title: response.message
          }),1000);
          if(response.isSuccessful) {
            let target = table_Reservation.row("#"+d.reservationID);
            //console.log(">>>", target);
            target.data().reservationStatus = "0";
            target.invalidate();
            $("#rsvtn-panel-status").html(getReservationStatusBadge(0));
          }
        },
        "json"
      );
    }
  });
};

function setCancelled() {
  Swal.fire({
  title: 'Are you sure you want to cancel this reservation?',
  text: 'The status will change to "cancelled"',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes',
  cancelButtonText: 'No'
  }).then((result) => {
    if (result.isConfirmed) {
      let i = $("#rsvtn-panel-id").attr('data-index');
      let d = table_Reservation.rows().data()[i];
      let rsvID = d.reservationID;
      //console.log(rsvID );
      $.post("/admin/customFiles/php/database/reservationControls/setCancelStatus.php", {rsvid: rsvID},
        function (response, textStatus, jqXHR) {
          console.log(response);
          setTimeout(Toast.fire({
            icon: response.status,
            title: response.message
          }),1000);
          if(response.isSuccessful) {
            let target = table_Reservation.row("#"+d.reservationID);
            //console.log(">>>", target);
            target.data().reservationStatus = "2";
            target.invalidate();
            $("#rsvtn-panel-status").html(getReservationStatusBadge(2));
          }
        },
        "json"
      );
    }
  });
};

function initiateEarlyCheckout(date, rsvid) {
  Swal.fire({
    icon: 'warning',
    title: 'This action is not reversible',
    text: 'Are you sure you want to do this?',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Yes',
    showLoaderOnConfirm: true,
    preConfirm: (login) => {
      console.log(">", login)
      return $.post("/admin/customFiles/php/database/reservationControls/setEarlyCheckOut.php", {
        "date-checkOut": date,
        rsvid: rsvid
      },
        function (data, textStatus, jqXHR) {
          return
        },
        "json"
    ).promise();
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    if (result.isConfirmed) {
      console.log(result.value);
      Swal.fire({
        icon: result.value.status,
        title: result.value.message
      })
      if(result.value.isSuccessful) {
        $('#input-date-earlyCheckOut').attr('disabled');
        $('#input-date-earlyCheckOut').addClass('d-none');
        $("#label-EarlyCheckout").text(moment(date).format('dddd, MMMM D YYYY'));
      }
    }
    $('#input-date-earlyCheckOut').data('datetimepicker').date(null);
    table_Reservation.ajax.reload();
  });
  }

  const resendEmail = (e) => {
    toggleButtonDisabled(e, "#reservationModal-buttons", "Sending...")
    let i = $("#rsvtn-panel-id").attr('data-index');
    let d = table_Reservation.rows().data()[i];
    let rsvid = d.reservationID;
    // console.log(rsvid);
    // return;
    $.post("/admin/customFiles/php/database/reservationControls/resendEmail.php", {rsvid: rsvid},
      function (response, textStatus, jqXHR) {
      toggleButtonDisabled(e, "#reservationModal-buttons", "Sending...")
      // console.log(response);
      Toast.fire({
        icon: response.status,
        title: response.message
      });
      },
      "json"
    );
  }

</script>

<!-- Script to toggle navigation buttons -->
<script>
  let activeNav = document.querySelector(".sidebar > nav > ul > li:nth-child(1)");
  if (activeNav.querySelector('ul') != null){
    activeNav.className += " menu-is-opening menu-open";
    activeNav.querySelector('.menu-open > ul > li:nth-child(1) > a').classList.toggle('active');
    activeNav.querySelector('ul').style.display = "block";
  }
  activeNav.querySelector('a:nth-child(1)').classList.toggle('active');
</script>

</body>
</html>
