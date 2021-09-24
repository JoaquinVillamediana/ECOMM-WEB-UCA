let sectionSeleccionar = document.querySelector("#seleccionar")
let sectionDatos = document.querySelector("#datos")

let optRetiro = document.querySelector("#retiro")
let optEnvio = document.querySelector("#envio")

let datosTitulo = document.querySelector("#datos_titulo")
let opcion="";

function seleccionar(opt){
    optEnvio.checked = false
    optRetiro.checked = false
    if(opt === "" || opcion === opt){
        opcion=""
        sectionDatos.classList.add("d-none")
        sectionSeleccionar.classList.add("b-bottom")
    }
    else{
        opcion=opt
        if(opcion === "envio")
            optEnvio.checked = true
        if(opcion === "retiro")
            optRetiro.checked = true
        datosTitulo.innerHTML = `Datos de ${opt}`
        sectionDatos.classList.remove("d-none")
        sectionDatos.classList.add("b-bottom")
        sectionSeleccionar.classList.remove("b-bottom")
    }
}

function proceder(){
    window.location.href = "carritopago.html"
}