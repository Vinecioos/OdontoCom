<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="shortcut icon" href="../assets/LogoFav.PNG" type="image/x-icon">
    <title>Administradores</title>
</head>

<body>
    <header class="cabecalho">
        <div class="cabecalho__logo">
            <a href="administrador.html">
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
                <a class="links__escrita" href="administradores.html">
                    <div class="links__opcoes">
                        <img class="links__imagem" src="../assets/cardAdministrador.png" alt="">
                        Administradores
                    </div>
                </a>
                <a class="links__escrita" href="usuario.html">
                    <div class="links__opcoes">
                        <img class="links__imagem" src="../assets/person 1.png" alt="">
                        Usuário
                    </div>
                </a>
                <a class="links__escrita" href="profissionais.html">
                    <div class="links__opcoes">
                        <img class="links__imagem" src="../assets/maleta.png" alt="">
                        Profissionais
                    </div>
                </a>
                <a class="links__escrita" href="gerenciar.html">
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
                <p>Administradores</p>
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
                    <button class="botao botao__novoUsuario"><img class="botao__icon"src="../assets/usuario+.png" alt="">Criar Administrador</button>
                </div>
                <div class="tabela">
                    <!--A ser Incrementado-->
                </div>
            </div>
        </section>
    </main>
</body>
</html>