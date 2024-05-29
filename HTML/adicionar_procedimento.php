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
    $tuss = $_POST["TUSS"];
    $profissional = $_POST["profissional"];
    $valor = $_POST["valor"];
    $duracao = $_POST["duracao"];

    $sql = "INSERT INTO tratamentos (nome, tuss, profissional, valor, duracao) VALUES ('$nome', '$tuss', '$profissional', '$valor', '$duracao')";

    if ($conexao->query($sql) === TRUE) {
        echo "Novo procedimento adicionado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }

    $conexao->close();
    header("Location: gerenciar.php");
    exit();
}
?>