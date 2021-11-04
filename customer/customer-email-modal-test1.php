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
    body {
    background-color: #eee
}

.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0rem rgba(0, 123, 255, .25)
}

.btn-secondary:focus {
    box-shadow: 0 0 0 0rem rgba(108, 117, 125, .5)
}

.close:focus {
    box-shadow: 0 0 0 0rem rgba(108, 117, 125, .5)
}

.mt-200 {
    margin-top: 200px
}
	</style>

	<title>Booking Details</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
		<div class="container">
			<a class="navbar-brand js-scroll-trigger" href="Customer-Home.html">The Grand Budapest</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Compare.html">Compare</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Rooms.html">Rooms</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Amenities.html">Amenities</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger active" href="Customer-Login.html">Login</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<?php
		include_once "connect.php";
	
 
<<<<<<< HEAD:customer/customer-email-modal-test1.php

	?>
	<!-- Modal Verify -->
	<link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard_theme_dots.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.smartWizard.min.js"></script>
<div class="container">
    <div class="row d-flex justify-content-center mt-200"> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Launch multistep Wizard </button> </div> <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Smart Wizard modal</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <div id="smartwizard">
                        <ul>
                            <li><a href="#step-1">Step 1<br /><small>Account Info</small></a></li>
                            <li><a href="#step-2">Step 2<br /><small>Personal Info</small></a></li>
                            <li><a href="#step-3">Step 3<br /><small>Payment Info</small></a></li>
                            <li><a href="#step-4">Step 4<br /><small>Confirm details</small></a></li>
                        </ul>
                        <div>
                            <div id="step-1">
                                <div class="row">
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Name" required> </div>
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Email" required> </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Password" required> </div>
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Repeat password" required> </div>
                                </div>
                            </div>
                            <div id="step-2">
                                <div class="row">
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Address" required> </div>
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="City" required> </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="State" required> </div>
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Country" required> </div>
                                </div>
                            </div>
                            <div id="step-3" class="">
                                <div class="row">
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Card Number" required> </div>
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Card Holder Name" required> </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="CVV" required> </div>
                                    <div class="col-md-6"> <input type="text" class="form-control" placeholder="Mobile Number" required> </div>
                                </div>
                            </div>
                            <div id="step-4" class="">
                                <div class="row">
                                    <div class="col-md-12"> <span>Thanks For submitting your details with BBBootstrap.com. we will send you a confirmation email. We will review your details and revert back.</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

=======

	?>
	<!-- Modal Verify -->
	<section id="modal">
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
			<div class="modal-dialog" role="document">
			  	<div class="modal-content">
					<div class="modal-header">
				  	<h4 class="modal-title" id="myModalLabel">Verify your Account</h4>
				
					</div>
					<!-- page 1 -->
					<div class="modal-body">
					<div class="modal-split">
						<div class="loginForm">
							<div class="col-lg-12 mx-auto">
								<h2><b>Verify </b></h2>
								<hr class="new1">
									<form method="POST" action="email-test-test.php">
										<tr>
											<td><input type = "text" name = "email" required placeholder = "Email Address" id="emaillogin"></td>	
										</tr>					
									</form>
							</div>
						</div>
					</div>
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

>>>>>>> benito/dev:customer/Customer-Booking_Form.php
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

</body>

<!-- Scripts -->

<script src="js/addAnotherRoomToReserve.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
<<<<<<< HEAD:customer/customer-email-modal-test1.php
    $(document).ready(function(){

$('#smartwizard').smartWizard({
selected: 0,
theme: 'dots',
autoAdjustHeight:true,
transitionEffect:'fade',
showStepURLhash: false,

});

});
</script>
<script>
=======
>>>>>>> benito/dev:customer/Customer-Booking_Form.php

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
<<<<<<< HEAD:customer/customer-email-modal-test1.php
        $('#exampleModal').modal('show');
=======
        $('#myModal').modal('show');
>>>>>>> benito/dev:customer/Customer-Booking_Form.php
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
					n_button.setAttribute("id","verifyBtn");
          			n_button.innerHTML = "Verify";

    	$(this).find('.modal-footer').append(b_button).append(n_button);

    	var page_track = 0;

    	$(n_button).click(function() {
			
        
        this.blur();
		/*<!-- page 1 -->*/
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
		/*<!-- page 2 -->*/
    	$(b_button).click(function() {

    		if(page_track == 1)
    		{
    			$(b_button).hide();
    		}

    		if(page_track == pages.length-1)
    		{
    			$(n_button).text("Verify");
    		}

    		if(page_track > 0)
    		{
    			page_track--;

    			pages.hide();
    			pages.eq(page_track).show();
    		}
    	});
  }
  });
}
</script>
<<<<<<< HEAD:customer/customer-email-modal-test1.php
<script>
    $(document).ready(function(){

$('#smartwizard').smartWizard({
selected: 0,
theme: 'dots',
autoAdjustHeight:true,
transitionEffect:'fade',
showStepURLhash: false,

});

});
</script>
=======
>>>>>>> benito/dev:customer/Customer-Booking_Form.php


</html>