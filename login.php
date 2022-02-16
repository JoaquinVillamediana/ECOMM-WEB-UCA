<?php
include_once('onlyguest.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/login.css">
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
            <h1>Login</h1>
            <form action="" id="LoginForm" method="POST">
                <label for="">Email</label>
                <input type="text" name="email" id="email">

                <label for="">Password</label>
                <input type="password" name="password" id="password">

                <?php
                include_once('db.php');

                if ($_POST) {
                    $conn = conectarBD();
                    $query = 'SELECT * FROM usuarios WHERE email = "' . $_POST["email"] . '" and password = "' . $_POST["password"] . '";';
                    $respuesta = consultaSQL($conn, $query);

                    if ($respuesta->num_rows > 0) {
                        while ($row = $respuesta->fetch_assoc()) {
                            $_SESSION['user'] = $row['email'];
                            $_SESSION["userid"] = $row["id"];
                            $_SESSION['user_type'] = $row['usertype'];

                            desconectarBD($conn);

                            if ($_SESSION['user_type'] == 1) {
                                header('Location: ./admin/banner/index.php');
                            } else {
                                header('Location: index.php');
                            }
                        }
                    } else {
                        echo ('<span style="display:block;" class="error">Credenciales invalidas.</span>');
                    }
                    desconectarBD($conn);
                }
                ?>

                <span id="error" class="error">Credenciales invalidas.</span>
                <a class="register" href="register.php">No tenes cuenta? Creala!</a>
                <button type="submit" onclick="validateFields()">Entrar</button>
            </form>
        </div>
    </div>



</body>

<script src="./assets/js/login.js"></script>
<script src="./assets/js/generalfront.js"></script>

</html>