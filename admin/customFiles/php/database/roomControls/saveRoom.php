<?php

require_once("../../directories/directories.php");
require_once(__initDB__);

function imageNameExistsInGallery(&$conn, $imageName) {
    $sql = "SELECT picture from gallery where picture like '".$imageName."';";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function getUniqueName(&$conn, $fileName) {
    while(imageNameExistsInGallery($conn, $fileName)) {
        $fileName .= "0";
    }
    return $fileName;
}

function insertImageInfoToGallery(&$conn, $sectionID, $pictureName, $is360) {
    $pictureName = "'".$pictureName."'";
    $sql = "INSERT INTO gallery (picture, is360, sectionID) VALUES (".$pictureName.", ".$is360.", ".$sectionID.");";
    if (mysqli_query($conn, $sql)) {
        //echo "Image Successfully added to there.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

//echo getUniqueName($conn, "sad");

//die();

//print_r($_FILES);
//print_r(json_decode($_POST['queries']));

$queries = json_decode($_POST['queries']);

function insertAndMoveGallery(&$conn, &$queries) {
    foreach($queries->insert->gallery as $sectionKey => $value) {
        foreach($value as $imageTempID => $imageInfo ) {
            $imageName = getUniqueName($conn, $imageTempID);
            insertImageInfoToGallery($conn, $sectionKey, $imageName, $imageInfo->is360);
            $imageIndex = array_search($imageTempID, $_FILES['images']['name']);
            $imageDirectory = __D_ROOMS__.$queries->roomTypeID."/";
            //echo $imageDirectory;
            move_uploaded_file($_FILES['images']['tmp_name'][$imageIndex],  $imageDirectory.$imageName.".jpg");
        }
    }
}

//image deletion function for delete section
function batchImageDeletion(&$conn, &$queries, $sectionID) {
    $sql = "SELECT gallery.picID, gallery.picture FROM gallery WHERE sectionID=".$sectionID.";";
    $result = mysqli_query($conn, $sql);
    $imageIDwithFilename = [];
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $imageIDwithFilename += array($row["picID"] => $row["picture"].".jpg");
        }
      }
    foreach($imageIDwithFilename as $imageID => &$filename) {
        if(deleteImageFromDB($conn, $imageID)) {
            deleteImageFileOnDirectory($filename, $queries);
        }
    }
}

//individual image deletion
function processImageDeletion(&$conn, &$queries) {
    if(!count(get_object_vars($queries->delete->gallery)))
        return;
    //$sql = "";
    foreach($queries->delete->gallery as $sectionKey => &$imageIDarray) {
        //print_r($imageIDarray);
        $imageIDwithFilename = getToBeDeletedImageFileName($conn, $imageIDarray);
        //print_r($imageIDwithFilename);
        foreach($imageIDwithFilename as $imageID => &$filename) {
            if(deleteImageFromDB($conn, $imageID)) {
                deleteImageFileOnDirectory($filename, $queries);
            }
        }
    }
}

function deleteImageFromDB(&$conn, $imageID) {
    $sql = "DELETE FROM gallery WHERE picID=".$imageID." LIMIT 1;";
    //echo $sql;
    if (mysqli_query($conn, $sql)) {
        //echo "Image data deleted successfully";
        return true;
    } else {
    echo "Error deleting image data: " . mysqli_error($conn);
    return false;
    }
}

function deleteImageFileOnDirectory(&$filename, &$queries) {
    $filePath = __D_ROOMS__.$queries->roomTypeID."/".$filename;
    if(file_exists($filePath))
        unlink($filePath);
}

function getToBeDeletedImageFileName(&$conn, &$imageIDarray) {
    $tempImageNameArray = [];
    $imageIDsqlReadyStr = "(".implode(", ", $imageIDarray).")";
    $sql = "SELECT gallery.picture, gallery.picID FROM gallery where picID in".$imageIDsqlReadyStr;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result))
       $tempImageNameArray += array($row["picID"] => $row["picture"].".jpg");
    }
    return $tempImageNameArray;
}

function updateImageInfo(&$conn, &$queries) {
    $sql = "";
    foreach($queries->update->gallery as $sectionID => &$value ) {
        foreach($value as $imageInfoKey => $imageInfoValue) {
            $sql .= "UPDATE gallery SET is360='".$imageInfoValue->is360."' WHERE picID=".$imageInfoKey.";";
        }
    }   
    if (empty($sql))
        return;
    if (mysqli_multi_query($conn, $sql)) {
        //echo "New item/s created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
//print_r($queries);

function insertItem(&$conn, &$queries) {
    $sql = "";
    //print_r($queries->insert->items);
    foreach($queries->insert->items as $sectionID => &$value ) {
        foreach($value as &$info) {
            $info = mysqli_real_escape_string($conn, $info);
        }
        $sql .=  "INSERT INTO roominfo (info, roomSecID) VALUES"."('".implode("', ".$sectionID."),('",$value)."', ".$sectionID.");";
    }
    if (empty($sql))
        return;
    //print_r($queries->insert->items);
    //echo $sql;
    //return;
    if (mysqli_multi_query($conn, $sql)) {
        //echo "New item/s created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function updateItem(&$conn, &$queries) {
    foreach($queries->update->items as $sectionKey => $value) {
        foreach($value as $infoID => $info) {
            //echo "item ". $infoID;
            $sql = "UPDATE roominfo SET info='".$info."' WHERE roomInfoID=".$infoID;
            if (mysqli_query($conn, $sql)) {
                //echo "Item Updated";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }
}

function deleteItem(&$conn, &$queries) {
    foreach($queries->delete->items as $sectionKey => $value) {
        $sql = "DELETE FROM roominfo WHERE roomInfoID in (".implode(', ', $value).");";
        if (mysqli_query($conn, $sql)) {
            //echo "Items deleted";
        } else {
            echo "Error deleting records: " . mysqli_error($conn);
        }
    }
}

function insertSection(&$conn, &$queries) {
    $sql = "";
    foreach($queries->insert->sections as &$sections) {
        $sql .= "INSERT INTO roomsec (sectionName, sectionIcon, roomTypeID) values('".$sections->sectionName."', '".$sections->sectionIcon."', ".$queries->roomTypeID.");";
    }
    if (empty($sql))
        return;
    if (mysqli_multi_query($conn, $sql)) {
        //echo "New sections created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function deleteSection(&$conn, &$queries) {
    //delete images data on DB and FS
    foreach($queries->delete->sections as &$sectionID) {
        batchImageDeletion($conn, $queries, $sectionID);
    }
    //delete section data on DB
    $sql = "";
    foreach($queries->delete->sections as &$sectionID) {
        $sql .= "DELETE FROM roomsec WHERE sectionID=".$sectionID.";";
    }
    //echo $sql;
    if (empty($sql))
        return;
    if (mysqli_multi_query($conn, $sql)) {
        //echo "Sections deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function updateRoomInfo(&$conn, &$queries) {
    if(property_exists($queries->update->roomInfo, "roomName")) 
        updateRoomName($conn, $queries);
        
    if(property_exists($queries->update->roomInfo, "roomCover")) 
        updateRoomCover($conn, $queries);
    
    if(property_exists($queries->update->roomInfo, "description")) 
       updateRoomDescription($conn, $queries);

    if(property_exists($queries->update->roomInfo, "maxAdult")) 
        maxAdult($conn, $queries);

    if(property_exists($queries->update->roomInfo, "maxChild")) 
        maxChild($conn, $queries);
        
    if(property_exists($queries->update->roomInfo, "rate")) 
        updateRate($conn, $queries);
}

function updateRoomName(&$conn, &$queries) {
        $roomName = $queries->update->roomInfo->roomName;
        $roomTypeID = $queries->roomTypeID;
        $sql = "UPDATE roomtype SET roomtype.name='".$roomName."' WHERE roomTypeID=".$roomTypeID;
        if (mysqli_query($conn, $sql)) {
            //echo "Room name updated";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
}


function updateRoomDescription(&$conn, &$queries) {
    $description = $queries->update->roomInfo->description;
    $roomTypeID = $queries->roomTypeID;
    $sql = "UPDATE roomtype SET roomtype.desc='".$description."' WHERE roomTypeID=".$roomTypeID;
    if (mysqli_query($conn, $sql)) {
        //echo "Room description updated";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

function updateRoomCover(&$conn, &$queries) {
    $coverIndex = array_search("roomCover", $_FILES['images']['name']);
    //echo $coverIndex;
    $imagePath = __D_ROOMS__.$queries->roomTypeID."/".$queries->roomTypeID."-cover.jpg";
    //echo $imageDirectory."\n";
    //echo file_exists($imageDirectory) ? "Exists" : "Nah";
    move_uploaded_file($_FILES['images']['tmp_name'][$coverIndex], $imagePath);
}

function maxAdult(&$conn, &$queries) {
    $maxAdult = $queries->update->roomInfo->maxAdult;
    $roomTypeID = $queries->roomTypeID;
    $sql = "UPDATE roomtype SET roomtype.maxAdult=".$maxAdult." WHERE roomTypeID=".$roomTypeID;
    //echo $sql;return;
    if (mysqli_query($conn, $sql)) {
        //echo "Room max adult updated";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

function maxChild(&$conn, &$queries) {
    $maxChild = $queries->update->roomInfo->maxChild;
    $roomTypeID = $queries->roomTypeID;
    $sql = "UPDATE roomtype SET roomtype.maxChildren=".$maxChild." WHERE roomTypeID=".$roomTypeID;
    //echo $sql;return;
    if (mysqli_query($conn, $sql)) {
        //echo "Room max child updated";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}


function updateRate(&$conn, &$queries) {
    $rate = $queries->update->roomInfo->rate;
    $roomTypeID = $queries->roomTypeID;
    $sql = "UPDATE roomtype SET roomtype.rate=".$rate." WHERE roomTypeID=".$roomTypeID;
    //echo $sql;return;
    if (mysqli_query($conn, $sql)) {
        //echo "Room max adult updated";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

function fixQueryStringToMysqlChars(&$conn, &$queries) {
    //insert items query
    foreach($queries->insert->items as $sectionID => &$value ) {
        foreach($value as &$info) {
            $info = mysqli_real_escape_string($conn, $info);
        }
    }

    //update items query
    foreach($queries->update->items as $sectionID => &$value ) {
        foreach($value as $infoID => &$info) {
            $info = mysqli_real_escape_string($conn, $info );
        }
    }

    //delete section query
    foreach($queries->delete->sections as &$value ) {
        $value = mysqli_real_escape_string($conn,  $value);
    }

    //insert section query
    foreach($queries->insert->sections as &$value ) {
        $value->sectionName = mysqli_real_escape_string($conn,  $value->sectionName);
        $value->sectionIcon = mysqli_real_escape_string($conn,  $value->sectionIcon);
    }


    if(property_exists($queries->update->roomInfo, "roomName")) 
        $queries->update->roomInfo->roomName = mysqli_real_escape_string($conn,  ($queries->update->roomInfo->roomName) );
    
    if(property_exists($queries->update->roomInfo, "description")) 
        $queries->update->roomInfo->description = mysqli_real_escape_string($conn,  $queries->update->roomInfo->description );
    
    if(property_exists($queries->update->roomInfo, "maxChild")) 
        $queries->update->roomInfo->maxChild = mysqli_real_escape_string($conn,  preg_replace("/[^0-9]/", "", $queries->update->roomInfo->maxChild) );

    if(property_exists($queries->update->roomInfo, "maxAdult")) 
    $queries->update->roomInfo->maxAdult = mysqli_real_escape_string($conn,   preg_replace("/[^0-9]/", "", $queries->update->roomInfo->maxAdult) );

}   

//$output->setFailed('Wais');

//echo $output->getOutput(true);

//die();

$output->setSuccessful("Saved Successfully");

try {
fixQueryStringToMysqlChars($conn, $queries);
} catch (Exception $error) {
    $output->setFailed("Something went wrong while processing the data. Please try again", $error);
    die();
}
//print_r($queries);
//print_r($_FILES);

try {
updateRoomInfo($conn, $queries);
} catch (Exception $error) {
    $output->setFailed("Something went wrong while saving the room info. Please try again", $error);
    die();
}

try {
updateItem($conn, $queries);
} catch (Exception $error) {
    $output->setFailed("Something went wrong while updating the room info list item/s. Please try again", $error);
    die();
}

try {
deleteItem($conn, $queries);
} catch (Exception $error) {
    $output->setFailed("Something went wrong while the room info list item/s. Please try again", $error);
    die();
}

try {
insertItem($conn, $queries);
} catch (Exception $error) {
    $output->setFailed("Something went wrong while creating the room info list item/s. Please try again", $error);
    die();
}

try {
insertSection($conn, $queries);
} catch (Exception $error) {
    $output->setFailed("Something went wrong while creating the new section/s. Please try again", $error);
    die();
}

try {

deleteSection($conn, $queries);
} catch (Exception $error) {
    $output->setFailed("Something went wrong while removing the section/s. Please try again", $error);
    die();
}

try {
updateImageInfo($conn, $queries);
} catch (Exception $error) {
    $output->setFailed("Something went wrong while updating the image/s. Please try again", $error);
    die();
}

try {
processImageDeletion($conn, $queries);
} catch (Exception $error) {
    $output->setFailed("Something went wrong while removing the image/s. Please try again", $error);
    die();
}

//print_r($queries);
try {
    if(count(get_object_vars($queries->insert->gallery))) {
        //echo "has images";
        insertAndMoveGallery($conn, $queries);
    }
} catch (Exception $error) {
    $output->setFailed("Something went wrong while saving the image/s. Please try again", $error);
    die();
}

echo $output->getOutput(true);

/*
foreach ($_FILES['roomCover']['tmp_name'] as $index => &$value) {
    move_uploaded_file($value,  __D_ROOMS__. $_FILES['roomCover']['name'][$index].".jpg");
}*/
//move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
//$output->output["data"]=$_POST["queries"];
//echo $output->getOutput;

?>