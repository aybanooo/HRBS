<?php
$receiver = "benjbenito10@gmail.com";
$subject = "Email Test via PHP using Localhost";
$body = "Hi, there...This is a test email send from Localhost.";
$sender = "From:Thanosthesis@gmail.com";
if(mail($receiver, $subject, $body, $sender)){
    echo "Email sent successfully to $receiver";
}else{
    echo "Sorry, failed while sending mail!";
}
//mail('benjbenito10@gmail.com','Test Subject','Hello There!','From: Thanosthesis@gmail.com')

?>