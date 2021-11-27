<?php

require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_OUTPUT_HANDLER__;
require_once __F_RSV_HANDLER__;

(!isset($_GET['d'])) && die();

$date = decodeCheckinoutDate($_GET['d']);

if(!$date) die;

$roomIDs = getBookableRoomsID($date[0], $date[1]);
if(!empty($roomIDs))
$rooms = getRoomDetails($roomIDs);
?>
<select class="form-control" id="form-walk_in-select-roomtype" name="form-walk_in-select-roomtype" onchange="showRate()" aria-describedby="form-walk_in-select-roomtype-error" aria-invalid="false">
<?php 

if(!empty($roomIDs))
foreach($rooms as $room) { ?>
    <option data-maxChildren="<?php print $room['maxChildren'];?>" data-maxAdult="<?php print $room['maxAdult'];?>" data-rid="<?php print base64_encode($room['roomTypeID']);?>" data-rate="<?php print $room['rate'];?>"><?php print $room['name'];?></option>
<?php }
else
    echo '<option>No rooms available</option>';
?>
</select>