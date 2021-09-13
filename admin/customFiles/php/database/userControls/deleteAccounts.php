<?php
require_once("../../directories/directories.php");
require_once(__dbCreds__);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if(!( isset($_POST["accountList"]) && isset($_POST["rawAccList"]) )) {
  exit;
}

$accs = json_decode($_POST["rawAccList"]);

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
$sql = "DELETE from employee WHERE empID IN ".$_POST["accountList"].";";

$status = 1;

if ($conn->query($sql) === TRUE) {
  if($conn->affected_rows <= 0) 
      $status = 0;
} else {
  $status = 0;
}
echo $status;

mysqli_close($conn);

//header('Location: /Thesis/Proto/scratch.php');



?>