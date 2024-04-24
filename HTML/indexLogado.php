<?php
session_start();
$dbHost = "Localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "login";

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
?>
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
  <script src="../JavaScript/scriptLogado.js" defer></script>
  <link rel="stylesheet" href="../style/style.css">
  <link rel="shortcut icon" href="assets/LogoFav.PNG" type="image/x-icon">
  <title>OdontoCom</title>
</head>

<body>
  <!--Cabeçalho-->
  <header class="cabecalho">
    <div class="cabecalho__logo">
      <a href="indexLogado.php">
        <img class="logo" src="../assets/OdontoCom_White.png" alt="Logo">
      </a>
    </div>

    <nav class="cabecalho-logado">
      <a class="cabecalho__botao cabecalho__informacoes__menu" href="#sobreNosBotao">Sobre nós</a>
      <a class="cabecalho__botao cabecalho__informacoes__menu" href="#tratamentosBotao">Tratamentos</button></a>

      <div id="btn-menu-perfil" class="btn-menu-perfil">
        <i class="bi bi-person-circle"></i>
        <div class="meu-perfil-central">
          <a href="#" class="meu-perfil">Meu</a>
          <a href="#" class="meu-perfil"> Perfil</a>
        </div>
      </div>

    </nav>

    <div class="menu-perfil" id="menu-perfil">
      <div class="btn-fechar">
        <i class="bi bi-x" id="bi bi-x-perfil"></i>
      </div>

      <nav>
        <ul>
          <li>
            <p><?php
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
                    echo "Bem Vindo, $nomeDoUsuario!";
                  }
                }
                ?></p>
          </li>
          <li class="opcoes-mobile"><a class="btn-sobre-nos" href="#sobreNosBotao">Sobre nós</a></li>
          <li class="opcoes-mobile"><a class="btn-tratamentos" href="#tratamentosBotao">Tratamentos</button></a></li>
          <li><a href="agendamentos.php">Agendamentos</a></li>
          <li><a href="dadosPessoais.php">Dados Pessoais</a></li>
          <li><a href="index.html">Sair</a></li>
        </ul>
      </nav>
    </div>

    <div class="overlay-menu" id="overlay-menu"></div>

  </header>
  <!--FIM Cabeçalho-->
  <!--Body-->
  <main>
    <div class="container">
      <section class="container__retangulo">
        <div class="container-vinicius">
          <div class="retangulo__titulo">
            <h2 class="retangulo__titulo__escrita">OdontoCom</h2>
          </div>
          <p class="retangulo__escrita">No consultório <b>"OdontoCom"</b>, cuidamos do seu sorriso com dedicação e
            expertise.
            Nossa equipe de profissionais altamente qualificados está comprometida em proporcionar tratamentos
            odontológicos
            com excelência, garantindo sua saúde bucal e a beleza do seu sorriso.
          </p>
          <a class="retangulo__botao" href="../HTML/agendamentos.php">Agendar Consulta</a>
        </div>
      </section>
      <img class="imagem" src="../assets/Imagem1.jpg" alt="">
    </div>
    <div id="sobreNosBotao" class="divisoria">
      <h1 class="divisoria__sobreNos"> Sobre Nós</h1>
    </div>
    <section class="sobreNos__container">
      <div class="sobreNos">
        <img class="sobreNos__logo" src="../assets/OdontoCom_logo1.png" alt="">
        <p class="sobreNos__escrita">Na OdontoCom, somos mais do que uma clínica odontológica. Somos uma família
          comprometida em oferecer cuidados excepcionais aos nossos pacientes. Nossa equipe é composta por profissionais
          apaixonados pela saúde bucal e pelo bem-estar dos nossos pacientes.
          <br>
          O que nos destaca é o nosso compromisso com o conforto, a conveniência e a satisfação dos pacientes. Desde o
          momento em que você entra em nossa clínica, você será recebido com um sorriso caloroso e um ambiente
          acolhedor. Nosso objetivo é tornar cada visita uma experiência positiva e relaxante.
          <br>
          Na OdntoCom, investimos em tecnologia de ponta e educação contínua para garantir que nossos pacientes recebam
          os melhores tratamentos possíveis. Nossa equipe está sempre atualizada com as últimas técnicas e avanços na
          odontologia, para que você possa ter confiança em nossa experiência e habilidade.
        </p>
      </div>
    </section>
    <div id="tratamentosBotao" class="divisoria">
      <h1 class="divisoria__tratamentos">Tratamentos</h1>
    </div>
    <!-- Carrosel/Slide -->
    <section>
      <div class="slider">
        <input type="radio" name="toggle" id="btn-1" checked>
        <input type="radio" name="toggle" id="btn-2">
        <input type="radio" name="toggle" id="btn-3">

        <div class="slider-controls">
          <label for="btn-1"></label>
          <label for="btn-2"></label>
          <label for="btn-3"></label>
        </div>

        <ul class="slides">
          <li class="slide">
            <div class="slide-content">
              <h2 class="slide-title">Aparelho</h2>
              <p class="slide-text"> Aparelho dental, é um dispositivo utilizado para corrigir problemas de má oclusão
                dentária e malformações na arcada dentária. Ele é composto por diferentes componentes, cada um
                desempenhando um papel específico no processo de correção ortodôntica.</p>
            </div>
            <p class="slide-image">
              <img src="../assets/Aparelho.png" alt="stuff" width="320" height="240">
            </p>
          </li>
          <li class="slide">
            <div class="slide-content">
              <h2 class="slide-title">Cárie</h2>
              <p class="slide-text">Essa desmineralização leva à formação de pequenas aberturas ou cavidades nos dentes,
                que podem progredir e comprometer estruturas mais profundas, como a dentina e até mesmo a polpa
                dentária, se não tratadas adequadamente!</p>
            </div>
            <p class="slide-image">
              <img src="../assets/Carie.png" alt="stuff" width="320" height="240">
            </p>
          </li>
          <li class="slide">
            <div class="slide-content">
              <h2 class="slide-title">Clareamento</h2>
              <p class="slide-text">O clareamento dental é um procedimento odontológico popular que visa melhorar a
                aparência estética dos dentes, tornando-os mais brancos e brilhantes. </p>

            </div>
            <p class="slide-image">
              <img src="../assets/Clareamento.png" alt="stuff" width="320" height="240">
            </p>
          </li>

        </ul>
      </div>

      <div class="tratamentos-mobile">
        <div class="slide-content">
          <h2 class="slide-title">Aparelho</h2>
          <p class="slide-text"> Aparelho dental, é um dispositivo utilizado para corrigir problemas de má oclusão
            dentária e malformações na arcada dentária. Ele é composto por diferentes componentes, cada um
            desempenhando um papel específico no processo de correção ortodôntica.</p>
          <p class="slide-image">
            <img src="../assets/Aparelho.png" alt="stuff" width="320" height="240">
          </p>
        </div>
        <div class="slide-content">
          <h2 class="slide-title">Cárie</h2>
          <p class="slide-text">Essa desmineralização leva à formação de pequenas aberturas ou cavidades nos dentes,
            que podem progredir e comprometer estruturas mais profundas, como a dentina e até mesmo a polpa
            dentária, se não tratadas adequadamente!</p>
          <p class="slide-image">
            <img src="../assets/Carie.png" alt="stuff" width="320" height="240">
          </p>
        </div>
        <div class="slide-content">
          <h2 class="slide-title">Clareamento</h2>
          <p class="slide-text">O clareamento dental é um procedimento odontológico popular que visa melhorar a
            aparência estética dos dentes, tornando-os mais brancos e brilhantes. </p>
          <p class="slide-image">
            <img src="../assets/Clareamento.png" alt="stuff" width="320" height="240">
          </p>
        </div>
      </div><!--Fim tratamentos Mobile-->
    </section>
    <!-- FIM Carrosel/Slide -->
  </main>
  <!-- FIM Body-->
  <!--Rodapé-->
  <footer>
    <div class="rodape">
      <a class="rodape__escrita" href="ByTech.html">&copy; Criado por ByTech</a>
    </div>
  </footer>
  <!--Fim Rodapé-->
</body>

</html>