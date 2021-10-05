<?php
require_once("../../directories/directories.php");
require_once(__dbCreds__);
require_once(__outputHandler__);
require_once(__formatInput__);

mysqli_report(MYSQLI_REPORT_STRICT);

// Create connection
try {
$conn = new mysqli($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    $output->setFailed("Cannot connect to database.");
    echo $output->getOutput(true);
    die();
}

// Check connection
if ($conn->connect_error) {
    $output->setFailed("Cannot connect to database.".$conn->connect_error);
    //echo $output->getOutput(true);
    die();
}

prepareForSQL($conn, $_GET['input-one-newRoomStatus']);

$sql = "SELECT `roomStatus` FROM roomstatus WHERE `roomStatus` like '{$_GET['input-one-newRoomStatus']}';";

if(mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {
    echo json_encode("Room status already exist.");
} else {
    echo json_encode(true);
}

?>