<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="shortcut icon" href="../assets/LogoFav.PNG" type="image/x-icon">
    <title>Usuario</title>
    <style>
        .tabela {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tabela thead {
            background-color: #d3d3d3;
            /* fundo cinza para thead */
        }

        .tabela th,
        .tabela td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .tabela tbody tr:nth-child(odd) {
            background-color: #ffffff;
            /* fundo branco para linhas ímpares */
        }

        .tabela tbody tr:nth-child(even) {
            background-color: #f2f2f2;
            /* fundo cinza claro para linhas pares */
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons form {
            display: inline;
        }

        .action-buttons img {
            width: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header class="cabecalho">
        <div class="cabecalho__logo">
            <a href="administradores.php">
                <img class="logo" src="../assets/OdontoCom_White.png" alt="Logo">
            </a>
        </div>
    </header>
    <main class="main__container">
        <nav class="nav__administrador__container">
            <div class="nav__div__conatiner">
                <img src="../assets/person-circle.png" alt="">
                <div class="div__administrador">
                    <h2 class="administrador__titulo">Administrador</h2>
                    <a class="editarPerfil" href="">Editar Perfil</a>
                </div>
            </div>
            <h3>ODONTOCOM</h3>
            <div class="links__container">
                <a class="links__escrita" href="">
                    <div class="links__opcoes">
                        <img class="links__imagem" src="../assets/calendario.png" alt="">
                        Agendamento
                    </div>
                </a>
                <a class="links__escrita" href="administradores.php">
                    <div class="links__opcoes">
                        <img class="links__imagem" src="../assets/cardAdministrador.png" alt="">
                        Administradores
                    </div>
                </a>
                <a class="links__escrita" href="usuario.php">
                    <div class="links__opcoes">
                        <img class="links__imagem" src="../assets/person 1.png" alt="">
                        Usuário
                    </div>
                </a>
                <a class="links__escrita" href="profissionais.php">
                    <div class="links__opcoes">
                        <img class="links__imagem" src="../assets/maleta.png" alt="">
                        Profissionais
                    </div>
                </a>
                <a class="links__escrita" href="gerenciar.php">
                    <div class="links__opcoes">
                        <img class="links__imagem" src="../assets/engrenagem.png" alt="">
                        Gerenciar
                    </div>
                </a>
                <a class="links__escrita" href="">
                    <div class="links__opcoes">
                        <img class="links__imagem" src="../assets/sair.png" alt="">
                        sair
                    </div>
                </a>
            </div>
        </nav>
        <section class="usuario__container">
            <div class="div__usuarios">
                <p>Usuários</p>
            </div>
            <div class="div__input__container">
                <div class="div__input">
                    <div class="input">
                        <label for="">Nome</label>
                        <input type="text">
                    </div>
                    <div class="input">
                        <label for="">E-mail</label>
                        <input type="text">
                    </div>
                    <div class="input input__telefone__cpf">
                        <label for="">Telefone</label>
                        <input type="text">
                    </div>
                    <div class="input input__telefone__cpf">
                        <label for="">CPF</label>
                        <input type="text">
                    </div>
                </div>
                <div class="div__botao">
                    <button class="botao"><img class="botao__icon" src="../assets/Lupa.png" alt="">Pesquisar</button>
                </div>
            </div>
            <div class="tabela__container">
                <div class="div__botao__novoUsuario">
                    <button class="botao botao__novoUsuario"><img class="botao__icon" src="../assets/usuario+.png" alt="">Criar novo usuário</button>
                </div>
                <div class="tabela">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>CPF</th>
                                <th>Código de Segurança</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dbHost = "localhost"; // Use "localhost" (all lowercase) instead of "Localhost"
                            $dbUsername = "root";
                            $dbPassword = "";
                            $dbName = "login";

                            $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                            if ($conexao->connect_error) {
                                die("Connection failed: " . $conexao->connect_error);
                            }

                            $sql = "SELECT nome, email, telefone, cpf, codigoSeg FROM user";
                            $result = $conexao->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                    <td>" . $row["nome"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["telefone"] . "</td>
                    <td>" . $row["cpf"] . "</td>
                    <td>" . $row["codigoSeg"] . "</td>
                    <td class='action-buttons'>
                        <form action='editar_user.php' method='POST'>
                            <input type='hidden' name='email' value='" . $row["email"] . "'>
                            <button type='submit'><img src='../assets/edit.png' alt='Editar'></button>
                        </form>
                        <form action='excluir_user.php' method='POST'>
                            <input type='hidden' name='email' value='" . $row["email"] . "'>
                            <button type='submit'><img src='../assets/delete.png' alt='Excluir'></button>
                        </form>
                    </td>
                </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>Nenhum usuário encontrado</td></tr>";
                            }
                            $conexao->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</body>

</html>