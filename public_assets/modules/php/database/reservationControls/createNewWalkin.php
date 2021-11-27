<?php
require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_RSV_HANDLER__;
require_once __F_OUTPUT_HANDLER__;
require_once __F_VALIDATIONS__;


// print_r($_POST);

// die;
$str_checkIn = $_POST['checkIn'];
$str_checkOut = $_POST['checkOut'];
$adult = intval($_POST['guest']['adult']);
$child = intval($_POST['guest']['child']);

$rid = intval(base64_decode($_POST['rid']));
$PWDorSENIOR_ID = $_POST['PoS_ID'];
$voucher = $_POST['voucher_code'];
// $voucher = '2dpjdcG';

$xID = $_POST['xID'];



$connForXID = createTempDBConnection();
prepareForSQL($connForXID, $xID);
$XID_exist = mysqli_fetch_all(mysqli_query($connForXID, "SELECT COUNT(*) FROM `paypalpayment` WHERE `orderID` like '$xID' LIMIT 1;"))[0][0];
mysqli_close($connForXID);
if($XID_exist) {
    die($output->setFailed("Transaction ID already exists"));
}


(validateDate($str_checkIn) && validateDate($str_checkOut)) || throw new Exception("Invalid checkin or checkout date");
$date_checkIn = DateTime::createFromFormat('Y-m-d', $str_checkIn);
$date_checkOut = DateTime::createFromFormat('Y-m-d', $str_checkOut);

$bp = new bookingPayment($date_checkIn, $date_checkOut, $rid, $PWDorSENIOR_ID, [$adult, $child], $voucher);

$test = $bp->getBookingDetails();
if(!$test['VALID_BOOKING']) {
    die($output->setFailed('Invalid Booking'));
}

$total = $test['amount']['total'];

$truForm = [
    "fname" =>  $_POST['fname'],
    "lname" =>  $_POST['lname'],
    "cnumber" =>  $_POST['contact'],
    "email" => $_POST['email']
    
];

$bp_data =  [
    "truForm" =>  $truForm,
    "bp_details" =>  $test
];

$bp_data = json_decode(json_encode($bp_data));


$reservationID = reserve_bp($bp_data);
updateToPaid($reservationID);
updateReservationAmountTable($bp_data, $reservationID);

$quickConn = createTempDBConnection();

$sql = "INSERT INTO `paypalpayment`(
    `reservationID`, `orderID`, 
    `payedValue`, `currency`) 
    VALUES (
        $reservationID,'$xID',
        $total, 'PHP');";
if(!mysqli_query($quickConn, $sql)) {
    die($output->setFailed('Cannot create payment info'));
}
// sendMail($reservationID);

echo $output->setSuccessful('Reservation has been made');
?>