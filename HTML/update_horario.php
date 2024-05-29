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
    $nome = $_POST['nome'];
    $entrada = $_POST['entrada'] ?? null;
    $saida = $_POST['saida'] ?? null;

    // Valida os dados recebidos
    if (!empty($nome)) {
        // Atualiza a entrada se estiver definida
        if (!empty($entrada)) {
            $sql = "UPDATE profissionais SET entrada = ? WHERE nome = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $entrada, $nome);

            if ($stmt->execute()) {
                echo "Horário de entrada atualizado com sucesso!";
            } else {
                echo "Erro ao atualizar horário de entrada: " . $stmt->error;
            }
            $stmt->close();
        }

        // Atualiza a saída se estiver definida
        if (!empty($saida)) {
            $sql = "UPDATE profissionais SET saida = ? WHERE nome = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $saida, $nome);

            if ($stmt->execute()) {
                echo "Horário de saída atualizado com sucesso!";
            } else {
                echo "Erro ao atualizar horário de saída: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        echo "Nome do profissional não fornecido.";
    }
} else {
    echo "Método de requisição inválido.";
}

$conn->close();
header("Location: gerenciar.php");
exit();
?>
