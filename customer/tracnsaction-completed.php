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
    //TRANSACTION DETAILS
    $orderID = $response->result->id;
    $email = $response->result->payer->email_address;
    $name = $response->result->purchase_units[0]->shipping->name->full_name;
    $address1 = $response->result->purchase_units[0]->address->address_line_1;
    $address2 = $response->result->purchase_units[0]->address->admin_area_2;
    $address3 = $response->result->purchase_units[0]->address->admin_area_1;
    $address4 = $response->result->purchase_units[0]->address->postal_code;
    $address5 = $response->result->purchase_units[0]->address->country_code;
    $fullAddress = $address1.", ".$address2.", ".$address3.", ".$address4.", ".$address5;

    //insert details to database
    include('dbcon'); //eto yung conmnection ng database
    //prepare and bind 
    $stmt = $con->prepare("INSERT INTO tblname (tablecoloums) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss, $VALUES");
    $stmt->execute();
    if (!$stmt) {
        echo 'There was a problem on your code' .mysqli_error($con);
    }
    else{
        header("Location://paypalSuccess.php");
    }
    $stmt->close();
    $con->close();
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