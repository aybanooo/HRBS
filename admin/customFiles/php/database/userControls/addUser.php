<?php
require_once("../../directories/directories.php");
require_once(__dbCreds__);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO employee
VALUES ('".$_POST["empID"]."',
'".$_POST["fName"]."',
'".$_POST["lName"]."',
'".$_POST["accessID"]."',
'".$_POST["contact"]."');";

$credsSql = "INSERT INTO empaccountdetails(empID)
VALUES (\"".$_POST["empID"]."\");";

$deleteSql = "DELETE FROM employee WHERE empID=".$_POST["empID"];


//$allSQL = $sql + $sqlTwo;


//insert new role data to accesspermission table
if ($conn->query($sql) === TRUE) {
    if ($conn->query($credsSql) === TRUE) {
        echo "1";
      } else {
        mysqli_query($conn, $deleteSql);
        echo "0";
      }
} else {
  //echo "<script>console.log(\"Error in sql: " . $sql . "<br>" . $conn->error."\");</script>";
  echo "0";
}

$conn->close();

//header('Location: /Thesis/Proto/scratch.php');
?>