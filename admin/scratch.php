<?php

?>

<html>
    <head>
        <title>Database Test</title>
    </head>
    <body>
        <form action="./customFiles/php/database/userControls/insertUser.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="name" placeholder="Name" required>
            <input type="submit">
        </form>
        <div id="display_info" >
            output here
        </div>
        <input type="text" id="roleName">
        <button onclick="checkRoleExistence()">Check</button>
    </body>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- Special Script-->
<script>
    
function checkRoleExistence() {
    var name=$("#roleName").val();
        
    if(name) {
        $.ajax({
            type: 'post',
            url: 'customFiles/php/database/roleControls/checkIfNewRoleExist.php',
            data: {
                roleName:name,
            },
            success: function (response) {
                // We get the element having id of display_info and put the response inside it
                $('#display_info').html(response);
            }
        });
    }
    else
    {
    $( '#display_info' ).html("Please Enter Some Words");
    }
}

</script>
</html>