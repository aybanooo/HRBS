<?php
require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __AUTOLOAD_PUBLIC__;

use \Firebase\JWT\JWT;

$secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
$token = JWT::decode($_COOKIE['authkn'], $confPrivate['JWT_KEY'], ['HS512']);
$now = new DateTimeImmutable();
$serverName = $confPrivate['CLIENT_DOMAIN_NAME'];

if ($token->iss !== $serverName ||
    $token->nbf > $now->getTimestamp() ||
    $token->exp < $now->getTimestamp())
{
    header('HTTP/1.1 401 Unauthorized');
    exit;
}
?>