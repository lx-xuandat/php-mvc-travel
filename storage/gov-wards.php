<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Đọc file Excel
$inputFileName = 'wards.xls';
$spreadsheet = IOFactory::load($inputFileName);
$sheet = $spreadsheet->getActiveSheet();

$dataByProvince = [];

// Bỏ dòng tiêu đề, bắt đầu từ dòng 2
foreach ($sheet->getRowIterator(2) as $row) {
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);

    $rowData = [];
    foreach ($cellIterator as $cell) {
        $rowData[] = $cell->getValue();
    }

    // Cột: Mã | Tên | Mã TP | Tỉnh / Thành Phố
    $ma     = $rowData[0];
    $ten    = $rowData[1];
    $ma_tp  = $rowData[2];
    $ten_tp = $rowData[3];

    $record = [
        'ma'     => $ma,
        'ten'    => $ten,
        'ma_tp'  => $ma_tp,
        'ten_tp' => $ten_tp,
    ];

    if (!isset($dataByProvince[$ma_tp])) {
        $dataByProvince[$ma_tp] = [];
    }
    $dataByProvince[$ma_tp][] = $record;
}

// Tạo thư mục json nếu chưa có
if (!is_dir('json')) {
    mkdir('json');
}

// Xuất ra nhiều file JSON, mỗi tỉnh một file
foreach ($dataByProvince as $ma_tp => $records) {
    $filename = "json/province_{$ma_tp}.json";
    file_put_contents($filename, json_encode($records, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    echo "Đã tạo file: $filename\n";
}