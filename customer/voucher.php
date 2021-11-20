<?php
include('db.php');
	$coupon_code = $_POST['coupon'];
	$price = $_POST['price'];
 
	$query = mysqli_query($conn, "SELECT * FROM `promotion` WHERE `promoCode` = '$coupon_code' && `minSpend` <= '$price' && `maxSpend` >= '$price' && `expiry` != CURDATE()") or die(mysqli_error($conn));
	$count = mysqli_num_rows($query);
	$fetch = mysqli_fetch_array($query);
	$array = array();


	 	if($count > 0){
			$discount = $fetch["value"]; 
			$total =  $price - $discount;
			$array["value"] = $fetch["value"];
			$array["price"] = $price-$discount;
			
			echo json_encode($array);
			
		}else{
			echo "error";
		}

?>