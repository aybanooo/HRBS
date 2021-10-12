var roles = {
    "Owner" : {
        access : [
            true, true, true, true, true, true, true,
            true, true, true, true, true, true, true, 
            true, true, true, true, true],
        userCount : 1 
    },
    "Staff" : {
        access : [
            true, true, true, true, true, true, true,
            false, false, true, false, false, true, true, 
            true, true, true, true, true],
        userCount : 1
    }
}



var parser = new DOMParser();

function boolToCheck(value) {
    return value ? 'checked': '';
}

function changeRoleName(oldRoleName, newRoleName) {
    /*if (oldRoleName !== newRoleName) {
        Object.defineProperty(roles, newRoleName,
            Object.getOwnPropertyDescriptor(roles, oldRoleName));
        delete roles[oldRoleName];
    }*/
    $(`.roleName:contains('${oldRoleName}')`).text(newRoleName);
    updateAccTableRoles(oldRoleName, newRoleName);
}

function checkToNum(val) {
    return val ? 1 : 0;
}

function saveRole(event) {
    target = $(event).parents().eq(3).find('.roleName').text();
    key = $(event).parents().eq(3).find('#roleID').val();
    
    permission = []
    for (let x=1; x<20; x++) {
        permission.push( checkToNum($(event).parents().eq(2).find('#'+key+'check'+x).is(":checked")) );
    } 
    //console.log( checkToNum($(event).parents().eq(2).find('#'+key+'check1').is(":checked")) );
    console.log(permission);
    $.ajax({
        type: 'post',
        url: 'customFiles/php/database/roleControls/saveRole.php',
        data: {
            roleID:key,
            1:permission[0],
            2:permission[1],
            3:permission[2],
            4:permission[3],
            5:permission[4],
            6:permission[5],
            7:permission[6],
            8:permission[7],
            9:permission[8],
            10:permission[9],
            11:permission[10],
            12:permission[11],
            13:permission[12],
            14:permission[13],
            15:permission[14],
            16:permission[15],
            17:permission[16],
            18:permission[17],
            19:permission[18],
        },
        async: false,
        success: function (response) {
            console.log(response);
            if(response) {
                Toast.fire({
                    icon: 'success',
                    title: 'Saved.'
                    });
            }
            $(event).parents().eq(3).find("span[name=\"changesWarning\"]").addClass("d-none");
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(errorThrown);
        }
    });

}

function discardChanges(event) {
    key = $(event).parents().eq(3).find('#roleID').val();
    $.ajax({
        type: 'get',
        url: 'customFiles/php/database/roleControls/discardChanges.php',
        data: {
            roleID:key
        },
        async: false,
        success: function (response) {
            defaults = JSON.parse(response);
            for(let chkNum=1; chkNum<20;chkNum++) {
                //console.log("#"+key+'check'+chkNum);
                //console.log($(event).parents().eq(2).attr('class'));
                $(event).parents().eq(2).find("#"+key+'check'+chkNum).prop("checked", parseInt(defaults[chkNum-1]));
            }
            $(event).parents().eq(3).find("span[name=\"changesWarning\"]").addClass("d-none");
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(errorThrown);
        }
    });
}

function updateRoleName(oldN, newN, pass) {
    $.ajax({
        type: 'post',
        url: 'customFiles/php/database/roleControls/updateRoleName.php',
        data: {
            oldRoleName:oldN,
            newRoleName:newN,
            pass:pass
        },
        success: function (response) {
            if(response) {
                getRoleSelectNodes();
                changeRoleName(oldN, newN);
                toggleButtonDisabled("#changeRoleNameModal button[type='submit']", "#changeRoleNameModal", "Saving...");
                $('#changeRoleNameModal').click();
                $('#changeRoleNameForm').trigger("reset");
                Toast.fire({
                    icon: 'success',
                    title: 'Role name has been changed.'
                    });
            }
            else {
                Toast.fire({
                    icon: 'danger',
                    title: 'Failed to change role name.'
                    });
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(errorThrown);
        }
    });
}

function deleteRole(event) {
    toggleButtonDisabled(event, "#rolesBody", "");
    target = $(event).parents().eq(3).find('.roleName').text();
    key = $(event).parents().eq(3).find('#roleID').val();
    delete roles[target];
    $.ajax({
        type: 'post',
        url: 'customFiles/php/database/roleControls/deleteRole.php',
        data: {
            roleID:key,
        },
        success: function (response) {
            if(response) {
                Toast.fire({
                    icon: 'success',
                    title: 'Role has been deleted.'
                    });
                $(event).parents().eq(5).remove();
                $('#inputRole').find(`:contains('${target}')`).remove();
                FixAccTableRoles(target);
                getRoleSelectNodes();
                toggleButtonDisabled(event, "#rolesBody", "");
            }
            else {
                Toast.fire({
                    icon: 'danger',
                    title: 'Failed to delete role.'
                    });
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(errorThrown);
        }
    });
}

function updateAccTableRoles(oldRoleName, newRoleName) {
    $('#accountTable tbody').find(`a:contains('${oldRoleName}')`).text(newRoleName);
}

function FixAccTableRoles(deletedRole) {
    $('#accountTable tbody').find(`a:contains('${deletedRole}')`).text('No Role');
}

async function newRole(e) {
    console.log(e);
    toggleButtonDisabled(e, "#roles");
    var key = 1;
    //Get list of existing role names in db
    var response = await $.ajax({
        type: 'post',
        url: 'customFiles/php/database/roleControls/checkIfNewRoleExist.php',
        dataType: "json",
        data: {
            roleName:name,
        },
        success: function (response) {
            return(response);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            throw (errorThrown);
        }
    });

    if(!response.isSuccessful) {
        throw "Failed to check role name";
    }
    
    while(response.data.includes("Role "+key)){
        key++;
    }
    var roleName = "Role " + key;
    console.log("key is " + key);
    await addRoleToDatabase(roleName);
    toggleButtonDisabled(e, "#roles");
}

async function addRoleToDatabase(roleName = null) {
    if(roleName) {
        await $.ajax({
            type: 'post',
            url: 'customFiles/php/database/roleControls/createNewRole.php',
            data: {
                roleName:roleName,
            },
            success: function (response) {
            console.log("naAdd na sa DB");
            appendToRolesList(roleName);
            console.log("naAdd na sa page");
            }
        });
    } else {
        console.log("No Input pre");
    }
}

function appendToRolesList(name) {
    $.ajax({
        type: 'get',
        url: 'customFiles/php/database/roleControls/getNewRoleCard.php',
        data: {
            roleName:name,
        },
        success: function (response) {
            $('#rolesBody').append(response);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(errorThrown);
        }
    });
}

function generateRoles() {
    $.ajax({
        type: 'post',
        url: 'customFiles/php/database/roleControls/generateRolesList.php',
        success: function (response) {
            $('#rolesBody').append(response);
            getRoleSelectNodes();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(errorThrown);
        }
    });
}

function getRoleSelectNodes() {
    $.ajax({
        type: 'get',
        url: 'customFiles/php/database/roleControls/generateRoleSelectNode.php',
        async: false,
        success: function (response) {
            $('#inputRole').html(response);
            $('#inputChangeAccRole').html(response);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
           console.log(errorThrown);
        }
    });
}

//old generate roles
function OLDgenerateRoles(){
    inList = []
    $('.roleName').each( function() {
        inList.push($(this).text());
      });
    for(var key in roles) {
        if(inList.indexOf(key)!=-1){
            continue;
        };
        roleCardRow = `
        <div class="row">
            <div class="col">
                <div class="card collapsed-card">
                    <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                        <h3 class="card-title ce-noenter ce-limit"><span class="roleName">${key}</span><small class="text-secondary ml-2"><span class="roleCount">${roles[key]['userCount']}</span> <span class="font-weight-light">Account/s</span></small></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <button type="button" class="btn btn-default changeRoleName" data-toggle="modal" data-target="#changeRoleNameModal">Change role name</button>
                            <button type="button" class="btn btn-default mt-1 mt-sm-0" onClick="deleteRole(this)">
                            <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-success ml-2">Save</button>
                            <button type="button" class="btn btn-outline-secondary">Discard</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="row">
                            <div class="col-12">
                                <h5>Rooms</h5>
                            </div>
                            </div> 
                            <div class="row mb-4">
                                <div class="col-12">
                                <div class="form-check selectAllGroup">
                                    <input type="checkbox" class="form-check-input roleSelectAll" id="${key}selectAll1">
                                    <label class="form-check-label" for="${key}selectAll1">Select All</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="${key}check1" ${boolToCheck(roles[key]['access'][0])}>
                                    <label class="form-check-label" for="${key}check1">Add/Delete Rooms</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="${key}check2" ${boolToCheck(roles[key]['access'][1])}>
                                    <label class="form-check-label" for="${key}check2">Manage room thumbnail/image</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="${key}check3" ${boolToCheck(roles[key]['access'][2])}>
                                    <label class="form-check-label" for="${key}check3">Manage room description</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="${key}check4" ${boolToCheck(roles[key]['access'][3])}>
                                    <label class="form-check-label" for="${key}check4">Manage room sections</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="${key}check5" ${boolToCheck(roles[key]['access'][4])}>
                                    <label class="form-check-label" for="${key}check5">Manage room general information</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="${key}check6" ${boolToCheck(roles[key]['access'][5])}>
                                    <label class="form-check-label" for="${key}check6">Manage room rates</label>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                <h5>Accounts</h5>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check selectAllGroup">
                                        <input type="checkbox" class="form-check-input roleSelectAll" id="${key}selectAll3">
                                        <label class="form-check-label" for="${key}selectAll3">Select All</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="${key}check7" ${boolToCheck(roles[key]['access'][7])}>
                                        <label class="form-check-label" for="${key}check7">Add accounts</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="${key}check8" ${boolToCheck(roles[key]['access'][8])}>
                                        <label class="form-check-label" for="${key}check8">Delete accounts</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="${key}check9" ${boolToCheck(roles[key]['access'][9])}>
                                        <label class="form-check-label" for="${key}check9">Reset password</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="${key}check10" ${boolToCheck(roles[key]['access'][10])}>
                                        <label class="form-check-label" for="${key}check10">Manage roles</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="row">
                                <div class="col-12">
                                <h5>Amenities</h5>
                                </div>
                            </div> 
                            <div class="row mb-4">
                                <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="${key}check11" ${boolToCheck(roles[key]['access'][6])}>
                                    <label class="form-check-label" for="${key}check11">Manage amenities</label>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                <h5>Webpage</h5>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check selectAllGroup">
                                        <input type="checkbox" class="form-check-input roleSelectAll" id="${key}selectAll4">
                                        <label class="form-check-label" for="${key}selectAll4">Select All</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="${key}check12" ${boolToCheck(roles[key]['access'][11])}>
                                        <label class="form-check-label" for="${key}check12">Modify company name</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="${key}check13" ${boolToCheck(roles[key]['access'][12])}>
                                        <label class="form-check-label" for="${key}check13">Modify Page Cover</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="${key}check14" ${boolToCheck(roles[key]['access'][13])}>
                                        <label class="form-check-label" for="${key}check14">Modify Company Logo</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="${key}check15" ${boolToCheck(roles[key]['access'][14])}>
                                        <label class="form-check-label" for="${key}check15">Modify Contact Info</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="${key}check16" ${boolToCheck(roles[key]['access'][15])}>
                                        <label class="form-check-label" for="${key}check16">Modify Social Media Links</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="${key}check17" ${boolToCheck(roles[key]['access'][16])}>
                                        <label class="form-check-label" for="${key}check17">Modify Display</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="${key}check18" ${boolToCheck(roles[key]['access'][17])}>
                                        <label class="form-check-label" for="${key}check18">Modify Location</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-3">
                            <div class="row">
                                <div class="col-12">
                                <h5>Vouchers</h5>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="${key}check19" ${boolToCheck(roles[key]['access'][11])}>
                                        <label class="form-check-label" for="${key}check19">Manage Vouchers</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        $('#rolesBody').append(roleCardRow);
        
        option = document.createElement('option');
        option.innerText = key;
        document.getElementById('inputRole').appendChild(option);
    }
}


$('#rolesBody').on('click', '.changeRoleName', function () {
    target = $(this).parents().eq(3).find('.roleName').text();
    document.getElementById('oldRoleName').value = target;
});


$('#rolesBody').on('click', '.roleSelectAll', function () {
    stats = $(this).prop('checked');
    console.log(stats);
    $(this).parents().eq(2).find('input:gt(0)').prop('checked', stats);
});

function countRoles() {
    roleOverall = [];
    count = 0;
    $('#accountTable tbody td:nth-child(6) a').each(function (){
        roleOverall.push($(this).text());
      });
      console.log(roleOverall);
    for(var key in roles) {
        for(var a in roleOverall) {
            if (key==roleOverall[a]) {
                count++;
            }
        }
        roles[key]['userCount'] = count;
        console.log('bilang ', roles[key]['userCount']);
        count = 0;
    }
}

function refreshRoleCount() {
    for(var key in roles) {
        
        $(`#rolesBody h3:contains(${key}) .roleCount`).text(roles[key]['userCount']);
        console.log(roles[key]['userCount']);
    }
}

$("#rolesBody").on("click", "input[type=\"checkbox\"]", function () {
    console.log("ikikik");
    $(this).parents().eq(6).find("span[name=\"changesWarning\"]").removeClass("d-none");
});

countRoles()
generateRoles();

