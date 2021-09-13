<?php
require_once("../../directories/directories.php");
require_once(__dbCreds__);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function boolToCheck($value) {
    return $value ? 'checked': '';
}


$sql = "SELECT * FROM access WHERE accessname like \"".$_GET["roleName"]."\"";
//$sql = "SELECT * FROM access";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        //echo $row["accessID"]."<br>";   
        $sqlTwo = "SELECT permId, val FROM accesspermission where accessId like \"".$row["accessID"]."\" ORDER BY permId";
        $resultTwo = mysqli_query($conn, $sqlTwo);

        $rowList = [];

        if (mysqli_num_rows($resultTwo) > 0) {
            while($rowTwo = mysqli_fetch_assoc($resultTwo)) {
                //echo "-".$rowTwo["permId"]." ".$rowTwo["val"]."<br>"; 
                array_push($rowList, $rowTwo["val"]);
            }
            //print_r($rowList);
            $roleCardRow = "
                <div class=\"row\">
                    <div class=\"col\">
                        <div class=\"card collapsed-card\">
                            <div class=\"card-header\" data-card-widget=\"collapse\" style=\"cursor: pointer;\">
                                <input type=\"hidden\" id=\"roleID\" name=\"roleID\" value=\"".$row["accessID"]."\"> <span name=\"changesWarning\" title=\"Unsave Changes\" class=\"badge bg-secondary ml-3 d-none\">Unsave changes</span>
                                <h3 class=\"card-title ce-noenter ce-limit\"><span class=\"roleName\">".$row["accessname"]."</span><small class=\"text-secondary ml-2\"><span class=\"roleCount\"><i class=\"fas fa-circle-notch fa-spin\"> </i></span> <span class=\"font-weight-light\">Account/s</span></small></h3>
                                <div class=\"card-tools\">
                                    <button type=\"button\" class=\"btn btn-tool\" data-card-widget=\"collapse\"><i class=\"fas fa-plus\"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class=\"card-body\">
                            <div class=\"row mb-3\">
                                <div class=\"col-6\">
                                    <button type=\"button\" class=\"btn btn-default changeRoleName\" data-toggle=\"modal\" data-target=\"#changeRoleNameModal\">Change role name</button>
                                    <button type=\"button\" class=\"btn btn-default mt-1 mt-sm-0\" onClick=\"deleteRole(this)\">
                                    <i class=\"fas fa-trash\"></i>
                                    </button>
                                </div>
                                <div class=\"col-6 text-right\">
                                    <button type=\"button\" class=\"btn btn-success ml-2\" onclick=\"saveRole(this)\" name=\"saveButton\">Save</button>
                                    <button type=\"button\" class=\"btn btn-outline-secondary\" onclick=\"discardChanges(this)\">Discard</button>
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"col-12 col-md-6 col-lg-4 mb-3\">
                                    <div class=\"row\">
                                    <div class=\"col-12\">
                                        <h5>Rooms</h5>
                                    </div>
                                    </div> 
                                    <div class=\"row mb-4\">
                                        <div class=\"col-12\">
                                        <div class=\"form-check selectAllGroup\">
                                            <input type=\"checkbox\" class=\"form-check-input d-none roleSelectAll\" id=\"".$row["accessID"]."selectAll1\">
                                            <label class=\"form-check-label\" for=\"".$row["accessID"]."selectAll1\">Select All</label>
                                        </div>
                                        <div class=\"form-check\">
                                            <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check1\" ".boolToCheck($rowList[0]).">
                                            <label class=\"form-check-label\" for=\"".$row["accessID"]."check1\">Add/Delete Rooms</label>
                                        </div>
                                        <div class=\"form-check\">
                                            <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check2\" ".boolToCheck($rowList[1]).">
                                            <label class=\"form-check-label\" for=\"".$row["accessID"]."check2\">Manage room thumbnail/image</label>
                                        </div>
                                        <div class=\"form-check\">
                                            <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check3\" ".boolToCheck($rowList[2]).">
                                            <label class=\"form-check-label\" for=\"".$row["accessID"]."check3\">Manage room description</label>
                                        </div>
                                        <div class=\"form-check\">
                                            <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check4\" ".boolToCheck($rowList[3]).">
                                            <label class=\"form-check-label\" for=\"".$row["accessID"]."check4\">Manage room sections</label>
                                        </div>
                                        <div class=\"form-check\">
                                            <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check5\" ".boolToCheck($rowList[4]).">
                                            <label class=\"form-check-label\" for=\"".$row["accessID"]."check5\">Manage room general information</label>
                                        </div>
                                        <div class=\"form-check\">
                                            <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check6\" ".boolToCheck($rowList[5]).">
                                            <label class=\"form-check-label\" for=\"".$row["accessID"]."check6\">Manage room rates</label>
                                        </div>
                                        </div>
                                    </div>
                                    <div class=\"row\">
                                        <div class=\"col-12\">
                                        <h5>Accounts</h5>
                                        </div>
                                    </div> 
                                    <div class=\"row\">
                                        <div class=\"col-12\">
                                            <div class=\"form-check selectAllGroup\">
                                                <input type=\"checkbox\" class=\"form-check-input d-none d-none roleSelectAll\" id=\"".$row["accessID"]."selectAll3\">
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."selectAll3\">Select All</label>
                                            </div>
                                            <div class=\"form-check\">
                                                <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check7\" ".boolToCheck($rowList[6]).">
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."check7\">Add accounts</label>
                                            </div>
                                            <div class=\"form-check\">
                                                <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check8\" ".boolToCheck($rowList[7])."}>
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."check8\">Delete accounts</label>
                                            </div>
                                            <div class=\"form-check\">
                                                <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check9\" ".boolToCheck($rowList[8]).">
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."check9\">Reset password</label>
                                            </div>
                                            <div class=\"form-check\">
                                                <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check10\" ".boolToCheck($rowList[9])."}>
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."check10\">Manage roles</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-12 col-md-6 col-lg-4 mb-3\">
                                    <div class=\"row\">
                                        <div class=\"col-12\">
                                        <h5>Amenities</h5>
                                        </div>
                                    </div> 
                                    <div class=\"row mb-4\">
                                        <div class=\"col-12\">
                                        <div class=\"form-check\">
                                            <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check11\" ".boolToCheck($rowList[10]).">
                                            <label class=\"form-check-label\" for=\"".$row["accessID"]."check11\">Manage amenities</label>
                                        </div>
                                        </div>
                                    </div>
                                    <div class=\"row\">
                                        <div class=\"col-12\">
                                        <h5>Webpage</h5>
                                        </div>
                                    </div> 
                                    <div class=\"row\">
                                        <div class=\"col-12\">
                                            <div class=\"form-check selectAllGroup\">
                                                <input type=\"checkbox\" class=\"form-check-input d-none roleSelectAll\" id=\"".$row["accessID"]."selectAll4\">
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."selectAll4\">Select All</label>
                                            </div>
                                            <div class=\"form-check\">
                                                <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check12\" ".boolToCheck($rowList[11]).">
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."check12\">Modify company name</label>
                                            </div>
                                            <div class=\"form-check\">
                                                <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check13\" ".boolToCheck($rowList[12]).">
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."check13\">Modify Page Cover</label>
                                            </div>
                                            <div class=\"form-check\">
                                                <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check14\" ".boolToCheck($rowList[13]).">
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."check14\">Modify Company Logo</label>
                                            </div>
                                            <div class=\"form-check\">
                                                <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check15\" ".boolToCheck($rowList[14]).">
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."check15\">Modify Contact Info</label>
                                            </div>
                                            <div class=\"form-check\">
                                                <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check16\" ".boolToCheck($rowList[15]).">
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."check16\">Modify Social Media Links</label>
                                            </div>
                                            <div class=\"form-check\">
                                                <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check17\" ".boolToCheck($rowList[16]).">
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."check17\">Modify Display</label>
                                            </div>
                                            <div class=\"form-check\">
                                                <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check18\" ".boolToCheck($rowList[17]).">
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."check18\">Modify Location</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-12 col-md-6 col-lg-4 mb-3\">
                                    <div class=\"row\">
                                        <div class=\"col-12\">
                                        <h5>Vouchers</h5>
                                        </div>
                                    </div> 
                                    <div class=\"row\">
                                        <div class=\"col-12\">
                                            <div class=\"form-check\">
                                                <input type=\"checkbox\" class=\"form-check-input\" id=\"".$row["accessID"]."check19\" ".boolToCheck($rowList[18]).">
                                                <label class=\"form-check-label\" for=\"".$row["accessID"]."check19\">Manage Vouchers</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
            echo $roleCardRow;
        }
        else {
            echo "No Data po";
        }
    }
} else {
    echo "No Data";
}

mysqli_close($conn);

//header('Location: /Thesis/Proto/scratch.php');



?>