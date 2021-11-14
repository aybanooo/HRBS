<?php
include('db.php');

// Iescape natin para iwas SQL injection. Ito din dahilan ng error kapag may quote yung query. 
// Bakit nga pala name ng room yung value? hindi ba dapat ID ng room?
$valueFromBooking = mysqli_real_escape_string($conn, $_POST['id']); 

$query="SELECT rate FROM roomtype WHERE `name`='{$valueFromBooking}'";
$result=mysqli_query($conn, $query) or die(mysqli_error($conn));
while($row=mysqli_fetch_array($result)){
?>
        <td value="<?php echo $row["rate"]?>" name="roomRate"><?php echo $row["rate"]; ?></td>
<?php
  }  
?>
