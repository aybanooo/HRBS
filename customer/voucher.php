<?php
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
  $output->setFailed("Cannot connect to database.".$conn->connect_error);
  echo $output->getOutput(true);
  die();
}
	$coupon_code = $_POST['coupon'];
	$price = $_POST['price'];
 
	$query = mysqli_query($conn, "SELECT * FROM `promotion` WHERE `promoCode` = '$coupon_code' && `value` = '1'") or die(mysqli_error($conn));
	$count = mysqli_num_rows($query);
	$fetch = mysqli_fetch_array($query);
	$array = array();
	if($count > 0){
		$discount = $fetch['discount'] / 100;
		$total = $discount * $price;
		$array['discount'] = $fetch['discount'];
		$array['price'] = $price - $total;
 
		echo json_encode($array);
 
	}else{
		echo "error";
	}
?>
