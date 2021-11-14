<?php
require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once(__initDB__);
require_once(__F_FORMAT__);
require_once __F_VALIDATIONS__;
checkAdminSideAccess();


function notSetToEmptyString(&$value) {
    if(isset($value))
        return $value;
    else
        return "";
}

$deleteSql = "DELETE FROM companyinfo limit 1;";
//echo mysqli_num_rows($result);

$rowExistSQL = "select * from companyinfo;";

if(mysqli_num_rows($result = mysqli_query($conn, $rowExistSQL)) == 0) {
    $sql = "INSERT INTO companyinfo ()
    VALUES ('Reservation System', '','','','','');";
    if (mysqli_query($conn, $sql)) {
        //echo "Record saved successfully";
    } else {
        //echo "Error saving record: " . mysqli_error($conn);
    }
    mysqli_fetch_all($result);
}
else {
    if(mysqli_num_rows($result) > 1){
        $deleteSql = "DELETE FROM companyinfo limit 1;";
        mysqli_query($conn, $deleteSql);
    }
    $sql = "select * from companyinfo limit 1;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output->output['data'] = $row;
        }
    } else
        echo $output->setFailed("Something went wrong while retrieving the data");
    mysqli_fetch_all($result);
}

if(mysqli_num_rows($result = mysqli_query($conn, "SELECT `value` from `settings` WHERE `name` like 'showLogoInNav' LIMIT 1;"))) {
    while($r = mysqli_fetch_array($result))
        $output->output['data']['showLogo'] = toPhpBool($r['value']);
    echo $output->setSuccessful();
} else {
    echo $output->setFailed("Something went wrong while retrieving the data");
}



?>
