<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__F_OUTPUT_HANDLER__);
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

$data = [
  "data" => []
];

$sql = "SELECT `roomStatusID`, `roomStatus`, `desc`, `bookable` FROM `roomstatus`";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($data["data"], [
        "roomStatusID" => $row["roomStatusID"],
        "roomStatus" =>  $row["roomStatus"],
        "description" => $row["desc"],
        "bookable" => $row["bookable"]
        ]);
    }
} else {
    $output->setSuccessful("No Rooms");
    die();
}

echo json_encode($data);

?>