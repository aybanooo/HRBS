<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

$sql = "SELECT id, firstname, lastname FROM MyGuests";


//insert new role data to accesspermission table
if ($conn->query($sql) === TRUE) {
  echo "1";
} else {
  //echo "<script>console.log(\"Error in sql: " . $sql . "<br>" . $conn->error."\");</script>";
  echo "0";
}

$conn->close();

//header('Location: /Thesis/Proto/scratch.php');
?>