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

if( !isset($_GET["roomName"]) || empty(trim($_GET["roomName"]))) {
  $output->setFailed("No room name");
  echo $output->getOutput(true);
  die();
  }
$_GET["roomName"] = trim($_GET["roomName"]);

$sql = "SELECT * from roomtype where name like '".$_GET["roomName"]."'";

if(!$result = mysqli_query($conn, $sql)) {
  $output->setFailed("There was a problem retrieving the data", mysqli_error($conn));
  echo $output->getOutput(true);
  die();
}

if(mysqli_num_rows($result) > 0) {
  $output->setSuccessful("Exist");
  $output->output["data"] = true;
} else {
  $output->output["data"] = false;
  $output->setSuccessful("Doesn't exist".mysqli_error($conn));
  echo $output->getOutput(true);
  die();
}

echo $output->getOutput(true);
?>