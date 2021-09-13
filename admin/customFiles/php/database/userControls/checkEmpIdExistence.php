<?php
require_once("../../directories/directories.php");
require_once(__dbCreds__);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM employee WHERE empID=".$_GET["empID"];
//$sql = "SELECT * FROM access";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    echo "0";    
}
} else {
    echo "1";
}

mysqli_close($conn);

//header('Location: /Thesis/Proto/scratch.php');
?>