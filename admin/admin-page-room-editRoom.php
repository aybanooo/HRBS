<?php

require_once("customFiles/php/directories/directories.php");
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
  <!-- Special Style-->
  <link rel="stylesheet" href="customFiles/specialStyle.css">
  <link rel="stylesheet" href="customFiles/editRoom.css">
  <!-- SweetAlert2 -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="plugins/toastr/toastr.min.js"></script>
  <!--<script src="customFiles/premade/aframe.min.js"></script>-->
  <script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>
  <script src="customFiles/generate360.js"></script>

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


      <div class="loadingOverlay">

        <div>
          <div class="loader"></div>
        </div>
      </div>

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Edit Room</h1>
            </div>
            <div class="col-sm-6">
              <div class="row mt-3 mt-sm-0 ">
                <div class="col-6">
                  <a href="rooms"><button class="btn btn-outline-secondary btn-block">Cancel</button></a>
                </div>
                <div class="col-6">
                  <a href="javascript: void(0)"><button class="btn btn-success btn-block"
                      onclick="saveRoom()">Save</button></a>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content d-none">
        <div class="container-fluid editRoom-container">

          <div class="card">
            <div class="card-header d-flex p-0">
              <div class="container-fluid ce-noblank ce-noenter">
                <h3 id="roomName" class="p-3" class="" contenteditable="True">...</h3>
                <label for="roomName">Room Name</label>
              </div>
            </div><!-- /.card-header -->
            <div class="card-body">

              <!-- Row 1 -->
              <div class="row">
                <div class="col">
                  <div class="card mb-2 bg-gradient-dark roomImageCard">
                    <img class="card-img-top" src="/public_assets/defaults/default-image-landscape.jpg"
                      alt="Dist Photo 1">
                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                      <div class="container-fluid p-0">
                        <input type="file" id="inputRoomCover" accept=".jpg, .jpeg" hidden>
                        <label for="inputRoomCover" class="btn btn-app mb-0 ml-0 font-weight-normal">
                          <i class="fas fa-edit"></i> Upload
                        </label>
                        <a class="btn btn-app mb-0" onclick="resetRoomCover()"">
                        <i class=" fas fa-trash"></i> Reset
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Row 1 end -->
              <!-- Row 2 -->
              <div class="row mt-4">
                <div class="col">
                  <label>Description</label>
                  <textarea id="roomDescription" class="form-control" placeholder="Type the room description here..."
                    data-roomdescription></textarea>
                </div>
              </div>
              <!-- Row 2 end-->

              <!-- Row 3 -->
              <div class="row mt-4">
                <div class="col">

                  <div class="container-fluid">
                    <ul class="nav nav-tabs justify-content-center" id="roomSection-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link hoverable-fas-icon active" id="roomSection-genInfo-tab" data-toggle="pill"
                          href="#roomSection-genInfo" role="tab" aria-controls="roomSection-genInfo"
                          aria-selected="true">
                          <i class="fas fa-info fa-2x"></i>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a data-toggle="modal" data-target="#roomSectionModal" class="nav-link hoverable-fas-icon"
                          id="roomSection-addSection-tab" href="javascript: void(0)" role="tab"><i
                            class="fas fa-plus fa-2x"></i></a>
                      </li>
                    </ul>

                    <!-- Modal -->
                    <div class="modal fade" id="roomSectionModal" tabindex="-1" role="dialog"
                      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <form id="form-newSection">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Add A Room Section</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row mb-2">
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="sectionName">Section Name</label>
                                    <input type="text" class="form-control form-control-border border-width-2"
                                      id="sectionName" name="sectionName" placeholder="Enter the section name">
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="iconName">Icon name</label>
                                    <div class="input-group">
                                      <input id="iconName" type="text" name="iconName" class="form-control" readonly>
                                      <div class="input-group-append">
                                        <span id="iconListDropdown" class="input-group-text"
                                          onclick="$('#iconMainCard').toggleClass('d-none')"><i
                                            class="fas fa-angle-down"></i></span>
                                      </div>
                                    </div>
                                  </div>

                                </div>
                                <div class="col-12">
                                  <div class="container vh-50">
                                    <div class="card card-primary card-outline card-outline-tabs d-none"
                                      id="iconMainCard">
                                      <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                          <li class="nav-item">
                                            <a onclick="" class="nav-link active" id="solid-icons-tab"
                                              data-toggle="pill" href="#solid-icons" role="tab"
                                              aria-controls="solid-icons" aria-selected="true">Solid</a>
                                          </li>
                                          <li class="nav-item">
                                            <a onclick="" class="nav-link" id="regular-icons-tab" data-toggle="pill"
                                              href="#regular-icons" role="tab" aria-controls="regular-icons"
                                              aria-selected="false">Regular</a>
                                          </li>
                                        </ul>
                                      </div>
                                      <div class="card-body" id="iconCard">
                                        <div class="tab-content" id="icon-tabs">
                                          <div class="tab-pane fade active show" id="solid-icons" role="tabpanel"
                                            aria-labelledby="solid-icons-tab">
                                            <div class="row mb-3">
                                              <div class="col-12">
                                                <div class="row">
                                                  <div class="col-6">
                                                    <input class="form-control" id="solidSearch" type="text"
                                                      placeholder="Search..">
                                                  </div>
                                                  <div
                                                    class="col-6 d-flex align-items-center justify-content-center text-secondary">
                                                    <div class="form-group m-0">
                                                      <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                          id="solidIconsOnly">
                                                        <label class="custom-control-label" for="solidIconsOnly">Hide
                                                          Names</label>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="tab-pane fade" id="regular-icons" role="tabpanel"
                                            aria-labelledby="regular-icons-tab">
                                            <div class="row mb-3">
                                              <div class="col-12">
                                                <div class="row">
                                                  <div class="col-6">
                                                    <input class="form-control" id="regularSearch" type="text"
                                                      placeholder="Search..">
                                                  </div>
                                                  <div
                                                    class="col-6 d-flex align-items-center justify-content-center text-secondary">
                                                    <div class="form-group m-0">
                                                      <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                          id="regularIconsOnly">
                                                        <label class="custom-control-label" for="regularIconsOnly">Hide
                                                          Names</label>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="card-footer">
                                        <nav aria-label="Page navigation">
                                          <div class="d-flex justify-content-center">
                                            <a href="javascript: void(0)" onclick="$('#iconCard').scrollTop(0)"><small
                                                class="text-uppercase">back to top</small></a>
                                          </div>
                                        </nav>
                                      </div>
                                    </div>
                                    <!-- /.card -->
                                  </div>
                                </div>
                                <div class="col-12">
                                  <button type="submit" class="btn btn-outline-secondary btn-block">Create new
                                    section</button>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col" id="buttonList">

                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- Modal End-->

                    <!-- Modal 360 -->
                    <div class="modal fade" id="modalFor360" tabindex="-1" role="dialog" aria-labelledby="modalFor360"
                      aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-body d-flex p-0 justify-content-center align-content-center">
                            <div class="embed-responsive embed-responsive-16by9 rounded" id="360div">
                              <iframe frameborder="0" id="360frame" class="embed-responsive-item"
                                src="360view.html"></iframe>
                            </div>
                            <img src="assets/images/defaults/default-image-landscape.png" id="normalImg"
                              class="img-fluid rounded d-none" alt="Responsive image">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-content" id="roomSection-tabContent">
                      <!-- Genereal info Tab-->
                      <div class="tab-pane fade active show" id="roomSection-genInfo" role="tabpanel"
                        aria-labelledby="roomSection-genInfo-tab">
                        <div class="container-fluid p-3">
                          <div class="row d-flex justify-content-between">
                            <label>General Information<a href="javascript: void(0)" onclick="addInfo(event)" class=""><i
                                  class="fas fa-plus pl-2"></i></a></label>
                            <a href="#" class="float-right" data-toggle="tooltip"
                              title="Empty entry will be automatically deleted."><i
                                class="fas fa-question-circle pl-2"></i></a>
                          </div>
                          <div class="row mx-1 mx-sm-5 my-sm-2">
                            <div class="col-12 ce-limit ce-noenter ce-blankremove">
                              <ul class="list-unstyled row gen-info-list" data-section-general>
                                <!--<li class="list-item col-6 col-md-3"><i class="fas fa-check mx-1"></i><span>STATIC TESTING ITEM</span></li>-->
                              </ul>
                            </div>
                          </div>
                          <div class="row d-flex justify-content-start  ">
                            <label>Rate</label>
                            <!--<a href="#" class="float-right" data-toggle="tooltip" title="The toggle buttons on cards shows/hides the top border highlight."><i class="fas fa-question-circle pl-2"></i></a>-->
                          </div>
                          <div id="rateCards" class="row my-sm-2 ce-noblank rateCards">
                            <div class="col-4">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">$</span>
                                </div>
                                <input type="text" id="roomRate" min="0" class="form-control">
                              </div>
                            </div>

                          </div>
                          <div class="row d-flex justify-content-between">
                            <label>Capacity</label>
                            <a href="#" class="float-right" data-toggle="tooltip"
                              title="The option will be automatically hide from the customer side if the value is 0"><i
                                class="fas fa-question-circle pl-2"></i></a>
                          </div>
                          <div class="row d-flex justify-content-start">
                            <div class="col-6 col-md-2">
                              <div class="input-group mb-3" data-toggle="tooltip" title="Child/s">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-child"></i></span>
                                </div>
                                <input id="maxChild" style="width: 65px !important;" class="form-control" type="number"
                                  min="0" value="0" required>
                              </div>
                            </div>
                            <div class="col-6 col-md-2">
                              <div class="input-group mb-3" data-toggle="tooltip" title="Adult/s">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-male"></i></span>
                                </div>
                                <input id="maxAdult" style="width: 65px !important;" class="form-control" type="number"
                                  min="0" value="0" required>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Genereal info Tab End-->

                    </div>
                  </div>
                  <!-- Container Fluid end -->

                </div>
              </div>
              <!-- Row 3 end-->

            </div><!-- /.card-body -->
          </div>

          <!-- Review Card -->
          <div class="card d-none">
            <div class="card-header">
              <h5 class="text-left">Ratings</h5>
            </div>
            <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col-12 col-md-6 col-lg-3">
                    <div class="row">
                      <h6><i class="fas fa-certificate pr-2 text-info"></i>Overall Rating </h6>
                    </div>
                    <div class="row d-flex align-items-center justify-content-center">
                      <span class="overallRate mr-2">5</span>
                      <span class="overallRateOutOf text-secondary">/
                        <span class="overallRateOutOValue text-secondary">5</span></span>
                    </div>
                    <div class="row d-flex justify-content-center">
                      <span class="overallRateStars">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                      </span>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="row">
                      <h6><i class="fas fa-align-left pr-2 text-info"></i>Rating Breakdown </h6>
                    </div>
                    <div class="row mt-2">
                      <div class="col">
                        <span class="progress-label">5<i class="fas fa-star text-warning ml-1 mr-2"></i></span>
                        <div class="progress rateProgress">
                          <div class="progress-bar bg-warning" style="width: 100%"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col">
                        <span class="progress-label">4<i class="fas fa-star text-warning ml-1 mr-2"></i></span>
                        <div class="progress rateProgress">
                          <div class="progress-bar bg-warning" style="width: 0%"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col">
                        <span class="progress-label">3<i class="fas fa-star text-warning ml-1 mr-2"></i></span>
                        <div class="progress rateProgress">
                          <div class="progress-bar bg-warning" style="width: 0%"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col">
                        <span class="progress-label">2<i class="fas fa-star text-warning ml-1 mr-2"></i></span>
                        <div class="progress rateProgress">
                          <div class="progress-bar bg-warning" style="width: 0%"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col">
                        <span class="progress-label">1<i class="fas fa-star text-warning ml-1 mr-2"></i></span>
                        <div class="progress rateProgress">
                          <div class="progress-bar bg-warning" style="width: 0%"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Reviews Row -->
                <div class="row">
                  <div class="col">
                    <!-- Review Entry Row -->
                    <div>
                      <!-- User image -->
                      <img class="img-circle img-sm" src="dist/img/user3-128x128.jpg" alt="User Image">

                      <div class="m-5">
                        <span class="d-block">
                          <strong class="d-inline-block">Ella Hanging-lubak</strong>

                          <div class="btn-group dropleft ml-2 mr-2 float-right">
                            <a class="" data-toggle="dropdown" aria-expanded="true"><i
                                class="fas fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu" role="menu" x-placement="bottom-start"
                              style="position: absolute; transform: translate3d(68px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                              <a class="dropdown-item" href="#">Delete</a>
                            </div>
                          </div>

                          <span class="text-muted d-block d-sm-inline-block float-sm-right reviewDate">8:03 PM
                            Today</span>
                          <span class="d-block">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                          </span>
                        </span><!-- /.username block -->
                        The accomodation is good. I love it from the bottom of my heart and through the core of my soul
                        &lt;3.
                      </div>
                      <!-- /.comment-text -->
                    </div>
                    <!-- Review Entry Row -->
                    <!-- Review Entry Row -->
                    <div>
                      <!-- User image -->
                      <img class="img-circle img-sm" src="dist/img/user5-128x128.jpg" alt="User Image">

                      <div class="m-5">
                        <span class="d-block">
                          <strong class="d-inline-block">Tonio Batumbakal</strong>
                          <div class="btn-group dropleft ml-2 mr-2 float-right">
                            <a class="" data-toggle="dropdown" aria-expanded="true"><i
                                class="fas fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu" role="menu" x-placement="bottom-start"
                              style="position: absolute; transform: translate3d(68px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                              <a class="dropdown-item" href="#">Delete</a>
                            </div>
                          </div>
                          <span class="text-muted d-block d-sm-inline-block float-sm-right reviewDate">8:03 PM
                            Today</span>
                          <span class="d-block">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                          </span>
                        </span><!-- /.username block -->
                        I am flaberghasted the first time I entered the room. The accomodation is exquisite plus the
                        view is immaculate!
                      </div>
                      <!-- /.comment-text -->
                    </div>
                    <!-- Review Entry Row -->
                  </div>
                </div>
                <!-- Reviews Row End -->


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
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- jsGrid -->
  <script src="plugins/jsgrid/jsgrid.min.js"></script>
  <!-- jquery-validation -->
  <script src="plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="plugins/jquery-validation/additional-methods.min.js"></script>
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Special Script-->
  <script src="customFiles/customScript.js"></script>
  <script src="customFiles/roomSection.js"></script>
  <script src="customFiles/cheatsheet.js"></script>
  <script src="customFiles/roomGeneration.js"></script>
  <script src="customFiles/toggle360ImagesGallery.js"></script>
  <script src="customFiles/loading.js"></script>
  <script src="customFiles/initialize Toastr.js"></script>

  <!-- Page Special Script -->
  <script>
    putDesignToggleBtn();
    generateEllipse();
    var genInfoList = document.getElementsByClassName('gen-info-list');
    [].forEach.call(genInfoList, function (el) {
      el.querySelectorAll('li > span').forEach(function (el) {
        el.setAttribute("contentEditable", "True");
      });

    });

    /*
    $(".ce-noblank *[contentEditable=\"True\"]").focus(function () {
      origText = $(this).text();
    });

    $(".ce-noblank *[contentEditable=\"True\"]").focusout(function () {
      if($(this).text()==""){
        $(this).text(origText);
      } 
    });

    $(".ce-blankremove *[contentEditable=\"True\"]").focusout(function () {
      if($(this).text()==""){
        $(this).closest('li').remove();
      } 
    });
    */


    $("#form-newSection").validate({
      rules: {
        iconName: {
          required: true,
          validIcon: true
        },
        sectionName: {
          required: true
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
      submitHandler: function (form, e) {
        //console.log($(form).find('input').val());
        createNewSection();
        e.preventDefault();
        $("#roomSectionModal").modal('hide');
        form.reset();
        //$(form).submit();
      }
    });

    jQuery.validator.addMethod("validIcon", function (value, element) {
      return solid.includes(value.substr(7)) || regular.includes(value.substr(7));
    }, "Invalid icon name.");

    function saveRoom() {
      toggleLoadingScreen();
      addNewItemsToInsertQuery();
      //console.log(queries);
      var form_data = new FormData();
      for (const [sectionKey, value] of Object.entries(queries.insert.gallery)) {
        for (const [imageKey, value] of Object.entries(queries.insert.gallery[sectionKey])) {
          form_data.append('images[]', value.fileObject, imageKey);
          console.log(value);
        }
      }
      if (queries.update.roomInfo.roomCover)
        form_data.append('images[]', queries.update.roomInfo.roomCover, "roomCover");
      var strQueries = JSON.stringify(queries);
      form_data.append('queries', strQueries);
      //console.log(form_data);
      //return;
      $.ajax({
        type: "post",
        url: "customFiles/php/database/roomControls/saveRoom.php",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
          //console.log("DONE???");
          //console.log(response);
          sessionStorage.setItem("saveStatus", response);
          location.reload(true);
          //console.log("DONE???");
        }
      });

    }

    //Adds the new item into the insert query
    function addNewItemsToInsertQuery() {
      queries.insert.items = {};
      $(".list-unstyled.row.gen-info-list[data-section-id]").each(function () {
        var sectionID = $(this).attr('data-section-id');
        if (!queries.insert.items[sectionID])
          queries.insert.items[sectionID] = [];
        $(this).find("span[newinfo]").each(function () {
          var temp = $(this).text();
          queries.insert.items[sectionID].push(temp);
        });
        if (queries.insert.items[sectionID].length == 0)
          delete queries.insert.items[sectionID]
      });
    }

    function addItemToSection(sectionID, infoID, info) {
      $(`[data-section-id="${sectionID}"]`).append(`
  <li class="list-item col-6 col-md-3">
    <div class="row">
      <div class="col-auto p-0">
        <i class="fas fa-check mx-1"></i>
      </div>
      <div class="col">
        <span contenteditable="True" data-sec-item-id="${infoID}">${info}</span>
      </div>
    </div>
  </li>`)
    }


    function addImageToSection(sectionID, pictureID, data) {
      var template = `<div class="col-md-12 col-lg-6 col-xl-4" data-section-gallery-image-id="${pictureID}">
                  <div class="card mb-2">
                    <img id="${pictureID}"  class="card-img-top rounded"  src="/public_assets/rooms/${xyzroominfocba.basicInfo.roomTypeID}/${data.pictureName}.jpg">
                    <div class="card-img-overlay p-0">
                      <span class="imageModaler ${data.is360 === "0" ? "" : "pano360"}" style="display: inline-block; position: relative; width: 100%; height: 100%;"></span>
                      <div class="bannerContainer"> 
                        <span class="badge badge-secondary ${data.is360 === "0" ? "d-none" : ""}">360°</span>
                        <span class="badge badge-warning d-none">360° view not availble on unsaved image.</span>
                      </div> 
                      <div class="btn-group dropleft">
                        <a href="javascript: void(0)" data-toggle="dropdown">
                          <span><i class="fas fa-ellipsis-v"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" onclick="toggle360(event, ${sectionID}, ${pictureID}, false)" href="javascript: void(0)">Toggle 360</a></li>
                          <li><a class="dropdown-item" onclick="deleteImageEntry(event, ${sectionID}, ${pictureID}, false)" href="javascript: void(0)">Delete</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>`;
      $(`[data-section-id-gallery="${sectionID}"]`).append(template);
    }

    function addSectionTabButton(id, icon) {
      var template = `<li class="nav-item">
                <a class="nav-link hoverable-fas-icon" id="roomSection-${id}-tab" 
                data-toggle="pill" href="#roomSection-${id}" role="tab" 
                aria-controls="roomSection-${id}" aria-selected="true">
                  <i class="${icon} fa-2x"></i>
                </a>
              </li>`;
      $("#roomSection-tab > li:last-child").before(template);
    }

    function addSectionTabBody(id, sectionName) {
      var template = `<div class="tab-pane fade" id="roomSection-${id}" role="tabpanel" aria-labelledby="roomSection-${id}-tab">
                        <div class="container-fluid p-3">
                          
                          <div class="row d-flex justify-content-between">
                            <label>${sectionName} Info<a onclick="addInfo(event)"><i class="fas fa-plus pl-2"></i></a></label>
                            <a href="javascript: void(0)" class="hoverable-danger" onclick="removeSection(${id})">Remove Section</a>
                          </div>
                          <div class="row mx-1 mx-sm-5 my-sm-2">
                            <div class="col-12 ce-limit ce-noenter ce-blankremove">
                              <ul class="list-unstyled row gen-info-list" data-section-id="${id}">
                              </ul>
                            </div>
                          </div>

                          <div class="row d-flex justify-content-between">
                            <input id="picker${id}" class="imagePicker" type="file"  accept=".jpeg, .jpg" hidden/>
                            <label for="picker${id}">Gallery<a><i class="fas fa-plus pl-2"></i></a></label>
                          </div>

                          <!-- Image Row -->
                          <div class="row gallery-row" data-section-id-gallery=${id}>
                     
                          </div>
                          <!-- Image Row End -->

                        </div>
                      </div>`;
      $("#roomSection-tabContent").append(template);
    }

    function resetRoomCover() {
      //console.log("GEGE", lastSavedRoomImage);
      $(".roomImageCard img").attr('src', lastSavedRoomImage);
      delete queries.update.roomInfo["roomCover"];
    }

    function initializeInputListeners() {

      var origText = "";

      $(".ce-noblank").on("focus", "*[contentEditable=\"True\"]", function () {
        origText = $(this).text();
      });

      $(".ce-noblank").on("focusout", "*[contentEditable=\"True\"]", function () {
        if ($(this).text() == "") {
          $(this).text(origText);
        }
      });

      $(".ce-blankremove").on("focusout", "*[contentEditable=\"True\"]", function () {
        if ($(this).text() == "") {
          if ($(this).attr('data-sec-item-id') != null) {
            var sectionID = $(this).closest('ul').attr('data-section-id');
            var itemID = $(this).attr('data-sec-item-id');
            addItemToDeleteQuery(sectionID, itemID);
          }
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

      $(".ce-noenter").on("keydown", "*[contentEditable=\"True\"]", function (event) {
        if (event.which == 13)
          document.activeElement.blur()
      });

      $(".ce-shiftenter").on("keydown", "*[contentEditable=\"True\"]", function (event) {
        if (event.which === 13 && event.shiftKey === false)
          return false;
      });

      $(".ce-limit").on("keydown", "*[contentEditable=\"True\"]", function (event) {
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

      $("#roomRate").on("keydown", function (e) {
        if (e.which == 13)
          document.activeElement.blur()
        key = e.keyCode;
        if (key == 8 || utils.isNavigational(e) || utils.isSpecial(e)) return true;
        if (isNaN(String.fromCharCode(e.which))) e.preventDefault();
      });


      $(".ce-numOnly").on("keydown", "*[contentEditable=\"True\"]", function (e) {
        if (e.which == 13)
          document.activeElement.blur()
        key = e.keyCode;
        if (key == 8 || utils.isNavigational(e) || utils.isSpecial(e)) return true;
        if (isNaN(String.fromCharCode(e.which))) e.preventDefault();
      });

      $('.row.gallery-row').on('click', '.imageModaler', function () {
        var image = $(this).parents().eq(1).find('img').attr('src');
        var attr = $(this).attr('newimage');
        if ($(this).hasClass('pano360') && !(typeof attr !== 'undefined' && attr !== false)) {

          if (($('#360div').hasClass('d-none')))
            $('#360div').removeClass('d-none');
          if (!($('#normalImg').hasClass('d-none')))
            $('#normalImg').addClass('d-none')

          $('#modalFor360').modal("show");
          console.log(image);
          $('#360frame').attr('src', '360view.html?image=' + image);
        } else {
          $('#modalFor360').modal("show");
          if (!($('#360div').hasClass('d-none')))
            $('#360div').addClass('d-none');
          if (($('#normalImg').hasClass('d-none')))
            $('#normalImg').removeClass('d-none')

          $('#normalImg').attr('src', image);
          console.log("not 360");
        }

      });
    }

    $("#roomDescription").on('keydown', function (e) {
      queries.update.roomInfo["description"] = $(this).val();
      var keyCode = e.keyCode || e.which;

      if (keyCode == 9) {
        e.preventDefault();
        var start = this.selectionStart;
        var end = this.selectionEnd;
        this.value = this.value.substring(0, start) +
          "\t" + this.value.substring(end);

        // put caret at right position again
        this.selectionStart =
          this.selectionEnd = start + 1;
      }
    });

    $("#roomName").on("focusout", function () {
      console.log($(this).text());
      queries.update.roomInfo["roomName"] = $(this).text();
    });


    $("#maxChild").change(function () {
      if ($(this).val().length == 0)
        $(this).val('0');
      queries.update.roomInfo["maxChild"] = $(this).val();
    });

    $("#maxAdult").change(function () {
      if ($(this).val().length == 0)
        $(this).val('0');
      queries.update.roomInfo["maxAdult"] = $(this).val();
    });


    $("#roomRate").focusin(function () {
      var strVal = $(this).val();
      var numOnlyVal = strVal.replace(/,/gi, '');
      $(this).val(numOnlyVal);
    });

    $("#roomRate").change(function () {
      if ($(this).val().length == 0)
        $(this).val('0');
      queries.update.roomInfo["rate"] = $(this).val();
    });

    $("#roomRate").focusout(function () {
      var num = $(this).val().replace(/,/gi, "");
      var num2 = num.replace(/\d(?=(?:\d{3})+$)/g, '$&,');
      $(this).val(num2);
    });


    //add item in delete query object
    function addItemToDeleteQuery(sectionID, itemID) {
      console.log(sectionID, itemID);
      if (!(sectionID in queries.delete.items))
        queries.delete.items[sectionID] = [];
      queries.delete.items[sectionID].push(itemID);
      delete queries.update.items[sectionID][itemID];
    }

    function toggleLoadingScreen() {

      if ($(".loadingOverlay").hasClass('hide')) {
        $(".content").addClass('d-none')
        $(".loadingOverlay").removeClass('d-none')
        $(".loadingOverlay").removeClass('hide');
      } else {
        $(".loadingOverlay").addClass('hide');
        $(".content").removeClass('d-none')
        setTimeout(function () {
          $(".loadingOverlay").addClass('d-none')
        }, 400);
      }

    }


    $(document).ready(function () {
      lastSavedRoomImage =
        `/public_assets/rooms/${xyzroominfocba.basicInfo.roomTypeID}/${xyzroominfocba.basicInfo.roomTypeID}-cover.jpg`;
      $(".roomImageCard > img").attr('src', lastSavedRoomImage + "?t="+ +new Date());
      queries["roomTypeID"] = xyzroominfocba.basicInfo.roomTypeID;
      $("[data-roomdescription]").val(xyzroominfocba.basicInfo.desc);
      $("#roomName").html(xyzroominfocba.basicInfo.name);
      $("#maxChild").val(xyzroominfocba.basicInfo.maxChildren);
      $("#maxAdult").val(xyzroominfocba.basicInfo.maxAdult);
      $("#roomRate").val(xyzroominfocba.basicInfo.rate);
      //console.log(xyzroominfocba);
      $("[data-section-general]").attr('data-section-id', xyzroominfocba.generalInfoItems.genID);
      //generate general info items. yung mga may check.
      for (const [key, value] of Object.entries(xyzroominfocba.generalInfoItems.items)) {
        addItemToSection(xyzroominfocba.generalInfoItems.genID, key, value);
      }

      for (const sectionKey of Object.keys(xyzroominfocba.sections)) {
        addSectionTabButton(sectionKey, xyzroominfocba.sections[sectionKey].sectionIcon);
        addSectionTabBody(sectionKey, xyzroominfocba.sections[sectionKey].sectionName)
        for (const [infoID, value] of Object.entries(xyzroominfocba.sections[sectionKey].items)) {
          addItemToSection(sectionKey, infoID, value);
        }
        for (const [pictureID, value] of Object.entries(xyzroominfocba.sections[sectionKey].gallery)) {
          addImageToSection(sectionKey, pictureID, value);
        }
      }





      //add modified section existing item in update query object
      $("[data-section-id]").on("focusout", "span[contenteditable]:not(span[newinfo])", function (e) {
        var sectionID = $(this).closest('ul').attr('data-section-id');
        var infoID = $(e.target).attr('data-sec-item-id');
        var info = $(e.target).text();
        if (!(sectionID in queries.update.items))
          queries.update.items[sectionID] = {};
        if ($(e.target).attr('data-sec-item-id') != null) {
          queries.update.items[sectionID][infoID] = info;
        }
        console.log(queries.update.items[sectionID]);
      });

      //add new section item in insert query object JOKE LANG. WAG GAMITIN TO. 
      //KAPAG SINAVE TSKA LANG NATIN KUNIN VALUES NG BAGONG ITEM
      $("[data-section-id]").on("focusout", "span[contenteditable][new]:not(span[data-sec-item-id])", function (e) {
        var sectionID = $(this).closest('ul').attr('data-section-id');
        var info = $(e.target).text();
        //if (!(sectionID in queries.update.items))
        //  queries.insert.items[sectionID] = {};
        console.log("New item in section " + sectionID + ": " + info);
      });


      $("#roomSection-tab").on('click', 'li > span.fas.fa-times', function (e) {
        $(this).parent().remove();
        var sectionInsertQueryID = $(this).attr('data-target');
        var sectionInsertQueryIcon = $(this).attr('data-target-icon');
        for (index = 0; index < queries.insert.sections.length; index++) {
          if (queries.insert.sections[index].sectionName == sectionInsertQueryID && queries.insert.sections[
              index].sectionIcon == sectionInsertQueryIcon) {
            //console.log("Nasa insert ", index);
            queries.insert.sections.splice(index, 1);
            break;
          } else {
            //console.log("wala paps");
          }
        }
      });
      //generateTabButton("gesi",  "fas fa-address-book fa-2x", "");
      //$('[data-toggle="tooltip"]').tooltip();   

      initializeInputListeners();
      $("#inputRoomCover").change(function () {
        if ($(this).val() == "")
          return;
        const [file] = $(this).prop('files');
        queries.update.roomInfo["roomCover"] = file;
        $(".roomImageCard img").attr('src', URL.createObjectURL(file));
        $(this).val("");
      });

      $(".imagePicker").change(function () {
        if ($(this).val() == "")
          return;
        var galleryDiv = $(this).closest(".container-fluid").find('.row.gallery-row');
        //console.log(galleryDiv);
        const [file] = $(this).prop('files');
        var sectionID = galleryDiv.attr('data-section-id-gallery');
        console.log(file);
        var tempID = new Date().getTime().toString();
        if (!queries.insert.gallery[sectionID]) {
          queries.insert.gallery[sectionID] = {};
        }
        queries.insert.gallery[sectionID][tempID] = {
          "fileObject": file,
          "is360": 0,
          "section": sectionID
        };
        console.log(tempID);
        if (file) {
          src = URL.createObjectURL(queries.insert.gallery[sectionID][tempID].fileObject);
        }
        var template2 = `<div class="col-md-12 col-lg-6 col-xl-4" data-new-image>
                  <div class="card mb-2">
                    <img id="${queries.insert.gallery[sectionID][tempID]}"  class="card-img-top rounded"  src="${src}">
                    <div class="card-img-overlay p-0">
                      <span newImage class="imageModaler" style="display: inline-block; position: relative; width: 100%; height: 100%;"></span>
                      <div class="bannerContainer"> 
                        <span class="badge badge-secondary d-none">360°</span>
                        <span class="badge badge-warning">360° view not availble on unsaved image.</span>
                      </div> 
                      <div class="btn-group dropleft">
                        <a href="javascript: void(0)" data-toggle="dropdown">
                          <span><i class="fas fa-ellipsis-v"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" onclick="toggle360(event, ${sectionID}, ${tempID}, true)" href="javascript: void(0)">Toggle 360</a></li>
                          <li><a class="dropdown-item" onclick="deleteImageEntry(event, ${sectionID}, ${tempID}, true)" href="javascript: void(0)">Delete</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>`;
        galleryDiv.append(template2);
        console.log($(this).val());
        $(".imagePicker").val('');
      });

      //console.log(sessionStorage.getItem("saveStatus"));
if (!(sessionStorage.getItem("saveStatus") === null)) {
try {
console.log(sessionStorage.getItem("saveStatus"))
rsp = JSON.parse(sessionStorage.getItem("saveStatus"));
Toast.fire({
  icon: rsp.isSuccessful ? "success" : "error",
  title: rsp.message
});
sessionStorage.removeItem("saveStatus");
} catch (e) {}
}
toggleLoadingScreen();
});

    var lastSavedRoomImage;

    let queries = {
      "delete": {
        "sections": [],
        "items": {},
        "gallery": {}
      },
      "insert": {
        "sections": [],
        "items": {},
        "gallery": {}
      },
      "update": {
        "roomInfo": {},
        "sections": {},
        "items": {},
        "gallery": {}
      },
    }
  </script>

<!-- Script to toggle navigation buttons -->
<script>
  let activeNav = document.querySelector(".sidebar > nav > ul > li:nth-child(2)"); //change :nth(n) value
  if (activeNav.querySelector('ul') != null){
    activeNav.className += " menu-is-opening menu-open";
    activeNav.querySelector('.menu-open > ul > li:nth-child(1) > a').classList.toggle('active'); //change :nth(n) value
    activeNav.querySelector('ul').style.display = "block";
  }
  activeNav.querySelector('a:nth-child(1)').classList.toggle('active'); //do not change this
</script>

</body>

</html>