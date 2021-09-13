<?php
require_once("../../directories/directories.php");
require_once(__dbCreds__);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function notSetToEmptyString(&$value) {
    if(isset($value))
        return $value;
    else
        return "";
}

$deleteSql = "DELETE FROM companyinfo limit 1;";
//echo mysqli_num_rows($result);

$rowExistSQL = "select * from companyinfo;";
$result = mysqli_query($conn, $rowExistSQL);


if(mysqli_num_rows($result) == 0) {
    $sql = "INSERT INTO companyinfo ()
    VALUES ('Reservation System', '','','','','');";
    if (mysqli_query($conn, $sql)) {
        //echo "Record saved successfully";
    } else {
        //echo "Error saving record: " . mysqli_error($conn);
    }
}
else {
    if(mysqli_num_rows($result) > 1){
        $deleteSql = "DELETE FROM companyinfo limit 1;";
        mysqli_query($conn, $deleteSql);
    }
    $sql = "select * from companyinfo limit 1;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo json_encode($row);
        }
    } else {
        echo "";
    }

}


$conn->close();
?>