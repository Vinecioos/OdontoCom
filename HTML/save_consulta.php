<?php
session_start();
$dbHost = "Localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "login";

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);


$taskDateValue = $_POST['task-date'];
$taskTratamento = $_POST['tratamentos'];
$taskHorario = $_POST['horarios'];
$taskDesc = $_POST['task-desc'];
$email = $_SESSION["email"];

// Verificação de consulta existente
$verificaConsulta = "SELECT COUNT(*) as total FROM consultas WHERE datas = ? AND horario = ?";
$stmtVerifica = $conexao->prepare($verificaConsulta);
$stmtVerifica->bind_param("ss", $taskDateValue, $taskHorario);  // Corrigido para "ss"
$stmtVerifica->execute();
$resultadoVerificacao = $stmtVerifica->get_result();
$row = $resultadoVerificacao->fetch_assoc();
$totalConsultas = $row['total'];

if ($totalConsultas > 0) {
    echo "Erro: Já existe uma consulta agendada para esta data e horário.";
    exit;
}

$sql = "INSERT INTO consultas (datas, horario, tratamento, descricao, email_cliente) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conexao->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sssss", $taskDateValue, $taskHorario, $taskTratamento, $taskDesc, $email);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }

    $stmt->close();
} else {
    echo "error";
}

$conexao->close();
?>