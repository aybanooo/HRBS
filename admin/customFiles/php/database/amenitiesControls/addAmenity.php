<?php

require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once __initDB__;
require_once __F_FORMAT__;
require_once __F_VALIDATIONS__;
require_once "genAmenityCardFunction.php";
require_once __F_PERMISSION_HANDLER__;

checkPermission(__V_P_AMENITIES_MANAGE__, true);
#print_r($_POST);
#print_r($_FILES); 

$amenityName = prepareForSQL($conn, $_POST['inp-amenityName']);
$description = prepareForSQL($conn, $_POST['inp-textArea-description']);

if(mysqli_query($conn, "INSERT INTO `amenities`(`amenityName`, `amenityDesc`) VALUES ('$amenityName','$description') LIMIT 1;")) {
    
}

$id = mysqli_insert_id($conn);

$amenityEntryFolder = __D_AMENITIES__."$id/";

if(!file_exists($amenityEntryFolder))
    mkdir($amenityEntryFolder);

if(isset($_FILES['file-image-amenityImage'])) {
    if(check_file_type($_FILES['file-image-amenityImage']['type'], 'image/jpeg, image/jpg')) {
        echo $output->setFailed('Unsupported file type');
        rmdir($amenityEntryFolder);
        mysqli_query($conn, "DELETE FROM `amenities` WHERE `amenityID`=$id LIMIT 1;");
        die();
    }
    try {
        move_uploaded_file($_FILES['file-image-amenityImage']['tmp_name'], $amenityEntryFolder."image.jpeg");
    } catch( Exception $e) {
        echo $output->setFailed('Something went wrong while processing the image');
        rmdir($amenityEntryFolder);
        mysqli_query($conn, "DELETE FROM `amenities` WHERE `amenityID`=$id LIMIT 1;");
        die();
    }
} else {
    copy(__D_PUBLIC_DEFAULTS__."default-image-landscape.jpg", $amenityEntryFolder."image.jpeg");
}


$result = mysqli_query($conn, "SELECT * FROM `amenities` WHERE `amenityID`=$id LIMIT 1;");
$r = mysqli_fetch_all($result, MYSQLI_ASSOC);
$r[0]['amenityID'] = towtf($r[0]['amenityID'], 3); 

ob_start();
generateAmenityCard($r[0]);
$output->output['data'] = ob_get_contents();  
ob_end_clean();

echo $output->setSuccessful('New amenity created');

?>