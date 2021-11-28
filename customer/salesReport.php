<?php
require_once(dirname(__FILE__, 2) . '/public_assets/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

$servername = 'sql572.main-hosting.eu';
$username = 'u362912910_thanos';
$password = '+O90jwO1!1q';
$dbname = 'u362912910_hrbs';

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * from `reservation` RSV 
            INNER JOIN `customer` C ON RSV.`customerID`= C.`customerID` 
            INNER JOIN `reservation_amount` RSVA ON RSV.`reservationID`= RSVA.`reservationID`
            INNER JOIN `paypalpayment` P ON RSV.`reservationID`= P.`reservationID`;";

$data = mysqli_query($conn, $sql);

if (mysqli_num_rows($data) > 0) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Reservation ID');
    $sheet->setCellValue('B1', 'Booking ID');
    $sheet->setCellValue('C1', 'Customer ID');
    $sheet->setCellValue('D1', 'numberOfNightstay');
    $sheet->setCellValue('E1', 'origRoomRate');
    $sheet->setCellValue('F1', 'Revenue');

    $revenue = $data1["payedValue"] * $data1['numberOfNightstay'];
    
    $rowCount = 2;
    foreach ($data as $data1) {
        $sheet->setCellValue('A' . $rowCount, $data1["reservationID"]);
        $sheet->setCellValue('B' . $rowCount, $data1["customerID"]);
        $sheet->setCellValue('C' . $rowCount, $data1["numberOfNightstay"]);
        $sheet->setCellValue('D' . $rowCount, $data1["payedValue"]);
        $sheet->setCellValue('E' . $rowCount, $data1["origRoomRate"]);
        $sheet->setCellValue('F' . $rowCount, $data1["payedValue"] * $data1['numberOfNightstay']);
        $rowCount++;
    }

    $sheet -> setCellValue('F' . $rowCount =+ 1,$revenue);
    
        

    $writer = new Xlsx($spreadsheet);
    //Mahalaga 'to para sa pagdodownload ng file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode('data.xlsx') . '"');
    $writer->save('php://output');
} else {
    $_SESSION['status'] = "No Record found to export";
}


//Uncomment nyo 'to para gumana yung pagprocess ng excel file






//


?>
<!-- Pang debug -->
<pre>
    <?php
    echo json_encode($data);
    ?>
</pre>

<script>
    console.log(<?php print json_encode($data); ?>);
</script>