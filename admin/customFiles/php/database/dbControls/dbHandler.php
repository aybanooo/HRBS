<?php
require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once(__F_OUTPUT_HANDLER__);
require_once(__F_FORMAT__);

function createTempDBConnection() {
    $tempINI = array_merge(parse_ini_file(__CONF_DB__), parse_ini_file(__CONF_PRIVATE__));
    mysqli_report(MYSQLI_REPORT_STRICT);
    // return connection
   return new mysqli($tempINI['DB_SERVERNAME'], $tempINI['DB_USERNAME'], $tempINI['DB_PASS'], $tempINI['DB_NAME']);
}

function checkIfSettingExist($name) {
    ($name==="") && throw new Exception("Name cannot be an empty string");
    $tempConn = createTempDBConnection();
    $exist = (mysqli_num_rows($result = mysqli_query($tempConn, "SELECT * FROM `settings` WHERE `name` LIKE '$name' LIMIT 1;"))==1);
    mysqli_close($tempConn);
    return $exist;
}

function createSettingIfMissing($name, $value, $valType ) {
    ($name===""||$value==="") && throw new Exception("Name or value cannot be an empty string");
    is_string($valType) && throw new Exception("Type cannot be a string");
    ($valType<0 || $valType > 3) && throw new Exception("Type must be only 1|2|3");
    $tempConn = createTempDBConnection();
    prepareForSQL($tempConn, $name);
    prepareForSQL($tempConn, $value);
    prepareForSQL($tempConn, $valType);
    if(!checkIfSettingExist($name))
        mysqli_query($tempConn, "INSERT INTO `settings`(`name`, `value`, `type`) VALUES ('$name','$value','$valType')");
    mysqli_close($tempConn);
}

#$2y$10$WvbX0/X.a9//Evje/6NOTumlEd0Qn4CX.z.T.1wSo.F...

?>