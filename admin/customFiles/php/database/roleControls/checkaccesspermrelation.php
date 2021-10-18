<?php

require_once(dirname(__FILE__,3).'/directories/directories.php');
require_once(__validations__);
require_once(__gen__);
require_once(__initDB__);


$currAccessPermissions = [];
$allPermissions = [];


if(mysqli_num_rows($result = mysqli_query($conn, "SELECT A.accessID, GROUP_CONCAT(B.permId) as permIDs FROM access A LEFT JOIN accesspermission B ON A.accessID=B.accessId GROUP BY A.accessID;")) > 0) {
  #$temp =  json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
  while($r = mysqli_fetch_assoc($result)) {
    $currAccessPermissions[$r['accessID']] = explode(",", $r['permIDs']);
  }
}

if(mysqli_num_rows($result = mysqli_query($conn, "SELECT permID from `permissions`;")) > 0) {
  while($r = mysqli_fetch_assoc($result)) {
    array_push($allPermissions, $r['permID']);
  }
}

foreach($currAccessPermissions as $accessID => $permCollection) {
  $dif[$accessID] = array_values(array_diff($allPermissions, $permCollection));
}

$sql = "";
foreach($dif as $accessID => &$missingPermissions) {
  foreach($missingPermissions as $permIDs) {
    $sql .= "INSERT INTO `accesspermission` (`accessId`, `permId`, `val`) VALUES ($accessID,  $permIDs, '0');";
  }
}

if(empty($sql)) {
  die('"Form is emptiness, emptiness is form" — The Heart Sutra');
} else {
  if (mysqli_multi_query($conn, $sql)) {
    do {
      /* store the result set in PHP */
      if ($result = mysqli_store_result($conn)) {
          while ($row = $result->fetch_row()) {
              #printf("%s\n", $row[0]);
          }
      }
      /* print divider */
      if (mysqli_more_results($conn)) {
          #printf("-----------------\n");
      }
    } while (mysqli_next_result($conn));
  } else {
    echo $output->setFailed('Failed to create permission relation', mysqli_error($conn));
    die();
  }
}
?>