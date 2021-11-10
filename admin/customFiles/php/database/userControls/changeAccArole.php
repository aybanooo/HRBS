<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__F_LOGIN_HANDLER__);
require_once __F_PERMISSION_HANDLER__;
require_once(__F_VALIDATIONS__);

checkRequiredPOSTval("newAccessID, empID");

$newAcid = prepareForSQL($conn, $_POST["newAccessID"], 1);
$empID = prepareForSQL($conn, $_POST["empID"], 1);

// Validations
checkPermission(__V_P_ACCOUNT_CHANGE_ROLE__, true);
$currentUserID = getUserInfoFromToken($_COOKIE['authkn'])->id;
// Check if the user is trying to change their own account
if($currentUserID==$empID)
  die($output->setFailed("You cannot change your own account"));

if(!accessIDhaveFFA($newAcid)) {
    if(getFFAUserCount_delete_emp($currentUserID)==0) {
        echo $output->setFailed("Atleast 1 role must have full account management access");
        die();
    }
}

$sql = "UPDATE employee SET accessID=".$newAcid." WHERE empID=".$empID.";";

$output->output['data'] =  $_POST;


if (mysqli_query($conn, $sql)) {
    //echo "Record updated successfully";
    echo $output->setSuccessful("Record updated successfully");
    //echo mysqli_affected_rows($conn);
} else {
    echo $output->setSuccessful("Something went wrong while changing the account role");
    //echo "Error updating record: " . mysqli_error($conn);
}
//echo $status;
?>