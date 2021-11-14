<?php

namespace Sample;

require __DIR__ . '/vendor/autoload.php';
//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;
require 'paypalClient.php';
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
    $email = $response->result->payer->email_address;
    $name = $response->result->purchase_units[0]->shipping->name->full_name;
  
    //insert details to database
    include('db.php'); //eto yung conmnection ng database
    //prepare and bind 
    $maxIDQ = "SELECT MAX(customerID) AS 'maxID' FROM customer";
    $maxIDRes = mysqli_query($conn, $maxIDQ);
    $maxIDRow = mysqli_fetch_assoc($maxIDRes);
    $customerID = $maxIDRow['maxID'];
    $stmt = "UPDATE reservation SET reservationStatus = '1' WHERE reservationID = '$customerID'";
    
    if (!$stmt) {
        echo 'There was a problem on your code' .mysqli_error($conn);
    }
    else{
      echo '<script>window.location.href="paypalSuccess.php";</script>';
      mysqli_query($conn, $stmt) or die('Error: ' . mysqli_error($conn));
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
?>