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
    include(__D_UI__."js/analytics.php");
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
  <!-- Special Style-->
  <link rel="stylesheet" href="customFiles/specialStyle.css">
  <link rel="stylesheet" href="customFiles/overrideStyle.css">

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
        <div class="row">
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
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>Reservations</p>
              </div>
              <div class="icon">
                <i class="fas fa-book"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53</h3>
                <p>Cleared Reservations</p>
              </div>
              <div class="icon">
                <i class="fas fa-check-circle"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>Available Room</p>
              </div>
              <div class="icon">
                <i class="fas fa-door-open"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

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
            <div class="table-responsive">          
            <table id="rsvTable" class="table borderless reservationTable">
              <thead>
                <tr>
                  <th>Reservation ID</th>
                  <th>name</th>
                  <th>Date</th>
                  <th>Room</th>
                  <th>Room #</th>
                  <th>Check-In Date</th>
                  <th>Check-Out Date</th>
                  <th>Check-In Time</th>
                  <th>Check-Out Time</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Mimi Yun</td>
                  <td>2020-10-23</td>
                  <td>Royal Penthouse Suite</td>
                  <td>503</td>
                  <td>2021-04-13</td>
                  <td>2020-04-18</td>
                  <td>6:45</td>
                  <td>15:30</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Trevor Weesley</td>
                  <td>2020-10-01</td>
                  <td>Imperial Suite</td>
                  <td>444</td>
                  <td>2020-10-02</td>
                  <td>2020-10-07</td>
                  <td>2:45</td>
                  <td>20:30</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>George Bush</td>
                  <td>2020-10-23</td>
                  <td>Imperial Suite</td>
                  <td>314</td>
                  <td>2020-10-24</td>
                  <td>2020-10-26</td>
                  <td>16:55</td>
                  <td>8:31</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Sasha Grey</td>
                  <td>2020-10-23</td>
                  <td>Royal Penthouse Suite</td>
                  <td>521</td>
                  <td>2021-04-13</td>
                  <td>2020-04-18</td>
                  <td>12:12</td>
                  <td>18:11</td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Michael Truman</td>
                  <td>2020-10-23</td>
                  <td>Imperial Suite</td>
                  <td>444</td>
                  <td>2020-12-02</td>
                  <td>2020-12-07</td>
                  <td>11:19</td>
                  <td>10:47</td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Eliar Fox</td>
                  <td>2021-01-13</td>
                  <td>Royal Penthouse Suite</td>
                  <td>522</td>
                  <td>2021-01-29</td>
                  <td>2021-02-2</td>
                  <td>13:01</td>
                  <td>15:26</td>
                </tr>
              </tbody>
            </table>
            </div>
          </div>
        </div>
        <!-- Data Table End -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Reservation view modal -->
  <div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="reservationModalTitle"><strong id="reservationID">#</strong> Reservation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Reservation view modal END-->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020-2021 <a href="#">Link Here</a>.</strong> All rights reserved.
  </footer>


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
<!-- Special Script-->
<script src="customFiles/initialize Toastr.js"></script>
<script src="customFiles/reservation_incidentals.js"></script>
<script src="customFiles/customScript.js"></script>

<script>
  $(function () {
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
  })
</script>
<!-- Table script -->
<script>
 $(document).ready(function () {
  $('#rsvTable').DataTable( {
  "columnDefs": [
    { "width": "10%", "targets": 0 }
  ]
});
  $('.dataTables_length').addClass('bs-select');
});


  $(document).ready(function(){
  $("#incidentalTableSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#incidentalTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});


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
