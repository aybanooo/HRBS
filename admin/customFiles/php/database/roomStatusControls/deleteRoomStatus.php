<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__F_OUTPUT_HANDLER__);
require_once __F_PERMISSION_HANDLER__;

checkPermission(__V_P_ROOMS_MANAGE_STATUS__, true);

if(!isset($_POST["roomStatusIDArray"])) {
    $output->setFailed("Selection doesn't exist.");
    echo $output->getOutput(1);
    die();
}

$roomStatusIDArray = implode(", ", $_POST["roomStatusIDArray"]);

if( mysqli_num_rows(mysqli_query($conn, "SELECT * from room WHERE roomStatusID in ($roomStatusIDArray)")) > 0) {
    $output->setFailed("Some rooms numbers are still using this status. Please change it first before deleting this room status.");
    echo $output->getOutput(1);
    die();
}

$sql = "DELETE FROM roomstatus where roomStatusID in ($roomStatusIDArray);";

if (mysqli_query($conn, $sql) == TRUE) {
    $output->setSuccessful("Selected room status have been deleted.");
} else {
    $output->setFailed("Something went wrong while deleting the room status.", mysqli_error($conn));
}

echo $output->getOutput(1);

?>