<?php
// Thư mục chứa JSON
$jsonFolder = __DIR__ . '/json';
$configFolder = __DIR__ . '/config';

// Tạo thư mục config nếu chưa có
if (!is_dir($configFolder)) {
    mkdir($configFolder);
}

foreach (glob($jsonFolder . '/*.json') as $file) {
    $jsonContent = file_get_contents($file);
    $data = json_decode($jsonContent, true);

    if (!is_array($data)) {
        echo "Bỏ qua file không hợp lệ: $file\n";
        continue;
    }

    // Chuyển thành mảng với key = ward_{ma}
    $assoc = [];
    foreach ($data as $item) {
        if (isset($item['ma'])) {
            $assoc['ward_' . $item['ma']] = $item;
        }
    }

    // Lấy tên file gốc (không có .json)
    $basename = basename($file, '.json');

    // Xuất ra file config PHP
    $outputFile = $configFolder . '/' . $basename . '.php';
    $content = "<?php\n\nreturn " . var_export($assoc, true) . ";\n";

    file_put_contents($outputFile, $content);
    echo "Đã tạo file config: $outputFile\n";
}