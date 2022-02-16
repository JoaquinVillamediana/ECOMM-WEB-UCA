<?php
include_once('../../onlyadmin.php');
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
            <h1 class="text-center my-1">Revisar orden #123</h1>
            <div class="estado">
                <p>Estado del pedido: </p> <span class="state pending" id="pendiente">Pendiente</span> <br>
                <div id="botones">
                    <button type="button" class="btn btn-success" onclick="confirmar()">Confirmar</button>
                    <button type="button" class="btn btn-cancel" onclick="rechazar()">Rechazar</button>
                </div>
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
                <li>
                    <img src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="info">
                        <div class="descripcion">
                            <p class="id">#123</p>
                            <h3>Titulo del producto</h3>
                            <p class="tags">Color: azul</p>
                        </div>
                        <div class="cantidad">
                            <p>Precio unit.: $1500.00</p>
                            <p>Cantidad: 5</p>
                        </div>
                        <div class="precio_item">
                            $1500.00
                        </div>
                    </div>
                </li>
                <li>
                    <img src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="info">
                        <div class="descripcion">
                            <p class="id">#123</p>
                            <h3>Titulo del producto</h3>
                            <p class="tags">Color: azul</p>
                        </div>
                        <div class="cantidad">
                            <p>Precio unit.: $1500.00</p>
                            <p>Cantidad: 5</p>
                        </div>
                        <div class="precio_item">
                            $1500.00
                        </div>
                    </div>
                </li>
            </ul>
            <div class="section envio">
                <h2 class="header">Datos de envio</h2>
                <p class="seleccionaste">Seleccionó: <b>Envio a domicilio</b></p>
                <div class="info-envio">
                    <h3>Datos de envio:</h3>
                    <div class="row">
                        <b>Nombre:</b>
                        <p>Rodrigo Dueñas</p>
                    </div>
                    <div class="row">
                        <b>Direccion:</b>
                        <p>Sara Sofía 59847 Hernandes del mirador</p>
                    </div>
                    <div class="row">
                        <b>DNI:</b>
                        <p>35585339</p>
                    </div>
                    <div class="row">
                        <b>Telefono:</b>
                        <p>+54 9 11-3133-5455</p>
                    </div>
                </div>
            </div>
            <div class="section pago">
                <h2 class="header">Datos de pago</h2>
                <div class="info-pago">
                    <p><b>Total:</b> $4,500.00 </p>
                    <p> <b>Titular:</b> Rodrigo Dueñas</p>
                    <b> Datos de la tarjeta: </b>
                    <div class="datos-tarjeta">
                        <p><b>Numero: </b> 4567-4568-4568-9876</p>
                        <p><b>Fecha: </b> 11/22</p>
                        <p><b>CVC: </b> 123</p>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <script src="../../assets/js/adminordersdetails.js"></script>
    <script src="../../assets/js/generaladmin.js"></script>
</body>

</html>