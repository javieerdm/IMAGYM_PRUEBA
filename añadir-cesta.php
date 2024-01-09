<?php
session_start();
?>

<?php

include('conexion.php');
$producto_id = $_GET['ProductoID'];
$cantidad =$_POST['cantidad'];
$talla = $_POST['talla'];

$clave_carrito = $producto_id . '_' . $talla;


if (isset($_SESSION['carrito'])) {
    $carrito = $_SESSION['carrito'];
} else {
    $carrito = array();
}


// Agregar el producto al carrito
if (isset($carrito[$clave_carrito])) {
    $carrito[$clave_carrito]['cantidad'] += $cantidad;
} else {
    $carrito[$clave_carrito] = ['cantidad' => $cantidad, 'talla' => $talla];


}

// Guardar el carrito en una cookie
setcookie('carrito', serialize($carrito), time() + 3600, '/');

// Actualizar la variable de sesión
$_SESSION['carrito'] = $carrito;

header("location:carrito.php")


?>