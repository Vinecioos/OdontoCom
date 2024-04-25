<?php
session_start();
$dbHost = "Localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "login";

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);


// Recebendo os dados enviados via POST
$taskDateValue = $_POST['task-date'];
$taskTratamento = $_POST['tratamentos'];
$taskHorario = $_POST['horarios'];
$taskDesc = $_POST['task-desc'];
$email = $_SESSION["email"];

$sql = "INSERT INTO consultas (datas, horario, tratamento, descricao, email_cliente) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conexao->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sssss", $taskDateValue, $taskHorario, $taskTratamento, $taskDesc, $email);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
} else {
    echo "error";
}

$conexao->close();
?>
?>