<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__validations__);
require_once(__format__);

checkRequiredGETval("acid", true);

$acid = $_GET['acid'];

prepareForSQL($conn, $acid, 1);

$tempData = [];

if($result = mysqli_query($conn, "SELECT * FROM accesspermission WHERE accessId=$acid") ) {
  if(mysqli_num_rows($result) > 0) {
    #$tempData = mysqli_fetch_all($result, MYSQLI_ASSOC);
    while($r = mysqli_fetch_assoc($result)) {
      if(isset($tempData['id'])) {
        $tempData['perms'][$r['permId']] = filter_var(zeroToEmpty($r['val']), FILTER_VALIDATE_BOOLEAN);
      } else {
        $tempData['id'] = $r['accessId'];
        $tempData['perms'][$r['permId']] =  filter_var(zeroToEmpty($r['val']), FILTER_VALIDATE_BOOLEAN);
      }
    }
  }
}

$output->output['data'] = $tempData;

echo $output->setSuccessful();
?>
