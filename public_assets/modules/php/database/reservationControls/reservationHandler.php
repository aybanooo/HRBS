<?php

use phpseclib3\Crypt\EC;

require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_OUTPUT_HANDLER__;

function getBookableRooms(string $checkInDate, string $checkOutDate, int $roomTypeID = null) {
    $origInDate = $checkInDate;
    $origOutDate = $checkOutDate;
    try {
        $checkInDate = DateTime::createFromFormat('Y-m-d', $checkInDate)->format('Y-m-d');
        $checkOutDate = DateTime::createFromFormat('Y-m-d', $checkOutDate)->format('Y-m-d');
    } catch(Exception $e) {
        throw new Exception("Invalid Date format. Should be YYYY-m-d e.g 2000-12-23");
    }
    ($origInDate!=$checkInDate || $origOutDate!=$checkOutDate) && die("Invalid Date");
    ($checkOutDate <= $checkInDate) && throw new Exception("Check-out date must be greter than or equal to check-in date");
    $roomtypeCondition = "";
    if(!is_null($roomTypeID)) {
        (isValidRoomTypeID($roomTypeID)) || throw new Exception("Room type ID not found");
        $roomtypeCondition = "&& RM.`roomTypeID`=$roomTypeID";
    }
    $sql = "SELECT * FROM `room` RM  INNER JOIN `roomstatus` RS ON RM.`roomStatusID`=RS.`roomStatusID` WHERE RM.`roomNo` NOT IN (SELECT `roomNo` FROM `reservation` WHERE 
    (`checkInDate` > '$checkInDate' AND `checkInDate` < '$checkOutDate') OR
    (`checkOutDate` > '$checkInDate' AND `checkOutDate` < '$checkOutDate') OR
    ('$checkInDate' > `checkInDate` AND '$checkInDate' < `checkOutDate`) OR
    ('$checkOutDate' > `checkInDate` AND '$checkOutDate' < `checkOutDate`))  && RS.`bookable`=1 $roomtypeCondition;";
    $tempConn = createTempDBConnection();
    $result = doQuery_fetchAll($tempConn, $sql, MYSQLI_ASSOC);
    mysqli_close($tempConn);
    return $result;
}

function getValidRoomTypeID() {
    $tempConn = createTempDBConnection();
    $sql = "SELECT `roomTypeID` FROM roomtype;";
    $result = mysqli_fetch_all(mysqli_query($tempConn, $sql));
    $mapped = array_map(fn($v) => intval($v[0]), $result);
    mysqli_close($tempConn);
    return $mapped;
}

function isValidRoomTypeID(int $roomTypeID) {
    ($roomTypeID < 0) && throw new Exception("Room Type ID must be a positive integer");
    $roomTypes = getValidRoomTypeID();
    $valid = in_array($roomTypeID, $roomTypes);
    return $valid;
}

function getBookableRoomsID(string $checkInDate, string $checkOutDate) {
    $bookableRooms = getBookableRooms($checkInDate, $checkOutDate);
    $mappedRooms = array_map(fn($v)=> intval($v['roomTypeID']), $bookableRooms);
    $distinctRooms = array_unique($mappedRooms, SORT_NUMERIC);
    return array_values($distinctRooms);
}

function getRoomDetails(array|int $roomTypeID = null) {
    $condition = "";
    if(!is_null($roomTypeID)) {
        $validRoomTypeID = getValidRoomTypeID();
        if(is_integer($roomTypeID)) {
            ($roomTypeID < 0) && throw new Exception("Room Type ID must be a positive integer");
            (in_array($roomTypeID, $validRoomTypeID)) || throw new Exception("Room type ID not found");
            $condition = "WHERE `roomTypeID`=$roomTypeID";
        }
        if(is_array($roomTypeID)) {
            foreach($roomTypeID as $val) {
                // echo is_int($val);
                is_integer($val) || throw new Exception("Room Type ID must be an integer");
                ($val < 0) && throw new Exception("Room Type ID must be a positive integer");
                in_array($val, $validRoomTypeID) || throw new Exception("Room type ID not found");
            }
            $imploded = implode(", ",$roomTypeID);
            $condition = "WHERE `roomTypeID` IN ($imploded)";
        }
    }
    $sql = "SELECT * FROM `roomtype` $condition;";
    $tempConn = createTempDBConnection();
    $result = doQuery_fetchAll($tempConn, $sql, MYSQLI_ASSOC);
    return $result;
}

return;
?>


<pre>
    <?php
        echo json_encode(getRoomDetails(38));
    ?>
</pre>