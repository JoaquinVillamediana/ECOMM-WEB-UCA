function eliminarProductoCarrito(id_producto_carrito){
    var data = new FormData();
    data.append("id_eliminar", id_producto_carrito);

    var xhr = new XMLHttpRequest();
    xhr.withCredentials = true;


    xhr.open("POST", "carrito.php");
    xhr.addEventListener("readystatechange", function() {
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            let productos = document.getElementById("productos")
            let productoEliminado = document.getElementById("carrito_producto_" + id_producto_carrito)
            productos.removeChild(productoEliminado)
        }
      });
    xhr.send(data);
}