<?php
session_start();

include('conexion.php');
$producto_id = $_GET['ProductoID'];
$cantidad = isset($_POST['cantidad']) ? (int)$_POST['cantidad'] : 0;
$nombreTalla = $_POST['talla'];

// Comprobar que la cantidad solicitada sea mayor que 0
if ($cantidad <= 0) {
    echo "<script>alert('Cantidad no válida.'); window.history.back();</script>";
    exit;
}

$clave_carrito = $producto_id . '_' . $nombreTalla;
$stockDisponible = 0;

if ($nombreTalla) {
    // Obtener el TallaID y verificar el stock para productos con talla
    $consultaTallaID = "SELECT ID FROM Tallas WHERE Talla = '$nombreTalla'";
    $resultadoTallaID = $conexion->query($consultaTallaID);

    if ($filaTalla = $resultadoTallaID->fetch_assoc()) {
        $tallaID = $filaTalla['ID'];
        $consultaStock = "SELECT Stock FROM ProductoTallas WHERE ProductoID = $producto_id AND TallaID = $tallaID";
        $resultado = $conexion->query($consultaStock);
        $fila = $resultado->fetch_assoc();
        $stockDisponible = $fila['Stock'];
    } else {
        echo "<script>alert('Talla no encontrada.'); window.history.back();</script>";
        exit;
    }
} else {
    // Verificar el stock para productos sin talla
    $consultaStock = "SELECT Stock FROM Productos WHERE ID = $producto_id";
    $resultado = $conexion->query($consultaStock);
    $fila = $resultado->fetch_assoc();
    $stockDisponible = $fila['Stock'];
}

// Calcular la cantidad total considerando lo que ya está en el carrito
$cantidadTotal = isset($_SESSION['carrito'][$clave_carrito]) ? $_SESSION['carrito'][$clave_carrito]['cantidad'] + $cantidad : $cantidad;

// Comprobar si hay suficiente stock
if ($stockDisponible < $cantidadTotal) {
    echo "<script>alert('Stock no disponible.'); window.history.back();</script>";
    exit;
}

if ($stockDisponible < $cantidadTotal) {
    $_SESSION['error'] = 'Stock no disponible.';
    echo "<script>window.history.back();</script>";
        exit;
}

// Lógica para agregar al carrito
if (isset($_SESSION['carrito'][$clave_carrito])) {
    $_SESSION['carrito'][$clave_carrito]['cantidad'] += $cantidad;
} else {
    $_SESSION['carrito'][$clave_carrito] = ['cantidad' => $cantidad, 'talla' => $nombreTalla];
}

// Guardar el carrito en una cookie
setcookie('carrito', serialize($_SESSION['carrito']), time() + 3600, '/');

header("location:carrito.php");
?>
