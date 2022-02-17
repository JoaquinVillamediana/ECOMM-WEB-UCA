<?php 
    include_once("onlyclientes.php");
?>
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
            $query = "SELECT fecha, pedidos.id as id,pedidos.id_estado, envio_direccion, estados.nombre as estado_nombre
                      FROM pedidos
                      JOIN estados ON id_estado = estados.id
                      WHERE id_usuario = $id_usuario";
            $result = consultaSQL($conn, $query);
            if($result->num_rows > 0){
            while($pedido = $result->fetch_assoc()){

                switch($pedido["id_estado"])
                {
                    case 1:
                        $aEstado = ["Pago Pendiente","pending"];
                        break;
                        case 2:
                            $aEstado = ["Pago Aprobado","success"];
                            break;
                            case 3:
                                $aEstado = ["Pago Cancelado","cancel"];
                                break;
                }

                echo('
                <div class="item">
                    <p class="date">'.$pedido["fecha"].'</p>
                    <p class="status '.$aEstado[1].'">'.$aEstado[0].'</p>
                    <h5 class="order">#'.$pedido["id"].'</h5>
                    <p class="address">'.$pedido["envio_direccion"].'</p>
                    <a href="./pedido.php?id='.$pedido["id"].'" class="more">Ver mas</a>
                </div>
                ');
            }
            desconectarBD($conn);  
        }else{
            echo("<p style='margin: 0 auto;'>Todavia no realizaste ningun pedido</p>");
        }
        ?>  


    </section>
    <script src="./assets/js/generalfront.js"></script>
</body>

</html>