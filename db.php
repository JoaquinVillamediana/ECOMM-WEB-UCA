<?php

function conectarBD()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecomm";
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Checkear conexión
    if ($conn->connect_error) {
        die("Conexion fallida: " . $conn->connect_error);
    }
    //echo "Conexion EXISTOSA";
    return $conn;
}
function consultaSQL($conn, $sql)
{
    $result = $conn->query($sql);
    return $result;
}


function desconectarBD($conn)
{
    // cerrar conexión
    $conn->close();
}
