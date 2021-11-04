<?php

require_once "customFiles/php/directories/directories.php";
require_once __F_LOGIN_HANDLER__;

// Redirect to login page if token is invalid
if (!isTokenValid()) {
  header("Location: /admin/");
  exit();
}
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <?php include __F_HEAD_CONTENTS__;?>

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
            <h1>My Account</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-widget widget-user shadow">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username"><?php print "{$_SESSION['userInfo']['first_name']} {$_SESSION['userInfo']['last_name']}";  ?></h3>
                <h5 class="widget-user-desc">Staff</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="/admin/assets/images/profilePictures/<?php print $_SESSION['userInfo']['id'].".jpg?".time() ?>" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">
                        <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <?php print $_SESSION['userInfo']['contact_number'];  ?>
                        </a>
                      </h5>
                      <span class="description-text">Contact #</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php print $_SESSION['userInfo']['id']; ?></h5>
                      <span class="description-text">employee ID</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">
                        <a class="collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Change
                        </a>
                      </h5>
                      <span class="description-text">Password</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row d-flex justify-content-center">
                  <div class="col-6">
                    <div id="accordion">
                        <div id="collapseOne" class="collapse fade" aria-labelledby="headingOne" data-parent="#accordion">
                            <form id="form-changePass">
                              <br>
                              <br>
                              <div class="form-group">
                                <input type="password" class="form-control" id="inp-oldPass" name="inp-oldPass"  placeholder="Old Password">
                              </div>
                              <div class="form-group">
                                <input type="password" name="inp-newPass" class="form-control" id="inp-newPass" placeholder="New Password">
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
                              <div class="form-group">
                                <input type="password" name="inp-newRePass" class="form-control" id="inp-newRePass" placeholder="Repeat New Password">
                              </div>
                              <div class="form-group">
                                <button type="submit"id="btn-submit-changePass" class="btn btn-primary btn-block">Submit</button>
                              </div>
                            </form>
                          </div>

                        <div id="collapseTwo" class="collapse fade" aria-labelledby="headingTwo" data-parent="#accordion">
                          <form>
                            <br>
                            <br>
                            <div class="form-group">
                              <input type="password" name="newContact" class="form-control" id="newContact" placeholder="New Contact #">
                            </div>
                            <div class="form-group">
                              <input type="password" name="currPass" class="form-control" id="currPass" placeholder="Current Password">
                            </div>
                            <div class="form-group">
                              <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                          </form>
                        </div>

                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="row">
        
        </div>
        <div class="row">

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
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Special Script-->
<script src="customFiles/customScript.js"></script>
<script src="customFiles/initialize Toastr.js"></script>
<script src="customFiles/buttonDisabler.js"></script>
<script>

$("#form-changePass").validate({
  rules: {
    "inp-newPass": {
      required: true,
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
  submitHandler:  (form, e) => {
    toggleButtonDisabled("#btn-submit-changePass", "#form-changePass", "Please Wait...");
     $.post("/admin/customFiles/php/database/employeeAccountControls/changePassword.php", $(form).serialize(),
      function (response, textStatus, jqXHR) {
        toggleButtonDisabled("#btn-submit-changePass", "#form-changePass", "Please Wait...");
        Toast.fire({
          icon: response.status,
          title: response.message
        });
        if(response.isSuccessful) {
          $(form).trigger('reset');
          $(form).find(".form-group small.form-text li").removeClass('text-success');
        }
      },
      "json"
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

</script>

<!-- Script to toggle navigation buttons -->
<script>
  let activeNav = document.querySelector(".sidebar > nav > ul > li:nth-child(6)"); //change :nth(n) value
  if (activeNav.querySelector('ul') != null){
    activeNav.className += " menu-is-opening menu-open";
    activeNav.querySelector('.menu-open > ul > li:nth-child(4) > a').classList.toggle('active'); //change :nth(n) value
    activeNav.querySelector('ul').style.display = "block";
  }
  activeNav.querySelector('a:nth-child(1)').classList.toggle('active'); //do not change this
</script>

</body>
</html>
