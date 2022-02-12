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

    <?php include('template/navbar.php');?>
    
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
                <?php 
                    include('db.php');
                    $conn = conectarBD();
                    $query = 'select * from producto';
                    $result = consultaSQL($conn,$query);
                    while ($producto = $result->fetch_assoc()){
                        if ($producto['descuento'] != NULL){
                            ?>
                                <div class="item">
                                    <img class="product-image" src="./assets/img/remera-futbol-hombre-adidas-visitante-colombia-a-fi5295-4.jpg" alt="">
                                    <div class="content">
                                        <p class="category">Camisetas</p>
                                        <h5 class="name"><?php echo $producto['nombre']?></h5>
                                        <p class="price"><span class="old">$<?php echo $producto['precio']?></span> <span class="new">$<?php echo $producto['descuento']?></span></p>
                                        <a href="product.php" class="btn-product">Ver producto</a>
                                    </div>
                                    <div class="discount">30% OFF</div>
                                </div>

                        <?php }
                    } ?>
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
                        <a href="product.php" class="btn-product">Ver producto</a>
                    </div>
                    <div class="discount">30% OFF</div>
                </div>

                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price">$400.00</p>
                        <a href="product.php" class="btn-product">Ver producto</a>
                    </div>
                </div>
                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price">$400.00</p>
                        <a href="product.php" class="btn-product">Ver producto</a>
                    </div>
                </div>
                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price">$400.00</p>
                        <a href="product.php" class="btn-product">Ver producto</a>
                    </div>
                </div>
                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price">$400.00</p>
                        <a href="product.php" class="btn-product">Ver producto</a>
                    </div>
                </div>
                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price">$400.00</p>
                        <a href="product.php" class="btn-product">Ver producto</a>
                    </div>
                </div>
                <div class="item">
                    <img class="product-image" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/016d4521d4934e588340ab0400be130f_9366/Pelota_de_futbol_playa_Uniforia_Pro_(UNISEX)_Turquesa_FH7347_01_standard.jpg" alt="">
                    <div class="content">
                        <p class="category">Pelotas</p>
                        <h5 class="name">Pelota adidas ADX40</h5>
                        <p class="price">$400.00</p>
                        <a href="product.php" class="btn-product">Ver producto</a>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <?php include('template/footer.php'); ?>


    <script src="./assets/js/generalfront.js"></script>
</body>

</html>