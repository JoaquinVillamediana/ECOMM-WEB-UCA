<?php
include_once('../../onlyadmin.php');
include_once('../../db.php');

$conn = conectarBD();
$query = 'SELECT * FROM categoria WHERE id = "' . $_GET['id'] . '";';
$respuesta = consultaSQL($conn, $query);
if ($respuesta->num_rows > 0) {
    while ($row = $respuesta->fetch_assoc()) {
        $current_name = $row["nombre"];
    }
    desconectarBD($conn);
} else {
    desconectarBD($conn);
    header("Location: index.php");
}


if ($_POST) {
    $conn = conectarBD();
    $query = 'UPDATE categoria SET nombre = "'. $_POST["name"] .'" WHERE id = "' . $_GET['id'] . '";';
    consultaSQL($conn, $query);
    desconectarBD($conn);
    header("Location: index.php");
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
    <link rel="stylesheet" href="../../assets/css/adminproductcreate.css">
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

    <div class="container main-container">
        <h1>Editar Categoria</h1>
        <form action="" method="POST" id="createForm">
            <div class="item" id="name">
                <label for="">Nombre</label>
                <input type="text" name="name" value="<?php echo($current_name); ?>" id="name-input">
                <span class="error">Campo obligatorio (min 3 car. max 60 car.)</span>
            </div>
            <div style="text-align: center;">
                <button onclick="validateFields()" class="btn-create">Guardar</button>
            </div>
        </form>
    </div>

    <script src="../../assets/js/admincategory.js"></script>
    <script src="../../assets/js/generaladmin.js"></script>
</body>

</html>