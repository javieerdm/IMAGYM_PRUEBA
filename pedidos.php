<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Pedidos</title>
    <link rel="stylesheet" href="principal.css">
    <link rel="stylesheet" href="pedidos.css">
</head>

<body>
    <div id="body">
        <?php include('cabecera.php'); ?>

        <section>
            <h2>Mis Pedidos</h2>

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
                    $consultaProductosEnPedido = "SELECT P.Nombre, P.Precio, PF.Cantidad
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
                                </tr>";

                        while ($productoEnPedido = $resultadoProductosEnPedido->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $productoEnPedido['Nombre'] . "</td>
                                    <td>" . $productoEnPedido['Precio'] . " €</td>
                                    <td>" . $productoEnPedido['Cantidad'] . "</td>
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
