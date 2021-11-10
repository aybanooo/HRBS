<?php

$phpDIR = dirname(__FILE__,3);

require_once("$phpDIR/directories/directories.php");
require_once(__initDB__);
require_once(__F_VALIDATIONS__);
require_once(__F_FORMAT__);
require_once(__F_FORMAT_INPUT__);
require_once(__F_PERMISSION_HANDLER__);

checkPermission(__V_P_VOUCHERS_MANAGE__, 1);

$sql = "";

foreach($_POST['code'] as &$code) {
    prepareForSQL($conn, $code);
    $sql .= "DELETE FROM `promotion` where promoCode='$code';";
}


if(mysqli_multi_query($conn, $sql)) {
    echo $output->setSuccessful("Voucher/s have been deleted successfuly");
} else {
    echo $output->setFailed("Something went wrong while deleting the records.", mysqli_error($conn));
}


?>