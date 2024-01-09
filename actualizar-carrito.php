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
    if (isset($_POST['producto_id']) && isset($_POST['accion'])) {
        $producto_id = $_POST['producto_id'];
        $accion = $_POST['accion'];

        if ($accion === 'incrementar') {
            // Lógica para incrementar la cantidad del producto en el carrito
            if (isset($carrito[$producto_id])) {
                $carrito[$producto_id]['cantidad']++;
            }
        } elseif ($accion === 'decrementar') {
            // Lógica para decrementar la cantidad del producto en el carrito
            if (isset($carrito[$producto_id]) && $carrito[$producto_id] > 0) {
                $carrito[$producto_id]['cantidad']--;
                if ($carrito[$producto_id]['cantidad'] === 0) {
                    unset($carrito[$producto_id]);
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