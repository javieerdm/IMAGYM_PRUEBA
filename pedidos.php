<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Pedidos</title>
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/pedidos.css">
</head>

<body>
    <div id="body">
        <?php include('cabecera.php'); ?>

        <section>
            <h1>Mis Pedidos</h1>

            <?php
            // Obtener los pedidos del cliente desde la base de datos
            $consultaPedidos = "SELECT * FROM Facturas WHERE ClienteID = $cliente";
            $resultadoPedidos = $conexion->query($consultaPedidos);

            if ($resultadoPedidos->num_rows > 0) {
                while ($pedido = $resultadoPedidos->fetch_assoc()) {
                    echo "<p>Pedido realizado el " . $pedido['FechaCompra'] . "</p>";
                    echo "<p>Precio Total: " . $pedido['PrecioTotal'] . " €</p>";

                    // Obtener los productos de cada pedido
                    $facturaID = $pedido['ID'];
                    $consultaProductosEnPedido = "SELECT P.Nombre, P.Precio, PF.Cantidad, PF.Talla
                                                  FROM ProductosEnFacturas PF
                                                  JOIN Productos P ON PF.ProductoID = P.ID
                                                  WHERE PF.FacturaID = $facturaID";

                    $resultadoProductosEnPedido = $conexion->query($consultaProductosEnPedido);

                    if ($resultadoProductosEnPedido->num_rows > 0) {
                        echo "<table border='1'>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio Unitario</th>
                                    <th>Cantidad</th>
                                    <th>Talla</th>

                                </tr>";

                        while ($productoEnPedido = $resultadoProductosEnPedido->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $productoEnPedido['Nombre'] . "</td>
                                    <td>" . $productoEnPedido['Precio'] . " €</td>
                                    <td>" . $productoEnPedido['Cantidad'] . "</td>
                                    <td>" . $productoEnPedido['Talla'] . "</td>

                                  </tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "<p>No hay productos en este pedido.</p>";
                    }

                    echo "<hr>";
                }
            } else {
                echo "<p>No tienes pedidos realizados.</p>";
            }
            ?>

        </section>

        <?php include('pie.php'); ?>
    </div>
</body>

</html>
