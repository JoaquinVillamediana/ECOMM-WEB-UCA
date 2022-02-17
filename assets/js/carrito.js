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
            if(productos.children.length == 0){
                window.location.href = "carrito.php"
            }
            else{
                let itemsTotales = document.getElementById("itemsTotales")
                let precioTotal = document.getElementById("precioTotal")
                const options = { style: 'currency', currency: 'ARS' };
                const numberFormat2 = new Intl.NumberFormat('es-AR', options);
                let precioProducto = parseInt(productoEliminado.attributes.precio.value)
                precioTotal.attributes.precio.value -= precioProducto
                precioTotal.innerText = numberFormat2.format(precioTotal.attributes.precio.value)
                itemsTotales.innerText = productos.children.length
            }
        }
      });
    xhr.send(data);
}