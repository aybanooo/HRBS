<?php

use PHPMailer\PHPMailer\POP3;

require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __initDB__;
require_once __format__;
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
    $tempKey = '!A%D*G-KaNdRgUkXp2s5v8y/B?E(H+MbQeShVmYq3t6w9z$C&F)J@NcRfUjWnZr4u7x!A%D*G-KaPdSgVkYp2s5v8y/B?E(H+MbQeThWmZq4t6w9z$C&F)J@NcRfUjXn2r5u8x!A%D*G-KaPdSgVkYp3s6v9y$B?E(H+MbQeThWmZq4t7w!z%C*F)J@NcRfUjXn2r5u8x/A?D(G+KaPdSgVkYp3s6v9y$B&E)H@McQeThWmZq4t7w!z%C*F-JaNdRgUjXn2r5u8x/A?D(G+KbPeShVmYp3s6v9y$B&E)H@McQfTjWnZr4t7w!z%C*F-JaNdRgUkXp2s5v8x/A?D(G+KbPeShVmYq3t6w9z$C&E)H@McQfTjWnZr4u7x!A%D*G-JaNdRgUkXp2s5v8y/B?E(H+MbPeShVmYq3t6w9z$C&F)J@NcRfTjWnZr4u7x!A%D*G-KaPdSgVkXp2s5v8y/B?E(H+MbQeThWmZq3t6w9z$C&F)J@NcRfUjXn2r5u7';
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