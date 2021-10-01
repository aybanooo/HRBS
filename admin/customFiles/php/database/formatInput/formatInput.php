<?php
require_once("../../directories/directories.php");

//type = 0 if value needs to be true or false
// type = 1 if value needs to be a digit
function prepareForSQL(&$conn, &$val, $type = null) {
    if (!is_null($type)) {
        if($type == 0)  {
            $val = preg_replace("/[^0-1]/", "", $val);
            $val = empty($val) ? "0" : $val;
        } else if ($type == 1) 
            $val = preg_replace("/[^0-9]/", "", $val);
    } else {
        $val = trim($val);
    }
    $val = mysqli_real_escape_string($conn, $val);
}

?>