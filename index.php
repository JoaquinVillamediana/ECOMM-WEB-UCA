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
                    $query = 'SELECT categoria.nombre as nom_cat, producto.nombre as nom_prod, producto.precio as precio, producto.id as id, 
                    producto_imagenes.imagen as url_img, producto.descuento as descuento from producto 
                    INNER JOIN categoria ON producto.id_categoria=categoria.id
                    INNER JOIN producto_imagenes ON producto.id=producto_imagenes.id_producto 
                    WHERE descuento IS NOT NULL';;
                    $result = consultaSQL($conn,$query);
                    $id="";
                    while ($producto = $result->fetch_assoc()){
                        if ($producto['id']!=$id){
                            $porcentaje = (($producto['precio']-$producto['descuento'])*100)/$producto['precio'];
                        ?>
                            <div class="item">
                                <img class="product-image" src=<?php echo $producto['url_img'] ?> alt="">
                                <div class="content">
                                    <p class="category"><?php echo $producto['nom_cat']?></p>
                                    <h5 class="name"><?php echo $producto['nom_prod']?></h5>
                                    <p class="price"><span class="old">$<?php echo $producto['precio']?></span> <span class="new">$<?php echo $producto['descuento']?></span></p>
                                    <a href="product.php?id=<?php echo strval($producto["id"]) ?>" class="btn-product">Ver producto</a>
                                </div>
                                <div class="discount"><?php echo intval($porcentaje)?>% OFF!</div>
                            </div>

                    <?php $id = $producto['id'];
                            }
                        } ?>
            </div>

        </div>
    </section>
    <section class="top-products">
        <div class="container">
            <h2 class="title">Productos</h2>

            <div class="items">
                <?php 
                    $conn = conectarBD();
                    $query = 'SELECT producto.*, categoria.nombre as nombre_categoria FROM producto JOIN categoria ON producto.id_categoria = categoria.id LIMIT 12';
                    $result = consultaSQL($conn,$query);
                    while ($producto = mysqli_fetch_assoc($result)){
                        $id_producto = $producto["id"];
                        $query = "SELECT imagen FROM producto_imagenes WHERE id_producto = $id_producto LIMIT 1";
                        $result_img = consultaSQL($conn,$query);
                        $imagen = $result_img->fetch_assoc();
                        echo('
                        <div class="item">
                                <img class="product-image" src="' . $imagen["imagen"] . '" alt="">
                                <div class="content">
                                    <p class="category">' . $producto["nombre_categoria"] . '</p>
                                    <h5 class="name">' . $producto["nombre"] . '</h5>
                                    <p class="price"><span class="new">$ '. number_format($producto["precio"], 2) .'</span></p>
                                    <a href="product.php?id='. $producto["id"] .'" class="btn-product">Ver producto</a>
                                </div>
                            </div>
                        ');
                    }
                ?>

            </div>

        </div>
    </section>

    <?php include('template/footer.php'); ?>


    <script src="./assets/js/generalfront.js"></script>
</body>

</html>