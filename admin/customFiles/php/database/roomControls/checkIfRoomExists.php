<?php
require_once("../../directories/directories.php");
require_once(__initDB__);

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