<?php

require_once(dirname(__FILE__, 3).'/directories/directories.php');
require_once(__F_VALIDATIONS__);
require_once(__F_GEN__);
require_once(__initDB__);

voucherEnabled();

#$result = mysqli_query($conn, "SELECT * FROM roomtype;");

function generateCheckList($accessID, $permList) {
  #print "<script>console.groupCollapsed('Permissions');</script>";
  #print "<script>console.log(".json_encode($permList['permissions']).");</script>";
  #print "<script>console.groupEnd('Permissions');</script>";
  #print "<script>console.log(".json_encode($permList['permissions']).");</script>";
  foreach($permList['permissions'] as $key => $val):
    ?>
    <div class="form-check">
      <input
        type="checkbox"
        class="form-check-input"
        id="<?php print $accessID."check".$key; ?>" 
        data-accs="<?php print $accessID;?>"
        data-perm="<?php print $key;?>"
        <?php print  $val['value'] == "0" ? "" : "checked";?>
      />
      <label class="form-check-label" for="<?php print $accessID."check".$key; ?>"> <?php print $val['name']; ?> </label>
    </div>
    <?php
  endforeach;
}

$data = [];
$categories = [];

#create array containing categories
if(mysqli_num_rows($result = mysqli_query($conn, "SELECT categoryID, `name` FROM permissionscategory ORDER BY priority;")) > 0) {
  #$temp =  mysqli_fetch_all($result, MYSQLI_ASSOC);
  while($r = mysqli_fetch_assoc($result)) {
    array_push($categories, ["categoryID" => $r['categoryID'], "name" => $r['name'], "permissions" => []]);
  }
}

#create array containing accessIDs
if(mysqli_num_rows($result = mysqli_query($conn, "SELECT * FROM access ORDER BY accessID ASC")) > 0) {
  while($r = mysqli_fetch_assoc($result)) {
    $data[$r['accessID']] = ["accessID" => $r['accessID'], "accessname" => $r['accessname'], "permissionCategories" => $categories];
  }
}

#put permissions in accessID's categories
if(mysqli_num_rows($result = mysqli_query($conn, "SELECT A.*, B.category AS categoryID, B.name  FROM accesspermission A LEFT JOIN permissions B ON A.permId=b.permID")) > 0) {
  #$temp = mysqli_fetch_all($result, MYSQLI_ASSOC);
  while($r = mysqli_fetch_assoc($result)) {
    $i = array_search($r['categoryID'], array_column($categories, 'categoryID'));
    #echo $i;
    $data[$r['accessId']]['permissionCategories'][$i]['permissions'][$r['permId']] = ["value" => $r['val'], "name" => $r['name']]; 
  }
}

include "./generateHTMLcards.php";
die();
?>