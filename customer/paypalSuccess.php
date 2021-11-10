<?php
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
    $output->setFailed("Cannot connect to database." . $conn->connect_error);
    echo $output->getOutput(true);
    die();
}

 //Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'email-config.php';
require 'vendor/autoload.php';

//Create an instance; passing true enables exceptions
$mail = new PHPMailer(true);
$apiKeyPass = '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';


try {
    //Server settings
    $mail->SMTPDebug = $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.sendgrid.net';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'apikey';                     //SMTP username
    $mail->Password   = $apiKeyPass;                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

    //Recipients
    $mail->setFrom('Thanosemailthesis@gmail.com', 'Thanos');
    $mail->addAddress('benjbenito10@gmail.com');  //Add a recipient

    $body = '<p><strong>Hello<strong/>This is a test email<p/>';


    //Content

    $mail->Subject = 'Test email';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);


    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

$query = "SELECT companyName FROM companyInfo";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$followingdata = $result->fetch_array(MYSQLI_ASSOC);
?>



<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Thank you for booking with us!</title>
    <link rel="icon" type="image/x-icon" href="" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/styles.css" rel="stylesheet" />

    <style type="text/css">
        body {
            padding-top: 65px;
            background-color: #F2F2F3;
        }

        #mainNav .navbar-brand {
            color: rgba(255, 255, 255, 1);
        }

        #mainNav .nav-link {
            color: rgba(255, 255, 255, 1);
        }

        nav#mainNav {
            background-color: black;
            position: fixed;
        }

        h1 {
            text-align: center;
            padding-top: 2%;
            padding-bottom: 2%;
        }

        .boxinfo {
            background-color: white;
            color: black;
            padding: 2%;
            text-align: center;
            margin: 8% auto;
            width: 40%;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.4);
            border-radius: 5px;
        }

        .boxinfo h1 {
            text-align: center;
        }

        .boxinfo p {
            text-align: center;
        }

        .footer {
            background-color: black;
            color: rgba(255, 255, 255, .8);
            padding: 1%;
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        .template-demo>.btn {
            margin-right: 0.5rem;
        }

        .template-demo {
            margin-top: 0.5rem;
        }

        .btn.btn-social-icon {
            width: 50px;
            height: 50px;
            padding: 0
        }

        .btn.btn-rounded {
            border-radius: 50px
        }

        .btn-facebook {
            background: #3b579d;
            color: #ffffff
        }

        .btn-twitter {
            background: #2caae1;
            color: #ffffff
        }

        .btn-instagram {
            background: #dc4a38;
            color: #ffffff
        }

        .btn-facebook:hover,
        .btn-facebook:focus {
            background: #2d4278;
            color: #ffffff
        }

        .btn-twitter:hover,
        .btn-twitter:focus {
            background: #1b8dbf;
            color: #ffffff
        }

        .btn-instagram:hover,
        .btn-instagram:focus {
            background: #bf3322;
            color: #ffffff
        }
    </style>
    <title>Sign Up</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="Customer-Home.html"><?php echo $followingdata['companyName']; ?></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Compare.php">Compare</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Rooms.html">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Amenities.html">Amenities</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger active" href="Customer-Login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    $query = "SELECT socialFB, socialTwitter, socialInstagram, contact, email, footerRight
        FROM socialMedias, companyInfo";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $followingdata = $result->fetch_array(MYSQLI_ASSOC);
    ?>
    <div class="boxinfo">
        <h1>Thank you for booking with us</h1>
        <br />
        <p>A copy of the Reservation and Receipt has been sent to your email. <br />If you have any concern. Dont hesitate to contact us at <b><?php echo $followingdata["contact"]; ?></b> or email us at <b><?php echo $followingdata["email"]; ?></b></p>
    </div>
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <p><b>Contact us</b></p>
                <p><?php echo $followingdata["contact"]; ?></p>
                <p><?php echo $followingdata["email"]; ?></p>
            </div>
            <div class="col-lg-4 mx-auto">
                <p>Connect with us at</p>
                <button type="button" class="btn btn-social-icon btn-facebook btn-rounded" href="<?php echo $followingdata["socialFB"]; ?>"><i class="fa fa-facebook"></i></button>
                <button type="button" class="btn btn-social-icon btn-instagram btn-rounded" href="<?php echo $followingdata["socialInstagram"]; ?>"><i class="fa fa-instagram"></i></button>
                <button type="button" class="btn btn-social-icon btn-twitter btn-rounded" href="<?php echo $followingdata["socialTwitter"]; ?>"><i class="fa fa-twitter"></i></button>
            </div>
            <div class="col-lg-4 mx-auto">
                <p><?php echo $followingdata["footerRight"]; ?></p>
            </div>
        </div>
    </div>

</body>

</html>