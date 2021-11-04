<?php

require_once "customFiles/php/directories/directories.php";

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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-select/css/select.bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Special Style-->
  <link rel="stylesheet" href="customFiles/specialStyle.css">
  <link rel="stylesheet" href="customFiles/loader.css">

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
            <h1>Rooms</h1>
          </div>
          <div class="col-sm-6">
            <div class="row mt-3 mt-sm-0 ">
              <div class="col-6">
              </div>
              <div class="col-6">
                  <a href="javascript: void(0)" data-toggle="modal" data-target="#modal-createNewRoom" ><button class="btn btn-primary btn-block">Add a room</button></a>
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
          <div class="col">
            <div class="card card--skeleton" id="card-roomList">
              <div class="card-body table-bg p-3">
                <h2><span class="nav--skeleton rounded d-inline-block p-0 m-0" style="width: 50%;">&nbsp;</span></h2>
                <h2 class="text-right"><span class="nav--skeleton rounded d-inline-block p-0 m-0" style="width: 30%;">&nbsp;</span></h2>
                <div class="image--skeleton container-fluid rounded" style="height: 250px;">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row d-none">
          <div class="col">
            <!-- Data Table -->
            <div class="card" id="card-roomList">
              <div class="card-header border-0">
                <h2 class="card-title">Manage Room Types - <button class="btn btn-link p-0 m-0" onclick="showRoomCard(1)">Manage Room Numbers</button> - <button class="btn btn-link p-0 m-0" onclick="showRoomCard(2)" >Manage Room Status</button></h2>
              </div>
              <div class="card-body table-bg p-2">
                <!--<span class="a-loader rounded"></span>-->
                <div class="table-responsive">          
                <table id="roomTable" class="table borderless ">
                  <thead class="hidden">
                    <tr>
                      <th>Room</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                </div>
              </div>
            </div>
            <!-- Data Table End -->
          </div>
        </div>


        <div class="row d-none">
          <div class="col">
            <!-- Manage Room Numbers Card -->
            <div class="card" id="card-tableManageRoomNum" style="transition-duration: 0.4s;">
              <div class="card-header border-0">
                <h2 class="card-title"><button class="btn btn-link p-0 m-0" onclick="showRoomCard(0)">Manage Room Types</button> - Manage Room Numbers - <button class="btn btn-link p-0 m-0" onclick="showRoomCard(2)">Manage Room Status</button></h2>
              </div>
              <div class="card-body p-2">

                <table id="table-roomNum" class="table table-bordered table-hover dataTable dtr-inline">
                  <thead>
                    <tr>
                      <th>Room #</th>
                      <th>Floor Level</th>
                      <th>Room Type</th>
                      <th>Status</th>
                      <th>
                        <button class="btn btn-link p-0" id="btn-toggleCheckOnVisible">Select All</button>
                      </th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <!-- Manage Room Numbers Card -->
          </div>
        </div>

        <div class="row d-none">
          <div class="col">
            <!-- Manage Room Status Card -->
            <div class="card" id="card-tableManageRoomStatus">
              <div class="card-header border-0">
                <h2 class="card-title"><button class="btn btn-link p-0 m-0" onclick="showRoomCard(0)">Manage Room Types</button> - <button class="btn btn-link p-0 m-0" onclick="showRoomCard(1)">Manage Room Numbers</button> - Manage Room Status</h2>
              </div>
              <div class="card-body p-2">

                <div class="row">
                  <div class="col">
                    <div class="d-flex justify-content-between">
                      <div>
                        <button class="btn btn-default" id="btn-roomStatus-addOne" type="button" data-toggle="collapse" data-target="#collapseOne-roomStatus" aria-expanded="false" aria-controls="collapseOne-roomStatus">
                                <span>Add One</span>
                        </button>
                      </div>
                      <div>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <select class="form-control rounded-left" id="manageRoomStatus-searchFilter">
                              <option value="-1" selected="selected">All</option>
                              <option value="0">Room Status</option>
                              <option value="1">Description</option>
                              <option value="2">Bookable</option>
                            </select>
                          </div>
                          <input id="manageRoomStatus-search" type="text" class="form-control rounded-right" placeholder="Search...">
                        </div>
                      </div>
                    </div>
                    <div id="accordion-roomStatus" class="accordion">
                      <div id="collapseOne-roomStatus" class="fade active collapse" aria-labelledby="headingOne" data-parent="#accordion-roomStatus">
                        <form id="form-one-RoomStatus" novalidate="novalidate">
                          <div class="row pt-3 pb-2">
                            <div class="col">
                              <div class="form-group">
                              <input type="text" class="form-control form-control-border" id="input-one-newRoomStatus" name="input-one-newRoomStatus" placeholder="Room Status Name">
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <input type="text" class="form-control form-control-border" id="input-one-newDescription" name="input-one-newDescription" placeholder="Description">
                              </div>
                            </div>
                            <div class="col">
                              <span class="font-weight-bold text-gray" style="pointer-events: none; position: absolute; top: -5px; left: 0; font-size: 1.5ex;">Bookable</span>
                              <select class="custom-select form-control-border bg-transparent selectRoomType" id="select-one-bookable" name="select-one-bookable">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                              </select>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-default btn-block mb-1" id="btn-AddRoomStatus">
                            <span>Add</span>  
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <table id="table-roomStatus" class="table table-bordered table-hover dataTable dtr-inline">
                  <thead>
                    <tr>
                      <th>Room Status</th>
                      <th>description</th>
                      <th>Bookable</th>
                      <th>
                        <button class="btn btn-link p-0" id="btn-roomStatus-toggleCheckOnVisible">Select All</button>
                      </th>
                    </tr>
                  </thead>
                </table>

              </div>
            </div>
            <!-- Manage Room Status Card -->
          </div>
        </div>


      </div><!-- /.container-fluid -->

      <!-- Modal -->
      <div class="modal fade" id="modal-createNewRoom">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <form id="form-createNewRoom">
              <div class="modal-header">
                <h4 class="modal-title">Add a room</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group m-0">
                  <input type="text" class="form-control text-center" name="roomName" placeholder="Room Name">
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!--Modal End-->

      <!-- Modal -->
      <div class="modal fade" id="modal-changeSelected">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <form id="form-changeSelected">
              <div class="modal-header">
                <h4 class="modal-title">Change Selected</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-1 d-flex align-items-center justify-content-center">
                      <input type="checkbox" class="form-check-input m-0 checkGroup" id="check-toggleRoomTypeSelect" name="check-toggleRoomTypeSelect" checked>
                  </div>
                  <div class="col">
                    <div class="form-group select-roomTypes m-0">

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-1 d-flex align-items-center justify-content-center">
                      <input type="checkbox" class="form-check-input m-0 checkGroup" id="check-toggleRoomStatusSelect" name="check-toggleRoomStatusSelect" checked>
                  </div>
                  <div class="col">
                    <div class="form-group select-roomStatus m-0">

                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Change</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!--Modal End-->

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
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
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
<script src="plugins/datatables-select/js/dataTables.select.min.js"></script>
<script src="plugins/datatables-select/js/select.bootstrap4.min.js"></script>
<script src="plugins/datatables-editor/dataTables.editor.min.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- Special Script-->
<script src="customFiles/customScript.js"></script>
<script src="customFiles/initialize Toastr.js"></script>
<!-- Page Special Script -->
<script>
  dimRooms();
</script>
<!-- Table script -->
<script>
var tbl = $('#roomTable').DataTable({

  paging: false,
  info: false,
  "dom": '<"row"<"col"><"col"f>>rtip', // Positions table elements
  /*"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]], // Sets up the amount of records to display
  "language": {
    "search": "_INPUT_",            // Removes the 'Search' field label
    "searchPlaceholder": "Search"   // Placeholder for the search box
  }*/
});

//$('#roomTable_wrapper > div.row:first-child > div:first-child').append('<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-manageRoomNum">Manage room numbers</button>')

$('.dataTables_length').addClass('bs-select');

$("#form-createNewRoom").validate({
  rules: {
    roomName: {
      required: true,
      isUnique: true
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
    //console.log($(form).find('input').val());

    $.ajax({
      type: "post",
      url: "customFiles/php/database/roomControls/createRoom.php",
      data: {
        roomName: $(form).find('input').val() 
      },
      async: false,
      success: function (response) {
        response = JSON.parse(response);
        if(response.isSuccessful)
          tbl.row.add(addRoomEntry( response.data.roomTypeID, response.data.name )).draw(false);
          dimRooms();
          //console.log(response);
        Toast.fire({
          icon: response.isSuccessful ? "success" : "error",
          title: response.isSuccessful ? "Room has been `successfuly added." : "Cannot add room. " + response.message
        });
        refreshManageRoomNumSelectElements();
      }
    });

    e.preventDefault();
    $("#modal-createNewRoom").modal('toggle');
    form.reset();
    tbl.draw(false);
    //$(form).submit();
  }
});

jQuery.validator.addMethod("isUnique", function(value, element) {
  $.ajax({
      type: 'get',
      url: 'customFiles/php/database/roomControls/checkIfRoomExists.php',
      data: {
        roomName: value
      },
      async: false,
      success: function (response) {
        output = JSON.parse(response);
        //console.log(response);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown);
      }
    });
    return !output.data;
}, "Room already exists.");

function generateRoomList() {
  $.ajax({
    type: "get",
    url: "customFiles/php/database/roomControls/getRoomList.php",
    async: false,
    success: function (response) {
      console.log(JSON.parse(response));
      output = JSON.parse(response);
      //console.log(output);
      output.data.forEach(element => {
        //console.log(element.roomTypeID);
        
        tbl.row.add(addRoomEntry( element.roomTypeID, element.name, element.desc )).draw(false);
        dimRooms();
        
      });
    }
  });
}

function refreshManageRoomNumSelectElements() {
  $.ajax({
    type: "get",
    url: "/admin/customFiles/php/database/roomNumberControls/getSelectableRoomTypes.php",
    dataType: "json",
    success: function (response) {
      $("select[name='selectRoomType']").replaceWith(response.data); 
    }
  });

  $.ajax({
    type: "get",
    url: "/admin/customFiles/php/database/roomNumberControls/getSelectableRoomStatus.php",
    dataType: "json",
    success: function (response) {
      $("select[name='selectRoomStatus']").replaceWith(response.data); 
    }
  });

}

function createDatatable() {
  
  //creates room number management datatable
  tableManageRoom = $('#table-roomNum').DataTable( {
    "language": { search: "" },
    "paging": true,
    "lengthChange": true,
    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": false,
    dom: '<"d-flex justify-content-between"<"#appendAddButtons"><"#appendSearch">><"#accordionInput.accordion"><"#toggleColumn.row pt-2 pb-1"<"col text-right"l>>rt<"row"<"col"B><"col text-center"i><"col"p>><"#itemPool.row">',
    buttons: [
        {
            text: 'Delete Selection',
            className: 'btn btn-danger',
            action: function ( e, dt, node, config ) {
              var ids = $.map(tableManageRoom.rows('.selected').data().pluck("roomNo"), function (item) {
                return item;
              });
              deleteSelection(ids);
            }
        },
        {
            text: 'Change Selection',
            className: 'btn btn-default',
            action: function ( e, dt, node, config ) {
              var ids = tableManageRoom.rows( {selected: true} ).count();
              if(ids == 0) {
                Toast.fire({
                  icon: "error",
                  title: "No records selected. Please select some records."
                });
                return;
              }
              //console.log(ids.length);
              $("#modal-changeSelected").modal('toggle');
            },
            attr:  {
                id: 'btn-changeSelection'
            }
        }
    ],
    ajax: {
        url: '/admin/customFiles/php/database/roomNumberControls/getRoomNumList.php',
        dataSrc: 'data'
    },
    columns: [
        {
            "width": "100px",
            "data": "roomNo",
            "render": function ( data, type, row, meta ) {
              return data;
              //return '<span hidden>'+data+'</span><input type="number" value="'+data+'" class="form-control form-control-border bg-transparent text-center">';
            }
          },
          {
            "width": "100px",
            "data": "floorLevel",
            "render": function ( data, type, row, meta ) {
              return data;
              //return '<span hidden>'+data+'</span><input type="number" value="'+data+'" class="form-control form-control-border bg-transparent text-center">';
            }
          },
          {
            "data": "roomtypeName",
            "render": function ( data, type, row, meta ) {
              return data;
              //return generateSelectableField(data);
            }
          },
          { "data": "roomStatusLabel" },
          {}
    ],
    columnDefs: [
      {
          "width": "65px",
          orderable: false,
          className: 'select-checkbox',
          defaultContent: '',
          data: null,
          targets: 4
      }
    ],
    select: {
          style:    'mutli',
          selector: 'td:last-child'
    },
    order: [[ 1, 'asc' ]]
  } );

  tableManageRoomStatus = $('#table-roomStatus').DataTable({
    "language": { search: "" },
    "paging": true,
    "lengthChange": true,
    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": false,
    dom: 'rt<"row"<"col"B><"col text-center"i><"col"p>>',
    ajax: {
        url: '/admin/customFiles/php/database/roomStatusControls/getRoomStatusList.php',
        dataSrc: 'data'
    },
    buttons: [
      {
          text: 'Delete Selection',
          className: 'btn btn-danger',
          action: function ( e, dt, node, config ) {
            var ids = $.map(tableManageRoomStatus.rows('.selected').data().pluck("roomStatusID"), function (item) {
              return item;
            });
            deleteStatusSelection(ids);
          },
          attr:  {
              id: 'btn-deleteSelectedRoomStatus'
          }
      }
    ],
    columns: [
      {
        "data": "roomStatus",
        "render": function ( data, type, row, meta ) {
          return data;
        }
      }, {
        "data": "description",
        "render": function ( data, type, row, meta ) {
          return data;
        }
      }, {
        "data": "bookable",
        "render": function ( data, type, row, meta ) {
          return parseInt(data) ? "Yes" : "No";
        }
      },
      {}
    ],
    columnDefs: [
      {
          "width": "65px",
          orderable: false,
          className: 'select-checkbox',
          defaultContent: '',
          data: null,
          targets: 3
      }
    ],
    select: {
          style:    'mutli',
          selector: 'td:last-child'
    },
    order: [[ 0, 'asc' ]]
  });

  setTimeout(function() {
    //$("#table-roomNum_wrapper .dataTables_scrollHead table thead tr th:first-child").click();
  }, 500);
  addManageRoomInputs();
  customSearchBox();
  addColumnVisibility();
  initializeEventListeners();
  initializeFormValidator();
}

function initializeDataTablesData() {
  getSelectableRoomList();
}

///admin/customFiles/php/database/roomNumberControls/getRoomNumList.php

function getSelectableRoomList() {
  $.ajax({
    type: "get",
    url: "/admin/customFiles/php/database/roomNumberControls/getSelectableRoomTypes.php",
    dataType: "json",
    success: function (response) {
      selectTableRooms = response.data; 
      getSelectableRoomStatus();
    }
  });
}

function getSelectableRoomStatus() {
  $.ajax({
    type: "get",
    url: "/admin/customFiles/php/database/roomNumberControls/getSelectableRoomStatus.php",
    dataType: "json",
    success: function (response) {
      selectTableRoomStatus = response.data; 
      console.log("DONE");
      createDatatable();
    }
  });
}

function generateSelectableField(data) {
  parsedSelect = $('<div>').html(selectTableRooms);
  parsedSelect.find('option[value="'+data+'"]').attr('selected', '');
  stringValue = parsedSelect.find('option[value="'+data+'"]').text();
  return '<span hidden>'+stringValue+'</span>'+parsedSelect.html();
}


function initializeFormValidator() {
  
  $("#form-one-RoomNum").validate({
    rules: {
      "input-one-newRoomNumber": {
        required: true,
        remote: {
          url: "/admin/customFiles/php/database/roomNumberControls/checkIfOneRoomNoExist.php",
          type: "post",
          data: {
            roomNo: function() {
              return $( "#input-one-newRoomNumber").val();
            }
          }
        }
      },
      "input-one-newFloorLevel": {
        required: true,
        min: 0
      }
    },
    messages: {
      "input-one-newRoomNumber": {
        remote: "Room # exists"
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
        e.preventDefault();
        
        console.log($(form).find("select[name='selectRoomType']").val());
        
        $.ajax({
          type: "post",
          url: "/admin/customFiles/php/database/roomNumberControls/addOneRoomNum.php",
          data: {
            roomNo: $(form).find("#input-one-newRoomNumber").val(),
            floorLevel: $(form).find("#input-one-newFloorLevel").val(),
            roomTypeID: $(form).find("select[name='selectRoomType']").val(),
            statusID: $(form).find("select[name='selectRoomStatus']").val()
          },
          dataType: "json",
          success: function (response) {
            Toast.fire({
              icon: response.isSuccessful ? "success" : "error",
              title: response.isSuccessful ? response.message : response.message + (response.error.desc ?? "")
            });
            tableManageRoom.ajax.reload();
            $("#itemPool").html();
            $("#form-one-RoomNum").trigger('reset');
          }
        });
        
    }
  });

  $("#form-multi-RoomNum").validate({
    groups: {
      roomNumRange: "input-multi-rangeFirst input-multi-rangeLast"
    },
    rules: {
      "input-multi-rangeFirst": {
        require_from_group: [2, ".roomNumRange"],
        remote: {
          url: "/admin/customFiles/php/database/roomNumberControls/checkIfNoExistingRoomInRange.php",
          type: "get",
          data: {
            roomNoFirst: function() {
              return $( "#input-multi-rangeFirst").val();
            },
            roomNoLast: function() {
              return $( "#input-multi-rangeLast").val();
            },
            ignoreExisting: function() {
              return $("#check-ignoreExistingRoomNum").prop('checked');
            }
          }
        }
      },
      "input-multi-rangeLast": {
        min: 0,
        require_from_group: [2, ".roomNumRange"],
        remote: {
          url: "/admin/customFiles/php/database/roomNumberControls/checkIfNoExistingRoomInRange.php",
          type: "get",
          data: {
            roomNoFirst: function() {
              return $( "#input-multi-rangeFirst").val();
            },
            roomNoLast: function() {
              return $( "#input-multi-rangeLast").val();
            },
            ignoreExisting: function() {
              return $("#check-ignoreExistingRoomNum").prop('checked');
            }
          }
        }
      },
      "input-multi-newFloorLevel": {
        required: true,
        min: 0  
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
        e.preventDefault();
        //console.log($(form).find("select[name='selectRoomType']").val());
        toggleButtonDisabled("#form-multi-RoomNum button[type='submit']", "#card-tableManageRoomNum", "Adding...");
        $.ajax({
          type: "post",
          url: "/admin/customFiles/php/database/roomNumberControls/addRoomNumRange.php",
          data: {
            roomNoFirst: $(form).find("#input-multi-rangeFirst").val(),
            roomNoLast: $(form).find("#input-multi-rangeLast").val(),
            floorLevel: $(form).find("#input-multi-newFloorLevel").val(),
            roomTypeID: $(form).find("select[name='selectRoomType']").val(),
            statusID: $(form).find("select[name='selectRoomStatus']").val()
          },
          dataType: "json",
          success: function (response) {
            Toast.fire({
              icon: response.isSuccessful ? "success" : "error",
              title: response.isSuccessful ? response.message : response.message + (response.error.desc ?? "")
            });
            tableManageRoom.ajax.reload();
            $("#itemPool").html();
            $("#form-multi-RoomNum").trigger("reset");
            toggleButtonDisabled("#form-multi-RoomNum button[type='submit']", "#card-tableManageRoomNum");
          }
        });

    }
  });

  $("#form-changeSelected").validate({
    groups: {
      checkGroup: "check-toggleRoomTypeSelect check-toggleRoomStatusSelect"
    },
    rules: {
      "check-toggleRoomTypeSelect": {
        require_from_group: [1, '.checkGroup']
      },
      "check-toggleRoomStatusSelect": {
        require_from_group: [1, '.checkGroup']
      }
    },
      errorElement: 'span',
      errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.modal-body').append(error);
    },
      highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
      unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
    submitHandler: function(form, e) {
      e.preventDefault();
      $("#modal-changeSelected").modal('toggle');var ids = $.map(tableManageRoom.rows('.selected').data().pluck("roomNo"), function (item) {
        return item;
      });
      toggleButtonDisabled("#btn-changeSelection", "#card-tableManageRoomNum", "Updating...");
      $.ajax({
        type: "post",
        url: "/admin/customFiles/php/database/roomNumberControls/changeTypeAndStatus.php",
        data: ($(form).serialize()+"&roomNums="+ids),
        dataType: "json",
        success: function (response) {
          //console.log(response);
            Toast.fire({
              icon: response.isSuccessful ? "success" : "error",
              title: response.isSuccessful ? response.message : response.message + (response.error.desc ?? "")
            });
            tableManageRoom.ajax.reload();
            $("#itemPool").html('');
            toggleButtonDisabled("#btn-changeSelection", "#card-tableManageRoomNum");
        }
      });

    }
  });

  
  $("#form-one-RoomStatus").validate({
    rules: {
      "input-one-newRoomStatus": {
        required: true,
        remote: "/admin/customFiles/php/database/roomStatusControls/checkIfRoomStatusExist.php"
      },
      "input-one-newDescription": {
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
    submitHandler: function(form, e) {
      //console.log($(form).serialize());
      toggleButtonDisabled("#btn-AddRoomStatus", "#card-tableManageRoomStatus", "Adding...");
      $.ajax({
        type: "post",
        url: "/admin/customFiles/php/database/roomStatusControls/addRoomStatus.php",
        data: $(form).serialize(),
        dataType: "json",
        success: function (response) {
          console.log(response);
          toggleButtonDisabled("#btn-AddRoomStatus", "#card-tableManageRoomStatus");
          Toast.fire({
            icon: response.isSuccessful ? "success" : "error",
            title: response.isSuccessful ? response.message : response.message + (response.error.desc ?? "")
          });
          if (response.isSuccessful)
              $(form).trigger('reset');
          tableManageRoomStatus.ajax.reload();
          refreshManageRoomNumSelectElements();
        }
      });

    }
  });

  $("#check-ignoreExistingRoomNum").change(function() {
    $("#form-multi-RoomNum").valid();
  });

  jQuery.validator.addMethod("noExistingRoomNumInRange", function(value, element) {
    $.ajax({
      type: 'get',
      url: '/admin/customFiles/php/database/roomNumberControls/checkIfNoExistingRoomInRange.php',
      data: {
        roomNo: value
      },
      success: function (response) {
          console.log(response === "1" ? true : false);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown);
      }
    });
  }, "Room already exists.");

}

function initializeEventListeners() {
  
  tableManageRoom.on( 'select', function ( e, dt, type, indexes ) {
      if ( type === 'row' ) {
          var data = tableManageRoom.rows( indexes ).data().pluck("roomNo")[0];
          if($("#itemPool").find( $(`span[data-poolid='${data}']`) ).length != 0)
            return;
          var el = `<span class="p-1 ml-2 rounded bg-info" data-poolID="${data}">${data}</span>`;
          $("#itemPool").append(el);
      }
  } );

  tableManageRoom.on( 'deselect', function ( e, dt, type, indexes ) {
      if ( type === 'row' ) {
          var data = tableManageRoom.rows( indexes ).data().pluck("roomNo")[0];
          //console.log(data);
          $("#itemPool span[data-poolID='"+data+"']").remove();
      }
  } );

  $("#manageRoomNum-searchFilter").change( function() {
    colToSearch = $(this).val();
    searchValue =  $("#manageRoomNum-search").val();
    searchManageRoomNumTable(searchValue, colToSearch);
  });

  $("#manageRoomNum-search").on('keyup', function() {
    colToSearch = $("#manageRoomNum-searchFilter :selected").val();
    searchValue = $(this).val();
    searchManageRoomNumTable(searchValue, colToSearch);
  });
  
  $("#manageRoomStatus-searchFilter").change( function() {
    colToSearch = $(this).val();
    searchValue =  $("#manageRoomStatus-search").val();
    searchManageRoomStatusTable(searchValue, colToSearch);
  });

  $("#manageRoomStatus-search").on('keyup', function() {
    colToSearch = $("#manageRoomStatus-searchFilter :selected").val();
    searchValue = $(this).val();
    searchManageRoomStatusTable(searchValue, colToSearch);
  });

  $('#appendAddButtons button').on('click', function (event) {
    target = $(this).attr('data-target');
    $(target).tab('show');
  });

  $("#btn-toggleCheckOnVisible").click( function(){
    //tableManageRoom.rows( { search: 'applied' } ).select();
    console.log(tableManageRoom.rows( '.selected' ).count());
    if(tableManageRoom.rows( { search: 'applied', selected: true, page: 'current' } ).count() != tableManageRoom.rows( { search: 'applied', page: 'current' } ).count()) {
      tableManageRoom.rows( { search: 'applied', page: 'current' } ).select().data().each(function(item) {

        if($("#itemPool").find( $(`span[data-poolid='${item.roomNo}']`) ).length == 0) {
          //console.log(item.roomNo, "doesnt exists");
          $("#itemPool").append('<span class="p-1 ml-2 rounded bg-info" data-poolid="'+item.roomNo+'">'+item.roomNo+"</span>");
        }

      });

    } else {
      tableManageRoom.rows( { search: 'applied', page: 'current' } ).deselect().data().each(function(item) {
          $("#itemPool").find( $(`span[data-poolid='${item.roomNo}']`) ).remove();
        });
    }
  });
  
  $("#btn-roomStatus-toggleCheckOnVisible").click( function(){
    //tableManageRoomStatus.rows( { search: 'applied' } ).select();
    console.log(tableManageRoomStatus.rows( '.selected' ).count());
    if(tableManageRoomStatus.rows( { search: 'applied', selected: true, page: 'current' } ).count() != tableManageRoomStatus.rows( { search: 'applied', page: 'current' } ).count()) {
      tableManageRoomStatus.rows( { search: 'applied', page: 'current' } ).select().data();
    } else {
      tableManageRoomStatus.rows( { search: 'applied', page: 'current' } ).deselect().data();
    }
  });

  $("input#check-toggleRoomTypeSelect").change(function() {
    var isEnabled = $(this).prop('checked');
    if (isEnabled) {
      $("#form-changeSelected select[name='selectRoomType']").removeAttr('disabled');
    } else {
      $("#form-changeSelected select[name='selectRoomType']").attr('disabled', '');
    }
  });

  $("input#check-toggleRoomStatusSelect").change(function() {
    var isEnabled = $(this).prop('checked');
    if (isEnabled) {
      $("#form-changeSelected select[name='selectRoomStatus']").removeAttr('disabled');
    } else {
      $("#form-changeSelected select[name='selectRoomStatus']").attr('disabled', '');
    }
  });

}

function deleteSelection(selection) {
  if(selection.length == 0) {
    Toast.fire({
      icon: "error",
      title: "No rows selected"
    });
    return;
  }

  $.ajax({
    type: "post",
    url: "/admin/customFiles/php/database/roomNumberControls/deleteRoomNumbers.php",
    data: {
      roomNoArray: selection
    },
    dataType: "json",
    success: function (response) {
      //console.log(response);
      Toast.fire({
        icon: response.isSuccessful ? "success" : "error",
        title: response.message
      });
      tableManageRoom.ajax.reload();
      $("#itemPool").html('');
    }
  });

}


function deleteStatusSelection(selection) {
  if(selection.length == 0) {
    Toast.fire({
      icon: "error",
      title: "No rows selected"
    });
    return;
  }
  toggleButtonDisabled("#btn-deleteSelectedRoomStatus", "#card-tableManageRoomStatus", "Deleting...");
  $.ajax({
    type: "post",
    url: "/admin/customFiles/php/database/roomStatusControls/deleteRoomStatus.php",
    data: {
      roomStatusIDArray: selection,
    },
    dataType: "json",
    success: function (response) {
      console.log(response);
      Toast.fire({
        icon: response.isSuccessful ? "success" : "error",
        title: response.message
      });
      tableManageRoomStatus.ajax.reload();
      toggleButtonDisabled("#btn-deleteSelectedRoomStatus", "#card-tableManageRoomStatus");
    }
  });

}

function searchManageRoomNumTable(value = null, column = null) {
  column = parseInt(column);
  if(colToSearch >= 0) {
    console.log(value, column);
    tableManageRoom.search( "" ).draw();
    tableManageRoom.columns([0,1,2,3]).search("").draw();
    tableManageRoom.columns(column).search(value).draw();
  } else {
    console.log("All");
    tableManageRoom.columns([0,1,2,3]).search("").draw();
    tableManageRoom.search( value ).draw();
  }
}

function searchManageRoomStatusTable(value = null, column = null) {
  column = parseInt(column);
  if(colToSearch >= 0) {
    console.log(value, column);
    tableManageRoomStatus.search( "" ).draw();
    tableManageRoomStatus.columns([0,1,2]).search("").draw();
    tableManageRoomStatus.columns(column).search(value).draw();
  } else {
    console.log("All");
    tableManageRoomStatus.columns([0,1,2]).search("").draw();
    tableManageRoomStatus.search( value ).draw();
  }
}

function showRoomCard(index) {
  /*
  var tblmngrmCard = $("#card-tableManageRoomNum");
  var roomListCard = $("#card-roomList");
  var vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
  var loc =  vh > tblmngrmCard.height() ? tblmngrmCard.offset().top - (vh - tblmngrmCard.height()) : (roomListCard.offset().top + roomListCard.height());
  $('html,body').animate({scrollTop: loc }, 1000);
  */
  $(".content > .container-fluid > .row").addClass('d-none');
  $(".content > .container-fluid > .row").eq(index).removeClass('d-none');
}

$(document).ready(function () {
  initializeDataTablesData();
  $(".content > .container-fluid > .row:first-child").remove();
  showRoomCard(0);
});

function customSearchBox() {
  console.log("gege");
  var element = `
  <div class="input-group">
                  <div class="input-group-prepend">
                    <select class="form-control rounded-left" id="manageRoomNum-searchFilter">
                      <option value="-1" selected="selected">All</option>
                      <option value="0">Room #</option>
                      <option value="1">Floor Level</option>
                      <option value="2">Room Type</option>
                      <option value="3">Status</option>
                    </select>
                  </div>
                  <input id="manageRoomNum-search" type="text" class="form-control rounded-right" placeholder="Search...">
                </div>
  `;
  $("#appendSearch").html(element);
}

function addManageRoomInputs() {
  tabNav = `
  <button class="btn btn-default" id="btn-addOne" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <span>Add One</span>
  </button>
  <button class="btn btn-default" id="btn-AddMultiple" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <span>Add Multiple</span>
  </button>`;

  tabBody = `
    <div id="collapseOne" class="fade active collapse" aria-labelledby="headingOne" data-parent="#accordionInput">
      <form id="form-one-RoomNum">
      <div class="row pt-3 pb-2">
        <div class="col-2">
          <div class="form-group">
          <input type="number" class="form-control form-control-border" id="input-one-newRoomNumber" name="input-one-newRoomNumber" placeholder="Room #" min="0">
          </div>
        </div>
        <div class="col-2">
          <div class="form-group">
            <input type="number" class="form-control form-control-border" id="input-one-newFloorLevel" name="input-one-newFloorLevel" placeholder="Floor Level" min="0">
          </div>
        </div>
        <div class="col">
          ${selectTableRooms}
        </div>
        <div class="col">
          ${selectTableRoomStatus}
        </div>
      </div>
      <button type="submit" class="btn btn-default btn-block mb-1">
        <span>Add</span>  
      </button>
      </form>
    </div>
    
    <div id="collapseTwo" class="fade active collapse" aria-labelledby="headingTwo" data-parent="#accordionInput">
      <form id="form-multi-RoomNum">
      <div class="row pt-3 pb-2">
        <div class="col d-flex align-items-center">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="check-ignoreExistingRoomNum">
            <label class="form-check-label" for="check-ignoreExistingRoomNum">Ignore existing room #</label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-4">
          <div class="row">
            <div class="col">
              <input type="number" class="form-control form-control-border roomNumRange" id="input-multi-rangeFirst" name="input-multi-rangeFirst" placeholder="First Room #" min="0">
            </div>
            <div class="col">
              <input type="number" class="form-control form-control-border roomNumRange" id="input-multi-rangeLast" name="input-multi-rangeLast" placeholder="Last Room #" min="0">
            </div>
          </div>
        </div>
        <div class="col-2">
          <input type="number" class="form-control form-control-border" id="input-multi-newFloorLevel" name="input-multi-newFloorLevel" placeholder="Floor Level" min="0">
        </div>
        <div class="col">
          ${selectTableRooms}
        </div>
        <div class="col">
          ${selectTableRoomStatus}
        </div>
      </div>

      <button type="submit" class="btn btn-default btn-block mb-1">
        <span>Add</span>  
      </button>
      </form>
    </div>

  `;
  $("#appendAddButtons").append(tabNav);
  $("#accordionInput").append(tabBody);
  $("#modal-changeSelected .modal-body .select-roomTypes").append(selectTableRooms);
  $("#modal-changeSelected .modal-body .select-roomStatus").append(selectTableRoomStatus);
}

function addColumnVisibility() {
  col = `
          <div class="col">
            <div>
              Toggle column: 
              <a class="toggle-vis" data-column="0">Room #</a> - 
              <a class="toggle-vis" data-column="1">Floor Level</a> - 
              <a class="toggle-vis" data-column="2">Room Type</a> - 
              <a class="toggle-vis" data-column="3">Status</a>
            </div>
          </div>
        </div>`;
        $("#toggleColumn").prepend(col);
}

$('.content').on('click', "a.toggle-vis", function (e) {
  e.preventDefault();
  
  // Get the column API object
  var column = tableManageRoom.column( $(this).attr('data-column') );

  // Toggle the visibility
  column.visible( ! column.visible() );
} );

function toggleButtonDisabled(selector = null, disableBtnScopeSelector = "*", disabledText = "Loading...") {
      if(selector==null) return;
      disableBtnScopeSelector = disableBtnScopeSelector.trim();
      disableBtnScopeSelector = disableBtnScopeSelector == "" || disableBtnScopeSelector == null ? "*" : disableBtnScopeSelector;
      if($(selector).prop('disabled')==false) {
        $(disableBtnScopeSelector+" .btn").prop('disabled', true);
        $(selector + " > span").addClass('d-none');
        $(selector).append('<span class="disabledText">'+disabledText+'</span>');
        $(selector).prepend(`<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>`);
      } else {
        $("#btn-changeSelection").attr('disabled', '');
        $(selector + " > .spinner-border").remove();
        $(selector + " > .disabledText").remove();
        $(selector + " > span").removeClass('d-none');
        $(disableBtnScopeSelector+" .btn").prop('disabled', false);
      }
}

generateRoomList();
</script>
<style>
  .top label {
    padding-right: 10px !important;
  }
</style>

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
