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

<select id="nameRoom" name="roomName" name="pickRoom" onchange="selectRate()">
<?php 

if(!empty($roomIDs))
foreach($rooms as $room) { ?>
    <option value="<?php print $room['roomTypeID'];?>"><?php print $room['name'];?></option>
<?php }
else
    echo '<option value="">No rooms available</option>';
?>
</select>