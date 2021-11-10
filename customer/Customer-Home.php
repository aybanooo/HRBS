<?php
include('db.php');

$query = "SELECT companyName, companyDesc, address, longitude, latitude  
FROM companyinfo";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$followingdata = $result->fetch_array(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $followingdata['companyName']; ?> | Home</title>
    <link rel="icon" type="image/x-icon" href="" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="dist/simplepicker.css">


    <style type="text/css">
        map {
            height: 500px;
            width: 100%;
        }

        .footer {
            background-color: black;
            color: rgba(255, 255, 255, .8);
            padding: 1%;
            position: static;
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

        .event-log {
            margin: 10px 5px;
            line-height: 2;
            border: 1px solid #4c4c4c;
            height: auto;
            width: 90%;
            padding: 2px 6px;
            color: #4c4c4c;
            white-space: pre;
        }

        .btndate {
            border: none;
            background: white;
            font-size: 16px;
            padding: 7px 14px;
            border: 1px solid #ddd;
            margin: 0 7px;
            color: #016565;
            font-size: 13px;
        }

        .timefeature {
            margin-bottom: 10rem;
        }

        .timebox {
            margin: 3% auto;
            display: flex;
            justify-content: center;
            padding: 5px;
        }

        .picker {
            margin: 0 50px;
        }

        input[type=text] {
            text-align: center;
        }

        input[type=submit] {
            border: none;
            outline: 0;
            width: 20%;
            padding: 10px;
            font-size: .8em;
            border-radius: 10px;
            background-color: #2980B9;
            color: #fff;
            display: block;
            margin: auto;
            margin-bottom: 5%;
            margin-top: -1%;
            font-size: 1.2em;
        }

        input[type=submit]:hover {
            box-shadow: 0 0 5px 1px rgb(0, 0, 0, 0.2), 0 0 2px 0 rgb(0, 0, 0, 0.5);
            background-color: #2471A3;
            transition: 0.3s;
            transform: scale(1.005);
        }
    </style>
</head>

<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top"><?php echo $followingdata['companyName']; ?></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Compare.php">Compare</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Rooms.php">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Customer-Amenities.php">Amenities</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#map">Location</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
                <h1 class="mx-auto my-0 text-uppercase"><?php echo $followingdata["companyName"]; ?></h1>
                <h2 class="text-white-50 mx-auto mt-2 mb-5"><?php echo $followingdata['companyDesc']; ?></h2>
                <a class="btn btn-primary js-scroll-trigger" href="#about">Check Available Dates</a>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="about-section text-center" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-white mb-4">Check Available Dates</h2>
                    <div class="timefeature">
                        <div class="timebox">
                            <button class="btndate button-1">&#128197 </button><input type="text" disabled placeholder="Check-in" id="test1" />
                            <div class="picker-1 picker"></div>
                            <br>

                            <button class="btndate button-2">&#128197 </button><input type="text" disabled placeholder="Check-out" id="test2" />
                            <div class="picker-2 picker"></div>

                            <input type="text" placeholder="Promo code" />
                        </div>

                        <a class="btn btn-primary js-scroll-trigger" href="A.0-Customer-Rooms.html">Book A Room</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Projects-->
    <section class="projects-section bg-light" id="rooms">
        <?php
        $query = "SELECT `name`, `desc` FROM roomtype;";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="container">
                    <!-- Featured Project Row-->
                    <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                        <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="https://806d2bf04cf5fa54997a-e7c5344b3b84eec5da7b51276407b19c.ssl.cf1.rackcdn.com/responsive/1536/806d2bf04cf5fa54997a-e7c5344b3b84eec5da7b51276407b19c.ssl.cf1.rackcdn.com/u/conservatorium/rooms/penthouse/Penthouse-Suite---900--1-.jpg" alt="" /></div>
                        <div class="col-xl-4 col-lg-5">
                            <div class="featured-text text-center text-lg-left">
                                <h4><?php echo $row["name"]; ?></h4>
                                <p class="text-black-50 mb-0"><?php echo $row["desc"]; ?></p>
                            </div>
                        </div>
                    </div>
            <?php
            }
        } else {
            echo "No Rooms Found";
        }
            ?>
            <div class="row justify-content-center no-gutters mb-5 mb-lg-0" id="amenities">
                <?php
                $query = "SELECT amenityName, amenityDesc FROM amenities;";
                $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-lg-6"><img class="img-fluid" src="https://cf.bstatic.com/data/xphoto/1182x887/217/21775845.jpg?size=S" alt="" /></div>
                        <div class="col-lg-6">
                            <div class="bg-black text-center h-100 project">
                                <div class="d-flex h-100">
                                    <div class="project-text w-100 my-auto text-center text-lg-left">
                                        <div class="roomright">
                                            <h4 class="text-white"><?php echo $row["amenityName"]; ?></h4>
                                            <p class="mb-0 text-white-50"><?php echo $row["amenityDesc"]; ?></p>
                                            <hr class="d-none d-lg-block mb-0 ml-0" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "No amenities Found";
                }
                ?>
            </div>
                </div>
                </div>
    </section>
    <!-- Map-->
    <section class="map-section bg-light" id="map">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto text-center">
                    <div id="map"></div>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIwzALxUPNbatRBj3Xi1Uhp0fFzwWNBkE&callback=initMap&libraries=&v=weekly" async></script>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
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
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>
<script src="dist/simplepicker.js"></script>
<script>
    let simplepicker1 = new SimplePicker(".picker-1", {
        zIndex: 10
    });

    let simplepicker2 = new SimplePicker(".picker-2", {
        zIndex: 10
    });

    const $button1 = document.querySelector('.button-1');
    $button1.addEventListener('click', (e) => {
        simplepicker1.open();
    });

    simplepicker1.on("submit", function(date, readableDate) {
        var input = document.querySelector('#test1');
        input.value = readableDate;
    });

    const $button2 = document.querySelector('.button-2');
    $button2.addEventListener('click', (e) => {
        simplepicker2.open();
    });

    simplepicker2.on("submit", function(date, readableDate) {
        var input = document.querySelector('#test2');
        input.value = readableDate;
    });
</script>
<script>
    function initMap() {
        const uluru = {
            lat: 59.9407,
            lng: 30.3254
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: uluru,
        });
        const marker = new google.maps.Marker({
            position: uluru,
            map: map,
        });
    }
</script>