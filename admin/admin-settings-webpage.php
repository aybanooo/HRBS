<?php

require_once "customFiles/php/directories/directories.php";
require_once __F_LOGIN_HANDLER__;

// Redirect to login page if token is invalid
if (!isTokenValid()) {
  include("admin-login.php");
  exit();
}
session_start();
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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Croppie -->
  <link rel="stylesheet" href="customFiles/croppie/croppie.css">
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
            <h1>Settings</h1>
          </div>
          <div class="col-sm-6">
            <div class="row mt-3 mt-sm-0 ">
              <div class="col-6"></div>
              <div class="col-6">
                <button class="btn btn-success btn-block" onclick="saveData(this)" ><span>Save</span></button>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <form id="form-main">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Company Name card-->
          <div class="col-12 ">
            <div class="card">
              <div class="card-header">
                <h3  class="card-title">Company Name</h3>
              </div>
              <div class="card-body">
                <div class="container-fluid p-0 m-0">
                  <div class="row mb-3">
                    <div class="col">
                      <div class="container-fluid p-0 m-0 ce-noenter ce-noblank">
                        <input id="inp-companyName" name="inp-companyName" class="form-control form-control-border text-center" class="text-center"></input>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Company Name card end-->
          <!-- Cover card-->
          <div class="col-12 ">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Page Cover</h3>
              </div>
              <div class="card-body">
                <div class="container-fluid p-0 m-0">
                  <div class="row mb-3">
                    <div class="col">
                      <div class="container-fluid coverContainer p-0 m-0">
                        <img src="/public_assets/images/pageCover.jpeg?t=<?php print time();?>" id="img-pageCover" class="img w-100" alt="Company cover image">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-3 text-center">
                      <input type="file" id="inp-image-pageCover" accept="image/*" hidden/>
                      <label type="button" class="btn btn-block btn-default font-weight-normal" for="inp-image-pageCover">Change</label>
                    </div>
                    <div class="col-3 text-center">
                      <button type="button" class="btn btn-block btn-default">Remove</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Cover card end-->
        </div>
        <div class="row">
          <!-- Company logo col -->
          <div class="col-12 col-sm-6">
            <div class="row">
              <div class="container-fluid">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Logo</h3>
                  </div>
                  <div class="card-body">
                    <div class="container-fluid p-0 m-0">
                      <div class="row mb-3">
                        <div class="col">
                          <div class="container-fluid">
                            <img id="img-logo" src="/public_assets/images/logo.png?t=<?php print time();?>" class="img-fluid" alt="Company logo image">
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col text-center">
                          <input type="file" id="inp-image-logo" accept="image/*" hidden="">
                          <label type="button" class="btn btn-block btn-default font-weight-normal" for="inp-image-logo">Change</label>
                        </div>
                        <div class="col text-center">
                          <button type="button" class="btn btn-block btn-default">Remove</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="inp-logo-showLogoInAdmin" name="inp-logo-showLogoInAdmin">
                            <label class="custom-control-label" for="inp-logo-showLogoInAdmin">Show in admin's navigation</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="container-fluid">
                <div class="card">
                  <div class="card-header">
                    <h3>Social Media Links</h3>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="inp-socmed-1">Instagram</label>
                      <input type="url" class="form-control form-control-border border-width-2" id="inp-socmed-1" name="inp-socmed-1" placeholder="www.instagram.com/yourcompanypage">
                    </div>
                    <div class="form-group">
                      <label for="inp-socmed-2">Facebook</label>
                      <input type="url" class="form-control form-control-border border-width-2" id="inp-socmed-2" name="inp-socmed-2" placeholder="www.facebook.com/yourcompanypage">
                    </div>
                    <div class="form-group">
                      <label for="inp-socmed-3">Twitter</label>
                      <input type="url" class="form-control form-control-border border-width-2" id="inp-socmed-3" name="inp-socmed-3" placeholder="www.twitter.com/yourcompanypage">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Company logo card end-->

          <!-- Company contact Info card -->
          <div class="col-12 col-sm-6">
            <div class="row">
              <div class="container-fluid">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Contact Info</h3>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="inp-contactNum">Phone/Telephone #</label>
                      <input type="tel" class="form-control form-control-border border-width-2" id="inp-contactNum" name="inp-contactNum" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
                    </div>
                    <div class="form-group">
                      <label for="inp-email">Email Address</label>
                      <input type="email" class="form-control form-control-border border-width-2" id="inp-email" name="inp-email">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="container-fluid">
                <div class="card">
                  <div class="card-header">
                    <h3>Display</h3>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Currency</label>
                      <select class="custom-select">
                        <option value="USD" selected="selected">United States Dollars</option>
                        <option value="EUR">Euro</option>
                        <option value="GBP">United Kingdom Pounds</option>
                        <option value="DZD">Algeria Dinars</option>
                        <option value="ARP">Argentina Pesos</option>
                        <option value="AUD">Australia Dollars</option>
                        <option value="ATS">Austria Schillings</option>
                        <option value="BSD">Bahamas Dollars</option>
                        <option value="BBD">Barbados Dollars</option>
                        <option value="BEF">Belgium Francs</option>
                        <option value="BMD">Bermuda Dollars</option>
                        <option value="BRR">Brazil Real</option>
                        <option value="BGL">Bulgaria Lev</option>
                        <option value="CAD">Canada Dollars</option>
                        <option value="CLP">Chile Pesos</option>
                        <option value="CNY">China Yuan Renmimbi</option>
                        <option value="CYP">Cyprus Pounds</option>
                        <option value="CSK">Czech Republic Koruna</option>
                        <option value="DKK">Denmark Kroner</option>
                        <option value="NLG">Dutch Guilders</option>
                        <option value="XCD">Eastern Caribbean Dollars</option>
                        <option value="EGP">Egypt Pounds</option>
                        <option value="FJD">Fiji Dollars</option>
                        <option value="FIM">Finland Markka</option>
                        <option value="FRF">France Francs</option>
                        <option value="DEM">Germany Deutsche Marks</option>
                        <option value="XAU">Gold Ounces</option>
                        <option value="GRD">Greece Drachmas</option>
                        <option value="HKD">Hong Kong Dollars</option>
                        <option value="HUF">Hungary Forint</option>
                        <option value="ISK">Iceland Krona</option>
                        <option value="INR">India Rupees</option>
                        <option value="IDR">Indonesia Rupiah</option>
                        <option value="IEP">Ireland Punt</option>
                        <option value="ILS">Israel New Shekels</option>
                        <option value="ITL">Italy Lira</option>
                        <option value="JMD">Jamaica Dollars</option>
                        <option value="JPY">Japan Yen</option>
                        <option value="JOD">Jordan Dinar</option>
                        <option value="KRW">Korea (South) Won</option>
                        <option value="LBP">Lebanon Pounds</option>
                        <option value="LUF">Luxembourg Francs</option>
                        <option value="MYR">Malaysia Ringgit</option>
                        <option value="MXP">Mexico Pesos</option>
                        <option value="NLG">Netherlands Guilders</option>
                        <option value="NZD">New Zealand Dollars</option>
                        <option value="NOK">Norway Kroner</option>
                        <option value="PKR">Pakistan Rupees</option>
                        <option value="XPD">Palladium Ounces</option>
                        <option value="PHP">Philippines Pesos</option>
                        <option value="XPT">Platinum Ounces</option>
                        <option value="PLZ">Poland Zloty</option>
                        <option value="PTE">Portugal Escudo</option>
                        <option value="ROL">Romania Leu</option>
                        <option value="RUR">Russia Rubles</option>
                        <option value="SAR">Saudi Arabia Riyal</option>
                        <option value="XAG">Silver Ounces</option>
                        <option value="SGD">Singapore Dollars</option>
                        <option value="SKK">Slovakia Koruna</option>
                        <option value="ZAR">South Africa Rand</option>
                        <option value="KRW">South Korea Won</option>
                        <option value="ESP">Spain Pesetas</option>
                        <option value="XDR">Special Drawing Right (IMF)</option>
                        <option value="SDD">Sudan Dinar</option>
                        <option value="SEK">Sweden Krona</option>
                        <option value="CHF">Switzerland Francs</option>
                        <option value="TWD">Taiwan Dollars</option>
                        <option value="THB">Thailand Baht</option>
                        <option value="TTD">Trinidad and Tobago Dollars</option>
                        <option value="TRL">Turkey Lira</option>
                        <option value="VEB">Venezuela Bolivar</option>
                        <option value="ZMK">Zambia Kwacha</option>
                        <option value="EUR">Euro</option>
                        <option value="XCD">Eastern Caribbean Dollars</option>
                        <option value="XDR">Special Drawing Right (IMF)</option>
                        <option value="XAG">Silver Ounces</option>
                        <option value="XAU">Gold Ounces</option>
                        <option value="XPD">Palladium Ounces</option>
                        <option value="XPT">Platinum Ounces</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="inp-footer-r">Footer Right Text</label>
                      <input type="text" class="form-control form-control-border border-width-2" id="inp-footer-r" name="inp-footer-r" placeholder="Enter any text here e.g Copyright">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="container-fluid">
                <div class="card">
                  <div class="card-header">
                    <div class="form-group">
                      <label for="inp-address">Address</label>
                      <input type="text" class="form-control form-control-border border-width-2" id="inp-address" name="inp-address" placeholder="Hotel address">
                    </div>
                    <div class="form-group">
                      <label for="inp-loc">Latitude, Longitude</label>
                      <input type="text" class="form-control form-control-border border-width-2" id="inp-loc" name="inp-loc" placeholder="14.581860858430435, 120.977005522402">
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="embed-responsive embed-responsive-1by1">
                      <iframe id="map" class="embed-responsive-item" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyANA3u1iWaTsQ1tbJsEyzhKhZ8JZXb3XMg
                      &q=14.581860858430435, 120.977005522402"></iframe>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Company contact Info card end-->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </form>
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

<!-- TEMPLATE -->
<template id="my-template">
  <swal-title>
    <div class="container-imageCropper">
      <div class="container-spinner">
        <span class="spinner-border fa-spin"></span>
      </div>
      <div class="imageCropper"></div>
    </div>
  </swal-title>
  <swal-button type="confirm">
    Select
  </swal-button>
  <swal-button type="cancel">
    Cancel
  </swal-button>
  <swal-param name="allowEscapeKey" value="false" />
  <swal-param
    name="customClass"
    value='{ "popup": "my-popup" }' />
</template>

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
<!-- Croppie -->
<script src="customFiles/croppie/croppie.js"></script>
<!-- Special Script-->
<script src="customFiles/initialize Toastr.js"></script>
<script src="customFiles/buttonDisabler.js"></script>
<script src="customFiles/customScript.js"></script>
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

    $("#inp-loc").keydown(function() {
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

$("#inp-loc").focusout(function() {
  if($(this).val()==""){
    $(this).val(origText);
    var location = $("#map").attr('src');
    location = location.substring(0,location.indexOf('&q=')+3) + $(this).val();
    $("#map").attr('src', location);
  }
});

$('#inp-loc').on('input', function() {
  if($(this).val()==="")
    return;
  var location = $("#map").attr('src');
  location = location.substring(0,location.indexOf('&q=')+3) + $(this).val();
  $("#map").attr('src', location);
});

$("#inp-loc").focus(function(){
  origText = $(this).val();
});

// page cover changer with crop
$('#inp-image-pageCover').on('change', function() {
    Swal.fire({
      template: '#my-template'
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        pageCover.croppie('result', {
          type: 'blob',
          size: {
            width: 1920,
            height: 1080
          },
          format: 'jpeg',
          circle: false
        }).then(function(result) {
          //console.log(result);
          savedPageCover = result;
          var urlCreator = window.URL || window.webkitURL;
          var pageCoverUrl = urlCreator.createObjectURL(result);
          $("#img-pageCover").attr('src', pageCoverUrl);
          /*
          Swal.fire({
            imageUrl: result,
          });
          */
        });
      } else if (result.isDenied) {
        Swal.fire('Unable to load image', '', 'info')
      }
    });
    pageCover = $(".imageCropper").croppie({
      enableExif: true,
      viewport: {
          width: 320,
          height: 180,
          type: 'square'
      },
      boundary: {
          width: 350,
          height: 200
      },
      showZoomer: true,
      enforceBoundary:true
    });
    setTimeout(() => {
      $('.container-imageCropper').addClass('ready');
      var reader = new FileReader();
      reader.onload = function (event) {
        pageCover.croppie('bind', {
          url: event.target.result,
        });
      }
      reader.readAsDataURL(this.files[0]);
      $(this).val(null);
    },1000);

});

// logo changer with crop
$('#inp-image-logo').on('change', function() {
    Swal.fire({
      template: '#my-template'
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {

        // Create logo url and blob
        logo.croppie('result', {
          type: 'blob',
          size: {
            width: 1000,
            height: 1000
          },
          format: 'png',
          circle: false
        }).then(function(result) {
          //console.log(result);
          savedLogo = result;
          var urlCreator = window.URL || window.webkitURL;
          var logoUrl = urlCreator.createObjectURL(result);
          $("#img-logo").attr('src', logoUrl);
          /*
          Swal.fire({
            imageUrl: result,
          });
          */
        });

        //create favicon blob
        logo.croppie('result', {
          type: 'blob',
          size: {
            width: 32,
            height: 32
          },
          format: 'png',
          circle: false
        }).then(function(result) {
          thumb = result;
        });


      } else if (result.isDenied) {
        Swal.fire('Unable to load image', '', 'info')
      }
    });
    logo = $(".imageCropper").croppie({
      enableExif: true,
      viewport: {
          width: 320,
          height: 320,
          type: 'square'
      },
      boundary: {
          width: 350,
          height: 350
      },
      showZoomer: true,
      enforceBoundary:true
    });
    setTimeout(() => {
      $('.container-imageCropper').addClass('ready');
      var reader = new FileReader();
      reader.onload = function (event) {
        logo.croppie('bind', {
          url: event.target.result,
        });
      }
      reader.readAsDataURL(this.files[0]);
      $(this).val(null);
    },1000);

});

function saveData(el) {
  //Prepare form data
  toggleButtonDisabled(el, ".content-header", "Saving...")
  fd = new FormData($("#form-main")[0]);
  //gather and append all images if changed
  if(typeof savedPageCover !== 'undefined')
    fd.append('pageCover', savedPageCover, 'pageCover');
  if(typeof logo !== 'undefined')
    fd.append('logo', savedLogo, 'logo');
  if(typeof thumb !== 'undefined')
    fd.append('thumb', thumb, 'thumb');
  //Adds inp-log-showLogoInAdmin in form data
  fd.append("inp-logo-showLogoInAdmin", $("#inp-logo-showLogoInAdmin").prop('checked'));
  /*
  console.groupCollapsed('Form Data');
  for (var pair of fd.entries()) {
      console.log(pair[0]+ ', ' + pair[1]); 
  }
  console.groupEnd('Form Data');
  */
  $.ajax({
    type: "post",
    url: "customFiles/php/database/webPageControls/saveWebPageSettings.php",
    data: fd,
    contentType: false,
    processData: false,
    cache: false,
    dataType: 'json',
    success: function (response) {
      //*
      Toast.fire({
        icon: response.status,
        title: response.message
      });
      //*/
      console.log(response);
      toggleButtonDisabled(el, ".content-header", "Saving...")
    }
  });
}

function loadData() {
  $.ajax({
    type: "post",
    url: "customFiles/php/database/webPageControls/loadWebPageSettings.php",
    dataType: 'json',
    success: function (response) {
      //console.log(data);
      $("#inp-companyName").val(response.data["companyName"]);
      $("#inp-contactNum").val(response.data["contact"]);
      $("#inp-email").val(response.data["email"]);
      $("#inp-address").val(response.data["address"]);
      $("#inp-logo-showLogoInAdmin").prop('checked', response.data['showLogo']);
      $("#inp-loc").val(`${response.data["latitude"]}${( (/\S/.test(response.data["longitude"])) ? "," : "")}${response.data["longitude"]}`);
      $("#map").attr('src', `https://www.google.com/maps/embed/v1/place?key=AIzaSyANA3u1iWaTsQ1tbJsEyzhKhZ8JZXb3XMg
                      &q=${response.data["latitude"]}${( (/\S/.test(response.data["longitude"])) ? "," : "")}${response.data["longitude"]}`)
      //console.log( data["companyName"] );
    }
  });
}

document.addEventListener("keydown", function(e) {
  if ((window.navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)  && e.keyCode == 83) {
    e.preventDefault();
    saveData();
  }
}, false);  

loadData()

</script>

<!-- Script to toggle navigation buttons -->
<script>
  let activeNav = document.querySelector(".sidebar > nav > ul > li:nth-child(6)"); //change :nth(n) value
  if (activeNav.querySelector('ul') != null){
    activeNav.className += " menu-is-opening menu-open";
    activeNav.querySelector('.menu-open > ul > li:nth-child(3) > a').classList.toggle('active'); //change :nth(n) value
    activeNav.querySelector('ul').style.display = "block";
  }
  activeNav.querySelector('a:nth-child(1)').classList.toggle('active'); //do not change this
</script>

</body>
</html>
