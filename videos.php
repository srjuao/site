<?php
// Obtém a lista de vídeos na pasta de uploads
$videos = [];
$uploadDir = 'uploads/';
$files = scandir($uploadDir);

foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
        $videos[] = ['path' => $uploadDir . $file];
    }
}

// Retorna a lista de vídeos como JSON
header('Content-Type: application/json');
echo json_encode($videos);
?>

