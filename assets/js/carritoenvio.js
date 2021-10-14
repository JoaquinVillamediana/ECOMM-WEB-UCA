let sectionSeleccionar = document.querySelector("#seleccionar")
let sectionDatos = document.querySelector("#datos")

let optRetiro = document.querySelector("#retiro")
let optEnvio = document.querySelector("#envio")

let datosTitulo = document.querySelector("#datos_titulo")
let opcion="";

function seleccionar(opt){
    limpiarInputs()
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
    let ok = true
    if(!validarDirec('direccion', 'La direccion no debe estar vacía'))
        ok = false
    if(!validarNom('nombre', 'El nombre no debe estar vacío y debe contener solo letras.'))
        ok = false
    if(!validarNum('dni', 'El dni no debe estar vacío y deben ser solo numeros.'))
        ok = false
    if(!validarNum('telefono', 'El telefono no debe estar vacío y deben ser solo numeros.'))
        ok = false

    if(ok)
        window.location.href = "carritopago.html"
}

function mostrarErrorInput(id, mensajeError){
    let e = document.getElementById(`${id}-error`)
    if(e){
        if(mensajeError === "" || mensajeError === undefined){
            e.innerHTML = ""
            e.classList.add("d-none")
        }
        else{
            e.innerHTML = mensajeError
            e.classList.remove("d-none")
        }
    }
}

function limpiarInputs(){
    ["telefono", "dni", "nombre", "direccion"].forEach((id) => {
        mostrarErrorInput(id, "")
        var x = document.getElementById(id)
        x.className = ""
        x.value=""
    })
}

function validarInput(id, validacion, mensajeError){
    // recibe un id de input y una funcion booleana validacion, y le pone la clase de css segun si fue
    // validada correctamente o no, ademas retorna si se valido bien o no
    var x = document.getElementById(id)
    if(validacion(x)){
        x.classList.remove("error")
        x.classList.add("validated")
        mostrarErrorInput(id, "")
        return true
    }
    else{
        x.classList.add("error")
        x.classList.remove("validated")
        mostrarErrorInput(id, mensajeError)
        return false
    }
}

function validarNom(miID, mensajeError){
    return validarInput(miID, (x) => (x.value !== "" && sonLetras(x.value)), mensajeError)
}

function validarDirec(miID, mensajeError){
    return validarInput(miID, (x) => (x.value !== ""), mensajeError)
}

function validarNum(miID, mensajeError){
    return validarInput(miID, (x) => (x.value !== "" && !isNaN(x.value)), mensajeError)
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