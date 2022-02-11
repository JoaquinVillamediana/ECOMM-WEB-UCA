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
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>

    <header>
        <div class="container">
            <div class="imgs">
                <img src="./assets/img/logo.png" alt="" class="logo">
                <img src="assets/svg/bars-solid.svg" width="25" class="bars" onclick="toggleHamburguesa()">
            </div>
            <div class="links">
                <a href="index.php" class="link">Home</a>
                <a href="search.php" class="link">Buscador</a>
                <?php if (!empty($_SESSION['user'])) { ?>
                    <a href="carrito.php" class="link">Carrito</a>
                    <a href="mispedidos.php" class="link">Mis Pedidos</a>
                    <a href="logout.php" class="link logout">Salir</a>
                <?php } else { ?>
                    <a href="login.php" class="link logout">Ingresar</a>
                <?php } ?>
            </div>
        </div>
    </header>

    <section class="banner">
        <div class="container">
            <a href="">
                <img class="img-banner" src="https://www.softub.ch/wp-content/uploads/Black-Friday-Sale.jpg" alt="">
            </a>
        </div>
    </section>
    <section class="top-products">
        <div class="container">
            <h2 class="title">Grandes ofertas</h2>

            <div class="items">
                <div class="item">
                    <img class="product-image" src="./assets/img/remera-futbol-hombre-adidas-visitante-colombia-a-fi5295-4.jpg" alt="">
                    <div class="content">
                        <p class="category">Camisetas</p>
                        <h5 class="name">Remera Seleccion Colombia</h5>
                        <p class="price"><span class="old">$400.00</span> <span class="new">$280.00</span></p>
                        <a href="product.html" class="btn-product">Ver producto</a>
                    </div>
                    <div class="discount">30% OFF</div>
                </div>

                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price"><span class="old">$400.00</span> <span class="new">$200.00</span></p>
                        <a href="product.html" class="btn-product">Ver producto</a>
                    </div>
                    <div class="discount">50% OFF</div>
                </div>

                <div class="item">
                    <img class="product-image" src="https://solodeportes-9bvc3m9qgmf6g9x.stackpathdns.com/media/catalog/product/cache/faae2c37ab1d315e4b697a7f62b421b7/s/h/short-de-argentina-adidas-alternativo-blanco-100020fl9019001-1.jpg" alt="">
                    <div class="content">
                        <p class="category">Pantalones</p>
                        <h5 class="name">Short seleccion argentina</h5>
                        <p class="price"><span class="old">$400.00</span> <span class="new">$312.00</span></p>
                        <a href="product.html" class="btn-product">Ver producto</a>
                    </div>
                    <div class="discount">22% OFF</div>
                </div>


            </div>

        </div>
    </section>
    <section class="top-products">
        <div class="container">
            <h2 class="title">Productos destacados</h2>

            <div class="items">
                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price"><span class="old">$400.00</span> <span class="new">$280.00</span></p>
                        <a href="product.html" class="btn-product">Ver producto</a>
                    </div>
                    <div class="discount">30% OFF</div>
                </div>

                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price">$400.00</p>
                        <a href="product.html" class="btn-product">Ver producto</a>
                    </div>
                </div>
                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price">$400.00</p>
                        <a href="product.html" class="btn-product">Ver producto</a>
                    </div>
                </div>
                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price">$400.00</p>
                        <a href="product.html" class="btn-product">Ver producto</a>
                    </div>
                </div>
                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price">$400.00</p>
                        <a href="product.html" class="btn-product">Ver producto</a>
                    </div>
                </div>
                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price">$400.00</p>
                        <a href="product.html" class="btn-product">Ver producto</a>
                    </div>
                </div>
                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price">$400.00</p>
                        <a href="product.html" class="btn-product">Ver producto</a>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <footer>
        <p class="company">E-Commerce © 2021</p>
        <a class="link" href="index.html">Home</a>
        <a class="link" href="register.html">Registro</a>
        <a class="link" href="search.html">Buscar Producto</a>
        <a class="link" href="carrito.html">Carrito</a>
    </footer>


    <script src="./assets/js/generalfront.js"></script>
</body>

</html>