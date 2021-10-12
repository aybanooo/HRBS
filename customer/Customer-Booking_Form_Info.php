<?php
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
  $output->setFailed("Cannot connect to database.".$conn->connect_error);
  echo $output->getOutput(true);
  die();
}

$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$contact = $_POST['cnumber'];
$email = $_POST['email'];
$roomName = $_POST['roomName'];


$sql = "INSERT INTO customer (fname, lname, contact, email) VALUES('$firstName', '$lastName', '$contact', '$email');";

if (mysqli_query($conn, $sql)) {
	echo "New record has been added.";
}
else{
	echo "ERROR: ".mysqli_error($conn);
}

?>