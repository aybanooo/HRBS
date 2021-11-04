<?php
require_once("../../directories/directories.php");
require_once(__initDB__);

$sql = "SELECT roomNo FROM room WHERE roomNo=".$_POST["roomNo"].";";
$result = mysqli_query($conn, $sql);
$output->setSuccessful();

if(mysqli_num_rows($result) > 0) {
    echo json_encode(false);
} else {
    echo json_encode(true);
}

?>