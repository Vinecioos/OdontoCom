<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $semana = $_POST['semana'];
    $inicio = $_POST['inicio'];
    $final = $_POST['final'];

    // Valida os dados recebidos
    if (!empty($semana) && !empty($inicio) && !empty($final)) {
        // Atualiza a disponibilidade
        $sql = "UPDATE agenda SET inicio = ?, final = ? WHERE semana = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $inicio, $final, $semana);

        if ($stmt->execute()) {
            echo "Disponibilidade atualizada com sucesso!";
        } else {
            echo "Erro ao atualizar disponibilidade: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Todos os campos são obrigatórios.";
    }
} else {
    echo "Método de requisição inválido.";
}

$conn->close();
header("Location: gerenciar.php");
exit();
?>
