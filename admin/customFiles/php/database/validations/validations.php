<?php

$phpDIR = dirname(__FILE__,3);

require_once("$phpDIR/directories/directories.php");
require_once(__initDB__);
require_once(__outputHandler__);
require_once(__format__);


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




?>