<?php
include('db.php');
require_once(dirname(__FILE__, 2)."/public_assets/modules/php/directories/directories.php");
$query = "SELECT companyName FROM companyinfo";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$followingdata = $result->fetch_array(MYSQLI_ASSOC);


if (isset($_POST['submit'])) {
    $comments = $_POST['commentsSuggest'];
    $reservationID = $_POST['reservationID'];

    $queryReviews = "INSERT INTO reviews (reviewID, reservationID, review) VALUES (DEFAULT ,$reservationID, '$comments');";
    mysqli_query($conn, $queryReviews) or die(mysqli_error($conn));
}
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
            <a class="navbar-brand js-scroll-trigger" href="/"><?php echo $followingdata['companyName']; ?></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>
    <?php
    $query = "SELECT socialFB, socialTwitter, socialInstagram, contact, email, footerRight
        FROM socialmedias, companyinfo";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $followingdata = $result->fetch_array(MYSQLI_ASSOC);
    ?>
    <div class="boxinfo">
        <h1>Thank you for your comment and suggestion</h1>
        <br />
        <p>We will improve our services to satisfy our future customers.</p>
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <p><b>Contact us</b></p>
                <p><?php echo $followingdata["contact"]; ?></p>
                <p><a href="mailto:<?php $followingdata["email"]; ?>"><?php echo $followingdata["email"]; ?></a></p>
            </div>
            <div class="col-lg-4 mx-auto">
                <p>Connect with us at</p>
                <a href="<?php echo $followingdata["socialFB"]; ?>" target="_blank"><button type="button" class="btn btn-social-icon btn-facebook btn-rounded"><i class="fa fa-facebook"></i></button></a>
                <a href="<?php echo $followingdata["socialInstagram"]; ?>" target="_blank"><button type="button" class="btn btn-social-icon btn-instagram btn-rounded"><i class="fa fa-instagram"></i></button></a>
                <a href="<?php echo $followingdata["socialTwitter"]; ?>" target="_blank"><button type="button" class="btn btn-social-icon btn-twitter btn-rounded"><i class="fa fa-twitter"></i></button></a>
            </div>
            <div class="col-lg-4 mx-auto">
                <p><?php echo $followingdata["footerRight"]; ?></p>
            </div>
        </div>
    </div>

</body>

</html>