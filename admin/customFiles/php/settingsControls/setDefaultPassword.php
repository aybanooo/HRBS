<?php

require_once(dirname(__FILE__, 2)."/directories/directories.php");
require_once __initDB__;
require_once __format__;
require_once __validations__;

if(!isPassFormat($_POST['inp-defPass']))
    echo $output->setFailed(testPass($_POST['inp-defPass']));

$defVal = password_hash($_POST['inp-defPass'], PASSWORD_DEFAULT);

if(mysqli_query($conn, "ALTER TABLE `empaccountdetails` ALTER COLUMN `password` SET DEFAULT '$defVal';")) {
    echo $output->setSuccessful("Default password have been updated");
} else {
    echo $output->setFailed("Something went wrong while updating the default password");
}

?>