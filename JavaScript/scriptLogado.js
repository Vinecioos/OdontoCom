//MENU DO PERFIL E ABA PERFIL

let btnMenu = document.getElementById("btn-menu-perfil");
let menu = document.getElementById("menu-perfil");
let overlay = document.getElementById("overlay-menu");
let btnSair = document.getElementById("bi bi-x-perfil");

let btnHabilitaEditar = document.getElementById("editar-perfil");
let nomeEditar = document.querySelector(".input-nome");
let emailEditar = document.querySelector(".input-email");
let telEditar = document.querySelector(".input-tel");
let cpfEditar = document.querySelector(".input-cpf");
let senhaEditar = document.querySelector(".input-senha");
let btnEditar = document.querySelector(".input-edit");
let cabecalho = document.getElementById("cabecalho-secundario");


//MENU DO PERFIL E ABA PERFIL

btnMenu.addEventListener('click', () => {
    menu.classList.add('abrir-menu')
})

overlay.addEventListener('click', () => {
    menu.classList.remove('abrir-menu')
})

btnSair.addEventListener('click', () => {
    menu.classList.remove('abrir-menu')
})

btnHabilitaEditar.addEventListener('click', () => {

    cabecalho.innerHTML += " > Editar";

    nomeEditar.removeAttribute("disabled");
    emailEditar.removeAttribute("disabled");
    telEditar.removeAttribute("disabled");
    cpfEditar.removeAttribute("disabled");
    senhaEditar.removeAttribute("disabled");
    btnEditar.removeAttribute("disabled");

})

