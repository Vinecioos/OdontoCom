<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "login";

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    if (isset($_POST["nome"])) {
        // Atualizar usuário
        $nome = $_POST["nome"];
        $new_email = $_POST["new_email"];
        $telefone = $_POST["telefone"];
        $cpf = $_POST["cpf"];
        $codigoSeg = $_POST["codigoSeg"];

        $sql = "UPDATE user SET nome=?, email=?, telefone=?, cpf=?, codigoSeg=? WHERE email=?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssssss", $nome, $new_email, $telefone, $cpf, $codigoSeg, $email);

        if ($stmt->execute()) {
            // Redirecionamento após atualização bem-sucedida
            echo "<script>alert('Usuário atualizado com sucesso!'); window.location='usuario.php';</script>";
        } else {
            echo "<script>alert('Erro ao atualizar usuário!'); window.location='usuario.php';</script>";
        }

        $stmt->close();
    } else {
        // Exibir formulário de edição
        $sql = "SELECT nome, email, telefone, cpf, codigoSeg FROM user WHERE email=?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Editar Usuário</title>
                <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }
    </style>
            </head>

            <body>
                <h2>Editar Usuário</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" value="<?php echo $row['nome']; ?>"><br>
                    <label for="new_email">Email:</label>
                    <input type="text" name="new_email" value="<?php echo $row['email']; ?>"><br>
                    <label for="telefone">Telefone:</label>
                    <input type="text" name="telefone" value="<?php echo $row['telefone']; ?>"><br>
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" value="<?php echo $row['cpf']; ?>"><br>
                    <label for="codigoSeg">Código de Segurança:</label>
                    <input type="text" name="codigoSeg" value="<?php echo $row['codigoSeg']; ?>"><br>
                    <button type="submit">Atualizar</button>
                </form>
                <a href="usuario.php">Cancelar</a>
            </body>

            </html>

            <?php
        } else {
            echo "<script>alert('Usuário não encontrado!'); window.location='usuario.php';</script>";
        }

        $stmt->close();
    }
}
$conexao->close();
?>
