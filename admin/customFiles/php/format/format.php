<?php

//type = 0 if value needs to be true or false
// type = 1 if value needs to be a digit
// type = null no removal will be made
function formatToType(&$val, $type = null) {
    if (!is_null($type)) {
        if($type == 0)  {
            toPhpBool($val);
            $val = preg_replace("/[^0-1]/", "", $val);
            $val = empty($val) ? "0" : $val;
        } else if ($type == 1) 
            $val = preg_replace("/[^0-9]/", "", $val);
    } else {
        $val = trim($val);
    }
    $val = $val;
}

function prepareForSQL(&$conn, &$val, $type = null) {
    if (!is_null($type)) {
        if($type == 0)  {
            toPhpBool($val);
            $val = empty($val) ? "0" : $val;
        } else if ($type == 1) 
            $val = preg_replace("/[^0-9]/", "", $val);
    } else {
        $val = trim($val);
    }
    $val = mysqli_real_escape_string($conn, $val);
    return $val;
}

function toPhpBool(&$val) {
    $val = filter_var($val, FILTER_VALIDATE_BOOLEAN); 
}

function emptyToZero(&$var) {
    $var = empty($var) ? 0 : $var;
    return $var;
}

function zeroToEmpty(&$var) {
    $var = $var == "0" ? "" : $var;
    return $var;
}

function towtf($str, $level = 1) {
    if($level <= 0)
      throw new Exception("level cannot be less than or equal to 0");
    $str = str_split($str);
    foreach($str as &$char) {
        $char = dechex(ord($char)*($level+$level));
    }
    foreach($str as &$char) {
        $char = $char.chr(random_int(103, 122));
    }
    $str = base64_encode(chr(random_int(103, 122)).implode("", $str));
    return ($str);
  }
  
  function tonotwtf($str, $level = 1) {
    if($level <= 0)
      throw new Exception("level cannot be less than or equal to 0");
    $str = preg_split("/[g-z]/",  base64_decode($str));
    array_pop($str);
    array_shift($str);
    foreach($str as &$char) {
        $char = chr(hexdec($char)/($level+$level));
    }
    return implode("",$str);
  }
?>