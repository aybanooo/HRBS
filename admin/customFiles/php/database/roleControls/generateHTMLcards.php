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
                    <?php
                    # Select All Checkbox 
                    # creates checkbox if permissions checkbox is greater than 1
                    if(count($val['permissionCategories'][$i]['permissions']) > 1) {
                      ?>
                        <button type="button" class="btn btn-link p-0" name="select-all-perms">Select All</button>
                      <?php
                    }
                    # Select All checkbox End
                    if(isset($fakeWhere))
                        if(!empty($fakeWhere))  
                            generateSoloCheckList($val['accessID'], $val['permissionCategories'][$i]); 
                        else
                            generateCheckList($val['accessID'], $val['permissionCategories'][$i]); 
                    else
                        generateCheckList($val['accessID'], $val['permissionCategories'][$i]); 
                    ?>
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
                #print "<script>console.groupCollapsed('2nd column');</script>";
                foreach(range(0, count($val['permissionCategories'])-1) as $i):
                    if($i%2 == 0) {
                        continue;
                    }
                #print "<script>console.log($i);</script>";
              ?>
              <div class="row mt-2">
                <div class="col-12">
                  <h5 class="mb-0 mt-2"> <?php 
                    print  $val['permissionCategories'][$i]['name'];
                  ?> </h5>
                </div>
              </div> 
              <div class="row">
                <div class="col-12">
                    <?php
                    # Select All Checkbox 
                    # creates checkbox if permissions checkbox is greater than 1
                    if(count($val['permissionCategories'][$i]['permissions']) > 1) {
                      ?>
                        <button type="button" class="btn btn-link p-0" name="select-all-perms">Select All</button>
                      <?php
                    }
                    # Select All checkbox End
                    if(isset($fakeWhere))
                        if(!empty($fakeWhere))  
                            generateSoloCheckList($val['accessID'], $val['permissionCategories'][$i]); 
                        else
                            generateCheckList($val['accessID'], $val['permissionCategories'][$i]); 
                    else
                        generateCheckList($val['accessID'], $val['permissionCategories'][$i]);   
                    ?>
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