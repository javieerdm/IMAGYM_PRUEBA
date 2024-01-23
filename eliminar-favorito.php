<?php
include('conexion.php');

if (isset($_POST['producto_id'], $_POST['usuario_id'])) {
    $producto_id = $_POST['producto_id'];
    $usuario_id = $_POST['usuario_id'];

    // Consulta SQL para eliminar el producto de los favoritos del usuario específico
    $consultaEliminar = "DELETE FROM Favoritos WHERE ProductoID = $producto_id AND UsuarioID = $usuario_id";
    $conexion->query($consultaEliminar);

    // Redirigir de nuevo a la página de favoritos
    header('Location: favoritos.php');
}
?>
