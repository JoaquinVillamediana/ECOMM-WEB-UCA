<?php
    include_once("onlyclientes.php");
    function traer_carrito_productos($id_carrito, $conn){
        // Me fijo si existe el carrito
        $query = "SELECT producto.precio as precio, producto.descuento as descuento, cantidad
                  FROM carrito_productos
                  JOIN producto ON carrito_productos.id_producto = producto.id
                  WHERE id_carrito = $id_carrito";
        $res = consultaSQL($conn, $query);
        if($res->num_rows < 1)
        {
            $res = NULL;
        }
        return $res;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        include_once("db.php");
        $userid = $_SESSION["userid"];
        $conn = conectarBD();
        // Datos de pago
        $titular = $_POST["titular"];
        $tarjeta = $_POST["tarjeta"];
        $expiracion = $_POST["expiracion"];
        $cvc = $_POST["cvc"];
        // consigo el carrito
        $query = "SELECT *
                  FROM carrito 
                  WHERE id_usuario = $userid";
        $result = consultaSQL($conn, $query);
        $carrito = $result->fetch_assoc();
        $id_carrito = $carrito["id"];
        $nombre = $carrito["nombre"];
        $direccion = $carrito["direccion"];
        $telefono = $carrito["telefono"];
        $dni = $carrito["dni"];
        $envio = $carrito["envio"];
        // Conseguir el importe
        $importe = 0;
        $carritos_productos = traer_carrito_productos($carrito["id"], $conn);
        while($cp = $carritos_productos->fetch_assoc()){
            $precioFinal = $cp['precio'] - $cp['precio']*($cp["descuento"] /100);
            $importe += $precioFinal * $cp["cantidad"];
        }
        
        

        // Hago el pedido
        $query = "INSERT INTO pedidos(id_usuario, id_estado, envio, envio_nombre, envio_direccion, envio_dni, envio_telefono, pago_titular, pago_tarjeta, pago_expiracion, pago_cvc, importe)
                  VALUES($userid, 1, $envio, '$nombre', '$direccion', $dni, '$telefono', '$titular', '$tarjeta', '$expiracion', $cvc, $importe)";
        consultaSQL($conn, $query);
        $id_pedido = $conn->insert_id;
        // Hago los pedido_producto
        $query = "INSERT INTO pedidos_producto(id_pedido, id_producto, id_atributo, cantidad, precio_unitario)
                  SELECT $id_pedido as id_pedido, id_producto, id_atributo, cantidad, (producto.precio - (producto.precio * (producto.descuento / 100))) as precio_unitario
                  FROM carrito_productos 
                  JOIN producto on producto.id = carrito_productos.id_producto 
                  WHERE id_carrito = $id_carrito";
        
        consultaSQL($conn, $query);

        // Bajo el stock

        $query = "SELECT * FROM carrito_productos WHERE id_carrito = $id_carrito";
        $result = consultaSQL($conn, $query);
        while($row = $result->fetch_assoc())
        {
            $id_producto = $row["id_producto"];
            $cantidad = $row["cantidad"];

            $conn2 = conectarBD();
            $query2 = "UPDATE producto SET stock = ( producto.stock - ".intval($cantidad)." ) WHERE producto.id = $id_producto";
            
            consultaSQL($conn2,$query2);
            desconectarBD($conn2);
        }

        // Vuelo el carrito y los carrito_producto
        $query = "DELETE FROM carrito_productos WHERE id_carrito = $id_carrito";
        consultaSQL($conn, $query);
        $query = "DELETE FROM carrito WHERE id = $id_carrito";
        $result = consultaSQL($conn, $query);
        

        desconectarBD($conn);
        header("Location: pedido.php?id=$id_pedido");
    }
    else{
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/carrito.css">
    <link rel="stylesheet" href="./assets/css/carritopago.css">
</head>

<body>

    <header>
        <div class="container">
            <img src="./assets/img/logo.png" alt="" class="logo">
            <div class="links">
                <a href="index.php" class="link">Volver al sitio</a>
            </div>
        </div>
    </header>
    <ul class="progress_carrito">
        <li class="done">
            <a href="carrito.php">Mi carrito</a>
        </li>
        <li class="done">
            <a href="carritoenvio.php">Datos</a>
        </li>
        <li>
            <a>Datos de pago</a>
        </li>
    </ul>
    <main class="container carrito_resumen">
        <section class="header b-bottom">
            <h2 class="header">Datos de pago</h2>
            <form class="form" method="POST" id="form">
                <div class="form-group">
                    <div class="form-item">
                        <div class="textfield">
                            <label for="titular">Titular de la tarjeta</label>
                            <input name="titular" id="titular" type="text">
                            <p class="textfield-p-error d-none" id="titular-error"></p>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="textfield">
                            <label for="tarjeta">Numero de la tarjeta</label>
                            <input name="tarjeta" id="tarjeta" type="text" placeholder="1234-5987-4567-4569" maxlength="19" onkeyup="return agregarGuion(event)">
                            <p class="textfield-p-error d-none" id="tarjeta-error"></p>
                        </div>
                    </div>
                    <div class="form-item dividido">
                        <div class="textfield">
                            <label for="date">Fecha de expiracion</label>
                            <input name="expiracion"  id="date" type="text" placeholder="MM/AA" maxlength="5" onkeyup="return agregarBarra(event)">
                            <p class="textfield-p-error d-none" id="date-error"></p>
                        </div>
                        <div class=" textfield ">
                            <label for= "cvc" >CVC</label>
                            <input name="cvc"  id= "cvc" type="number" placeholder="123">
                            <p class=" textfield-p-error d-none " id="cvc-error"></p>
                        </div>
                    </div>
                </div>  
            </form>
            <button class=" proceder " onclick=" confirmar() ">Confirmar compra</button>

        </section>
    </main>
    <script src=" ./assets/js/carritopago.js "></script>
</body>

</html>
<?php } ?>