<?php
require_once("../../directories/directories.php");
require_once(__dbCreds__);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function boolToCheck($value) {
    return $value ? 'checked': '';
}


$sql = "SELECT * FROM access";
//$sql = "SELECT * FROM access";
$result = mysqli_query($conn, $sql);
$options = "";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo $row["accessID"]."<br>";   
        $options .= "<option value=\"".$row["accessID"]."\">".$row["accessname"]."</option>";
    }
    //echo $options;
} else {
    //echo "";
}

//header('Location: /Thesis/Proto/scratch.php');
?>

<select class="form-control" name="select-roles">
    <?php print $options;?>
</select>