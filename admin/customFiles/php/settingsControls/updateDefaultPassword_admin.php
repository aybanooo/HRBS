<?php

require_once(dirname(__FILE__,2)."/directories/directories.php");
require_once __initDB__;
require_once __F_FORMAT__;
require_once __F_VALIDATIONS__;
require_once __F_DB_HANDLER__;
checkAdminSideAccess();

$ini = parse_ini_file(__CONF_PRIVATE__);

$currPass = $_POST['inp-oldPass'];
$newPass = $_POST['inp-newPass'];
$newRePass = $_POST['inp-newRePass'];

if($newRePass!==$newPass) {
    echo $output->setFailed("Password doesn't match");
    die();
}

define('FETCHED_PASS_ADMIN', mysqli_fetch_all(mysqli_query($conn, "SELECT `value` FROM `settings` WHERE `name`='adminPass' LIMIT 1;"))[0][0]);

$passwordMatched = password_verify($currPass, FETCHED_PASS_ADMIN);

if($passwordMatched) {
    //check new password format and if it repeated password matched 
    $hashedPass = password_hash($newPass, PASSWORD_DEFAULT);
    prepareForSQL($conn, $hashedPass);
    if(mysqli_query($conn, "REPLACE INTO `settings` values('adminPass', '$hashedPass', 3);")) {
        echo $output->setSuccessful('Admin password has been updated');
    } else {
        echo $output->setFailed('Something went wrong while updating the password');
    }
} else {
    echo $output->setFailed('Current password is incorrect');
}
?>