<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>The Grand Budapest | Login</title>
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
	.loginForm{
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
		box-shadow:0 0 5px 1px rgb(0,0,0,0.2),0 0 2px 0 rgb(0,0,0,0.5);
		background-color:#2471A3 ;
		transition:0.3s;
		transform:scale(1.005);
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
    	color: #ffffff;
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
	 .error {color: #FF0000;}
	</style>
	<title>Login</title> 
</head>
<body>
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="Customer-Home.html">The Grand Budapest</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                     	<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Compare_Rooms.html">Compare</a></li>
                    	<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Rooms.html">Rooms</a></li>
                    	<li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Amenities.html">Amenities</a></li>
                    </ul>
                </div>
            </div>
        </nav>

    <section id="login">
		<div class="loginForm">
			<div class="row">
                <div class="col-lg-12 mx-auto">
<<<<<<< Updated upstream:customer/Customer-Login.html
			    	<h1><b>Login</b></h1>
=======
					<?php
						if(isset($_GET['msg'])){
							echo "<center><h4>" . $_GET['msg'] . "</h4></center>";
						}
					?>
			    	<h1><b>Verification</b></h1>
>>>>>>> Stashed changes:customer/Customer-Login.php
			    	<hr class="new1">
			    		<form action="Customer-Email_Verification.php" method="POST" >
							<tr>
<<<<<<< Updated upstream:customer/Customer-Login.html
								<td><input type = "text" name = "email" required placeholder = "Email Address/Phone Number"></td>	
=======
								<td><input type = "text" name = "email" required placeholder = "email / phone number"></td>	
								
>>>>>>> Stashed changes:customer/Customer-Login.php
							</tr>					
							
							<tr>
								<td class="sign" align = "center" align = "right"><input type = "submit" value = "Verify" name = "login"></td>
							</tr>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
		
		<div class="footer">
			 <div class="row">
			    <div class="col-lg-4 mx-auto">
			      	<p><b>Contact us</b></p>
					<p>09051234564</p>
					<p>thegrandbudepest@gmail.com</p>
			    </div>
			    <div class="col-lg-4 mx-auto">
				    <p>Connect with us at</p>
					<button type="button" class="btn btn-social-icon btn-facebook btn-rounded"><i class="fa fa-facebook"></i></button> 
					<button type="button" class="btn btn-social-icon btn-instagram btn-rounded"><i class="fa fa-instagram"></i></button>
					<button type="button" class="btn btn-social-icon btn-twitter btn-rounded"><i class="fa fa-twitter"></i></button>
			   	</div>
			   	<div class="col-lg-4 mx-auto">
				    <p>	®2014-2018 The Grand Budapest </p>
				    <p>All Rights Reserved</p>
			    </div>
			</div>
    	</div>
</body>
</html>