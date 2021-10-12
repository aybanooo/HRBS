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

if ( !(isset($_POST['roomNoFirst']) && isset($_POST['roomNoLast']) && isset($_POST['floorLevel']) && isset($_POST['roomTypeID']) && isset($_POST['statusID']) ) )  {
    $output->setFailed("Missing input");
    echo $output->getOutput(1);
    die();
}

prepareForSQL($conn, $_POST['roomNoFirst'], 1);
prepareForSQL($conn, $_POST['roomNoLast'], 1);
prepareForSQL($conn, $_POST['floorLevel'], 1);
prepareForSQL($conn, $_POST['roomTypeID'], 1);
prepareForSQL($conn, $_POST['statusID'], 1);


$existingRoomNums = [];

$existingRoomNumsResult = mysqli_query($conn, "SELECT roomNo FROM room WHERE roomNo BETWEEN {$_POST['roomNoFirst']} AND {$_POST['roomNoLast']}");
if(mysqli_num_rows($existingRoomNumsResult) > 0)
    while($r = mysqli_fetch_assoc($existingRoomNumsResult))
        array_push($existingRoomNums, $r["roomNo"]);


$sql = "";

foreach (range($_POST['roomNoFirst'], $_POST['roomNoLast']) as $roomNum) {
    if(!in_array($roomNum, $existingRoomNums))
        $sql .= "INSERT INTO `room`(`roomNo`, `floorLevel`, `roomtypeID`, `roomStatusID`) 
        VALUES ($roomNum,{$_POST['floorLevel']},{$_POST['roomTypeID']},{$_POST['statusID']});";
}

if (mysqli_multi_query($conn, $sql)) {
    $output->setSuccessful("New room # have been created successfully.");
  } else {
    $output->setFailed("Something went wrong while  creating the new room #.", mysqli_error($conn));
  }

echo $output->getOutput(1) ;

mysqli_close($conn);

?>