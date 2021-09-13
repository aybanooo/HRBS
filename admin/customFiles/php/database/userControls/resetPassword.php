<?php

require_once("../../directories/directories.php");
require_once(__dbCreds__);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql = "UPDATE empaccountdetails SET password = DEFAULT WHERE empID=".$_POST["empID"];


if (mysqli_query($conn, $sql)) {
    //echo "Record updated successfully";
    echo "1";
    //echo mysqli_affected_rows($conn);
} else {
    echo "0";
    //echo "Error updating record: " . mysqli_error($conn);
}
//echo $status;

mysqli_close($conn);


?>