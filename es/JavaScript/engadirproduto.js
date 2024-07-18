/* JavaScript Document */
let produto = document.getElementById("produto");
let descricion = document.getElementById("descricion");
let categoria = document.getElementById("categoria");
let stock = document.getElementById("stock");
let prezo = document.getElementById("telefono");
let imaxe = document.getElementById("imagenPrevisualizacion");
let engadir = document.getElementById("engadir");
let avisos = document.querySelector(".avisos");
engadir.addEventListener("click", function(event){
    if (produto.value=="" || descricion.value=="" || categoria.value=="Seleccione categoría" 
    || stock.value=="" || prezo.value=="" || imaxe.value=="") {
        avisos.style.display = "block";
        avisos.innerHTML = "<img src='Imaxes/Xerais/aviso.png' width='100%' alt='Aviso'/>Tienes algunos campos sin completar. Revíselo.";
        event.preventDefault();
    }
});