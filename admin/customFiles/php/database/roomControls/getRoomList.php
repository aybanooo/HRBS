<?php
require_once("../../directories/directories.php");
require_once(__dbCreds__);
require_once(__outputHandler__);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    $output->setFailed("Cannot connect to database.".$conn->connect_error);
    echo $output->getOutput(true);
    die();
}

$sql = "SELECT * from roomtype";
if(!$result = mysqli_query($conn, $sql)) {
    $output->setFailed("There was a problem retrieving the data", mysqli_error($conn));
    echo $output->getOutput();
    die();
}

$output->output["data"] = [];

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        array_push($output->output["data"], $row);
    }
} else {
    $output->setSuccessful("There are no rooms. ".mysqli_error($conn));
    echo $output->getOutput(true);
    die();
}

echo $output->getOutput(true);

?>