<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__F_FORMAT_INPUT__);
require_once(__F_FORMAT__);
require_once __F_PERMISSION_HANDLER__;
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

checkPermission(__V_P_ROOMS_MANAGE_NUMBERS__, true);


$_POST["roomNums"] = explode(",", $_POST["roomNums"]);

foreach($_POST["roomNums"] as &$val) {
    prepareForSQL($conn, $val, 1);
}

$_POST["roomNums"] = implode(",", $_POST["roomNums"]);

$sql = "";

if (isset($_POST["selectRoomType"]) && !isset($_POST["selectRoomStatus"])) {
    $sql = "UPDATE `room` SET `roomtypeID`={$_POST['selectRoomType']} WHERE roomNo IN ({$_POST['roomNums']});";
} else if (!isset($_POST["selectRoomType"]) && isset($_POST["selectRoomStatus"])) {
    $sql = "UPDATE `room` SET `roomStatusID`={$_POST['selectRoomStatus']} WHERE roomNo IN ({$_POST['roomNums']});";
} else if (isset($_POST["selectRoomType"]) && isset($_POST["selectRoomStatus"])) {
    $sql = "UPDATE `room` SET `roomtypeID`={$_POST['selectRoomType']},`roomStatusID`={$_POST['selectRoomStatus']} WHERE roomNo IN ({$_POST['roomNums']});";
} else {
    $output->setFailed("Invalid options.");
    echo $output->getOutput(1);
    die();
}

if (mysqli_query($conn, $sql)) {
    $output->setSuccessful("Room number/s have been updated successfully.");
  } else {
    $output->setFailed("Something went wrong while updating the room number/s.", mysqli_error($conn));
}

echo $output->getOutput(1);

?>