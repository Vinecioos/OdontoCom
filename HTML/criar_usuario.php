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
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $codigoSeg = $_POST["codigoSeg"];

    $sql = "INSERT INTO user (nome, email, telefone, cpf, codigoSeg) VALUES ('$nome', '$email', '$telefone', '$cpf', '$codigoSeg')";

    if ($conexao->query($sql) === TRUE) {
        echo "Novo usuário criado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }

    $conexao->close();
    header("Location: usuario.php");
    exit();
}
?>
