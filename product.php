<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/product.css">
    <script src="./assets/js/product.js"></script>
</head>

<body>

    <?php include('template/navbar.php');?>

    <div class="main-container">
        <div class="images">
            <img id="images" src="assets/img/pelota1.jpeg" alt="" class="slider-image">
        </div>
        <div id="dots" class="btns-img">
            <span class="dot dot-active" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>
    <div class="main-container">
        <p class="category">Pelotas</p>
        <h1 class="name">Pelota Turquesa FH7347</h1>
        <p class="info-item"><b>ID Producto:</b> #342</p>

        <div class="botones" id="talles">
            <button class="btn-talle active" onclick="btnseleccionado(0)">Azul</button>
            <button class="btn-talle" onclick="btnseleccionado(1)">Arg</button>
            <button class="btn-talle" onclick="btnseleccionado(2)">Blanca</button>

        </div>

        <p class="price">$400.00</p>

        <div class="botones">
            <a href="carrito.html" class="btn-carrito">AGREGAR AL CARRITO</a>
        </div>

    </div>
    <div class="main-container">
        <div class="detalles">
            <h4>DETALLES</h4>
            <p>Pelota de Fútbol futsal GOL DE ORO STAR | Nº4 Material: cuero sintetico vulcanizado Color:naranja, blanco, amarillo peso reglamentario: 400gr Tamaño:nº4 gajos pegados tipo de pique: medio pique circunferencia: 65 cm</p>
        </div>
    </div>

    

    <script src="./assets/js/generalfront.js"></script>

</body>

</html>