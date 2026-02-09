<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$toursDir = __DIR__ . '/../tours';
$tours = [];

if (is_dir($toursDir)) {
    $folders = array_filter(scandir($toursDir), function($item) use ($toursDir) {
        return is_dir($toursDir . '/' . $item) && !in_array($item, ['.', '..']);
    });

    foreach ($folders as $folderName) {
        $folderPath = $toursDir . '/' . $folderName;
        $indexHtml = $folderPath . '/index.html';
        $indexHtm = $folderPath . '/index.htm';
        $thumbnail = $folderPath . '/thumbnail.png';

        $hasIndex = file_exists($indexHtml) || file_exists($indexHtm);
        $hasThumbnail = file_exists($thumbnail);

        if ($hasIndex) {
            $indexFile = file_exists($indexHtml) ? 'index.html' : 'index.htm';
            $tours[] = [
                'id' => $folderName,
                'name' => $folderName,
                'thumbnail' => $hasThumbnail ? "tours/{$folderName}/thumbnail.png" : null,
                'path' => "tours/{$folderName}/{$indexFile}"
            ];
        }
    }
}

echo json_encode($tours, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
