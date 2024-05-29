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
    $nome = $_POST["nome"];
    $especialidade = $_POST["especialidade"];
    $telefone = $_POST["telefone"];
    $cro = $_POST["cro"];

    $stmt = $conexao->prepare("INSERT INTO profissionais (nome, especialidade, telefone, CRO) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $especialidade, $telefone, $cro);

    if ($stmt->execute() === TRUE) {
        echo "Novo profissional criado com sucesso";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();

    header("Location: profissionais.php");
    exit();
}
?>
