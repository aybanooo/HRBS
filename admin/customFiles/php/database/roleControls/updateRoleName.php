<?php
require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once(__initDB__);
require_once(__F_FORMAT__);
require_once(__F_VALIDATIONS__);
require_once __F_PERMISSION_HANDLER__;
checkAdminSideAccess();

checkPermission(__V_P_ROLES_MANAGE__, true);

checkRequiredPOSTval("acid, newRoleName, password");

$password = $_POST["password"];
$tokenID = getUserInfoFromToken($_COOKIE['authkn'])->id;
validPassword($password, $tokenID, true);

$newRoleName = prepareForSQL($conn, $_POST["newRoleName"]);
$acid = prepareForSQL($conn, $_POST['acid']);

$sql = "UPDATE access SET accessname='$newRoleName' WHERE accessID='$acid'";

if(mysqli_query($conn, $sql)) {
  echo $output->setSuccessful("Role name has been successfuly changed");
} else {
  echo $output->setFailed("Something went wrong while changing role name");
}

?>