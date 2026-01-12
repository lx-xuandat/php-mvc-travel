<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Đọc file Excel
$inputFileName = 'provinces.xls';
$spreadsheet = IOFactory::load($inputFileName);
$sheet = $spreadsheet->getActiveSheet();

$provinces = [];

// Bỏ dòng tiêu đề, bắt đầu từ dòng 2
foreach ($sheet->getRowIterator(2) as $row) {
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);

    $rowData = [];
    foreach ($cellIterator as $cell) {
        $rowData[] = $cell->getValue();
    }

    // Cột: Mã | Tên | Tên Tiếng Anh | Cấp | Nghị định
    $provinces[] = [
        'ma'  => $rowData[0],
        'ten' => $rowData[1],
    ];
}

// Xuất ra file JSON
$outputFile = __DIR__ . '/json/provinces.json';
file_put_contents($outputFile, json_encode($provinces, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

echo "Đã tạo file: $outputFile\n";