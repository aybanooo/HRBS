<?php

require_once("customFiles/php/directories/directories.php");
require_once __initDB__;
require_once __F_LOGIN_HANDLER__;
require_once __F_DB_HANDLER__;

// Redirect to login page if token is invalid
if (!isTokenValid()) {
  header("Location: /admin/");
  exit();
}
checkUserExistence();
session_start();
setupUserSession();

$conn_displayable_data = createTempDBConnection();
$result = mysqli_query($conn_displayable_data, "SELECT * FROM `settings` WHERE `name` in('tax', 'serviceCharge');");
$displayable_data = [];
while($r = mysqli_fetch_assoc($result))
  $displayable_data[$r['name']] = $r['value'];  
mysqli_close($conn_displayable_data);
unset($result, $conn_displayable_data);
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
  <link rel="stylesheet" href="customFiles/appearance.css">
  <link rel="stylesheet" href="customFiles/codeMirror/lib/codemirror.css">
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
            <h1>Billing</h1>
          </div>
          <div class="col-sm-6">
            <div class="row mt-3 mt-sm-0 ">
              <div class="col-6"></div>
              <div class="col-6">
                <a href="javascript: void(0)"><button type="submit" class="btn btn-success btn-block" onclick="save(this)">Save</button></a>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label for="inp-tax">Tax <small class="text-muted">(in percentage)</small></label>
                  <div class="input-group">
                    <input type="number" min="0" max="100" class="form-control" id="inp-tax" placeholder="Tax rate" pattern="^[1-9]$" value="<?php print $displayable_data['tax']; ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inp-tax">Service Charge <small class="text-muted">(in percentage)</small></label>
                  <div class="input-group">
                    <input type="number" min="0" max="100" class="form-control" id="inp-srvc_charge" placeholder="Service charge rate" pattern="^[1-9]$" value="<?php print $displayable_data['serviceCharge']; ?>" > 
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row d-none">
            <div class="col-12 col-sm-6">
            <div class="card">
              <div class="card-header">
                <h3>Incidental Charge</h3>
              </div>
              <div class="card-body">

                <div class="row">
                  <div class="col" id="appendIncidentalCharge">
                    <div class="row">
                      <div class="col d-none">
                        <input type="hidden" class="form-control" id="pk" value="0">
                      </div>
                      <div class="col-8">
                        <input type="text" class="form-control" id="" placeholder="Label">
                      </div>
                      <div class="col-3">
                        <input type="number" class="form-control" id="" min="0" placeholder="Charge">
                      </div>
                      <div class="col-1 d-flex justify-content-center align-items-center">
                        <button class="btn btn-default"><i class="fas fa-times"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col d-flex justify-content-center">
                    <button class="btn btn-block btn-default">Add</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
<!-- Special Script-->
<script src="customFiles/customScript.js"></script>
<script src="customFiles/initialize Toastr.js"></script>
<script src="customFiles/buttonDisabler.js"></script>
<script src="customFiles/codeMirror/lib/codemirror.js"></script>
<script src="customFiles/codeMirror/mode/css/css.js"></script>
<script src="customFiles/billing.js"></script>
<script>

var origText = "";

$(".ce-noblank").on("focus","*[contentEditable=\"True\"]", function(){
  origText = $(this).text();
});

$(".ce-noblank").on("focusout","*[contentEditable=\"True\"]", function(){
  if($(this).text()==""){
    $(this).text(origText);
  } 
});

$(".ce-blankremove").on("focusout","*[contentEditable=\"True\"]", function(){
  if($(this).text()==""){
    $(this).closest('li').remove();
  } 
});

settings = {
      maxLen: 25,
    }

    keys = {
      'backspace': 8,
      'shift': 16,
      'ctrl': 17,
      'alt': 18,
      'delete': 46,
      // 'cmd':
      'leftArrow': 37,
      'upArrow': 38,
      'rightArrow': 39,
      'downArrow': 40,
    }

    utils = {
      special: {},
      navigational: {},
      isSpecial(e) {
        return typeof this.special[e.keyCode] !== 'undefined';
      },
      isNavigational(e) {
        return typeof this.navigational[e.keyCode] !== 'undefined';
      }
    }

    utils.special[keys['backspace']] = true;
    utils.special[keys['shift']] = true;
    utils.special[keys['ctrl']] = true;
    utils.special[keys['alt']] = true;
    utils.special[keys['delete']] = true;

    utils.navigational[keys['upArrow']] = true;
    utils.navigational[keys['downArrow']] = true;
    utils.navigational[keys['leftArrow']] = true;
    utils.navigational[keys['rightArrow']] = true;

    $(".ce-noenter").on("keydown","*[contentEditable=\"True\"]", function(event){
      if (event.which == 13)
        document.activeElement.blur()
    });

    $("#loc").keydown(function() {
      if (event.which == 13)
        document.activeElement.blur()
    });

    $(".ce-shiftenter").on("keydown","*[contentEditable=\"True\"]", function(event){
      if (event.which === 13 && event.shiftKey === false)
        return false;
    });

    $(".ce-limit").on("keydown","*[contentEditable=\"True\"]", function(event){
      let len = event.target.innerText.trim().length;
      hasSelection = false;
      selection = window.getSelection();
      isSpecial = utils.isSpecial(event);
      isNavigational = utils.isNavigational(event);
      
      if (selection) {
        hasSelection = !!selection.toString();
      }
      
      if (isSpecial || isNavigational) {
        return true;
      }
      
      if (len >= settings.maxLen && !hasSelection) {
        event.preventDefault();
        return false;
      }
      
  });

$("#loc").focusout(function() {
  if($(this).val()==""){
    $(this).val(origText);
    var location = $("#map").attr('src');
    location = location.substring(0,location.indexOf('&q=')+3) + $(this).val();
    $("#map").attr('src', location);
  }
});

$('#loc').on('input', function() {
  var location = $("#map").attr('src');
  location = location.substring(0,location.indexOf('&q=')+3) + $(this).val();
  $("#map").attr('src', location);
});

$("#loc").focus(function(){
  origText = $(this).val();
});

$(".content-wrapper input").focusout(function(){
  let inputNode = this;
  let id = inputNode.id;
  let value = inputNode.value;
  modifiedInputs[id] = value;
  //console.log(modifiedInputs);
});

function save(e) {
  toggleButtonDisabled(e, undefined, "Saving...");
  $.post("customFiles/php/database/billingControls/saveBilling.php", modifiedInputs,
    function (data, textStatus, jqXHR) {
      //console.log(data);
       toggleButtonDisabled(e, undefined, "Saving...");
      Toast.fire({
        icon: data.status,
        title: data.message
      });
    },
    "json"
  );
}

let modifiedInputs = {};

</script>


<!-- Script to toggle navigation buttons -->
<script>
  let activeNav = document.querySelector(".sidebar > nav > ul > li:nth-child(4)"); //change :nth(n) value
  if (activeNav.querySelector('ul') != null){
    activeNav.className += " menu-is-opening menu-open";
    activeNav.querySelector('.menu-open > ul > li:nth-child(1) > a').classList.toggle('active'); //change :nth(n) value
    activeNav.querySelector('ul').style.display = "block";
  }
  activeNav.querySelector('a:nth-child(1)').classList.toggle('active'); //do not change this
</script>

</body>
</html>
