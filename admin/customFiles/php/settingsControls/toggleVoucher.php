<?php
require_once(dirname(__FILE__,2)."/directories/directories.php");
require_once __initDB__;
require_once __F_FORMAT__;
require_once __F_VALIDATIONS__;
require_once(__F_PERMISSION_HANDLER__);

checkPermission(__V_P_VOUCHERS_MANAGE__, 1);


checkRequiredPOSTval("value");
prepareForSQL($conn, $_POST['value'], 0);

$value = $_POST['value'];

$sql = "UPDATE `settings` SET `value`='$value' WHERE `name` like 'enableVoucher'";

$boolMessage = $value ? "enabled" : "disabled";


if(mysqli_query($conn, $sql)) {
    echo $output->setSuccessful("Voucher is now $boolMessage");
} else {
    echo $output->setFailed("Unable to $boolMessage voucher.");
}

?>

