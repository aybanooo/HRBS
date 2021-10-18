<?php
require_once("../../directories/directories.php");
require_once(__initDB__);


if ($result = mysqli_query($conn, "DELETE FROM access WHERE accessID=".$_POST["delid"]." LIMIT 1;")) {
    if(mysqli_affected_rows($conn) == 1) 
        echo $output->setSuccessful('Role have been deleted sucessfuly');
    else 
      echo $output->setSuccessful('Nothing has been deleted');
} else {
  echo $output->setFailed('Something went wrong while deleting roles');
}

mysqli_close($conn);

?>