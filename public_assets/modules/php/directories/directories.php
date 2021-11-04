<?php

//rooter ay yung mismong pinaka mataas na directory
define('__D_ROOT__', dirname(dirname(dirname(dirname(dirname(__FILE__))))));
define('__D_PUBLIC_ASSETS__', __D_ROOT__.'/public_assets');
define('__modules__', __D_PUBLIC_ASSETS__.'/modules');
define('__modules_php__', __modules__.'/php');

define('__dbCreds__', __modules_php__.'/database/dbCreds.php');
define('__F_OUTPUT_HANDLER__', __modules_php__.'/outputHandler/outputHandler.php');




?>