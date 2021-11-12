let pendiente = document.getElementById("pendiente")
let botones = document.getElementById('botones')
let modal = document.getElementById('modal')
let textoModal = document.getElementById('texto-modal')
let accion = ""


function confirmar(confirmacion){
    modal.style.display = "block";
    accion = "confirmar"
    textoModal.innerHTML = accion
    if(!confirmacion)
        return
    borrarBotones()
    pendiente.innerHTML = "Aprobado"
    pendiente.className = "state success"
}

function rechazar(confirmacion){
    modal.style.display = "block";
    accion = "rechazar"
    textoModal.innerHTML = accion
    if (!confirmacion)
        return
    borrarBotones()
    pendiente.innerHTML = "Rechazado"
    pendiente.className = "state cancel"
}


function borrarBotones(){
    botones.classList.add("d-none")
}

function confirmarAccion(){
    if(accion == "confirmar")
        confirmar(true)
    else{
        if(accion == "rechazar"){
            rechazar(true)
        }
    }
    modal.style.display = "none";
}

function cancelarAccion(){
    accion = ""
    modal.style.display = "none";
}
