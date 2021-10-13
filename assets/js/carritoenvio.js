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

function sonLetras(str){
    var x = 0
    for (let i of str){
        if ((i.charCodeAt(0)>122 || i.charCodeAt(0)<65) && i.charCodeAt(0)!=32){
            x+=1
        }
    }
    if (x>0){
        return false
    }
    else if (x===0){
        return true
    }
}

function validarNom(miID){
    var x = document.getElementById(miID)
    if (x.value === "" || sonLetras(x.value)===false) {
        x.classList.add("error")
    }
    else{
        x.classList.remove("error")
    }
}

function validarDirec(miID){
    var x = document.getElementById(miID)
    if (x.value === "") {
        x.classList.add("error")
    }
    else{
        x.classList.remove("error")
    }
}

function validarNum(miID){
    var x = document.getElementById(miID)
    if (x.value === "" || isNaN(x.value)) {
        x.classList.add("error")
    }
    else{
        x.classList.remove("error")
    }
}