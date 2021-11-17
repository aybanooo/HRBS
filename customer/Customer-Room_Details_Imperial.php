<?php
include('db.php');

require_once(dirname(__FILE__, 2) . "/public_assets/modules/php/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_OUTPUT_HANDLER__;
require_once __F_VALIDATIONS__;
require_once "../public_assets/modules/php/database/roomControls/getRoomData.php";

$unwtfedID = tonotwtf($_GET['r'], 3);
$query = "SELECT companyName FROM companyinfo";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$followingdata = $result->fetch_array(MYSQLI_ASSOC);
?>


<!DOCTYPE HTML>
<html lang="en">

<head>
    <?php
    require_once(dirname(__FILE__, 2) . "/public_assets/modules/php/directories/directories.php");
    include_once(__D_UI__ . "js/analytics.php");
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $followingdata['companyName']; ?>| Room Details</title>

    <link href="https://fonts.googleapis.com/css?family=CenturyGothic" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=CenturyGothic:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="css (1)/styles (1).css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="css (1)/fontawesome-free/css/all.min.css">
    <!-- Ion Icons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css (1)/adminlte/adminlte.min.css">
    <!-- Special Style-->
    <link rel="stylesheet" href="css (1)/specialSyle.css">
    <link rel="icon" type="image/x-icon" href="" />

    <style type="text/css">
        body {
            padding-top: 65px;
            background-color: #F2F2F3;
        }

        #mainNav .navbar-brand {
            color: rgba(255, 255, 255, 1);
        }

        #mainNav .nav-link {
            color: rgba(255, 255, 255, 1);
        }

        nav#mainNav {
            background-color: black;
            position: fixed;

        }

        .roomDetails {
            margin-top: 5%;
            margin-bottom: 5%;
            color: black;
            width: 70%;
        }

        a {
            color: #64a19d;
            text-decoration: none;
            background-color: transparent;
        }

        a.roomBack {
            float: left;
            margin: 5% 0 0 5%;
        }

        button.btn.btn-success {
            margin: 3% 5% 0 0;
            float: right;
        }

        .footer {
            background-color: black;
            color: rgba(255, 255, 255, .8);
            padding: 1%;
            position: absolute;
            width: 100%;
            text-align: center;
        }

        .template-demo>.btn {
            margin-right: 0.5rem;
        }

        .template-demo {
            margin-top: 0.5rem;
        }

        .btn.btn-social-icon {
            width: 50px;
            height: 50px;
            padding: 0
        }

        .btn.btn-rounded {
            border-radius: 50px
        }

        .btn-facebook {
            background: #3b579d;
            color: #ffffff
        }

        .btn-twitter {
            background: #2caae1;
            color: #ffffff
        }

        .btn-instagram {
            background: #dc4a38;
            color: #ffffff
        }

        .btn-facebook:hover,
        .btn-facebook:focus {
            background: #2d4278;
            color: #ffffff
        }

        .btn-twitter:hover,
        .btn-twitter:focus {
            background: #1b8dbf;
            color: #ffffff
        }

        .btn-instagram:hover,
        .btn-instagram:focus {
            background: #bf3322;
            color: #ffffff
        }

        .gallery-row .card {
            cursor: pointer;
        }
    </style>
    <title>Room Details</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="Customer-Home.php"><?php echo $followingdata['companyName']; ?></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Compare.php">Compare</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Rooms.php">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Amenities.php">Amenities</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="content my-5 mx-0 mx-md-5">
        <?php
        $query = "SELECT * FROM roomtype WHERE roomTypeID = 38";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $followingdata = $result->fetch_array(MYSQLI_ASSOC);
        ?>
        <div class="row mx-0 mx-lg-5">
            <div class="col mx-0 mx-md-5">
                <div class="container-fluid">
                    <div class="card roomdetail">
                        <div class="card-header d-flex p-0">
                            <div class="container-fluid ce-noblank ce-noenter">
                                <div class="row">
                                    <div class="col-lg-4 mx-auto">
                                        <a class="roomBack" href="Customer-Rooms.php">
                                            < Back to Rooms</a>
                                    </div>
                                    <div class="col-lg-4 mx-auto">

                                        <h3 id="name" class="p-3"><?php echo $followingdata['name']; ?></h3>
                                    </div>
                                    <div class="col-lg-4 mx-auto">
                                        <a href="Customer-Booking_Form.php"><button type="button" class="btn btn-success">Book Now</button></a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">

                            <!-- Row 1 -->
                            <div class="row">
                                <div class="col">
                                    <div class="card mb-2 bg-gradient-dark roomImageCard">
                                        <img class="card-img-top" src="/public_assets/rooms/<?php print $unwtfedID; ?>/<?php print $unwtfedID; ?>-cover.jpg" alt="Dist Photo 1">
                                        <div class="card-img-overlay d-flex flex-column justify-content-end">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Row 1 end -->
                            <!-- Row 2 -->
                            <div class="row mt-4">
                                <div class="col">
                                    <label>Description</label>
                                    <p rows="3 style=" resize: none; margin-top: 0px; margin-bottom: 0px; height: 100px;"><?php echo $followingdata['desc']; ?></p>
                                </div>
                            </div>
                            <!-- Row 2 end-->
                            <?php
                            $queryGuest = "SELECT * FROM roomtype;";
                            $result = mysqli_query($conn, $queryGuest) or die(mysqli_error($conn));
                            $followingdataGuest = $result->fetch_array(MYSQLI_ASSOC);
                            ?>
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><b>Rate</b></h4>
                                        <p class="card-text"><?php echo $followingdataGuest["rate"]; ?></p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><b>Adult</b></h4>
                                        <p class="card-text"><?php echo $followingdataGuest["maxAdult"]; ?></p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><b>Children</b></h4>
                                        <p class="card-text"><?php echo $followingdataGuest["maxChildren"]; ?> </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Row 3 -->
                            <div class="row mt-4">
                                <div class="col">

                                    <div class="container-fluid">
                                        <ul class="nav nav-tabs justify-content-center" id="roomSection-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link hoverable-fas-icon active" id="roomSection-genInfo-tab" data-toggle="pill" href="#roomSection-genInfo" role="tab" aria-controls="roomSection-genInfo" aria-selected="true">
                                                    <i class="fas fa-info fa-2x"></i>
                                                </a>
                                            </li>
                                            <?php
                                            foreach ($full_room_data['sections'] as $key => $val) {
                                            ?>
                                                <li class="nav-item">
                                                    <a class="nav-link hoverable-fas-icon" id="roomSection-<?php print $key; ?>-tab" data-toggle="pill" href="#roomSection-<?php print $key; ?>" role="tab" aria-controls="roomSection-<?php print $key; ?>" aria-selected="false"><i class="<?php print $val['sectionIcon']; ?> fa-2x"></i></a>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                        <div class="tab-content" id="roomSection-tabContent">
                                            <!-- Genereal info Tab-->
                                            <div class="tab-pane fade active show" id="roomSection-genInfo" role="tabpanel" aria-labelledby="roomSection-genInfo-tab">
                                                <div class="container-fluid p-3">
                                                    <div class="row d-flex justify-content-between">
                                                        <label>General Information</label>
                                                    </div>
                                                    <div class="row mx-1 mx-sm-5 my-sm-2">
                                                        <div class="col-12 ce-limit ce-noenter ce-blankremove">
                                                            <ul class="list-unstyled row gen-info-list">
                                                                <?php
                                                                $queryGenInfo = "SELECT A.*, B.* FROM roomsec A INNER JOIN roominfo B ON A.`sectionID`= B.`roomSecID` WHERE A.`general`=1 && A.`roomTypeID`=38;";
                                                                $result = mysqli_query($conn, $queryGenInfo) or die(mysqli_error($conn));
                                                                while ($rowGenInfo = mysqli_fetch_assoc($result)) {
                                                                ?>
                                                                    <li class="list-item col-4 col-md-4"><i class="fas fa-check mx-1"></i><span><?php echo $rowGenInfo["info"]; ?></span></li>
                                                                <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Genereal info Tab End-->

                                            <?php
                                            foreach ($full_room_data['sections'] as $key => $val) {
                                            ?>
                                                <div class="tab-pane fade" id="roomSection-<?php print $key; ?>" role="tabpanel" aria-labelledby="roomSection-<?php print $key; ?>-tab">
                                                    <div class="container-fluid p-3">

                                                        <div class="row d-flex justify-content-between">
                                                            <label><?php print $val['sectionName']; ?> Info</label>
                                                        </div>
                                                        <div class="row mx-1 mx-sm-5 my-sm-2">
                                                            <div class="col-12 ce-limit ce-noenter ce-blankremove">
                                                                <ul class="list-unstyled row gen-info-list">
                                                                    <?php
                                                                    foreach ($val['items'] as $info) {
                                                                    ?>
                                                                        <li class="list-item col-6 col-md-3">
                                                                            <div class="row">
                                                                                <div class="col-auto p-0">
                                                                                    <i class="fas fa-check mx-1"></i>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <span><?php print $info; ?></span>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="row d-flex justify-content-between">
                                                            <label>Gallery</label>
                                                        </div>


                                                        <div class="row gallery-row">
                                                            <?php
                                                            foreach ($val['gallery'] as $gallery_item) {
                                                            ?>
                                                                <div class="col-md-12 col-lg-6 col-xl-4">
                                                                    <div class="card mb-2">
                                                                        <img id="22" class="card-img-top rounded" src="/public_assets/rooms/<?php print $unwtfedID; ?>/<?php print $gallery_item['pictureName']; ?>.jpg">
                                                                        <div class="card-img-overlay p-0">
                                                                            <?php
                                                                            if ($gallery_item['is360'] == "1") {
                                                                            ?>
                                                                                <div class="bannerContainer m-2">
                                                                                    <span class="badge badge-secondary ">360°</span>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>



                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>

                                    <!-- Container Fluid end -->

                                </div>
                                <!-- Row 3 end-->
                            </div>]

                            <!-- Review Card -->
                            <div class="card elevation-0">
                                <div class="card-header">
                                    <h5 class="text-left">Customer Reviews</h5>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="row">
                                                <div class="col">
                                                <?php
                                                    $query = "SELECT * FROM reviews";
                                                    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <div>
                                                        <img class="img-circle img-sm" src="assets (1)/img (1)/Images/user5-128x128.jpg" alt="User Image">
                                                        <!-- Review Entry Row -->
                                                        <div class="m-5">
                                                            <span class="d-block">
                                                                <strong class="d-inline-block">Customer <?php echo $row['reservationID']; ?></strong>
                                                            </span><!-- /.username block -->
                                                            <?php echo $row['review']; ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal 360 -->
            <div class="modal fade" id="modalFor360" tabindex="-1" role="dialog" aria-labelledby="modalFor360" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body d-flex p-0 justify-content-center align-content-center">
                            <div class="embed-responsive embed-responsive-16by9 rounded" id="360div">
                                <iframe frameborder="0" id="360frame" class="embed-responsive-item" src="360view.html"></iframe>
                            </div>
                            <img src="assets/images/defaults/default-image-landscape.png" id="normalImg" class="img-fluid rounded d-none" alt="Responsive image">
                        </div>
                    </div>
                </div>
            </div>

    </section>
    <?php
    $query = "SELECT socialFB, socialTwitter, socialInstagram, contact, email, footerRight
        FROM socialmedias, companyinfo";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $followingdata = $result->fetch_array(MYSQLI_ASSOC);
    ?>
    <div class="footer">
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <p><b>Contact us</b></p>
                <p><?php echo $followingdata["contact"]; ?></p>
                <p><a href="mailto:<?php $followingdata["email"]; ?>"><?php echo $followingdata["email"]; ?></a></p>
            </div>
            <div class="col-lg-4 mx-auto">
                <p>Connect with us at</p>
                <a href="<?php echo $followingdata["socialFB"]; ?>" target="_blank"><button type="button" class="btn btn-social-icon btn-facebook btn-rounded"><i class="fa fa-facebook"></i></button></a>
                <a href="<?php echo $followingdata["socialInstagram"]; ?>" target="_blank"><button type="button" class="btn btn-social-icon btn-instagram btn-rounded"><i class="fa fa-instagram"></i></button></a>
                <a href="<?php echo $followingdata["socialTwitter"]; ?>" target="_blank"><button type="button" class="btn btn-social-icon btn-twitter btn-rounded"><i class="fa fa-twitter"></i></button></a>
            </div>
            <div class="col-lg-4 mx-auto">
                <p><?php echo $followingdata["footerRight"]; ?></p>
            </div>
        </div>
    </div>


    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="js (1)/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="js (1)/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="js (1)/adminlte/adminlte.min.js"></script>
    <!-- Custom Script -->
    <script src="js/compare.js"></script>
    <!-- Page Script -->
    <script>
        $(".gallery-row .card").click(function() {
            let imageSrc = $(this).find('img').attr('src');
            let is360 = $(this).find('.bannerContainer').length != 0;
            console.log(is360);
            if (is360) {
                $("#360div").removeClass('d-none');
                ($("#normalImg").hasClass('d-none')) || $("#normalImg").addClass('d-none');
                $("#360div > iframe").attr('src', '360view.html?image=' + imageSrc);
            } else {
                $("#360div").addClass('d-none');
                $("#normalImg").removeClass('d-none');
                ($("#normalImg").hasClass('d-none')) || $("#normalImg").removeClass('d-none');
                $("#normalImg").attr('src', imageSrc);
            }
            $("#modalFor360").modal('toggle');
        });
    </script>

</body>

</html>