<?php
session_start();
$dbHost = "Localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "login";

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if (isset($_POST['nome'])) {
    $email = $_SESSION['email'];
    $novoNome = $_POST['nome'];

    $sql = "UPDATE user SET nome='$novoNome' WHERE email='$email'";
    $resultado = $conexao->query($sql);

    if ($resultado) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar dados: " . $conexao->error;
    }
}

if (isset($_POST['email'])) {
    $email = $_SESSION['email'];
    $novoEmail = $_POST['email'];

    $sql = "UPDATE user SET email='$novoEmail' WHERE email='$email'";
    $resultado = $conexao->query($sql);

    if ($resultado) {
        $_SESSION['email'] = $novoEmail;
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar dados: " . $conexao->error;
    }
}

if (isset($_POST['telefone'])) {
    $email = $_SESSION['email'];
    $novoTelefone = $_POST['telefone'];

    $sql = "UPDATE user SET telefone='$novoTelefone' WHERE email='$email'";
    $resultado = $conexao->query($sql);

    if ($resultado) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar dados: " . $conexao->error;
    }
}

if (isset($_POST['cpf'])) {
    $email = $_SESSION['email'];
    $novoCPF = $_POST['cpf'];

    $sql = "UPDATE user SET CPF='$novoCPF' WHERE email='$email'";
    $resultado = $conexao->query($sql);

    if ($resultado) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar dados: " . $conexao->error;
    }
}

if (isset($_POST['password'])) {
    $email = $_SESSION['email'];
    $novaSenha = $_POST['password'];

    $sql = "UPDATE user SET senha='$novaSenha' WHERE email='$email'";
    $resultado = $conexao->query($sql);

    if ($resultado) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar dados: " . $conexao->error;
    }
}

$conexao->close();
header('Location: dadosPessoais.php');
?>