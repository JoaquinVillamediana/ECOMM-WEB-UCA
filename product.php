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
        // le digo a javascript que id de producto comprar
        echo '<script>id_producto='.$id_producto.'</script>';
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
            
            $query = "SELECT id, nombre FROM producto_atributo WHERE id_producto = $id_producto";
            $result2 = consultaSQL($conn,$query);
            $atributos = $result2->fetch_all();
            
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
            ');
            if($atributos && count($atributos) > 0){
                // dejo seleccionado el primer atributo
                echo '<script>id_atributo_elegido='.$atributos[0][0].'</script>';
                echo('<div class="botones" id="talles">');
                foreach (range(0, count($atributos) - 1) as $numero) {
                    $active = $numero == 0 ? " active" : "";
                    $atributo = $atributos[$numero][1];
                    echo('<button class="btn-talle'.$active.'" onclick="btnseleccionado('.$numero.', '.$atributos[$numero][0].')">'.$atributo.'</button>');
                }  
                echo('</div>');
            }
            echo('
                <p class="price">$ '.number_format($producto["precio"], 2).' </p>

                <div class="botones">
                    <a onclick="agregarProducto()" class="btn-carrito">AGREGAR AL CARRITO</a>
                </div>
                <div class="alerta d-none" id="alerta">
                    Agregado correctamente al carrito
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