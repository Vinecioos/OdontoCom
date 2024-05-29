<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "login";

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $nome = $_POST["nome"];
    $new_email = $_POST["new_email"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $codigoSeg = $_POST["codigoSeg"];

    $sql = "UPDATE user SET nome=?, email=?, telefone=?, cpf=?, codigoSeg=? WHERE email=?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssss", $nome, $new_email, $telefone, $cpf, $codigoSeg, $email);

    if ($stmt->execute()) {
        echo "<script>alert('Usuário atualizado com sucesso!'); window.location='usuario.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar usuário!'); window.location='usuario.php';</script>";
    }

    $stmt->close();
}
$conexao->close();
?>
