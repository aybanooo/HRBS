<?php

namespace Sample;

require_once(dirname(__FILE__,2)."/public_assets/modules/php/directories/directories.php");
require_once __F_DB_HANDLER__;
require __DIR__ . '/vendor/autoload.php';
//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
require 'paypalClient.php';
(empty($_GET['customerID'])) && die("No customer");
$orderID = $_GET['orderID'];

class GetOrder
{

  // 2. Set up your server to receive a call from the client
  /**
   *You can use this function to retrieve an order by passing order ID as an argument.
   */
  public static function getOrder($orderId)
  {

    // 3. Call PayPal to get the transaction details
    $client = PayPalClient::client();
    $response = $client->execute(new OrdersGetRequest($orderId));
    //TRANSACTION DETAILS kukunin mga nasa details form tas ipapasok sa db.
    $orderID = $response->result->id;
  
    //insert details to database
    include('db.php'); //eto yung conmnection ng database
    //prepare and bind 
    $customerID = $_GET['customerID'];
    $stmt = "UPDATE reservation SET reservationStatus = '1' WHERE reservationID = '$customerID'";
    
    if (!$stmt) {
        echo 'There was a problem on your code' .mysqli_error($conn);
    }
    else{
      #echo '<script>window.location.href="paypalSuccess.php";</script>';
      if(!mysqli_query($conn, $stmt)){
          die("Failed to update reservation status");
      }
    /**
     *Enable the following line to print complete response as JSON.
     */
    //print json_encode($response->result);
    //print "Status Code: {$response->statusCode}\n";
    //print "Status: {$response->result->status}\n";
    //print "Order ID: {$response->result->id}\n";
    //print "Intent: {$response->result->intent}\n";
    //print "Links:\n";
    //foreach($response->result->links as $link)
    //{
    //  print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
    //}
    // 4. Save the transaction in your database. Implement logic to save transaction to your database for future reference.
    // print "Gross Amount: {$response->result->purchase_units[0]->amount->currency_code} {$response->result->purchase_units[0]->amount->value}\n";

    // To print the whole response body, uncomment the following line
    // echo json_encode($response->result, JSON_PRETTY_PRINT);
  }
}
}

/**
 *This driver function invokes the getOrder function to retrieve
 *sample order details.
 *
 *To get the correct order ID, this sample uses createOrder to create an order
 *and then uses the newly-created order ID with GetOrder.
 */
if (!count(debug_backtrace()))
{
  GetOrder::getOrder($orderID, true);
}

$customerID = $_GET['customerID'];
$connForEmail = createTempDBConnection();
$customerEmail = mysqli_fetch_all(mysqli_query($connForEmail, "SELECT `email` from `customer` WHERE `customerID`=$customerID LIMIT 1;"))[0][0];

?>

<form action="paypalSuccess.php" method="POST" style="display: none;">
  <input type="text" name="inp-email" value="<?php print $customerEmail; ?>">
  <input type="text" name="inp-cid" value="<?php print $customerID;?>">
  <input id="btn-submit" type="submit" value="submit">
</form>
<script>
  document.getElementById('btn-submit').click();
</script>