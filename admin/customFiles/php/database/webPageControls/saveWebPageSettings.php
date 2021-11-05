<?php
require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__F_VALIDATIONS__);
require_once(__F_FORMAT__);
require_once(__F_FORMAT_IMAGE__);

//print_r($_FILES);


if(isset($_FILES['pageCover'])) {
    if (check_file_type($_FILES['pageCover']['type'], 'image/jpeg')) {
        echo$output->setFailed("Something went wrong while uploading the new page cover");
        die();
    }
    move_uploaded_file($_FILES['pageCover']['tmp_name'], __D_PUBLIC_IMAGES__."pageCover.jpeg");
}

if(isset($_FILES['logo'])) {
    if (check_file_type($_FILES['logo']['type'], 'image/png')) {
        echo$output->setFailed("Something went wrong while uploading the logo");
        die();
    }
    move_uploaded_file($_FILES['logo']['tmp_name'], __D_PUBLIC_IMAGES__."logo.png");
    resizer(__D_PUBLIC_IMAGES__."logo.png", __D_PUBLIC_IMAGES__."logo_100x100.png", 128, 128);
    resizer(__D_PUBLIC_IMAGES__."logo.png", __D_PUBLIC_IMAGES__."favicon.png", 32, 32);
}

/*
if(isset($_FILES['thumb'])) {
    if (check_file_type($_FILES['thumb']['type'], 'image/png')) {
        echo$output->setFailed("Something went wrong while uploading the new thumbnail");
        die();
    }
    move_uploaded_file($_FILES['thumb']['tmp_name'], __D_PUBLIC_IMAGES__."favicon.png");
}
*/

$companyName = isset($_POST['inp-companyName']) ? prepareForSQL($conn, $_POST['inp-companyName']) : "";
$address = isset($_POST['inp-address'])  ? prepareForSQL($conn, $_POST['inp-address']) : "";
$contactNum = isset($_POST['inp-contactNum']) ? prepareForSQL($conn, $_POST['inp-contactNum']) : "";
$email = isset($_POST['inp-email']) ? prepareForSQL($conn, $_POST['inp-email']) : "";
$footer_r = isset($_POST['inp-footer-r']) ? prepareForSQL($conn, $_POST['inp-footer-r']) : "";
$socmed_1 = isset($_POST['inp-socmed-1']) ? prepareForSQL($conn, $_POST['inp-socmed-1']) : "";
$socmed_2 = isset($_POST['inp-socmed-2']) ? prepareForSQL($conn, $_POST['inp-socmed-2']) : "";
$socmed_3 = isset($_POST['inp-socmed-3']) ? prepareForSQL($conn, $_POST['inp-socmed-3']) : "";
$showLogoInAdmin = isset($_POST['inp-logo-showLogoInAdmin']) ? prepareForSQL($conn, $_POST['inp-logo-showLogoInAdmin'], 0) : "0";

// checks company name value then fail if empty
varsHaveEmpty([$companyName], true) && die($output->setFailed("Company name cannot be empty"));

if(isset($_POST['inp-loc'])) {
    $raw_loc = isset($_POST['inp-loc']) ? prepareForSQL($conn, $_POST['inp-loc']) : "";
    if (substr_count($raw_loc, ',') == 1) {
        $loc = explode(',', $raw_loc, 2);
    }
    else {
        $loc[0] = $raw_loc;
        $loc[1] = "";
    }
}

//delete excess rows
if(mysqli_num_rows($allCompanyRows = mysqli_query($conn, "SELECT * FROM `companyinfo`;")) > 1) {
    $numOfDeletion = mysqli_num_rows($allCompanyRows) - 1;
    echo $numOfDeletion;
    mysqli_query($conn, "DELETE FROM `companyinfo` LIMIT $numOfDeletion");
}

//create one row if table is empty
if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `companyinfo`;")) == 0) {
    $sql = "INSERT INTO companyinfo ()
    VALUES ('"
    .$companyName."', '"
    .$address."', 'Not included in form', '"
    .$contactNum."', '"
    .$loc[1]."', '"
    .$loc[0]."', '"
    .$email."', '"
    .$footer_r."');";
    if(mysqli_query($conn, $sql)) {
        echo $output->setSuccessful("Successfuly updated");
    } else {
        echo $output->setFailed("Something went wrong while updating the information", mysqli_error($conn));
    }
    die();
}

$sqlUpdate = "UPDATE `companyinfo` SET 
`companyName`='$companyName',
`address`='$address',
`companyDesc`='Not included in form',
`contact`='$contactNum',
`longitude`='{$loc[1]}',
`latitude`='{$loc[0]}',
`email`='$email',
`footerRight`='$footer_r' LIMIT 1;";

if(mysqli_query($conn, $sqlUpdate)) {
    #do nothing yet
} else {
    echo $output->setFailed("Something went wrong while updating the hotel information");
    die();
}

if(mysqli_num_rows($result = mysqli_query($conn, "SELECT * FROM `settings` WHERE `name` LIKE 'showLogoInNav' LIMIT 1;"))==0) {
    mysqli_query($conn, "INSERT INTO `settings` (`name`, `value`, `type`) VALUES ('showLogoInNav', '', '1') LIMIT 1;");
}
if(mysqli_query($conn, "UPDATE `settings` SET `value`='$showLogoInAdmin' WHERE `name` like 'showLogoInNav' LIMIT 1;")){
    echo $output->setSuccessful("Successfuly updated");
} else {
    echo $output->setFailed("Something went wrong while updating the information", mysqli_error($conn));
}

?>