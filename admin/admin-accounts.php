<?php

require_once("customFiles/php/directories/directories.php");
require_once __initDB__;


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
  <link rel="stylesheet" href="customFiles/croppie/croppie.css" />
  

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
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
  <?php include __navigation__?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="display-1">Accounts</h1>
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
              <!-- /.card-header -->
              <div class="card-body">
                <table id="accountTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="no-sort sorting_disabled">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="selectAll">
                        <label class="form-check-label" for="selectAll">Select All</label>
                      </div>
                    </th>
                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Contact</th>
                    <th>Role(s)</th>
                    <th class="no-sort text-center">Password</th>
                  </tr>
                  </thead>
                  <tbody>
            
                  </tbody>
                  <tfoot>
                  <tr>
                    <th></th>
                    <th>Employee ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Contact</th>
                    <th>Role</th>
                    <th></th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card card-warning collapsed-card" id="roles">
              <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                <h3 class="card-title">Roles</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="rolesBody">
                <div class="row mb-3">
                  <div class="col">
                    <button onclick="newRole(this)"type="button" class="btn btn-default"><span>Create a new role</span></button>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
      
      <div class="modal fade" id="addAccountModal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add an account</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="newAccForm">
            <div class="modal-body">
              <div class="row">
                <div class="col-12 col-md-6 pb-4 pb-md-0 d-flex align-items-center">
                  <button type="button" class="btn btn-block btn-default upload-result d-none">Result</button>
                  <div class="upload-div container">
                    <div class="upload-msg">
                      <img src="./assets/images/defaults/profilePicture.jpg" width="200" height="200" />
                    </div>
                    <div class="upload-div-container container">

                    </div>
                  </div>
                  <!--<div class="container elevation-2 p-0" id="newAccImage">
                    <div class="newAccImageOverlay d-none d-md-inline-block ">
                      <div class="container h-100 w-100 d-flex align-items-center">
                        <div class="container w-100 m-4">
                          <div class="row">
                            <div class="col-12">
                              <button type="button" class="btn btn-block btn-outline-secondary mb-1" onclick="alert('changed?')">Change</button>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <button type="button" class="btn btn-block btn-outline-secondary mt-1" onclick="removeNewAccImg()">Remove</button>
                            </div>
                          </div>
                      </div>
                    </div>
                    </div>
                    <img class="h-100 w-100" src="dist/img/user2-160x160.jpg" alt="User Image" id="newAccImg">
                  </div>-->
                </div>
                <!--<div class="col-12 d-block d-md-none">-->
                <div class="col-12 d-none">
                  <div class="container pb-4">
                    <div class="row">
                      <div class="col-6">
                        <button type="button" class="btn btn-block btn-default">Change</button>
                      </div>
                      <div class="col-6">
                        <button type="button" class="btn btn-block btn-default">Remove</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="profilePicture" accept="image/jpg, image/jpeg">
                        <label class="custom-file-label" for="profilePicture">User picture  </label>
                      </div>
                      <div class="input-group-append" id="removeFile" >
                        <span class="input-group-text" id="" style="cursor: pointer;"><i class="fa fa-times"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <input type="text" name="empID" class="form-control" id="inputEmpID" placeholder="Employee ID">
                  </div>
                  <div class="form-group">
                      <input type="text" name="fname" class="form-control" id="inputFname" placeholder="First Name">
                  </div>
                  <div class="form-group">
                      <input type="text" name="lname" class="form-control" id="inputLname" placeholder="Last Name">
                  </div>
                  <div class="form-group">
                      <input type="text" name="contact" class="form-control" id="inputContact" placeholder="Enter contact #">
                  </div>
                  <div class="form-group mb-0">
                    <select class="custom-select" id="inputRole">
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" onsubmit="return false">Create</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="resetPassModal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Confirm Password Reset</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="resetPassForm">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                      <input type="text" name="resetPasswordID" class="form-control"  id="inputResetPasswordID" placeholder="Employee ID" disabled>
                  </div>
                  <div class="form-group">
                      <input type="password" name="password" class="form-control"  id="inputResetPassword" placeholder="Enter your password">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" onsubmit="return false">Reset</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="changeRoleNameModal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Role Name</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="changeRoleNameForm" method="POST" action="./customFiles/php/database/roleControls/updateRoleName.php">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                      <input type="text" name="oldRoleName" class="form-control" id="oldRoleName" placeholder="old Role Name" readonly="readonly">
                  </div>
                  <div class="form-group">
                      <input type="text" name="newRoleName" class="form-control" id="newRoleName" placeholder="New Role Name">
                  </div>
                  <div class="form-group">
                      <input type="password" id="password" name="password" class="form-control" id="changeRolePassword" placeholder="Enter your password">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!-- Change account role modal -->
      <div class="modal fade" id="changeAccRoleModal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Role</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="changeAccRoleForm">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                      <input type="text" name="empIDChangeRole" class="form-control" id="empIDChangeRole" placeholder="Employee ID" disabled>
                  </div>
                  <div class="form-group">
                    <select class="custom-select" id="inputChangeAccRole">
                    </select>
                  </div>
                  <div class="form-group">
                      <input type="password" name="password" class="form-control" id="changeRolePassword" placeholder="Enter your password">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" onsubmit="return false">Save</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

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
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Special Script-->
<script src="customFiles/croppie/croppie.js"></script>
<script src="customFiles/customScript.js"></script>
<script src="customFiles/buttonDisabler.js"></script>
<script src="customFiles/rolse.js"></script>
<script>
  var Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 3500
    });

    var table = $("#accountTable").DataTable({
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": false,
      "searching": true,
      "lengthMenu": [5, 10, 15, 25],
      "pageLength": 10,
      "buttons": [
        {
          attr: {
            'data-toggle': 'modal',
            'data-target':'#addAccountModal'
          },
          text: 'Add',
          className: 'btn btn-success'
        },
        {
          text: 'Delete',
          className: 'btn btn-danger',
          action: function() {
            deleteAccounts();
          }
        },
        {
          attr: {
            'id':'refreshAccList'
          },
          text: 'Refresh',
          action: function() {
            $("#refreshAccList").prop('disabled', true);
            $("#refreshAccList > span").text('');
            $("#refreshAccList > span").toggleClass('fas fa-circle-notch fa-spin');
            generateAccountTableEntries();
            setTimeout(function() {
              $("#refreshAccList").prop('disabled', false);
              $("#refreshAccList > span").text('Refresh');
              $("#refreshAccList > span").toggleClass('fas fa-circle-notch fa-spin');
            }, 500);
          }
        }
      ],
      columnDefs: [ 
        {orderable: false, "searchable": false, width: "100px", orderable: false, targets: 0 },
        {orderable: false, "searchable": false, orderable: false, targets: 4 }
      ]
    });
    table.buttons().container().appendTo('#accountTable_wrapper .col-md-6:eq(0)');



  var checkbox = String.raw` <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                      </div>`;

  var editButton = String.raw`<a data-toggle="modal" data-target="#resetPassModal" href="javascript: void(0)" class="hoverable-primary">Reset</a>`;
  
$(document).ready(function(){
  //$('#accountTable tr td:first-child').append(checkbox);
  //$('#accountTable tr td:last-child').append(editButton);

  $("#accountTable").on('click', '#selectAll', function() {
    var checkBox = $(this);
    checkBox.prop("checked", !checkBox.prop("checked"));
    $('#accountTable').find('input[type=checkbox]').prop("checked", !checkBox.prop("checked"));
  });

  $("#accountTable").on("click","td:first-child", function(){
      var checkBox = $(this).find('input[type=checkbox]');
      checkBox.prop("checked", !checkBox.prop("checked"));
  });

  $("#accountTable").on("click", "a[data-target=\"#resetPassModal\"]",function () {
     $("#inputResetPasswordID").val( $(this).data("value") );
  });

  $uploadCrop = $('.upload-div-container').croppie({
    enableExif: true,
    viewport: {
      height: 190,
      width: 190,
      type: 'circle'
    },
    boundary: {
      height: 200
    }
  });

  $("#removeFile").on("click", function() {
    $("#profilePicture").val(null);
    $(".custom-file-label[for=\"profilePicture\"]").text('User Picture');
    $('.upload-div').removeClass('ready');
  });

});

$.validator.setDefaults({
    submitHandler: function () {
      console.log('submited');
    }
  });

$('#resetPassForm').validate({
  rules: {
    password: {
        required: true
      }
    },
    messages: {
      password: {
        required: "Please provide a password",
      },
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
    submitHandler: function () {
      
      $.ajax({
        type: 'post',
        url: 'customFiles/php/database/userControls/resetPassword.php',
        data: {
          empID: $("#inputResetPasswordID").val()
        },
        async: false,
        success: function (response){
          if(parseInt(response)){
            Toast.fire({
              icon: 'success',
              title: 'Password have been reset'
           });
          }
          else {
            Toast.fire({
              icon: 'error',
              title: 'Failed to reset password'
           });
          }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          Toast.fire({
              icon: 'error',
              title: 'Failed to update role. Something went wrong when reaching the server.'
          });
          console.log(errorThrown);
        }
      });

        Toast.fire({
                icon: 'success',
                title: 'The password have been reset.'
                });
        $('#resetPassModal').click();
        $('#inputResetPassword').val('');
        $('#inputResetPasswordRepeat').val('');
    }
});

$('#changeAccRoleForm').validate({
    rules: {
      password: {
        required: true,
      }
    },
    messages: {
      password: {
        required: "Please provide a password",
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
    submitHandler: function () {
      newRole = $('#inputChangeAccRole option:selected').text();
      findThis = $('#empIDChangeRole').val();
      $('#accountTable').find(`td:contains('${findThis}')`).parent(0).find('.changeAccRole').text(newRole);
      $('#changeAccRoleModal').click();
      countRoles();
      refreshRoleCount();//changeAccArole

      console.log("bagong role "+$('#inputChangeAccRole option:selected').val());
      console.log("id " + findThis);
      $.ajax({
        type: 'post',
        url: 'customFiles/php/database/userControls/changeAccArole.php',
        data: {
          empID: findThis,
          newAccessID: $('#inputChangeAccRole option:selected').val()
        },
        success: function (response){
          if(parseInt(response)){
            Toast.fire({
              icon: 'success',
              title: 'Role have been successfully updated.'
           });
          }
          else {
            Toast.fire({
              icon: 'error',
              title: 'Role update failed. '+response
           });
          }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          Toast.fire({
              icon: 'error',
              title: 'Failed to update role. Something went wrong when reaching the server.'
          });
          console.log(errorThrown);
        }
      });

    }
  });

$('#changeRoleNameForm').submit(function(e) {
    e.preventDefault();
}).validate({
  rules: {
    newRoleName: {
      required: true
    }
  },
  messages: {
    newRoleName: {
      required: "Please provide a role name."
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
  submitHandler: function() {
    oldRoleName = $('#oldRoleName').val();
    newRoleName = $('#newRoleName').val();
    password = $('#password').val();
    updateRoleName(oldRoleName, newRoleName, password);
    changeRoleName(oldRoleName, newRoleName);
    $('#changeRoleNameModal').click();
    $('#changeRoleNameForm').trigger("reset");
    return false;
  }
});

$('#changeRoleForm').validate({
  rules: {
    oldRoleName: {
      required: true
    },
    newRoleName: {
      required: true
    },
    password: {
      required: true,
    }
  },
  messages: {
    password: {
      required: "Please provide a password",
      minlength: "Your password must be at least 8 characters long",
      equalTo: "Password does not match"
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
  }
});

$('#newAccForm').validate({
    rules: {
      empID : {
        required: true,
        remote: "customFiles/php/database/userControls/checkEmpIdExistence.php"
      },
      contact: {
        required: true
      },
      fname : {
        required: true
      },
      lname : {
        required: true
      },
      password: {
        required: true,
        minlength: 8,
        equalTo: "#inputPasswordRepeat"
      },
      repassword: {
        required: true,
        minlength: 8,
        equalTo: "#inputPassword"
      },
    },
    messages: {
      empID: {
        required: "This field cannot be empty."
      },
      contact: {
        required: "Please enter a contact #",
      },
      fname: {
        required: "This field cannot be empty."
      },
      lname: {
        required: "This field cannot be empty."
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 8 characters long",
        equalTo: "Password does not match"
      },
      repassword: {
        required: "Please repeat the password",
        minlength: "Password does not match",
        equalTo: "Password does not match"
      },
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
    submitHandler: function () {
      createAccount();
    }
  });

  function generateAccountTableEntries() {
    table.clear().draw();
    $.ajax({
      type: 'post',
      url: 'customFiles/php/database/userControls/generateAccountTableEntries.php',
      async: false,
      success: function (response) {
        parsedResponse = JSON.parse(response);
        console.log(parsedResponse);
        parsedResponse.forEach((entry) => {
          console.log(entry.empID);
          checkboxWithID = String.raw` <div class="form-check">
                        <input type="checkbox" class="form-check-input accountCheckbox" value="${entry.empID}">
                      </div>`;
          editButtonWithID = String.raw`<a data-toggle="modal" data-target="#resetPassModal" href="javascript: void(0)" class="hoverable-primary" data-value="${entry.empID}">Reset</a>`;
                      nodedRole = `<a data-toggle="modal" data-target="#changeAccRoleModal" href="javascript: void(0)" class="hoverable-primary changeAccRole" data-value="${entry.empID}">${entry.accessname}</a>`;
          table.row.add( [
            checkboxWithID,
            entry.empID,
            entry.fName,
            entry.lName,
            entry.contact,
            nodedRole,
            editButtonWithID
        ] ).draw( false );
        });
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        Toast.fire({
            icon: 'error',
            title: 'Failed to add user.'
        });
        console.log(errorThrown);
      }
    });
/*
    table.row.add( [
            checkbox,
            empID,
            fname,
            lname,
            contact,
            roleA,
            editButton
        ] ).draw( false );
        */
  }

  function createAccount(){

    $('#addAccountModal').click();
    var empID = document.getElementById('inputEmpID').value;
    var fname = document.getElementById('inputFname').value;
    var lname = document.getElementById('inputLname').value;
    var contact = document.getElementById('inputContact').value;
    var role = document.getElementById('inputRole').value;
    roleA = `<a data-toggle="modal" data-target="#changeAccRoleModal" href="javascript: void(0)" class="hoverable-primary changeAccRole">${document.getElementById('inputRole').options[document.getElementById('inputRole').selectedIndex].text}</a>`;
    //console.log(empID + " " + contact);

    $.ajax({
      type: 'post',
      url: 'customFiles/php/database/userControls/addUser.php',
      data: {
        empID:empID,
        fName:fname,
        lName:lname,
        contact:contact,
        accessID:role,
        role:role
      },
      async: false,
      success: function (response) {
        addPictureToDB(empID)
        console.log("user is added? "+response);
        checkboxWithID = String.raw` <div class="form-check">
                        <input type="checkbox" class="form-check-input accountCheckbox" value="${empID}">
                      </div>`;
        editButtonWithID = String.raw`<a data-toggle="modal" data-target="#resetPassModal" href="javascript: void(0)" class="hoverable-primary" data-value="${empID}">Reset</a>`;

        if(parseInt(response)) {
          Toast.fire({  
              icon: 'success',
              title: 'Account have been successfuly created.'
          });
          table.row.add( [
          checkboxWithID,
            empID,
            fname,
            lname,
            contact,
            roleA,
            editButtonWithID
        ] ).draw( false );
        }
        else
          Toast.fire({
              icon: 'error',
              title: 'Failed to add user.'
          });
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        Toast.fire({
            icon: 'error',
            title: 'Failed to add user.'
        });
        console.log(errorThrown);
      }
    });
    countRoles();
    refreshRoleCount();
  }

  function deleteAccounts() {
    var n=0;
    var accs = [];
    document.getElementById('accountTable').querySelectorAll('input[type="checkbox"]:checked').forEach(function(el) {
      accs.push(parseInt(el.value));
      n++;
    });


    
    $.ajax({
        type: 'post',
        url: 'customFiles/php/database/userControls/deleteAccounts.php',
        data: {
          accountList: JSON.stringify(accs).replace("[","(").replace("]",")"),
          rawAccList: JSON.stringify(accs)
        },
        success: function (response){
          console.log(response ? response+"gegege" : response+"pols");
          if(parseInt(response)){
            
            document.getElementById('accountTable').querySelectorAll('input[type="checkbox"]:checked').forEach(function(el) {
              table.row(el.parentElement.parentElement.parentElement)
              .remove().draw();
            });

            Toast.fire({
              icon: 'success',
              title: 'Account\'s have been successfuly deleted.'
           });
          }
          else {
            Toast.fire({
              icon: 'error',
              title: 'Something went wronge while deleting accounts. Please refresh the page.'
           });
          }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          Toast.fire({
              icon: 'error',
              title: 'Failed to delete accounts. Something went wrong when reaching the server.'
          });
          console.log(errorThrown);
        }
      });
  }

  $(function () {
  bsCustomFileInput.init();
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.upload-div-container cr-image').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  } else {
    alert('select a file to see preview');
    $('.upload-div-container cr-image').attr('src', '');
  }
}

var $uploadCrop;

function readFile(input) {
   if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function (e) {
      $('.upload-div').addClass('ready');
            $uploadCrop.croppie('bind', {
              url: e.target.result
            }).then(function(){
              console.log('jQuery bind complete');
            });
            
          }
          reader.readAsDataURL(input.files[0]);
      }
      else {
        swal("Sorry - you're browser doesn't support the FileReader API");
    }
}

function logResult(result) {
		var html;
		if (result.html) {
			html = result.html;
		}
		if (result.src) {
			html = '<img src="' + result.src + '" />';
		}
    //console.log(result);
    console.log('%c ', "font-size:400px; background:url("+result.src+") no-repeat;");
	}

$('#profilePicture').on('change', function () { console.log( this.files[0] );readFile(this); });

function addPictureToDB(empID) {

  //console.log($('#profilePicture')[0].files.length);

  $uploadCrop.croppie('result', {
    type: 'blob',
    size: 'viewport',
    format: 'jpg',
    circle: false
  }).then(function (resp) {
    
    var fd = new FormData();
    var files = $('#profilePicture')[0].files;
    console.log((files.length > 0) + " < this");
    if(files.length > 0 ){
      fd.append('file',resp, empID+".jpg");
      $.ajax({
        url: 'customFiles/php/database/userControls/uploadImage.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){

          console.log(response);

            if(response != 0){
              console.log("File uploaded");
              $("#newAccForm").trigger("reset");
              //$("#img").attr("src",response); 
              //$(".preview img").show(); // Display image element
            }else{
              console.log("File not uploaded");
            }
            
        }
      });

    }
    else {
      $.ajax({
        url: 'customFiles/php/database/userControls/uploadImage.php',
        type: 'post',
        data: {
          empID: empID
        },
        success: function(response){
          console.log(response);
            if(response != 0){
              $("#newAccForm").trigger("reset");
              console.log("File uploaded");
              //$("#img").attr("src",response); 
              //$(".preview img").show(); // Display image element
            }else{
              console.log("File not uploadedss\n"+response);
            }
        },
      });
      //alert("Please select a file.");
    }

    //logResult( {src: resp} );
  });
  
  $('.upload-div').removeClass('ready');
}

//$('.upload-result').click();

/*$("#profilePicture").change(function() {
  readFile(this);
});*/

  generateAccountTableEntries();
</script>
<link rel="stylesheet" href="customFiles/overrideStyle.css">

<!-- Script to toggle navigation buttons -->
<script>
  let activeNav = document.querySelector(".sidebar > nav > ul > li:nth-child(3)"); //change :nth(n) value
  if (activeNav.querySelector('ul') != null){
    activeNav.className += " menu-is-opening menu-open";
    activeNav.querySelector('.menu-open > ul > li:nth-child(1) > a').classList.toggle('active'); //change :nth(n) value
    activeNav.querySelector('ul').style.display = "block";
  }
  activeNav.querySelector('a:nth-child(1)').classList.toggle('active'); //do not change this
</script>

</body>
</html>
