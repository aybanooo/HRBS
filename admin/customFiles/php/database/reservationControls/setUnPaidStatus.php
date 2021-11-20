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

checkRequiredPOSTval("rsvid", true);

$rid = $_POST['rsvid'];

prepareForSQL($tempConn, $rid, 1);

$sql = "UPDATE `reservation` SET `reservationStatus`=0 WHERE `reservationID`=$rid LIMIT 1;";

if(mysqli_query($tempConn, $sql)) {
    echo $output->setSuccessful('Status have been updated');
    die;
} else {
    echo $output->setFailed('Something went wrong while updating the record');
    die;
}

?>