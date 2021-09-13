<?php

require_once("../../directories/directories.php");


if(isset($_FILES['file']['name'])){
   
   /* Getting file name */
   $filename = $_FILES['file']['name'];
   /* Location */
   $location = __profilePictures__.$filename;
   echo $location;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);

   /* Valid extensions */
   $valid_extensions = array("jpg","jpeg");

   print_r($_FILES['file']['name']);

   $response = 0;
   /* Check file extension */
   if(in_array(strtolower($imageFileType), $valid_extensions)) {
      /* Upload file */
      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
         $response = $location;
      }
   }
   echo $response;
   exit;
}
else if(isset($_POST["empID"])){
   echo "eee";
   $file = __defaults__.'profilePicture.jpg';
   $newfile = __profilePictures__.$_POST["empID"].'.jpg';
   if (!copy($file, $newfile)) {
      echo "failed to copy $file...\n";
      //echo "<script>Failed to copy default file</script>";
   }
   exit;
}
echo $_POST["empID"];