<?php
include_once('../../onlyadmin.php');
include_once('../../db.php');
$ID_edit = $_GET['product_id'];

if ($_POST){
    $id_cat=$_POST['category'];
    $nombre=$_POST['name'];
    $precio=$_POST['price'];
    $details=$_POST['details'];
    $stock=$_POST['stock'];
    $descuento=$_POST['discount'];
    if(empty($_POST['discount']))
    {
        $descuento = 0;
    }
    $images = $_POST['image'];
    $attrs = $_POST['attr'];
    $conn = conectarBD();
    $query = "UPDATE producto SET id_categoria=$id_cat, nombre='$nombre', precio=$precio, detalles='$details', descuento=$descuento, stock=$stock
    WHERE id=$ID_edit";

    
    consultaSQL($conn,$query);
    desconectarBD($conn);
    
    // BORRAR IMAGENES Y ATTRS PARA DESPUES AGREGARLAS DE NUEVO

    if(count($images) == 1)
    {
        if($images[0] != "")
        {
            $conn2 = conectarBD();
            $query2 = "SET FOREIGN_KEY_CHECKS=0;";
            consultaSQL($conn2,$query2);
            $query2 = "DELETE FROM producto_imagenes WHERE id_producto=$ID_edit;";
            
            consultaSQL($conn2,$query2);
            $query2 = "SET FOREIGN_KEY_CHECKS=1;";
            consultaSQL($conn2,$query2);
            desconectarBD($conn2);
        }
    }else
    {
        $conn2 = conectarBD();
        $query2 = "SET FOREIGN_KEY_CHECKS=0;";
        consultaSQL($conn2,$query2);
        $query2 = "DELETE FROM producto_imagenes WHERE id_producto=$ID_edit;";
        
        consultaSQL($conn2,$query2);
        $query2 = "SET FOREIGN_KEY_CHECKS=1;";
        consultaSQL($conn2,$query2);
        desconectarBD($conn2);
    }

    if(!empty($attrs) && count($attrs) > 0)
    {
        $conn3 = conectarBD();
        $query3 = "SET FOREIGN_KEY_CHECKS=0;";
        consultaSQL($conn3,$query3);
        $query3 = "DELETE FROM producto_atributo WHERE id_producto=$ID_edit;";
        consultaSQL($conn3,$query3);
        $query3 = "SET FOREIGN_KEY_CHECKS=1;";
        consultaSQL($conn3,$query3);

        desconectarBD($conn3);    
    }
    

    // print_r($images);

    foreach($images as $img_url){
        if ($img_url!=""){
            $imagen = "assets/img/".$img_url;
            $conn4 = conectarBD();
            $query4 = "INSERT INTO producto_imagenes (id_producto, imagen) VALUES ($ID_edit, '$imagen')";
            
            consultaSQL($conn4,$query4);
            desconectarBD($conn4);
        }

    }
    foreach($attrs as $attr){
        if ($attr!=""){
            $conn5 = conectarBD();
            $query5 = "INSERT INTO producto_atributo (id_producto, nombre) VALUES ($ID_edit, '$attr')";
            consultaSQL($conn5,$query5);
            desconectarBD($conn5);
            
        }
    }
    
    


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
        <h1>Editar Producto</h1>
        <form action="" method="POST" id="productForm">
            <?php 
            
            $conn = conectarBD();
            $query = "SELECT * from producto WHERE producto.id='$ID_edit'";
            $result = consultaSQL($conn,$query);
            desconectarBD($conn);

            while ($row = $result->fetch_assoc()){
                $nombre = $row['nombre'];
                $id_cat = $row['id_categoria'];
                $precio = $row['precio'];
                $descuento = $row['descuento'];
                $stock = $row['stock'];
                $detalles = $row['detalles'];
            }
            $attrs = [];
            $conn2 = conectarBD();
            $query2 = "SELECT nombre from producto_atributo WHERE id_producto='$ID_edit'";
            $result2 = consultaSQL($conn2,$query2); 
            while ($row = $result2->fetch_assoc()){
                array_push($attrs,$row['nombre']);
            }

            $imgs = [];
            $conn3 = conectarBD();
            $query3 = "SELECT imagen from producto_imagenes WHERE id_producto='$ID_edit'";
            $result3 = consultaSQL($conn3,$query3); 
            while ($row = $result3->fetch_assoc()){
                array_push($imgs,$row['imagen']);
                
            }
            ?>
            <div class="item" id="name">
                <label for="">Nombre</label>
                <input type="text" name="name" value="<?php echo $nombre; ?>" id="name-input">
                <span class="error">Campo obligatorio (min 3 car. max 60 car.)</span>
            </div>
            <div class="item" id="category">
                <label for="">Categoria</label>
                <select name="category" id="category-input">
                <?php 
                $conn = conectarBD();
                $query = "select * from categoria";
                $resultado = consultaSQL($conn,$query);
                if ($resultado->num_rows >0){
                    while ($row = $resultado->fetch_assoc()){
                        $add = '';
                        if ($row['id']==$id_cat){
                            $add = 'selected';
                        }
                        ?>
                        <option <?php echo $add;?> value=<?php echo $row['id'];?>><?php echo $row['nombre'];?></option>
                    <?php }
                } ?>
                </select>
            </div>
            <div class="item" id="image">
                <label for="" id="images-label">Imagenes</label>
                <input type="file" onchange="addImage(this)" name="image[]" id="img-4">
                <div class="current-images">
                    <ul id="ul-imgs">
                        <?php 
                        $i=1;
                        foreach($imgs as $img){
                            ?>
                            <li class="old-img"><?php echo $img; ?><a href="" onclick="delImage(<?php echo $i; ?>)" id="del-img-<?php echo $i; ?>" class="del-img">X</a></li>

                    <?php $i=$i+1; } ?>
                    </ul>
                </div>
            </div>
            <div class="item attrs" id="image">
                <label for="" id="images-label">Atributos</label>
                <div class="combo" id="attr-combo">
                    <input type="text" name="attrs" id="attr-input" data-attr-id="4">
                    <a href="" onclick="addAttr()" class="attr-submit">Cargar</a>
                    <?php 
                        $i=1;
                        foreach($attrs as $attr){
                            ?>
                            <input type="hidden" name="attr[]" id="attr-<?php echo $i ?>" value="<?php echo $attr ?>">
                        <?php $i=$i+1;}

                        ?>
                </div>
                <div class="current-attrs">
                    <ul id="ul-attr">
                        <?php 
                        $i=1;
                        foreach($attrs as $attr){
                            ?>
                            <li><?php echo $attr ?><a href="" onclick="delAttr(<?php echo $i ?>)" id="del-attr-<?php echo $i ?>" class="del-attr">X</a></li>
                            
                        <?php $i=$i+1;}

                        ?>
                        
                    </ul>
                </div>
            </div>
            <div class="price-combo">
                <div class="item" id="price">
                    <label for="">Precio (AR$)</label>
                    <input type="number" value="<?php echo $precio; ?>" name="price" id="price-input">
                    <span class="error">Campo obligatorio. Numerico</span>
                </div>
                <div class="item" id="discount">
                    <label for="">Descuento (%)</label>
                    <input type="number" value="<?php echo $descuento; ?>"  id="discount-input" name="discount">
                    <span class="error">Campo obligatorio.</span>
                </div>
            </div>
            <div class="item" id="stock">
                <label for="">Stock</label>
                <input type="number" min="0" name="stock" value=<?php echo $stock; ?> id="stock-input">
                <span class="error">Campo obligatorio. Numerico</span>
            </div>
            <div class="item" id="details">
                <label for="">Detalles</label>
                <textarea name="details" cols="30" id="details-input" name="details" rows="10"><?php echo $detalles; ?>
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