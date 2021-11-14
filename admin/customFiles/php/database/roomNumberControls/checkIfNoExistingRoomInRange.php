<?php
require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

$_GET['ignoreExisting'] =  filter_var($_GET['ignoreExisting'], FILTER_VALIDATE_BOOLEAN);

if ($_GET['ignoreExisting'])
    die(json_encode(true));

require_once("../../directories/directories.php");
require_once(__initDB__);   

$sql = "SELECT roomNo FROM room WHERE roomNo BETWEEN {$_GET['roomNoFirst']} AND {$_GET['roomNoLast']}";
$result = mysqli_query($conn, $sql);

$existingRoomNums = [];

if(mysqli_num_rows($result) > 0) {
    while($r = mysqli_fetch_assoc($result)) {
        array_push($existingRoomNums, $r["roomNo"]);
    }
    echo json_encode(strval("Room ".implode(", ", $existingRoomNums)." already exists."));
} else {
    echo json_encode(true);
}

?>