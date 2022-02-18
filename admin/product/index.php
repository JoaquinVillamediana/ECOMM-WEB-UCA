<?php
include_once('../../onlyadmin.php');
include_once('../../db.php');

if ($_POST && !empty($_POST['product_id'])) {
    $conn = conectarBD();
    $query = "SET FOREIGN_KEY_CHECKS=0;";
    consultaSQL($conn,$query);

    $query = 'DELETE FROM carrito_productos WHERE id_producto = ' . $_POST['product_id'] . ';';
    consultaSQL($conn, $query);

    $query = 'DELETE FROM producto_atributo WHERE id_producto = ' . $_POST['product_id'] . ';';
    consultaSQL($conn, $query);

    $query = 'DELETE FROM producto_imagenes WHERE id_producto = ' . $_POST['product_id'] . ';';
    consultaSQL($conn, $query);


    $query = 'DELETE FROM producto WHERE id = ' . $_POST['product_id'] . ';';
    consultaSQL($conn, $query);

    $query = "SET FOREIGN_KEY_CHECKS=1;";
    consultaSQL($conn,$query);

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
            <h1>Productos</h1>
            <a href="create.php" class="btn-create">Crear</a>
            <div class="mobile-scroll">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th></th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        $conn = conectarBD();
                        $query = 'SELECT producto.id as id, producto.nombre as nombre, categoria.nombre as nom_cat, producto.precio as precio from producto
                        INNER JOIN categoria ON producto.id_categoria=categoria.id';
                        $respuesta = consultaSQL($conn,$query);

                        if ($respuesta->num_rows > 0);{
                            while ($row = $respuesta->fetch_assoc()){
                                ?>
                                <tr>
                                    <td><?php echo $row['nombre'] ?></td>
                                    <td><?php echo $row['nom_cat'] ?></td>
                                    <td><?php echo "$".$row['precio'] ?></td>
                                    <td><form action="" method="POST">
                                        <input type="hidden" name="product_id" value=<?php echo $row['id'];?>>
                                        <a href="edit.php?product_id=<?php echo $row['id'] ?>" class="btn-admin blue">Editar</a>
                                        <button type="submit" class="btn-admin red">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </section>





    <script src="../../assets/js/generaladmin.js"></script>
</body>

</html>