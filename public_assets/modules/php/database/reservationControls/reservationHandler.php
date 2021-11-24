<?php

use phpseclib3\Crypt\EC;

require_once(dirname(__FILE__, 3)."/directories/directories.php");
require_once __F_DB_HANDLER__;
require_once __F_OUTPUT_HANDLER__;
require_once __F_VALIDATIONS__;

function createPaypalPaymentEntry(array|object $result, int|string $reservationID) {
    $xID = $result->purchase_units[0]->payments->captures[0]->id;
    $amount = $result->purchase_units[0]->payments->captures[0]->amount->value;
    $currency = $result->purchase_units[0]->payments->captures[0]->amount->currency_code;
    $sql = "INSERT INTO `paypalpayment`(
            `reservationID`, `orderID`, 
            `payedValue`, `currency`) 
            VALUES (
                $reservationID,'$xID',
                $amount, '$currency');";
    $tempConn = createTempDBConnection();
    mysqli_query($tempConn, $sql);
    mysqli_close($tempConn);
}

function updateReservationAmountTable(array|object &$bp_data, int|string $reservationID) {
    $bp_details = &$bp_data->bp_details;
    $voucher = $bp_details->details->voucher->code;

    $tax_rate = $bp_details->details->tax;
    $PoS_rate = $bp_details->details->DISCOUNT_PWDorSENIOR;
    $serviceCharge_rate = $bp_details->details->serviceCharge;

    $subtotal = $bp_details->amount->subtotal;
    $PoS_discount = $bp_details->amount->PoS_discount;
    $voucher_discount = $bp_details->amount->voucher_discount;
    $initialRoomRate = $subtotal + $voucher_discount;
    $vat = $bp_details->amount->VAT;
    $ServiceCharge = $bp_details->amount->ServiceCharge;
    $total = $bp_details->amount->total;

    $sql = "INSERT INTO `reservation_amount`(
                `reservationID`, `roomRate`, 
                `voucher_value`, `vat_rate`, 
                `serviceCharge_rate`, `vat_value`, 
                `serviceCharge_value`, `total`, 
                `PoS_value`) 
            VALUES (
                $reservationID, $subtotal,
                $voucher_discount, $tax_rate,
                $serviceCharge_rate, $vat,
                $ServiceCharge, $total,
                $PoS_discount);";

    $tempConn = createTempDBConnection();
    mysqli_query($tempConn, $sql);
    mysqli_close($tempConn);
}

function updateToPaid(int $reservationID) {
    $sql = "UPDATE `reservation` SET `reservationStatus`=1 WHERE `reservationID`=$reservationID LIMIT 1;";
    $tempConn = createTempDBConnection();
    mysqli_query($tempConn, $sql);
}

function reserve_bp(array|object &$bp_data) {
    $bp_details = &$bp_data->bp_details;
    $checkIn = $bp_details->details->checkIn;
    $checkOut = $bp_details->details->checkOut;
    $nights = $bp_details->details->nights;
    $roomTypeID = $bp_details->details->room->roomTypeID;
    $bookableRoomNo = getBookableRooms($checkIn, $checkOut, $roomTypeID);
    $voucher = $bp_details->details->voucher->code;
    $PoS_ID = $bp_details->details->PoS_ID;

    $roomName = $bp_details->details->room->name;

    // guest
    $adult = $bp_details->details->guest->adult;
    $child = $bp_details->details->guest->child;

    $subtotal = $bp_details->amount->subtotal;
    $PoS_discount = $bp_details->amount->PoS_discount;
    $voucher_discount = $bp_details->amount->voucher_discount;
    $initialRoomRate = $subtotal + $voucher_discount;
    $vat = $bp_details->amount->VAT;
    $ServiceCharge = $bp_details->amount->ServiceCharge;
    $total = $bp_details->amount->total;


    $mappedRoomNo = array_map(fn($v)=> intval($v['roomNo']), $bookableRoomNo);
    if(count($mappedRoomNo)==0) throw new Exception("No rooms available");
    if($voucher!="")
        if(!checkVoucherValidity($voucher, $initialRoomRate, $roomTypeID)) throw new Exception("Voucher is not available");
    // echo "<pre>".json_encode($mappedRoomNo).'</pre>';
    $id = addCustomerToDB($bp_data);
    $assignedRoomNo = $mappedRoomNo[0];

    $tempConn = createTempDBConnection();

    prepareForSQL($tempConn, $roomName);

    $sql = "INSERT INTO `reservation`(
        `roomNo`, `customerID`, `numberOfNightstay`, 
        `adults`, `children`, `dateCreated`, `checkInDate`, 
        `checkOutDate`, `checkInTime`, `checkOutTime`, `reservationStatus`, `voucher_code`, `PoS_ID`, `roomname`, `origRoomRate`) 
        VALUES (
            {$mappedRoomNo[0]}, $id,
            '$nights', $adult,
            $child, NOW(),
            '$checkIn','$checkOut',
            null, null, 0, '$voucher', '$PoS_ID', '$roomName', $initialRoomRate);";

    if(!mysqli_query($tempConn, $sql)){
        mysqli_query($tempConn, "DELETE FROM `customer` WHERE `customerID`=$id LIMIT;");
        throw new Exception("Something went wrong while creating reservation ".getConnError($tempConn));
    }
    $reservationID = mysqli_insert_id($tempConn);
    mysqli_close($tempConn);
    return $reservationID;
}

function addCustomerToDB(array|object &$bp_data) {
    $bp_details = &$bp_data->bp_details;
    $bp_truForm = &$bp_data->truForm;

    $tempConn = createTempDBConnection();

    $fname = $bp_truForm->fname; prepareForSQL($tempConn, $fname);
    $lname = $bp_truForm->lname; prepareForSQL($tempConn, $lname);
    $cnumber = $bp_truForm->cnumber; prepareForSQL($tempConn, $cnumber);
    $email = $bp_truForm->email; prepareForSQL($tempConn, $email);

    prepareForSQL($tempConn, $fname);
    prepareForSQL($tempConn, $lname);
    prepareForSQL($tempConn, $cnumber);
    prepareForSQL($tempConn, $email);

    $sql = "INSERT INTO `customer`(`fname`, `lname`, `contact`, `email`, `verified`, `verification`) 
            VALUES (
                '$fname', '$lname',
                '$cnumber','$email',
                0, 'None') LIMIT 1;";

    $success = mysqli_query($tempConn, $sql);
    if(!$success) throw new Exception ("Something went wrong while create customer data");
    $id = mysqli_insert_id($tempConn);
    mysqli_close($tempConn);
    return $id;
}

function getBookableRooms(string $checkInDate, string $checkOutDate, int $roomTypeID = null) {
    $origInDate = $checkInDate;
    $origOutDate = $checkOutDate;
    try {
        $checkInDate = DateTime::createFromFormat('Y-m-d', $checkInDate)->format('Y-m-d');
        $checkOutDate = DateTime::createFromFormat('Y-m-d', $checkOutDate)->format('Y-m-d');
    } catch(Exception $e) {
        throw new Exception("Invalid Date format. Should be YYYY-m-d e.g 2000-12-23");
    }
    ($origInDate!=$checkInDate || $origOutDate!=$checkOutDate) && die("Invalid Date");
    ($checkOutDate <= $checkInDate) && throw new Exception("Check-out date must be greter than or equal to check-in date");
    $roomtypeCondition = "";
    if(!is_null($roomTypeID)) {
        (isValidRoomTypeID($roomTypeID)) || throw new Exception("Room type ID not found");
        $roomtypeCondition = "&& RM.`roomTypeID`=$roomTypeID";
    }

//      i = (4, 6)
//      a = (1, 3)
//      ax > ix and ax < iy     check if ax is inside i
//      ay > ix and ay < iy     check if ay is inside i
//      ix > ax and ix < ay     check if ix is inside a
//      iy > ax and iy < ay     check if iy is inside a
//      ax = ix and ay = iy

     $sql = "SELECT * FROM `room` RM  INNER JOIN `roomstatus` RS ON RM.`roomStatusID`=RS.`roomStatusID` WHERE RM.`roomNo` NOT IN (SELECT `roomNo` FROM `reservation` WHERE 
    (`checkInDate` > '$checkInDate' AND `checkInDate` < '$checkOutDate') OR
    (`checkOutDate` > '$checkInDate' AND `checkOutDate` < '$checkOutDate') OR
    ('$checkInDate' > `checkInDate` AND '$checkInDate' < `checkOutDate`) OR
    ('$checkOutDate' > `checkInDate` AND '$checkOutDate' < `checkOutDate`) OR
    ('$checkInDate' = `checkInDate` AND '$checkOutDate' = `checkOutDate`) && `reservationStatus` IN (0,1)
    )  && RS.`bookable`=1 $roomtypeCondition;";
    $tempConn = createTempDBConnection();
    $result = doQuery_fetchAll($tempConn, $sql, MYSQLI_ASSOC);
    mysqli_close($tempConn);
    return $result;
}

function getValidRoomTypeID() {
    $tempConn = createTempDBConnection();
    $sql = "SELECT `roomTypeID` FROM roomtype;";
    $result = mysqli_fetch_all(mysqli_query($tempConn, $sql));
    $mapped = array_map(fn($v) => intval($v[0]), $result);
    mysqli_close($tempConn);
    return $mapped;
}

function isValidRoomTypeID(int $roomTypeID) {
    ($roomTypeID < 0) && throw new Exception("Room Type ID must be a positive integer");
    $roomTypes = getValidRoomTypeID();
    $valid = in_array($roomTypeID, $roomTypes);
    return $valid;
}

function getBookableRoomsID(string $checkInDate, string $checkOutDate) {
    $bookableRooms = getBookableRooms($checkInDate, $checkOutDate);
    $mappedRooms = array_map(fn($v)=> intval($v['roomTypeID']), $bookableRooms);
    $distinctRooms = array_unique($mappedRooms, SORT_NUMERIC);
    return array_values($distinctRooms);
}

function getRoomDetails(array|int $roomTypeID = null) {
    $condition = "";
    if(!is_null($roomTypeID)) {
        $validRoomTypeID = getValidRoomTypeID();
        if(is_integer($roomTypeID)) {
            ($roomTypeID < 0) && throw new Exception("Room Type ID must be a positive integer");
            (in_array($roomTypeID, $validRoomTypeID)) || throw new Exception("Room type ID not found");
            $condition = "WHERE `roomTypeID`=$roomTypeID";
        }
        if(is_array($roomTypeID)) {
            foreach($roomTypeID as $val) {
                // echo is_int($val);
                is_integer($val) || throw new Exception("Room Type ID must be an integer");
                ($val < 0) && throw new Exception("Room Type ID must be a positive integer");
                in_array($val, $validRoomTypeID) || throw new Exception("Room type ID not found");
            }
            $imploded = implode(", ",$roomTypeID);
            $condition = "WHERE `roomTypeID` IN ($imploded)";
        }
    }
    $sql = "SELECT * FROM `roomtype` $condition;";
    $tempConn = createTempDBConnection();
    $result = doQuery_fetchAll($tempConn, $sql, MYSQLI_ASSOC);
    return $result;
}

function decodeCheckinoutDate(string $encodedDate) {
	$d_urlDecoded = urldecode($encodedDate);
	$d_base64Decoded = base64_decode($d_urlDecoded);
	$date = json_decode($d_base64Decoded);
	if(is_null($date)) return false;;
    if(!is_array($date)) return false;
    if(!count($date)==2) return false;
	if(!validateDate($date[0]) && !validateDate($date[1])) return false;
	return $date;
}

function checkVoucherValidity(string $coupon_code, int $price, int $roomTypeID) {
    if($coupon_code=="") return;    
    $tempConn = createTempDBConnection();
    $sql = "SELECT COUNT(*) FROM `promotion` P 
    INNER JOIN `promotionroomtype` PR ON P.`promoCode`=PR.`promoCode` 
    WHERE PR.`roomTypeID`=$roomTypeID && P.`promoCode`='$coupon_code' &&
    P.`minSpend` <= '$price' && P.`maxSpend` >= '$price' && P.`expiry` >= NOW()
     LIMIT 1;";
	$valid = mysqli_fetch_all(mysqli_query($tempConn, $sql))[0][0];
    mysqli_close($tempConn);
    return $valid;
}

function getVoucherDetails(string $coupon_code) {
    $tempConn = createTempDBConnection();
    $sql = "SELECT * FROM `promotion` WHERE `promoCode` = '$coupon_code' LIMIT 1;";
	$data = mysqli_fetch_all(mysqli_query($tempConn, $sql), MYSQLI_ASSOC)[0];
    mysqli_close($tempConn);
    return $data;
}


class bookingPayment {
    private DateTime $date_checkIn;
    private DateTime $date_checkOut;
    private int $roomTypeID;
    private bool $isDiscounted;
    private string $PoS_ID;
    private int $guest_adult;
    private int $guest_child;
    private bool $voucher_valid;
    private string $voucher_code;
    private int $voucher_value;
    private const DISCOUNT_PWDorSENIOR = 0.2;
    private float $tax;
    private float $serviceCharge;
    private $roomDetails;
    private $VALID_BOOKING = TRUE;

    function __construct(DateTime $checkIn, DateTime $checkOut, int $roomTypeID, string $PoS_ID = "", array $guest, string $voucher = "") {
        $this->date_checkIn = $checkIn;
        $this->date_checkOut = $checkOut;
        $this->roomTypeID = $roomTypeID;
        $this->isDiscounted = boolval($PoS_ID);
        $this->PoS_ID = boolval($PoS_ID) ? $PoS_ID : "";
        $this->voucher_code = $voucher;
        $this->setTaxRate();
        $this->setServiceCharge();
        $this->setGuest($guest);
        $this->setRoomDetails($roomTypeID);
        $this->checkRoomAvailability();
        $this->setVoucher();
    }

    function getBookingDetails() {
        $this->checkVoucherAvalability();
        $this->checkRoomAvailability();
        $data = [
            "VALID_BOOKING" => $this->VALID_BOOKING,
            "details" => [
                "checkIn" => $this->date_checkIn->format('Y-m-d'),
                "checkOut" => $this->date_checkOut->format('Y-m-d'),
                "nights" => $this->getNightsCount(),
                "room" => $this->roomDetails,
                "isDiscounted" => $this->isDiscounted,
                "guest" => [
                    "total" => $this->getGuestCount(),
                    "adult" => $this->guest_adult,
                    "child" => $this->guest_child
                ],
                "voucher" => [
                    "isValid" =>  $this->voucher_valid,
                    "code" => $this->voucher_code,
                    "value" => $this->voucher_value
                ],
                "tax" => $this->tax,
                "serviceCharge" => $this->serviceCharge,
                "PoS_ID" => $this->PoS_ID,
                "DISCOUNT_PWDorSENIOR" => self::DISCOUNT_PWDorSENIOR
            ],
            "amount" => [
                "subtotal" => $this->getSubtotal(),
                "PoS_discount" => $this->getPoSDiscount(),
                "voucher_discount" => $this->getVoucherDiscount(),
                "VAT" => $this->getVat(),
                "ServiceCharge" => $this->getServiceCharge(),
                "total" => $this->getTotal()
            ]
        ];
        return $data;
    }

    function getCheckInDate ($asDateTime = FALSE) {
        if($asDateTime) return $this->date_checkIn;
        return $this->date_checkIn->format('Y-m-d');
    }

    function getCheckOutDate ($asDateTime = FALSE) {
        if($asDateTime) return $this->date_checkOut;
        return $this->date_checkOut->format('Y-m-d');
    }

    function getNightsCount() {
        $n_nights = $this->date_checkIn->diff($this->date_checkOut)->format('%a');
        return intval($n_nights);
    }

    function getGuestCount() {
        return $this->guest_adult + $this->guest_child;
    }

    function getRoomTypeID() {
        return $this->roomTypeID;
    }

    function getDiscountedStatus() {
        return $this->isDiscounted;
    }

    private function setRoomDetails($roomTypeID) {
        $this->roomDetails = getRoomDetails($roomTypeID)[0];
    }

    private function setGuest($guest) {
        (count($guest) == 2) || throw new Exception("There must be two values for guest array");
        foreach($guest as $val)
            (is_int($val)) || throw new Exception("Guest values must be an intger");
        $this->guest_adult = intval($guest[0]);
        $this->guest_child = intval($guest[1]);
    }

    private function setTaxRate() {
        $tempConn = createTempDBConnection();
        $tax = mysqli_fetch_all(mysqli_query($tempConn, "SELECT `value` FROM `settings` WHERE `name` like 'tax' LIMIT 1;"))[0][0];
        mysqli_close($tempConn);
        $converted = intval($tax) / 100;
        $this->tax = $converted;
    }

    private function setServiceCharge() {
        $tempConn = createTempDBConnection();
        $serviceCharge = mysqli_fetch_all(mysqli_query($tempConn, "SELECT `value` FROM `settings` WHERE `name` like 'serviceCharge' LIMIT 1;"))[0][0];
        mysqli_close($tempConn);
        $converted = intval($serviceCharge) / 100;
        $this->serviceCharge = $converted;
    }

    private function setVoucher() {
        $voucher = $this->voucher_code;
        $roomTypeID = $this->roomTypeID;
        $validVoucher = checkVoucherValidity($voucher, $this->getTotalRoomRate(), $roomTypeID);
        if($validVoucher) {
            $voucher_value = intval(getVoucherDetails($voucher)['value']);
            $this->voucher_value = $voucher_value;
            $this->voucher_valid = TRUE;
        } else {
            $this->voucher_valid = FALSE;
            $this->voucher_value = 0;
        }

    }
    
    function checkVoucherAvalability() {
        $coupon_code = $this->voucher_code;
        $roomTypeID = $this->roomTypeID;
        $subtotal = $this->getTotalRoomRate();
        $validVoucher = checkVoucherValidity($coupon_code, $subtotal, $roomTypeID);
        if(!$validVoucher) {
            if($coupon_code!="")
                $this->VALID_BOOKING = FALSE;
            $this->voucher_valid = FALSE;
        }
        return $validVoucher;
    }

    function checkRoomAvailability() {
        $rid = $this->roomTypeID;
        $availableRooms = getBookableRoomsID($this->getCheckInDate(), $this->getCheckOutDate());
        $valid = in_array($rid, $availableRooms);
        if(!$valid)
            $this->VALID_BOOKING = FALSE;
        return $valid;
    }

    function getTotalRoomRate() {
        $room_rate = intval($this->roomDetails['rate']);
        return $room_rate * $this->getNightsCount();
    }

    private function getSubtotal() {
        $room_rate = intval($this->roomDetails['rate']);
        $rateXnight = $this->getTotalRoomRate() - $this->voucher_value;
        return $rateXnight;
    }

    private function getPoSDiscount() {
        $PoSDiscount_rate = self::DISCOUNT_PWDorSENIOR;
        if(!$this->isDiscounted)
            return 0;
        $totalRoomRate =  $this->getSubtotal();
        $vat = $totalRoomRate * $this->tax;
        $serviceCharge =  $totalRoomRate *  $this->serviceCharge;
        $totalPrice = $vat + $serviceCharge + $totalRoomRate;
        //senior discount computation
        $dividedRate =  $totalRoomRate / $this->getGuestCount();
        $RateofVat =  $dividedRate * $this->tax;
        $rateMinusVat = $dividedRate - $RateofVat;
        $rateDiscount = $rateMinusVat * self::DISCOUNT_PWDorSENIOR;
        $rateDiscounted = $rateMinusVat - $rateDiscount;
        $totalDiscount = $dividedRate - $rateDiscounted;
        // echo $totalPriceWithDiscount = $totalPrice ;die;
        return $totalDiscount;
    }

    private function getVoucherDiscount() {
        if($this->voucher_valid)
            return $this->voucher_value;
        return 0;
    }

    private function getVat() {
        $subtotal = $this->getSubtotal();
        $tax = $this->tax;
        $value = $subtotal * $tax;
        return $value; 
    }

    private function getServiceCharge() {
        $subtotal = $this->getSubtotal();
        $serviceCharge = $this->serviceCharge;
        $value = $subtotal * $serviceCharge;
        return $value; 
    }

    private function getTotal() {
        $subtotal = $this->getSubtotal();
        $discount_PoS = $this->getPoSDiscount();
        $discount_voucher = $this->getVoucherDiscount();
        $vat = $this->getVat();
        $serviceCharge = $this->getServiceCharge();
        $total = $subtotal + $vat + $serviceCharge - $discount_PoS;
        return $total;
    }
    
}

return;
?>


<pre>
    <?php
        echo json_encode(getRoomDetails(38));
    ?>
</pre>