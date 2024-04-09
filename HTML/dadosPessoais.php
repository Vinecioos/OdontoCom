<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="../JavaScript/script.js" defer></script>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="shortcut icon" href="assets/LogoFav.PNG" type="image/x-icon">
    <title>Dados Pessoais</title>
</head>

<body>
    <header class="cabecalho">
        <div class="cabecalho__logo">
            <a href="indexLogado.php">
                <img class="logo" src="../assets/OdontoCom_White.png" alt="Logo">
            </a>
        </div>

        <nav class="cabecalho-logado">
            <a href="indexLogado.php" class="inicio">Início</a>
            <div id="btn-menu-perfil" class="btn-menu-perfil">
                <i class="bi bi-person-circle"></i>
                <a href="#" class="meu-perfil">Meu Perfil</a>
            </div>

        </nav>

        <div class="menu-perfil" id="menu-perfil">
            <div class="btn-fechar">
                <i class="bi bi-x" id="bi bi-x"></i>
            </div>

            <nav>
                <ul>
                    <li>
                        <p><?php
                            session_start();
                            $dbHost = "Localhost";
                            $dbUsername = "root";
                            $dbPassword = "";
                            $dbName = "login";

                            $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                            // Verifica se o usuário está autenticado
                            if (isset($_SESSION['email'])) {
                                $email = $_SESSION['email'];

                                // Query para buscar o nome do usuário
                                $sql = "SELECT nome FROM user WHERE email = '$email'";
                                $result = $conexao->query($sql);

                                // Se a consulta retornar resultados
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $nomeDoUsuario = $row['nome'];

                                    // Exibindo o nome do usuário
                                    echo "Olá, $nomeDoUsuario!";
                                }
                            }
                            ?></p>
                    </li>
                    <li><a href="agendamentos.html">Agendamentos</a></li>
                    <li><a href="dadosPessoais.php">Dados Pessoais</a></li>
                    <li><a href="index.html">Sair</a></li>
                </ul>
            </nav>
        </div>

        <div class="overlay-menu" id="overlay-menu"></div>

    </header>
    <!--FIM Cabeçalho-->
    <div class="cabecalho-secundario">
        <a id="cabecalho-secundario" href="#">Meus Dados</a>
    </div>
    <!--FIM Cabeçalho Secundário-->
    <main class="main-dados-pessoais">
        <section class="menu-lateral">
            <nav class="nav-meus-dados">
                <p><?php
                            $dbHost = "Localhost";
                            $dbUsername = "root";
                            $dbPassword = "";
                            $dbName = "login";

                            $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                            // Verifica se o usuário está autenticado
                            if (isset($_SESSION['email'])) {
                                $email = $_SESSION['email'];

                                // Query para buscar o nome do usuário
                                $sql = "SELECT nome FROM user WHERE email = '$email'";
                                $result = $conexao->query($sql);

                                // Se a consulta retornar resultados
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $nomeDoUsuario = $row['nome'];

                                    // Exibindo o nome do usuário
                                    echo "Olá, $nomeDoUsuario!";
                                }
                            }
                            ?></p>
                <p>Seja bem-vindo à sua conta!</p>
                <ul>
                    <li><a id="editar-perfil" href="#">Editar Perfil</a></li>
                    <li><a href="indexLogado.php">Voltar para a página principal</a></li>
                    <li><a href="#">Sair</a></li>
                </ul>
            </nav>
        </section><!--FIM NAV Meus Dados-->
        <section class="conteudo">
            <div class="container" id="editContainer">
                <form action="edicao.php" method="post" class="form-edit">
                    <label for="nome">Nome:</label> <br>
                    <input placeholder="<?php
                            $dbHost = "Localhost";
                            $dbUsername = "root";
                            $dbPassword = "";
                            $dbName = "login";

                            $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                            // Verifica se o usuário está autenticado
                            if (isset($_SESSION['email'])) {
                                $email = $_SESSION['email'];

                                // Query para buscar o nome do usuário
                                $sql = "SELECT nome FROM user WHERE email = '$email'";
                                $result = $conexao->query($sql);

                                // Se a consulta retornar resultados
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $nomeDoUsuario = $row['nome'];

                                    // Exibindo o nome do usuário
                                    echo "$nomeDoUsuario";
                                }
                            }
                            ?>" class="input-nome" type="text" id="nome" name="nome" disabled><br>

                    <label for="email">Email:</label> <br>
                    <input placeholder="<?php
                            $dbHost = "Localhost";
                            $dbUsername = "root";
                            $dbPassword = "";
                            $dbName = "login";

                            $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                            // Verifica se o usuário está autenticado
                            if (isset($_SESSION['email'])) {
                                $email = $_SESSION['email'];

                                // Query para buscar o nome do usuário
                                $sql = "SELECT nome FROM user WHERE email = '$email'";
                                $result = $conexao->query($sql);

                                // Se a consulta retornar resultados
                                if ($result->num_rows > 0) {
                                    echo "$email";
                                }
                            }
                            ?>" class="input-email" type="text" id="email" name="email" disabled><br>

                    <label for="telefone">Telefone:</label> <br>
                    <input placeholder="<?php
                            $dbHost = "Localhost";
                            $dbUsername = "root";
                            $dbPassword = "";
                            $dbName = "login";

                            $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                            // Verifica se o usuário está autenticado
                            if (isset($_SESSION['email'])) {
                                $email = $_SESSION['email'];

                                // Query para buscar o nome do usuário
                                $sql = "SELECT telefone FROM user WHERE email = '$email'";
                                $result = $conexao->query($sql);

                                // Se a consulta retornar resultados
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $telDoUsuario = $row['telefone'];

                                    // Exibindo o nome do usuário
                                    echo "$telDoUsuario";
                                }
                            }
                            ?>" class="input-tel" type="tel" id="telefone" name="telefone" disabled><br>

                    <label for="cpf">CPF:</label> <br>
                    <input placeholder="<?php
                            $dbHost = "Localhost";
                            $dbUsername = "root";
                            $dbPassword = "";
                            $dbName = "login";

                            $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                            // Verifica se o usuário está autenticado
                            if (isset($_SESSION['email'])) {
                                $email = $_SESSION['email'];

                                // Query para buscar o nome do usuário
                                $sql = "SELECT CPF FROM user WHERE email = '$email'";
                                $result = $conexao->query($sql);

                                // Se a consulta retornar resultados
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $CPFDoUsuario = $row['CPF'];

                                    // Exibindo o nome do usuário
                                    echo "$CPFDoUsuario";
                                }
                            }
                            ?>" class="input-cpf" type="text" id="cpf" name="cpf" disabled><br>

                    <label for="password">Senha:</label> <br>
                    <input placeholder="*********" class="input-senha" type="password" id="password" name="password" disabled><br>

                    <input class="input-edit" type="submit" value="Salvar Alterações" disabled>
                </form>
            </div>
        </section>
    </main>
    <!--FIM Main-->
    <footer>
        <div class="rodape">
            <a class="rodape__escrita" href="ByTech.html">&copy; Criado por ByTech</a>
        </div>
    </footer>
    <!--Fim Rodapé-->

</body>

</html>