<?php
include('db.php');
	$coupon_code = $_POST['coupon'];
	$price = $_POST['price'];
	$room = $_POST['roomName'];
 
	$query = mysqli_query($conn, "SELECT * FROM `promotion` WHERE `promoCode` = '$coupon_code' &&  `minSpend` <= '$price' && `maxSpend` >= '$price' && `expiry` != 'CURDATE()';" ) or die(mysqli_error($conn));
	$count = mysqli_num_rows($query);
	$fetch = mysqli_fetch_array($query);
	$array = array();


	 	if($count > 0){
			$total = $price - $fetch['value'];
			
			echo json_encode($total);
			
		}else{
			echo "error";
		}

?>