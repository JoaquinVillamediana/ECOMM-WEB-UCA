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
    <?php 
        if(!$_GET || !$_GET["id"]){
            header("Location: index.php");
        }
        include('db.php');
        $id_producto = $_GET["id"];
        $conn = conectarBD();
        $query = "SELECT producto.*, categoria.nombre as nombre_categoria FROM producto JOIN categoria ON producto.id_categoria = categoria.id WHERE producto.id = $id_producto";
        $result = consultaSQL($conn,$query);
        $producto = $result->fetch_assoc();
        if($producto){
            $query = "SELECT imagen FROM producto_imagenes WHERE id_producto = $id_producto";
            $result = consultaSQL($conn,$query);
            $imagenes = [];
            while($imagen = $result->fetch_assoc()){
                $imagenes[] = $imagen["imagen"];
            }
            // dejo las imagenes en javascript para que despues se puedan cambiar del lado del cliente
            echo ('<script>var imagenes = '. json_encode($imagenes) .'</script>');
            
            echo('
            <div class="main-container">
                <div class="images">
                    <img id="images" src="'.$imagenes[0].'" alt="" class="slider-image">
                </div>
                <div id="dots" class="btns-img">');
                foreach (range(0, count($imagenes) - 1) as $numero) {
                    $dot_active = $numero == 0 ? " dot-active" : "";
                    echo('<span class="dot' . $dot_active . '" onclick="currentSlide(' . strval($numero + 1) . ')"></span>');
                }
            echo('</div>
            </div>
            <div class="main-container">
                <p class="category">'.$producto["nombre_categoria"].'</p>
                <h1 class="name">'.$producto["nombre"].'</h1>
                <p class="info-item"><b>ID Producto:</b> #'.$producto["id"].'</p>
                <div class="botones" id="talles">
                    <button class="btn-talle active" onclick="btnseleccionado(0)">Azul</button>
                    <button class="btn-talle" onclick="btnseleccionado(1)">Arg</button>
                    <button class="btn-talle" onclick="btnseleccionado(2)">Blanca</button>
                </div>
                <p class="price">$ '.number_format($producto["precio"], 2).' </p>

                <div class="botones">
                    <a href="carrito.html" class="btn-carrito">AGREGAR AL CARRITO</a>
                </div>

            </div>
            <div class="main-container">
                <div class="detalles">
                    <h4>DETALLES</h4>
                    <p>'.$producto["detalles"].'</p>
                </div>
            </div>
            ');
        }
        else{
            header("Location: index.php");
        }
    ?>
    <script src="./assets/js/generalfront.js"></script>

</body>

</html>