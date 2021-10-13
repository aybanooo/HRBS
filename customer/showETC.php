<?php
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
  $output->setFailed("Cannot connect to database.".$conn->connect_error);
  echo $output->getOutput(true);
  die();
}

$valueFromBooking = $_POST['id'];

$query="SELECT price FROM rate WHERE roomName='{$valueFromBooking}'";
$result=mysqli_query($conn, $query) or die(mysqli_error($conn));
while($row=mysqli_fetch_array($result)){
?>
        <td ><?php echo $row["price"]; ?></td>
<?php
  }  
?>
