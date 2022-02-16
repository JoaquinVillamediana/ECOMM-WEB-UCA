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
            <h2 class="header">Resumen del pedido #421</h2>
            <div class="resumen section header">
                <h2 class="header">Gracias por comprar en nuestra tienda</h2>
                <p>Tu numero de pedido es: 421</p>
                <p class="small">Durante las proximas horas te estaremos contactando via mail para actualizarte el estado del pedido</p>
                <p class="small">Estado del pedido: <span class="yellow">pendiente</span></p>
            </div>
            <div class="resumen section productos">
                <h2 class="header">Productos:</h2>
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
            </div>
            <div class="section envio">
                <h2 class="header">Datos de envio</h2>
                <p class="seleccionaste">Seleccionaste: <b>Envio a domicilio</b></p>
                <div class="info-envio">
                    <h3>Datos:</h3>
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
                    <p>Total: <b>$4,500.00</b> </p>
                    <p>Abonado con la tarjeta terminada en 4578 </p>
                    <p>Titular: Rodrigo Dueñas</p>
                </div>
            </div>
        </section>
    </main>

    <script src="./assets/js/carritoenvio.js"></script>
</body>

</html>