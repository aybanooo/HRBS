<?php

include('db.php');
#$maxIDQ = "SELECT MAX(email) AS 'maxID',  FROM customer";
#$maxIDRes = mysqli_query($conn, $maxIDQ);
#$maxIDRow = mysqli_fetch_assoc($maxIDRes);
#$customerEmail = $maxIDRow['maxID'];
#ini_set( 'display_errors', 1 );
#error_reporting( E_ALL );
$apiKey = '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';
#$mail->Username = 'apikey';
    #$mail->Password = $apiKey;
    #$mail->setFrom('thanoshotelreservation@ghrbs.site', 'Thanos');
    ##$mail->addReplyTo('thanoshotelreservation@ghrbs.site', 'Thanos');
    #$mail->addAddress('benjbenito10@gmail.com', 'Benj');
    #$mail->Host = 'smtp.sendgrid.net';
    #$mail->Port = 587;
$subject = "testing 123";
    use PHPMailer\PHPMailer\PHPMailer;
    require 'vendor/autoload.php';
    $mail = new PHPMailer;
    $mail->IsHTML(true);
    $mail->IsSMTP(true);
    $mail->SMTPDebug = 2;
    $mail->CharSet = "utf-8";
    // Gmail
   $base_url = "http://localhost/tutorial/email-address-verification-script-using-php/";
   
   $mail_body = "dsfsfdfsdfsdfsf";       //Sets Mailer to send message using SMTP
   $mail->Host = 'smtp.sendgrid.net';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
   $mail->Port = '587';        //Sets the default SMTP server port
   $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
   $mail->Username = 'apikey';     //Sets SMTP username
   $mail->Password = $apiKey;     //Sets SMTP password
   $mail->SMTPSecure = 'tls';       //Sets connection prefix. Options are "", "ssl" or "tls"
   $mail->From = 'thanoshotelreservation@ghrbs.site';   //Sets the From email address for the message
   $mail->FromName = 'GHRBS';     //Sets the From name of the message
   $mail->AddAddress(/*$_POST['user_email']*/'benjbenito10@gmail.com',);  //Adds a "To" address   
   $mail->IsHTML(true);       //Sets message type to HTML    
   $mail->Subject = 'Email Verification';   //Sets the Subject of the message
   $mail->Body = $mail_body;       //An HTML or plain text message body
   if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}
 


?>
 
     
   