<?php

require_once("../../directories/directories.php");
require_once(__initDB__);
require_once __F_VALIDATIONS__;
checkAdminSideAccess();

$data = [
  "data" => []
];

$sql = "SELECT A.roomNo, A.floorLevel, B.name, C.roomStatus FROM room A LEFT JOIN roomtype B ON A.roomtypeID=B.roomTypeID LEFT JOIN roomstatus C ON A.roomStatusID=C.roomStatusID; ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($data["data"], [
      "roomNo" => $row["roomNo"],
      "floorLevel" =>  $row["floorLevel"],
      "roomtypeName" => $row["name"],
      "roomStatusLabel" => $row["roomStatus"]
    ]);
  }
} else {
  $output->setSuccessful("No Rooms");
}

//$output->output["data"] = $data;
//echo $output->getOutput(true);
echo json_encode($data);

/*
$data = '
{ "data": [
    {
        "roomNo": "110",
        "floorLevel": "1",
        "roomtypeID": "22",
        "roomtypeName": "Gege Suite",
        "roomStatusID": "1",
        "roomStatusLabel": "Not Available"
    }
]}';

echo json_encode($d);
*/

?>