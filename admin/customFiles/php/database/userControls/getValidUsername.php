<?php
require_once("../../directories/directories.php");
require_once(__dbCreds__);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

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