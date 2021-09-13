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


if( !isset($_POST["roomName"]) || empty(trim($_POST["roomName"]))) {
  $output->setFailed("No room name");
  echo $output->getOutput(true);
  die();
}

$_POST["roomName"] = trim($_POST["roomName"]);

//die();//--------------------------------

$sql = "INSERT INTO roomtype-roomgeneralinfo (roomTypeID)
VALUES ('".$_POST["roomName"]."');";

if (mysqli_query($conn, $sql)) {
  $output->setSuccessful("New record created successfully");
} else {
  $output->setFailed("Something went wrong while creating the new room.", mysqli_error($conn) );
  echo $output->getOutput(true);
  die();
}



echo $output->getOutput(true);

mysqli_close($conn);

?>