<?php

$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
  $output->setFailed("Cannot connect to database.".$conn->connect_error);
  echo $output->getOutput(true);
  die();
}

$query="SELECT companyName FROM companyInfo";
$result=mysqli_query($conn, $query) or die(mysqli_error($conn));
$followingdata = $result->fetch_array(MYSQLI_ASSOC);
?> 


<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $followingdata['companyName']; ?>| Room Details</title>

    <link href="https://fonts.googleapis.com/css?family=CenturyGothic" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=CenturyGothic:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="css (1)/styles (1).css" rel="stylesheet"/>
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
    body{ 
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
    .roomDetails{
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
    .footer{
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
    .btn-facebook:hover, .btn-facebook:focus {
        background: #2d4278;
        color: #ffffff
    }
    .btn-twitter:hover, .btn-twitter:focus {
        background: #1b8dbf;
        color: #ffffff
    }
    .btn-instagram:hover, .btn-instagram:focus {
        background: #bf3322;
        color: #ffffff
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
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Compare_Rooms.php">Compare</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Rooms.php">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Amenities.php">Amenities</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="content m-5">
    <?php
        $query="SELECT `name`, `desc` FROM roomtype";
        $result=mysqli_query($conn, $query) or die(mysqli_error($conn));
        $followingdata = $result->fetch_array(MYSQLI_ASSOC);
    ?>
        <div class="row">
            <div class="col">
        <div class="container-fluid roomDetails editRoom-container">
        <div class="card roomdetail">
            <div class="card-header d-flex p-0">
            <div class="container-fluid ce-noblank ce-noenter">
                <div class="row">
                    <div class="col-lg-4 mx-auto">
                        <a class="roomBack" href = "Customer-Rooms.php">< Back to Rooms</a>
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
                    <img class="card-img-top" src="assets (1)/img (1)/Images/imperial-suite.jpg" alt="Dist Photo 1">
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
                <p rows="3 style="resize: none; margin-top: 0px; margin-bottom: 0px; height: 100px;"><?php echo $followingdata['desc']; ?></p>
                </div>
            </div>
            <!-- Row 2 end-->

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
                        <li class="nav-item">
                        <a class="nav-link hoverable-fas-icon" id="roomSection-living_room-tab" data-toggle="pill" href="#roomSection-living_room" role="tab" aria-controls="roomSection-living_room" aria-selected="false">
                            <i class="fas fa-couch fa-2x"></i>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link hoverable-fas-icon" id="roomSection-bed_room-tab" data-toggle="pill" href="#roomSection-bed_room" role="tab" aria-controls="roomSection-bed_room" aria-selected="false"><i class="fas fa-bed fa-2x"></i></a>
                        </li>
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
                                <li class="list-item col-4 col-md-4"><i class="fas fa-check mx-1"></i><span>2 Adults</span></li>
                                <li class="list-item col-4 col-md-4"><i class="fas fa-check mx-1"></i><span>2 Children</span></li>
                                <li class="list-item col-4 col-md-4"><i class="fas fa-check mx-1"></i><span>1 Bedroom</span></li>
                                <li class="list-item col-4 col-md-4"><i class="fas fa-check mx-1"></i><span>1 bathroom</span></li>
                                <li class="list-item col-4 col-md-4"><i class="fas fa-check mx-1"></i><span>Wifi</span></li>
                                <li class="list-item col-4 col-md-4"><i class="fas fa-check mx-1"></i><span>Airconditioned</span></li>
                                </ul>
                            </div>
                            </div>

                        </div>
                        </div>
                        <!-- Genereal info Tab End-->
                        
                        <!-- Living Room Tab-->
                        <div class="tab-pane fade" id="roomSection-living_room" role="tabpanel" aria-labelledby="roomSection-living_room-tab">
                        <div class="container-fluid p-3">
                            
                            <div class="row d-flex justify-content-between">
                            <label>Living Room Info</label>
                            </div>
                            <div class="row mx-1 mx-sm-5 my-sm-2">
                            <div class="col-12 ce-limit ce-noenter ce-blankremove">
                                <ul class="list-unstyled row gen-info-list">
                                <li class="list-item col-6 col-md-3"><i class="fas fa-check mx-1"></i><span>Carpet na antique</span></li>
                                <li class="list-item col-6 col-md-3"><i class="fas fa-check mx-1"></i><span>Painting ni Elsa</span></li>
                                <li class="list-item col-6 col-md-3"><i class="fas fa-check mx-1"></i><span>Kurtina sa kama</span></li>
                                <li class="list-item col-6 col-md-3"><i class="fas fa-check mx-1"></i><span>Bintanang sakop buong pader</span></li>
                                <li class="list-item col-6 col-md-3"><i class="fas fa-check mx-1"></i><span>Trojan Horse</span></li>
                                </ul>
                            </div>
                            </div>

                            <div class="row d-flex justify-content-between">
                            <label>Gallery</label>
                            </div>
                            <!-- Image Row -->
                            <div class="row gallery-row">
                            <div class="col-md-12 col-lg-6 col-xl-4">
                                <div class="card mb-2">
                                <img class="card-img-top" src="assets (1)/img (1)/Images/imperial-suite.jpg" alt="Dist Photo 3">
                                <div class="card-img-overlay">
                                
                                </div>
                            </div>
                            </div>
                            <!-- Image Row End -->

                        </div>
                        </div>
                        <!-- Living Room Tab End-->
                        
                    
                        </div>
                        
                        <!-- BedRoom Tab-->
                        <div class="tab-pane fade" id="roomSection-bed_room" role="tabpanel" aria-labelledby="roomSection-bed_room-tab">
                            <div class="container-fluid p-3">
                            
                            <div class="row d-flex justify-content-between">
                                <label>Bedroom Info</label>
                            </div>
                            <div class="row mx-1 mx-sm-5 my-sm-2">
                                <div class="col-12 ce-limit ce-noenter ce-blankremove">
                                <ul class="list-unstyled row gen-info-list">
                                    <li class="list-item col-6 col-md-3"><i class="fas fa-check mx-1"></i><span>1 Bedroom</span></li>
                                    <li class="list-item col-6 col-md-3"><i class="fas fa-check mx-1"></i><span>1 bathroom</span></li>
                                    <li class="list-item col-6 col-md-3"><i class="fas fa-check mx-1"></i><span>1 Kitchen</span></li>
                                    <li class="list-item col-6 col-md-3"><i class="fas fa-check mx-1"></i><span>Wifi</span></li>
                                    <li class="list-item col-6 col-md-3"><i class="fas fa-check mx-1"></i><span>Airconditioned</span></li>
                                </ul>
                                </div>
                            </div>
    
                            <div class="row d-flex justify-content-between">
                                <label>Gallery</label>
                            </div>
                            <!-- Image Row -->
                            <div class="row gallery-row">
                                <div class="col-md-12 col-lg-6 col-xl-4">
                                <div class="card mb-2">
                                <img class="card-img-top" src="assets (1)/img (1)/Images/imperial-suite-2.jpg" alt="Dist Photo 3">
                                    <div class="card-img-overlay">
                                    
                                </div>
                                </div>
                            </div>
                            <!-- Image Row End -->
    
                            </div>
                        </div>
                        </div>
                        </div>
                        <!-- Bed Room Tab End-->
                        </div>
                    
                    <!-- Container Fluid end -->

            </div>
            <!-- Row 3 end-->
            </div>


                <!-- Review Card -->
                        <div class="card elevation-0">
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
                                    <img class="img-circle img-sm" src="assets (1)/img (1)/Images/user3-128x128.jpg" alt="User Image">
                                    
                                    <div class="m-5">
                                        <span class="d-block">
                                        <strong class="d-inline-block">Ella Hanging-lubak</strong>
                                        
                                        <div class="btn-group dropleft ml-2 mr-2 float-right">
                                                <div class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(68px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                
                                        <span class="text-muted d-block d-sm-inline-block float-sm-right reviewDate">8:03 PM Today</span>
                                        <span class="d-block">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </span>
                                        </span><!-- /.username block -->
                                        The accomodation is good. I love it from the bottom of my heart and through the core of my soul &lt;3.
                                    </div>
                                    <!-- /.comment-text -->
                                    </div>
                                    
                                    
                                    <!-- Review Entry Row -->
                                    <!-- Review Entry Row -->
                                    <div>
                                    <!-- User image -->
                                    <img class="img-circle img-sm" src="assets (1)/img (1)/Images/user5-128x128.jpg" alt="User Image">
                                    
                                    <div class="m-5">
                                        <span class="d-block">
                                        <strong class="d-inline-block">Tonio Batumbakal</strong>
                                        <div class="btn-group dropleft ml-2 mr-2 float-right">
                                            <div class="dropdown-menu" role="menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(68px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                        <span class="text-muted d-block d-sm-inline-block float-sm-right reviewDate">8:03 PM Today</span>
                                        <span class="d-block">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </span>
                                        </span><!-- /.username block -->
                                        I am flaberghasted the first time I entered the room. The accomodation is exquisite plus the view is immaculate!
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
                

            </div>	

                    

        </div>
        </div><!-- /.container-fluid -->
        </div>
        </div>
    
    </section>
    <?php
        $query="SELECT socialFB, socialTwitter, socialInstagram, contact, email, footerRight
        FROM socialMedias, companyInfo";
        $result=mysqli_query($conn, $query) or die(mysqli_error($conn));
        $followingdata = $result->fetch_array(MYSQLI_ASSOC);
    ?>
	<div class="footer">
		<div class="row">
			<div class="col-lg-4 mx-auto">
				<p><b>Contact us</b></p>
				<p><?php echo $followingdata["contact"]; ?></p>
				<p><?php echo $followingdata["email"]; ?></p>               
			</div>
			<div class="col-lg-4 mx-auto">
				<p>Connect with us at</p>
					<button type="button" class="btn btn-social-icon btn-facebook btn-rounded" href="<?php echo $followingdata["socialFB"]; ?>"><i class="fa fa-facebook"></i></button>
					<button type="button" class="btn btn-social-icon btn-instagram btn-rounded" href="<?php echo $followingdata["socialInstagram"]; ?>"><i class="fa fa-instagram"></i></button>
					<button type="button" class="btn btn-social-icon btn-twitter btn-rounded" href="<?php echo $followingdata["socialTwitter"]; ?>"><i class="fa fa-twitter"></i></button>          
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

</body>
</html>