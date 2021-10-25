<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__format__);

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
VALUES ($empID);";

//$deleteSql = "DELETE FROM employee WHERE empID=".$_POST["empID"];


//$allSQL = $sql + $sqlTwo;


//insert new role data to accesspermission table
if (mysqli_query($conn, $sql)) {
  echo $output->setSuccessful("Account have been successfuly created.");
} else {
  //echo "<script>console.log(\"Error in sql: " . $sql . "<br>" . $conn->error."\");</script>";
  echo $output->setFailed("Failed to add user.");
}
//header('Location: /Thesis/Proto/scratch.php');
?>