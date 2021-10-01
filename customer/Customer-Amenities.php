<?php

require_once("../../directories/directories.php");
require_once(__dbCreds__);
require_once(__outputHandler__);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  $output->setFailed("Cannot connect to database.".$conn->connect_error);
  echo $output->getOutput(true);
  die();
}

$result=mysqli_query($conn, $query);

$query="SELECT amenityName, amenityDesc FROM amenities";

?> 

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
	.amenities{
		background-color: white;
		color: black;
		text-align: center;
		margin: 5% auto;		
		width: 60%;
	box-shadow:0 0 5px 0 rgba(0,0,0,0.4);
		border-radius: 5px;
	}
	.carousel{
		height: 100%;
		width: 95%;
		margin: auto;
		margin-bottom: 4%;
	}
	.footer{
        background-color: black;
        color: rgba(255, 255, 255, .8);
        padding: 1%;
        position: absolute;
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
	</style>
	<title>Amenities</title>
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
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Compare.html">Compare</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Rooms.html">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#amenities">Amenities</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger active" href="Customer-Login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
<?php
if (mysqli_num_rows($result)>0) {
	while($row=mysqli_fetch_assoc($result)){
		echo "<section id='amenities'>";
		echo "    <div class='amenities'>";
		echo "	      <div class='row'>";
        echo "            <div class='col-lg-12 mx-auto'>";
		echo "	    	      <h1><b>".$row["amenityName"]."</b></h1>";
		echo "			          <div id='carouselExampleIndicators' class='carousel slide pointer-event' data-ride='carousel'>";
		echo "		  		          <div class='carousel-inner' role='listbox'>";
		echo "		    		          <div class='carousel-item active'>";
		echo "		      				      <img class='d-block w-100' src='https://cf.bstatic.com/data/xphoto/1182x887/217/21775845.jpg?size=S' data-src='holder.js/900x400?theme=social' alt='900x400' data-holder-rendered='true'>";
		echo "		      				      <div class='carousel-caption d-none d-md-block'>";
		echo "                                    <h3>".$row["amenityName"]."</h3>";
		echo "			          	              <p>".$row["amenityDesc"]."</p>";
		echo "			        	       </div>";
		echo "		    		      </div>";
		echo "		  		      </div>";
		echo "			      </div>";
		echo "		      </div>";
		echo "        </div>";
		echo "    </div>";
		echo "</section>";
	}
} else {
	echo "There are 0 results.";
}
?>
    <section id="amenities">
		<div class="amenities">
			<div class="row">
                <div class="col-lg-12 mx-auto">
			    	<h1><b>Infinity Pool</b></h1>
					<div id="carouselExampleIndicators" class="carousel slide pointer-event" data-ride="carousel">
				  		<div class="carousel-inner" role="listbox">
				    		<div class="carousel-item active">
				      			<img class="d-block w-100" src="https://cf.bstatic.com/data/xphoto/1182x887/217/21775845.jpg?size=S" data-src="holder.js/900x400?theme=social" alt="900x400" data-holder-rendered="true">
				      			<div class="carousel-caption d-none d-md-block">
 
                                <h3>Infinity Pool</h3>
					          	<p>In a 6,000 sqm old orange grove next to the hotel, we have created our Relax Garden Swimming-pool. This is an adults-only (16+) area and an area of relaxation - no music, no animation. The entrance for children is forbidden. This pool is open from mid-May to mid-October, 10:00 18:00, times and dates are subject to change according to weather conditions.

.</p>
					        	</div>
				    		</div>
				  		</div>
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