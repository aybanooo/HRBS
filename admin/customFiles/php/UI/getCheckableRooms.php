<?php
require_once("../directories/directories.php");
require_once(__dbCreds__);
require_once(__outputHandler__);

mysqli_report(MYSQLI_REPORT_STRICT);

// Create connection
try {
$conn = new mysqli($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    $output->setFailed("Cannot connect to database.");
    echo $output->getOutput(true);
    die();
}

// Check connection
if ($conn->connect_error) {
    $output->setFailed("Cannot connect to database.".$conn->connect_error);
    //echo $output->getOutput(true);
    die();
}



function createSelectElements(&$list) {
    $select = "";
    foreach($list as $id => $name) {
        $select .= <<<END
         <label class="btn btn-outline-secondary font-weight-normal  mb-2">
            <input type="checkbox" autocomplete="off" value="$id" name="forList[]"> $name
         </label>
        END;
    }
    return ($select);
}

$sql = "SELECT * FROM roomtype;";
$tempList = [];

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
    while($r = mysqli_fetch_assoc($result)) {
        $tempList += [$r["roomTypeID"] => $r["name"]];
    }
} else {
    echo "No room type available.";
}

?>

<div class="btn-group-toggle check-roomType text-center" name="check-roomType" data-toggle="buttons">
    <?php 
        echo createSelectElements($tempList);
    ?>
</div>
