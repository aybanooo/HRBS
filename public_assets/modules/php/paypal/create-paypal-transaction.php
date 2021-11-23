<?php
require_once(dirname(__FILE__, 2)."/public_assets/modules/php/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_RSV_HANDLER__;
require_once __F_VALIDATIONS__;
require_once __F_FORMAT__;

// require __DIR__ . '/vendor/autoload.php';
require __AUTOLOAD_PUBLIC__;
//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

include "PayPalClient.php";

class CreateOrder
{

// 2. Set up your server to receive a call from the client
  /**
   *This is the sample function to create an order. It uses the
   *JSON body returned by buildRequestBody() to create an order.
   */
  public static function createOrder($debug=false)
  {
    $request = new OrdersCreateRequest();
    $request->prefer('return=representation');
    $request->body = self::buildRequestBody();
   // 3. Call PayPal to set up a transaction
    $client = PayPalClient::client();
    $response = $client->execute($request);
    if ($debug)
    {
      print "Status Code: {$response->statusCode}\n";
      print "Status: {$response->result->status}\n";
      print "Order ID: {$response->result->id}\n";
      print "Intent: {$response->result->intent}\n";
      print "Links:\n";
      foreach($response->result->links as $link)
      {
        print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
      }

      // To print the whole response body, uncomment the following line
      // echo json_encode($response->result, JSON_PRETTY_PRINT);
    }
    // echo json_encode($response);
    // 4. Return a successful response to the client.
    return $response;
  }

  /**
     * Setting up the JSON request body for creating the order with minimum request body. The intent in the
     * request body should be "AUTHORIZE" for authorize intent flow.
     *
     */
    private static function buildRequestBody()
    {
      return array(
        'intent' => 'CAPTURE',
        'application_context' =>
            array(
              'shipping_preference' => 'NO_SHIPPING',
              'return_url' => 'https://example.com/return',
              'cancel_url' => 'https://example.com/cancel'
            ),
        'purchase_units' =>
            array(
                0 =>
                    array(
                        'amount' =>
                            array(
                                'currency_code' => 'PHP',
                                'value' => "{$GLOBALS['bp_details']['amount']['total']}"
                            )
                    )
            )
      );
    }
}

$data = json_decode(file_get_contents('php://input'),1);

// activate this vvv for debugging instead of the above
// $data = json_decode($_GET['data'], 1);
// $data['form']['discount'] = '213123-123123-23';
// unset($data['form']['seniorcitizen']);

$PoS_ID = "";
if(isset($data['form']['seniorcitizen']) && $data['form']['discount']!= "" ) {
  $PoS_ID = $data['form']['discount'];
}

$bp_data = [
  "truForm" => [
  "checkIn" => $data['form']['from'],
  "checkOut" => $data['form']['to'],
  "roomTypeID" => $data['form']['roomName'],
  "fname" => $data['form']['fname'],
  "lname" => $data['form']['lname'],
  "cnumber" => $data['form']['cnumber'],
  "email" => $data['form']['email'],
  "adults" => $data['form']['adults'],
  "children" => $data['form']['children'],
  "PoS_ID" => $PoS_ID,
  "voucherCode" => $data['voucher']
  ]
];

$str_checkIn = $bp_data['truForm']['checkIn'];
$str_checkOut = $bp_data['truForm']['checkOut'];
$adult = intval($bp_data['truForm']['adults']);
$child = intval($bp_data['truForm']['children']);
$rid = intval($bp_data['truForm']['roomTypeID']);
$PWDorSENIOR_ID = $bp_data['truForm']['PoS_ID'];
$voucher = $bp_data['truForm']['voucherCode'];
// $voucher = '2dpjdcG';

(validateDate($str_checkIn) && validateDate($str_checkOut)) || throw new Exception("Invalid checkin or checkout date");
$date_checkIn = DateTime::createFromFormat('Y-m-d', $str_checkIn);
$date_checkOut = DateTime::createFromFormat('Y-m-d', $str_checkOut);

$bp = new bookingPayment($date_checkIn, $date_checkOut, $rid, $PWDorSENIOR_ID, [$adult, $child], $voucher);

$bp_details = $bp->getBookingDetails();
$bp_data["bp_details"] = $bp_details;
$wtd_bp = towtf(json_encode($bp_data), 5);
// $unwtd_bp = json_decode(tonotwtf($wtd_bp, 5));
$bp = ["bp_data" => $wtd_bp];

/**
 *This is the driver function that invokes the createOrder function to create
 *a sample order.
 */
if (!count(debug_backtrace()))
{
  $response = CreateOrder::createOrder();
  // $response['result']['form'];
  $response->result  = (object)array_merge((array)$response->result,  $bp);
  echo json_encode($response);
}
exit;
?>

<pre><
  <?php
    echo json_encode($response);
    exit;
  ?>
</pre>
