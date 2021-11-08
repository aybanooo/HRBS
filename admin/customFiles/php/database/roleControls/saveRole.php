<?php
require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once(__initDB__);
require_once __F_VALIDATIONS__;
require_once __F_FORMAT__;
require_once __F_DB_HANDLER__;
require_once __F_PERMISSION_HANDLER__;

checkPermission(__V_P_ROLES_MANAGE_, true);

#echo json_encode($_POST);

checkRequiredPOSTval("acid, perms");
$sql = "";

$accessID = $_POST['acid'];
prepareForSQL($conn, $accessID, 1);

$tempKeyList = array_keys($_POST['perms']);
$formatedPerms = [];
#print_r($_POST['perms']);
try {
    foreach($tempKeyList as $oldKey) {
        prepareForSQL($conn, $oldKey, 1);
        $newKey = $oldKey;
        $tempVal = $_POST['perms'][$oldKey];
        prepareForSQL($conn, $tempVal, 0);
        $formatedPerms[$newKey] = $tempVal;
    }
} catch (Exception $e) {
    echo $output->setFailed("Something went wrong while saving.");
    die();
}

#print_r($_POST['perms']);

#$sql = 'SELECT employee.empID, employee.accessID,COUNT(permissions.permId) FROM `employee` INNER JOIN `access` ON employee.accessID=access.accessID INNER JOIN `accesspermission` ON access.accessID=accesspermission.accessId INNER JOIN `permissions` ON accesspermission.permId=permissions.permID WHERE accesspermission.val=1 && permissions.category=4 GROUP BY employee.empID HAVING COUNT(permissions.permId)=(SELECT COUNT(*) FROM `permissionscategory` A INNER JOIN `permissions` B ON A.categoryID=B.category WHERE A.categoryID=4);';
/*
$sql = 'SELECT employee.empID, employee.accessID,COUNT(permissions.permId) FROM `employee` 
INNER JOIN `access` ON employee.accessID=access.accessID 
INNER JOIN `accesspermission` ON access.accessID=accesspermission.accessId 
INNER JOIN `permissions` ON accesspermission.permId=permissions.permID 
WHERE accesspermission.val=1 && permissions.category=4 
GROUP BY employee.empID 
HAVING COUNT(permissions.permId) = (
    SELECT COUNT(*) FROM `permissionscategory` A 
    INNER JOIN `permissions` B ON A.categoryID=B.category 
    WHERE A.categoryID=4
);';
*/

if(getFFACount_change($accessID, $_POST['perms'])==0) {
    echo $output->setFailed("Atleast 1 role must have full account management access");
    die();
}

if(getFFAUserCount_change($accessID, $_POST['perms'])==0) {
    echo $output->setFailed("Atleast 1 account must have full account management access");
    die();
}

#print_r($formatedPerms);

#die();

foreach($formatedPerms as $permID => &$val) {
    prepareForSQL($conn, $val, 0);
    $sql .= "UPDATE accesspermission SET val=$val WHERE accessId=".$accessID." && permId=$permID;\n";
}   

if(mysqli_multi_query($conn, $sql)) {
    #echo "AF rows: ".mysqli_affected_rows($conn);
    echo $output->setSuccessful("Changes have been sucessfuly saved.");
} else {
    echo $output->setFailed("Something went wrong while saving.");
}

?>