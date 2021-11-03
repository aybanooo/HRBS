<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    $output->setFailed("Cannot connect to database." . $conn->connect_error);
    echo $output->getOutput(true);
    die();
}

?>