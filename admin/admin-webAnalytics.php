<?php

require_once "customFiles/php/directories/directories.php";
require_once __F_LOGIN_HANDLER__;

// Redirect to login page if token is invalid
if (!isTokenValid()) {
  header("Location: /admin/");
  exit();
}
checkUserExistence();
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
  <!-- Special Style-->
  <link rel="stylesheet" href="customFiles/specialStyle.css">

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
  <?php include __F_NAVIGATION__;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Web Analytics</h1>
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
            <div class="card card-info">
              <div class="card-header">
                  <h3 class="card-title">
                    <div class="dropdown">
                      <button type="button" class="btn dropdown-toggle titleDropdown" data-toggle="dropdown">
                        User Accounts
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item text-body" href="#">Web Visits</a>
                        <a class="dropdown-item text-body" href="#">Average Session</a>
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
          
          <!-- 1st col -->
          <div class="col-12 col-lg-6 d-none
                      <span class="spinner-border mt-0 d-flex align-items-center" role="status" aria-hidden="true"></span>
                    ">
            <div class="row">
              <div class="col-12">
                <!-- Donut chart -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="far fa-chart-bar"></i>
                      New & Returning Visitors 
                    </h3>
                  </div>
                  <div class="card-body">
                    <div id="donut-chart" style="height: 295px;"></div>
                  </div>
                  <!-- /.card-body-->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.col -->

          <!-- 2nd col -->
          <div class="col-12">
            <div class="row">
              <div class="col-6">
                <!-- small card -->
                <div class="small-box bg-gradient-info" id="analytics-sessions">
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
                    <p>Sessions</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
    
              <div class="col-6">
                <!-- small card with time shit -->
                <div class="small-box bg-gradient-success" id="analytics-users">
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
                    <p>Website Visitors</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
    
              <div class="col-6">
                <!-- small card -->
                <div class="small-box bg-gradient-info" id="analytics-session-average">
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
                    <p>Avg. Sessions Duration (Minutes)</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-eye"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
    
              <div class="col-6">
                <!-- small card with time shit -->
                <div class="small-box bg-gradient-success" id="analytics-users-new">
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
                    <p>New Visitors</p>
                  </div>
                  <div class="icon">
                    <i class="far fa-eye"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
    
              <div class="col-6">
                <!-- small card -->
                <div class="small-box bg-gradient-info" id="analytics-page_views-per_session">
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
                    <p>Page Views Per Session</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-percent"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
    
              <div class="col-6">
                <!-- small card with time shit -->
                <div class="small-box bg-gradient-success" id="analytics-bounce_rate">
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
                    <p>Bounce Rate</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-stopwatch"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
            </div>
          </div>
          
          

        </div>
        <!-- /.row (2 column row) -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
<!-- FLOT CHARTS -->
<script src="plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot/plugins/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="plugins/flot/plugins/jquery.flot.pie.js"></script>
<!-- Special Script-->
<script src="customFiles/customScript.js"></script>
<script src="customFiles/webAnalytics.js"></script>

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
          data                : [0, 0, 2, 0, 0]
        }
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
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
    //lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })
  })

    /*
     * DONUT CHART
     * -----------
     */

    var donutData = [
    {
      label: 'Returning Visitors',
      data : 23,
      color: '#3c8dbc'
    },
    {
      label: 'New Visitors',
      data : 8,
      color: '#3ba146'
    }
  ]
  $.plot('#donut-chart', donutData, {
    series: {
      pie: {
        show       : true,
        radius     : 1,
        innerRadius: 0,
        label      : {
          show     : true,
          radius   : 2 / 3,
          formatter: labelFormatter,
          threshold: 0.1
        }

      }
    },
    legend: {
      show: false
    }
  })
  /*
    * END DONUT CHART
    */

  /*
   * Custom Label formatter
   * ----------------------
   */
   function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }
</script>

<!-- Script to toggle navigation buttons -->
<script>
  let activeNav = document.querySelector(".sidebar > nav > ul > li:nth-child(1)"); //change :nth(n) value
  if (activeNav.querySelector('ul') != null){
    activeNav.className += " menu-is-opening menu-open";
    activeNav.querySelector('.menu-open > ul > li:nth-child(2) > a').classList.toggle('active'); //change :nth(n) value
    activeNav.querySelector('ul').style.display = "block";
  }
  activeNav.querySelector('a:nth-child(1)').classList.toggle('active'); //do not change this
</script>

</body>
</html>
