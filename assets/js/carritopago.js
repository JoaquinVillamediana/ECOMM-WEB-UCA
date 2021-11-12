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

function sonNumeros(str){
    var x = 0
    for (let i of str){
        if ((i.charCodeAt(0)>57 || i.charCodeAt(0)<48)){
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

function confirmar(){
    var x = validarInputs()
    if (x) {
        window.location.href = "pedido.html"
    }
}

function validarInputs(){
    var nom = validarNom("titular","Este campo no debe estar vacío.")
    var tarj = validarNumTarjeta("tarjeta","Este campo no debe estar vacío.")
    var fech = validarFechaExp("date","Este campo no debe estar vacío.")
    var cvc = validarCVC("cvc","Este campo no debe estar vacío.")
    if (nom && tarj && fech && cvc){
        return true
    }else {
        return false
    }

}

function validarNom(miID,mensajeError){
    var x = document.getElementById(miID)
    var ok = false
    if (x.value != "" && sonLetras(x.value)){
        ok = true
    }
    else {
        mostrarErrorInput(miID,mensajeError)
        ok = false
    }
    return ok
}

function validarNumTarjeta(miID,mensajeError){
    var x = document.getElementById(miID)
    var ok = false
    if (x.value != "" && sonNumeros(x.value) && x.value.length==16){
        ok =  true
    }
    else {
        mostrarErrorInput(miID,mensajeError)
        ok = false
    }
    return ok
}

function validarFechaExp(miID,mensajeError){
    var x = document.getElementById(miID)
    var ok = false
    if (x.value != "" && x.value == 5){
        ok =  true
    }
    else {
        mostrarErrorInput(miID,mensajeError)
        ok = false
    }
    return ok
}

function validarCVC(miID,mensajeError){
    var x = document.getElementById(miID)
    var ok = false
    if (x.value != "" && x.value == 3 && sonNumeros(x.value)){
        ok =  true
    }
    else {
        mostrarErrorInput(miID,mensajeError)
        ok = false
    }
    return ok
}

function agregarBarra(e){
    if (e.key != "Backspace"){
        if(e.target.value.length == 2){
            e.target.value += "/"
        }
    }
}

function agregarGuion(e){
    if (e.key != "Backspace"){
        var len = e.target.value.length
        if(len == 4 || len == 9 || len == 14){
            e.target.value += "-"
        }
    }
}