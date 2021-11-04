<?php

use PHPMailer\PHPMailer\POP3;

require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __initDB__;
require_once __F_FORMAT__;
require_once __AUTOLOAD_PUBLIC__;

use \Firebase\JWT\JWT;


$empId = prepareForSQL($conn, $_POST['inp-empID'], 3);
$pass = $_POST['inp-password'];

if(mysqli_num_rows($result = mysqli_query($conn, "SELECT `password` FROM `empaccountdetails` WHERE `empID`=$empId LIMIT 1;")) != 1) {
    echo $output->setFailed('Invalid ID');
    die();
}



define('FETCHED_PASS',  mysqli_fetch_all($result, MYSQLI_NUM)[0][0]);
if(password_verify($pass, FETCHED_PASS)) {
    //start session

    // JWT shits
    $tempKey = '';
    $issuedAt   = new DateTimeImmutable();
    $expire     = $issuedAt->modify('+6 minutes')->getTimestamp();
    $serverName = "hrbs.hotel";
    $username   = $empId;

    $data = [
        'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
        'iss'  => $serverName,                       // Issuer
        'nbf'  => $issuedAt->getTimestamp(),         // Not before
        'exp'  => $expire,                           // Expire
        'userName' => $username,                     // User name
    ];

    echo JWT::encode(
        $data,
        $tempKey,
        'HS512'
    );
    
} else {
    //give error
    echo $output->setFailed('Invalid Credentials');
    die();
}



die();

echo $output->setSuccessful('Valid');

?>