<?php

require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_OUTPUT_HANDLER__;
require_once __F_LOGIN_HANDLER__;
require_once __F_FORMAT__;

//--------------- PERMISSION LIST ---------------

/*
SELECT A.*, B.name FROM `permissions` A LEFT JOIN `permissionscategory` B ON A.category=B.categoryID ORDER BY `category`;
+--------+----------------------+----------+-----------+
| permID | name                 | category | name      |
+--------+----------------------+----------+-----------+
|     21 | Manage Reservations  |        0 | NULL      |
|     20 | General Testing      |        0 | NULL      |
|      1 | Manage Rooms         |        1 | Rooms     |-
|     23 | Manage Room Numbers  |        1 | Rooms     |-
|     24 | Manage Room Status   |        1 | Rooms     |-
|     11 | Manage amenities     |        2 | Amenities |-
|     19 | Manage Vouchers      |        3 | Vouchers  |
|      7 | Add accounts         |        4 | Accounts  |-
|     22 | Change Account Role  |        4 | Accounts  |-
|      8 | Delete accounts      |        4 | Accounts  |-
|     10 | Manage roles         |        4 | Accounts  |-
|      9 | Reset password       |        4 | Accounts  |-
|     18 | Modify Location      |        5 | Webpage   |
|     17 | Modify Display       |        5 | Webpage   |
|     16 | Modify Social Media  |        5 | Webpage   |
|     14 | Modify Company Logo  |        5 | Webpage   |
|     13 | Modify Page Cover    |        5 | Webpage   |
|     12 | Modify company name  |        5 | Webpage   |
|     15 | Modify Contact Info  |        5 | Webpage   |
+--------+----------------------+----------+-----------+
*/

// Rooms permission
define('__V_P_ROOMS_MANAGE__', explode(',',
'1' ));
define('__V_P_ROOMS_MANAGE_NUMBERS__', explode(',',
'23' ));
define('__V_P_ROOMS_MANAGE_STATUS__', explode(',',
'24' ));

// Amenities permission
define('__V_P_AMENITIES_MANAGE__', explode(',',
'11' ));

// Roles permission
define('__V_P_ROLES_MANAGE__', explode(',',
'10' ));

// Account permission
define('__V_P_ACCOUNT_CREATE__', explode(',',
'7' ));
define('__V_P_ACCOUNT_DELETE__', explode(',',
'8' ));
define('__V_P_ACCOUNT_RESET_PASS__', explode(',',
'9' ));
define('__V_P_ACCOUNT_CHANGE_ROLE__', explode(',',
'22' ));

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