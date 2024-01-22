<?php
$conexion = new mysqli('localhost', 'root', 'tfgimagym', 'script_imagym');
if ($conexion->connect_error) {
   die('Error en la conexión' . $conexion->connect_error);
}
mysqli_set_charset($conexion,"utf8");

?>


