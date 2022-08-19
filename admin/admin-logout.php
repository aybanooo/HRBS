<?php

require_once("customFiles/php/directories/directories.php");

$ini = parse_ini_file(__CONF_SYSTEM__);

// echo "what";

setcookie(
    "authkn", 
    'sad', [
    'expires' => 1,
    'path' => '/admin/',
    'domain' => $ini['CLIENT_DOMAIN_NAME'],
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Strict',
]);
header("Refresh:0; url=/admin/");
?>