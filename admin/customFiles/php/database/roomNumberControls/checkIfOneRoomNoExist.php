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
$sql = "SELECT roomNo FROM room WHERE roomNo=".$_POST["roomNo"].";";
$result = mysqli_query($conn, $sql);
$output->setSuccessful();

if(mysqli_num_rows($result) > 0) {
    echo json_encode(false);
} else {
    echo json_encode(true);
}

?>