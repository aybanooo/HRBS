<?php

$phpDIR = dirname(__FILE__,3);

require_once("$phpDIR/directories/directories.php");
require_once(__initDB__);
require_once(__outputHandler__);
require_once(__format__);
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

function checkRequiredPOSTval($strList = null) {
    $temp = array_map('trim', explode(',', $strList));
    foreach($temp as $val) {
        if(!isset($_POST[$val])) {
            echo $GLOBALS['output']->setFailed("Something went wrong while processing the request.", $val." is missing."); 
            die();
        }
    }
    //echo "no missing\n";
}

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