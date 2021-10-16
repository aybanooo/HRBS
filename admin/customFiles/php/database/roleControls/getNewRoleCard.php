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

?>


<?php 
    #echo json_encode($data);
    #die();
  foreach($data as $val){
?>
<div class="row">
  <div class="col">
    <div class="card collapsed-card">
        <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
            <input type="hidden" name="roleID" value="<?php print $val['accessID'];?>">
            <h3 class="card-title ce-noenter ce-limit"><span class="roleName"><?php print $val['accessname'];?></span><small class="text-secondary ml-2"><span class="roleCount"> <i class="fas fa-circle-notch fa-spin"> </i> </span> <span class="font-weight-light">Account/s</span></small>  <span name="changesWarning" title="Unsave Changes" class="badge bg-secondary ml-3 d-none">Unsave changes</span> </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool d-inline-block" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="display: none;">
        <div class="row mb-3">
            <div class="col-6">
                <button type="button" class="btn btn-default changeRoleName" data-toggle="modal" data-target="#changeRoleNameModal">Change role name</button>
                <button type="button" class="btn btn-default mt-1 mt-sm-0" onclick="deleteRole(this)">
                <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="col-6 text-right">
                <button type="button" class="btn btn-success ml-2" onclick="saveRole(this)" name="saveButton"><span>Save</span></button>
                <button type="button" class="btn btn-outline-secondary" onclick="discardChanges(this)"><span>Discard</span></button>
            </div>
        </div>
        <form class="row">
            <div class="col-12 col-md-6 col-lg-4 mb-3">
            <?php
                $currCol = 0;
                $t = json_encode(count($val['permissionCategories']));
                #print "<script>console.log($t)</script>";
                #print "<script>console.groupCollapsed('1st column');</script>";
                foreach(range(0, count($val['permissionCategories'])-1) as $i):
                if($i%2 != 0) {
                  continue;
                }
                #print "<script>console.log($i);</script>";
              ?>
              <div class="row mt-2">
                <div class="col-12">
                  <h5> <?php print $val['permissionCategories'][$i]['name'];?> </h5>
                </div>
              </div> 
              <div class="row">
                <div class="col-12">
                  <?php generateSoloCheckList($val['accessID'], $val['permissionCategories'][$i]); ?>
                </div>
              </div>
              <?php  
              endforeach;
              #print "<script>console.groupEnd('1st column');</script>";
            ?>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
            <?php
                $currCol = 0;
                #$t = json_encode(count($val['permissionCategories']));
                #print "<script>console.log($t)</script>";
                print "<script>console.groupCollapsed('2nd column');</script>";
                foreach(range(0, count($val['permissionCategories'])-1) as $i):
                    if($i%2 == 0) {
                        continue;
                    }
                #print "<script>console.log($i);</script>";
              ?>
              <div class="row mt-2">
                <div class="col-12">
                  <h5> <?php print  $val['permissionCategories'][$i]['name'];?> </h5>
                </div>
              </div> 
              <div class="row">
                <div class="col-12">
                  <?php generateSoloCheckList($val['accessID'], $val['permissionCategories'][$i]); ?>
                </div>
              </div>
              <?php  
              endforeach;
              #print "<script>console.groupEnd('2nd column');</script>";
            ?>
            </div>
        
        </form>
      </div>
    </div>
  </div>
</div>
<?php
  }
?>

