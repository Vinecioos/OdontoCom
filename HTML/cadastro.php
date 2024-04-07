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
        $sqlemail = "SELECT * FROM user WHERE email = '$email'";

        $result = $conexao -> query($sqlemail);
        
        if(mysqli_num_rows($result) < 1){
            if($_POST['password'] === $_POST['confirmed_password']){
                $email = $_POST['email'];
                $senha = $_POST['password'];
                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $telefone = $_POST['telefone'];

                $codigoSeg = strtoupper(substr(str_replace('-', '', uniqid()), 0, 6));

                $result = mysqli_query($conexao, "INSERT INTO user(email, senha, nome, telefone, CPF, codigoSeg) VALUES ('$email', '$senha', '$nome','$telefone','$cpf','$codigoSeg')");
        
                echo "<script>alert('Cadastro realizado com sucesso! ANOTE SEU CODIGO DE SEGURANÇA: $codigoSeg');";
                echo "window.location='login.html';</script>";
            }
            else{
                echo "<script>alert('Senha inválida!');";
                echo "window.location='cadastro.html';</script>";
            }
        }
        else{
            echo "<script>alert('email já cadastrado!');";
            echo "window.location='login.html';</script>";
        }
        
    }
?>