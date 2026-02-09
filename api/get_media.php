<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../includes/functions.php';

$media = getMedia();
echo json_encode($media, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
