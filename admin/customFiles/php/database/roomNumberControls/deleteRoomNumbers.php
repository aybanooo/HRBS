<?php
require_once("../../directories/directories.php");
require_once(__initDB__);

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