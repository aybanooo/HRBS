<?php

require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __F_OUTPUT_HANDLER__;
require_once __F_DB_HANDLER__;
require_once __F_FORMAT__;
require_once __F_VALIDATIONS__;
require_once __F_PERMISSION_HANDLER__;
checkAdminSideAccess();

checkPermission(__V_P_BILLING_MANAGE__, true);

function saveTax() {
    $tempConn = createTempDBConnection();
    if(!isset($_POST['inp-tax'])) 
        return;
    $tax = $_POST['inp-tax'];
    (!is_numeric($tax)) && die($GLOBALS['output']->setFailed('Tax should be a number'));
    $tax = intval($tax);
    ($tax>100 || $tax<0) && die($GLOBALS['output']->setFailed('Tax should be between 0 and 100'));
    if(!mysqli_query($tempConn, "UPDATE `settings` SET `value`=$tax WHERE `name`='tax' LIMIT 1;"))
        die($GLOBALS['output']->setFailed('Something went wrong while saving tax', getConnError($tempConn)));
    mysqli_close($tempConn);
}

function saveSrvcCharge() {
    $tempConn = createTempDBConnection();
    if(!isset($_POST['inp-srvc_charge'])) 
        return;
    $srvc_charge = $_POST['inp-srvc_charge'];
    (!is_numeric($srvc_charge)) && die($GLOBALS['output']->setFailed('Service Charge should be a number'));
    $srvc_charge = intval($srvc_charge);
    ($srvc_charge>100 || $srvc_charge<0) && die($GLOBALS['output']->setFailed('Service Charge should be between 0 and 100'));
    if(!mysqli_query($tempConn, "UPDATE `settings` SET `value`=$srvc_charge WHERE `name`='serviceCharge' LIMIT 1;"))
        die($GLOBALS['output']->setFailed('Something went wrong while saving service charge', getConnError($tempConn)));
    mysqli_close($tempConn);
}

saveTax();
saveSrvcCharge();

echo $output->setSuccessful('Changes have been saved');

?>