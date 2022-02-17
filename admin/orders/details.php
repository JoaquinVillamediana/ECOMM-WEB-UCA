<?php
include_once('../../onlyadmin.php');
include_once('../../db.php'); 
$conn = conectarBD();
$query = 'SELECT * 
FROM `pedidos` 
WHERE pedidos.id = '.$_GET["id"].'
';
$pedido = consultaSQL($conn, $query);
if($pedido->num_rows < 1)
{
    header('Location: index.php');
}
$pedido = $pedido->fetch_assoc();

switch($pedido["id_estado"])
{
    case 1:
        $aEstado = ["Pago Pendiente","pending"];
        break;
        case 2:
            $aEstado = ["Pago Aprobado","success"];
            break;
            case 3:
                $aEstado = ["Pago Cancelado","cancel"];
                break;
}
desconectarBD($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="../../assets/css/general_admin.css">
    <link rel="stylesheet" href="../../assets/css/carrito.css">
    <link rel="stylesheet" href="../../assets/css/adminordersdetails.css">
</head>

<body>

    <header>
        <div class="container">
            <div class="logo-container">
                <img src="../../assets/img/logo.png" alt="" class="logo"> - Admin
                <img src="../../assets/svg/bars-solid.svg" width="25" class="bars" onclick="toggleHamburguesa()">
            </div>
            <div class="links">
                <a href="../banner/index.php" class="link">Banner</a>
                <a href="../users/index.php" class="link">Usuarios</a>
                <a href="../product/index.php" class="link">Productos</a>
                <a href="../category/index.php" class="link">Categorias</a>
                <a href="../orders/index.php" class="link">Pedidos</a>
                <a href="../../logout.php" class="link logout">Log-Out</a>
            </div>
        </div>
    </header>

    <div class="container main-container">
        <form action="" id="productForm">
            <h1 class="text-center my-1">Revisar orden #<?php echo($pedido["id"]); ?></h1>
            <div class="estado">
                <p>Estado del pedido: </p> <?php echo('<span class="state '.$aEstado[1].'">'.$aEstado[0].'</span>'); ?> <br>
                <?php if($pedido["id_estado"] == 1){ ?>
                <div id="botones">
                    <button type="button" class="btn btn-success" onclick="confirmar()">Confirmar</button>
                    <button type="button" class="btn btn-cancel" onclick="rechazar()">Rechazar</button>
                </div>
                <?php } ?>
                <div id="modal" class="modal">
                    <div class="contenido">
                        <p>Seguro que desea <span id="texto-modal">rechazar</span> este pedido?</p>
                        <div class="botones">
                            <button type="button" class="btn btn-success" onclick="confirmarAccion()">Si</button>
                            <button type="button" class="btn btn-cancel" onclick="cancelarAccion()">No</button>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="prod">Productos</h2>
            <ul class="carrito_productos">
                <?php 
                $conn = conectarBD();
                $query = "SELECT pedidos_producto.*, producto.nombre as producto_nombre, producto_atributo.nombre as atributo_nombre , (SELECT imagen FROM producto_imagenes WHERE producto_imagenes.id_producto = pedidos_producto.id_producto LIMIT 1) as producto_imagen
                FROM pedidos_producto
                JOIN producto ON producto.id = pedidos_producto.id_producto
                JOIN  producto_atributo ON pedidos_producto.id_atributo = producto_atributo.id
                WHERE id_pedido = ". $pedido["id"] ."";
                $result = consultaSQL($conn,$query);

                while($row = $result->fetch_assoc())
                {
                    echo('
                    <li>
                    <img src="../../'.$row['producto_imagen'].'" alt="">
                    <div class="info">
                        <div class="descripcion">
                            <p class="id">#'. $row["id"] .'</p>
                            <h3>'. $row["producto_nombre"] .'</h3>
                            <p class="tags">'. $row["atributo_nombre"] .'</p>
                        </div>
                        <div class="cantidad">
                            <p>Precio unit.: $'. $row["precio_unitario"] .'</p>
                            <p>Cantidad: '. $row["cantidad"] .'</p>
                        </div>
                        <div class="precio_item">
                            $'. intval($row["precio_unitario"]) * intval($row["cantidad"]) .'
                        </div>
                    </div>
                </li>
                    ');
                }
                
                ?>
                
            </ul>
            <div class="section envio">
                <h2 class="header">Datos de envio</h2>
                <p class="seleccionaste">Seleccionó: <b><?php if($pedido["envio"] == 1){ echo("Envio a domicilio"); }else{ echo("Retiro en local");}?> </b></p>
                <div class="info-envio">
                    <h3>Datos de envio:</h3>
                    <div class="row">
                        <b>Nombre:</b>
                        <p><?php echo($pedido["envio_nombre"]); ?></p>
                    </div>
                    <div class="row">
                        <b>Direccion:</b>
                        <p><?php echo($pedido["envio_direccion"]); ?></p>
                    </div>
                    <div class="row">
                        <b>DNI:</b>
                        <p><?php echo($pedido["envio_dni"]); ?></p>
                    </div>
                    <div class="row">
                        <b>Telefono:</b>
                        <p><?php echo($pedido["envio_telefono"]); ?></p>
                    </div>
                </div>
            </div>
            <div class="section pago">
                <h2 class="header">Datos de pago</h2>
                <div class="info-pago">
                    <p><b>Total:</b> $<?php echo($pedido["importe"]); ?> </p>
                    <p> <b>Titular:</b> <?php echo($pedido["pago_titular"]); ?></p>
                    <b> Datos de la tarjeta: </b>
                    <div class="datos-tarjeta">
                        <p><b>Numero: </b> <?php echo($pedido["pago_tarjeta"]); ?></p>
                        <p><b>Fecha: </b> <?php echo($pedido["pago_expiracion"]); ?></p>
                        <p><b>CVC: </b> <?php echo($pedido["pago_cvc"]); ?></p>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <script src="../../assets/js/adminordersdetails.js"></script>
    <script src="../../assets/js/generaladmin.js"></script>
    <script>
        function confirmar(confirmacion){
    // modal.style.display = "block";
    // accion = "confirmar"
    // textoModal.innerHTML = accion
    // if(!confirmacion)
    //     return
    // borrarBotones()
    // pendiente.innerHTML = "Aprobado"
    // pendiente.className = "state success"
    window.location.replace("action.php?id=<?php echo($pedido["id"]); ?>&option=1");
    }

    function rechazar(confirmacion){
    // modal.style.display = "block";
    // accion = "rechazar"
    // textoModal.innerHTML = accion
    // if (!confirmacion)
    //     return
    // borrarBotones()
    // pendiente.innerHTML = "Rechazado"
    // pendiente.className = "state cancel"
    window.location.replace("action.php?id=<?php echo($pedido["id"]); ?>&option=2");
    }
    </script>
</body>

</html>