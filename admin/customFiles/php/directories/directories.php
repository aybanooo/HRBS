<?php

//root director kung nasaan yung index.html para sa admin
define('__D_ROOT_ADMIN__', dirname(dirname(dirname(dirname(__FILE__)))));
define('__D_ROOT__', dirname(__D_ROOT_ADMIN__));

// auto switch prvt dir
$prvtdir = dirname(__D_ROOT__)."/private/";
$prvtdir = !file_exists($prvtdir) ? __D_ROOT__."/test_files/" : $prvtdir; 
define('__PRVT_F_ROOT__', $prvtdir);
unset($prvtdir);

define('__D_PHP__', __D_ROOT_ADMIN__.'/customFiles/php/');
define('__userControls__', __D_PHP__.'database/userControls/');
define('__roleControls__', __D_PHP__.'database/roleControls/');
define('__D_LOGIN_CONTORLS__', __D_PHP__.'database/loginControls/');
define('__D_DB_CONTORLS__', __D_PHP__.'database/dbControls/');
define('__D_PERMISSION_CONTROLS__', __D_PHP__.'database/permissionControls/');
define('__dbCreds__', __D_PHP__.'database/dbCreds.php');
define('__initDB__', __D_PHP__.'database/initializeDB.php');
define('__D_PROFILE_PICTURES_ADMIN__', __D_ROOT_ADMIN__."/assets/images/profilePictures/");
define('__D_DEFAULTS_ADMIN__', __D_ROOT_ADMIN__."/assets/images/defaults/");

define('__D_PUBLIC_ASSETS__', __D_ROOT__.'/public_assets/');
define('__D_ROOMS__', __D_PUBLIC_ASSETS__.'rooms/');
define('__D_AMENITIES__', __D_PUBLIC_ASSETS__.'amenities/');
define('__D_PUBLIC_IMAGES__', __D_PUBLIC_ASSETS__.'images/');
define('__D_PUBLIC_DEFAULTS__', __D_PUBLIC_ASSETS__.'defaults/');

//----- I/O constants --------
define('__F_OUTPUT_HANDLER__', __D_PHP__.'outputHandler/outputHandler.php');
define('__F_FORMAT_INPUT__', __D_PHP__.'format/formatInput.php');
define('__F_FORMAT__', __D_PHP__.'format/format.php');
define('__F_FORMAT_IMAGE__', __D_PHP__.'format/formatImage.php');
define('__F_VALIDATIONS__', __D_PHP__.'database/validations/validations.php');

//----- UI constants --------
define('__D_UI__', __D_ROOT_ADMIN__.'/customFiles/php/UI/');
define('__F_NAVIGATION__', __D_UI__.'navigation.php');
define('__F_HEAD_CONTENTS__', __D_UI__.'commonHeadContents.php');
define('__F_MAIN_HEADER__', __D_UI__.'mainHeader.php');
define('__F_MAIN_FOOTER__', __D_UI__.'footer.php');

//----- Gens ------
define('__F_GEN__', __D_PHP__.'generate/generate.php');

//----- Configs ------
define('__CONF_DB__', __PRVT_F_ROOT__."db.ini"); #This contains database credentials
define('__CONF_PRIVATE__', __PRVT_F_ROOT__."private.ini"); #This contains private keys and stuff
define('__CONF_SYSTEM__', __PRVT_F_ROOT__."system.ini"); #This contains the system/hotel stuff
define('__CONF_DMODE__', __PRVT_F_ROOT__."dmode.ini"); #For developers
define('__CONF_DMODE_PARSED__', parse_ini_file(__CONF_DMODE__)['dmode']); #For developers
define('__CONF_GAPI_CRDS__', __PRVT_F_ROOT__."thesis-331607-94c600763d0c.json"); #for google analytics. service account

//----- Handlers -----
define('__F_LOGIN_HANDLER__', __D_LOGIN_CONTORLS__."loginHandler.php");
define('__F_DB_HANDLER__', __D_DB_CONTORLS__."dbHandler.php");
define('__F_PERMISSION_HANDLER__', __D_PERMISSION_CONTROLS__."permissionHandler.php");

//----- Autoload -----
define('__AUTOLOAD_PUBLIC__', __D_PUBLIC_ASSETS__.'vendor/autoload.php'); 

define('__F_BASE__', "<base href='".$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/admin/'>");

$writableDIRs = [
    __D_PROFILE_PICTURES_ADMIN__,
    __D_DEFAULTS_ADMIN__,
    __D_PUBLIC_ASSETS__,
    __D_ROOMS__,
    __D_AMENITIES__,
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
unset($writableDIRs);

date_default_timezone_set('Asia/Manila');

?>