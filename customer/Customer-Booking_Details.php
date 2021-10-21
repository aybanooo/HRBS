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
if(isset($_POST['fname'])){ 
	$firstName = $_POST['fname'];
}
if(isset($_POST['lname'])){ 
	$lastName = $_POST['lname'];
}
if(isset($_POST['cnumber'])){ 
	$contact = $_POST['cnumber'];
}
if(isset($_POST['email'])){ 
	$email = $_POST['email'];
}
if(isset($_POST['roomName'])){ 
	$roomName = $_POST['roomName'];
}
if(isset($_POST['daterange'])){ 
	$daterange = $_POST['daterange'];
}

$split = explode('-', $daterange);
$count = count($split);
if($count <> 2){
  #invalid data
}

$start = $split[0];
$end = $split[1];



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
	input#total {
		border: none;
		background-color: transparent;
		outline: none;
		outline-width: 0;
		text-align: right;
		background-color: inherit;
		font-size: 3em;
		font-weight: bold;
		box-shadow: none;
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
	table input[type=text] {
		width:100%;
		font-size:1.25rem;
		outline-color:#999;
		border:#999;
		background-color:#E5E8E8;
		border-radius:15px;
		text-align: center;
		margin: 0 auto;
		display: block;
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
	table{
		table-layout: fixed;
		width: 70%;
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
    	padding: 0;
 	}
 	.btn.btn-info {
    	border-radius: 10px;
		background-color: #45b6fe;
		color: #ffffff;
		padding: 12px;
		box-shadow: 0 0.1875rem 0.1875rem;
		font-size: 80%;
 	}
	.btn.btn-success{
		border-radius: 10px;
		box-shadow: 0 0.1875rem 0.1875rem;
		font-size: 80%;
		text-transform: uppercase;
		letter-spacing: 0.15rem;
		border: 0;
		padding: 15px;
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
                	<a class="return" href = "Customer-Booking_Form.php">< Back to Booking Details</a>
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
					<div class="col-lg-12 mx-auto">
						<table align="center">
							<tr>
								<td><h3><b>Guest Information</b></h3><td>
							</tr>
							<tr align="right">
								<th>First Name:</th>
								<td><?php echo $firstName; ?></td>
							</tr>
							<tr align="right">
								<th>Last Name:</th>
								<td><?php echo $lastName; ?></td>
							</tr>
							<tr align="right">
								<th>Contact:</th>
								<td><?php echo $contact; ?></td>
							</tr>
							<tr align="right">
								<th>Email Address:</th>
								<td><?php echo $email; ?></td>
							</tr>
							<tr>
								<td colspan="2"><hr/></td>
							</tr>

							<tr> 
								<td><h3><b>Reservation Details</b></h3></td>
							</tr>
							<tr align="right">
								<th>Room:</th>
								<td><?php echo $roomName; ?></td>
							</tr>
							<tr align="right">
						<?php
							$query = "SELECT rate FROM roomtype WHERE `name`='$roomName'";
							$result=mysqli_query($conn, $query) or die(mysqli_error($conn));
							$followingdata = $result->fetch_array(MYSQLI_ASSOC);
							
							$vat = $followingdata['rate'] * 0.12;
							$serviceCharge = $followingdata['rate'] * 0.10; 
							$totalPriceWServiceCharge = $vat + $serviceCharge + $followingdata['rate'];

						?>
								<th>Rate:</th>
								<td><?php echo $followingdata['rate']; ?></td>
							</tr>
							<tr align="right">
								<th>Check-in Date:</th>
								<td><?php echo $start; ?></td>
							</tr>
							<tr align="right">
								<th>Check-out Date:</th>
								<td><?php echo $end; ?></td>
							</tr>
							<tr align="right">
								<th>Check-in Time:</th><!-- kukunin sa database -->
								<td>7:00 AM</td><!-- kukunin sa database -->
							</tr>
							<tr align="right">
								<th>Check-out Time:</th><!-- kukunin sa database -->
								<td>7:00 AM</td>
							</tr>                   
							<tr align="right">
								<td colspan="2"><hr/></td>
							</tr>
							<tr align="right">
								<td ><h3><b>Voucher</b></h3></td>	
							</tr>
							<tr align="right">
								<th><label for="code">Code:</label></th>
								<td><input class="form-control" type="text" id="coupon" name="coupon" placeholder="Code (Optional)"/></input></td>
							</tr >
							<tr align="right">
								<td ><input type="hidden" value="<?php echo number_format($totalPriceWServiceCharge,2,  '.', '' ); ?>" id="price" name="price"/><td>
							</tr>
							<tr align="right">
								<td colspan="2"><button class="btn btn-info" id="activate" >Apply Voucher</button></td>
							</tr>
							<form action="" method="POST">
								<tr>
									<td colspan="2"><hr></td>
								</tr>
								<tr>
									<td><h3><b>Payment</b></h3></td>
									<td></td>	
								</tr>
								<tr>
									<td colspan="2" align="right">
										<div id="paypal-button"></div>
									</td>
								</tr>
								<tr>
									<td colspan="2"><hr></td>
								</tr>
								<tr>
									<td><h3><b>Billing</b></h3></td>	
								</tr>
								<tr align="right">
									<td><b>Price Breakdown</b></td>
								</tr>
								
								<tr align="right">
									<td>Room Rate</td>
									<td><?php echo number_format($followingdata['rate'], 2,  '.', ','); ?></td>
								</tr>
								<tr align="right">
									<td>VAT (12%)</td>
									<td><?php echo number_format($vat, 2,  '.', ','); ?></td>
								</tr>
								<tr align="right">
									<td>Service Charge</td>
									<td><?php echo number_format($serviceCharge, 2,  '.', ','); ?></td>
								</tr>
								<tr align="right">
									<td>Voucher Discount</td>
									<td><div id="result"></div></td>
								</tr>
								<tr align="right">
									<td>Incidental Charges</td>
									<td></td>
								</tr>

						
								<tr align="right">
									<td colspan="2"><hr/></td>
								</tr>
								<tr>
									<td><h1><b>Total</b></h1></td>
								</tr>
								<tr align="right">
									<td colspan="2"><input class="form-control-plaintext" type="number" value="<?php echo number_format($totalPriceWServiceCharge,2,  '.', '' );?>" id="total" name="result" readonly="readonly" lang="en-150"/></td>
								</tr>
								<tr align="right">
									<td colspan="2"><input type="checkbox" class="form-check-input" id="exampleCheck1"><label class="form-check-label" for="exampleCheck1">I Understand the <a href="#">Terms and Agreement.</a></label></p></td>
								</tr>
								<tr align="right">
									<td colspan="2"><button type="button" class="btn btn-success">Book Now</button></td>
								</tr>
								</table>
						</div>
					</form>
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
<script>
	$(document).ready(function(){
		$('#activate').on('click', function(){
			var coupon = $('#coupon').val();
			var price = $('#price').val();
			if(coupon == ""){
				alert("Please enter a coupon code!");
			}else{
				$.post('voucher.php', {coupon: coupon, price: price}, function(data){
					if(data == "error"){
						alert("Invalid Coupon Code!");
						$('#total').html(price);
						$('#result').val('');
					} else {
						var json = JSON.parse(data);
						$('#result').html(+json.discount+"% Off");
						$('#total').val(json.price );
					}
				});
			}
		});
	});
	$('#btnClick').on('click',function(){
    if($('#1').css('display')!='none'){
    $('#2').html('Here is my dynamic content').show().siblings('div').hide();
    }else if($('#2').css('display')!='none'){
        $('#1').show().siblings('div').hide();
    }
});
</script>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
paypal.Button.render({
// Configure environment
env: 'sandbox',
client: {
sandbox: 'demo_sandbox_client_id',
production: 'demo_production_client_id'
},
// Customize button (optional)
locale: 'en_US',
style: {
size: 'small',
color: 'gold',
shape: 'pill',
},
// Set up a payment
payment: function (data, actions) {
return actions.payment.create({
transactions: [{
amount: {
total: '0.01',
currency: 'USD'
}
}]
});
},
// Execute the payment
onAuthorize: function (data, actions) {
return actions.payment.execute()
.then(function () {
// Show a confirmation message to the buyer
window.alert('Thank you for your purchase!');
});
}
}, '#paypal-button');
</script>
</html>

