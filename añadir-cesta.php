<?php
session_start();
?>

<?php

include('conexion.php');
$producto_id = $_GET['ProductoID'];
$cantidad =$_POST['cantidad'];

if (isset($_SESSION['carrito'])) {
    $carrito = $_SESSION['carrito'];
} else {
    $carrito = array();
}


// Agregar el producto al carrito
if (isset($carrito[$producto_id])) {
    $carrito[$producto_id] += $cantidad;
} else {
    $carrito[$producto_id] = $cantidad;
}

// Guardar el carrito en una cookie
setcookie('carrito', serialize($carrito), time() + 3600, '/');

// Actualizar la variable de sesión
$_SESSION['carrito'] = $carrito;

header("location:carrito.php")


?>