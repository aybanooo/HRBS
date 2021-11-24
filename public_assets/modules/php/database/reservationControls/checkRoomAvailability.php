<?php

require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_OUTPUT_HANDLER__;
require_once __F_VALIDATIONS__;
require_once __F_RSV_HANDLER__;


checkRequiredGETval('in, out, rid', 1);
$in = $_GET['in'];
$out = $_GET['out'];
$rid = $_GET['rid'];

(validateDate($in) && validateDate($out)) || throw new Exception("Invalid checkin or checkout date");
// $date_checkIn = DateTime::createFromFormat('Y-m-d', $in);
// $date_checkOut = DateTime::createFromFormat('Y-m-d', $out);

$bookableRoomsID = getBookableRoomsID($in, $out);

($rid=="") && die($output->setFailed('Invalid booking'));
(in_array($rid, $bookableRoomsID)) || die($output->setFailed('Invalid booking'));

echo $output->setSuccessful('Valid');
?>