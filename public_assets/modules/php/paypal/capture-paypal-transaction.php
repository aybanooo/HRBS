<?php
// require __DIR__ . '/vendor/autoload.php';
require_once(dirname(__FILE__, 2)."/public_assets/modules/php/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_RSV_HANDLER__;
require_once __F_VALIDATIONS__;
require_once __F_FORMAT__;

require __AUTOLOAD_PUBLIC__;

//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

include "PayPalClient.php";

class CaptureOrder
{

  // 2. Set up your server to receive a call from the client
  /**
   *This function can be used to capture an order payment by passing the approved
   *order ID as argument.
   *
   *@param orderId
   *@param debug
   *@returns
   */
  public static function captureOrder($orderId, $debug=false)
  {
    $request = new OrdersCaptureRequest($orderId);

    // 3. Call PayPal to capture an authorization
    $client = PayPalClient::client();
    $response = $client->execute($request);
    // 4. Save the capture ID to your database. Implement logic to save capture to your database for future reference.
    if ($debug)
    {
      print "Status Code: {$response->statusCode}\n";
      print "Status: {$response->result->status}\n";
      print "Order ID: {$response->result->id}\n";
      print "Links:\n";
      foreach($response->result->links as $link)
      {
        print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
      }
      print "Capture Ids:\n";
      foreach($response->result->purchase_units as $purchase_unit)
      {
        foreach($purchase_unit->payments->captures as $capture)
        {   
          print "\t{$capture->id}";
        }
      }
      // To print the whole response body, uncomment the following line
      // echo json_encode($response->result, JSON_PRETTY_PRINT);
    }
    // echo json_encode($response);
    return $response;
  }
}

$data = json_decode(file_get_contents('php://input'));
$wtf_bp = $data->bp_data;
// $wtf_bp = "cDRjZW4xNTRxNDg4dTQ3NGg0OTJpMmJjcjQ1Nnc0NzR0NDQybTE1NHUyNDR4NGNlaDE1NG4zZGVoNDEwejNmMnUzZGVtNDJlaDJkYXc0NGNsMTU0cTI0NHcxNTRxMWY0eTFlMHcxZjR1MWVheTFjMmgxZWFrMWVhazFjMngxZjR5MjMwejE1NHMxYjhxMTU0ejNkZW40MTBtM2YybjNkZXA0MmVrMzE2bDQ5Mnk0ODhnMTU0aDI0NHcxNTRyMWY0cTFlMGgxZjRyMWVheTFjMnMxZWF0MWVhZzFjMmsxZmVoMWUwZzE1NHgxYjhsMTU0eTQ3NG00NTZ2NDU2cjQ0Mm4zNDh6NGJhajQ2MHIzZjJtMmRhczJhOGcxNTR5MjQ0eDE1NHExZmV2MjMwbDE1NHkxYjhzMTU0ZzNmY3c0NGN0M2NheTQ0Mm4zZjJrMTU0cjI0NG0xNTRpMmU0dDQ1Nmg0MTB4NDRjdDE0MHIzMDJnM2NhcDQ3NGc0MmV1MTQwazJkYWs0OWNuM2NhaDQ0Y3UxNDB6MjllZzNjYXc0NzRyM2NhcTQxYW40ODhxMTU0cDFiOHUxNTR3NDM4ejQ0Y3QzY2F5NDQybTNmMm8xNTR5MjQ0dTE1NGczM2V2M2NhdzQ0Y3U0ODhrNDU2bDQ3ZW0xNTRwMWI4azE1NHEzZGV3NDRjdTQ5Mm80NDJrM2Q0eTNmMng0NzR0MTU0bTI0NGkxNTRsMWUweTIzYXIyMWNuMjEyZzFmZXExZjR1MjNhaDFmZWgyMWNvMjI2cTFlMHAxNTRqMWI4aDE1NGszZjJoNDQyeTNjYXg0MWFqNDM4czE1NHUyNDRqMTU0cDNlOHQ0MjRnNDU2cTQxMG40NGNpNDQydDNjYXk0NzRnNDJlejQxYXo0OWNsM2NhcjQ0Y2cyODBnNGJhbzNjYXc0MTB2NDU2dzQ1NmwxY2N2M2RlcjQ1Nmg0NDJ3MTU0aTFiOHoxNTR5M2NhbDNlOHg0OTJtNDM4cjQ4OG40N2V2MTU0djI0NHYxNTRuMWY0czE1NHAxYjh2MTU0bzNkZXE0MTBpNDFhdjQzOHMzZThvNDc0bDNmMnM0NGNpMTU0eDI0NHIxNTRoMWUwczE1NGkxYjhpMTU0bTMyMGc0NTZpMzNldTNiNnkyZGF1MmE4bDE1NG8yNDRtMTU0ejE1NGwxYjh4MTU0czQ5Y280NTZ5NDkybzNkZXk0MTB3M2YydzQ3NHMyOWV5NDU2cjNlOG0zZjJpMTU0aDI0NGoxNTR2MTU0eTRlMm8xYjhoMTU0ejNkNHI0NjBuM2I2bzNlOHYzZjJwNDg4dTNjYW00MWFvNDM4aDQ3ZW4xNTR0MjQ0ajRjZXExNTRuMzVjeDI4YWkyZjh2MmRhdzJhOHMzYjZqMjk0ejMxNnMzMTZsMmVlejJkYXgzMGNxMmM2bjE1NG4yNDR3NDg4czQ3NGk0OTJvM2YyazFiOG0xNTRpM2U4eDNmMmg0ODhvM2NhbDQxYW00Mzh3NDdlbzE1NGwyNDRuNGNlcjE1NHkzZGVtNDEwajNmMmgzZGV4NDJldzJkYWs0NGN2MTU0ejI0NGsxNTRsMWY0bDFlMHYxZjR1MWVhdjFjMnIxZWFpMWVheDFjMnoxZjRyMjMwdDE1NHUxYjhnMTU0cDNkZXg0MTB4M2YyajNkZWw0MmVnMzE2eTQ5Mnk0ODh5MTU0czI0NHMxNTRvMWY0bjFlMGsxZjRuMWVhbDFjMmsxZWF4MWVhbzFjMnAxZmVxMWUwczE1NHAxYjhsMTU0bTQ0Y280MWF0NDA2djQxMHc0ODhtNDdldzE1NHoyNDRzMWY0eDFiOHMxNTR1NDc0czQ1NnM0NTZsNDQycTE1NHAyNDRoNGNlczE1NG80NzR1NDU2bDQ1NnU0NDJtMzQ4azRiYXk0NjBpM2YyczJkYXQyYThvMTU0aDI0NGkxNTRxMWZleDIzMGcxNTRqMWI4czE1NHQ0NGN4M2NhbTQ0MngzZjJ1MTU0dTI0NGwxNTRsMmE4djQxYWszZGVzM2NhajQ2MHE0NzRnNDFhdzQ1NnUxODZuNDdlbjE0MGozM2VtNDkycjQxYXU0ODhqM2YyejE1NGgxYjhvMTU0bTNlOHozZjJ0NDdlaTNkZXIxNTRuMjQ0dDE1NG8xODZnMzk4czM5OG0xODZzMmE4aTNmMmc0N2VqM2RlbDQ3NHQ0MWF3NDYwczQ4OG80MWFwNDU2eDQ0Y3ExNDB0NDU2ZzNmY20xNDByNDg4bDQxMHIzZjJ3MTQweTQ3NG80NTZxNDU2cjQ0MnAxY2NtMWNjaDFjY2szOTh5Mzk4cDE4NmgxODZ0MTU0ejFiOGsxNTRnNDQybTNjYXU0YjByMjhhcjNlOHc0OTJtNDM4cTQ4OHQxNTRpMjQ0bTE1NHgxZjRxMTU0bTFiOG0xNTRyNDQydjNjYXg0YjBwMjllczQxMG40MWFsNDM4cDNlOG80NzRvM2YyajQ0Y20xNTR2MjQ0dzE1NGkxZmV2MTU0ZzFiOHExNTR2NDc0eTNjYWc0ODh2M2YyajE1NHQyNDRqMTU0ZzIzMGwyMjZvMWUwbTFlMHcxNTRsNGUycTFiOG8xNTRoNDFhcTQ3ZXUyYThnNDFhajQ3ZWozZGV3NDU2cTQ5Mmc0NGNxNDg4dzNmMnMzZThpMTU0eDI0NGwzZmNuM2NheTQzOGo0N2VxM2YybjFiOGoxNTRzNDA2eTQ5MnozZjJ6NDdlbzQ4OGsxNTR4MjQ0bzRjZXAxNTRsNDg4bDQ1NnA0ODh0M2NheTQzOGwxNTRoMjQ0bDFmNGgxYjh3MTU0cjNjYXUzZThuNDkydzQzOG80ODh2MTU0aDI0NGsxZjR4MWI4cTE1NGszZGVrNDEweDQxYXU0MzhzM2U4dzE1NHAyNDRxMWUwajRlMm8xYjhuMTU0bTQ5Y3o0NTZrNDkybzNkZXA0MTB2M2YyeTQ3NHMxNTRuMjQ0dTRjZXQxNTRoNDFhdTQ3ZXAzNWNuM2NhejQzOHA0MWFtM2U4bzE1NHQyNDR3M2ZjazNjYXU0Mzh5NDdlcDNmMmsxYjhwMTU0cTNkZWo0NTZwM2U4dTNmMncxNTR5MjQ0aTE1NHYxNTRnMWI4dDE1NGk0OWN6M2NhcjQzOHA0OTJ5M2YydzE1NHYyNDR0MWUwcjRlMnYxYjh6MTU0aDQ4OHMzY2FxNGIwejE1NHcyNDR1MWUwZzFjY20xZWFpMWY0cDFiOG8xNTRoNDdlbzNmMmc0NzR1NDljejQxYXEzZGV6M2YydDI5ZW40MTB2M2NhaTQ3NHg0MDZ3M2YyazE1NHcyNDRwMWUweDFjY2kxZWF0MWI4bDE1NGwzMjBzNDU2ajMzZXAzYjZvMmRhdjJhOHExNTRxMjQ0dzE1NGoxNTR1MWI4eTE1NGoyYThxMmRhaTMzZXoyOWV4MzE2ejM1MnAzMGN4MzQ4ZzNiNmozMjBwMzY2ejJhOHU0NTZoNDc0eTMzZWkyYjJuMzBjajJkYWozMTZxMzM0eTE1NHcyNDR2MWUwdjFjY2gxZjR2NGUyejFiOHIxNTRxM2NhajQ0Mmw0NTZuNDkybDQ0Y3U0ODhyMTU0cjI0NHQ0Y2VtMTU0bTQ3ZWk0OTJ0M2Q0ZzQ4OGo0NTZwNDg4cTNjYXo0Mzh3MTU0bDI0NGcxZWFnMjI2eDIwOHkxZTB6MWUwbjFiOHQxNTR3MzIwdzQ1NnEzM2VqM2I2cTNlOHU0MWF5NDdlcDNkZXM0NTZ3NDkyZzQ0Y2g0ODh2MTU0cTI0NHgxZTBvMWI4cjE1NGk0OWNqNDU2aTQ5MmgzZGV0NDEwczNmMng0NzRsM2I2eTNlOHo0MWFxNDdlZzNkZXg0NTZ2NDkydzQ0Y2o0ODhrMTU0cDI0NHYxZTB4MWI4bzE1NHQzNWNuMjhhazM0OG0xNTR6MjQ0ejFmNHUxZTBvMjMwdTIzMHgxYjhyMTU0ZzMzZWwzZjJ3NDc0dzQ5Y280MWFxM2RlbTNmMmkyOWVnNDEwdjNjYXk0NzRzNDA2djNmMnAxNTRqMjQ0djFlYXkyMjZoMjA4cDFlMGwxYjh6MTU0eDQ4OHo0NTZuNDg4ZzNjYXM0MzhnMTU0dTI0NHkxZjRpMWVheTFmNGoxZjRyMjMweDRlMnE0ZTJ0NGUybQ==";
// $orderID = "3LD99948HR576830L";

$bp_data = json_decode(tonotwtf($wtf_bp, 5));

// echo "<pre>".json_encode(getBookableRooms("2021-11-28","2021-11-30", 38))."</pre>"


/**
 *This driver function invokes the captureOrder function with
 *approved order ID to capture the order payment.
 */
if(false)
try {
    if (!count(debug_backtrace())) {
      // $reservationID = reserve_bp($bp_data);
      $response = CaptureOrder::captureOrder($data->orderID);
      echo json_encode($response);
      // updateToPaid($reservationID);
    }
} catch (Exception $e) {
}

exit;
?>

<pre>
  <?php
    echo json_encode($bp_data);
  ?>
</pre>