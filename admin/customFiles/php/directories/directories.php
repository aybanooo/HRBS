<?php

//root director kung nasaan yung index.html para sa admin
define('__ROOT__', dirname(dirname(dirname(dirname(__FILE__)))));
define('__ROOTER__', dirname(__ROOT__));
define('__userControls__', __ROOT__.'/customFiles/php/database/userControls/');
define('__roleControls__', __ROOT__.'/customFiles/php/database/roleControls/');
define('__dbCreds__', __ROOT__."/customFiles/php/database/dbCreds.php");
define('__initDB__', __ROOT__."/customFiles/php/database/initializeDB.php");
define('__profilePictures__', __ROOT__."/assets/images/profilePictures/");
define('__defaults__', __ROOT__."/assets/images/defaults/");

define('__public_assets__', __ROOTER__.'/public_assets/');
define('__rooms__', __public_assets__.'rooms/');
define('__amenities__', __public_assets__.'amenities/');
define('__public_images__', __public_assets__.'images/');
define('__public_defaults__', __public_assets__.'defaults/');

//----- I/O constants --------
define('__outputHandler__', __ROOT__.'/customFiles/php/outputHandler/outputHandler.php');
define('__formatInput__', __ROOT__.'/customFiles/php/format/formatInput.php');
define('__format__', __ROOT__.'/customFiles/php/format/format.php');
define('__format_image__', __ROOT__.'/customFiles/php/format/formatImage.php');
define('__validations__', __ROOT__.'/customFiles/php/database/validations/validations.php');

//----- UI constants --------
define('__dirUI__', __ROOT__.'/customFiles/php/UI/');
define('__navigation__', __dirUI__.'navigation.php');
define('__head_contents__', __dirUI__.'commonHeadContents.php');

//----- Gens ------
define('__gen__', __ROOT__.'/customFiles/php/generate/generate.php');

//----- Configs ------
define('__CONF_DB__', __ROOTER__."/db.ini"); #This contains database credentials
define('__CONF_PRIVATE__', __ROOTER__."/private.ini"); #This contains private keys and stuffs

//----- Autoload -----
define('__AUTOLOAD_PUBLIC__', __public_assets__.'vendor/autoload.php'); 

define('__base__', "<base href='".$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/admin/'>");

$writableDIRs = [
    __profilePictures__,
    __defaults__,
    __public_assets__,
    __rooms__,
    __amenities__,
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

date_default_timezone_set('Asia/Manila');

?>