<?php

require_once("../directories/directories.php");
require_once __F_VALIDATIONS__;
checkAdminSideAccess();
$filename = '../../../assets/customCSS/overrideStyle.css';
$default = "/* Enter your custom style here*/
/* Don't forget to put \"!important\" to override styles */";

if (file_exists($filename)) {
    //echo "The file $filename exists";
    $content = file_get_contents($filename);
    if(empty($content)) {
        echo $content;
    }
    echo file_get_contents($filename);
} else {
    $styleFile = fopen($filename, "w");
    fwrite($styleFile, $default);
    fclose($styleFile);
    echo file_get_contents($filename);
    //echo "The file $filename does not exist";
}

?>