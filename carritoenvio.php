<?php
    include_once("onlyclientes.php");
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        include_once("db.php");
        $conn = conectarBD();
        $nombre = $_POST["nombre"];
        $direccion = $_POST["direccion"];
        $telefono = $_POST["telefono"];
        $dni = $_POST["dni"];
        $envio = $_POST["envio"];
        
        $userid = $_SESSION["userid"];
        $query = "UPDATE carrito 
                  SET envio = $envio,
                      nombre = '$nombre',
                      direccion = '$direccion',
                      telefono = '$telefono',
                      dni = $dni,
                      envio = $envio
                  WHERE id_usuario = $userid";
        consultaSQL($conn, $query);
        desconectarBD($conn);
        header('Location: carritopago.php');
    }
    else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/carrito.css">
    <link rel="stylesheet" href="./assets/css/carritoenvio.css">
</head>

<body>

    <header>
        <div class="container">
            <img src="./assets/img/logo.png" alt="" class="logo">
            <div class="links">
                <a href="index.php" class="link">Volver al sitio</a>
            </div>
        </div>
    </header>
    <ul class="progress_carrito">
        <li class="done">
            <a href="carrito.php">Mi carrito</a>
        </li>
        <li>
            <a href="carritoenvio.php">Datos</a>
        </li>
        <li>
            <a>Datos de pago</a>
        </li>
    </ul>
    <main class="container carrito_resumen">
        <section class="b-bottom header" id="seleccionar">
            <h2 class="header">¿Cómo entregamos tu compra?</h2>
            <ul class="opciones_envio">
                <li>
                    <label for="retiro">
                        <input type="radio" name="retiro" id="retiro" onclick="seleccionar('retiro')">
                        <span>Retiro en puntos de entrega</span>
                    </label>
                </li>
                <li>
                    <label for="envio">
                        <input type="radio" name="envio" id="envio" onclick="seleccionar('envio')">
                        <span>Envio a domicilio</span>
                    </label>
                </li>
            </ul>
        </section>
        <section class="datos d-none b-bottom" id="datos">
            <h2 id="datos_titulo" class="header">Datos de envio</h2>
            <form method="POST" id="form">
                <input type="hidden" value="" id="input_envio" name="envio"/>
                <div class="form-group">
                    <div class="form-item">
                        <div class="textfield">
                            <label for="nombre">Nombre:</label>
                            <input name="nombre" id="nombre" type="text" onblur="validarNom(this.id)" maxlength="60">
                            <p class="textfield-p-error d-none" id="nombre-error"></p>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="textfield">
                            <label for="direccion">Direccion:</label>
                            <input name="direccion" id="direccion" type="text" onblur="validarDirec(this.id)" maxlength="255">
                            <p class="textfield-p-error d-none" id="direccion-error"></p>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="textfield">
                            <label for="telefono">Telefono:</label>
                            <input name="telefono" id="telefono" type="text" onblur="validarNum(this.id)" maxlength="60">
                            <p class="textfield-p-error d-none" id="telefono-error"></p>
                        </div>
                    </div>
                    <div class="form-item">
                        <div class="textfield">
                            <label for="dni">DNI:</label>
                            <input name="dni" id="dni" type="text" onblur="validarNum(this.id)">
                            <p class="textfield-p-error d-none" id="dni-error"></p>
                        </div>
                    </div>
                </div>
                
            </form>
            <button class="proceder" onclick="proceder()">Proceder al pago</button>

        </section>
    </main>

    <script src="./assets/js/carritoenvio.js"></script>
</body>

</html>
        
<?php
}
?>