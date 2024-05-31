<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="shortcut icon" href="../assets/LogoFav.PNG" type="image/x-icon">
    <title>Administradores</title>

     <style>
        .tabela {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tabela thead {
            background-color: #d3d3d3;
        }

        .tabela th,
        .tabela td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .tabela tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .tabela tbody tr:nth-child(even) {
            background-color: #f2f2f2;
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

        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            position: relative;
        }

        .modal-content .input {
            margin-bottom: 15px;
        }

        .modal-content label {
            display: block;
            margin-bottom: 5px;
        }

        .modal-content input {
            width: calc(100% - 20px);
            padding: 5px;
            box-sizing: border-box;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
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
                <a class="links__escrita" href="consultas.html">
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
                <a class="links__escrita" href="login.html">
                    <div class="links__opcoes">
                        <img class="links__imagem" src="../assets/sair.png" alt="">
                        sair
                    </div>
                </a>
            </div>
        </nav>
        <section class="usuario__container">
            <div class="div__usuarios">
                <p>Administradores</p>
            </div>
            <div class="div__input__container">
                <div class="div__input">
                    <div class="input">
                        <label for="searchNome">Nome</label>
                        <input type="text" id="searchNome">
                    </div>
                    <div class="input">
                        <label for="searchEmail">E-mail</label>
                        <input type="text" id="searchEmail">
                    </div>
                    <div class="input input__telefone__cpf">
                        <label for="searchTelefone">Telefone</label>
                        <input type="text" id="searchTelefone">
                    </div>
                    <div class="input input__telefone__cpf">
                        <label for="searchCpf">CPF</label>
                        <input type="text" id="searchCpf">
                    </div>
                </div>
                <div class="div__botao">
                    <button class="botao" id="searchBtn"><img class="botao__icon" src="../assets/Lupa.png" alt="">Pesquisar</button>
                </div>
            </div>
            <div class="tabela__container">
                <div class="div__botao__novoUsuario">
                    <button class="botao botao__novoUsuario"><img class="botao__icon" src="../assets/usuario+.png" alt="">Criar Administrador</button>
                </div>
                <div class="tabela">
                    <table id="userTable">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>CPF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dbHost = "localhost";
                            $dbUsername = "root";
                            $dbPassword = "";
                            $dbName = "login";

                            $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                            if ($conexao->connect_error) {
                                die("Connection failed: " . $conexao->connect_error);
                            }

                            $sql = "SELECT nome, email, telefone, cpf  FROM admins";
                            $result = $conexao->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                    <td>" . $row["nome"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["telefone"] . "</td>
                    <td>" . $row["cpf"] . "</td>
                </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>Nenhum usuário encontrado</td></tr>";
                            }
                            $conexao->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <div id="createAdminModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Criar Novo Administrador</h2>
            <form id="createAdminForm" action="criar_admin.php" method="POST">
                <div class="input">
                    <label for="admin_nome">Nome</label>
                    <input type="text" id="admin_nome" name="nome" required>
                </div>
                <div class="input">
                    <label for="admin_email">E-mail</label>
                    <input type="email" id="admin_email" name="email" required>
                </div>
                <div class="input">
                    <label for="admin_telefone">Telefone</label>
                    <input type="text" id="admin_telefone" name="telefone" required>
                </div>
                <div class="input">
                    <label for="admin_cpf">CPF</label>
                    <input type="text" id="admin_cpf" name="cpf" required>
                </div>
                <div class="input">
                    <label for="admin_senha">Senha</label>
                    <input type="password" id="admin_senha" name="senha" required>
                </div>
                <button type="submit">Criar Administrador</button>
            </form>
        </div>
    </div>

    <script>
        document.querySelector('.botao__novoUsuario').onclick = function() {
            document.getElementById('createAdminModal').style.display = 'block';
        }

        document.querySelectorAll('.close').forEach(function(element) {
            element.onclick = function() {
                element.closest('.modal').style.display = 'none';
            }
        });

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }

        document.getElementById('searchBtn').onclick = function() {
            const nome = document.getElementById('searchNome').value.toLowerCase();
            const email = document.getElementById('searchEmail').value.toLowerCase();
            const telefone = document.getElementById('searchTelefone').value.toLowerCase();
            const cpf = document.getElementById('searchCpf').value.toLowerCase();

            const table = document.getElementById('userTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                let tdNome = tr[i].getElementsByTagName('td')[0];
                let tdEmail = tr[i].getElementsByTagName('td')[1];
                let tdTelefone = tr[i].getElementsByTagName('td')[2];
                let tdCpf = tr[i].getElementsByTagName('td')[3];

                if (tdNome && tdEmail && tdTelefone && tdCpf) {
                    let nomeValue = tdNome.textContent || tdNome.innerText;
                    let emailValue = tdEmail.textContent || tdEmail.innerText;
                    let telefoneValue = tdTelefone.textContent || tdTelefone.innerText;
                    let cpfValue = tdCpf.textContent || tdCpf.innerText;

                    if (nomeValue.toLowerCase().indexOf(nome) > -1 &&
                        emailValue.toLowerCase().indexOf(email) > -1 &&
                        telefoneValue.toLowerCase().indexOf(telefone) > -1 &&
                        cpfValue.toLowerCase().indexOf(cpf) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</body>

</html>