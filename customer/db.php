<?php

require_once(dirname(__FILE__,2)."/public_assets/modules/php/directories/directories.php");

$dbCreds = parse_ini_file(__CONF_DB__);

$servername = $dbCreds['DB_SERVERNAME'];
$username = $dbCreds['DB_USERNAME'];
$password = $dbCreds['DB_PASS'];
$dbname = $dbCreds['DB_NAME'];

//$username = "root";
//$password = "";
//$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    $output->setFailed("Cannot connect to database.",getConnError($conn));
    echo $output->getOutput(true);
    die();
}

if(!mysqli_query($conn, "SET time_zone = '+08:00';")) {
    die("Something went wrong while updating the timezone");
}
?>