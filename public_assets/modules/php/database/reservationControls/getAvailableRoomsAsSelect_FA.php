<?php

require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_OUTPUT_HANDLER__;
require_once __F_RSV_HANDLER__;

(!isset($_GET['d'])) && die();

$date = decodeCheckinoutDate($_GET['d']);

if(!$date) die;

$roomIDs = getBookableRoomsID($date[0], $date[1]);
if(!empty($roomIDs)) {
    $rooms = getRoomDetails($roomIDs);
    $availRoomsCount = getRoomTypeAvailRoomsCount($date[0], $date[1]);
    foreach($availRoomsCount as $value) {
        $test[$value['roomTypeID']] = $value['roomsAvail'];
        $i = array_search($value['roomTypeID'], array_column($rooms, 'roomTypeID'));
        $rooms[$i]['roomsAvail'] = $value['roomsAvail'];
    }
}
?>
<select class="form-control" id="form-walk_in-select-roomtype" name="form-walk_in-select-roomtype" onchange="showRate()" aria-invalid="false">
<?php 

if(!empty($roomIDs))
foreach($rooms as $room) { ?>
    <option data-roomsAvail="<?php print $room['roomsAvail']; ?>" data-maxChildren="<?php print $room['maxChildren'];?>" data-maxAdult="<?php print $room['maxAdult'];?>" data-rid="<?php print base64_encode($room['roomTypeID']);?>" data-rate="<?php print $room['rate'];?>"><?php print $room['name'];?></option>
<?php }
else
    echo '<option>No rooms available</option>';
?>
</select>