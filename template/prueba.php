<?php 
    echo "hola";
    echo "buuuenas";
    include('db.php');
    $conn = conectarBD();
    $query = 'select * from producto';
    $xddd = consultaSQL($conn,$query);
    echo "holaaa"
?>