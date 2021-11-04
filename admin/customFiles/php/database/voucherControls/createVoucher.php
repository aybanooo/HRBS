<?php

require_once("../../directories/directories.php");
require_once(__initDB__);
require_once(__outputHandler__);
require_once(__format__);
require_once(__formatInput__);
require_once(__validations__);

function generateCode() {
    $template = "abcdefghijklmnopABCDEFGHIJKLMNOP0123456789";
    $input_length = strlen($template);
    $random_string = '';
    for($i = 0; $i < 7; $i++) {
        $random_character = $template[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}

function getUniqueCode() {
    do
      $code = generateCode();
    while(!isCodeUnique($code));
    return $code;
}

function createPromotionToRoomtypeEntries($promoCode) {
    foreach($_POST['forList'] as $key => $val) {
        $sql = "INSERT INTO `promotionroomtype`
        (`promoCode`, `roomTypeID`) VALUES 
        ('$promoCode','$val')\n";
        if(mysqli_query($GLOBALS['conn'], $sql)==FALSE) {
            $GLOBALS['output']->setFailed("Something went wrong while creating the promotion's valid room types.");
            echo $GLOBALS['output']->getOutput(1);
            die();
        }
    }
}

//format inputs
setEmptyVarsToZero($_POST['minSpend']);
setEmptyVarsToZero($_POST['maxSpend']);
setEmptyVarsToZero($_POST['maxUsage']); 

limitChars($_POST['format'], 8);

convertToServerTime($_POST['validUntilDate']);

// escapes mysql special characters
prepareForSQL($conn, $_POST['promoName']);
prepareForSQL($conn, $_POST['promoDesc']);
prepareForSQL($conn, $_POST['format']);
prepareForSQL($conn, $_POST['formatPlacement']);
prepareForSQL($conn, $_POST['value'], 2);
prepareForSQL($conn, $_POST['minSpend'], 2);
prepareForSQL($conn, $_POST['maxSpend'], 2);
prepareForSQL($conn, $_POST['quantity'],);
prepareForSQL($conn, $_POST['maxUsage']);
prepareForSQL($conn, $_POST['validUntilDate']);
if(!isset($_POST['forList'])){
    $GLOBALS['output']->setFailed("No room type selected.");
    die($GLOBALS['output']->getOutput(1));
}
foreach($_POST['forList'] as &$val)
    prepareForSQL($conn, $val);
unset($val);

/*checkRequiredPOSTval($requiredVars);
foreach($_POST as $key => $val) {
    if (gettype($_POST[$key]) == "array")
        foreach($_POST[$key] as $arKey => $arVal)
            echo $key."[$arKey]". " = " .$arVal."\n";
    else
        echo $key. " = " .$val."\n";
}*/


if(isset($_POST['check-customCode'])) {
    $_POST['check-customCode'] = filter_var($_POST['check-customCode'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    $requiredVars = "format, formatPlacement, value, minSpend, maxSpend, quantity, maxUsage, validUntilDate";
    checkRequiredPOSTval($requiredVars);
    $_POST['quantity'] = $_POST['formatPlacement']==0 ? 1 : $_POST['quantity'];
    for ($i=0; $i < $_POST['quantity'] ; $i++) { 
        $promoCode = getUniqueCode();
        $promoCode = $_POST['formatPlacement']==1 ? $promoCode."-".$_POST['format'] :  ($_POST['formatPlacement']==2 ? $_POST['format']."-".$promoCode : $promoCode);
        $sql = "INSERT INTO `promotion`
        (`promoCode`, `value`, `minSpend`, `maxSpend`, `dateCreated`, `expiry`, `promoName`, `promoDesc`) 
        VALUES ('$promoCode', {$_POST['value']}, {$_POST['minSpend']}, {$_POST['maxSpend']}, NOW(), 
        '{$_POST['validUntilDate']}', '{$_POST['promoName']}', '{$_POST['promoDesc']}');";
        //echo $sql."\n";
        if(!mysqli_query($conn, $sql)) {
            $GLOBALS['output']->setFailed("Something went wrong while create the promo code/s.");
            echo $GLOBALS['output']->getOutput(1);
            die();
        }
        createPromotionToRoomtypeEntries($promoCode);
    }
    $GLOBALS['output']->setSuccessful("Promo code/s have been created successfuly.");
} else {
    $requiredVars = "value, minSpend, maxSpend, quantity, maxUsage, validUntilDate";
    checkRequiredPOSTval($requiredVars);
    for ($i=0; $i < $_POST['quantity'] ; $i++) { 
        $promoCode = getUniqueCode();
        $sql = "INSERT INTO `promotion`
        (`promoCode`, `value`, `minSpend`, `maxSpend`, `dateCreated`, `expiry`, `promoName`, `promoDesc`) 
        VALUES ('$promoCode', {$_POST['value']}, {$_POST['minSpend']}, {$_POST['maxSpend']}, NOW(), 
        '{$_POST['validUntilDate']}', '{$_POST['promoName']}', '{$_POST['promoDesc']}');";
        //echo $sql."\n";
        if(!mysqli_query($conn, $sql)) {
            $GLOBALS['output']->setFailed("Something went wrong while create the promo code/s.");
            echo $GLOBALS['output']->getOutput(1);
            die();
        }
        createPromotionToRoomtypeEntries($promoCode);
    }
    $GLOBALS['output']->setSuccessful("Promo code/s have been created successfuly.");
}

echo $GLOBALS['output']->getOutput(1);

?>