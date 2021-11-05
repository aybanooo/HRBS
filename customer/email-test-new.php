<?php
require_once 'email-config.php'
require 'vendor/autoload.php'; // If you're using Composer (recommended)

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("thanosemailthesis@gmail.com", "ghrbs");
$email->setSubject("Booking Details");
$email->addTo("benjbenito10@gmail.com");
$email->addContent("text/plain", "Your booking details are listed below");
$email->addContent(
    "text/html", "<strong>Your booking details are listed below</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}