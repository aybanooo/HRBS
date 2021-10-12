<?php

$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
  $output->setFailed("Cannot connect to database.".$conn->connect_error);
  echo $output->getOutput(true);
  die();
}

$query="SELECT companyName FROM companyInfo";
$result=mysqli_query($conn, $query) or die(mysqli_error($conn));
$followingdata = $result->fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $followingdata['companyName']; ?> Login</title>
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
	.boxinfo1{
		background-image:linear-gradient(to right, rgba(255, 255, 255, 0), rgba(0, 0, 0, 0.8));
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
		width: 70%;
		height: auto;
		margin:auto;
		margin-top: 5%;
		margin-bottom: 1%;
		box-shadow:0 0 5px 0 rgba(0,0,0,0.4);
		border-radius: 5px;
		padding-bottom:25px;
		overflow: auto;
		padding: 1%;
	}
	.roomright{
		display:block;
		width: 70%;
		float:right;
		padding:2%;
		text-align: justify;
		color: white;
	}
	.roomright h1{
		font-size: 1.5em;
	}
	.roomright p{
		display:block;
		font-size:1em;
		margin-top:15px;
	}
	.roomright button{
		float: right;
	}
	.roomleft{
		display:block;
		width: 70%;
		float:left;
		padding:2%;
		text-align: justify;
		color: white;
	}
	.roomleft h1{
		font-size: 1.5em;
		float: right;
	}
	.roomleft p{
		display:block;
		font-size:1em;
		margin-top:15px;
		text-align:justify;
	}
	.roomleft button{
		float: left;
	}
	.footer{
        background-color: black;
        color: rgba(255, 255, 255, .8);
        padding: 1%;
        position: absolute;
        width: 100%;
        text-align: center;
        bottom: 0;
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
    	padding: 0;
 	}
 	.btn.btn-rounded {
    	border-radius: 50px;
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
		</style>
<title>Home</title>
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
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Compare_Rooms.html">Compare</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#rooms">Rooms</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Amenities.html">Amenities</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <section id="rooms">
            <?php
                $query="SELECT roomName, roomDesc FROM roomtype;";
                $result=mysqli_query($conn, $query) or die(mysqli_error($conn));
                if (mysqli_num_rows($result)>0) {
                    while($row=mysqli_fetch_assoc($result)){
            ?>
				<div class="boxinfo1">
					<div class="roomright">
						<div class="container" id="titleContainer">
							<div class="row">
								<div class="col-sm-8">
									<h1><b><?php echo $row["roomName"]; ?></b></h1>
								</div>
								<div class="col-sm-4">
									<a href="Customer-Room_Details_Imperial.html"><button type="button" class="btn btn-primary" >Book a Room</button></a>
								</div>
							</div>	
								<p><?php echo $row["roomDesc"]; ?></p>
						</div>
					</div>
				</div>
            <?php
                    }
                }
                else{
                    echo "<h1>No Rooms Found</h1>";
                }
            ?>	

		</div>
		</section>
		
	<?php
        $query="SELECT socialFB, socialTwitter, socialInstagram, contact, email, footerRight
        FROM socialMedias, companyInfo";
        $result=mysqli_query($conn, $query) or die(mysqli_error($conn));
        $followingdata = $result->fetch_array(MYSQLI_ASSOC);
    ?>
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