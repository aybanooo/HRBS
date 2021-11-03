<?php

require_once("customFiles/php/directories/directories.php");
require_once __initDB__;

if(mysqli_num_rows($result = mysqli_query($conn, "SELECT * FROM `companyinfo` LIMIT 1;")) != 1)
  echo "N/A";
$companyInfo = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hotel Reservation System Admin</title>

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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Special Style-->
  <link rel="stylesheet" href="customFiles/specialStyle.css">
  <link rel="stylesheet" href="customFiles/login.css">
  <link rel="stylesheet" href="customFiles/overrideStyle.css">
  

</head>
<body class="layout-fixed">
<span id="loginBGImage"></span>
  <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
    <form id="form-login" class="card p-4">
      <div class="card-body">
        <div class="row mb-4">
          <div class="col-12 text-center">
            <h1 class="d-block text-uppercase text-white"><?php print $companyInfo['companyName'];?></h1>
            <h4 class="d-block text-white">Hotel Reservation and Billing System</h4>
          </div>
        </div>
        <div class="row">
            <div class="col-12">
              <div class="form-group">
                <input type="text" class="form-control" id="inp-empID" name="inp-empID" placeholder="Employee ID">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="inp-password" name="inp-password" placeholder="Password">
              </div>
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
        </div>
      </div>
    </form>
  </div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Jquery Validation -->
<script src="plugins/jquery-validation/jquery.validate.js"></script>
<script src="plugins/jquery-validation/additional-methods.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Special Script-->
<script src="customFiles/customScript.js"></script>
<!-- Page Specific Script-->
<script>

$("#form-login").validate({
  rules: {
    "inp-empID": {
      required: true,
    },
    "inp-password": {
      required: true,
    }
  },
  errorElement: 'span',
  errorPlacement: function (error, element) {
    error.addClass('invalid-feedback');
    element.closest('.form-group').append(error);
  },
  highlight: function (element, errorClass, validClass) {
    $(element).addClass('is-invalid');
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).removeClass('is-invalid');
  },
  submitHandler: (form) => {
    console.log("gegege");
  }
});


</script>
</body>
</html>
