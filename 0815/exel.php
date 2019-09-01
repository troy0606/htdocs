<?php
    require "../vendor/autoload.php";
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $spreadSheet = new Spreadsheet();
    $sheet = $spreadSheet->getActiveSheet();
    $sheet->setCellValue("B2","Hello");

    $writer = new Xlsx($spreadSheet);
    $writer->save("start.xlsx");
?>