<?php
session_start();
include('conexion.php');

if (isset($_SESSION['carrito'])) {
    $carrito = $_SESSION['carrito'];
} elseif (isset($_COOKIE['carrito'])) {
    $carrito = unserialize($_COOKIE['carrito']);
} else {
    exit("No se encontró el carrito");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['producto_id'], $_POST['accion'])) {
        $producto_id = $_POST['producto_id'];
        $accion = $_POST['accion'];
        $talla = isset($_POST['talla']) ? $_POST['talla'] : null;
        $clave_carrito = $producto_id . '_' . $talla;

        // Obtener el stock actual del producto
        if ($talla) {
            // Si el producto tiene talla, primero obtén el ID de la talla
            $consultaTallaID = "SELECT ID FROM Tallas WHERE Talla = '$talla'";
            $resultadoTallaID = $conexion->query($consultaTallaID);
            if ($resultadoTallaID->num_rows > 0) {
                $filaTallaID = $resultadoTallaID->fetch_assoc();
                $tallaID = $filaTallaID['ID'];
                // Luego usa ese ID para comprobar el stock
                $consultaStock = "SELECT Stock FROM ProductoTallas WHERE ProductoID = $producto_id AND TallaID = $tallaID";
            } else {
                $_SESSION['error'] = 'La talla especificada no existe.';
                header('Location: carrito.php');
                exit;
            }
         } else {
            // Si el producto no tiene talla
            $consultaStock = "SELECT Stock FROM Productos WHERE ID = $producto_id";
        }
        $resultadoStock = $conexion->query($consultaStock);
        $filaStock = $resultadoStock->fetch_assoc();
        $stockDisponible = $filaStock['Stock'];

        $cantidadActualCarrito = isset($carrito[$clave_carrito]) ? $carrito[$clave_carrito]['cantidad'] : 0;

        if ($accion === 'incrementar') {
            if ($cantidadActualCarrito + 1 <= $stockDisponible) {
                $carrito[$clave_carrito]['cantidad']++;
            } else {
                $_SESSION['error'] = 'Stock no disponible.';
                header('Location: carrito.php');
                exit;
            }
        } elseif ($accion === 'decrementar' && $cantidadActualCarrito > 1) {
            $carrito[$clave_carrito]['cantidad']--;
        }

        setcookie('carrito', serialize($carrito), time() + (86400 * 30), '/');
        $_SESSION['carrito'] = $carrito;

        header('Location: carrito.php');
        exit();
    }
}

exit("Acción no válida");
?>
