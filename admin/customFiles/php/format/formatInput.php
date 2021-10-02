<?php


$phpDIR = dirname(__FILE__,2);
require_once("$phpDIR/directories/directories.php");

function convertToServerTime(&$datetime) {
    $datetime =  date('Y-m-d H:i:s', strtotime($datetime));
}

function setEmptyVarsToZero(&$var) {
    $var = empty($var) ? 0 : $var;
}

function limitChars(&$var, $length = 0) {
    $var = substr($var, 0, $length);
}

?>