<?php
require_once(dirname(__FILE__, 2) . "/public_assets/modules/php/directories/directories.php");
require_once __F_FORMAT__;
require_once __F_VALIDATIONS__;
require_once __F_RSV_HANDLER__;
include('db.php');

$query="SELECT companyName FROM companyinfo";
$result=mysqli_query($conn, $query) or die(mysqli_error($conn));
$followingdata = $result->fetch_array(MYSQLI_ASSOC);

$validCheckinOutDate = isset($_GET['d']) && $_GET['d'] != "";
if($validCheckinOutDate) {
	$d = $_GET['d'];
	$d_urlDecoded = urldecode($d);
	$d_base64Decoded = base64_decode($d_urlDecoded);
	$date = json_decode($d_base64Decoded);
	(!is_null($date) && count($date)==2) || die("Invalid Date");
	(validateDate($date[0]) && validateDate($date[1])) || die("Invalid Date");
	$checkIn = $date[0];
	$checkOut = $date[1];
}

$roomsID = getBookableRoomsID($checkIn, $checkOut);
#echo json_encode( getBookableRoomsID("2021-11-29", "2021-11-30") );
$rooms = "";

if(!empty($roomsID))
	$rooms = getRoomDetails($roomsID);



// echo base64_decode("eyJjaGVja0luRGF0ZSI6IjIwMjEtMTEtMjkiLCJjaGVja091dERhdGUiOiIyMDIxLTExLTA1In0='");
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<?php
    require_once(dirname(__FILE__, 2) . "/public_assets/modules/php/directories/directories.php");
    include_once(__D_UI__ . "js/analytics.php");
    print __F_BASE_CUSTOMER__;
    ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $followingdata['companyName']; ?> | Available Rooms</title>

	<link href="https://fonts.googleapis.com/css?family=CenturyGothic" rel="stylesheet" />
	<link href="css (1)/styles (1).css" rel="stylesheet" />
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="css (1)/fontawesome-free/css/all.min.css">
	<!-- Ion Icons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="css (1)/adminlte/adminlte.min.css">
	<!-- Special Style-->
	<link rel="stylesheet" href="css (1)/specialSyle.css">
    <link href="css/styles.css" rel="stylesheet"/>
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

		.boxinfo1 {
			background-image: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(0, 0, 0, 0.8));
			background-repeat: no-repeat;
			background-position: center;
			background-size: cover;
			width: 70%;
			height: auto;
			margin: auto;
			margin-top: 5%;
			margin-bottom: 5%;
			box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.4);
			border-radius: 5px;
			padding-bottom: 25px;
			overflow: auto;
			padding: 1%;
		}

		.roomright {
			display: block;
			width: 70%;
			float: right;
			padding: 2%;
			text-align: justify;
			color: white;
		}

		.roomright h1 {
			font-size: 1.5em;
		}

		.roomright p {
			display: block;
			font-size: 1em;
			margin-top: 15px;
		}

		.roomright button {
			float: right;
		}

		.roomleft {
			display: block;
			width: 70%;
			float: left;
			padding: 2%;
			text-align: justify;
			color: white;
		}

		.roomleft h1 {
			font-size: 1.5em;
			float: right;
		}

		.roomleft p {
			display: block;
			font-size: 1em;
			margin-top: 15px;
			text-align: justify;
		}

		.roomleft button {
			float: left;
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
			padding: 0;
		}

		.btn.btn-rounded {
			border-radius: 50px;
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

		.boxinfo1 ::-webkit-scrollbar {
			width: 7px;
			height: 10px;
		}

		.boxinfo1 ::-webkit-scrollbar-thumb {
			background: rgba(90, 90, 90);
			border-radius: 10px;
		}

		.boxinfo1 ::-webkit-scrollbar-track {
			background: rgba(0, 0, 0, 0);
		}

		#floatinglabel-checkinout {
			position: fixed;
			bottom: 0;
			width: 100vw;
			z-index: 2;
		}
	</style>
</head>

<body class="100vh">
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
		<div class="container">
			<a class="navbar-brand js-scroll-trigger" href="/"><?php echo $followingdata['companyName']; ?></a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
				data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
				aria-label="Toggle navigation">
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

	<?php
if($validCheckinOutDate) {
?>
	<div id="floatinglabel-checkinout" class="container-fluid">
		<div class="row d-flex justify-content-center">
			<div class="col-11 col-md-6">
				<div class="card text-white bg-white shadow-lg">
					<div class="card-body p-3">
						<div class="row">
							<div id="float-checkIn" class="col-12 col-sm-6 text-center text-black">
								<small class="text-muted d-block text-left">Check-in</small>
							</div>
							<div id="float-checkOut" class="col-12 col-sm-6 text-center text-black">
								<small class="text-muted d-block text-left">Check-out</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>
	<section id="rooms" class="content my-5 mx-0 mx-md-5" style="margin-bottom: 100px !important;">
	<h1>Available rooms</h1>
		<?php
			if(is_array($rooms) && true)
			foreach($rooms as $roomDetails){
				$tfedID = towtf($roomDetails['roomTypeID'], 3);
				$id = $roomDetails['roomTypeID'];
            ?>
		<div class="boxinfo1"
			style="height: 300px; background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?php print "'/public_assets/rooms/$id/$id-cover.jpg'"; ?>) left center / cover no-repeat;">
			<div class="roomright w-100 h-100">
				<div class="container h-100" id="titleContainer">
					<div class="row">
						<div class="col-sm-8">
							<h1><b><?php echo $roomDetails["name"]; ?></b></h1>
						</div>
						<div class="col-sm-4">
							<a href='/rooms/<?php echo $tfedID."/".$_GET['d']; ?>'><button type="button"
									class="btn btn-primary m-0">Book a
									Room</button></a>
						</div>
					</div>
					<p style="overflow-y: scroll; height: 175px;"><?php echo $roomDetails["desc"]; ?></p>
				</div>
			</div>
		</div>
		<?php
			}
			else
				echo "<br><br><h2 class='text-center m-5 p-5'>No Rooms Available</h3><br><br>";
		?>

		</div>
	</section>
	<?php
    $query = "SELECT socialFB, socialTwitter, socialInstagram, contact, email, footerRight
        FROM socialmedias, companyinfo";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $followingdata = $result->fetch_array(MYSQLI_ASSOC);
    ?>
	<div class="footer" style="overflow-x: hidden; padding-bottom: 125px;">
		<div class="row">
			<div class="col-lg-4 mx-auto">
				<p><b>Contact us</b></p>
				<p><?php echo $followingdata["contact"]; ?></p>
				<p><a href="mailto:<?php $followingdata["email"]; ?>"><?php echo $followingdata["email"]; ?></a></p>
			</div>
			<div class="col-lg-4 mx-auto">
				<p>Connect with us at</p>
				<a href="<?php echo $followingdata["socialFB"]; ?>" target="_blank"><button type="button"
						class="btn btn-social-icon btn-facebook btn-rounded"><i class="fa fa-facebook"></i></button></a>
				<a href="<?php echo $followingdata["socialInstagram"]; ?>" target="_blank"><button type="button"
						class="btn btn-social-icon btn-instagram btn-rounded"><i
							class="fa fa-instagram"></i></button></a>
				<a href="<?php echo $followingdata["socialTwitter"]; ?>" target="_blank"><button type="button"
						class="btn btn-social-icon btn-twitter btn-rounded"><i class="fa fa-twitter"></i></button></a>
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
	<!-- Moment -->
	<script src="/public_assets/modules/libraries/moment/moment.min.js"></script>


	<?php
if($validCheckinOutDate){
?>
	<script>
		$("#float-checkIn").append(moment('<?php print $date[0]; ?>').format('dddd, MMM D YYYY'));
		$("#float-checkOut").append(moment('<?php print $date[1]; ?>').format('dddd, MMM D YYYY'));
	</script>
	<?php
}
?>

</body>

</html>