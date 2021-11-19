<?php

require_once(dirname(__FILE__,3)."/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_OUTPUT_HANDLER__;
require_once __F_VALIDATIONS__;
require_once __F_FORMAT__;

function getGeneralInfoItems(&$id, &$conn, &$output) {
    $sql = "SELECT A.sectionID, B.roomInfoID, B.info FROM roomsec A LEFT JOIN roominfo B ON A.sectionID=B.roomSecID WHERE roomTypeID=".$id." AND general=1;";
    $result = mysqli_query($conn, $sql);
    $items = [];
    $itemsContainer = [];
    if(mysqli_num_rows($result) > 0) {
        $rowID = null;
        //echo mysqli_fetch_array($result)[0]."<br/>";
        while($rows = mysqli_fetch_assoc($result)) {

            if (is_null($rowID))
                $rowID= $rows["sectionID"];
            if ($rows["info"] != null) 
                $items += array($rows["roomInfoID"]=> htmlspecialchars($rows["info"], ENT_QUOTES, 'UTF-8') );
                //echo "<textarea style=\"white-space: nowrap;\">";
                //print_r($rows["info"]);
                //echo "</textarea>";
            }
        $itemsContainer = array("genID"=>$rowID);
        $itemsContainer += array("items"=>$items);
    } else {
        $output->setFailed("This room has no general section.");
        echo $output->getOutputAsHTML();
        die();
    }
    return $itemsContainer;
}

function getSectionsAndItems(&$id, &$conn, &$output) {
    $sql = "SELECT A.sectionID, A.sectionIcon, A.sectionName from roomsec A WHERE roomTypeID=".$id." AND general IS NULL";
    $result = mysqli_query($conn, $sql);
    $sections = [];
    if(mysqli_num_rows($result) > 0) {
        //echo mysqli_fetch_array($result)[0]."<br/>";
        //print_r(mysqli_fetch_assoc($result));
        while($rows = mysqli_fetch_assoc($result)) {
            $sql2 = "SELECT roomInfoID, info from roominfo where roomSecID=".$rows["sectionID"];
            $resultSectionItems = mysqli_query($conn, $sql2);
            $tempItemsHolder = [];
            if(mysqli_num_rows($resultSectionItems) > 0)
                while( $row2 = mysqli_fetch_assoc($resultSectionItems) )
                    $tempItemsHolder += array($row2["roomInfoID"] => htmlspecialchars( stripslashes($row2["info"]), ENT_QUOTES, 'UTF-8' ) );
            $sections += array($rows["sectionID"]=> array(
                "sectionIcon"=>$rows["sectionIcon"],
                "sectionName"=>htmlspecialchars($rows["sectionName"]),
                "items" =>  $tempItemsHolder,
                "gallery" =>  getGalleryImages($conn, $rows["sectionID"]))
            );
            
        }
    } else {
        //$output->setFailed("Something went wrong obtaining the room sections and its items.");
        //echo $output->getOutputAsHTML();
        //die();
    }
    //print_r($sections);
    return $sections;
}

function getGalleryImages(&$conn, $sectionID) {
    $sql = "SELECT A.picID, A.picture, A.is360, A.sectionID from gallery A WHERE sectionID=".$sectionID.";";
    $resultGallery = mysqli_query($conn, $sql);
    $tempGalleryHolder = [];
    if(mysqli_num_rows($resultGallery) > 0)
        while($row = mysqli_fetch_assoc($resultGallery) )
                        $tempGalleryHolder += array($row["picID"]=> array("pictureName"=>$row["picture"], "is360"=>$row["is360"]) );
    return $tempGalleryHolder;
}

function getRoomBasicInfo(&$id, &$conn, &$output) {
    $sql = "SELECT A.roomTypeID, A.name, A.desc, A.maxAdult, A.maxChildren, A.rate from roomtype A WHERE roomTypeID=".$id;
    $result = mysqli_query($conn, $sql);
    $basicInfos = [];
    if(mysqli_num_rows($result) > 0) {
        while($rows = mysqli_fetch_assoc($result)) {
            $rows["name"] = htmlspecialchars($rows["name"]); 
            $rows["desc"] = $rows["desc"]; 
            //echo "<script>console.log(`sssss".$rows["desc"]."`)</script>";
            $basicInfos = $rows;
        }
    } else {
        $output->setFailed("This room doesn't exist.");
        echo $output->getOutputAsHTML();
        die();
    }
    return $basicInfos;
}

function getRoomAsAssoc(&$id) {
    global $conn, $output;
    $room = [];
    //$room += array("keykeymo" => "valvasaur");
    //$room += array("gesi" => "tanaka");
    $basicInfo = getRoomBasicInfo($id, $conn, $output);
    $generalInfoItems = getGeneralInfoItems($id, $conn, $output);
    $sectionAndItems = getSectionsAndItems($id, $conn, $output);

    $room += array("basicInfo" => $basicInfo);
    $room += array("generalInfoItems" => $generalInfoItems);
    $room += array("sections" => $sectionAndItems);
    return $room;
}

function roomExist($id) {
    $sql = "SELECT COUNT(*) FROM `roomtype` WHERE `roomTypeID`=$id LIMIT 1;";
    $tempConn = createTempDBConnection();
    $exist = mysqli_fetch_all(mysqli_query($tempConn, $sql))[0][0];
    return intval($exist);
}




$gID = $_GET['r'] ?? "";

$rID = tonotwtf($gID, 3);

$conn = createTempDBConnection();
prepareForSQL($conn, $rID, 1);

$emptyData = [
    "name"=> "",
    "desc" => "",
    "maxAdult"=> "0",
    "maxChildren"=> "0",
    "rate"=> "0",
    "genInfo"=> [],
    "sections" => []
];

if($rID==="") {
    #header("Location: /rooms");{
    echo json_encode($emptyData);
    die();
}

if(!roomExist($rID)) {
    #header("Location: /rooms");
    echo json_encode($emptyData);
    die();
}

$full_room_data = getRoomAsAssoc($rID);
//echo $output->getOutputAsHTML();
//Etong part na to nagdidisplay ng HTML

$flattened_room_data = [];
$genInfo = [
    "genInfo" => $full_room_data['generalInfoItems']['items']
];
$flattened_room_data = array_merge( $full_room_data['basicInfo'], $genInfo);

$sections = [];
foreach($full_room_data['sections'] as $key => $val ) {
    $sectionName = ucwords($val['sectionName']);
    if(array_key_exists($sectionName, $sections)) {
        $sections[$sectionName] = array_merge($sections[$sectionName], $val['items']);
    } else {
        $sections[$sectionName] = $val['items'];
    }
}

$flattened_room_data['sections'] = $sections;

echo json_encode($flattened_room_data);
die;
?>

<script>
    console.log(<?php print json_encode($full_room_data);?>);
</script>
<pre>
    <?php
        echo json_encode($flattened_room_data);exit;
    ?>
</pre>
