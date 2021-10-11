<?php
    include "connect.php";
    if (isset($_POST['verifyBtn'])){
        $email = $_POST['email'];
        //verification code
        $verification = bin2hex(random_bytes(19));

        $res = mysqli_query($conn, "INSERT INTO 'customer'('email','verification')values('email','verification')");
        //compose email
        if($res){
            $sub = "Email Verification link";
            $body = "Hello $email, Please verify your email address. Here is the verification code.";
            $sender = "From: Thanosthesis@gmail.com";
            //if successful
            if(mail($email, $sub, $body, $sender)){
                echo "Email verificiation sent succesfully to $email";
            }
            else{//not successful
                mysqli_query($conn, "DELETE FROM 'customer' where 'verification'=''$verification");
                echo "Unable to send verification link";
            }


        }
 }


?>