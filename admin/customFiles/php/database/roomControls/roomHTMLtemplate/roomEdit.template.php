<?php
require_once("../../../directories/directories.php");
require_once(__initDB__);

/*
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    $output->setFailed("Cannot connect to database.".$conn->connect_error);
    echo $output->getOutput(true);
    die();
    }

    if( !isset($_GET["roomTypeID"]) || empty(trim($_GET["roomTypeID"]))) {
        $output->setFailed("No room name");
        echo $output->getOutput(true);
        die();
    }

    $_GET["roomTypeID"] = trim($_GET["roomTypeID"]);

    $sql = "SELECT * FROM roomtype A INNER JOIN roomsec B ON A.roomTypeID = B.roomTypeID INNER JOIN roominfo C ON B.sectionID = C.roomSecID
    WHERE A.roomTypeID=".$_GET["roomTypeID"];

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        while($rows = mysqli_fetch_assoc($result)) {
            print_r($rows);
            echo '<br>';
            echo '<br>';
        }
    } else {
        $output->setFailed("Something went wrong while getting the room info.");
    }

    die();
*/

?>