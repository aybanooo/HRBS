<?php
require_once(dirname(__FILE__, 2)."/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_OUTPUT_HANDLER__;

function getCurrency() {
    $tempConn = createTempDBConnection();    
    $currency = mysqli_fetch_all(mysqli_query($tempConn, "SELECT `value` FROM `settings` WHERE `name` like 'currency' LIMIT 1;"))[0][0];
    return $currency;
}

?>