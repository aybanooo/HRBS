<?php

//rooter ay yung mismong pinaka mataas na directory
define('__ROOTER__', dirname(dirname(dirname(dirname(dirname(__FILE__))))));
define('__public_assets__', __ROOTER__.'/public_assets');
define('__modules__', __public_assets__.'/modules');
define('__modules_php__', __modules__.'/php');

define('__dbCreds__', __modules_php__.'/database/dbCreds.php');
define('__outputHandler__', __modules_php__.'/outputHandler/outputHandler.php');




?>