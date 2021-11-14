<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once __F_VALIDATIONS__;
checkAdminSideAccess();
function boolToCheck($value) {
    return $value ? 'checked': '';
}


$sql = "SELECT empID, fName, lName, contact, access.accessID, access.accessname FROM `employee` LEFT JOIN access ON employee.accessID = access.accessID";

$accounts = [
    "data" => []
];

//$sql = "SELECT * FROM access";
$result = mysqli_query($conn, $sql);
$options = "";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo $row["accessID"]."<br>";   
        array_push($accounts['data'], $row);
    }
} else {
    echo "";
}


echo json_encode($accounts);
//header('Location: /Thesis/Proto/scratch.php');
die();
?>

<pre>
    <?php
        echo json_encode($accounts);
    ?>
</pre>