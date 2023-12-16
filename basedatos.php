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
    $password = "";
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
    
    // Mostrar la información de pedidos
    echo "<h2>Pedidos:</h2>";
    if ($resultPedidos->num_rows > 0) {
        while($row = $resultPedidos->fetch_assoc()) {
            // Mostrar información de cada pedido
            echo  "Cliente ID: " . $row["ClienteID"]. " - Producto ID: " . $row["ProductoID"] . " - Producto: " . $row["NombreProducto"]. " - Cantidad: " . $row["Cantidad"] . " - Precio total: " . $row["PrecioTotal"]. " - Fecha compra: " . $row["FechaCompra"].  "<br>";
        }
    } else {
        echo "No hay pedidos.";
    }
    
    // Mostrar la información de usuarios
    echo "<h2>Usuarios:</h2>";
    if ($resultUsuarios->num_rows > 0) {
        while($row = $resultUsuarios->fetch_assoc()) {
            // Mostrar información de cada usuario
            echo "ID Usuario: " . $row["ID"]. " - Nombre: " . $row["Nombre"]. " - Email: " . $row["Email"]. " - Rol: " . $row["Rol"]. "<br>";
        }
    } else {
        echo "No hay usuarios.";
    }
    
    // Cerrar la conexión
    $conn->close();
    ?>