<?php

require_once("../directories/directories.php");

$filename = '../../../assets/customCSS/overrideStyle.css';

$styleFile = fopen($filename, "w");
if(empty($_POST['textContent'])) {
    $default = "/* Enter your custom style here*/
/* Don't forget to put \"!important\" to override styles */";
    echo fwrite($styleFile, $default);
}
else {
    echo fwrite($styleFile, $_POST['textContent']);
}
fclose($styleFile);

?>