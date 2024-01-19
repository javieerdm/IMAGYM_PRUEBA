<?php
//$conexion = new mysqli('localhost', 'root', '', 'script_imagym');
//if ($conexion->connect_error) {
  //  die('Error en la conexión' . $conexion->connect_error);
//}
//mysqli_set_charset($conexion,"utf8");
$url = parse_url(getenv("JAWSDB_URL"));

$server = $url["esilxl0nthgloe1y.chr7pe7iynqr.eu-west-1.rds.amazonaws.com"];
$username = $url["tto8891hif7ljdap"];
$password = $url["zo25ckoe4fmvbom4"];
$db = substr($url["path"], 1); // Elimina la barra inicial en el nombre de la base de datos

$conexion = new mysqli($server, $username, $password, $db);

if ($conexion->connect_error) {
    die('Error en la conexión: ' . $conexion->connect_error);
}

mysqli_set_charset($conexion, "utf8");
?>


