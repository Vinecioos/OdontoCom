<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="shortcut icon" href="../assets/LogoFav.PNG" type="image/x-icon">
    <title>Gerenciar</title>
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
                <a class="links__escrita" href="">
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
                <p>Gerenciamento</p>
            </div>
            <div class="div__input__gerenciar__container">
                <div class="div__input__gerenciar">
                    <div class="input__gerenciar">
                        <label for="">Nome</label>
                        <input type="text">
                        <div class="botao__gerenciar__container">
                            <button class="botao__gerenciar"><img class="botao__icon" src="../assets/+.png"
                                    alt="">Adcionar Procedimento</button>
                        </div>
                    </div>
                    <div class="input__gerenciar  TUSS">
                        <label for="">TUSS</label>
                        <input type="text">
                    </div>
                    <div class="input__gerenciar">
                        <button class="botao__pesquisar">Pesquisar</button>
                    </div>
                </div>
                <div class="tabela__gerenciar">
                    <!--A ser Incrementado-->
                </div>
            </div>
            <div class="informacoes__container">
                <div class="disposição__disponibildade">
                    <h2 class="texto__informacoes">Disposição dos Profissionais</h2>
                    <div class="tabela__gerenciar__informacoes">

                    </div>
                </div>
                <div class="disposição__disponibildade">
                    <h2 class="texto__informacoes">Disponibildade de Agendamento</h2>
                    <div class="tabela__gerenciar__informacoes">

                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>