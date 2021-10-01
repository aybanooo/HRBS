<?php
    include "connect.php";
    if (isset($_POST['verify'])){
        $_email = $_POST['email'];

        $verification = bin2hex(random_bytes(19));

        $res = mysqli_query($conn,"INSERT INTO `customer`(`email`,`verification`) VALUES ('$email','verification')");
         
            if($res){
                $sub = "Email Verification Link";
                $body = "Welcome $email, Please verify your email address.";
                $sender = "From: Thanosthesis@gmail.com";

                    if(mail($email, $sub, $body, $sender)){
                        header("Location: Customer-Login.php?msg= Email verification send successfully to $email.");
                    }
                    else{
                        mysqli_query($conn, "DELETE FROM `customer` WHERE `verification` = '$verification'");
                        header("Location: Customer-Login.php?msg= Unable to send the verification link.");
                    }
            }
            else{
                header("Location: Customer-Login.php?msg= Unable to connect with database");
            }



    }

?>