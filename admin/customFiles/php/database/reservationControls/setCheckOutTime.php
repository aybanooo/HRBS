<?php
require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __initDB__;
require_once __F_OUTPUT_HANDLER__;
require_once __F_VALIDATIONS__;
require_once __F_DB_HANDLER__;
require_once __F_FORMAT__;
checkAdminSideAccess();

$tempConn = createTempDBConnection();

checkRequiredPOSTval("date-checkOut, rsvid", true);

$date =  DateTime::createFromFormat('Y-m-d H:i', $_POST['date-checkOut']);
$date_formated = date_format($date, 'Y-m-d H:i:00');
$rsvid = prepareForSQL($tempConn, $_POST['rsvid']);
if(!mysqli_query($tempConn, "UPDATE `reservation` SET `checkOutTime`='$date_formated' WHERE `reservationID`=$rsvid LIMIT 1;")) {
    echo $output->setFailed('Something went wrong while updating the check-out time', getConnError($tempConn));
    die();
}

echo $output->setSuccessful('Check-out time is now updated');
?>