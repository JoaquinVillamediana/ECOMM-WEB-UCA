<?php
include_once('../../onlyadmin.php');
include_once('../../db.php');

$id_cat=$_POST['category_input'];
$nombre=$_POST['name_input'];
$precio=$_POST['price-input'];
$detalles=$_POST['details-input'];
$stock=$_POST['stock-input'];
$descuento=$_POST['discount-input'];

$query = 'INSERT INTO product values ('.$id_cat.','.$nombre.','.$precio.','.$detalles.','.$descuento.','.$stock.')'


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
        <h1>Crear Producto</h1>
        <form action="" method="POST" id="productForm">
            <div class="item" id="name">
                <label for="">Nombre</label>
                <input type="text" name="name" id="name-input">
                <span class="error">Campo obligatorio (min 3 car. max 60 car.)</span>
            </div>
            <div class="item" id="category">
                <label for="">Categoria</label>
                <select name="" id="category-input">
                <?php 
                $conn = conectarBD();
                $query = "select * from categoria";
                $resultado = consultaSQL($conn,$query);
                if ($resultado->num_rows >0){
                    while ($row = $resultado->fetch_assoc()){
                        ?>
                        <option value=<?php echo $row['id']?>><?php echo $row['nombre']?></option>
                    <?php }
                } ?>
                </select>
            </div>
            <div class="item" id="image">
                <label for="" id="images-label">Imagenes</label>
                <input type="file" onchange="addImage(this)" name="image[]" id="img-1">
                <div class="current-images">
                    <ul id="ul-imgs">
                    </ul>
                </div>
            </div>
            <div class="item attrs" id="image">
                <label for="" id="images-label">Atributos</label>
                <div class="combo" id="attr-combo">
                    <input type="text" name="attrs" id="attr-input" data-attr-id="1">
                    <a href="" onclick="addAttr()" class="attr-submit">Cargar</a>
                </div>
                <div class="current-attrs">
                    <ul id="ul-attr">
                    </ul>
                </div>
            </div>
            <div class="price-combo">
                <div class="item" id="price">
                    <label for="">Precio (AR$)</label>
                    <input type="number" name="price" id="price-input">
                    <span class="error">Campo obligatorio. Numerico</span>
                </div>
                <div class="item" id="discount">
                    <label for="">Descuento (%)</label>
                    <input type="number" name="discount" id="discount-input">
                    <span class="error">Campo obligatorio.</span>
                </div>
            </div>
            <div class="item" id="stock">
                <label for="">Stock</label>
                <input type="number" min="0" name="stock" id="stock-input">
                <span class="error">Campo obligatorio. Numerico</span>
            </div>
            <div class="item" id="details">
                <label for="">Detalles</label>
                <textarea name="" cols="30" id="details-input" rows="10"></textarea>
                <span class="error">Campo obligatorio. (min 3 car. max 1050 car.)</span>
            </div>
            <div style="text-align: center;">
                <button type="submit" onclick="validateFields()" class="btn-create">Crear</button>
            </div>
        </form>
    </div>

    <script src="../../assets/js/adminproduct.js"></script>
    <script src="../../assets/js/generaladmin.js"></script>




</body>

</html>