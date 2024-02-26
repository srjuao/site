<?php
session_start();
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
$password = $_POST['password'];

// Consulta SQL para verificar se o usuário existe
$sql = "SELECT id, username, password FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Usuário encontrado, verificar senha
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Senha correta, definir sessão e redirecionar para página de perfil
        $_SESSION['user_id'] = $row['id'];
        header("Location: perfil.php");
        exit();
    } else {
        // Senha incorreta, redirecionar de volta para página de login
        header("Location: index.html");
        exit();
    }
} else {
    // Usuário não encontrado, redirecionar de volta para página de login
    header("Location: index.html");
    exit();
}

$conn->close();
?>
