<?php
include('db.php');

require_once(dirname(__FILE__, 2)."/public_assets/modules/php/directories/directories.php");
require_once __F_FORMAT__;

$query = "SELECT companyName FROM companyinfo";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$followingdata = $result->fetch_array(MYSQLI_ASSOC);

$query = "SELECT `roomTypeID`, `name` FROM roomtype;";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
ob_start();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <option data-rid="<?php print towtf($row["roomTypeID"], 3);?>"><?php echo $row["name"]; ?></option>
<?php
    }
}
$options = ob_get_contents();  
ob_end_clean();

?>

<!DOCTYPE HTML>
<html lang="en">

<head>	
    <?php 
		require_once(dirname(__FILE__, 2)."/public_assets/modules/php/directories/directories.php");
		include_once(__D_UI__."js/analytics.php"); 
        print __F_BASE_CUSTOMER__;
    ?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $followingdata['companyName']; ?> | Compare Rooms</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/styles.css" rel="stylesheet" />

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
            bottom: 0;
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
    </style>
    <title>Compare Rooms</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="/"><?php echo $followingdata['companyName']; ?></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/compare">Compare</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/rooms">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/amenities">Amenities</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="content m-5">

        <div class="row">
            <div class="col">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Compare</h3>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid ">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card" id="compareCard">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-3 d-flex align-items-center">
                                                        <small id="hint-none" class="text-muted d-block w-100 text-center fade show">Select atleast 1 room</small>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group m-0">
                                                            <select class="form-control select-room" id="select-room-0" data-target-col="0">
                                                                <option>None</option>
                                                                <?php
                                                                    print $options;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group m-0">
                                                            <select class="form-control select-room" id="select-room-1" data-target-col="1">
                                                                <option>None</option>
                                                                <?php
                                                                    print $options;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group m-0">
                                                            <select class="form-control select-room" id="select-room-2" data-target-col="2">
                                                                <option>None</option>
                                                                <?php
                                                                    print $options;
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="collapse" id="collapseExample">
                                                <div class="card-body" id="appendRoomInfoHere">
                                                    <div id="compare-row-roomName" class="row">
                                                        <div class="col-3">
                                                            <h4 class="text-center">Room Name</h4>
                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                    </div>
                                                    <div id="compare-row-rate" class="row">
                                                        <div class="col-3">
                                                            <h4 class="text-center">Rate</h4>
                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                    </div>
                                                    <div id="compare-row-guest" class="row">
                                                        <div class="col-3">
                                                            <h4 class="text-center">Max Guest</h4>
                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                    </div>
                                                    <div id="compare-row-genInfo" class="row">
                                                        <div class="col-3">
                                                            <h4 class="text-center">General Info</h4>
                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                        <div class="col-3">

                                                        </div>
                                                        <div class="col-3">

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
    <script src="/public_assets/modules/libraries/jquery/jquery.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/public_assets/modules/libraries/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- Custom Script -->
    <script src="js/compare.js"></script>

</body>

</html>