<?php
require_once(dirname(__FILE__, 2)."/directories/directories.php");
require_once __F_DB_HANDLER__;


$conn = createTempDBConnection();
function createSelectElements($list) {
    $select = "<select class='custom-select form-control-border selectRoomType' name='selectRoomType'>";
    foreach($list as $id => $name) {
        $select .= "<option value='$id'>$name</option>";
    }
    $select .= "</select>";
    return ($select);
}

$sql = "SELECT * FROM roomtype;";

$result = mysqli_query($conn, $sql);

$tempList = [];

if(mysqli_num_rows($result) > 0) {
    while($r = mysqli_fetch_assoc($result)) {
        $tempList += [$r["roomTypeID"] => $r["name"]];
    }
} else {
    $output->setFailed("No rooms");
}

$output->output["data"] = createSelectElements($tempList);

echo $output->getOutput(1);
?>