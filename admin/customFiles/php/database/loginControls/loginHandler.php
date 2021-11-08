<?php
require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __AUTOLOAD_PUBLIC__;
require_once __F_DB_HANDLER__;
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

function tokenEmpIDexist() {
    $tempConn = createTempDBConnection();
    $userID = getUserInfoFromToken($_COOKIE['authkn'])->id;
    prepareForSQL($tempConn, $userID);
    $exists = mysqli_fetch_all(mysqli_query($tempConn, "SELECT COUNT(DISTINCT empID)=1 from `employee` WHERE empID=$userID;"))[0][0];
    toPhpBool($exists);
    mysqli_close($tempConn);
    return $exists;
}

function checkUserExistence() {
    if(!tokenEmpIDexist()) {
        header("Location: /admin/logout");
    }
}

function setupUserSession($token = null) {
    if($token === null) {
        try {
            $token = JWT::decode($_COOKIE['authkn'], $GLOBALS['ini']['JWT_KEY'], ['HS512']);
        } catch(\Firebase\JWT\ExpiredException $e) {
            #return $e->getMessage();
            header("Location: /admin/logout");
        }
        $userInfo  = json_decode(tonotwtf($token->userInfo, 5));
    } else {
        $userInfo  = json_decode(tonotwtf($token, 5));
    }
    $_SESSION['userInfo'] = $userInfo;
}

function decodeLoginToken($token, $asArray = false) {
    $token = JWT::decode($token, $GLOBALS['ini']['JWT_KEY'], ['HS512']);
    if($asArray) $token = (array)$token;
    return $token;
}

function getUserInfoFromToken($token) {
    $token = JWT::decode($token, $GLOBALS['ini']['JWT_KEY'], ['HS512']);
    $userInfo = json_decode(tonotwtf($token->userInfo,5));
    return $userInfo;
}

?>