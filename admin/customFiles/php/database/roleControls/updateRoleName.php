<?php
require_once("../../directories/directories.php");
require_once(__dbCreds__);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$status = 1;



$sql = "UPDATE access SET accessname='".$_POST["newRoleName"]."' WHERE accessname='".$_POST["oldRoleName"]."'";

echo $sql;

if ($conn->query($sql) === TRUE) {
    if($conn->affected_rows <= 0) 
        $status = 0;

} else {
    $status = 0;
}
echo $status;

mysqli_close($conn);


?>