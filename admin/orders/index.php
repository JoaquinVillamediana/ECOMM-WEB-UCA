<?php
include_once('../../onlyadmin.php');
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
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#23</td>
                            <td>1</td>
                            <td>Pelota adidas ADX40</td>
                            <td>2</td>
                            <td>06/04/2021 14:34:21</td>
                            <td><span class="state pending">Pago Pendiente</span></td>
                            <td><a href="details.html" class="btn-admin">Revisar</a></td>
                        </tr>
                        <tr>
                            <td>#23</td>
                            <td>1</td>
                            <td>Pelota adidas ADX40</td>
                            <td>2</td>
                            <td>06/04/2021 14:34:21</td>
                            <td><span class="state success">Pago Exitoso</span></td>
                            <td><a href="details.html" class="btn-admin">Revisar</a></td>
                        </tr>
                        <tr>
                            <td>#23</td>
                            <td>1</td>
                            <td>Pelota adidas ADX40</td>
                            <td>2</td>
                            <td>06/04/2021 14:34:21</td>
                            <td><span class="state pending">Pago Pendiente</span></td>
                            <td><a href="details.html" class="btn-admin">Revisar</a></td>
                        </tr>
                        <tr>
                            <td>#23</td>
                            <td>1</td>
                            <td>Pelota adidas ADX40</td>
                            <td>2</td>
                            <td>06/04/2021 14:34:21</td>
                            <td><span class="state cancel">Pago Cancelado</span></td>
                            <td><a href="details.html" class="btn-admin">Revisar</a></td>
                        </tr>
                        <tr>
                            <td>#23</td>
                            <td>1</td>
                            <td>Pelota adidas ADX40</td>
                            <td>2</td>
                            <td>06/04/2021 14:34:21</td>
                            <td><span class="state pending">Pago Pendiente</span></td>
                            <td><a href="details.html" class="btn-admin">Revisar</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>





    <script src="../../assets/js/generaladmin.js"></script>
</body>

</html>