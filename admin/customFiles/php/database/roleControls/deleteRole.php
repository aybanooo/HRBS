<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once __F_VALIDATIONS__;
require_once __F_PERMISSION_HANDLER__;

checkPermission(__V_P_ROLES_MANAGE_, true);

$acid = prepareForSQL($conn, $_POST["delid"]);

if(getFFACount_change($acid)==0) {
  echo $output->setFailed("Atleast 1 role must have full account management access");
  die();
}
if(getFFAUserCount_change($acid)==0) {
    echo $output->setFailed("Atleast 1 account must have full account management access");
    die();
}
#die();
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