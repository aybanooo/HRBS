<?php

#include('db.php');
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

    use PHPMailer\PHPMailer\PHPMailer;
    require 'vendor/autoload.php';
    $mail = new PHPMailer;
    $mail->IsHTML(true);
    $mail->IsSMTP(true);
    $mail->CharSet = "utf-8";
    // Gmail
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "tls"; // sets the prefix to the servier
    $mail->Host = "smtp.sendgrid.net"; 
    $mail->Port = 587; // set the SMTP port for the GMAIL server
    $mail->Username = 'apikey'; // GMAIL username
    $mail->Password = "$apiKey"; // GMAIL password
     
    $mail->From = 'thanoshotelreservation@ghrbs.site';
    $mail->FromName   = 'GHRBS';
    $email_template = 'email-template.html';
     
    #$username = 'goocoder';
    #$password = 'password';
     
    #$message = file_get_contents($email_template);
    #$message = str_replace('%username%', $username, $message);
    #$message = str_replace('%password%', $password, $message);
         
    $mail->MsgHTML($message);
    $mail->Subject = $subject;
    $mail->send();
     
    ?>    