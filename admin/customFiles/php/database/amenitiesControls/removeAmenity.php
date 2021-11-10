<?php

require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once __initDB__;
require_once __F_FORMAT__;
require_once __F_PERMISSION_HANDLER__;

checkPermission(__V_P_AMENITIES_MANAGE__, true);

$id = tonotwtf($_POST['amid'], 3);

prepareForSQL($conn, $id, 2);

$id = intval($id);

if(mysqli_num_rows($resultID = mysqli_query($conn, "SELECT `amenityID` FROM `amenities` WHERE `amenityID`=$id LIMIT 1;")) == 1)
    $id = mysqli_fetch_all($resultID, MYSQLI_NUM)[0][0];
else
    die($output->setFailed('Amenity doesn\'t exist'));
#var_dump($id);

if($id==="")
    echo $output->setFailed('Cannot find amenity');

if(mysqli_query($conn, "DELETE FROM `amenities` WHERE `amenityID`=$id LIMIT 1")) {
    unlink(__D_AMENITIES__."$id/image.jpeg");
    rmdir(__D_AMENITIES__."$id/");
    die($output->setSuccessful('Deleted'));
}
else
    die($output->setFailed('Something went wrong while deleting the amenity'));
?>