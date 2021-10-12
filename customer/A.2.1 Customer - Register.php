<?php 
include('dbcon.php');

if(isset($_POST['submit'])){

	//get form data
	$email = $_POST['email'];
	$termsCheck = $_POST['notify'];

	if ($email == null) {
		echo "Please enter an email address.";
	} else {
		//form is valid
		//connect to database
		$mysqli = NEW MySQLi('localhost','root','','test');

		//sanitize form data
		$email = $mysqli->real_escape_string($email);

		//generate verification key
		$verification = md5(time().$email);

		echo $verification;

		//insert account into database and encrypt password
		$password = md5($p);

		$insert = $mysqli->query("INSERT INTO database_name(database_table) VALUES('$data_table_value')"); 

		if ($insert) {
			//send email
			$to = $email;
			$subject = "Email Verification";
			$message = "<a href='link'>";
			$headers = "From";
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			mail($to, $subject, $message, $headers);
			header('location');

		} else {
			echo $mysqli->error;
		}

	}
}
$result=mysqli_query($conn, $queryFooter);
$queryFooter="SELECT * FROM socialMedias";

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>The Grand Budapest | Sign Up</title>
    <link rel="icon" type="image/x-icon" href="" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/styles.css" rel="stylesheet"/>

	<style type="text/css">
	body{ 
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
	h1{
		text-align: center;
		padding-top: 2%;
		padding-bottom: 2%;
	}
	.signupForm{
		background-color: white;
		color: black;
		padding: 2%;
		text-align: center;
		margin: 5% auto;		
		width: 40%;
   		box-shadow: 0 0 5px 0 rgb(0 0 0 / 40%);
		border-radius: 5px;
	}
	input[type=text],input[type=password] {
			border:none;
			background-color:#eee;
			color:#000;
			width:75%;
			margin:auto;
			display:block;
			margin-bottom:4%;
			padding:10px;
			border-radius:25px;
			outline:0;
			padding-left:15px;
			font-size:1em;
			text-align: center;
	}
	input[type=submit] {
			border:none;
			outline:0;
			width:35%;
			padding:10px;
			font-size:.8em;
			border-radius:25px;
			background-color:#2980B9 ;
			color:#fff;
			display:block;
			margin:auto;
			margin-bottom: 5%;
			margin-top: 5%;
			font-size:1.2em;
	}
	input[type=submit]:hover {
		box-shadow:0 0 10px 1px rgb(0,0,0,0.5),0 0 12px 0 rgb(0,0,0,0.5);
		background-color:#2471A3 ;
		transition:0.3s;
		transform:scale(1.050);
		text-decoration:underline;
	}
	.footer{
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
 	.btn-facebook:hover, .btn-facebook:focus {
    	background: #2d4278;
    	color: #ffffff
 	}
 	.btn-twitter:hover, .btn-twitter:focus {
    	background: #1b8dbf;
    	color: #ffffff
 	}
 	.btn-instagram:hover, .btn-instagram:focus {
     	background: #bf3322;
     	color: #ffffff
 	}
 	.new1 {
		border-top: 1px solid #999;
		width:80%;
		margin-bottom:25px;
 	}
	</style>
	<title>Sign Up</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="home.html">The Grand Budapest</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="compare.html">Compare</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="A.0-Customer-Rooms.html">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="A.1 Customer - Amenities.html">Amenities</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger active" href="A.2 Customer - Logina.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="login">
		<div class="signupForm">
			<div class="row">
                <div class="col-lg-12 mx-auto">
		    	<h1><b>Sign Up</b></h1>
		    	<hr class="new1">
		    		<form>	
						<tr>
							<td><input type = "text" required name="email" placeholder = "Email Address"></td>
						</tr>
						<tr>
							<td><input type = "checkbox" required name="notify" required> I have read and accepted the <a href="">Terms of Use</a> and <a href="">Privacy Policy.</a></td>
						</tr>		
						<tr>
							<td align = "center" align = "right"><input type = "submit" formaction="email-confirmation.html" value = "Proceed" name ="signup"></td>
						</tr>
						<tr>
							<td>Already have an account? <a href="A.2 Customer - Logina.html">Login</a></td>
						</tr>
					</form>
				</div>
			</div>
		</div>
	</section>

	<div class="footer">
            <div class="row">
                <div class="col-lg-4 mx-auto">
                    <p><b>Contact us</b></p>
                    <?php
                        echo "<p>".$row["contactNum"]."</p><br/>";
                        "<p>".$row["emailAddress"]."</p>";                
                    ?>
                </div>
                <div class="col-lg-4 mx-auto">
                    <p>Connect with us at</p>
                        <button type='button' class='btn btn-social-icon btn-facebook btn-rounded'><i class='fa fa-facebook'>"<?php echo $row["socialFB"] ?>"</i></button>";
                        <button type='button' class='btn btn-social-icon btn-facebook btn-rounded'><i class='fa fa-instagram'>"<?php echo $row["socialTwitter"] ?>"</i></button>";
                        <button type='button' class='btn btn-social-icon btn-facebook btn-rounded'><i class='fa fa-twitter'>"<?php echo $row["socialInstagram"] ?>"</i></button>";            
                </div>
                <div class="col-lg-4 mx-auto">
                    <p> ®2014-2018 The Grand Budapest </p>
                    <p>All Rights Reserved</p>
                </div>
            </div>
        </div>
</body>
</html>