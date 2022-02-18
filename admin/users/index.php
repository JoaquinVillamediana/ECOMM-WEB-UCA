<?php
include_once('../../onlyadmin.php');
include_once('../../db.php');

if ($_POST && !empty($_POST['user_id'])) {
    $conn = conectarBD();
    $query = 'DELETE FROM carrito_productos WHERE id_carrito = (SELECT id FROM carrito WHERE id_usuario = ' . $_POST['user_id'] . ' LIMIT 1);';
    consultaSQL($conn, $query);
    $query = 'DELETE FROM carrito WHERE id_usuario = ' . $_POST['user_id'] . ';';
    consultaSQL($conn, $query);
    $query = 'DELETE FROM usuarios WHERE id = ' . $_POST['user_id'] . ';';
    consultaSQL($conn, $query);
    desconectarBD($conn);
}

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
            <h1>Usuarios</h1>
            <div class="mobile-scroll">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $conn = conectarBD();
                        $query = 'SELECT * FROM usuarios';
                        $respuesta = consultaSQL($conn, $query);

                        if ($respuesta->num_rows > 0) {
                            while ($row = $respuesta->fetch_assoc()) {

                                if ($row["usertype"] == 1) {
                                    $type = "Admin";
                                } elseif ($row["usertype"] == 2) {
                                    $type = "Cliente";
                                }


                                echo ('<tr>
                                <td>' . $row["id"] . '</td>
                                <td>' . $row["nombre"] . '</td>
                                <td>' . $row["email"] . '</td>
                                <td>' . $type . '</td>
                                <td><form action="" method="POST">
                                <input type="hidden" name="user_id" value="' . $row["id"] . '">
                                <button type="submit" class="btn-admin red">Eliminar</button></form></td>
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