<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once __F_PERMISSION_HANDLER__;

checkPermission(__V_P_ROOMS_MANAGE__, true);

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


if (!mkdir(__D_ROOMS__.$output->output["data"]->roomTypeID)) {
  $output->setFailed("Failed to create directory for room.");
  $sql = "delete from roomtype where name like '".$_POST["roomName"]."';";
  mysqli_query($conn, $sql);
  echo $output->getOutput(true);
  die();
}


$file = __D_DEFAULTS_ADMIN__.'default-image-landscape.jpg';
$newfile = __D_ROOMS__.$output->output["data"]->roomTypeID."/".$output->output["data"]->roomTypeID.'-cover.jpg';
if (!copy($file, $newfile)) {
    $output->setFailed("Failed to copy default image to the room folder.");
    $sql = "delete from roomtype where name like '".$_POST["roomName"]."';";
    mysqli_query($conn, $sql);
    if (!rmdir(__D_ROOMS__.$output->output["data"]->roomTypeID)) {
      $output->setFailed("Failed to remove folder.");
    }if (!rmdir(__D_ROOMS__.$output->output["data"]->roomTypeID."/section")) {
      $output->setFailed("Failed to remove folder.");
    }
    die();
}


$output->setSuccessful("New record created successfully");
echo $output->getOutput(true);

mysqli_close($conn);

?>