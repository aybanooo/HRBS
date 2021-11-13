<?php

require_once("../../directories/directories.php");
require_once __F_VALIDATIONS__;
checkAdminSideAccess();


if(isset($_FILES['file']['name'])){
   
   /* Getting file name */
   $filename = $_FILES['file']['name'];
   /* Location */
   $location = __D_PROFILE_PICTURES_ADMIN__.$filename;
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
   $file = __D_DEFAULTS_ADMIN__.'profilePicture.jpg';
   $newfile = __D_PROFILE_PICTURES_ADMIN__.$_POST["empID"].'.jpg';
   if (!copy($file, $newfile)) {
      echo "failed to copy $file...\n";
      //echo "<script>Failed to copy default file</script>";
   }
   exit;
}
echo $_POST["empID"];