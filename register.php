<?php
include_once('db.php');
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
            <form action="" method="POST" id="registerForm">
                <div id="name">
                    <label for="">Nombre y apellido</label>
                    <input type="text" name="name">
                    <span class="error">Campo obligatorio. (min 3 car. max 60 car.)</span>
                </div>

                <div id="email">
                    <label for="">Email</label>
                    <input type="email" name="email">
                    <span class="error">Email invalido.</span>

                    <?php
                    include_once('db.php');

                    if ($_POST) {
                        $conn = conectarBD();
                        $query = 'SELECT * FROM usuarios WHERE email = "' . $_POST["email"] . '";';
                        $respuesta = consultaSQL($conn, $query);

                        if ($respuesta->num_rows > 0) {
                            echo ('<span style="display:block;" class="error">Este email ya se encuentra registrado.</span>');
                            desconectarBD($conn);
                        } else {
                            $query = 'INSERT INTO usuarios (email,password,nombre,usertype) VALUES ("' . $_POST["email"] . '","' . $_POST["password"] . '","' . $_POST["name"] . '",2)';
                            consultaSQL($conn, $query);
                            $_SESSION['user'] = $_POST['email'];
                            $_SESSION["userid"] = $conn->insert_id;
                            $_SESSION['user_type'] = 2;
                            desconectarBD($conn);
                            header('Location: index.php');
                        }
                    }
                    ?>

                </div>

                <div id="password">
                    <label for="">Contrase??a</label>
                    <input type="password" name="password">
                    <span class="error">Campo obligatorio. (min 8 car. max 60 car.)</span>
                </div>

                <div id="password_confirm">
                    <label for="">Confirmar contrase??a</label>
                    <input type="password" name="confirm_password">
                    <span class="error">Las contrase??as deben coincidir.</span>
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