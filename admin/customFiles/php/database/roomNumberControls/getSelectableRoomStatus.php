<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

function createSelectElements($list) {
    $select = "<select class='custom-select form-control-border selectRoomType' name='selectRoomStatus'>";
    foreach($list as $id => $name) {
        $select .= "<option value='$id'>$name</option>";
    }
    $select .= "</select>";
    return ($select);
}

$sql = "SELECT * FROM roomstatus;";

$result = mysqli_query($conn, $sql);

$tempList = [];

if(mysqli_num_rows($result) > 0) {
    while($r = mysqli_fetch_assoc($result)) {
        $tempList += [$r["roomStatusID"] => $r["roomStatus"]];
    }
    $output->output["data"] = createSelectElements($tempList);
} else {
    $output->output["data"] = "
    <select class='custom-select form-control-border selectRoomType'>
        <option disabled selected value>None</option>
    </select>";
    $output->setFailed("No Status");
}

echo $output->getOutput(1);
?>