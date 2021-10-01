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