<?php
require_once("../../directories/directories.php");
require_once(__initDB__);

require_once(__F_VALIDATIONS__);

checkRequiredPOSTval("newAccessID, empID");

$newAcid = prepareForSQL($conn, $_POST["newAccessID"], 1);
$empID = prepareForSQL($conn, $_POST["empID"], 1);

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