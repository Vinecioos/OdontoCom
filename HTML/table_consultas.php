<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/style.css" />
    <link
      rel="shortcut icon"
      href="../assets/LogoFav.PNG"
      type="image/x-icon"
    />
    <title>Consultas</title>
    <style>
        .planner{
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
    <main>
      <nav class="nav__administrador__container">
        <div class="nav__div__conatiner">
          <img src="../assets/person-circle.png" alt="" />
          <div class="div__administrador">
            <h2 class="administrador__titulo">Administrador</h2>
            <a class="editarPerfil" href="">Editar Perfil</a>
          </div>
        </div>
        <h3>ODONTOCOM</h3>
        <div class="links__container">
          <a class="links__escrita" href="consultas.php">
            <div class="links__opcoes">
              <img
                class="links__imagem"
                src="../assets/calendario.png"
                alt=""
              />
              Agendamento
            </div>
          </a>
          <a class="links__escrita" href="administradores.php">
            <div class="links__opcoes">
              <img
                class="links__imagem"
                src="../assets/cardAdministrador.png"
                alt=""
              />
              Administradores
            </div>
          </a>
          <a class="links__escrita" href="usuario.php">
            <div class="links__opcoes">
              <img class="links__imagem" src="../assets/person 1.png" alt="" />
              Usuário
            </div>
          </a>
          <a class="links__escrita" href="">
            <div class="links__opcoes">
              <img class="links__imagem" src="../assets/maleta.png" alt="" />
              Profissionais
            </div>
          </a>
          <a class="links__escrita" href="">
            <div class="links__opcoes">
              <img
                class="links__imagem"
                src="../assets/engrenagem.png"
                alt=""
              />
              Gerenciar
            </div>
          </a>
          <a class="links__escrita" href="">
            <div class="links__opcoes">
              <img class="links__imagem" src="../assets/sair.png" alt="" />
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
            <h2 id="title">20 Maio de 2024</h2>
          </div>
        </div>
        <div class="div__input__container">
          <div class="div__input">
            <div class="input">
              <label for="">Nome</label>
              <input type="text" />
            </div>
            <div class="input">
              <label for="">E-mail</label>
              <input type="text" />
            </div>
            <div class="input input__telefone__cpf">
              <label for="">Telefone</label>
              <input type="text" />
            </div>
            <div class="input input__telefone__cpf">
              <label for="">CPF</label>
              <input type="text" />
            </div>
          </div>
          <div class="div__botao">
            <button class="botao">
              <img
                class="botao__icon"
                src="../assets/Lupa.png"
                alt=""
              />Pesquisar
            </button>
          </div>
        </div>
          <div class="tabela">
            <!--A ser Incrementado-->
          </div>
        </div>
      </section>
    </main>
  </body>
</html>
