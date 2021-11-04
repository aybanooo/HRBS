<<<<<<< HEAD
<?php
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
	$output->setFailed("Cannot connect to database." . $conn->connect_error);
	echo $output->getOutput(true);
	die();
}

$query = "SELECT companyName FROM companyInfo";
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
=======
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>The Grand Budapest | Booking Form</title>
    <link rel="icon" type="image/x-icon" href="" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/styles.css" rel="stylesheet"/>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">	
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<<<<<<<< HEAD:customer/Customer-Booking_Form.php

========
>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
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
	h1{
		padding-top: 2%;
		padding-bottom: 2%;
	}
	.bookForm{
		background-color: white;
		color: black;
		padding: 2%;
		margin: 5% auto;		
		width: 70%;
   		box-shadow: 0 0 5px 0 rgb(0 0 0 / 40%);
		border-radius: 5px;
	}
	a.return{
		text-align: left;
	}
	h2.title{
		text-align:center;
	}
	h3{
	    text-align: left;
	}
	table{
		width: 100%;
	}
	table input[type=text] {
		width:100%;
		font-size:1.25rem;
		vertical-align:top;
		outline-color:#999;
		border:#999;
		background-color:#E5E8E8;
		border-radius:15px;
	}
	.loginForm{
		color: black;
		text-align: center;
		margin: 2% auto;		
	}
	button#nextbutton {
		color: aqua !important;
	}
	input#emaillogin {
			border:none;
			background-color:#eee;
			color:#000;
			width:75%;
			margin:auto;
			display:block;
			margin-bottom:4%;
			padding:10px;
			border-radius:25px;
			outline:0;
			padding-left:15px;
			font-size:1em;
			text-align: center;
		}
	input#emailsubmit{
			border:none;
			outline:0;
			width:35%;
			padding:5px;
			font-size:.8em;
			border-radius:25px;
			background-color:#2980B9 ;
			color:#fff;
			display:block;
			margin:auto;
			font-size:1.2em;
	}
	input#emailsubmit:hover{
		box-shadow:0 0 5px 1px rgb(0,0,0,0.2),0 0 2px 0 rgb(0,0,0,0.5);
		background-color:#2471A3 ;
		transition:0.3s;
		transform:scale(1.005);
	}
<<<<<<<< HEAD:customer/Customer-Booking_Form.php

========
>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
	select#rate {
		width:100%;
		font-size:1.25rem;
		vertical-align:top;
		outline-color:#999;
		border:#999;
		background-color:#E5E8E8;
		border-radius:15px;
		padding: 1%;
	}
	select#ccmonth,#ccyear {
		width:100%;
		font-size:1.25rem;
		vertical-align:top;
		outline-color:#999;
		border:#999;
		background-color:#E5E8E8;
		border-radius:15px;
		padding: 1%;
	}
	body.modal-open { 
		overflow: scroll; 
	}

  body.modal-open { 
		overflow: scroll; 
	}


	input#date {
    	text-align: right;
	}
	::placeholder {
		color:#999;
		text-align: center;
	}
	img.mastercard{
		height: 80px;
		margin-right: 10%;
	}
	img.paypal{
		height: 80px;
		margin-right: 10%;
	}
	img{
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

	.btn-primary{
    	color: #fff;
    	background-color: #3b7bbf;
    	border-color: #3b7bbf;
	}
	.btn-primary:hover {
	  	color: #fff;
    	background-color: #3b7bbf;
    	border-color: #3b7bbf;
	}
	.footer{
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
	.dropdown-menu-center {
	    right: auto;
	    left: 50% !important;
		margin-top: 40px;
	    -webkit-transform: translate(-50%, 0);
	    -o-transform: translate(-50%, 0);
	    transform: translate(-50%, 0%) !important;
	}
>>>>>>> benito/dev
	</style>

	<title>Booking Details</title>
</head>
<<<<<<< HEAD

<body>
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
		<div class="container">
			<a class="navbar-brand js-scroll-trigger" href="Customer-Home.php"><?php echo $followingdata['companyName']; ?></a>
=======
<body>
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
		<div class="container">
			<a class="navbar-brand js-scroll-trigger" href="Customer-Home.html">The Grand Budapest</a>
>>>>>>> benito/dev
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Compare.html">Compare</a></li>
<<<<<<< HEAD
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Rooms.php">Rooms</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Amenities.php">Amenities</a></li>
=======
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Rooms.html">Rooms</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Amenities.html">Amenities</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger active" href="Customer-Login.html">Login</a></li>
>>>>>>> benito/dev
				</ul>
			</div>
		</div>
	</nav>
<<<<<<< HEAD

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
										<input type="text" name="date_picker1" id="date_picker1">
									</div>
								</td>
							</tr>
							<tr align="right">
								<th><label for="date">Check Out Date:</label></th>
								<td>
									<div class="form-group">
										<input type="text" name="date_picker2" id="date_picker2">
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
								<td colspan="2">
									<hr>
								</td>
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
        FROM socialMedias, companyInfo";
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
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
</body>

=======
<<<<<<<< HEAD:customer/Customer-Booking_Form.php
	<?php
		include_once "connect.php";
	
 

	?>
	<!-- Modal Verify -->
========
	<!-- Modal -->
>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
	<section id="modal">
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
			<div class="modal-dialog" role="document">
			  	<div class="modal-content">
					<div class="modal-header">
				  	<h4 class="modal-title" id="myModalLabel">Verify your Account</h4>
				
					</div>
<<<<<<<< HEAD:customer/Customer-Booking_Form.php
					<!-- page 1 -->
========
				
>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
					<div class="modal-body">
					<div class="modal-split">
						<div class="loginForm">
							<div class="col-lg-12 mx-auto">
<<<<<<<< HEAD:customer/Customer-Booking_Form.php
								<h2><b>Verify </b></h2>
								<hr class="new1">
									<form method="POST" action="email-test-test.php">
										<tr>
											<td><input type = "text" name = "email" required placeholder = "Email Address" id="emaillogin"></td>	
										</tr>					
========
								<h2><b>Login</b></h2>
								<hr class="new1">
									<form method="POST" action="">
										<tr>
											<td><input type = "text" name = "email" required placeholder = "Email Address/Phone Number" id="emaillogin"></td>	
										</tr>					
										<tr>
											<td class="sign" align = "center" align = "right"><input type = "submit" value = "Verify" name = "login" id="emailsubmit"></td>
										</tr>
>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
									</form>
							</div>
						</div>
					</div>
<<<<<<<< HEAD:customer/Customer-Booking_Form.php
					<!-- page 2 -->
					<div class="modal-split">
						<div class="loginform">
							<div class="col-lg-12 mx-auto">
								<h2 style="text-align: center;"><b>Verification Code Sent</b></h2>
									<hr class="new1">
										<tr>
											<div class="form-span" align="center"><span>The verification code has been sent to your email.</span></div>
										</tr>
										<br>
									<form>
										<tr>
											<td><input type = "text" name = "authentication" required placeholder = "Authentication Code" id="code"></td>	
										</tr>					
========
					
					<div class="modal-split">
						<div class="loginform">
							<div class="col-lg-12 mx-auto">
								<h2 style="text-align: center;"><b>Verification Sent</b></h2>
									<hr class="new1">
									<form>
										<tr>
											<div class="form-span" align="center"><span>The verification code is sent to y our email.</span></div>
										</tr>
										<br>
										<tr>
											<td><input type = "text" name = "authentication" required placeholder = "Authentication Code" id="emaillogin"></td>	
										</tr>					
										<tr>
											<td class="sign" align = "center" align = "right"><a href="confirmed"><input type="submit" formaction="Customer-Email_Confirmed.html" value = "Submit" id="emailsubmit"></a></td>
										</tr>
>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
									</form>
							</div>
						</div>
					</div>
<<<<<<<< HEAD:customer/Customer-Booking_Form.php

			
					</div>
		  
					<div class="modal-footer">
			
					</div>
				</div>
			</div>
		</div>
	</section>

========
					<div class="modal-split">
						<div class="loginform">
							<div class="col-lg-12 mx-auto">
								<h2 style="text-align: center;"><b>Account Verified</b></h2>
									<hr class="new1">
									<form>
										<tr>
											<div class="form-span" align="center"><span>You may now book your preferred room.</span></div>
										</tr>

									</form>
							</div>
						</div>
					</div>
			
					</div>
		  
					<div class="modal-footer">
			
					</div>
				</div>
			</div>
		</div>
	</section>
>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
	<section id="bookForm">
		<div class="bookForm">
			<div class="row">
                <div class="col-lg-3 mx-auto">
                	<a class="return" href = "Customer-Room_Details_Imperial.html">< Back to Room</a>
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
            		<table class="tableOne">
	            		<tr>
							<td colspan="2"><h4><b>Check in & out date</b></h4></td>
						</tr>
	            		<tr align="right">
							<th><label for="date">Date:</label></th>
								<td>
									<span><input type="text" name="datetimes" id="date"></span>
									<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
									<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
									<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
									<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<<<<<<<< HEAD:customer/Customer-Booking_Form.php

========
								
>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
								</td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>

	            		<tr>
							<td colspan="2"><h4><b>Reservation Details</b></h4></td>
						</tr>
						<tr align="right" class="roomEntry">
							<th>Room:</th>
							<td>Imperial Suite</td>
						</tr>
						<tr align="right" class="roomEntryRate">
							<th><label for="rate">Rate:</label></th>
							<td>
								<select name="rate" id="rate">
									<option value="rate1">Rate #1</option>
									<option value="rate2">Rate #2</option>
									<option value="rate3">Rate #3</option>
								</select>
							</td>
						</tr>
						<tr align="right" >	
							<th></th>
							<td class="d-flex justify-content-center">
								<div class="btn-group">
									<button class="btn btn-default d-block m-2" style="padding: 5px;" data-toggle="dropdown">Add another room</button>
									<ul class="dropdown-menu dropdown-menu-center" style="width: max-content;">
										<div class="container" id="addRoomDiv">
											<div class="row">
												<div class="col">
													<div class="d-flex justify-content-between">
														<a class="d-inline-block mr-2" href="javascript: void(0)"><h5 class="m-0" style="line-height: 29.2px;">Imperial Suite</h5></a>
														<button class="btn btn-default" style="padding: 5px; box-shadow: none !important; border: 1px solid gray;">View</button>
													</div>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col">
													<div class="d-flex justify-content-between">
														<a class="d-inline-block mr-2" href="javascript: void(0)"><h5 class="m-0" style="line-height: 29.2px;">Peninsula Suite</h5></a>
														<button class="btn btn-default" style="padding: 5px; box-shadow: none !important; border: 1px solid gray;">View</button>
													</div>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col">
													<div class="d-flex justify-content-between">
														<a class="d-inline-block mr-2" href="javascript: void(0)"><h5 class="m-0" style="line-height: 29.2px;">Royal Penthouse</h5></a>
														<button class="btn btn-default" style="padding: 5px; box-shadow: none !important; border: 1px solid gray;">View</button>
													</div>
												</div>
											</div>
										</div>
									</ul>
								  </div>

							</td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td colspan="2"><h4><b>Guest Information</b></h4></td>	
						</tr>
						<tr align="right">
							<th><label for="fname">First Name:</label></th>
							<td><input id="name" type="text" placeholder="First Name"></td>
						</tr>
						<tr align="right">
							<th><label for="lname">Last Name:</label></th>
							<td><input id="name" type="text" placeholder="Last Name"></td>
						</tr>
						<tr align="right">
							<th><label for="cNumber">Contact Number:</label></th>
							<td><input id="name" type="text" placeholder="Contact Number"></td>
						</tr>
						<tr align="right">
							<th><label for="email">Email:</label></th>
							<td>juandelacruz@yahoo.com</td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
            			<tr>
							<td colspan="2"><h3><b>Voucher</b></h3></td>	
						</tr>
						<tr align="right">
							<th><label for="code">Code:</label></th>
							<td><input type="text" name="voucher" id="code" placeholder="Voucher Code" required></input></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td><h4><b>Payment</b></h4></td>	
						</tr>
						<tr>
							<form>
								<td colspan="2">
									<input type="radio" name="card" id="masterCard" value="1" checked>
							    	<label for="masterCard">Mastercard</label>

							    	<input type="radio" name="card" id="paypal" value="2">
							    	<label for="paypal">Paypal</label>

							    	<input type="radio" name="card" id="bank" value="3">
							    	<label for="bank">Bank Transfer</label>

							    	<div id="mastercardDiv">
							        	<div class="form-group">
						                	<label for="name">Name</label>
						                	<input id="name" type="text" placeholder="Enter your name">
						            	</div>
						            	<div class="form-group">
						                    <label for="ccnumber">Credit Card Number</label>
						                    <div class="input-group">
						                        <input  type="text" placeholder="0000 0000 0000 0000" autocomplete="email">
						                        <div class="input-group-append">
						                       
						                        </div>
						                    </div>
						                </div>
						                <div class="row">
						                <div class="form-group col-sm-4">
						                    <label for="ccmonth">Month</label>
						                    <select id="ccmonth">
						                        <option>1</option>
						                        <option>2</option>
						                        <option>3</option>
						                        <option>4</option>
						                        <option>5</option>
						                        <option>6</option>
						                        <option>7</option>
						                        <option>8</option>
						                        <option>9</option>
						                        <option>10</option>
						                        <option>11</option>
						                        <option>12</option>
						                    </select>
						                </div>
						                <div class="form-group col-sm-4">
						                    <label for="ccyear">Year</label>
						                    <select id="ccyear">
						                        <option>2021</option>
						                        <option>2022</option>
						                        <option>2023</option>
						                        <option>2024</option>
						                        <option>2025</option>
						                        <option>2026</option>
						                        <option>2027</option>
						                        <option>2028</option>
						                        <option>2029</option>
						                    </select>
						                </div>
						                <div class="col-sm-4">
						                    <div class="form-group">
						                        <label for="cvv" data-toggle="tooltip" title="Three digit CV code on the back of your card">CVV/CVC <i class="fa fa-question-circle d-inline"></i></label>
	                                            <input type="text" required  placeholder="123" id="cvv">
						                    </div>
						                </div>
							    	</div>
							    </div>
							    <div class="d-none" id="paypalDiv">
							        		<p><button type="button" class="btn btn-primary "><i class="fab fa-paypal mr-2"></i> Log into my PayPal</button></p>
						               	 	<p class="text-muted"> Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
							    </div>
							    <div class="d-none" id="bankDiv">
						               	 	<p>Make your payment directly into our bank account. <br/> Please use your <b>Booking/Reservation ID </b> as the payment Reference. You can send us the payment receipt for faster transaction.<br/> <b>BDO Account no: 0000 0000 0000 0000</b></p>
							    </div>
								</td>	
							</form>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td><h4><b>Billing</b></h4></td>	
						</tr>
						<tr align="right">
							<td><b>Price Breakdown</b></td>
						</tr>
						<tr align="right">
							<td>Room Rate</td>
							<td>5, 000.00</td>
						</tr>
						<tr align="right">
							<td>VAT (12%)</td>
							<td>600.00</td>
						</tr>
						<tr align="right">
							<td>Service Charge</td>
							<td>452.00</td>
						</tr>
						<tr align="right">
							<td>Incidental Charges</td>
							<td>1, 231.00</td>
						</tr>
						<tr align="right">
							<td><h2><b>TOTAL</b></h2></td>
							<td><h2><b>P7, 283.00</b></h2></td>
						</tr>
						<tr align="right">
							<td colspan="2"><a href="Customer-Booking_Details.html"><button type="button" class="btn btn-success">Finalize Booking</button></a></td>
<<<<<<<< HEAD:customer/Customer-Booking_Form.php

========
>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
						</tr>
					</table>
            	</div>
			</div>
		</div>
	</section>
	
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<p><b>Contact us</b></p>
					<p>09051234564</p>
					<p>thegrandbudepest@gmail.com</p>
				</div>
				<div class="col-sm">
					<p>Connect with us at</p>
					<button type="button" class="btn btn-social-icon btn-facebook btn-rounded"><i class="fa fa-facebook"></i></button> 
					<button type="button" class="btn btn-social-icon btn-instagram btn-rounded"><i class="fa fa-instagram"></i></button>
					<button type="button" class="btn btn-social-icon btn-twitter btn-rounded"><i class="fa fa-twitter"></i></button>
				</div>
				<div class="col-sm">
					<p>	®2014-2018 The Grand Budapest </p>
					<p>All Rights Reserved</p>
				</div>
			</div>
		</div>
	</div>
<<<<<<<< HEAD:customer/Customer-Booking_Form.php

========
>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
</body>
>>>>>>> benito/dev

<!-- Scripts -->
<script src="js/addAnotherRoomToReserve.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<<<<<<< HEAD
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
=======
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
<<<<<<<< HEAD:customer/Customer-Booking_Form.php

========
>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
	$(`input[type="radio"][name="card"]`).on('click', function() {
		if($(this).val()==1) {
			$('#mastercardDiv').removeClass('d-none');
			$('#paypalDiv').removeClass('d-none').addClass('d-none');
			$('#bankDiv').removeClass('d-none').addClass('d-none');
			
		}
		else if ($(this).val()==2){
			$('#paypalDiv').removeClass('d-none');
			$('#mastercardDiv').removeClass('d-none').addClass('d-none');
			$('#bankDiv').removeClass('d-none').addClass('d-none');
		}
		else{
			$('#bankDiv').removeClass('d-none');
			$('#mastercardDiv').removeClass('d-none').addClass('d-none');
			$('#paypalDiv').removeClass('d-none').addClass('d-none');eee
		}
	})
</script>
<script>    
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
</script>
<script>
	$(function() {
		$('input[name="datetimes"]').daterangepicker({
		timePicker: true,
		startDate: moment().startOf('hour'),
		endDate: moment().startOf('hour').add(32, 'hour'),
		locale: {
			format: 'M/DD A'
		}
		});
	});
</script>
<script>
	$(document).ready(function() {
  prep_modal();
});

function prep_modal()
{
  $(".modal").each(function() {

  var element = this;
	var pages = $(this).find('.modal-split');

  if (pages.length != 0)
  {
    	pages.hide();
    	pages.eq(0).show();

    	var b_button = document.createElement("button");
                b_button.setAttribute("type","button");
          			b_button.setAttribute("class","btn btn-primary");
          			b_button.setAttribute("style","display: none;");
          			b_button.innerHTML = "Back";

    	var n_button = document.createElement("button");
                n_button.setAttribute("type","button");
          			n_button.setAttribute("class","btn btn-primary");
<<<<<<<< HEAD:customer/Customer-Booking_Form.php
					n_button.setAttribute("id","verifyBtn");
          			n_button.innerHTML = "Verify";

    	$(this).find('.modal-footer').append(b_button).append(n_button);

    	var page_track = 0;

    	$(n_button).click(function() {
			
        
        this.blur();
		/*<!-- page 1 -->*/
========
					n_button.setAttribute("id","nextbutton");
          			n_button.innerHTML = "Next";

    	$(this).find('.modal-footer').append(b_button).append(n_button);


    	var page_track = 0;

    	$(n_button).click(function() {
        
        this.blur();

>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
    		if(page_track == 0)
    		{
    			$(b_button).show();
    		}

    		if(page_track == pages.length-2)
    		{
    			$(n_button).text("Submit");
    		}

        if(page_track == pages.length-1)
        {
          $(element).find("form").submit();
        }

    		if(page_track < pages.length-1)
    		{
    			page_track++;

    			pages.hide();
    			pages.eq(page_track).show();
    		}


    	});
<<<<<<<< HEAD:customer/Customer-Booking_Form.php
		/*<!-- page 2 -->*/
========

>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
    	$(b_button).click(function() {

    		if(page_track == 1)
    		{
    			$(b_button).hide();
    		}

    		if(page_track == pages.length-1)
    		{
<<<<<<<< HEAD:customer/Customer-Booking_Form.php
    			$(n_button).text("Verify");
========
    			$(n_button).text("Next");
>>>>>>>> benito/dev:customer/Customer-Booking_Form.html
    		}

    		if(page_track > 0)
    		{
    			page_track--;

    			pages.hide();
    			pages.eq(page_track).show();
    		}
<<<<<<<< HEAD:customer/Customer-Booking_Form.php
    	});
  }
  });
}
</script>

========


    	});

  }
>>>>>>>> benito/dev:customer/Customer-Booking_Form.html

  });
}
>>>>>>> benito/dev
</script>
</html>