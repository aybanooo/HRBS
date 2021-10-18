<?php
require_once("../../directories/directories.php");
require_once(__initDB__);

$sql = "INSERT INTO employee
VALUES ('".$_POST["empID"]."',
'".$_POST["fName"]."',
'".$_POST["lName"]."',
'".$_POST["accessID"]."',
'".$_POST["contact"]."');";

$credsSql = "INSERT INTO empaccountdetails(empID)
VALUES (\"".$_POST["empID"]."\");";

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