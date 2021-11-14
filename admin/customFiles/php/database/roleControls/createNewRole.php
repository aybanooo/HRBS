<?php
require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once(__initDB__);
require_once __F_PERMISSION_HANDLER__;
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

checkPermission(__V_P_ROLES_MANAGE__, true);

function getNewUniqueName() {
  //$sql = "SELECT * FROM access";
  $list = [];

  if (mysqli_num_rows($result = mysqli_query($GLOBALS['conn'], "SELECT accessname FROM access")) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      array_push($list, $row['accessname']);
    }
  }
  $newRoleNum = 1;
  while(in_array("Role $newRoleNum", $list)) {
    $newRoleNum++;
  }
  return "Role $newRoleNum";
}

$roleName = getNewUniqueName();
#$sql = "INSERT INTO access (accessname) VALUES ('$roleName');";
//insert new role name to access table
if (mysqli_query($conn, "INSERT INTO access (accessname) VALUES ('$roleName');") === TRUE) {
  $insertID = mysqli_insert_id($conn);
  $output->setSuccessful("New role have been successfuly created.");
} else {
  #echo "Error in sql: " . $sql . "<br>" . $conn->error;
  #$conn->close();
}


include "./checkaccesspermrelation.php";
$fakeWhere = "WHERE accessID=$insertID";
#$fakeWhere = "WHERE accessID=6";#
ob_start();
include "./getNewRoleCard.php";
$card = ob_get_contents();
ob_end_clean();
$output->output['data'] = $card;

echo $output->setSuccessful('New role have been created.');
//header('Location: /Thesis/Proto/scratch.php');
?>