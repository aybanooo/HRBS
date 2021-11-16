<?php
require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __initDB__;
require_once __F_DB_HANDLER__;
require_once __F_LOGIN_HANDLER__;
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

checkRequiredPOSTval("inp-newContact, inp-currPass", true);

$empID = getUserInfoFromToken($_COOKIE['authkn'])->id;
$contactNum = prepareForSQL($conn, $_POST['inp-newContact']);
$password = $_POST['inp-currPass'];

idIsAdmin($empID, true);
validPassword($password, $empID, true);

$sql = "UPDATE `employee` SET `contact`='$contactNum' WHERE `empID`=$empID;";

if(!mysqli_query($conn, $sql)) {
    echo $output->setFailed('Something went wrong while updating the contact #', getConnError($conn));
    die();
}

echo $output->setSuccessful('Contact # has been updated. Please login again to display the changes.');
?>