<?php
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