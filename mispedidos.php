<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/mispedidos.css">
</head>

<body>

    <?php include('template/navbar.php');?>

    <h1>Mis pedidos</h1>

    <section class="container orders">
        <?php 
            include_once("db.php");
            include_once("onlyclientes.php");
            $id_usuario = $_SESSION["userid"];
            $conn = conectarBD();
            $query = "SELECT fecha, pedidos.id as id, envio_direccion, estados.nombre as estado_nombre
                      FROM pedidos
                      JOIN estados ON id_estado = estados.id
                      WHERE id_usuario = $id_usuario";
            $result = consultaSQL($conn, $query);
            while($pedido = $result->fetch_assoc()){
                echo('
                <div class="item">
                    <p class="date">'.$pedido["fecha"].'</p>
                    <p class="status pending">'.$pedido["estado_nombre"].'</p>
                    <h5 class="order">#'.$pedido["id"].'</h5>
                    <p class="address">'.$pedido["envio_direccion"].'</p>
                    <a href="./pedido.php?id='.$pedido["id"].'" class="more">Ver mas</a>
                </div>
                ');
            }
            desconectarBD($conn);  
        ?>  


    </section>
    <script src="./assets/js/generalfront.js"></script>
</body>

</html>