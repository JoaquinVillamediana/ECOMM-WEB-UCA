<?php
    // echo "hola";
    include('db.php');
    $conn = conectarBD();
    // $query =
    // 'SELECT * FROM producto_imagenes
    // INNER JOIN producto ON producto_imagenes.id_producto=producto.id
    // INNER JOIN categoria ON producto.id_categoria=categoria.id
    // WHERE producto.descuento IS NOT NULL';
    $query = 'SELECT categoria.nombre as nom_cat, producto.nombre as nom_prod, producto.precio as precio, producto.id as id, producto_imagenes.imagen as url_img, producto.descuento as descuento from producto 
    INNER JOIN categoria ON producto.id_categoria=categoria.id
    INNER JOIN producto_imagenes ON producto.id=producto_imagenes.id_producto
    WHERE descuento IS NOT NULL';
    
    $result = consultaSQL($conn,$query);
    $id = "";
    while ($producto = $result->fetch_assoc()){
        if ($producto['id']!=$id){
            $porcentaje = (($producto['precio']-$producto['descuento'])*100)/$producto['precio'];
            echo intval($porcentaje);
            echo "</br> </br>";
            echo "NOMBRE ---> ";
            echo $producto['nom_prod']." ";
            echo "PRECIO  ---> ";
            echo $producto['precio']." ";
            echo " ID PRODUCTO ---> ";
            echo $producto['id']." ";
            echo " DESCUENTO ---> ";
            echo $producto['descuento']." ";
            echo " URL ---> ";
            echo $producto['url_img']." ";
            echo "CATEGORIA ----> ";
            echo $producto['nom_cat']." ";
            echo "</br>";
            
        }
        $id = $producto['id'];
        
    }
?>