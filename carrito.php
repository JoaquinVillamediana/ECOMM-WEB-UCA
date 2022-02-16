<?php
function traer_carrito($email_usuario, $conn){
    // Me fijo si existe el carrito
    $query = "SELECT carrito.*, usuarios.email, (SELECT SUM((cantidad * producto.precio)) as subtotal FROM carrito_productos JOIN producto ON producto.id = carrito_productos.id_producto WHERE id_carrito = carrito.id) as subtotal
                FROM carrito 
                JOIN usuarios ON carrito.id_usuario = usuarios.id 
                WHERE usuarios.email = '$email_usuario'";
    $res = consultaSQL($conn, $query);
    return $res;
}

function traer_carrito_productos($id_carrito, $conn){
    // Me fijo si existe el carrito
    $query = "SELECT carrito_productos.*, producto.nombre as titulo, producto.precio as precio, (SELECT imagen FROM producto_imagenes WHERE id_producto = carrito_productos.id_producto LIMIT 1) as src, producto_atributo.nombre as atributo
              FROM carrito_productos
              JOIN producto ON carrito_productos.id_producto = producto.id
              JOIN producto_atributo ON producto_atributo.id = carrito_productos.id_atributo
              WHERE id_carrito = $id_carrito";
    $res = consultaSQL($conn, $query);
    return $res;
}

include_once("onlyclientes.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    include_once("db.php");
    $conn = conectarBD();
    if(isset($_POST["id_eliminar"])){
        // eliminar producto del carrito
        $id_eliminar = $_POST["id_eliminar"];
        $query = "DELETE FROM carrito_productos WHERE id = $id_eliminar";
        consultaSQL($conn, $query);
    }else{
        $id_producto = $_POST["id_producto"];
        $id_atributo = $_POST["id_atributo"];
        $cantidad = $_POST["cantidad"];
        $email = $_SESSION["user"];
        $result = traer_carrito($email, $conn);
        $carrito = NULL;
        // Si no existe, lo creo
        if ($result->num_rows == 0){
            $query = "INSERT INTO carrito(id_usuario, fecha)
                        VALUES((SELECT id FROM usuarios WHERE email = '$email'), CURRENT_TIMESTAMP)";
            $result2 = consultaSQL($conn, $query);
            // Y una vez creado lo traigo
            $result3 = traer_carrito($email, $conn);
            $carrito = $result3->fetch_assoc();
        }
        else{
            $carrito = $result->fetch_assoc();
        }
        if($carrito){
            $id_carrito = $carrito["id"];
            // una vez que tengo el carrito, me fijo si ya existe el mismo producto con el mismo atributo
            $query = "SELECT id 
                        FROM carrito_productos
                        WHERE id_carrito = $id_carrito AND id_producto = $id_producto AND id_atributo = $id_atributo";
            $result = consultaSQL($conn, $query);
            if($result->num_rows == 0){
                // si no existe lo agrego con la cantidad especificada
                $query = "INSERT INTO carrito_productos(id_carrito, id_producto, id_atributo, cantidad)
                        VALUES ($id_carrito, $id_producto, $id_atributo, $cantidad)";
                consultaSQL($conn, $query);
            }
            else{
                // si existe simplemente cambio la cantidad, a lo que me dieron en el post
                $query = "UPDATE carrito_productos
                            SET cantidad = $cantidad
                            WHERE id_carrito = $id_carrito AND id_producto = $id_producto AND id_atributo = $id_atributo";
                consultaSQL($conn, $query);
            }
        }
    }
}
else{
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/carrito.css">
    <script src="assets/js/carrito.js"></script>
</head>

<body>

    <header>
        <div class="container">
            <img src="./assets/img/logo.png" alt="" class="logo">
            <div class="links">
                <a href="index.html" class="link">Volver al sitio</a>
            </div>
        </div>
    </header>
    <ul class="progress_carrito">
        <li><a href="carrito.php">Mi carrito</a></li>
        <li><a>Datos</a></li>
        <li><a>Datos de pago</a></li>
    </ul>
    <main class="container carrito_resumen">
        <h2>Resumen del carrito</h2>
        <ul class="carrito_productos" id="productos">
            <?php 
                include_once("db.php");
                $conn = conectarBD();
                $carrito = traer_carrito($_SESSION["user"], $conn)->fetch_assoc();
                $carrito_productos = traer_carrito_productos($carrito["id"], $conn);
                while($carrito_producto = $carrito_productos->fetch_assoc()){
                    echo('
                        <li id="carrito_producto_'.$carrito_producto["id"].'">
                            <img src="'.$carrito_producto["src"].'" alt="">
                            <div class="info">
                                <div class="descripcion">
                                    <p class="id">#'.$carrito_producto["id_producto"].'</p>
                                    <h3>'.$carrito_producto["titulo"].'</h3>
                                    <p class="tags">'.$carrito_producto["atributo"].'</p>
                                </div>
                                <div class="cantidad">
                                    <p>Precio unit.: $'. number_format($carrito_producto["precio"], 2) .'</p>
                                    <p>Cantidad: '.$carrito_producto["cantidad"].'</p>
                                </div>
                                <div class="precio_item">
                                    $'.number_format($carrito_producto["precio"] * $carrito_producto["cantidad"], 2).'
                                    <button class="eliminar" onclick="eliminarProductoCarrito('.$carrito_producto["id"].')">X</button>
                                </div>
                            </div>
                        </li>
                    ');
                }
                echo '</ul>';
                echo '
                    <div class="subtotal">
                        <a class="secondary btn" href="index.php">Volver</a>
                        <div class="info">
                            <div class="cantidades">
                                Items totales:
                                <p>'.$carrito_productos->num_rows.' item(s)</p>
                            </div>
                            <div class="precios">
                                <span>Subtotal:</span>
                                <p>$'. number_format($carrito["subtotal"], 2) .'</p>
                            </div>
                        </div>
                        <a class="primary btn" href="carritoenvio.php">Continuar</a>
                    </div>        
                '
            ?>
            <!-- <li>
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
                        <button class="eliminar">X</button>
                    </div>
                </div>
            </li> -->
    </main>



</body>

</html>
        <?php
    }
?>