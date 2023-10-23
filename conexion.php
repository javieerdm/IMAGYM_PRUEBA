<?php
$conexion = new mysqli('localhost', 'root', '', 'base de datos');
if ($conexion->connect_error) {
    die('Error en la conexión' . $conexion->connect_error);
}
mysqli_set_charset($conexion,"utf8");
?>
