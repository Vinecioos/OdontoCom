<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="shortcut icon" href="../assets/LogoFav.PNG" type="image/x-icon">
    <title>Gerenciar</title>

    <style>
        .tabela__gerenciar {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tabela__gerenciar thead {
            background-color: #d3d3d3;
        }

        .tabela__gerenciar th,
        .tabela__gerenciar td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .tabela__gerenciar tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .tabela__gerenciar tbody tr:nth-child(even) {
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
                <a class="links__escrita" href="">
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
                <p>Gerenciamento</p>
            </div>
            <div class="div__input__gerenciar__container">
                <div class="div__input__gerenciar">
                    <div class="input__gerenciar">
                        <label for="searchNome">Nome</label>
                        <input type="text" id="searchNome" name="searchNome">
                        <div class="botao__gerenciar__container">
                            <button class="botao__gerenciar" onclick="showAddProcedureModal()"><img class="botao__icon" src="../assets/+.png" alt="">Adicionar Procedimento</button>
                        </div>
                    </div>
                    <div class="input__gerenciar  TUSS">
                        <label for="searchTUSS">TUSS</label>
                        <input type="text" id="searchTUSS" name="searchTUSS">
                    </div>
                    <div class="input__gerenciar">
                        <button class="botao__pesquisar" id="searchBtn">Pesquisar</button>
                    </div>
                </div>
                <div class="tabela__gerenciar">
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "login";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT nome, TUSS, profissional, valor, duracao FROM tratamentos";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table class='tabela__gerenciar' id='userTable'>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>TUSS</th>
                                <th>Profissional</th>
                                <th>Valor</th>
                                <th>Duração</th>
                            </tr>
                        </thead>
                        <tbody>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td>" . $row["nome"] . "</td>
                            <td>" . $row["TUSS"] . "</td>
                            <td>" . $row["profissional"] . "</td>
                            <td>" . $row["valor"] . "</td>
                            <td>" . $row["duracao"] . "</td>
                          </tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
            <div class="informacoes__container">
                <div class="disposição__disponibildade">
                    <h2 class="texto__informacoes">Disposição dos Profissionais</h2>
                    <div class="tabela__gerenciar__informacoes">
                        <table class="tabela__gerenciar" id="profissionalTable">
                            <thead>
                                <tr>
                                    <th>Profissional</th>
                                    <th>Entrada</th>
                                    <th>Saída</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "login";

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                $sql = "SELECT nome, entrada, saida FROM profissionais";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td>" . $row["nome"] . "</td>
                                            <td>
                                                <form action='update_horario.php' method='POST'>
                                                    <input type='hidden' name='nome' value='" . $row["nome"] . "'>
                                                    <select name='entrada' onchange='this.form.submit()'>
                                                        <option value='" . $row["entrada"] . "'>" . $row["entrada"] . "</option>
                                                        <option value='08:00'>08:00</option>
                                                        <option value='09:00'>09:00</option>
                                                        <option value='10:00'>10:00</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <form action='update_horario.php' method='POST'>
                                                    <input type='hidden' name='nome' value='" . $row["nome"] . "'>
                                                    <select name='saida' onchange='this.form.submit()'>
                                                        <option value='" . $row["saida"] . "'>" . $row["saida"] . "</option>
                                                        <option value='17:00'>17:00</option>
                                                        <option value='18:00'>18:00</option>
                                                        <option value='19:00'>19:00</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>Nenhum profissional encontrado</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="disposição__disponibildade">
                    <h2 class="texto__informacoes">Disponibilidade de Agendamento</h2>
                    <div class="tabela__gerenciar__informacoes">
                        <table class="tabela__gerenciar">
                            <thead>
                                <tr>
                                    <th>Semana</th>
                                    <th>Início</th>
                                    <th>Final</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "login";

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                $sql = "SELECT semana, inicio, final FROM agenda";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                        <form action='update_agenda.php' method='POST'>
                                        <input type='hidden' name='semana' value='" . $row["semana"] . "'>
                                        <td>
                                            " . $row["semana"] . "
                                        </td>
                                        <td>
                                            <input type='time' name='inicio' value='" . $row['inicio'] . "'>
                                        </td>
                                        <td>
                                            <input type='time' name='final' value='" . $row['final'] . "'>
                                        </td>
                                        <td>
                                            <button type='submit'>Salvar</button>
                                        </td>
                                    </form>
                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>Nenhuma disponibilidade encontrada</td></tr>";
                                }

                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </section>
    </main>

    <div id="addProcedureModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddProcedureModal()">&times;</span>
            <h2>Adicionar Novo Procedimento</h2>
            <form id="addProcedureForm" action="adicionar_procedimento.php" method="POST">
                <div class="input">
                    <label for="procedimento_nome">Nome do Procedimento</label>
                    <input type="text" id="procedimento_nome" name="nome" required>
                </div>
                <div class="input">
                    <label for="procedimento_tuss">TUSS</label>
                    <input type="text" id="procedimento_tuss" name="tuss" required>
                </div>
                <div class="input">
                    <label for="procedimento_profissional">Profissional</label>
                    <select id="procedimento_profissional" name="profissional" required>
                        <?php
                        $dbHost = "localhost";
                        $dbUsername = "root";
                        $dbPassword = "";
                        $dbName = "login";

                        $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                        if ($conexao->connect_error) {
                            die("Connection failed: " . $conexao->connect_error);
                        }

                        $sql = "SELECT nome FROM profissionais";
                        $result = $conexao->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["nome"] . "'>" . $row["nome"] . "</option>";
                            }
                        } else {
                            echo "<option value='' disabled>Nenhum profissional encontrado</option>";
                        }

                        $conexao->close();
                        ?>
                    </select>
                </div>
                <div class="input">
                    <label for="procedimento_valor">Valor</label>
                    <input type="number" id="procedimento_valor" name="valor" required>
                </div>
                <div class="input">
                    <label for="procedimento_duracao">Duração</label>
                    <input type="time" id="procedimento_duracao" name="duracao" required>
                </div>
                <button type="submit">Adicionar Procedimento</button>
            </form>
        </div>
    </div>

    <script>
        function showAddProcedureModal() {
            document.getElementById('addProcedureModal').style.display = 'block';
        }

        function closeAddProcedureModal() {
            document.getElementById('addProcedureModal').style.display = 'none';
        }

        document.getElementById('searchBtn').onclick = function() {
            var nome = document.getElementById('searchNome').value.toLowerCase();
            var TUSS = document.getElementById('searchTUSS').value.toLowerCase();

            var rows = document.querySelectorAll('#userTable tbody tr');

            rows.forEach(function(row) {
                var rowNome = row.cells[0].innerText.toLowerCase();
                var rowTUSS = row.cells[1].innerText.toLowerCase();

                if (rowNome.includes(nome) && rowTUSS.includes(TUSS)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>

</body>

</html>