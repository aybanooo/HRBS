<?php

require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __initDB__;
require_once __AUTOLOAD_PUBLIC__;
require_once __F_FORMAT__;
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

use \Firebase\JWT\JWT;

$ini = parse_ini_file(__CONF_PRIVATE__);

// decode jwt
try {
    $token = JWT::decode($_COOKIE['authkn'], $GLOBALS['ini']['JWT_KEY'], ['HS512']);
} catch(\Firebase\JWT\ExpiredException $e) {
    #return $e->getMessage();
    header("Location: /admin/logout");
}

$userInfo  = json_decode(tonotwtf($token->userInfo, 5), true);

$currPass = $_POST['inp-oldPass'];

if(mysqli_num_rows($result = mysqli_query($conn, "SELECT `password` FROM `empaccountdetails` WHERE `empID`={$userInfo['id']} LIMIT 1;")) != 1) {
    echo $output->setFailed('Invalid ID');
    die();
}

define('FETCHED_PASS',  mysqli_fetch_all($result, MYSQLI_NUM)[0][0]);
if(password_verify($currPass, FETCHED_PASS)) {
    //check new password format and if it repeated password matched 
    if($_POST['inp-newPass'] !== ($_POST['inp-newRePass']))
        die($output->setFailed('Password do not match'));
    if(!isPassFormat($_POST['inp-newPass']))
        die( $output->setFailed(testPass($_POST['inp-newPass'])) );

    $hashedPass =  password_hash($_POST['inp-newPass'], PASSWORD_DEFAULT);

    $preparedPassword = prepareForSQL($conn, $hashedPass);

    if(mysqli_query($conn, "UPDATE `empaccountdetails` SET `password`='$preparedPassword' WHERE `empID`={$userInfo['id']} LIMIT 1;")) {
        echo $output->setSuccessful('Password has been updated');
    } else {
        echo $output->setFailed('Something went wrong while updating the password');
    }
} else {
    echo $output->setFailed('Current password is incorrect');
}
?>