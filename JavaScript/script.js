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

