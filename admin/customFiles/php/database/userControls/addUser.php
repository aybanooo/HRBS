<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__F_FORMAT__);
require_once __F_PERMISSION_HANDLER__;
require_once __F_VALIDATIONS__;
require_once __F_DB_HANDLER__;
checkAdminSideAccess();

checkPermission(__V_P_ACCOUNT_CREATE__, true);

$empID = prepareForSQL($conn, $_POST['empID']);
$fName = prepareForSQL($conn, $_POST['fName']);
$lName = prepareForSQL($conn, $_POST['lName']);
$accessID = prepareForSQL($conn, $_POST['accessID']);
$contact = prepareForSQL($conn, $_POST['contact']);

$sql = "INSERT INTO employee
VALUES ($empID,
'$fName',
'$lName',
$accessID,
'$contact');";

$credsSql = "INSERT INTO empaccountdetails(empID)
VALUES ($empID) LIMIT 1;";

//$deleteSql = "DELETE FROM employee WHERE empID=".$_POST["empID"];


//$allSQL = $sql + $sqlTwo;


//insert new role data to accesspermission table
if (mysqli_query($conn, $sql)) {
  if (mysqli_query($conn, "INSERT INTO `empaccountdetails`(`empID`) VALUES ($empID);"))
    echo $output->setSuccessful("Account have been successfuly created.");
  else {
    mysqli_query($conn, "DELETE FROM `empaccountdetails` WHERE `empID`=$empID LIMIT 1;");
    echo $output->setFailed("Failed to add userssss.", getConnError($conn));
  }
} else {
  //echo "<script>console.log(\"Error in sql: " . $sql . "<br>" . $conn->error."\");</script>";
  echo $output->setFailed("Failed to add user.", getConnError($conn));
}
//header('Location: /Thesis/Proto/scratch.php');
?>