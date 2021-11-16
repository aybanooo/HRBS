<?php

#include('db.php');
#$maxIDQ = "SELECT MAX(email) AS 'maxID',  FROM customer";
#$maxIDRes = mysqli_query($conn, $maxIDQ);
#$maxIDRow = mysqli_fetch_assoc($maxIDRes);
#$customerEmail = $maxIDRow['maxID'];
#ini_set( 'display_errors', 1 );
#error_reporting( E_ALL );
$apiKey = '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';
    use PHPMailer\PHPMailer\PHPMailer;
    require 'vendor/autoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Host = 'smtp.sendgrid.net';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'apikey';
    $mail->Password = $apiKey;
    $mail->setFrom('thanoshotelreservation@ghrbs.site', 'Thanos');
    $mail->addReplyTo('thanoshotelreservation@ghrbs.site', 'Thanos');
    $mail->addAddress('benjbenito10@gmail.com', 'Benj');
    $mail->Subject = 'Testing PHPMailer';
    $mail->$htmlContent = ' 
    <html> 
    <head> 
        <title>Welcome to CodexWorld</title> 
    </head> 
    <body> 
        <h1>Thanks you for joining with us!</h1> 
        <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
            <tr> 
                <th>Name:</th><td>CodexWorld</td> 
            </tr> 
            <tr style="background-color: #e0e0e0;"> 
                <th>Email:</th><td>contact@codexworld.com</td> 
            </tr> 
            <tr> 
                <th>Website:</th><td><a href="http://www.codexworld.com">www.codexworld.com</a></td> 
            </tr> 
        </table> 
    </body> 
    </html>'; 
    $mail->Body = 'This is a plain text message body';
    //$mail->addAttachment('test.txt');
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'The email message was sent.';
    }
?>