<?php
require_once(dirname(__FILE__, 3).'/directories/directories.php');
require_once(__validations__);
require_once(__gen__);
require_once(__initDB__);

#$result = mysqli_query($conn, "SELECT * FROM roomtype;");

function generateSoloCheckList($accessID, $permList) {
  #print "<script>console.groupCollapsed('Permissions');</script>";
  #print "<script>console.log(".json_encode($permList['permissions']).");</script>";
  #print "<script>console.groupEnd('Permissions');</script>";
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
if(!isset($fakeWhere))
    $fakeWhere = ""; #Change this value to a WHERE CLAUSE before including somewhere to generate specific access cards

#create array containing categories
if(mysqli_num_rows($result = mysqli_query($conn, "SELECT categoryID, `name` FROM permissionscategory ORDER BY priority;")) > 0) {
  #$temp =  mysqli_fetch_all($result, MYSQLI_ASSOC);
  while($r = mysqli_fetch_assoc($result)) {
    array_push($categories, ["categoryID" => $r['categoryID'], "name" => $r['name'], "permissions" => []]);
  }
}

#create array containing accessIDs
if(mysqli_num_rows($result = mysqli_query($conn, "SELECT * FROM access $fakeWhere ORDER BY accessID ASC")) > 0) {
  while($r = mysqli_fetch_assoc($result)) {
    $data[$r['accessID']] = ["accessID" => $r['accessID'], "accessname" => $r['accessname'], "permissionCategories" => $categories];
  }
}

#put permissions in accessID's categories
if(mysqli_num_rows($result = mysqli_query($conn, "SELECT A.*, B.category AS categoryID, B.name  FROM accesspermission A LEFT JOIN permissions B ON A.permId=b.permID $fakeWhere;")) > 0) {
  #$temp = mysqli_fetch_all($result, MYSQLI_ASSOC);
  while($r = mysqli_fetch_assoc($result)) {
    $i = array_search($r['categoryID'], array_column($categories, 'categoryID'));
    #echo $i;
    $data[$r['accessId']]['permissionCategories'][$i]['permissions'][$r['permId']] = ["value" => $r['val'], "name" => $r['name']]; 
  }
}

include "./generateHTMLcards.php";

?>



