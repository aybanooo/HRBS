<?php

require_once('../../directories/directories.php');
require_once(__dbCreds__);
require_once(__F_OUTPUT_HANDLER__);

#echo $output->getOutput(true);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  $output->setFailed("Cannot connect to database.".$conn->connect_error);
  echo $output->getOutput(true);
  die();
}


#lagay mo na codes mo

?>