<?php
require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_RSV_HANDLER__;
require_once __F_OUTPUT_HANDLER__;
require_once __F_VALIDATIONS__;


$str_checkIn = $_POST['checkIn'];
$str_checkOut = $_POST['checkOut'];
$adult = intval($_POST['guest']['adult']);
$child = intval($_POST['guest']['child']);

$rid = intval($_POST['rid']);
$PWDorSENIOR_ID = $_POST['PoS_ID'];
$voucher = $_POST['voucher_code'];
// $voucher = '2dpjdcG';

(validateDate($str_checkIn) && validateDate($str_checkOut)) || throw new Exception("Invalid checkin or checkout date");
$date_checkIn = DateTime::createFromFormat('Y-m-d', $str_checkIn);
$date_checkOut = DateTime::createFromFormat('Y-m-d', $str_checkOut);

$bp = new bookingPayment($date_checkIn, $date_checkOut, $rid, $PWDorSENIOR_ID, [$adult, $child], $voucher);

$test = $bp->getBookingDetails();

echo json_encode($test);

?>