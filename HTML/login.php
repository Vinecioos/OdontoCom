<?php
session_start();
$dbHost = "Localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "login";

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

print_r($_REQUEST);

if (!isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    //acessa
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = '$email' and senha = '$senha'";

    $result = $conexao->query($sql);

    if (mysqli_num_rows($result) < 1) {
        $sql = "SELECT * FROM admins WHERE email = '$email' and senha = '$senha'";

        $result = $conexao->query($sql);

        if(mysqli_num_rows($result) < 1){
            unset($_SESSION['email']);
            unset($_SESSION['password']);
            echo "<script>alert('Email ou senha incorreta! Tente novamente.');";
            echo "window.location='login.html';</script>";
        }
        else{
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $senha;
            header('Location: administradores.php');
        }
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $senha;
        header('Location: indexLogado.php');
    }
} else {
    //Não acessa
    header('Location: cadastro.html');
}
