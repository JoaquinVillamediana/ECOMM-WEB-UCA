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
        <h1>Editar Producto</h1>
        <form action="" id="productForm">
            <div class="item" id="name">
                <label for="">Nombre</label>
                <input type="text" name="name" value="Pelota ADX40" id="name-input">
                <span class="error">Campo obligatorio (min 3 car. max 60 car.)</span>
            </div>
            <div class="item" id="category">
                <label for="">Categoria</label>
                <select name="" id="category-input">
                    <option selected value="">Pelotas</option>
                    <option value="">Remeras</option>
                    <option value="">Pantalones</option>
                </select>
            </div>
            <div class="item" id="image">
                <label for="" id="images-label">Imagenes</label>
                <input type="file" onchange="addImage(this)" name="image[]" id="img-4">
                <div class="current-images">
                    <ul id="ul-imgs">
                        <li>lorem.png<a href="" onclick="delImage(1)" id="del-img-1" class="del-img">X</a></li>
                        <li>loremipsum.png<a href="" onclick="delImage(2)" id="del-img-2" class="del-img">X</a></li>
                        <li>loremlorem.png<a href="" onclick="delImage(3)" id="del-img-3" class="del-img">X</a></li>
                    </ul>
                </div>
            </div>
            <div class="item attrs" id="image">
                <label for="" id="images-label">Atributos</label>
                <div class="combo" id="attr-combo">
                    <input type="text" name="attrs" id="attr-input" data-attr-id="4">
                    <a href="" onclick="addAttr()" class="attr-submit">Cargar</a>
                </div>
                <div class="current-attrs">
                    <ul id="ul-attr">
                        <li>AZUL<a href="" onclick="delAttr(1)" id="del-attr-1" class="del-attr">X</a></li>
                        <li>BLANCA<a href="" onclick="delAttr(2)" id="del-attr-2" class="del-attr">X</a></li>
                        <li>VERDE<a href="" onclick="delAttr(3)" id="del-attr-3" class="del-attr">X</a></li>
                    </ul>
                </div>
            </div>
            <div class="price-combo">
                <div class="item" id="price">
                    <label for="">Precio (AR$)</label>
                    <input type="number" value="4500" name="price" id="price-input">
                    <span class="error">Campo obligatorio. Numerico</span>
                </div>
                <div class="item" id="discount">
                    <label for="">Descuento (%)</label>
                    <input type="number" value="5" name="discount" id="discount-input">
                    <span class="error">Campo obligatorio.</span>
                </div>
            </div>
            <div class="item" id="stock">
                <label for="">Stock</label>
                <input type="number" min="0" name="stock" value="23" id="stock-input">
                <span class="error">Campo obligatorio. Numerico</span>
            </div>
            <div class="item" id="details">
                <label for="">Detalles</label>
                <textarea name="" cols="30" id="details-input" rows="10">Pelota de Fútbol futsal GOL DE ORO STAR | Nº4

                    Material: cuero sintetico vulcanizado
                    Color:naranja, blanco, amarillo
                    peso reglamentario: 400gr
                    Tamaño:nº4
                    gajos pegados
                    tipo de pique: medio pique
                    circunferencia: 65 cm
                </textarea>
                <span class="error">Campo obligatorio. (min 3 car. max 1050 car.)</span>
            </div>
            <div style="text-align: center;">
                <button onclick="validateFields()" class="btn-create">Guardar & Salir</button>
            </div>
        </form>
    </div>
    <script src="../../assets/js/adminproduct.js"></script>
    <script src="../../assets/js/generaladmin.js"></script>
</body>

</html>