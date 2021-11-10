<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once __F_PERMISSION_HANDLER__;

checkPermission(__V_P_ROOMS_MANAGE_NUMBERS__, true);

if ( !(isset($_POST['roomNo']) && isset($_POST['floorLevel']) && isset($_POST['roomTypeID']) && isset($_POST['statusID']) ) )  {
    $output->setFailed("Missing input");
    echo $output->getOutput(1);
    die();
}

$sql = "INSERT INTO `room`(`roomNo`, `floorLevel`, `roomtypeID`, `roomStatusID`) 
VALUES ({$_POST['roomNo']},{$_POST['floorLevel']},{$_POST['roomTypeID']},{$_POST['statusID']});";

if(mysqli_query($conn, $sql) == TRUE) {
    $output->setSuccessful("New room # have been created successfully.");
} else {
    $output->setFailed("Something went wrong while  creating the new room #.", $conn->error);
}

echo $output->getOutput(1) ;

?>