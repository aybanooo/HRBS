<?php
require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once(__initDB__);
require_once(__format__);
require_once(__validations__);


checkRequiredPOSTval("acid, newRoleName");

$newRoleName = prepareForSQL($conn, $_POST["newRoleName"]);
$acid = prepareForSQL($conn, $_POST['acid']);

$sql = "UPDATE access SET accessname='$newRoleName' WHERE accessID='$acid'";

if(mysqli_query($conn, $sql)) {
  echo $output->setSuccessful("Role name has been successfuly changed");
} else {
  echo $output->setFailed("Something went wrong while changing role name");
}

?>