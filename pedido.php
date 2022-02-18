<?php
    include_once("onlyclientes.php");
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
    <link rel="stylesheet" href="./assets/css/pedido.css">
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
    <main class="container carrito_resumen">
        <section class="b-bottom header" id="seleccionar">
            <?php 
                include_once("db.php");
                $conn = conectarBD();
                // Traigo el pedido seleccionado
                $id_pedido = $_GET["id"];
                $query = "SELECT pedidos.*, estados.nombre as estado_nombre
                          FROM pedidos 
                          JOIN estados ON estados.id = pedidos.id_estado
                          WHERE pedidos.id = $id_pedido";
                $result = consultaSQL($conn, $query);
                $pedido = $result->fetch_assoc();
                if($pedido && $pedido["id_usuario"] == $_SESSION["userid"]){
                    $seleccionaste = $pedido["envio"] == 1 ? "Envio a domicilio" : "Retiro en local";
                    // Traigo los pedidos_productos
                    $query = "SELECT pedidos_producto.*, producto.nombre as producto_nombre, producto_atributo.nombre as atributo_nombre , (SELECT imagen FROM producto_imagenes WHERE producto_imagenes.id_producto = pedidos_producto.id_producto LIMIT 1) as producto_imagen
                              FROM pedidos_producto
                              JOIN producto ON producto.id = pedidos_producto.id_producto
                              JOIN  producto_atributo ON pedidos_producto.id_atributo = producto_atributo.id
                              WHERE id_pedido = $id_pedido";
                    $result = consultaSQL($conn, $query);
                    $pedido_productos = [];
                    while($pp = $result->fetch_assoc()){
                        $pedido_productos[] = $pp;
                    }
                }
                else{
                    // No existe el pedido o es de un cliente distinto al logueado
                    header("location: index.php");                   
                }
                $aEstado;
                switch($pedido["id_estado"])
                {
                    case 1:
                        $aEstado = ["Pago Pendiente","yellow"];
                        break;
                        case 2:
                            $aEstado = ["Pago Aprobado","green"];
                            break;
                            case 3:
                                $aEstado = ["Pago Cancelado","red"];
                                break;
                }
            ?>
            
                <h2 class="header">Resumen del pedido #<?php echo $_GET["id"]; ?></h2>
                <div class="resumen section header">
                    <h2 class="header">Gracias por comprar en nuestra tienda</h2>
                    <p>Tu numero de pedido es: <?php echo $_GET["id"]; ?></p>
                    <p class="small">Durante las proximas horas te estaremos contactando via mail para actualizarte el estado del pedido</p>
                    <p class="small">Estado del pedido: <span class="<?php  echo $aEstado[1] ?>"><?php echo $pedido["estado_nombre"] ?></span></p>
                </div>
                <div class="resumen section productos">
                    <h2 class="header">Productos:</h2>
                    <ul class="carrito_productos">
                        <?php
                        foreach ($pedido_productos as $pp) {
                            echo('
                                <li>
                                <img src="'.$pp["producto_imagen"].'" alt="">
                                <div class="info">
                                    <div class="descripcion">
                                        <p class="id">#'.$pp["id_producto"].'</p>
                                        <h3>'.$pp["producto_nombre"].'</h3>
                                        <p class="tags">'.$pp["atributo_nombre"].'</p>
                                    </div>
                                    <div class="cantidad">
                                        <p>Precio unit.: $'.number_format($pp["precio_unitario"], 2).'</p>
                                        <p>Cantidad: '.strval($pp["cantidad"]).'</p>
                                    </div>
                                    <div class="precio_item">
                                        $'.number_format($pp["precio_unitario"] * $pp["cantidad"], 2).'
                                    </div>
                                </div>
                            </li>'); 
                        }
                        ?>
                    </ul>
                </div>
                <div class="section envio">
                    <h2 class="header">Datos de <?php echo $pedido["envio"] == 1 ? "envio" : "retiro" ?></h2>
                    <p class="seleccionaste">Seleccionaste: <b><?php echo $seleccionaste?></b></p>
                    <div class="info-envio">
                        <h3>Datos:</h3>
                        <div class="row">
                            <b>Nombre:</b>
                            <p><?php echo $pedido["envio_nombre"] ?></p>
                        </div>
                        <div class="row">
                            <b>Direccion:</b>
                            <p><?php echo $pedido["envio_direccion"] ?></p>
                        </div>
                        <div class="row">
                            <b>DNI:</b>
                            <p><?php echo $pedido["envio_dni"] ?></p>
                        </div>
                        <div class="row">
                            <b>Telefono:</b>
                            <p><?php echo $pedido["envio_telefono"] ?></p>
                        </div>
                    </div>
                </div>
                <div class="section pago">
                    <h2 class="header">Datos de pago</h2>
                    <div class="info-pago">
                        <p>Total: <b>$<?php echo number_format($pedido["importe"], 2); ?></b> </p>
                        <p>Abonado con la tarjeta terminada en <?php echo substr($pedido["pago_tarjeta"], -4) ?> </p>
                        <p>Titular: <?php echo $pedido["pago_titular"] ?></p>
                    </div>
                </div>
                </section>
      
    </main>

    <script src="./assets/js/carritoenvio.js"></script>
</body>

</html>