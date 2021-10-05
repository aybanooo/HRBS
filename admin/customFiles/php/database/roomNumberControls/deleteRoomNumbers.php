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

if(!isset($_POST["roomNoArray"])) {
    $output->setFailed("Selection doesn't exist.");
    echo $output->getOutput(1);
    die();
}

$roomNoArray = implode(", ", $_POST["roomNoArray"]);

$sql = "DELETE FROM room where roomNo in ($roomNoArray);";

if (mysqli_query($conn, $sql) == TRUE) {
    $output->setSuccessful("Selected room # have been deleted.");
    echo $output->getOutput(1);
} else {
    $output->setFailed("Something went wrong while deleting the records.");
    echo $output->getOutput(1);
}

?>