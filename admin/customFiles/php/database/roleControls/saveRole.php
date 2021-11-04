<?php
require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once(__initDB__);
require_once __F_VALIDATIONS__;
require_once __F_FORMAT__;

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

#print_r($formatedPerms);


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