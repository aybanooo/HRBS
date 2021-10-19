<?php
require("customFiles/php/directories/directories.php");
require_once(__validations__);
require_once(__outputHandler__);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <?php include __head_contents__;?>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-select/css/select.bootstrap4.min.css">
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
  <?php include_once __navigation__?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vouchers</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body d-flex justify-content-center align-middle">
                <div class="form-group mt-3">
                  <div class="custom-control custom-switch" style="transform: scale(1.5)">
                    <input type="checkbox" class="custom-control-input" id="toggleVoucher" <?php echo voucherEnabled() ? "checked" : "";?>>
                    <label class="custom-control-label d-block" for="toggleVoucher" data-toggle="collapse" data-target="voucherCard" >Enable Voucher</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card collapse show" id="voucherCard">
              <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <table id="table-vouchers" class="table table-hover dataTable">
                        <thead>
                          <tr>
                            <th>Code</th>
                            <th>Value</th>
                            <th>Minimum</th>
                            <th>Maximum</th>
                            <th>Valid Until</th>
                            <th>Label</th>
                            <th>Description</th>
                            <th>Assigned Room/s</th>
                            <th></th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
              </div>
          </div>
          </div>
        </div>
        <!-- /.row (Whole row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Add voucher modal-->
  <div class="modal fade" id="addVoucherModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Voucher</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="newVoucher">
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <input type="text" class="form-control" name="promoName" id="promoName" placeholder="Promo Label">
                </div>
                <div class="form-group">
                  <textarea class="form-control" rows="3" name="promoDesc" id="promoDesc" placeholder="Promo Description"></textarea>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" name="check-customCode" id="check-customCode"  data-toggle='collapse' data-target='#collapsediv1'>
                  <label class="form-check-label" for="check-customCode">Use custom code format</label>
                </div>
                <div id='collapsediv1' class='collapse div1'>
                  <div class="input-group my-3">
                    <input maxlength="8" type="text" class="form-control" name="format" id="format" placeholder="format" disabled>
                  </div>
                  <div class="form-group d-flex justify-content-between mb-0">
                    <div class="form-check d-inline-block">
                      <input class="form-check-input" value="1" type="radio" id="formatPlacement-prepend" name="formatPlacement" checked disabled>
                      <label class="form-check-label" for="formatPlacement-prepend">Prepend</label>
                    </div>
                    <div class="form-check d-inline-block">
                      <input class="form-check-input" value="2" type="radio" id="formatPlacement-append" name="formatPlacement" disabled>
                      <label class="form-check-label" for="formatPlacement-append">Append</label>
                    </div>
                    <div class="form-check d-inline-block">
                      <input class="form-check-input" value="0" type="radio" id="formatPlacement-none" name="formatPlacement" disabled>
                      <label class="form-check-label" for="formatPlacement-none">None</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <small class="text-muted d-block">Selecting none will only generate 1 code</small>
                      <small class="text-muted">Example: <span id="sampleCode">mh2xa5-</span></small>
                    </div>
                  </div>
                </div>
                <div class="input-group my-3 ">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Php</span>
                  </div>
                  <input type="number" class="form-control" name="value" id="value" min="1" placeholder="Value">
                </div>

                <div class="row mb-3">
                  <div class="col">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Php</span>
                      </div>
                      <input type="number" class="form-control" name="minSpend" id="minSpend" min="0" placeholder="Minimum Spend">
                    </div>
                  </div>
                  <div class="col">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Php</span>
                      </div>
                      <input type="number" class="form-control" name="maxSpend" id="maxSpend" min="0" placeholder="Maximum Spend">
                    </div>
                  </div>
                  <small class="text-muted d-block px-2">There will be no maximum or minimum spend if their value is set to 0 or empty</small>
                </div>

                <div class="d-block mb-2">
                  <div class="row">
                    <div class="col">
                      <div class="form-group m-0">
                        <input type="number" class="form-control" name="quantity" id="quantity" min="1" placeholder="Quantity">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group m-0">
                        <input type="number" class="form-control" name="maxUsage" id="maxUsage" min="1" placeholder="Maximum Usage">
                    </div>
                    </div>
                  </div>
                  <small class="text-muted d-block">Setting the maximum usage to 0 or empty will make the voucher usable infinite times.</small>
                </div>
                <!-- Date -->
                <div class="form-group">
                  <label>Expiration Date and time:</label>
                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" id="validUntilDate" name="validUntilDate" data-target="#reservationdatetime" placeholder="Valid Until"/>
                        <div class="input-group-append" id="btn-calendar">
                            <button type="button" class="btn input-group-text"><i class="fa fa-calendar"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0">
                  <label for="room">For room</label>
                  <div class="btn-group btn-group-toggle check-roomType" name="check-roomType" data-toggle="buttons">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal"><span>Cancel</span></button>
            <button type="submit" class="btn btn-primary"><span>Add</span></button>
          </div>
      </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--  Add voucher modal end -->

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
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- InputMask -->
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Moment -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/moment/moment-timezone.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js"></script>  
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>  
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="plugins/datatables-select/js/dataTables.select.min.js"></script>
<script src="plugins/datatables-select/js/select.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Special Script-->
<script src="customFiles/customScript.js"></script>
<script src="customFiles/initialize Toastr.js"></script>
<script src="customFiles/voucher.js"></script>

<script>
  

//Date range picker
$(function () {
    $('#reservationdatetime').datetimepicker({ 
      icons: { time: 'far fa-clock' },
      format: "M/D/YYYY h:m:s A Z"
    });
});

</script>

<!-- Script to toggle navigation buttons -->
<script>
  let activeNav = document.querySelector(".sidebar > nav > ul > li:nth-child(5)");
  if (activeNav.querySelector('ul') != null){
    activeNav.className += " menu-is-opening menu-open";
    activeNav.querySelector('.menu-open > ul > li:nth-child(1) > a').classList.toggle('active');
    activeNav.querySelector('ul').style.display = "block";
  }
  activeNav.querySelector('a:nth-child(1)').classList.toggle('active');
</script>
</body>
</html>
