<?php
session_start();
include('conexion.php'); // Incluye tu archivo de configuración de la base de datos

if (isset($_SESSION["cliente"]) && isset($_GET['ProductoID'])) {

    $nombre_usuario = $_SESSION["cliente"]; // Nombre del cliente de la sesión
    $producto_id = $_GET['ProductoID'];

    // Crear una conexión a la base de datos
    $conexion = new mysqli ('localhost', 'root', 'tfgimagym', 'script_imagym'); // Asegúrate de reemplazar con tus constantes o variables de conexión

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("La conexión falló: " . $conexion->connect_error);
    }

    $stmt = $conexion->prepare("SELECT ID FROM Usuarios WHERE Nombre = ?");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $usuario_id = $fila['ID'];



    // Preparar una declaración para insertar el producto en favoritos
    // Se usa INSERT IGNORE para evitar errores si el producto ya está en favoritos
    $stmt = $conexion->prepare("INSERT IGNORE INTO Favoritos (UsuarioID, ProductoID) VALUES (?, ?)");
    $stmt->bind_param("ii", $usuario_id, $producto_id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Producto añadido a favoritos con éxito'); window.location.href='producto.php';</script>";						
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "No se encontró el usuario";
    exit;
}

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
} else {
    // Redirigir al usuario a la página de registro si no ha iniciado sesión
    header('Location: registro.php');
    exit();
}
?>
