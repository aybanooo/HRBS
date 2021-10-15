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


?>