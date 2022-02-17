var id_atributo_elegido, id_producto, cantidad = 1;

function btnseleccionado(x, _id_atributo) {
    id_atributo_elegido = _id_atributo
    var header = document.getElementById("talles")
    var act = header.getElementsByClassName("active")
    var len = act.length
    if (len != 0) {
        act[0].classList.remove("active")
    }
    var btns = header.getElementsByClassName("btn-talle")
    btns[x].classList.add("active")
}

function currentSlide(x) {
    var current = document.getElementById("images")
    dotselect(x)
    current.src = imagenes[x-1]
}

function dotselect(x) {
    var header = document.getElementById("dots")
    var act = header.getElementsByClassName("dot-active")
    var len = act.length
    if (len != 0) {
        act[0].classList.remove("dot-active")
    }
    var btns = header.getElementsByClassName("dot")
    btns[(x - 1)].classList.add("dot-active")
}

function agregarProducto(){
    var data = new FormData();
    data.append("id_producto", id_producto);
    data.append("id_atributo", id_atributo_elegido);
    data.append("cantidad", cantidad);

    var xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener("readystatechange", function() {
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            mostrarAlerta()
        }
    });

    xhr.open("POST", "carrito.php");

    xhr.send(data);
}

function menos(){
    cantidad -= 1
    if(cantidad < 1)
        cantidad = 1
    actualizarCantidad()
}

function mas(){
    cantidad += 1
    actualizarCantidad()
}

function mostrarAlerta(){
    let alerta = document.getElementById("alerta")
    console.log("alerta")
    alerta.classList.remove("d-none")
    setTimeout(() => {alerta.classList.add("d-none")}, 3000)
}

function actualizarCantidad(){
    let spanCantidad = document.getElementById("cantidad");
    spanCantidad.innerText = cantidad
}