<?php
include('db.php');

$query = "SELECT companyName FROM companyinfo";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$followingdata = $result->fetch_array(MYSQLI_ASSOC);

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title><?php echo $followingdata['companyName']; ?> | Booking Form</title>
	<link rel="icon" type="image/x-icon" href="" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/styles.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<link rel="stylesheet" type="text/css" href="/public_assets/modules/libraries/daterangepicker/daterangepicker.css" />
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/cupertino/jquery-ui.css">
	<script src="https://www.google.com/recaptcha/api.js"></script>
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

		h1 {
			padding-top: 2%;
			padding-bottom: 2%;
		}

		.bookForm {
			background-color: white;
			color: black;
			padding: 2%;
			margin: 5% auto;
			width: 70%;
			box-shadow: 0 0 5px 0 rgb(0 0 0 / 40%);
			border-radius: 5px;
		}

		a.return {
			text-align: left;
		}

		h2.title {
			text-align: center;
		}

		h3 {
			text-align: left;
		}

		table {
			width: 100%;
		}

		table input[type=text],
		input[type=email] {
			width: 100%;
			font-size: 1.25rem;
			outline-color: #999;
			border: #999;
			background-color: #E5E8E8;
			border-radius: 15px;
			text-align: center;
			margin: 0 auto;
			display: block;
		}

		select#nameRoom {
			width: 100%;
			font-size: 1.25rem;
			outline-color: #999;
			border: #999;
			background-color: #E5E8E8;
			border-radius: 15px;
			text-align: center;
			margin: 0 auto;
			display: block;
		}

		.loginForm {
			color: black;
			text-align: center;
			margin: 2% auto;
		}

		button#nextbutton {
			color: aqua !important;
		}

		input#emaillogin {
			border: none;
			background-color: #eee;
			color: #000;
			width: 75%;
			margin: auto;
			display: block;
			margin-bottom: 4%;
			padding: 10px;
			border-radius: 25px;
			outline: 0;
			padding-left: 15px;
			font-size: 1em;
			text-align: center;
		}

		input#emailsubmit {
			border: none;
			outline: 0;
			width: 35%;
			padding: 5px;
			font-size: .8em;
			border-radius: 25px;
			background-color: #2980B9;
			color: #fff;
			display: block;
			margin: auto;
			font-size: 1.2em;
		}

		input#emailsubmit:hover {
			box-shadow: 0 0 5px 1px rgb(0, 0, 0, 0.2), 0 0 2px 0 rgb(0, 0, 0, 0.5);
			background-color: #2471A3;
			transition: 0.3s;
			transform: scale(1.005);
		}

		select#rate {
			width: 100%;
			font-size: 1.25rem;
			vertical-align: top;
			outline-color: #999;
			border: #999;
			background-color: #E5E8E8;
			border-radius: 15px;
			padding: 1%;
		}

		select#ccmonth,
		#ccyear {
			width: 100%;
			font-size: 1.25rem;
			vertical-align: top;
			outline-color: #999;
			border: #999;
			background-color: #E5E8E8;
			border-radius: 15px;
			padding: 1%;
		}

		body.modal-open {
			overflow: scroll;
		}

		input#date {
			text-align: right;
		}

		::placeholder {
			color: #999;
			text-align: center;
		}

		img.mastercard {
			height: 80px;
			margin-right: 10%;
		}

		img.paypal {
			height: 80px;
			margin-right: 10%;
		}

		img {
			cursor: pointer;
		}

		div#mastercardDiv {
			float: right;
			width: 60%;
		}

		div#paypalDiv {
			float: right;
			width: 60%;
		}

		div#bankDiv {
			float: right;
			width: 60%;
		}

		.btn-primary {
			color: #fff;
			background-color: #3b7bbf;
			border-color: #3b7bbf;
		}

		.btn-primary:hover {
			color: #fff;
			background-color: #3b7bbf;
			border-color: #3b7bbf;
		}

		.footer {
			background-color: black;
			color: rgba(255, 255, 255, .8);
			padding: 1%;
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

		.dropdown-menu-center {
			right: auto;
			left: 50% !important;
			margin-top: 40px;
			-webkit-transform: translate(-50%, 0);
			-o-transform: translate(-50%, 0);
			transform: translate(-50%, 0%) !important;
		}

		div#ui-datepicker-div {
			color: #000000;
		}

		a.ui-state-default {
			color: #000000;
			background-color: #ffffff;
			;
		}
	</style>

	<title>Booking Details</title>
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
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Compare.html">Compare</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Rooms.php">Rooms</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Amenities.php">Amenities</a></li>
				</ul>
			</div>
		</div>
	</nav>
	
	<section id="bookForm">
		<div class="bookForm">
			<div class="row">
				<div class="col-lg-3 mx-auto">
					<a class="return" href="Customer-Room_Details_Imperial.html">
						< Back to Room</a>
				</div>
				<div class="col-lg-6 mx-auto">
					<h2 class="title"><b>Booking Details</b></h2>
					<hr>
					<br>
				</div>
				<div class="col-lg-3 mx-auto">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-10 mx-auto">
					<form action="Customer-Booking_Details.php" method="POST">
						<table class="tableOne">
							<tr>
								<td colspan="2">
									<h4><b>Check in & out date</b></h4>
								</td>
							</tr>
							<tr align="right">
								<th><label for="date">Check In Date:</label></th>
								<td>
									<div class="form-group">
										<input type="text" name="date_picker1" id="date_picker1" required>
									</div>
								</td>
							</tr>
							<tr align="right">
								<th><label for="date">Check Out Date:</label></th>
								<td>
									<div class="form-group">
										<input type="text" name="date_picker2" id="date_picker2" required>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<hr>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<h4><b>Reservation Details</b></h4>
								</td>
							</tr>

							<tr align="right" class="roomEntry">
								<th>Room:</th>
								<td><select id="nameRoom" name="roomName" name="pickRoom" onchange="selectRate()">
										<?php
										$query = "SELECT `name` FROM roomtype;";
										$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
										while ($row = mysqli_fetch_assoc($result)) {
										?>
											<option value="<?php echo $row["name"]; ?>"><?php echo $row["name"]; ?></option>
										<?php
										}
										?>
								</td>
							</tr>
							<tr align="right" class="roomEntryRate">
								<th><label>Price:</label></th>
								<td id="ans"></td>
							</tr>
							<tr align="right">
								<th></th>
								<td class="d-flex justify-content-center">
									<div class="btn-group">
										<button class="btn btn-default d-block m-2" style="padding: 5px;" data-toggle="dropdown">Add another room</button>
										<ul class="dropdown-menu dropdown-menu-center" style="width: max-content;">
											<div class="container" id="addRoomDiv">
												<?php
												$query = "SELECT * FROM roomtype;";
												$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
												while ($row = mysqli_fetch_assoc($result)) {
												?>
													<div class="row">
														<div class="col">
															<div class="d-flex justify-content-between">
																<a class="d-inline-block mr-2" href="javascript: void(0)">
																	<h5 class="m-0" style="line-height: 29.2px;"><?php echo $row["name"]; ?></h5>
																</a>
															</div>
														</div>
													</div>
												<?php
												}
												?>
											</div>
										</ul>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<hr>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<h4><b>Guest Information</b></h4>
								</td>
							</tr>
							<tr align="right">
								<th><label for="fname">First Name:</label></th>
								<?php
								if (isset($_POST['fname'])) {
									$firstname = $_POST['fname'];
									echo '<td><input id="fname" type="text" name="fname" placeholder="First Name" value="' . $firstname . '"></td>';
								} else {
									echo '<td><input id="fname" type="text" name="fname" placeholder="First Name" required></td>';
								}
								?>
							</tr>
							<tr align="right">
								<th><label for="lname">Last Name:</label></th>
								<?php
								if (isset($_POST['lname'])) {
									$lastname = $_POST['lname'];
									echo '<td><input id="lname" type="text" name="lname" placeholder="Last Name" value="' . $lastname . '"></td>';
								} else {
									echo '<td><input id="lname" type="text" name="lname" placeholder="Last Name" required></td>';
								}
								?>
							</tr>
							<tr align="right">
								<th><label for="cNumber">Contact Number:</label></th>
								<?php
								if (isset($_POST['cnumber'])) {
									$contact = $_POST['cnumber'];
									echo '<td><input id="cnumber" type="text" name="cnumber" placeholder="Contact Number" value="' . $contact . '"></td>';
								} else {
									echo '<td><input id="cnumber" type="text" name="cnumber" placeholder="Contact Number" required></td>';
								}
								?>
							</tr>
							<tr align="right">
								<th><label for="email">Email:</label></th>
								<?php
								if (isset($_POST['email'])) {
									$email = $_POST['email'];
									echo '<td><input id="email" type="email" name="email" placeholder="Email Address" value="' . $email . '"></td>';
								} else {
									echo '<td><input id="email" type="email" name="email" placeholder="Email Address" required></td>';
								}
								?>
							</tr>
							<tr>
								<td><br></td>
							</tr>
							<tr align="right">
								<td colspan="2">
									<div class="g-recaptcha" data-sitekey="6LeosxcdAAAAAJdlUOtkEsqLjbJIrOuty1YYu7OG"></div>
								</td>
							</tr>
							<tr>
								<td><br></td>
							</tr>
							<tr align="right">

								<td colspan="2"><button type="submit" name="submit" id="submit" class="btn btn-success">Proceed to Payment</button></td>
							</tr>
					</form>
					</table>
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
</body>


<!-- Scripts -->
<script src="js/addAnotherRoomToReserve.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- moment -->
<script src="/public_assets/modules/libraries/moment/moment.min.js"></script>
<script src="/public_assets/modules/libraries/moment/locales.js"></script>
<script src="/public_assets/modules/libraries/moment/moment-timezone.js"></script>

<!-- daterange -->
<script src="/public_assets/modules/libraries/daterangepicker/daterangepicker.js"></script>
<script>
	function selectRate() {
		var roomName = document.getElementById("nameRoom").value;
		$.ajax({
			url: "showETC.php",
			method: "POST",
			data: {
				id: roomName
			},
			success: function(data) {
				$("#ans").html(data);
			}
		})
	}
</script>
<script>
	$(document).ready(function() {
		var startDate;
		var endDate;
		$("#date_picker1").datepicker({
			dateFormat: 'dd-mm-yy',
			maxDate: '365',
			minDate: '+5'
		})
		$("#date_picker2").datepicker({
			dateFormat: 'dd-mm-yy',
			maxDate: '365',
			minDate: '+5'
		});
		$('#date_picker1').change(function() {
			startDate = $(this).datepicker('getDate');
			$("#date_picker1").datepicker("option", "minDate", startDate);
		})
		$('#date_picker2').change(function() {
			endDate = $(this).datepicker('getDate');
			$("#date_picker2").datepicker("option", "maxDate", endDate);
		})
	})
</script>

</html>