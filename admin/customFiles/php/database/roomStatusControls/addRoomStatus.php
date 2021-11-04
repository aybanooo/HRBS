<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__F_OUTPUT_HANDLER__);
require_once(__F_FORMAT__);
require_once(__F_FORMAT_INPUT__);


if ( !(isset($_POST['input-one-newRoomStatus']) && isset($_POST['input-one-newDescription']) && isset($_POST['select-one-bookable']) ) )  {
    $output->setFailed("Missing input");
    echo $output->getOutput(1);
    die();
}

prepareForSQL($conn, $_POST['input-one-newRoomStatus']);
prepareForSQL($conn, $_POST['input-one-newDescription']);
prepareForSQL($conn, $_POST['select-one-bookable'], 0);

$sql = "INSERT INTO `roomstatus`(`roomStatus`, `desc`, `bookable`) VALUES ('{$_POST['input-one-newRoomStatus']}','{$_POST['input-one-newDescription']}', {$_POST['select-one-bookable']});";

if(mysqli_query($conn, $sql) == TRUE) {
    $output->setSuccessful("New room status have been created successfully.");
} else {
    $output->setFailed("Something went wrong while creating the new room status.", mysqli_error($conn));
}

echo $output->getOutput(1) ;

?>