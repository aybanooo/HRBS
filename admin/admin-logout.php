<?php

require_once("customFiles/php/directories/directories.php");

$ini = parse_ini_file(__CONF_SYSTEM__);

setcookie(
    "authkn", 
    'sad', [
    'expires' => 1,
    'path' => '/admin/',
    'domain' => $ini['CLIENT_DOMAIN_NAME'],
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict',
]);
header("Refresh:0; url=/admin/");
?>