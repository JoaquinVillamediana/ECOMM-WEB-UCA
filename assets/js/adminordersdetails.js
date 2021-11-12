let pendiente = document.getElementById("pendiente")
let botones = document.getElementById('botones')

function confirmar(){
    borrarBotones()
    pendiente.innerHTML = "Aprobado"
    pendiente.className = "state success"
}

function rechazar(){
    borrarBotones()
    pendiente.innerHTML = "Rechazado"
    pendiente.className = "state cancel"
}


function borrarBotones(){
    botones.classList.add("d-none")
}