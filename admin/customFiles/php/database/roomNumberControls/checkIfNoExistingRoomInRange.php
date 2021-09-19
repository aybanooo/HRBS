<?php


$_GET['ignoreExisting'] =  filter_var($_GET['ignoreExisting'], FILTER_VALIDATE_BOOLEAN);

if ($_GET['ignoreExisting'])
    die(json_encode(true));

require_once("../../directories/directories.php");
require_once(__dbCreds__);
require_once(__outputHandler__);

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