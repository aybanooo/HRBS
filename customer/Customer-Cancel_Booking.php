<?php
include('db.php');

$query = "SELECT companyName, companyDesc, address, longitude, latitude FROM companyinfo";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$followingdata = $result->fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE HTML>
<html lang="en">

<head>	
    <?php 
		require_once(dirname(__FILE__, 2)."/public_assets/modules/php/directories/directories.php");
		include_once(__D_UI__."js/analytics.php"); 
	?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $followingdata['companyName']; ?> | Cancel Booking</title>
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

        .loginForm h1 {
            text-align: center;
            padding-top: 2%;
            padding-bottom: 2%;
            font-size: 2em;
        }

        .loginForm {
            background-color: white;
            color: black;
            padding: 2%;
            text-align: center;
            margin: 5% auto;
            width: 50%;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.4);
            border-radius: 5px;
        }

        input[type=text],
        input[type=password] {
            border: 1px solid #c1c1c1;
            background-color: #eee;
            color: #000;
            width: 35%;
            margin: auto;
            display: block;
            margin-bottom: 4%;
            padding: 10px;
            border-radius: 25px;
            outline: 0;
            padding-left: 15px;
            font-size: 1em;
            transition: .3s;
            text-align: center;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            border: 1px solid #000;
        }

        input[type=submit] {
            border: none;
            outline: 0;
            width: 35%;
            padding: 10px;
            font-size: .8em;
            border-radius: 25px;
            background-color: #2980B9;
            color: #fff;
            display: block;
            margin: auto;
            margin-bottom: 5%;
            margin-top: 5%;
            font-size: 1.2em;
        }

        input[type=submit]:hover {
            box-shadow: 0 0 5px 1px rgb(0, 0, 0, 0.2), 0 0 2px 0 rgb(0, 0, 0, 0.5);
            background-color: #2471A3;
            transition: 0.3s;
            transform: scale(1.005);
        }

        .footer {
            background-color: black;
            color: rgba(255, 255, 255, .8);
            padding: 1%;
            width: 100%;
            text-align: center;
            position: absolute;
        }

        textarea#exampleFormControlTextarea1 {
            width: 75%;
            margin: auto;
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

        .new1 {
            border-top: 1px solid #999;
            width: 80%;
            margin-bottom: 25px;
        }

        .form-span {
            width: 75%;
            box-sizing: border-box;
            padding: 1em;
            margin: auto;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="Customer-Home.html"><?php echo $followingdata['companyName']; ?></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <section id="login">
        <div class="loginForm">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <h1><b>Booking Cancellation.</b></h1>
                    <hr class="new1">
                    <form action="" method="POST">

                        <tr>
                            <td><input type="text" name="cancellation" required placeholder="Reservation ID"></td>
                        </tr>
                        <tr>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Reason why you want to cancel the booking. "></textarea>
                        </tr>
                        <br>
                        <tr>
                            <td>
                                <input type="checkbox" id="cbverify" required>
                                <label for="cbverify">Are you sure you want to cancel booking?</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="sign" align="center" align="right"><a href="confirmed"><input type="submit" formaction="" value="Submit"></a></td>
                        </tr>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php
    $query = "SELECT socialFB, socialTwitter, socialInstagram, contact, email, footerRight
        FROM socialmedias, companyinfo";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $followingdata = $result->fetch_array(MYSQLI_ASSOC);
    ?>
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