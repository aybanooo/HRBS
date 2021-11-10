<?php

$servername = "localhost";
$username = "u362912910_thanos2";
$password = "L]5py5jrlHY";
$dbname = "u362912910_hrbs2";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    $output->setFailed("Cannot connect to database." . $conn->connect_error);
    echo $output->getOutput(true);
    die();
}

?>