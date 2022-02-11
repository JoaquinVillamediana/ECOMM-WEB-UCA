<?php
session_start();
if (!empty($_SESSION["user"])) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/register.css">
</head>

<body>

    <header>
        <div class="container">
            <div class="imgs">
                <img src="./assets/img/logo.png" alt="" class="logo">
                <img src="assets/svg/bars-solid.svg" width="25" class="bars" onclick="toggleHamburguesa()">
            </div>
            <div class="links">
                <a href="index.php" class="link">Home</a>
                <a href="search.php" class="link">Buscador</a>
                <?php if (!empty($_SESSION['user'])) { ?>
                    <a href="carrito.php" class="link">Carrito</a>
                    <a href="mispedidos.php" class="link">Mis Pedidos</a>
                    <a href="logout.php" class="link logout">Salir</a>
                <?php } else { ?>
                    <a href="login.php" class="link logout">Ingresar</a>
                <?php } ?>
            </div>
        </div>
    </header>

    <div class="container main-container">
        <div class="box">
            <h1>Registro</h1>
            <form action="">
                <div id="name">
                    <label for="">Nombre y apellido</label>
                    <input type="text" name="name">
                    <span class="error">Campo obligatorio. (min 3 car. max 60 car.)</span>
                </div>

                <div id="email">
                    <label for="">Email</label>
                    <input type="email" name="email">
                    <span class="error">Email invalido.</span>
                </div>

                <div id="password">
                    <label for="">Contraseña</label>
                    <input type="password" name="password">
                    <span class="error">Campo obligatorio. (min 8 car. max 60 car.)</span>
                </div>

                <div id="password_confirm">
                    <label for="">Confirmar contraseña</label>
                    <input type="password" name="confirm_password">
                    <span class="error">Las contraseñas deben coincidir.</span>
                </div>

                <a class="register" href="login.php">Ya tenes cuenta? Ingresa!</a>
                <button type="submit" onclick="validateFields()">Registrarse</button>
            </form>
        </div>
    </div>



</body>

<script src="./assets/js/register.js"></script>
<script src="./assets/js/generalfront.js"></script>

</html>