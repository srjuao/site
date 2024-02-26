<?php
// Verifica se o arquivo foi enviado corretamente
if ($_FILES['videoFile']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro ao enviar o arquivo.']);
    exit();
}

// Move o arquivo para a pasta de vídeos
$uploadDir = 'uploads/';
$uploadedFile = $uploadDir . basename($_FILES['videoFile']['name']);

if (!move_uploaded_file($_FILES['videoFile']['tmp_name'], $uploadedFile)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro ao salvar o arquivo.']);
    exit();
}

echo json_encode(['success' => true]);
?>
