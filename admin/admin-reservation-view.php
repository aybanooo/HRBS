<!DOCTYPE html>
<html lang="en">
<head>
  
  <?php include __F_HEAD_CONTENTS__;?>
  <?php print __F_BASE__;?>

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
  <?php echo __F_NAVIGATION__;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
              <span class="text-muted">Reservation #</span>
              <span class="text-normal"><?php echo $_GET['reservationID']; ?></span>
            </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
              <ul class="nav nav-pills" id="reservationModalTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="home" aria-selected="true">Info</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="billing-reservation-tab" data-toggle="tab" href="#billing-reservation" role="tab" aria-controls="billing-reservation" aria-selected="false">Reservation Billing</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="billing-incidentals-tab" data-toggle="tab" href="#billing-incidentals" role="tab" aria-controls="billing-incidentals" aria-selected="false">Incidentals Billing</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
               
                <div class="tab-content" id="reservationModalTabContent">
                  <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <div class="row">
                      <div class="col-6">
                        <div class="row">
                          <h5 class="text-secondary">Details</h5>
                        </div>
                        <div class="row mb-2">
                          <div class="col">
                            <span class="lbl mr-3">Reserved for:</span><span id="reservedFor">name here</span>
                          </div>
                        </div>
                        <div class="row mb-2">
                          <div class="col">
                            <span class="lbl mr-3">Date Reserved:</span><span id="dateReserved">Date</span>
                          </div>
                        </div>
                        <div class="row mb-2">
                          <div class="col">
                            <span class="lbl mr-3">Room:</span><span id="roomType">Room type</span>
                          </div>
                        </div>
                        <div class="row mb-2">
                          <div class="col">
                            <span class="lbl mr-3">Room #:</span><span id="roomNum">#</span>
                          </div>
                        </div>
                        <div class="row mb-2">
                          <div class="col">
                            <span class="lbl mr-3">Check-In Date:</span><span id="checkInDate">Check in date</span>
                          </div>
                        </div>
                        <div class="row mb-2">
                          <div class="col">
                            <span class="lbl mr-3">Check-Out Date:</span><span id="checkOutDate">Check out date</span>
                          </div>
                        </div>
                        <div class="row mb-2">
                          <div class="col">
                            <span class="lbl mr-3">Check-In Time:</span><span id="checkInTime">Check in time</span>
                          </div>
                        </div>
                        <div class="row mb-2">
                          <div class="col">
                            <span class="lbl mr-3">Check-Out Time:</span><span id="checkOutTime">Check out time</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="row">
                          <div class="col">
                            <h5 class="text-secondary">Incidental Charges</h5>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <table id="incidentalTable" class="table table-bordered table-sm m-0">
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="billing-reservation" role="tabpanel" aria-labelledby="billing-reservation-tab">...</div>
                  <div class="tab-pane fade" id="billing-incidentals" role="tabpanel" aria-labelledby="billing-incidentals-tab">...</div>
                </div>
              </div>
            </div>
          </div>
        </div>

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
</script>

</body>
</html>
