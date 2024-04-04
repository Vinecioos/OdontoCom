document.addEventListener("DOMContentLoaded", function() {
    let botao1 = document.getElementById("botao1");
    let botao2 = document.getElementById("botao2");
    
    botao1.addEventListener("click", function() {
        let posicaoY = 650; 

        window.scrollTo({
            top: posicaoY,
            behavior: 'smooth'
        });
    });

    botao2.addEventListener("click", function() {
        let posicaoY = 1200; 

        window.scrollTo({
            top: posicaoY,
            behavior: 'smooth'
        });
    });
});

//MENU DO PERFIL E ABA PERFIL

let btnMenu = document.getElementById("btn-menu-perfil");
let menu = document.getElementById("menu-perfil");
let overlay = document.getElementById("overlay-menu");

btnMenu.addEventListener('click', ()=>{
    menu.classList.add('abrir-menu')
})

menu.addEventListener('click', ()=>{
    menu.classList.remove('abrir-menu')
})

overlay.addEventListener('click', ()=>{
    menu.classList.remove('abrir-menu')
})

