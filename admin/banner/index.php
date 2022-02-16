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
    <link rel="stylesheet" href="../../assets/css/banner.css">
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

    <section class="info">
        <div class="container">
            <h1>Banner</h1>
            <h2 class="title">Banner Actual</h2>
            <img class="current-banner" src="https://www.softub.ch/wp-content/uploads/Black-Friday-Sale.jpg" alt="">
            <h2 class="title">Actualizar Banner</h2>
            <form action="">
                <input class="" name="image" id="image" type="file">
                <label for="">Enlace <i>Opcional</i></label>
                <input type="text" name="link" minlength="3" maxlength="60">
                <button type="button" onclick="validateInput()">Guardar</button>
            </form>
        </div>
    </section>


    <script src="../../assets/js/generaladmin.js"></script>
    <script src="../../assets/js/adminbanner.js"></script>
</body>


</html>