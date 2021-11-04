<?php
require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __AUTOLOAD_PUBLIC__;
require_once __F_FORMAT__;
use \Firebase\JWT\JWT;

$ini = array_merge(parse_ini_file(__CONF_PRIVATE__), parse_ini_file(__CONF_SYSTEM__));

function isLoginTokenExpired() {
    #(session_status() !== PHP_SESSION_ACTIVE) && session_start();
    #echo "Started";
    try {
        $token = JWT::decode($_COOKIE['authkn'], $GLOBALS['ini']['JWT_KEY'], ['HS512']);
    } catch(\Firebase\JWT\ExpiredException $e) {
        #return $e->getMessage();
        return true;
    }
    $now = new DateTimeImmutable();
    $serverName = $GLOBALS['ini']['CLIENT_DOMAIN_NAME'];

    if ($token->iss !== $serverName ||
        $token->nbf > $now->getTimestamp() ||
        $token->exp < $now->getTimestamp())
    {
        return true; 
    }
    return false;
}

function isTokenValid() {
    if (!isset($_COOKIE['authkn'])) return False;
    return !isLoginTokenExpired();
}

function setupUserSession() {
    try {
        $token = JWT::decode($_COOKIE['authkn'], $GLOBALS['ini']['JWT_KEY'], ['HS512']);
    } catch(\Firebase\JWT\ExpiredException $e) {
        #return $e->getMessage();
    }
    $_SESSION['id'] = tonotwtf($token->id, 5);
}

?>