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
            <h1>Categorias</h1>
            <a href="create.html" class="btn-create">Crear</a>
            <div class="mobile-scroll">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Pelotas</td>
                            <td><a href="edit.html" class="btn-admin">Editar</a></td>
                            <td><a href="" class="btn-admin red">Eliminar</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Remeras</td>
                            <td><a href="edit.html" class="btn-admin">Editar</a></td>
                            <td><a href="" class="btn-admin red">Eliminar</a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Pantalones</td>
                            <td><a href="edit.html" class="btn-admin">Editar</a></td>
                            <td><a href="" class="btn-admin red">Eliminar</a></td>
                        </tr>
                        <!-- and so on... -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>





    <script src="../../assets/js/generaladmin.js"></script>
</body>

</html>