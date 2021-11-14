<?php

require_once("customFiles/php/directories/directories.php");
require_once __initDB__;
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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Special Style-->
  <link rel="stylesheet" href="customFiles/specialStyle.css">
  <link rel="stylesheet" href="customFiles/appearance.css">
  <link rel="stylesheet" href="customFiles/codeMirror/lib/codemirror.css">
  <link rel="stylesheet" href="customFiles/codeMirror/addons/lint/lint.css">

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
  <?php include __F_NAVIGATION__; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>System Settings</h1>
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
              <div class="card-body">
                <form id="form-defPass">
                  <div class="form-group">
                    <label for="inp-defPass"><span class="mr-3">Default Password</span><button type="button" class="btn-link d-inline p-0 m-0 bg-transparent border-0" id="btn-viewDefPas">View default password</button></label>
                    <input type="password" class="form-control" id="inp-defPass"  name="inp-defPass" placeholder="Default Password">
                    <small class="form-text text-muted">
                      <ul>
                        <li>must be between 8 and 20 characters long.</li>
                        <li>must contain atleast one uppercase</li>
                        <li>must contain atleast one lowercase</li>
                        <li>Password must contain atleast one digit</li>
                        <li>Password must contain special characters from !  @ # $ % ^ & * ? _ ~ .</li>
                      </ul>
                      </small>
                  </div>
                  <button class="btn btn-primary w-100" type="submit">Update</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card">
              <div class="card-body">
                
              </div>
            </div>
          </div>
        </div>
        
      </div>
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
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<script src="customFiles/initialize Toastr.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Password strength meter -->
<script src="plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.js"></script>
<!-- Special Script-->
<script src="customFiles/customScript.js"></script>
<script src="customFiles/buttonDisabler.js"></script>
<script src="customFiles/initialize Toastr.js"></script>
<script>

</script>

<!-- Script to toggle navigation buttons -->
<script>

  $(function () {
    $('#inp-defPass').pwstrength({
      common: {
        minChar: 8,
        maxChar: 20,
      },
      ui: {
        showVerdictsInsideProgressBar: true,
        progressBarMinPercentage: 10,
        progressExtraCssClasses: "mt-2"
      }
    });
  });

  // Set new default password
  $("#form-defPass").validate({
    onkeyup: function(element) {
      if ($("#inp-defPass").is(":focus")) 
        $(element).valid();
    },
    rules: {
      'inp-defPass': {
        strong_password: true
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
    submitHandler: function(form, e) {
      toggleButtonDisabled($(form).find('button[type="submit"]'), "#form-defPass", "Updating...");
      $.post("/admin/customFiles/php/settingsControls/setDefaultPassword.php", $(form).serializeArray(),
        function (response, textStatus, jqXHR) {
          //console.log(response);
          Toast.fire({
            icon: response.status,
            title: response.message
          });
          $(form).trigger('reset');
          $(form).find('ul > li').attr('class', 'text-normal');
          $("#inp-defPass").pwstrength("forceUpdate");
          toggleButtonDisabled($(form).find('button[type="submit"]'), "#form-defPass", "Updating...");
        },
        'json'
      );
    }
  });

  $.validator.addMethod("strong_password", function (value, element) {
    let password = value;
    if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*?_~.])(.{8,20}$)/.test(password))) {
        return false;
    }
    $(element).siblings('small').children('ul').children().attr('class', 'text-success');
    return true;
  }, function (value, element) {
    let password = $(element).val();
    if (!(/^(.{8,20}$)/.test(password))) {
      $(element).siblings('small').children('ul').children().eq(0).attr('class', 'text-danger');
    } else {
      $(element).siblings('small').children('ul').children().eq(0).attr('class', 'text-success');
    }
    if (!(/^(?=.*[A-Z])/.test(password))) {
      $(element).siblings('small').children('ul').children().eq(1).attr('class', 'text-danger');
    } else {
      $(element).siblings('small').children('ul').children().eq(1).attr('class', 'text-success');
    }
    if (!(/^(?=.*[a-z])/.test(password))) {
      $(element).siblings('small').children('ul').children().eq(2).attr('class', 'text-danger');
    } else {
      $(element).siblings('small').children('ul').children().eq(2).attr('class', 'text-success');
    }
    if (!(/^(?=.*[0-9])/.test(password))) {
      $(element).siblings('small').children('ul').children().eq(3).attr('class', 'text-danger');
    } else {
      $(element).siblings('small').children('ul').children().eq(3).attr('class', 'text-success');
    }
    if (!(/^(?=.*[!@#$%^&*?_~.])/.test(password))) {
      $(element).siblings('small').children('ul').children().eq(4).attr('class', 'text-danger');
    } else {
      $(element).siblings('small').children('ul').children().eq(4).attr('class', 'text-success');
    }
    return false;
  });

  $("#btn-viewDefPas").click(() => {
    $.get("customFiles/php/settingsControls/viewDefPass.php", null,
      function (response, textStatus, jqXHR) {
        Swal.fire({
          icon: 'warning',
          title: 'Default Password',
          text: response.data,
          showConfirmButton: false
        });
      },
      'json'
    );
    
  });

  let activeNav = document.querySelector(".sidebar > nav > ul > li:nth-child(6)"); //change :nth(n) value
  if (activeNav.querySelector('ul') != null){
    activeNav.className += " menu-is-opening menu-open";
    activeNav.querySelector('.menu-open > ul > li:nth-child(1) > a').classList.toggle('active'); //change :nth(n) value
    activeNav.querySelector('ul').style.display = "block";
  }
  activeNav.querySelector('a:nth-child(1)').classList.toggle('active'); //do not change this
</script>

</body>
</html>