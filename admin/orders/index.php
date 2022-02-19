<?php
include_once('../../onlyadmin.php'); 
include_once('../../db.php'); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="../../assets/css/general_admin.css">
    <link rel="stylesheet" href="../../assets/css/adminproduct.css">
    <link rel="stylesheet" href="../../assets/css/adminorders.css">
</head>

<body>

    <header>
        <div class="container">
            <div class="logo-container">
                <img src="../../assets/img/logo.png" alt="" class="logo"> - Admin
                <img src="../../assets/svg/bars-solid.svg" width="25" class="bars" onclick="toggleHamburguesa()">
            </div>
            <div class="links">
                <a href="../banner/index.php" class="link">Banner</a>
                <a href="../users/index.php" class="link">Usuarios</a>
                <a href="../product/index.php" class="link">Productos</a>
                <a href="../category/index.php" class="link">Categorias</a>
                <a href="../orders/index.php" class="link">Pedidos</a>
                <a href="../../logout.php" class="link logout">Log-Out</a>
            </div>
        </div>
    </header>

    <section class="list">
        <div class="container">
            <h1>Pedidos</h1>
            <div class="mobile-scroll">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Usuario</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                         $conn = conectarBD();
                         $query = 'SELECT pedidos.*,count(pedidos_producto.id) as cant_prod 
                         FROM `pedidos` 
                         LEFT JOIN pedidos_producto 
                         ON(pedidos_producto.id_pedido = pedidos.id) 
                         GROUP BY (pedidos.id)
                         ORDER BY fecha desc
                         ';
                         $respuesta = consultaSQL($conn, $query);
                        
                         if ($respuesta->num_rows > 0) {
                             while ($row = $respuesta->fetch_assoc()) {
                                switch($row["id_estado"])
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


                                 echo ('<tr>
                                <td>#'.$row["id"].'</td>
                                <td>'.$row["id_usuario"].'</td>
                                <td>'.$row["cant_prod"].'</td>
                                <td>'.$row["fecha"].'</td>
                                <td><span class="state '.$aEstado[1].'">'.$aEstado[0].'</span></td>
                                <td><a href="details.php?id='.$row["id"].'" class="btn-admin">Revisar</a></td>
                                 </tr>');
                             }
                         }
                         desconectarBD($conn);

                    ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </section>





    <script src="../../assets/js/generaladmin.js"></script>
</body>

</html>