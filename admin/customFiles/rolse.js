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