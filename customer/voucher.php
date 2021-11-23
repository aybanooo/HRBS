<?php
require_once(dirname(__FILE__,2)."/public_assets/modules/php/directories/directories.php");
require_once __F_RSV_HANDLER__;
include('db.php');

	$coupon_code = $_POST['coupon'];
	$price = intval($_POST['price']);
	$roomTypeID = intval($_POST['rid']);
 
	$valid = checkVoucherValidity($coupon_code, $price, $roomTypeID);

	if($valid) {
		$data = getVoucherDetails($coupon_code);
		$discount = intval($data["value"]); 
		$total =  $price - $discount;
		$array["value"] = $data["value"];
		$array["price"] = $price-$discount;
		echo json_encode($array);
		die;
	}
	echo "error";

?>