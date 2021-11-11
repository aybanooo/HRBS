<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//require_once 'email-config.php';
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
    $mail->setFrom('thanoshotelreservation@ghrbs.site
    ', 'Thanos');
    $mail->addAddress('benjbenito10@gmail.com');  //Add a recipient
    
    $body = '<p><strong>Hello<strong/>This is a test email<p/>';
  

    //Content
    
    $mail->Subject = 'Test email';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);
    

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>