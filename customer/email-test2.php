<?php

include('db.php');
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
    #send email to
    $mail->addAddress('benjbenito10@gmail.com', 'Valued Guest');
    $mail->Subject = 'GHRBS booking details';
    
    $mail->Body = 'This is a plain text message body';
    //$mail->addAttachment('test.txt');
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'The email message was sent.';
    }
$mail->Body = "<html><body><p><b>Booking ID: bookingID</b></p><p>We look forward to welcoming you to our resort on checkinDate.</p><br>Our professional and friendly staff are committed to ensuring your stay is both enjoyable and comfortable.</p><br><p>Should you have any requests prior to your stay, please do not hesitate to contact us at thanoshotelreservation@ghrbs.site and we will endeavor to assist you whenever possible.<br><p>Thanks & Best Regards,</p><br><p>GHRBS team</p></body></html>";
$mail->AltBody = "Booking ID: bookingID\n\nWe look forward to welcoming you to our resort on checkinDate.\n\nOur professional and friendly staff are committed to ensuring your stay is both enjoyable and comfortable.\n\nShould you have any requests prior to your stay, please do not hesitate to contact us at thanoshotelreservation@ghrbs.site  and we will endeavor to assist you whenever possible.\n\nThanks & Best Regards,\n\n
GHRBS team";
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}
?>
 
     
   