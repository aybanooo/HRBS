<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$spreadsheet->getDefaultStyle()
->getFont()
->setName('Arial')
->setSize(12);

$spreadsheet->getActiveSheet()
->getColumnDimension('B')
->setAutoSize(true);

$spreadsheet->getActiveSheet()
->getColumnDimension('B')
->setAutoSize(true);

$spreadsheet->getActiveSheet()
->setCellValue('A1', "value")
->setCellValue('B1',)
->setCellValue('C1',)


$spreadsheet->getActiveSheet()
->setCellValue('A1', "value")
->setCellValue('B1',)
->setCellValue('C1',Date::PHPToExcel(datetimenow value));

$spreadsheet->getActiveSheet()
->getStyle('')
->getNumberFormat()
->setFormatCode(FORMAT_DATE_YYYYMMDD2)


$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');

?>