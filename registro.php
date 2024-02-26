<?php
// Conexão com o banco de dados (substitua com suas próprias informações)
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Obter dados do formulário
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Consulta SQL para inserir novo usuário
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    // Usuário cadastrado com sucesso, redirecionar para página de login
    header("Location: index.html");
    exit();
} else {
    echo "Erro ao cadastrar usuário: " . $conn->error;
}

$conn->close();
?>
