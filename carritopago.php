<?php
    include_once("onlyclientes.php");
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
        $query = "SELECT *, (SELECT SUM((cantidad * producto.precio)) as subtotal FROM carrito_productos JOIN producto ON producto.id = carrito_productos.id_producto WHERE id_carrito = carrito.id) as importe
                  FROM carrito 
                  WHERE id_usuario = $userid";
        $result = consultaSQL($conn, $query);
        $carrito = $result->fetch_assoc();
        $nombre = $carrito["nombre"];
        $direccion = $carrito["direccion"];
        $telefono = $carrito["telefono"];
        $importe = $carrito["importe"];
        $dni = $carrito["dni"];
        $envio = $carrito["envio"];
        // Hago el pedido
        $query = "INSERT INTO pedidos(id_usuario, id_estado, envio, envio_nombre, envio_direccion, envio_dni, envio_telefono, pago_titular, pago_tarjeta, pago_expiracion, pago_cvc, importe)
                  VALUES($userid, 1, $envio, '$nombre', '$direccion', $dni, '$telefono', '$titular', '$tarjeta', '$expiracion', $cvc, $importe)";
        consultaSQL($conn, $query);
        $id_pedido = $conn->insert_id;
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