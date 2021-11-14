<?php

require_once(dirname(__FILE__, 2)."/directories/directories.php");
require_once __initDB__;
require_once __F_FORMAT__;

if(mysqli_num_rows($result = mysqli_query($conn, "SELECT `value` FROM `settings` WHERE `name` like 'defPass' LIMIT 1;"))) {
    $output->output['data'] = tonotwtf(mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['value'], 5);
    echo $output->setSuccessful();
} else {    
    echo $output->setFailed("Something went wrong with the request.");
}
?>

