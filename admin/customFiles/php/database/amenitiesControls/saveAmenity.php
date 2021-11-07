<?php

require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __initDB__;
require_once __F_FORMAT__;
require_once __F_PERMISSION_HANDLER__;

#print_r($_POST);
#print_r($_FILES);

checkPermission(__V_P_AMENITIES_SAVE__, true);

$id = tonotwtf($_POST['amid'], 3);
formatToType($id, 1);

$title = prepareForSQL($conn, $_POST['amTitle']);
$desc = prepareForSQL($conn, $_POST['amDesc']);

if(empty($id))
    die($output->setFailed("Cannot find amenity. Amenity doesn't exist"));

if(mysqli_num_rows($result = mysqli_query($conn, "SELECT `amenityName` FROM `amenities` WHERE `amenityID`=$id LIMIT 1;")) == 0 ) {
    die($output->setFailed("Amenity doesn't exist"));
}

if(isset($_FILES['image'])) {
    move_uploaded_file($_FILES['image']['tmp_name'], __D_AMENITIES__."/$id/image.jpeg");
}

if(mysqli_query($conn, "UPDATE `amenities` SET `amenityName`='$title',`amenityDesc`='$desc',`amenityStatusID`=null WHERE `amenityID`=$id LIMIT 1;"))
    die($output->setSuccessful('Saved'));
else
    die($output->setFailed('Something went wrong while saving the amenity'));
?>