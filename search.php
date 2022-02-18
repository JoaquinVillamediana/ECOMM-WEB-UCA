<?php
session_start();
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/search.css">
</head>

<body>
    <?php include('template/navbar.php');?>

    <section class="products">
        <div class="container">
            <h2 class="title">Buscador</h2>
            <form class="searcher" id="seachForm" action="search.php" method="GET">
                <div class="content">
                    <label for="">Nombre</label>
                    <input class="product-name" id="product-name" name="nombre" type="text" placeholder="Nombre:">
                    <label for="">Categoria</label>
                    <select name="categoria" id="">
                        <option selected value="">Cualquiera</option>
                        <?php 

                        $conn = conectarBD();
                        $query = 'SELECT * FROM categoria';
                        $result = consultaSQL($conn,$query);
                        while($row = $result->fetch_assoc()){
                            echo('<option value="'. $row["id"] .'">'. $row["nombre"] .'</option>');
                        }
                        
                        ?>

                    </select>
                    <button type="submit" onclick="validateForm()">Buscar!</button>
                </div>
            </form>
            <div class="items">

                <?php 
                    if(empty($_GET["nombre"]) && empty($_GET["categoria"]))
                    {
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
                            $precioFinal = $producto['precio'] - $producto['precio']*($producto['descuento']/100);
                            
                        ?>
                            <div class="item">
                                <img class="product-image" src=<?php echo $producto['url_img'] ?> alt="">
                                <div class="content">
                                    <p class="category"><?php echo $producto['nom_cat']?></p>
                                    <h5 class="name"><?php echo $producto['nom_prod']?></h5>
                                    <p class="price"><span class="old">$<?php echo $producto['precio']?></span> <span class="new">$<?php echo $producto['precioFinal']?></span></p>
                                    <a href="product.php?id=<?php echo strval($producto["id"]) ?>" class="btn-product">Ver producto</a>
                                </div>
                                <?php if ($producto['descuento'] > 0){?>
                                    <div class="discount"><?php echo intval($producto['descuento'])?>% OFF!</div>
                                <?php } ?>
                                
                            </div>

                    <?php $id = $producto['id'];
                            }
                        } 
                    }else{
                        $conn = conectarBD();
                        $query = 'SELECT categoria.nombre as nom_cat, producto.nombre as nom_prod, producto.precio as precio, producto.id as id, 
                        producto_imagenes.imagen as url_img, producto.descuento as descuento from producto 
                        INNER JOIN categoria ON producto.id_categoria=categoria.id
                        INNER JOIN producto_imagenes ON producto.id=producto_imagenes.id_producto 
                        WHERE producto.nombre LIKE "%'.$_GET["nombre"].'%"      
                        ';
                        if(!empty($_GET["categoria"]))
                        {
                            $query .= 'AND categoria.id='. $_GET["categoria"];
                        }

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
                                    <?php if($porcentaje != 100){?>
                                    <p class="price"><span class="old">$<?php echo $producto['precio']?></span> <span class="new">$<?php echo $producto['descuento']?></span></p>
                                    <?php }else{ ?>
                                        <p class="price">$<?php echo $producto['precio']?></p>
                                    <?php }?>
                                    <a href="product.php?id=<?php echo strval($producto["id"]) ?>" class="btn-product">Ver producto</a>
                                </div>
                                <?php if($porcentaje != 100){?>
                                <div class="discount"><?php echo intval($porcentaje)?>% OFF!</div>
                                <?php } ?>
                            </div>

                        <?php $id = $producto['id'];
                            }
                        }
                         if($result->num_rows < 1)
                         {
                             echo('<div style="text-align: center;width:100%"><h2 style="margin: auto;"  class="title">Su busqueda no tuvo resultados</h2></div>');
                         }
                        
                    }
                    ?>
                
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


</body>
<script src="./assets/js/search.js"></script>
<script src="./assets/js/generalfront.js"></script>

</html>