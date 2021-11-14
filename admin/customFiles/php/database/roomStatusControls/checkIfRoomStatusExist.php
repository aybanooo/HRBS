<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__F_FORMAT__);
require_once(__F_FORMAT_INPUT__);
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

prepareForSQL($conn, $_GET['input-one-newRoomStatus']);

$sql = "SELECT `roomStatus` FROM roomstatus WHERE `roomStatus` like '{$_GET['input-one-newRoomStatus']}';";

if(mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
    echo json_encode("Room status already exist.");
} else {
    echo json_encode(true);
}

?>