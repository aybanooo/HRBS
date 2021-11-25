<?php

require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_VALIDATIONS__;

checkAdminSideAccess();

$sql = 'SELECT A.*, CONCAT(B.`fname`, " ", B.`lname`) AS Name, B.`contact`, B.`email`, B.`verified`, B.`verification`, RSVA.*, P.*  FROM `reservation` A 
LEFT JOIN `customer` B ON A.`customerID`=B.`customerID` 
LEFT JOIN `reservation_amount` RSVA ON A.`reservationID`=RSVA.`reservationID`
LEFT JOIN `paypalpayment` P ON A.`reservationID`=P.`reservationID`;';

$tempConn = createTempDBConnection();

$result = mysqli_fetch_all(mysqli_query($tempConn, $sql), MYSQLI_ASSOC);

echo json_encode(["data"=>$result]);
return;
?>

<pre>
    <?php
        echo json_encode($result);
    ?>
</pre>