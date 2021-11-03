<?php
require_once("../../directories/directories.php");
require_once(__dbCreds__);
require_once(__outputHandler__);

mysqli_report(MYSQLI_REPORT_STRICT);

// Create connection
try {
$conn = new mysqli($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    $output->setFailed("Cannot connect to database.");
    echo $output->getOutput(true);
    die();
}

// Check connection
if ($conn->connect_error) {
    $output->setFailed("Cannot connect to database.".$conn->connect_error);
    //echo $output->getOutput(true);
    die();
}

function createSelectElements($list) {
    $select = "<select class='custom-select form-control-border bg-transparent selectRoomType' name='selectRoomStatus'>";
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
    <select class='custom-select form-control-border bg-transparent selectRoomType'>
        <option disabled selected value>None</option>
    </select>";
    $output->setFailed("No Status");
}

echo $output->getOutput(1);
?>