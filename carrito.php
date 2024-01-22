<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Añade productos a tu cesta </title>
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/carrito.css">
</head>

<body>
    <div id="body">

        <?php include('cabecera.php'); ?>

        <section>
            <?php

            //Si no existe el cliente
            if (!isset($_SESSION['codusuario'])) {
                echo "<script type='text/javascript'>alert('Debes registrarte o iniciar sesión para realizar una compra');</script>";
                echo "<script type='text/javascript'>window.location.href='registro.php';</script>";
            }
            //Si existe el cliente
            else {
                $cliente = $_SESSION["codusuario"];

                $tam_carrito = 0;

                if (isset($_COOKIE['carrito'])) {
                    $carritoaux = $_COOKIE['carrito'];
                    $carrito = unserialize($carritoaux);
                    $tam_carrito = sizeof($carrito);
                }
                //SI EL CARRITO ESTA VACIO
                if ($tam_carrito == 0) {
                    echo "<div class='CARRITO VACIO'>
										<h1>Tu carrito está vacío....</h1>
										<br>
										<h1>¿A qué esperas? <br>Encuentra tus artículos favoritos entre las mejores ofertas</h1>									
									</div>";
                } else {
                    echo "<h1>Carrito de Compras</h1>";

                    echo "<table id='celdas' width='90%' border='1' align='center'>
                        <tr>
                            <th>Producto</th>
                            <th>Nombre</th>
                            <th>Precio Unitario</th>
                            <th>Talla</th>
                            <th>Cantidad</th>
                            <th>Precio total</th>

                        </tr>";
                    
foreach ($carrito as $clave_carrito => $detalles) {

    list($producto_id, $talla_producto) = explode('_', $clave_carrito);


    $consulta = "select * from productos where ID=$producto_id";
    $resultado = $conexion->query($consulta);

    while ($registro = $resultado->fetch_assoc()) {
        echo "<tr align='center'>";
        echo "<td> <img width='70' src=" . $registro['Imagen'] . "></img></td>";
        echo "<td>" . $registro['Nombre'] . "</td>";
        echo "<td>" . $registro['Precio'] . " € </td>";
        $tallaParaMostrar = isset($detalles['talla']) && $detalles['talla'] != '' ? $detalles['talla'] : 'N/A';
        echo "<td>" . $tallaParaMostrar . "</td>"; // Mostrar talla o 'N/A'
        echo "<td>";
        echo "<form method='post' action='actualizar-carrito.php'>";
        echo "<input type='hidden' name='producto_id' value='" . $registro['ID'] . "'>";
        echo "<input type='hidden' name='talla' value='" . $detalles['talla'] . "'>";
        echo "<input type='hidden' name='accion' value='incrementar'>";
        echo "<button type='submit' class='btn-incrementar' name='submit'>+</button>";
        echo "</form>";
        echo $carrito[$clave_carrito]['cantidad'];
        echo "<form method='post' action='actualizar-carrito.php'>";
        echo "<input type='hidden' name='producto_id' value='" . $registro['ID'] . "'>";
        echo "<input type='hidden' name='talla' value='" . $detalles['talla'] . "'>";
        echo "<input type='hidden'  class='btn-decrementar' name='accion' value='decrementar'>";
        echo "<button type='submit' name='submit'>-</button>";
        echo "</form>";
        echo "</td>";
        echo "<td>" . $registro['Precio'] * $carrito[$clave_carrito]['cantidad'] . " € </td>";
        echo "<td>
                <a href=./borrar-cesta.php?productoId=" . $clave_carrito . ">
                    <button id='botonx' type='reset' title='eliminar'><img width='20' src='imagenes/papelera.jpg'></button>
                </a>
            </td>";
        echo "</tr>";
    }
}

                    

                    echo "</table>";

                    // Calcular la cantidad total
                    $total_amount = 0;

                    foreach ($carrito as $clave_carrito => $cantidad) {
                        $consulta = "select * from productos where ID=$producto_id";
                        $resultado = $conexion->query($consulta);

                        while ($registro = $resultado->fetch_assoc()) {
                            $total_amount += $registro['Precio'] * $carrito[$clave_carrito]['cantidad'];
                        }
                    }

                    echo "<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post' id='form_pay'>
                        <!-- Valores requeridos -->
                        <input type='hidden' name='business' value='sb-gngo228196001@business.example.com'>
                        <input type='hidden' name='cmd' value='_xclick'>
                        <input type='hidden' name='currency_code' value='EUR'>
                        <input type='hidden' name='return' value='http://localhost/IMAGYM/crear-factura.php'>
                        <input type='hidden' name='cancel_return' value='http://localhost/IMAGYM/pago_cancelado.php'>
                        
                        <!-- Valores calculados -->
                        <input type='hidden' name='item_name' value='Productos en el carrito'>
                        <input type='hidden' name='amount' value='$total_amount'>
                        <input type='hidden' name='quantity' value='1'>
                        
                        <hr>
                        <button id='boton' class='terminar' type='submit'>Pagar ahora con Paypal</button>
                    </form>";
                    
                    echo "<tr>
                       <td colspan='4' align='right'><b>Total:</b></td>
                            <td><b>" . $total_amount . " € </b></td>
                              </tr>";
                }
            }

            

            echo "<br>";
            echo "<br>";

            ?>
        </section>

        <?php include('pie.php'); ?>
    </div>
</body>

</html>
