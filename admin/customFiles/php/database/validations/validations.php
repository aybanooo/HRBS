<?php

$phpDIR = dirname(__FILE__,3);

require_once("$phpDIR/directories/directories.php");
require_once(__initDB__);
require_once(__F_OUTPUT_HANDLER__);
require_once(__F_FORMAT__);


function getCurrentDateAsUTCtimestamp() {
    $sql = "SELECT UTC_TIMESTAMP() AS `timestamp` FROM DUAL LIMIT 1;";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          return $row['timestamp'];
        }
      } else {
        return "";
      }
}

function getCurrentDateOfServer() {
    $sql = "SELECT NOW() AS `timestamp` FROM DUAL LIMIT 1;";
    $result = mysqli_query($GLOBALS['conn'], $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          return $row['timestamp'];
        }
      } else {
        return "";
      }
}

function checkRequiredPOSTval($strList = null, $notEmpty = false) {
    $temp = array_map('trim', explode(',', $strList));
    foreach($temp as $val) {
        if(!isset($_POST[$val])) {
            echo $GLOBALS['output']->setFailed("Something went wrong while processing the request.", $val." is missing."); 
            die();
        }
        if($notEmpty) {
          if(empty($_POST[$val])) {
            echo $GLOBALS['output']->setFailed("Something went wrong while processing the request.", $val." is empty."); 
            die();
          }
        }
    }
    //echo "no missing\n";
}

function checkRequiredGETval($strList = null, $notEmpty = false) {
  $temp = array_map('trim', explode(',', $strList));
  foreach($temp as $val) {
      if(!isset($_GET[$val])) {
          echo $GLOBALS['output']->setFailed("Something went wrong while processing the request.", $val." is missing."); 
          die();
      }
      if($notEmpty) {
        if(empty($_GET[$val])) {
          echo $GLOBALS['output']->setFailed("Something went wrong while processing the request.", $val." is empty."); 
          die();
        }
      }
  }
  //echo "no missing\n";
}

function varsHaveEmpty($varList, $emptyStringOnly = false) {
  foreach($varList as $varEntry) {
    if($emptyStringOnly) {
     if ($varEntry === "") return True;
    } else {
      if(empty($varEntry)) return True;
    }
  }
}

function isPassFormat($str) {
  return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*?_~.])(.{8,20}$)/', $str);
  //return (ctype_alnum($str) && !preg_match('/\s/',$str) && strlen($str) >= 8);
}

function testPass($str) {
  if (!preg_match('/^(.{8,20}$)/', $str)) {
    return 'Password must be between 8 and 20 characters long.';
  }
  else if (!preg_match('/^(?=.*[A-Z])/', $str)) {
      return 'Password must contain atleast one uppercase.';
  }
  else if (!preg_match('/^(?=.*[a-z])/', $str)) {
      return 'Password must contain atleast one lowercase.';
  }
  else if (!preg_match('/^(?=.*[0-9])/', $str)) {
      return 'Password must contain atleast one digit.';
  }
  else if (!preg_match('/^(?=.*[@#$%&])/', $str)) {
      return "Password must contain special characters from @#$%&.";
  }
  return "Valid";
}


# File Uploads Validation

function check_file_uploaded_name_length ($filename)
{
    return (bool) (!(mb_strlen($filename,"UTF-8") <= 225) );
}

function check_file_type($filetype, $supportedTypes = 'image/jpg, image/jpeg, image/png') {
  $supportedTypes = array_map('trim', explode(',', $supportedTypes));
  //print_r($supportedTypes);
  //echo $filetype;
  return !in_array($filetype, $supportedTypes);
}

# File Uploads Validation END

# voucher/promo validation

function isCodeUnique($code) {
    $sql = "SELECT * FROM `promotion` WHERE promoCode like '$code'";
    if(mysqli_num_rows(mysqli_query($GLOBALS['conn'], $sql)) > 0)
        return false;
    else
        return true;
}

# voucher/promo validation end

//-------------------SETTINGS VALIDATION END-------------------

function voucherEnabled() {
  $condition = "";
  $sql = "SELECT `name`, `value`, `type` FROM `settings` WHERE `name` like 'enableVoucher' LIMIT 1;";
  if(mysqli_num_rows($result = mysqli_query($GLOBALS['conn'], $sql)) > 0) {
    while($r = mysqli_fetch_assoc($result)) {
        $condition = emptyToZero($r['value']);
    }
  }
  return $condition;
}

//-------------------SETTINGS VALIDATION END-------------------


//------------------- EMP ACCOUNT/ROLE VALIDATION-------------------

function getFutureFullAccountAccessCount($accessID, $permissions) {
  $tempConn = createTempDBConnection();
  $accountsPermissionKeys = explode(",",mysqli_fetch_all(mysqli_query($tempConn, 'SELECT GROUP_CONCAT(`permID`) FROM `permissions` WHERE `category`=4;'))[0][0]);

  // gets permissions to be turned off that is in account category
  $haveOffPermission = count(array_filter($permissions, function($val, $key) use ($accountsPermissionKeys) { 
    #echo $val." --> ".$key." = ".(in_array($key, $GLOBALS['accountsPermissionKeys']))."\n";
    return (!filter_var($val, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) && in_array($key, $accountsPermissionKeys));
  }, ARRAY_FILTER_USE_BOTH));

  print_r($accountsPermissionKeys);
  #echo $haveOffPermission."\n";

  // check if there is one false permission in account category on the post data
  // if there is one, the query below will exclude the access id (from the post)  
  $sqlConditionAccessID = $haveOffPermission > 0 ? " && access.accessId!=$accessID ": "";

  // sql to get the count of full account accessed role
  $sql = "SELECT COUNT(*) FROM (SELECT access.accessID FROM `access` 
  INNER JOIN `accesspermission` ON access.accessID=accesspermission.accessId 
  INNER JOIN `permissions` ON accesspermission.permId=permissions.permID 
  WHERE accesspermission.val=1 && permissions.category=4 $sqlConditionAccessID
  GROUP BY access.accessID HAVING COUNT(permissions.permId) = ( 
    SELECT COUNT(*) FROM `permissionscategory` A 
    INNER JOIN `permissions` B ON A.categoryID=B.category 
    WHERE A.categoryID=4 )
  ) AS countOfRows;";
  #echo $sql;

  // get count of full account accessed role
  $futureFullAccountAccessUsers = mysqli_fetch_all(mysqli_query($tempConn, $sql), MYSQLI_NUM)[0][0];
  #echo($futureFullAccountAccessUsers);
  mysqli_close($tempConn);
  return $futureFullAccountAccessUsers;
}

function getFutureFullAccountUserCount($accessID, $permissions) {
  $tempConn = createTempDBConnection();
  $accountsPermissionKeys = explode(",",mysqli_fetch_all(mysqli_query($tempConn, 'SELECT GROUP_CONCAT(`permID`) FROM `permissions` WHERE `category`=4;'))[0][0]);

  // gets permissions to be turned off that is in account category
  $haveOffPermission = count(array_filter($permissions, function($val, $key) use ($accountsPermissionKeys) { 
    #echo $val." --> ".$key." = ".(in_array($key, $GLOBALS['accountsPermissionKeys']))."\n";
    return (!filter_var($val, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) && in_array($key, $accountsPermissionKeys));
  }, ARRAY_FILTER_USE_BOTH));

  print_r($accountsPermissionKeys);
  #echo $haveOffPermission."\n";

  // check if there is one false permission in account category on the post data
  // if there is one, the query below will exclude the access id (from the post)  
  $sqlConditionAccessID = $haveOffPermission > 0 ? " WHERE B.accessID!=$accessID ": "";

  // sql to get the count of full account accessed users
  $sql = "SELECT COUNT(*) FROM (
    SELECT A.empID, B.* FROM `employee` A 
    INNER JOIN (SELECT access.accessID FROM `access` 
    INNER JOIN `accesspermission` ON access.accessID=accesspermission.accessId 
    INNER JOIN `permissions` ON accesspermission.permId=permissions.permID 
    WHERE accesspermission.val=1 && permissions.category=4  && access.accessId!=0 
    GROUP BY access.accessID HAVING COUNT(permissions.permId) = ( 
      SELECT COUNT(*) FROM `permissionscategory` A 
      INNER JOIN `permissions` B ON A.categoryID=B.category 
      WHERE A.categoryID=4 )
    ) B ON A.accessID=B.accessID $sqlConditionAccessID
  ) AS userWithAccessCount;";
  #echo $sql;

  // get count of full account accessed users
  $futureFullAccountAccessUsers = mysqli_fetch_all(mysqli_query($tempConn, $sql), MYSQLI_NUM)[0][0];
  #echo($futureFullAccountAccessUsers);
  mysqli_close($tempConn);
  return $futureFullAccountAccessUsers;
}

//------------------- EMP ACCOUNT/ROLE VALIDATION END-------------------

?>