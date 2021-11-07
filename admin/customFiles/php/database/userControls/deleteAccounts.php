<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__F_VALIDATIONS__);
require_once(__F_DB_HANDLER__);

if(!( isset($_POST["accountList"]) )) {
  echo $output->setFailed("Please select atleast 1 account");
  exit;
}

if(count($_POST["accountList"])<1)
  die($output->setFailed("Please select atleast 1 account"));

checkRequiredPOSTval("accountList");

$accs = $_POST["accountList"];
$implodedAccs = implode(",", $accs);
prepareForSQL($conn, $implodedAccs);


if(getFFAUserCount_delete_emp($implodedAccs)==0) {
  echo $output->setFailed("Atleast 1 role must have full account management access");
  die();
}

foreach ($accs as $value) {
  $filename = $value.".jpg";
  if (file_exists(__D_PROFILE_PICTURES_ADMIN__.$filename)) {
      unlink(__D_PROFILE_PICTURES_ADMIN__.$filename);
      //echo 'File '.$filename.' has been deleted';
  } else {
      //echo 'Could not delete '.$filename.', file does not exist';
  }
}

function boolToCheck($value) {
    return $value ? 'checked': '';
}

// sql to delete a record
$sql = "DELETE from employee WHERE empID IN ($implodedAccs);";


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