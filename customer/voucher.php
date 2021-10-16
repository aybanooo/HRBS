<?php
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
  $output->setFailed("Cannot connect to database.".$conn->connect_error);
  echo $output->getOutput(true);
  die();
}
$coupon_code=$_POST['coupon_code'];
$query=mysqli_query($conn,"select * from promotion where promoCode='$coupon_code' and value=1");
$row=mysqli_fetch_array($query);
if (mysqli_num_rows($query)>0){
	echo json_encode(array(
        "statusCode"=>200,
        "value"=>$row['value']
    ));
}
else{
	echo json_encode(array("statusCode"=>201));
}

?>