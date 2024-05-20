<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $dbHost = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "login";

    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    if ($conexao->connect_error) {
        die("Connection failed: " . $conexao->connect_error);
    }

    $sql = "DELETE FROM user WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "<script>alert('Usuário excluído com sucesso!'); window.location='usuario.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir usuário!'); window.location='usuario.php';</script>";
    }

    $stmt->close();
    $conexao->close();
}
?>
