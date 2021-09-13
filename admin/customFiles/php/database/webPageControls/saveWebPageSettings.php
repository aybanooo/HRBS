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

echo notSetToEmptyString($_GET["companyName"]);


if(isset($_GET["hotelLatLong"])) {
    if( substr_count($_GET["hotelLatLong"], ',') > 1  ) {
        $loc = explode(',', substr($_GET["hotelLatLong"], 0, strpos($_GET["hotelLatLong"], ',', 2)));
        echo $loc[0];
        echo $loc[1];
    }
    else if (substr_count($_GET["hotelLatLong"], ',') == 1) {
        $loc = explode(',', $_GET["hotelLatLong"], 2);
    }
    else {
        $loc[0] = str_replace(',', "", $_GET["hotelLatLong"]);
        array_push($loc, "");
    }
}



$rowExistSQL = "select * from companyinfo;";
$result = mysqli_query($conn, $rowExistSQL);
//echo mysqli_num_rows($result);

if(mysqli_num_rows($result) == 0) {
    $sql = "INSERT INTO companyinfo ()
    VALUES ('"
    .( isset($_GET["hotelName"]) ? $_GET["hotelName"] : "Hotel Reservation System" )."', '"
    .notSetToEmptyString($_GET["hotelAddress"])."', '"
    .notSetToEmptyString($_GET["hotelContact"])."', '"
    .notSetToEmptyString($loc[1])."', '"
    .notSetToEmptyString($loc[0])."', '"
    .notSetToEmptyString($_GET["hotelEmailAd"])."');";

    if ($conn->query($sql) === TRUE) {
        echo "1";
    //echo "Company info saved";
    } else {
        echo "0";
        //echo "Error saving: " . $sql . "<br>" . $conn->error;
    }
}
else {
    if(mysqli_num_rows($result) > 1){
        $deleteSql = "DELETE FROM companyinfo limit 1;";
        mysqli_query($conn, $deleteSql);
    }
    $sql = "UPDATE companyinfo SET
    companyName = '".( isset($_GET["hotelName"]) ? $_GET["hotelName"] : "Reservation System" )."', ".
    "address = '".notSetToEmptyString($_GET["hotelAddress"])."', ".
    "contact = '".notSetToEmptyString($_GET["hotelContact"])."', ".
    "longitude = '".notSetToEmptyString($loc[1])."', ".
    "latitude = '".notSetToEmptyString($loc[0])."', ".
    "email = '".notSetToEmptyString($_GET["hotelEmailAd"])."' LIMIT 1;";

    if (mysqli_query($conn, $sql)) {
        //echo "Record saved successfully";
        echo "1";
    } else {
        //echo "Error saving record: " . mysqli_error($conn);
        echo "0";
    }
}


$conn->close();
?>