<?php

require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once __initDB__;
require_once __format__;
include_once "genAmenityCardFunction.php";

$data = [];

if(mysqli_num_rows($result = mysqli_query($conn, "SELECT * FROM `amenities`;"))>0) {
    while($r = mysqli_fetch_assoc($result)) {
         array_push($data, [
            'amenityID' => towtf($r['amenityID'],3),
            'amenityName' => $r['amenityName'],
            'amenityDesc' => $r['amenityDesc'],
            'amenityStatusID' => $r['amenityStatusID'],
        ]);
    }
}

foreach($data as $amenityData) {
    generateAmenityCard($amenityData);
}

?>