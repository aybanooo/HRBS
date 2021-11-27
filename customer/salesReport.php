<?php
require_once(dirname(__FILE__,2).'/public_assets/vendor/autoload.php');

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

$sql = "SELECT * FROM `reservation`;";

$data = mysqli_fetch_all(mysqli_query($conn, $sql));

//Uncomment nyo 'to para gumana yung pagprocess ng excel file
/*
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);

// Mahalaga 'to para sa pagdodownload ng file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode('data.xlsx').'"');
$writer->save('php://output');
*/

?>

<pre>
    <?php 
        echo json_encode($data);
    ?>
</pre>