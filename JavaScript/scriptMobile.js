//MENU MOBILE

let btnMenuMobile = document.getElementById("btn-menu-mob");
let menuMobile = document.getElementById("menu-mobile");
let overlayMobile = document.getElementById("overlay-menu-mob");


btnMenuMobile.addEventListener('click', ()=>{
    menuMobile.classList.add('abrir-menu-mob')
})

menuMobile.addEventListener('click', ()=>{
    menuMobile.classList.remove('abrir-menu-mob')
})

overlayMobile.addEventListener('click', ()=>{
    menuMobile.classList.remove('abrir-menu-mob')
})
