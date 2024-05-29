<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="shortcut icon" href="../assets/LogoFav.PNG" type="image/x-icon">
    <title>Profissionais</title>

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
                <p>Profissionais</p>
            </div>
            <div class="div__input__container">
                <div class="div__input">
                    <div class="input">
                        <label for="searchNome">Nome</label>
                        <input type="text" id="searchNome">
                    </div>
                    <div class="input">
                        <label for="searchEspecialidade">Especialidade</label>
                        <select name="searchEspecialidade" id="searchEspecialidade">
                            <option value="Clareamento">Clareamento</option>
                            <option value="Aparelho">Aparelho</option>
                            <option value="Cárie">Cárie</option>
                        </select>
                    </div>
                    <div class="input input__telefone__cpf">
                        <label for="searchTelefone">Telefone</label>
                        <input type="text" id="searchTelefone">
                    </div>
                    <div class="input input__telefone__cpf">
                        <label for="searchCRO">CRO</label>
                        <input type="text" id="searchCRO">
                    </div>
                </div>
                <div class="div__botao">
                    <button class="botao" id="searchBtn"><img class="botao__icon" src="../assets/Lupa.png">Pesquisar</button>
                </div>
            </div>
            <div class="tabela__container">
                <div class="div__botao__novoUsuario">
                    <button class="botao botao__novoUsuario" onclick="showCreateProfessionalModal()">
                        <img class="botao__icon" src="../assets/usuario+.png" alt="">Criar Profissional</button>
                </div>
                <div class="tabela">
                    <table id="userTable">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Especialidade</th>
                                <th>Telefone</th>
                                <th>CRO</th>
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

                            $sql = "SELECT nome, especialidade, telefone, CRO  FROM profissionais";
                            $result = $conexao->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                    <td>" . $row["nome"] . "</td>
                    <td>" . $row["especialidade"] . "</td>
                    <td>" . $row["telefone"] . "</td>
                    <td>" . $row["CRO"] . "</td>
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

    <div id="createProfessionalModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCreateProfessionalModal()">&times;</span>
            <h2>Criar Novo Profissional</h2>
            <form id="createProfessionalForm" action="criar_profissional.php" method="POST">
                <div class="input">
                    <label for="profissional_nome">Nome</label>
                    <input type="text" id="profissional_nome" name="nome" required>
                </div>
                <div class="input">
                    <label for="profissional_especialidade">Especialidade</label>
                    <select id="profissional_especialidade" name="especialidade" required>
                        <?php
                        $dbHost = "localhost";
                        $dbUsername = "root";
                        $dbPassword = "";
                        $dbName = "login";

                        $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                        if ($conexao->connect_error) {
                            die("Connection failed: " . $conexao->connect_error);
                        }

                        $sql = "SELECT nome FROM tratamentos";
                        $result = $conexao->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["nome"] . "'>" . $row["nome"] . "</option>";
                            }
                        } else {
                            echo "<option value='' disabled>Nenhuma especialidade encontrada</option>";
                        }

                        $conexao->close();
                        ?>
                    </select>
                </div>
                <div class="input input__telefone__cpf">
                    <label for="profissional_telefone">Telefone</label>
                    <input type="text" id="profissional_telefone" name="telefone" required>
                </div>
                <div class="input input__telefone__cpf">
                    <label for="profissional_cro">CRO</label>
                    <input type="text" id="profissional_cro" name="cro" required>
                </div>
                <button type="submit">Criar Profissional</button>
            </form>
        </div>
    </div>

    <script>
        function showCreateProfessionalModal() {
            document.getElementById('createProfessionalModal').style.display = 'block';
        }

        function closeCreateProfessionalModal() {
            document.getElementById('createProfessionalModal').style.display = 'none';
        }

        document.getElementById('searchBtn').onclick = function() {
            const nome = document.getElementById('searchNome').value.toLowerCase();
            const especialidade = document.getElementById('searchEspecialidade').value.toLowerCase();
            const telefone = document.getElementById('searchTelefone').value.toLowerCase();
            const cro = document.getElementById('searchCRO').value.toLowerCase();

            console.log("Nome:", nome);
            console.log("Especialidade:", especialidade);
            console.log("Telefone:", telefone);
            console.log("CRO:", cro);

            const table = document.querySelector('.tabela table');
            const tr = table.querySelectorAll('tbody tr');

            tr.forEach(row => {
                let tdNome = row.cells[0];
                let tdEspecialidade = row.cells[1];
                let tdTelefone = row.cells[2];
                let tdCro = row.cells[3];

                console.log("Nome da célula:", tdNome.textContent.toLowerCase());
                console.log("Especialidade da célula:", tdEspecialidade.textContent.toLowerCase());
                console.log("Telefone da célula:", tdTelefone.textContent.toLowerCase());
                console.log("CRO da célula:", tdCro.textContent.toLowerCase());

                if (tdNome && tdEspecialidade && tdTelefone && tdCro) {
                    let nomeValue = tdNome.textContent.toLowerCase();
                    let especialidadeValue = tdEspecialidade.textContent.toLowerCase();
                    let telefoneValue = tdTelefone.textContent.toLowerCase();
                    let croValue = tdCro.textContent.toLowerCase();

                    if (nomeValue.includes(nome) && especialidadeValue.includes(especialidade) && telefoneValue.includes(telefone) && croValue.includes(cro)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            });
        }
    </script>

</body>

</html>