<?php
require_once(dirname(__FILE__, 2) . "/public_assets/modules/php/directories/directories.php");
require_once __F_FORMAT__;
require_once __F_VALIDATIONS__;
require_once __F_RSV_HANDLER__;
require_once __AUTOLOAD_PUBLIC__;
use PHPMailer\PHPMailer\PHPMailer;

function getReservationDetails(int|string $reservationID) {
    $sql = "SELECT * from `reservation` RSV 
            INNER JOIN `customer` C ON RSV.`customerID`=C.`customerID` 
            INNER JOIN `reservation_amount` RSVA ON RSV.`reservationID`=RSVA.`reservationID`
            INNER JOIN `paypalpayment` P ON RSV.`reservationID`=P.`reservationID` WHERE RSV.`reservationID`=$reservationID LIMIT 1;";

    $tempConn = createTempDBConnection();
    $data = mysqli_fetch_all(mysqli_query($tempConn, $sql),MYSQLI_ASSOC)[0];
    mysqli_close($tempConn);
    return $data;    
}

function sendMail(int|string $reservationID, $debug = false) {
    $apiKey = parse_ini_file(__CONF_PRIVATE__)['PHPMAILER_API_KEY'];
    $rsvDetails = getReservationDetails($reservationID);
    // echo "<pre>".json_encode($rsvDetails)."</pre>";exit;
    // This variable ($bookingID) is required for the template
    $name = $rsvDetails['fname']." ".$rsvDetails['lname'];
    $bookingID = $rsvDetails['reservationID'];
    $checkInDate =  date('l, F jS Y', strtotime($rsvDetails['checkInDate']));
    $checkoutDate =   date('l, F jS Y', strtotime($rsvDetails['checkOutDate']));
    
    $adult = $rsvDetails['adults'];
    $child = $rsvDetails['children'];

    $guest = "$adult <strong style='color: gray;'>Adult/s</strong> and $child <strong style='color: gray;'>Children</strong>";
    

    $customerEmail = $rsvDetails['email'];
    $roomname = $rsvDetails['roomname'];

    $roomRate = $rsvDetails['roomRate'];
    $vat = $rsvDetails['vat_value'];
    $serviceCharge = $rsvDetails['serviceCharge_value'];
    $voucher_value = $rsvDetails['voucher_value'];
    $PoS_value = $rsvDetails['PoS_value'];
    $total = $rsvDetails['total'];

    $paypalOrderID = $rsvDetails['orderID'];
    $currency = $rsvDetails['currency'];
    
    ob_start();
    include "email-template.php";
    $template = ob_get_contents();  
    ob_end_clean();
    echo $template;
    exit;
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = $debug;
    $mail->Host = 'smtp.sendgrid.net';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'apikey';
    $mail->Password = $apiKey;
    $mail->setFrom('thanoshotelreservation@ghrbs.site', 'Thanos');
    $mail->addReplyTo('thanoshotelreservation@ghrbs.site', 'Thanos');
    $mail->addAddress($customerEmail, 'Valued Guest');
    $mail->Subject = 'GHRBS booking details';
    $mail->Body = $template;
    $mail->IsHTML(true); 
    $mail->AltBody = "Booking ID: bookingID\n\nWe look forward to welcoming you to our resort on checkinDate.\n\nOur professional and friendly staff are committed to ensuring your stay is both enjoyable and comfortable.\n\nShould you have any requests prior to your stay, please do not hesitate to contact us at thanoshotelreservation@ghrbs.site  and we will endeavor to assist you whenever possible.\n\nThanks & Best Regards,\n\n
    GHRBS team";
    //$mail->addAttachment('test.txt');
    if (!$mail->send()) {
        if($debug)
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        return false;
    } else {
        if($debug)
            echo 'The email message was sent.';
        return true;
    }
}

?>
