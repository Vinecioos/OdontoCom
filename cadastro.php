<?php
    $dbHost = "Localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "login";

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    $email = $_POST['email'];

    $sql = mysqli_query($conexao, "SELECT * FROM user WHERE email = '{$email}'");

    if(mysqli_num_rows($sql)>0) {
        echo "<script>alert('Já existe um usuário cadastrado com este email');";
        echo "window.location='cadastro.html';</script>";
    } 
    else {
        if($_POST['password'] === $_POST['confirmed_password']){
            $email = $_POST['email'];
            $senha = $_POST['password'];
    
            $result = mysqli_query($conexao, "INSERT INTO user(email, senha) VALUES ('$email', '$senha')");
            echo "<script>alert('Cadastro realizado com sucesso!');";
            echo "window.location='login.html';</script>";
        }
        else{
            echo "<script>alert('Senha inválida!');";
        echo "window.location='cadastro.html';</script>";
        }
    }


    

    
?>