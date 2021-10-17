<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__validations__);

if(!( isset($_POST["accountList"]) )) {
  exit;
}

checkRequiredPOSTval("accountList");

$accs = $_POST["accountList"];

foreach ($accs as $value) {
  $filename = $value.".jpg";
  if (file_exists(__profilePictures__.$filename)) {
      unlink(__profilePictures__.$filename);
      //echo 'File '.$filename.' has been deleted';
  } else {
      //echo 'Could not delete '.$filename.', file does not exist';
  }
}

function boolToCheck($value) {
    return $value ? 'checked': '';
}

// sql to delete a record
$sql = "DELETE from employee WHERE empID IN (".implode(",", $accs).");";


if (mysqli_query($conn, $sql)) {
  if(mysqli_affected_rows($conn) > 0) 
    echo $output->setSuccessful("Records have been deleted");
  else
    echo $output->setSuccessful("Nothing to delete");
} else {
  echo $output->setFailed("Failed to delete accounts");
}

//header('Location: /Thesis/Proto/scratch.php');
?>