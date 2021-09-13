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

$_POST["roomName"] = mysqli_real_escape_string($conn, trim($_POST["roomName"]));

//die();//--------------------------------

$sql = "INSERT INTO roomtype (name)
VALUES ('".$_POST["roomName"]."');";

//echo $sql;

if (mysqli_query($conn, $sql)) {
} else {
  $output->setFailed("Something went wrong while creating the new room.", mysqli_error($conn) );
  echo $output->getOutput(true);
  die();
}

$sql = "select roomTypeID, name from roomtype where name like '".$_POST["roomName"]."';";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
  $output->output["data"] = mysqli_fetch_object($result);
} else {
  $output->setSuccessful("Cannot get id because room doesn't exist".mysqli_error($conn));
  echo $output->getOutput(true);
  die();
}


$sql = "INSERT INTO `roomsec` (`roomTypeID`, general) VALUES (".$output->output["data"]->roomTypeID.", 1)";
if (mysqli_query($conn, $sql)) {
} else {
  $output->setFailed("Something went wrong while creating the new room.", mysqli_error($conn) );
  echo $output->getOutput(true);
  die();
}


if (!mkdir(__rooms__.$output->output["data"]->roomTypeID)) {
  $output->setFailed("Failed to create directory for room.");
  $sql = "delete from roomtype where name like '".$_POST["roomName"]."';";
  mysqli_query($conn, $sql);
  echo $output->getOutput(true);
  die();
}


$file = __defaults__.'default-image-landscape.jpg';
$newfile = __rooms__.$output->output["data"]->roomTypeID."/".$output->output["data"]->roomTypeID.'-cover.jpg';
if (!copy($file, $newfile)) {
    $output->setFailed("Failed to copy default image to the room folder.");
    $sql = "delete from roomtype where name like '".$_POST["roomName"]."';";
    mysqli_query($conn, $sql);
    if (!rmdir(__rooms__.$output->output["data"]->roomTypeID)) {
      $output->setFailed("Failed to remove folder.");
    }if (!rmdir(__rooms__.$output->output["data"]->roomTypeID."/section")) {
      $output->setFailed("Failed to remove folder.");
    }
    die();
}


$output->setSuccessful("New record created successfully");
echo $output->getOutput(true);

mysqli_close($conn);

?>