<?php
include_once "dbCreds.php";
$conn = new mysqli("$servername","$username","$password","$dbname",) or die("Could not connect to database");
    if($conn){
        echo "Connected successfully";

    }
?>