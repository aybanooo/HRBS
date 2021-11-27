<?php
require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_VALIDATIONS__;

checkAdminSideAccess();

$xID = $_POST['xid'];
// echo $xID = 'W-H2K0XMZ1';

$connForXID = createTempDBConnection();
prepareForSQL($connForXID, $xID);
$XID_exist = mysqli_fetch_all(mysqli_query($connForXID, "SELECT COUNT(*) FROM `paypalpayment` WHERE `orderID` like '$xID' LIMIT 1;"))[0][0];
mysqli_close($connForXID);

// echo json_encode(!$XID_exist);
if($XID_exist)
    die(json_encode("Transaction ID Exists"));
echo json_encode(true);
?>