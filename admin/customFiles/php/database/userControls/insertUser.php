<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

$sql = "INSERT INTO scratchtable (username, password, name)
VALUES ('".$_POST["username"]."', '".$_POST["password"]."', '".$_POST["name"]."')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: /Thesis/Proto/scratch.php');
?>