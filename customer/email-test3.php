<?php
 
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
 $mail->Password = "$apiKey'; // GMAIL password
  
 $mail->From = 'thanoshotelreservation@ghrbs.site';
 $mail->FromName   = 'GHRBS';
 $email_template = 'email-template2.html';
 
$username = 'goocoder';
$password = 'password';
 
$message = file_get_contents($email_template);
$message = str_replace('%username%', $username, $message);
$message = str_replace('%password%', $password, $message);
     
$mail->MsgHTML($message);
$mail->Subject = $subject;
$mail->send();
 
?>