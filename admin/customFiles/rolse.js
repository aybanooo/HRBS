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
    toggleButtonDisabled(event, "#roles", "Saving...");
    var form = $(event).closest('div.card-body').children("form.row");
    var acid = $(event).closest("div.card").children('div.card-header').children("input[name='roleID']").val();
    //console.log(form.html());
    var fd = new FormData();
    var perms = {};
    form.find("input[type='checkbox']").each(function() {
        //console.log($(this).attr('data-perm'), $(this).prop('checked'));
        perms[$(this).attr('data-perm')] = $(this).prop('checked');
    });

    console.groupCollapsed('Form Data');
    for (var p of fd.entries()) {
        console.log(p);
    }
    console.groupEnd('Form Data');
    $.ajax({
        type: "post",
        url: "/admin/customFiles/php/database/roleControls/saveRole.php",
        data: {
            acid: acid,
            perms: perms
        },
        dataType: 'json',
        success: function (response) {
            toggleButtonDisabled(event, "#roles", "");
            //console.log(response);
            Toast.fire({
                icon: response.status,
                title: response.message
            });
        }
    });
}

function discardChanges(event) {

}

function deleteRole(event) {
    toggleButtonDisabled(event, "#roles", "");
    var card = $(event).closest("div.card");
    var delid = card.children('div.card-header').children("input[name='roleID']").val();
    $.ajax({
        type: "post",
        url: "/admin/customFiles/php/database/roleControls/deleteRole.php",
        data: {
            delid: delid
        },
        dataType: "json",
        success: function (response) {
            toggleButtonDisabled(event, "#roles", "");
            //console.log(response);
            Toast.fire({
                icon: response.status,
                title: response.message
            });
            if(response.isSuccessful) {
                //console.log(card);
                card.remove();
            }
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

//keep
async function newRole(e) {
    console.log(e);
    toggleButtonDisabled(e, "#roles", "Creating...");
    //Get list of existing role names in db
    await $.ajax({
            type: 'post',
            url: 'customFiles/php/database/roleControls/createNewRole.php',
            dataType: "html",
            success: function (response) {
            //console.log(response);
            console.log("naAdd na sa DB");
            $("#rolesBody").append(response);
            console.log("naAdd na sa page");
            }
        });
    toggleButtonDisabled(e, "#roles");
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

function generateRoles() {
    $.ajax({
        type: "get",
        url: "/admin/customFiles/php/database/roleControls/generateRolesListCards.php",
        dataType: "html",
        success: function (response) {
            $("#rolesBody").append(response);
        }
    });
}

generateRoles();
