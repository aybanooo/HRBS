<?php
require_once("../../directories/directories.php");
require_once(__initDB__);

$sql = "SELECT accessname FROM access";
//$sql = "SELECT * FROM access";
$result = mysqli_query($conn, $sql);

$list = [];

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    array_push($list, $row['accessname']);
  }
} else {
    echo json_encode(false);    
}

$output->output['data'] = $list;

echo $output->setSuccessful(1);

//header('Location: /Thesis/Proto/scratch.php');
?>