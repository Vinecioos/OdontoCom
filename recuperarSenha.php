<?php
    $dbHost = "Localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "login";

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    /* Qualquer email cadastrado já altera a senha da pessoa, nescessario colocar segurança na conta da pessoa */
    if(!isset($_POST['submit'])){
        $email = $_POST['email'];
        $sql = "SELECT * FROM user WHERE email = '$email'";

        $result = $conexao -> query($sql);
        
        if(mysqli_num_rows($result) < 1){
            echo "<script>alert('email não encontrado!');";
            echo "window.location='login.html';</script>";
        }
        else{
            if($_POST['password'] === $_POST['confirmed_password']){
                $novasenha = $_POST['password'];
        
                $result = mysqli_query($conexao, "UPDATE user SET senha = '$novasenha' WHERE email = '$email';");
                echo "<script>alert('Senha alterada com sucesso!');";
                echo "window.location='login.html';</script>";
            }
            else{
                echo "<script>alert('Senha diferentes!');";
                echo "window.location='redefinirSenha.html';</script>";
            }
        }
            
    }
?>