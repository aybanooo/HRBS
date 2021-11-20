<?php
include('db.php');

require_once(dirname(__FILE__, 2) . "/public_assets/modules/php/directories/directories.php");

$query = "SELECT companyName FROM companyinfo";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$followingdata = $result->fetch_array(MYSQLI_ASSOC);

// Checks if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	function post_captcha($user_response)
	{
		$fields_string = '';
		$fields = array(
			'secret' => parse_ini_file(__CONF_PRIVATE__)['RECAPTCHA_SECRET'],
			'response' => $user_response
		);
		foreach ($fields as $key => $value)
			$fields_string .= $key . '=' . $value . '&';
		$fields_string = rtrim($fields_string, '&');

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

		$result = curl_exec($ch);
		curl_close($ch);

		return json_decode($result, true);
	}

	// Call the function post_captcha
	$res = post_captcha($_POST['g-recaptcha-response']);

	if (!$res['success']) {
		// What happens when the CAPTCHA wasn't checked
		echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
	} else {
		// If CAPTCHA is successfully completed...

		$firstName = mysqli_real_escape_string($conn, $_POST['fname']);
		$lastName = mysqli_real_escape_string($conn, $_POST['lname']);
		$contact = mysqli_real_escape_string($conn, $_POST['cnumber']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$roomName = mysqli_real_escape_string($conn, $_POST['roomName']);
		$dateStart = mysqli_real_escape_string($conn, $_POST['from']);
		$dateEnd = mysqli_real_escape_string($conn, $_POST['to']);

		$var1 = strtr($dateStart, '/', '-');
		$dateStartFinal = date("Y-m-d", strtotime($var1));

		$var2 = strtr($dateEnd, '/', '-');
		$dateEndFinal = date("Y-m-d", strtotime($var2));

		$date1 = date_create($dateStartFinal);
		$date2 = date_create($dateEndFinal);
		$diff = date_diff($date1, $date2);
		$days = $diff->format("%a");

		$customerQuery = "INSERT INTO customer (fname, lname, contact, email, verified, verification) VALUES ('$firstName', '$lastName', '$contact', '$email', 'None', 'None') LIMIT 1;";
		mysqli_query($conn, $customerQuery) or die(mysqli_error($conn));

		$customerID = mysqli_insert_id($conn);

		$customerQuery1 = ("INSERT INTO reservation 
	( roomNo, customerID, numberOfNightstay, adults, children, checkInDate, checkOutDate, checkInTime, checkOutTime, dateCreated) 
	VALUES ('0', $customerID, '$days', 'none', 'none' ,'$dateStartFinal', '$dateEndFinal', NULL, NULL, NOW()) LIMIT 1;");

		mysqli_query($conn, $customerQuery1) or die(mysqli_error($conn));
	}
} else {
	die("PLEASE FINISH THE CAPTCHA");
}

?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<?php
	require_once(dirname(__FILE__, 2) . "/public_assets/modules/php/directories/directories.php");
	include_once(__D_UI__ . "js/analytics.php");
	?>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title><?php echo $followingdata['companyName']; ?> | Booking Form</title>
	<link rel="icon" type="image/x-icon" href="" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

		.finalForm {
			background-color: white;
			color: black;
			padding: 2%;
			margin: 5% auto;
			width: 70%;
			box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.4);
			border-radius: 5px;
		}

		table input[type=text] {
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

		p {
			margin-left: 5%;
		}

		a.return {
			text-align: left;
		}

		h2.title {
			text-align: center;
		}

		table {
			table-layout: fixed;
			width: 70%;
		}

		h3 {
			text-align: left;
		}

		p.text-muted {
			height: 500px;
			overflow: auto;
			background-color: #f3f3f3;
			border: 1px solid #d3d3d3;
			padding: 2%;
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
			padding: 0;
		}

		button#activate {
			border-radius: 10px;
			background-color: #45b6fe;
			color: #ffffff;
			padding: 12px;
			box-shadow: 0 0.1875rem 0.1875rem;
			font-size: 80%;
		}

		button#buttonbooknow {
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
	<title>Finalize Booking</title>
</head>

<body>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

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

	<section id="finalForm">
		<div class="finalForm">
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalCenterTitle">Payment</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<h6>Mode of Payment</h6>
							<div id="paypal-button-container"></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 mx-auto">
					<a class="return" href="Customer-Booking_Form.php">
						< Back to Booking Details</a>
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
							<td>
								<h3><b>Guest Information</b></h3>
							<td>
						</tr>
						<tr align="right">
							<th>First Name:</th>
							<td><?php echo htmlspecialchars($firstName); ?></td>
						</tr>
						<tr align="right">
							<th>Last Name:</th>
							<td><?php echo htmlspecialchars($lastName); ?></td>
						</tr>
						<tr align="right">
							<th>Contact:</th>
							<td><?php echo htmlspecialchars($contact); ?></td>
						</tr>
						<tr align="right">
							<th>Email Address:</th>
							<td><?php echo htmlspecialchars($email); ?></td>
						</tr>
						<tr>
							<td colspan="2">
								<hr />
							</td>
						</tr>

						<tr>
							<td>
								<h3><b>Reservation Details</b></h3>
							</td>
						</tr>
						<tr align="right">
							<th>Room:</th>
							<td id="roomName"><?php echo $roomName; ?></td>
						</tr>
						<tr align="right">
							<?php
							$query = "SELECT * FROM roomtype WHERE `name`='$roomName'";
							$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
							$followingdata = $result->fetch_array(MYSQLI_ASSOC);
							$totalPersons = $followingdata['maxAdult'] + $followingdata['maxChildren'];
							$seniorCitizen = isset($_POST['seniorcitizen']) ? $_POST['seniorcitizen'] : "";
							#Fetch Vat tac and service charge !!! GETS GETS HAHAHA gawin muna variable
							$queryTax = "SELECT * FROM `settings` WHERE `name` in ('tax', 'serviceCharge');";
							$result = mysqli_query($conn, $queryTax) or die(mysqli_error($conn));
							$tempSettings = mysqli_fetch_all($result, MYSQLI_ASSOC);
							$followingdatatax = $result->fetch_array(MYSQLI_ASSOC);
							$taxserviceCharge = $tempSettings[0]['value'];
							$tax = $tempSettings[1]['value'];
							unset($tempSettings);

							if ($seniorCitizen == 1 || $seniorCitizen == 2) {
								$totalRoomRate = $days * $followingdata['rate'];
								$vat = $totalRoomRate * ($tax / 100);
								$serviceCharge =  $totalRoomRate *  ($taxserviceCharge / 100);
								$totalPrice = $vat + $serviceCharge + $totalRoomRate;
								//senior discount computation
								$dividedRate =  $totalRoomRate / $totalPersons;
								$RateofVat =  $dividedRate * ($tax / 100);
								$rateMinusVat = $dividedRate - $RateofVat;
								$rateDiscount = $rateMinusVat * 0.2;
								$rateDiscounted = $rateMinusVat - $rateDiscount;
								$totalDiscount = $dividedRate - $rateDiscounted;
								$totalPriceWithDiscount = $totalPrice - $totalDiscount;
							} else {
								$totalRoomRate = $days * $followingdata['rate'];
								$vat = $totalRoomRate * ($tax / 100);
								$serviceCharge =  $totalRoomRate * ($taxserviceCharge / 100);
								$totalPriceNoDiscount = $vat + $serviceCharge + $totalRoomRate;
							}
							?>
							<th>Rate:</th>
							<td><?php echo number_format($followingdata['rate'], 2,  '.', ','); ?></td>
						</tr>
						<tr align="right">
							<th>Check-in Date:</th>
							<td><?php echo htmlspecialchars($dateStart); ?></td>
						</tr>
						<tr align="right">
							<th>Check-out Date:</th>
							<td><?php echo htmlspecialchars($dateEnd);  ?></td>
						</tr>
						<tr align="right">
							<th>Length of Stay:</th>
							<td><?php echo $days . " night/s"; ?></td>
						</tr>
						<tr align="right">
							<th>Check-in Time:</th><!-- kukunin sa database -->
							<td>7:00 AM</td><!-- kukunin sa database -->
						</tr>
						<tr align="right">
							<th>Check-out Time:</th><!-- kukunin sa database -->
							<td>7:00 AM</td><!-- kukunin sa database -->
						</tr>
						<tr align="right">
							<th>No of Adults:</th>
							<td><?php echo $followingdata['maxAdult']; ?></td>
						</tr>
						<tr align="right">
							<th>No of Childrens:</th>
							<td><?php echo $followingdata['maxChildren']; ?></td>
						</tr>
						<tr align="right">
							<td colspan="2">
								<hr />
							</td>
						</tr>
						<tr align="right">
							<td>
								<h3><b>Voucher</b></h3>
							</td>
						</tr>
						<tr align="right">
							<th><label for="code">Code:</label></th>
							<td><input class="form-control" type="text" id="coupon" name="coupon" placeholder="Code (Optional)" /></input></td>
						</tr>
						<tr align="right">
							<td><input type="hidden" value="
							<?php if ($seniorCitizen == 1 || $seniorCitizen == 2) {
								echo number_format($totalPriceWithDiscount, 2, '.', '');
							} else {
								echo number_format($totalPriceNoDiscount, 2, '.', '');
							} ?>" id="price" name="price" />
							<td>
						</tr>
						<tr align="right">
							<td colspan="2"><button class="btn btn-info" id="activate">Apply Voucher</button></td>
						</tr>
						<form action="" method="POST">
							<tr>
								<td colspan="2">
									<hr>
								</td>
							</tr>
							<tr>
								<td>
									<h3><b>Billing</b></h3>
								</td>
							</tr>
							<tr align="right">
								<td><b>Price Breakdown</b></td>
							</tr>

							<tr align="right">
								<td>Room Rate</td>
								<td><?php echo number_format($totalRoomRate, 2,  '.', ','); ?></td>
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
								<td>
									<div id="result"></div>
								</td>
							</tr>
							<tr align="right">
								<td>Senior Citizen/PWD Discount</td>
								<td><?php if ($seniorCitizen == 1 || $seniorCitizen == 2) {
										echo number_format($totalDiscount, 2, '.', '');
									} ?> </td>
							</tr>
							<tr align="right">
								<td colspan="2">
									<hr />
								</td>
							</tr>
							<tr>
								<td>
									<h1><b>Total</b></h1>
								</td>
							</tr>
							<tr align="right">
								<td colspan="2"><input class="form-control-plaintext" type="number" value="<?php if ($seniorCitizen == 1 || $seniorCitizen == 2) {
																												echo number_format($totalPriceWithDiscount, 2, '.', '');
																											} else {
																												echo number_format($totalPriceNoDiscount, 2, '.', '');
																											} ?>" id="total" readonly="readonly" lang="en-150" /></td>
							</tr>
							<tr align="right">
								<td colspan="2">
									<div class="form-check">
										<input type="checkbox" onchange="document.getElementById('buttonbooknow').disabled = !this.checked" required class="form-check-input" id="agree" required>
										<label for="agree">I understand the<a href="#" class="fst-italic link-primary" data-bs-toggle="modal" data-bs-target="#agreeModal"> terms and agreements</a></label>
									</div>
								</td>
							</tr>
							<tr align="right">
								<td colspan="2"><button id="buttonbooknow" type="button" class="btn btn-success" disabled data-toggle="modal" data-target="#exampleModalCenter">Book Now</button></td>
							</tr>
					</table>
				</div>
				</form>
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

	<div class="modal fade" id="agreeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-center">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<pre>The following regulations must be observed to ensure that this Hotel has publicness (is accepted by the public) and provides a safe and comfortable stay for guests: Failure to follow these rules may result in the cancellation of your stay and/or denial to use the hotel services.
				Furthermore, if you damage any hotel equipment or fixtures, the Hotel maintains the right to charge you the full cost of the damage.
				Rules
				1.	Without permission, do not use the guest rooms for anything other than what they were intended for.
				2.	For heating or cooking, do not light a fire in the passage or guest rooms.
				3.	To prevent fire, refrain from smoking on bed, in non-smoking rooms, and in any other places prone to catch fire.
				4.	The equipment and articles in guest rooms are strictly meant for the guests staying in the Hotel. Hence, inside the guest rooms, use of such equipment and articles by outsiders is prohibited.
				5.	Be careful not to move the articles in the Hotel or guest rooms from their fixed places without permission.
				6.	Do not change the position of the gadgets and fixtures in the Hotel or guest rooms without permission.
				7.	Do not bring the following inside the hotel premises:
				a Animals, birds, etc.
				b Things giving off foul smell
				c Articles exceeding the normal amount that can be carried into a hotel
				d Guns, swords, etc.
				e Explosives, or articles containing volatile oils that may ignite or catch fire
				f Any other articles that may pose a threat to the safety of other guests staying in the Hotel
				8.	Do not scream, sing loudly, or create loud noises by any other actions inside the Hotel or guest rooms, as it may disturb or annoy other guests staying in the Hotel.
				9.	Refrain from engaging into gambling or acts that violate public order and morals inside the Hotel or guest rooms.
				10.	Do not distribute advertisement goods or sell articles to the other guests or collect donation or signatures from them inside the Hotel premises, without proper permission.
				11.	Note that we may refuse stay to patients suffering from an illness that may cause discomfort of any kind to the other guests inside the Hotel.
				12.	Do not leave your personal belongings in the passages or the lobby.
				13.	Any acts of photography that may bother the other guests in the Hotel are strictly prohibited inside the Hotel or guest rooms.
				14.	Any personal meetings should be held in the 1st floor lobby only.
				15.	In principle, the guest rooms accommodating same guests continuously for two or more nights shall not be cleaned during their period of stay. Such rooms, however, shall be cleaned once in six days to maintain cleanliness. Further, if cleaning of one or more of the guest rooms is deemed necessary by the hotel authorities, the guests occupying the room(s) shall not have a right to deny such room cleaning.

				</pre>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

</body>
<script>
	$(document).ready(function() {
		$('#activate').on('click', function() {
			var coupon = $('#coupon').val();
			var price = $('#price').val();
			if (coupon == "") {
				alert("Please enter a coupon code!");
			} else {
				$.post('voucher.php', {
					coupon: coupon,
					price: price
				}, function(data) {
					if (data == "error") {
						alert("Invalid Coupon Code!");
						$('#total').html(price);
						$('#result').val('');
					} else {
						var json = JSON.parse(data);
						$('#result').val(Math.round(parseFloat(json.value)));
						$('#total').val(Math.round((parseFloat(json.price)) * 100) / 100);
					}
				});
			}
		});
	});
</script>
<script src="https://www.paypal.com/sdk/js?client-id=AVFvFuUKXMeSAJRgomChw5y-GVxtgyRGm2jAOBo5eVtGfd3mXa28RUQ7Niq6ae1mHhzI5LxvyP4zKH_e&currency=PHP"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
	paypal.Buttons({
		createOrder: function(data, actions) {
			return actions.order.create({
				purchase_units: [{
					amount: {
						value: document.getElementById('total').value
					},
				}]
			});
		},
		// Finalize the transaction after payer approval
		onApprove: function(data, actions) {
			return actions.order.capture().then(function() {
				window.location = "tracnsaction-completed.php?&orderID=" + data.orderID + "&customerID=" + '<?php print $customerID; ?>';
				//window.location = "paypalSuccess.php?&customerID=" + data.customerID;
			});
		}
	}).render('#paypal-button-container');
</script>

</html>