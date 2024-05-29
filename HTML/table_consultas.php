<?php
$dbHost = "Localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "login";

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style/style.css" />
  <link rel="shortcut icon" href="../assets/LogoFav.PNG" type="image/x-icon" />
  <title>Consultas</title>
  <style>
    .tabela {
      width: 97%;
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

    .planner {
      display: flex;
      justify-content: center;
      align-content: center;
      padding: 20px;
    }
  </style>
</head>

<body>
  <header class="cabecalho">
    <div class="cabecalho__logo">
      <a href="administradores.php">
        <img class="logo" src="../assets/OdontoCom_White.png" alt="Logo" />
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
        <p>Consultas</p>
      </div>
      <div class="planner">
        <h2 id="title"><?php
                        // Recupera a data da URL
                        if (isset($_GET['data'])) {
                          $data = new DateTime($_GET['data']);

                          $meses = array(1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril', 5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro');

                          $formattedDate = $data->format('d') . ' de ' . $meses[$data->format('n')] . ' de ' . $data->format('Y');

                          // Exibe a data na página
                          echo "<h2 id='title'>$formattedDate</h2>";
                        } else {
                          echo "Data não especificada na URL";
                        }
                        ?></h2>
      </div>
      </div>
      <div class="tabela">
        <?php
        if (isset($_GET['data'])) {
          $data = $_GET['data'];

          $sql = "SELECT * FROM consultas WHERE datas = '$data'"; // Corrigido para 'datas'
          $result = $conexao->query($sql);

          if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Data</th><th>horario</th><th>tratamento</th><th>descricao</th></tr>";
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row["datas"] . "</td>";
              echo "<td>" . $row["horario"] . "</td>";
              echo "<td>" . $row["tratamento"] . "</td>";
              echo "<td>" . $row["descricao"] . "</td>";
              echo "</tr>";
            }
            echo "</table>";
          } else {
            echo "0 resultados encontrados";
          }
          $conexao->close();
        } else {
          echo "Data não especificada na URL";
        }
        ?>

      </div>
      </div>
    </section>
  </main>
</body>

</html>