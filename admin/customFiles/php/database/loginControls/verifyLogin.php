<?php

require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __initDB__;
require_once __F_FORMAT__;
require_once __F_LOGIN_HANDLER__;
require_once __AUTOLOAD_PUBLIC__;

use \Firebase\JWT\JWT;

$empId = prepareForSQL($conn, $_POST['inp-empID'], 3);
$pass = $_POST['inp-password'];

// This single if checks if the empId input admin and then creates a login token for admin then end the script
if($empId=='admin') {
    $tempConForAdmin = createTempDBConnection();
    define('FETCHED_PASS_ADMIN', mysqli_fetch_all(mysqli_query($tempConForAdmin, "SELECT `value` FROM `settings` WHERE `name` LIKE 'adminPass' LIMIT 1;"))[0][0]);
    $isAdmin = intval(password_verify($pass, FETCHED_PASS_ADMIN));

    $userInfo['id'] = 'admin'; 
    $userInfo['first_name'] = 'admin'; 
    $userInfo['last_name'] = ''; 
    $userInfo['acid'] = 'admin'; 
    $userInfo['acname'] = 'admin'; 
    $userInfo['contact_number'] = 'admin';
    
    // JWT shits
    $tempKey = $ini['JWT_KEY'];
    $issuedAt   = new DateTimeImmutable();
    $expire     = (time() + (1800));
    $serverName = $ini['CLIENT_DOMAIN_NAME'];
    $userInfo = towtf(json_encode($userInfo), 5);

    $data = [
        'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
        'iss'  => $serverName,                       // Issuer
        'nbf'  => $issuedAt->getTimestamp(),         // Not before
        'exp'  => $expire,                           // Expire
        'userInfo' => $userInfo,                     // User information
    ];
    setcookie(
        "authkn", 
        JWT::encode(
            $data,
            $tempKey,
            'HS512'
        ), [
        'expires' => (time() + (1800)),
        'path' => '/admin/',
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    
    session_start();
    setupUserSession($userInfo);
    $output->output['data'] = "https://{$ini['CLIENT_DOMAIN_NAME']}/admin/";
    echo $output->setSuccessful();
    die();
}

if(mysqli_num_rows($result = mysqli_query($conn, "SELECT `password` FROM `empaccountdetails` WHERE `empID`=$empId LIMIT 1;")) != 1) {
    echo $output->setFailed('Invalid ID');
    die();
}

$ini = parse_ini_file(__CONF_SYSTEM__);

if (session_status() === PHP_SESSION_ACTIVE) {
    # not yet done
    header("Location: https://{$ini['CLIENT_DOMAIN_NAME']}/admin/");
}

// This single if checks if the empId input user and then creates a login token for user
define('FETCHED_PASS',  mysqli_fetch_all($result, MYSQLI_NUM)[0][0]);
if(password_verify($pass, FETCHED_PASS)) {
    // Load jwt key
    $ini = array_merge(parse_ini_file(__CONF_PRIVATE__), $ini);

    // Get user info
    if(mysqli_num_rows($result = mysqli_query($conn, "SELECT A.*, B.accessname FROM `employee` A INNER JOIN `access` B ON A.accessID=B.accessID WHERE `empID`=$empId LIMIT 1;")) != 1) {
        echo $output->setFailed('Cannot find account details.');
        die();
    }

    $tempUserInfo =  mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
    $userInfo['id'] = $tempUserInfo['empID']; 
    $userInfo['first_name'] = $tempUserInfo['fName']; 
    $userInfo['last_name'] = $tempUserInfo['lName']; 
    $userInfo['acid'] = $tempUserInfo['accessID']; 
    $userInfo['acname'] = $tempUserInfo['accessname']; 
    $userInfo['contact_number'] = $tempUserInfo['contact']; 

    // JWT shits
    $tempKey = $ini['JWT_KEY'];
    $issuedAt   = new DateTimeImmutable();
    $expire     = (time() + (43200));
    $serverName = $ini['CLIENT_DOMAIN_NAME'];
    $userInfo = towtf(json_encode($userInfo), 5);

    $data = [
        'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
        'iss'  => $serverName,                       // Issuer
        'nbf'  => $issuedAt->getTimestamp(),         // Not before
        'exp'  => $expire,                           // Expire
        'userInfo' => $userInfo,                     // User information
    ];

    setcookie(
        "authkn", 
        JWT::encode(
            $data,
            $tempKey,
            'HS512'
        ), [
        'expires' => (time() + (43200)),
        'path' => '/admin/',
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
    
    session_start();
    setupUserSession($userInfo);
    $output->output['data'] = "https://{$ini['CLIENT_DOMAIN_NAME']}/admin/";
    echo $output->setSuccessful();
} else {
    //give error
    echo $output->setFailed('Invalid Credentials');
    die();
}

die();
?>