<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="shortcut icon" href="../assets/LogoFav.PNG" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

    <title>Usuario</title>
    <style>
        .btn-link {
            background: none;
            border: none;
            padding: 0;
        }

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
                <p>Usuários</p>
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
                    <button id="openModalBtn" class="botao botao__novoUsuario"><img class="botao__icon" src="../assets/usuario+.png" alt="">Criar novo usuário</button>
                </div>
                <div class="tabela">
                    <table id="userTable">
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
                            $dbHost = "localhost";
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
                    <a class='edit-btn' data-nome='" . $row["nome"] . "' data-email='" . $row["email"] . "' data-telefone='" . $row["telefone"] . "' data-cpf='" . $row["cpf"] . "' data-codigoseg='" . $row["codigoSeg"] . "'><i class='bi bi-pencil'></i></a>
                    <form action='excluir_user.php' method='POST'>
                            <input type='hidden' name='email' value='" . $row["email"] . "'>
                            <button type='submit' class='btn btn-link p-0'><i class='bi bi-trash'></i></button>                        </form>
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

            <div id="userModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Criar Novo Usuário</h2>
                    <form id="createUserForm" action="criar_usuario.php" method="POST">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" required>
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" required>
                        <label for="telefone">Telefone</label>
                        <input type="text" id="telefone" name="telefone" required>
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" required>
                        <label for="codigoSeg">Código de Segurança</label>
                        <input type="text" id="codigoSeg" name="codigoSeg" required>
                        <button type="submit">Criar Usuário</button>
                    </form>
                </div>
            </div>

            <div id="editModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Editar Usuário</h2>
                    <form id="editUserForm" action="editar_user.php" method="POST">
                        <input type="hidden" id="edit_email" name="email" required>
                        <label for="edit_nome">Nome</label>
                        <input type="text" id="edit_nome" name="nome" required>
                        <label for="edit_new_email">E-mail</label>
                        <input type="email" id="edit_new_email" name="new_email" required>
                        <label for="edit_telefone">Telefone</label>
                        <input type="text" id="edit_telefone" name="telefone" required>
                        <label for="edit_cpf">CPF</label>
                        <input type="text" id="edit_cpf" name="cpf" required>
                        <label for="edit_codigoSeg">Código de Segurança</label>
                        <input type="text" id="edit_codigoSeg" name="codigoSeg" required>
                        <button type="submit">Atualizar Usuário</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.getElementById('openModalBtn').onclick = function() {
            document.getElementById('userModal').style.display = 'block';
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

        document.querySelectorAll('.edit-btn').forEach(function(button) {
            button.onclick = function() {
                var nome = this.getAttribute('data-nome');
                var email = this.getAttribute('data-email');
                var telefone = this.getAttribute('data-telefone');
                var cpf = this.getAttribute('data-cpf');
                var codigoSeg = this.getAttribute('data-codigoseg');

                document.getElementById('edit_nome').value = nome;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_new_email').value = email;
                document.getElementById('edit_telefone').value = telefone;
                document.getElementById('edit_cpf').value = cpf;
                document.getElementById('edit_codigoSeg').value = codigoSeg;

                document.getElementById('editModal').style.display = 'block';
            }
        });

        document.getElementById('searchBtn').onclick = function() {
            var nome = document.getElementById('searchNome').value.toLowerCase();
            var email = document.getElementById('searchEmail').value.toLowerCase();
            var telefone = document.getElementById('searchTelefone').value.toLowerCase();
            var cpf = document.getElementById('searchCpf').value.toLowerCase();

            var rows = document.querySelectorAll('#userTable tbody tr');

            rows.forEach(function(row) {
                var rowNome = row.cells[0].innerText.toLowerCase();
                var rowEmail = row.cells[1].innerText.toLowerCase();
                var rowTelefone = row.cells[2].innerText.toLowerCase();
                var rowCpf = row.cells[3].innerText.toLowerCase();

                if (rowNome.includes(nome) && rowEmail.includes(email) && rowTelefone.includes(telefone) && rowCpf.includes(cpf)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>