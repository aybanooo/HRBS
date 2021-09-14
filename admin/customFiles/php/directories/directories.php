<?php

//root director kung nasaan yung index.html para sa admin
define('__ROOT__', dirname(dirname(dirname(dirname(__FILE__)))));
define('__ROOTER__', dirname(__ROOT__));
define('__userControls__', __ROOT__.'/customFiles/php/database/userControls/');
define('__roleControls__', __ROOT__.'/customFiles/php/database/roleControls/');
define('__dbCreds__', __ROOT__."/customFiles/php/database/dbCreds.php");
define('__profilePictures__', __ROOT__."/assets/images/profilePictures/");
define('__defaults__', __ROOT__."/assets/images/defaults/");

define('__public_assets__', __ROOTER__.'/public_assets/');
define('__rooms__', __public_assets__.'rooms/');

define('__outputHandler__', __ROOT__.'/customFiles/php/outputHandler/outputHandler.php');

$writableDIRs = [
    __profilePictures__,
    __defaults__,
    __public_assets__,
    __rooms__,
];

function checkDirectories() {
    global $writableDIRs;
    foreach($writableDIRs as $dir) {
        if(!file_exists($dir) || !is_dir($dir))
            mkdir($dir);    
            //echo $dir." (X)"; 
        //else                  
            //echo $dir." (/)";
        //echo "<br>";
    }
}

checkDirectories();

?>