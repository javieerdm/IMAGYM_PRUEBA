<?php
// actualizar-carrito.php

// Iniciar sesión y obtener el carrito de la sesión o la cookie
session_start();

if (isset($_SESSION['carrito'])) {
    $carrito = $_SESSION['carrito'];
} elseif (isset($_COOKIE['carrito'])) {
    $carrito = unserialize($_COOKIE['carrito']);
} else {
    // Manejar la situación en la que el carrito no está disponible
    exit("No se encontró el carrito");
}

// Manejar la actualización del carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['producto_id'], $_POST['talla'], $_POST['accion'])) {
        $producto_id = $_POST['producto_id'];
        $talla = $_POST['talla'];
        $accion = $_POST['accion'];

        // Crear la clave combinada
        $clave_carrito = $producto_id . '_' . $talla;

        if ($accion === 'incrementar') {
            if (isset($carrito[$clave_carrito])) {
                $carrito[$clave_carrito]['cantidad']++;
            }
        } elseif ($accion === 'decrementar') {
            if (isset($carrito[$clave_carrito]) && $carrito[$clave_carrito]['cantidad'] > 0) {
                $carrito[$clave_carrito]['cantidad']--;
                if ($carrito[$clave_carrito]['cantidad'] === 0) {
                    unset($carrito[$clave_carrito]);
                }
            }
        }

        // Actualizar la cookie del carrito con los cambios
        $carrito_serializado = serialize($carrito);
        setcookie('carrito', $carrito_serializado, time() + (86400 * 30), '/'); // Cookie válida por 30 días

        // Actualizar el carrito en la sesión (si se usa)
        $_SESSION['carrito'] = $carrito;

        // Redireccionar de vuelta a la página del carrito
        header('Location: carrito.php');
        exit();
    }
}

// Manejar la situación en la que no se reciben datos POST adecuados
exit("Acción no válida");
?>