<?php
session_start();
?>

<?php

include('conexion.php');


$producto_id = $_GET['productoId'];
$carrito = $_COOKIE['carrito'];

$carrito = unserialize($carrito);
$carrito[$producto_id] = 0;

setcookie('carrito', serialize($carrito), time() + 3600, '/');
$_SESSION['carrito'] = $carrito;

header("location:carrito.php")


?>