/*JavaScript Document*/

const carrusel = document.getElementById("carrusel");
const foto = document.querySelector(".foto");
const anterior = document.getElementById("moveratras");
const siguiente = document.getElementById("moveradelante");

siguiente.addEventListener("click", function(){
    const fotoancha = foto.clientWidth;
    carrusel.scrollLeft += fotoancha;
});

anterior.addEventListener("click", function(){
    const fotoancha = foto.clientWidth;
    carrusel.scrollLeft -= fotoancha;
});