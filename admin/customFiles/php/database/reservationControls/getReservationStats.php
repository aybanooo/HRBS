<?php

require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __initDB__;
require_once __F_OUTPUT_HANDLER__;
require_once __F_VALIDATIONS__;
checkAdminSideAccess();


define("DATE_TODAY", "NOW()");
$DATE_OLDEST =  "2021-01-01";
define("DATE_LAST_5DAYS", "5");
define("DATE_LAST_1MONTH", "31");
define("DATE_LAST_1YEAR", "365");


$data = [];

$sql_reservations_count = "SELECT
            (SELECT COUNT(*) from `reservation` WHERE `dateCreated` BETWEEN CURDATE() AND NOW()) AS today,
            (SELECT COUNT(*) from `reservation` WHERE `dateCreated` BETWEEN DATE_SUB(NOW(), INTERVAL 5 DAY) AND NOW()) AS 'FiveDaysAgo',
            (SELECT COUNT(*) from `reservation` WHERE `dateCreated` BETWEEN DATE_SUB(NOW(), INTERVAL 31 DAY) AND NOW()) AS 'monthAgo',
            (SELECT COUNT(*) from `reservation` WHERE `dateCreated` BETWEEN DATE_SUB(NOW(), INTERVAL 365 DAY) AND NOW()) AS 'yearAgo',
            (SELECT COUNT(*) from `reservation` WHERE `dateCreated` BETWEEN '2021-01-01' AND NOW()) AS 'All';";

$reservations = array_map('intval', mysqli_fetch_all(mysqli_query($conn, $sql_reservations_count))[0]);

$sql_reservations_paid = "SELECT (SELECT COUNT(*) FROM `reservation` WHERE `reservationStatus`=1) AS countPaid;";

$reservations_paid = array_map('intval', mysqli_fetch_all(mysqli_query($conn, $sql_reservations_paid))[0]);

$sql_reservations_cancelled = "SELECT (SELECT COUNT(*) FROM `reservation` WHERE `reservationStatus`=2) AS countCancelled;";

$reservations_cancelled = array_map('intval', mysqli_fetch_all(mysqli_query($conn, $sql_reservations_cancelled))[0]);
            
$data['rsrvtn_count'] = $reservations;
$data['rsrvtn_paid'] = $reservations_paid;
$data['rsrvtn_cancelled'] = $reservations_cancelled;


echo json_encode($data);
die();
?>

<pre>
    <?php
        echo json_encode($data);
    ?>
</pre>