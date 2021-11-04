<?php

$phpDIR = dirname(__FILE__, 2);

require_once("$phpDIR/directories/directories.php");
require_once(__F_OUTPUT_HANDLER__);

$ini = array_merge(parse_ini_file(__CONF_DB__), parse_ini_file(__CONF_PRIVATE__));
mysqli_report(MYSQLI_REPORT_STRICT);

// Create connection
try {
$conn = new mysqli($ini['DB_SERVERNAME'], $ini['DB_USERNAME'], $ini['DB_PASS'], $ini['DB_NAME']);
} catch (mysqli_sql_exception $e) {
    $output->setFailed("Cannot connect to database.");
    echo $output->getOutput(true);
    die();
}

// Check connection
if ($conn->connect_error) {
    $output->setFailed("Cannot connect to database.".$conn->connect_error);
    //echo $output->getOutput(true);
    die();
}

unset($ini);
?>