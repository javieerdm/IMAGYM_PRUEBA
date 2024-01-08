<?php
// buscar.php
include('conexion.php'); // Asegúrate de incluir tu script de conexión a la base de datos

$terminoBusqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

// Prepara una consulta SQL para buscar productos por nombre
$consulta = "SELECT * FROM Productos WHERE Nombre LIKE '%$terminoBusqueda%'";

$resultado = mysqli_query($conexion, $consulta);

// Comprueba si hay resultados y muéstralos
if(mysqli_num_rows($resultado) > 0) {
    while($producto = mysqli_fetch_assoc($resultado)) {
        echo "<div>";
        echo "<h2>" . $producto['Nombre'] . "</h2>";
        // Muestra más detalles del producto si lo deseas
        echo "</div>";
    }
} else {
    echo "No se encontraron productos.";
}
?>
