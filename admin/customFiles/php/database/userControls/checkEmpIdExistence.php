<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

$sql = "SELECT * FROM employee WHERE empID={$_GET['empID']} LIMIT 1;";
//$sql = "SELECT * FROM access";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    echo json_encode("ID is already taken");
}
} else {
  echo json_encode(true);
}

mysqli_close($conn);

//header('Location: /Thesis/Proto/scratch.php');
?>