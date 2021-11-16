<?php
require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __initDB__;
require_once __F_DB_HANDLER__;
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

checkRequiredPOSTval("eID, contactNum, password", true);

$empID = prepareForSQL($conn, $_POST['eID']);
$contactNum = prepareForSQL($conn, $_POST['contactNum']);
$password = $_POST['password'];

validPassword($password, $empID, true);
idIsAdmin($empID, true);

$sql = "UPDATE `employee` SET `contact`='$contactNum' WHERE `empID`=$empID;";

if(!mysqli_query($conn, $sql)) {
    echo $output->setFailed('Something went wrong while updating the contact #', getConnError($conn));
    die();
}

echo $output->setSuccessful('Contact # has been updated');
?>