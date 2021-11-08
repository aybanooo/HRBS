<?php

require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_OUTPUT_HANDLER__;
require_once __F_LOGIN_HANDLER__;
require_once __F_FORMAT__;

//--------------- PERMISSION LIST ---------------

/*
SELECT A.*, B.name FROM `permissions` A INNER JOIN `permissionscategory` B ON A.category=B.categoryID;
+--------+----------------------+----------+-----------+
| permID | name                 | category | name      |
+--------+----------------------+----------+-----------+
|      1 | Add/Delete Rooms     |        1 | Rooms     |
|      2 | Manage room thumbnai |        1 | Rooms     |
|      3 | Manage room descript |        1 | Rooms     |
|      4 | Manage room sections |        1 | Rooms     |
|      5 | Manage room general  |        1 | Rooms     |
|      6 | Manage room rates    |        1 | Rooms     |
|      7 | Add accounts         |        4 | Accounts  |
|      8 | Delete accounts      |        4 | Accounts  |
|      9 | Reset password       |        4 | Accounts  |
|     10 | Manage roles         |        4 | Accounts  |
|     11 | Manage amenities     |        2 | Amenities |
|     12 | Modify company name  |        5 | Webpage   |
|     13 | Modify Page Cover    |        5 | Webpage   |
|     14 | Modify Company Logo  |        5 | Webpage   |
|     15 | Modify Contact Info  |        5 | Webpage   |
|     16 | Modify Social Media  |        5 | Webpage   |
|     17 | Modify Display       |        5 | Webpage   |
|     18 | Modify Location      |        5 | Webpage   |
|     19 | Manage Vouchers      |        3 | Vouchers  |
|     20 | General Testing      |        0 | NULL      |
|     21 | Manage Reservations  |        0 | NULL      |
+--------+----------------------+----------+-----------+
*/

// Amenities permission
define('__V_P_AMENITIES_SAVE__', explode(',',
'11'
));

// Roles permission
define('__V_P_ROLES_MANAGE__', explode(',',
'10'
));

// Account permission
define('__V_P_ACCOUNT_CREATE__', explode(',',
'7' ));
define('__V_P_ACCOUNT_DELETE__', explode(',',
'8' ));

//--------------- PERMISSION LIST END ---------------

function checkPermission($permissionList, $dieResponse = false) {
    $userInfo = getUserInfoFromToken($_COOKIE['authkn']);
    if( !tokenEmpIDexist() )
        die($GLOBALS['output']->setFailed("You don't exist!"));
    $tempConn = createTempDBConnection();
    $userID = $userInfo->id;
    $implodedPerms = implode(',', $permissionList);
    prepareForSQL($tempConn, $userID);
    prepareForSQL($tempConn, $implodedPerms);

    $sql = "SELECT COUNT(DISTINCT B.permId)/*A.empID, B.* */ FROM `employee` A 
    INNER JOIN `accesspermission` B ON A.accessID=B.accessID 
    WHERE empID=$userID && B.val=1 && B.permId IN 
    ($implodedPerms);
    ";
    
    $userCurrPermissionCount = mysqli_fetch_all(mysqli_query($tempConn, $sql), MYSQLI_NUM)[0][0];
    $userCurrPermissionCount = intval($userCurrPermissionCount);
    mysqli_close($tempConn);
    #echo ">>".$userCurrPermissionCount;
    #echo "<br>>>".count($permissionList);
    $allowed = count($permissionList)==$userCurrPermissionCount;
    if( $dieResponse && !$allowed ) {
        die($GLOBALS['output']->setFailed("Your are not permitted to do that"));
    }
    return $allowed;
}

?>