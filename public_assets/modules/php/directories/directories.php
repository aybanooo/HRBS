<?php

//root director kung nasaan yung index.html para sa admin
define('__D_ROOT__', dirname(__FILE__,5));

// auto switch prvt dir
$prvtdir = dirname(__D_ROOT__)."/private/";
$prvtdir = !file_exists($prvtdir) ? __D_ROOT__."/test_files/" : $prvtdir; 
define('__PRVT_F_ROOT__', $prvtdir);
unset($prvtdir);

//----- Public assets constants --------
define('__D_PUBLIC_ASSETS__', __D_ROOT__.'/public_assets/');
define('__D_ROOMS__', __D_PUBLIC_ASSETS__.'rooms/');
define('__D_AMENITIES__', __D_PUBLIC_ASSETS__.'amenities/');
define('__D_PUBLIC_IMAGES__', __D_PUBLIC_ASSETS__.'images/');
define('__D_PUBLIC_DEFAULTS__', __D_PUBLIC_ASSETS__.'defaults/');
define('__D_PUBLIC_PHP__', __D_PUBLIC_ASSETS__.'modules/php/');
define('__D_DB_CONTORLS__', __D_PUBLIC_PHP__.'database/dbControls/');
define('__D_RSV_CONTORLS__', __D_PUBLIC_PHP__.'database/reservationControls/');
define('__D_UI__', __D_PUBLIC_PHP__.'UI/');

//----- Handlers -----
define('__F_DB_HANDLER__', __D_DB_CONTORLS__."dbHandler.php");
define('__F_RSV_HANDLER__', __D_RSV_CONTORLS__."reservationHandler.php");

//----- I/O constants --------
define('__F_OUTPUT_HANDLER__', __D_PUBLIC_PHP__.'outputHandler/outputHandler.php');
define('__F_FORMAT_INPUT__', __D_PUBLIC_PHP__.'format/formatInput.php');
define('__F_FORMAT__', __D_PUBLIC_PHP__.'format/format.php');
define('__F_FORMAT_IMAGE__', __D_PUBLIC_PHP__.'format/formatImage.php');
define('__F_VALIDATIONS__', __D_PUBLIC_PHP__.'database/validations/validations.php');

//----- UI constants --------

//----- Gens ------

//----- Configs ------
define('__CONF_DB__', __PRVT_F_ROOT__."db.ini"); #This contains database credentials
define('__CONF_PRIVATE__', __PRVT_F_ROOT__."private.ini"); #This contains private keys and stuff
define('__CONF_SYSTEM__', __PRVT_F_ROOT__."system.ini"); #This contains the system/hotel stuff
define('__CONF_DMODE__', __PRVT_F_ROOT__."dmode.ini"); #For developers
define('__CONF_DMODE_PARSED__', parse_ini_file(__CONF_DMODE__)['dmode']); #For developers
define('__CONF_GAPI_CRDS__', __PRVT_F_ROOT__."thesis-331607-94c600763d0c.json"); #for google analytics. service account

//----- Handlers -----

//----- Autoload -----
define('__AUTOLOAD_PUBLIC__', __D_PUBLIC_ASSETS__.'vendor/autoload.php'); 

define('__F_BASE_CUSTOMER__', "<base href='".$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/customer/'>");

date_default_timezone_set('Asia/Manila');

return;
#the ff succeeding  are for debuging
?>

<pre>
    <?php
        echo json_encode(get_defined_constants(true)['user']);
    ?>
</pre>