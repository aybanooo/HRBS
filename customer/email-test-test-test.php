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
    $mail->Username = 'thanoshotelreservation@ghrbs.site';
    $mail->Password = $apiKey;
    $mail->setFrom('test@hostinger-tutorials.com', 'Your Name');
    $mail->addReplyTo('test@hostinger-tutorials.com', 'Your Name');
    $mail->addAddress('benjbenito10@gmail.com', 'Benj');
    $mail->Subject = 'Testing PHPMailer';
    $mail->msgHTML(file_get_contents('message.html'), __DIR__);
    $mail->Body = 'This is a plain text message body';
    //$mail->addAttachment('test.txt');
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'The email message was sent.';
    }
?>