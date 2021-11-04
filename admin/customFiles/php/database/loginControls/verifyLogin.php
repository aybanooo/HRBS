<?php

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

$ini = parse_ini_file(__CONF_SYSTEM__);

if (session_status() === PHP_SESSION_ACTIVE) {
    # not yet done
    header("Location: https://{$ini['CLIENT_DOMAIN_NAME']}/admin/");
}

define('FETCHED_PASS',  mysqli_fetch_all($result, MYSQLI_NUM)[0][0]);
if(password_verify($pass, FETCHED_PASS)) {

    $ini = array_merge(parse_ini_file(__CONF_PRIVATE__), $ini);
    // JWT shits
    $tempKey = $ini['JWT_KEY'];
    $issuedAt   = new DateTimeImmutable();
    $expire     = (time() + (86400));
    $serverName = $ini['CLIENT_DOMAIN_NAME'];
    $id   = towtf($empId, 5);

    $data = [
        'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
        'iss'  => $serverName,                       // Issuer
        'nbf'  => $issuedAt->getTimestamp(),         // Not before
        'exp'  => $expire,                           // Expire
        'id' => $id,                     // User name
    ];

    setcookie(
        "authkn", 
        JWT::encode(
            $data,
            $tempKey,
            'HS512'
        ), [
        'expires' => (time() + (86400)),
        'path' => '/admin/',
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    $output->output['data'] = "https://{$ini['CLIENT_DOMAIN_NAME']}/admin/";
    echo $output->setSuccessful();
} else {
    //give error
    echo $output->setFailed('Invalid Credentials');
    die();
}

die();
?>