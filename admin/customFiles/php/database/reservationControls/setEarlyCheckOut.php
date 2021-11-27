<?php
require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __initDB__;
require_once __F_OUTPUT_HANDLER__;
require_once __F_VALIDATIONS__;
require_once __F_DB_HANDLER__;
require_once __F_FORMAT__;
require_once __F_PERMISSION_HANDLER__;
checkAdminSideAccess();

checkPermission(__V_P_RSVTN_MANAGE__, 1);

$tempConn = createTempDBConnection();

checkRequiredPOSTval("date-checkOut, rsvid", true);

// print_r($_POST);die;

$date =  DateTime::createFromFormat('Y-m-d', $_POST['date-checkOut']);
$date_formated = date_format($date, 'Y-m-d');
$rsvid = prepareForSQL($tempConn, $_POST['rsvid']);
if(!mysqli_query($tempConn, "UPDATE `reservation` SET `earlyCheckout`='$date_formated' WHERE `reservationID`=$rsvid LIMIT 1;")) {
    echo $output->setFailed('Something went wrong while updating the early check-out date', getConnError($tempConn));
    die();
}

echo $output->setSuccessful('Early checkout is now updated');
?>