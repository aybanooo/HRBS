<?php
require_once("../directories/directories.php");
require_once(__initDB__);

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
