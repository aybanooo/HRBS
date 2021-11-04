<?php

$phpDIR = dirname(__FILE__,3);


require_once("$phpDIR/directories/directories.php");
require_once(__initDB__);
require_once(__F_VALIDATIONS__);

$data = [
    "data" => []
];


$sql = "SELECT A.*, C.name as `roomName`, C.roomTypeID as `id` FROM `promotion` A LEFT JOIN `promotionroomtype` B ON A.promocode=B.promocode LEFT JOIN `roomtype` C ON B.roomTypeID=C.roomTypeID";
$result = mysqli_query($conn, $sql);

while($r = mysqli_fetch_assoc($result)) {
    if(!isset($data["data"][$r["promoCode"]])) {
        $data["data"][$r["promoCode"]] = [
            "code" => $r["promoCode"],
            "value" => $r["value"],
            "minSpend" => $r["minSpend"],
            "maxSpend" => $r["maxSpend"],
            "validUntil" => gmdate("Y-m-d H:i:s", strtotime($r["expiry"]) ),
            "name" => $r["promoName"],
            "description" => $r["promoDesc"]
        ];
        if(!isset($data["data"][$r["promoCode"]]["forRoomTypes"]))
            $data["data"][$r["promoCode"]]["forRoomTypes"]= [];
        if(!empty($r["id"]))
            $data["data"][$r["promoCode"]]["forRoomTypes"][$r["id"]] = $r["roomName"];
    } else
        if(!empty($r["id"]))
            $data["data"][$r["promoCode"]]["forRoomTypes"][$r["id"]] = $r["roomName"];
}

$data = array_values($data["data"]);

//echo "<pre>".json_encode($data)."</pre>";
echo json_encode($data);
?>