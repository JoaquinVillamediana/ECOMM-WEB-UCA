<?php
include_once('../../onlyadmin.php');
include_once('../../db.php'); 

$conn = conectarBD();


if($_GET["option"] == 1)
{
    $query = 'UPDATE pedidos SET id_estado = 2 WHERE id = '.$_GET["id"].'
    ';
    consultaSQL($conn, $query);

}

if($_GET["option"] == 2)
{
    $query = 'UPDATE pedidos SET id_estado = 3 WHERE id = '.$_GET["id"].'
    ';
    consultaSQL($conn, $query);

    $query = 'SELECT * FROM pedidos_producto WHERE id_pedido = '.$_GET["id"].'
    ';
    $respuesta = consultaSQL($conn, $query);
    while($row = $respuesta->fetch_assoc())
    {
        $conn2 = conectarBD();
        $query2 = 'UPDATE producto SET stock = (producto.stock + '. $row["cantidad"] .') WHERE id = '.$row["id_producto"].'
    ';
        consultaSQL($conn2, $query2);
    }
    desconectarBD($conn2);
}

desconectarBD($conn);

header("Location: index.php");