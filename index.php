<?php
include('db.php');
session_start();

$conn2 = conectarBD();
$query = 'SELECT * FROM banner;';
$result = consultaSQL($conn2,$query);
while($row = $result->fetch_assoc())
{   
    $banner_img = $row['imagen'];
    $banner_link = $row['link'];
}
desconectarBD($conn2);
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
            <a href="<?php echo $banner_link; ?>" target="_blank">
                <img class="img-banner" src="<?php echo $banner_img; ?>" alt="">
            </a>
        </div>
    </section>
    <section class="top-products">
        <div class="container">
            <h2 class="title">Grandes ofertas</h2>
            <div class="items">
                <?php 
                    $conn = conectarBD();
                    $query = 'SELECT producto.nombre as nom_prod, producto.precio as precio, producto.id as id, categoria.nombre as nom_cat, (SELECT imagen FROM producto_imagenes WHERE id_producto = producto.id LIMIT 1) as url_img, producto.descuento as descuento
                    FROM producto 
                    JOIN categoria ON categoria.id = producto.id_categoria
                    WHERE descuento > 0 AND stock > 0';
                    $result = consultaSQL($conn,$query);
                    $id="";
                    while ($producto = $result->fetch_assoc()){
                        if ($producto['id']!=$id){
                            $precioFinal = $producto['precio'] - $producto['precio']*($producto['descuento']/100);
                            
                        ?>
                            <div class="item">
                                <img class="product-image" src=<?php echo $producto['url_img'] ?> alt="">
                                <div class="content">
                                    <p class="category"><?php echo $producto['nom_cat']?></p>
                                    <h5 class="name"><?php echo $producto['nom_prod']?></h5>
                                    <p class="price"><span class="old">$<?php echo $producto['precio']?></span> <span class="new">$<?php echo number_format($precioFinal,2)?></span></p>
                                    <a href="product.php?id=<?php echo strval($producto["id"]) ?>" class="btn-product">Ver producto</a>
                                </div>
                                <div class="discount"><?php echo intval($producto['descuento'])?>% OFF!</div>
                            </div>

                    <?php $id = $producto['id'];
                            }
                        } ?>
            </div>

        </div>
    </section>
    <section class="top-products">
        <div class="container">
            <h2 class="title">Todos los productos</h2>

            <div class="items">
                <?php 
                    $conn = conectarBD();
                    $query = 'SELECT producto.*, categoria.nombre as nombre_categoria FROM producto JOIN categoria ON producto.id_categoria = categoria.id WHERE stock > 0 LIMIT 12';
                    $result = consultaSQL($conn,$query);
                    while ($producto = mysqli_fetch_assoc($result)){
                        $id_producto = $producto["id"];
                        $query = "SELECT imagen FROM producto_imagenes WHERE id_producto = $id_producto LIMIT 1";
                        $result_img = consultaSQL($conn,$query);
                        $imagen = $result_img->fetch_assoc();
                        $precioFinal = $producto['precio'] - $producto['precio']*($producto['descuento']/100);
                        if ($producto['stock'] > 0){
                        if ($producto['descuento'] == 0){
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
                        else {
                            echo('
                            <div class="item">
                            <img class="product-image" src="' . $imagen["imagen"] . '" alt="">
                            <div class="content">
                                <p class="category">' . $producto["nombre_categoria"] . '</p>
                                <h5 class="name">' . $producto["nombre"] . '</h5>
                                <p class="price"><span class="old">$'.$producto['precio'].'</span><span class="new">$ '. number_format($precioFinal, 2) .'</span></p>
                                <a href="product.php?id='. $producto["id"] .'" class="btn-product">Ver producto</a>
                            </div>
                            <div class="discount">'.intval($producto['descuento']).'% OFF!</div>
                        </div>
                            ');
                        }
                    }
                        
                    }
                ?>

            </div>

        </div>
    </section>

    <?php include('template/footer.php'); ?>


    <script src="./assets/js/generalfront.js"></script>
</body>

</html>