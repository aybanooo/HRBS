<?php

require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__F_FORMAT__);
require_once __F_PERMISSION_HANDLER__;
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

checkPermission(__V_P_ACCOUNT_RESET_PASS__, true);

checkRequiredPOSTval("empID, password");
$password = $_POST["password"];
$tokenID = getUserInfoFromToken($_COOKIE['authkn'])->id;
validPassword($password, $tokenID, true);

$empID = prepareForSQL($conn, $_POST['empID']);

if(mysqli_num_rows($result = mysqli_query($conn, "SELECT `empID` from `empaccountdetails` LIMIT 1;")) == 0) {
  echo $output->setFailed("Account does not exist");
  die();
}

$sql = "UPDATE empaccountdetails SET password = DEFAULT WHERE empID=$empID LIMIT 1;";

if (mysqli_query($conn, $sql)) {
    //echo "Record updated successfully";
    echo $output->setSuccessful('Password have been reset');
    //echo mysqli_affected_rows($conn);
} else {
    //echo "Error updating record: " . mysqli_error($conn);
    echo $output->setFailed("Something went wrong while resetting the password");
  }
//echo $status;
?>