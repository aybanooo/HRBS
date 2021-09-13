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

function roomExist(&$conn) {
    $sql = "SELECT * FROM roomtype where roomTypeID='".$_POST["roomID"]."' LIMIT 1;";
    //echo $sql;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false ;
}

function removeDirectory($path) {
	$deleteFiles = glob($path . '/*');
	foreach ($deleteFiles as $deleteFiles) {
		//is_dir($deleteFiles) ? removeDirectory($deleteFiles) : print($deleteFiles);
		is_dir($deleteFiles) ? removeDirectory($deleteFiles) : unlink($deleteFiles);
        //echo "<br/>s";
	}
    //echo "<br/>";
	//echo $path." LAST";
	rmdir($path);
	return;
}

//removes non-numeric chars on roomID
$_POST["roomID"] =  trim(preg_replace("/[^0-9]/", "", $_POST["roomID"]), " ");

if(empty($_POST["roomID"]))
    die();

if(!roomExist($conn))
    die();

define("DELETE_DIR", __rooms__.$_POST["roomID"]);
//  echo DELETE_DIR;


if( !isset($_POST["roomID"]) || empty(trim($_POST["roomID"]))) {
    $output->setFailed("No room ID");
    echo $output->getOutput(true);
    die();
}



$sql = "delete from roomtype where roomTypeID=".$_POST["roomID"].";";
mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
    $output->setSuccessful("Room deleted successfully");
} else {
    $output->setFailed("Something went wrong while deleting the room.", mysqli_error($conn) );
    echo $output->getOutput(true);
    die();
}

try {
    if(file_exists(DELETE_DIR))
        removeDirectory(DELETE_DIR);
} catch (Exception $e) {
    $output->setFailed("Failed to delete folder and files. ".$e);
    echo $output->getOutput(true);
    die();
}

echo $output->getOutput(true);

?>