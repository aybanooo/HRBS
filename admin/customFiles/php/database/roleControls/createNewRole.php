<?php
require_once("../../directories/directories.php");
require_once(__dbCreds__);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO access (accessname)
VALUES ('".$_POST["roleName"]."');";


//$allSQL = $sql + $sqlTwo;

//insert new role name to access table
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully in access table";
} else {
  echo "Error in sql: " . $sql . "<br>" . $conn->error;
  $conn->close();
}

//get new role ID
$sqlGetRoleID = "SELECT accessID FROM access WHERE accessname LIKE '".$_POST["roleName"]."'";
$result = mysqli_query($conn, $sqlGetRoleID);
$roleID = "";

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $roleID = $row["accessID"];    
  }
} else {
    echo "NoID";
}


$sqlTwo = "INSERT INTO accesspermission (accessId, permId)
VALUES 
($roleID, '1'), 
($roleID, '2'), 
($roleID, '3'), 
($roleID, '4'), 
($roleID, '5'), 
($roleID, '6'), 
($roleID, '7'), 
($roleID, '8'), 
($roleID, '9'), 
($roleID, '10'), 
($roleID, '11'), 
($roleID, '12'), 
($roleID, '13'), 
($roleID, '14'), 
($roleID, '15'), 
($roleID, '16'), 
($roleID, '17'), 
($roleID, '18'), 
($roleID, '19');";

//insert new role data to accesspermission table
if ($conn->query($sqlTwo) === TRUE) {
  echo "New record created successfully in accesspermission table";
} else {
  echo "Error in sqlTwo: " . $sql . "<br>" . $conn->error;
}

$conn->close();

//header('Location: /Thesis/Proto/scratch.php');
?>