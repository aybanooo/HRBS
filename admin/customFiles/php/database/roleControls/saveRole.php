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

foreach ($_POST as $key => $value) {
    if($key=="roleID")
        continue;
    //echo $key." = ".$value."<br>";
    $sql = "UPDATE accesspermission SET val=$value WHERE accessId=".$_POST["roleID"]." && permId=$key";
    //echo $sql."<br>";
    if (mysqli_query($conn, $sql)) {
        //echo "Record updated successfully";
    } else {
        $status = 0;
        //echo "Error updating record: " . mysqli_error($conn);
    }
}

echo $status;

mysqli_close($conn);

?>