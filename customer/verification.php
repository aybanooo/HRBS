<?php
include "connect.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    if (isset($_POST['verifyBtn'])){
        $email = $_POST['email'];
        //verification code
        $verification = bin2hex(random_bytes(19));

        $res = mysqli_query($conn, "INSERT INTO 'customer'('email','verification')values('email','verification')");
        //compose email
        if($res){
            //$sub = "Email Verification link";
            //$body = "Hello $email, Please verify your email address. Here is the verification code.";
            //$sender = "From: Thanosthesis@gmail.com";
            //if successful
 //-------------------------------------------------------------------------------------------------------           
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$apiKeyPass = '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';

try {
    //Server settings
    $mail->SMTPDebug = $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.sendgrid.net';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'apikey';                     //SMTP username
    $mail->Password   = $apiKeyPass;                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('Thanosthesis@gmail.com', 'Thanos');
    $mail->addAddress('benjbenito10@gmail.com');  //Add a recipient
    
    $body = '<p><strong>Hello<strong/> This is test email with PHPmailer<p/>';
  

    //Content
    
    $mail->Subject = 'Test email';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);
    

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

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