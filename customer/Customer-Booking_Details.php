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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $followingdata['companyName']; ?> | Booking Form</title>
    <link rel="icon" type="image/x-icon" href="" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/styles.css" rel="stylesheet"/>

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
	.finalForm{
		background-color: white;
		color: black;
		padding: 2%;
		margin: 5% auto;		
		width: 70%;
	box-shadow:0 0 5px 0 rgba(0,0,0,0.4);
		border-radius: 5px;
	}
	p{
		margin-left: 5%;
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
	p.text-muted{
		height: 500px;
		overflow: auto;
		background-color: #f3f3f3;
		border: 1px solid #d3d3d3;
		padding: 2%;
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
    	color: #ffffff;
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
	<title>Finalize Booking</title>
</head>
<body>	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<script>
	$(document).ready(function(){
    	$("#myModal").on("show.bs.modal", function(event){
        	// Place the returned HTML into the selected element
        	$(this).find(".modal-body").load("/examples/php/remote.php");
    	});
	});
	</script>

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

   <section id="finalForm">
		<div class="finalForm">
			<div class="row">
                <div class="col-lg-3 mx-auto">
                	<a class="return" href = "Customer-Booking_Form.html">< Back to Booking Details</a>
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
					<div class="col-lg-6 mx-auto">
						<h3><b>Guest Information</b></h3>
						<p><b>First Name:</b> Juan<br/>
						<b>Last Name:</b> Dela Cruz<br/>
						<b>Contact Number:</b> 09064123916<br/>
						<b>Email:</b> delacruz.juan@yahoo.com</p>	    
						<hr/>
						<h3><b>Reservation Details</b></h3>
						<p><b>Reservation No.:</b> 201648451<br/>
						<b>Room:</b> Imperial Suite<br/>
						<b>Rate:</b> P 5,000.00/day - Regular Rate<br/>
						<b>Check-in Date:</b> September 20 <br/>
						<b>Check-out Date:</b> September 24 <br/>
						<b>Check-in Time:</b> 7:00 AM <br/>
						<b>Check-out Time:</b> 7:00 AM <br/>
						<b>Length of Stay:</b> 4 Days </p>
						
                        <table>
                        <tr>
							<td colspan="2"><hr/></td>
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
							
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<!--<tr>
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
						</tr>-->




                        </table>
					</div>
					<div class="col-lg-6 mx-auto">
						<h1><b>Total</b></h1>
							<h1><b>P 7, 283.00</b></h1>
							<p><input type="checkbox" class="form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">I Understand the <a href="#">Terms and Agreement.</a></label></p>
							<a href="Customer-Booking_Done.html"><button type="button" class="btn btn-success">Book Now</button></a>
					</div>
				</div>
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
</body>
</html>