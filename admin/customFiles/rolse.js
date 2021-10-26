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
            if(response.isSuccessful) {
                $(event).closest('.card').children('.card-header').find('span[name="changesWarning"]').addClass('d-none');
            }
        }
    });
}

function discardChanges(event) {
    toggleButtonDisabled(event, "#roles", "");
    $.ajax({
        type: "get",
        url: "/admin/customFiles/php/database/roleControls/discardChanges.php",
        data: {
            acid: $(event).closest('div.card').children('div.card-header').children("input[name='roleID']").val()
        },
        dataType: 'json',
        success: function (response) {
            //console.log(response);
            if(response.isSuccessful) {
                var target = $(event).closest('div.card').children('div.card-body');
                for(const [key, val] of  Object.entries(response.data.perms)) {
                    target.find(`input[type='checkbox'][data-accs='${response.data.id}'][data-perm='${key}']`).prop('checked', val);
                }
                $(event).closest('.card').children('.card-header').find('span[name="changesWarning"]').addClass('d-none');
            }
            toggleButtonDisabled(event, "#roles", "");
        }
    });
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

function updateRoleName(form) {
    var acid = $(form).find("#oldRoleName").attr('data-acid');
    var form = $(form).serializeArray();
    toggleButtonDisabled($("#changeRoleNameForm button[type='submit']"), "#changeRoleNameForm", "");
    $.ajax({
        type: 'post',
        url: 'customFiles/php/database/roleControls/updateRoleName.php',
        data: {
            acid: acid,
            newRoleName: form[1].value,
            pass: form[2].value
        },
        dataType: 'json',
        success: function (response) {
            Toast.fire({
                icon: response.status,
                title: response.message
            });
            if(response.isSuccessful) {
                var target = $(`#rolesBody .card .card-header input[value='${acid}']`).siblings('h3.card-title').children('.roleName');
                target.text(form[1].value);
                $('#changeRoleNameForm').trigger('reset');
                $('#changeRoleNameModal').modal('toggle');
            }
            table.ajax.reload(null, false);
            toggleButtonDisabled($("#changeRoleNameForm button[type='submit']"), "#changeRoleNameForm", "");
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
            getRoleSelectNodes();
            console.log("naAdd na sa page");
            }
        });
    toggleButtonDisabled(e, "#roles");
}


function getRoleSelectNodes() {
    $.ajax({
        type: 'get',
        url: 'customFiles/php/database/roleControls/generateRoleSelectNode.php',
        success: function (response) {
            //console.log(response);
            $("select[name='select-roles']").replaceWith(response);
        }
    });
}

function generateRoles() {
    $.ajax({
        type: "get",
        url: "/admin/customFiles/php/database/roleControls/generateRolesListCards.php",
        dataType: "html",
        success: function (response) {
            getRoleSelectNodes();
            $("#rolesBody").append(response);
        }
    });
}

generateRoles();

//Event Listeners

$("#rolesBody").on('click', "button.changeRoleName", function(e) {
    var oldRoleName = $(this).closest('div.card').children('div.card-header').find('span.roleName').text();
    var acid = $(this).closest('div.card').children('div.card-header').children("input[name='roleID']").val();
    console.log(acid);
    $("#oldRoleName").val(oldRoleName);
    $("#oldRoleName").attr('data-acid', acid);
});

$("#rolesBody").on('change', "input[type='checkbox']", function() {
    //var x = $(this).prop('checked');
    //console.log(x);
    $(this).closest('.card').children('.card-header').find('span[name="changesWarning"]').removeClass('d-none');
});

//Event Listeners End