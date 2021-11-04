<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__format__);
require_once(__formatInput__);

prepareForSQL($conn, $_GET['input-one-newRoomStatus']);

$sql = "SELECT `roomStatus` FROM roomstatus WHERE `roomStatus` like '{$_GET['input-one-newRoomStatus']}';";

if(mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
    echo json_encode("Room status already exist.");
} else {
    echo json_encode(true);
}

?>