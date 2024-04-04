<?php
    $dbHost = "Localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "login";

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    /* Qualquer email cadastrado já altera a senha da pessoa, nescessario colocar segurança na conta da pessoa */
    if(!isset($_POST['submit'])){
        $email = $_POST['email'];
        $codigoSeg = $_POST['codigoSeg'];

        $sql = "SELECT * FROM user WHERE email = '$email'";

        $result = $conexao -> query($sql);
        
        if(mysqli_num_rows($result) < 1){
            echo "<script>alert('email não encontrado!');";
            echo "window.location='login.html';</script>";
        }
        else{
            $row = $result->fetch_assoc();
        $codigoSegDB = $row['codigoSeg'];

        if ($codigoSeg === $codigoSegDB) {
            if ($_POST['password'] === $_POST['confirmed_password']) {
                $novaSenha = $_POST['password'];

                $result = mysqli_query($conexao, "UPDATE user SET senha = '$novaSenha' WHERE email = '$email';");

                if ($result) {
                    echo "<script>alert('Senha alterada com sucesso!');";
                    echo "window.location='login.html';</script>";
                } else {
                    echo "<script>alert('Erro ao alterar senha. Por favor, tente novamente mais tarde.');";
                    echo "window.location='redefinirSenha.html';</script>";
                }
            } else {
                echo "<script>alert('As senhas não coincidem!');";
                echo "window.location='redefinirSenha.html';</script>";
            }
        } else {
            echo "<script>alert('Código de segurança incorreto!');";
            echo "window.location='redefinirSenha.html';</script>";
        }
        }
            
    }
?>