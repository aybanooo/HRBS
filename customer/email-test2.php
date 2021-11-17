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
$mail->Host = 'smtp.sendgrid.net';
$mail->Port = 587;
$mail->Username = 'apikey';
$mail->Password = $apiKey;
$mail->IsSMTP(true);
$mail->CharSet = "utf-8";
$mail->From = "thanoshotelreservation@ghrbs.site";
$mail->FromName = "GHRBS";
$mail->addReplyTo("thanoshotelreservation@ghrbs.site", "Reply Address");
$mail->addAddress("benjbenito10@gmail.com"); 
$mail->Subject  = "Booking Details";
$mail->isHTML(true);
$mail->Body = "<html><body><p><b>Booking ID: bookingID</b></p><pWe look forward to welcoming you to our resort on $checkinDate.</p><br><p>Our professional and friendly staff are committed to ensuring your stay is both enjoyable and comfortable.</p><br><p>Should you have any requests prior to your stay, please do not hesitate to contact us at thanoshotelreservation@ghrbs.site  and we will endeavor to assist you whenever possible.</p><br><br><p>Thanks & Best Regards,</p><br><p>GHRBS team</p></body></html>";
$mail->AltBody = "Booking ID: bookingID\n\nWe look forward to welcoming you to our resort on checkinDate.\n\nOur professional and friendly staff are committed to ensuring your stay is both enjoyable and comfortable.\n\nShould you have any requests prior to your stay, please do not hesitate to contact us at thanoshotelreservation@ghrbs.site  and we will endeavor to assist you whenever possible.\n\nThanks & Best Regards,\n\n
GHRBS team";
?>
 
     
   