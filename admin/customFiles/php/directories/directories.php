<?php

//root director kung nasaan yung index.html para sa admin
define('__ROOT__', dirname(dirname(dirname(dirname(__FILE__)))));
define('__ROOTER__', dirname(__ROOT__));
define('__userControls__', __ROOT__.'/customFiles/php/database/userControls/');
define('__roleControls__', __ROOT__.'/customFiles/php/database/roleControls/');
define('__dbCreds__', __ROOT__."/customFiles/php/database/dbCreds.php");
define('__SHDP__', __ROOT__."/customFiles/php/SHDP/simple_html_dom.php");
define('__profilePictures__', __ROOT__."/assets/images/profilePictures/");
define('__defaults__', __ROOT__."/assets/images/defaults/");

define('__rooms__', __ROOTER__.'/rooms/');

define('__outputHandler__', __ROOT__.'/customFiles/php/outputHandler/outputHandler.php');

?>