<?php
session_start();
// Verificar se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}
// Página de perfil do usuário autenticado
echo "<h2>Perfil</h2>";
echo "<p>Bem-vindo, usuário!</p>";
echo "<p><a href='logout.php'>Sair</a></p>";
?>

