<?php

$phpDIR = dirname(__FILE__,3);

require_once("$phpDIR/directories/directories.php");
require_once(__initDB__);
require_once(__validations__);
require_once(__formatInput__);

mysqli_report(MYSQLI_REPORT_STRICT);

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