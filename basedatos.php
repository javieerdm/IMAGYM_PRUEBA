<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Base de datos</title>
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/basedatos.css">
</head>

<?php
session_start();
?>

<?php
    // Mostrar la información de pedidos y usuarios
    // Aquí es donde se mostrarán los datos de la tabla facturas y usuarios desde la base de datos
    // Realizar consultas SQL para obtener los pedidos y usuarios de las tablas respectivas
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "tfgimagym";
    $dbname = "script_imagym";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Consulta para obtener los pedidos (tabla facturas)
    $sqlPedidos = "SELECT * FROM facturas";
    $resultPedidos = $conn->query($sqlPedidos);
    
    // Consulta para obtener todos los usuarios
    $sqlUsuarios = "SELECT * FROM usuarios";
    $resultUsuarios = $conn->query($sqlUsuarios);

    $sqlPedidos = "SELECT f.ID, f.ClienteID, f.FechaCompra, f.PrecioTotal, u.Nombre 
               FROM facturas f 
               INNER JOIN usuarios u ON f.ClienteID = u.ID";

$resultPedidos = $conn->query($sqlPedidos);

$sqlPedidos = "SELECT f.ID AS ID_Pedido, f.ClienteID, f.FechaCompra, f.PrecioTotal, u.Nombre, pf.ProductoID, pf.Cantidad 
               FROM facturas f 
               INNER JOIN usuarios u ON f.ClienteID = u.ID
               INNER JOIN productosenfacturas pf ON f.ID = pf.FacturaID";

$resultPedidos = $conn->query($sqlPedidos);

$sqlPedidos = "SELECT f.ID AS ID_Pedido, f.ClienteID, f.FechaCompra, f.PrecioTotal, u.Nombre AS NombreCliente, pf.ProductoID, pf.Cantidad, p.Nombre AS NombreProducto
               FROM facturas f 
               INNER JOIN usuarios u ON f.ClienteID = u.ID
               INNER JOIN productosenfacturas pf ON f.ID = pf.FacturaID
               INNER JOIN productos p ON pf.ProductoID = p.ID";

$resultPedidos = $conn->query($sqlPedidos);

// Consulta para obtener los datos de la tabla Contacto
$sqlContacto = "SELECT * FROM Contacto";
$resultContacto = $conn->query($sqlContacto);
?>

<h6 class="volver">
    <a href="javascript:history.go(-1)">
        <img title="Volver atrás" src="imagenes/volver.jpg" style="width: 40px; height: auto;">
    </a>
</h6>

    
    <?php
    // Mostrar la información de pedidos

    echo "<h2>Pedidos:</h2>";
if ($resultPedidos->num_rows > 0) {
    echo "<table border='1'><tr><th>ID Pedido</th><th>Cliente ID</th><th>Producto ID</th><th>Producto</th><th>Cantidad</th><th>Precio Total</th><th>Fecha Compra</th></tr>";
    while($row = $resultPedidos->fetch_assoc()) {
        echo "<tr><td>" . $row["ID_Pedido"]. "</td><td>" . $row["ClienteID"]. "</td><td>" . $row["ProductoID"]. "</td><td>" . $row["NombreProducto"]. "</td><td>" . $row["Cantidad"]. "</td><td>" . $row["PrecioTotal"]. "</td><td>" . $row["FechaCompra"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No hay pedidos.";
}
    
    // Mostrar la información de usuarios

    echo "<h2>Usuarios:</h2>";
if ($resultUsuarios->num_rows > 0) {
    echo "<table border='1'><tr><th>ID Usuario</th><th>Nombre</th><th>Email</th><th>Rol</th></tr>";
    while($row = $resultUsuarios->fetch_assoc()) {
        echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Nombre"]. "</td><td>" . $row["Email"]. "</td><td>" . $row["Rol"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No hay usuarios.";
}

    // Mostrar la información de contacto
echo "<h2>Contactos:</h2>";
if ($resultContacto->num_rows > 0) {
    // Encabezado de la tabla
    echo "<table border='1'><tr><th>Orden</th><th>Nombre</th><th>Correo</th><th>Mensaje</th></tr>";

    // Datos de cada contacto
    while($row = $resultContacto->fetch_assoc()) {
        echo "<tr><td>" . $row["ORDEN"]. "</td><td>" . $row["NOMBRE"]. "</td><td>" . $row["CORREO"]. "</td><td>" . $row["MENSAJE"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No hay contactos.";
}
    
    // Cerrar la conexión
    $conn->close();
    ?>