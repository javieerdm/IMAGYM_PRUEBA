<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Añade productos a tu cesta </title>
    <link rel="stylesheet" href="principal.css">
    <link rel="stylesheet" href="carrito.css">
</head>

<body>
    <div id="body">

        <?php include('cabecera.php'); ?>

        <section>
            <?php

            //Si no existe el cliente, muestra cesta vacía
            if (!isset($_SESSION['codusuario'])) {
                echo "<script type='text/javascript'>alert('Debes registrarte o iniciar sesión para realizar una compra');</script>";
                echo "<script type='text/javascript'>window.location.href='registro.php';</script>";
            }
            //Si existe el cliente, muestra la compra
            else {
                $cliente = $_SESSION["codusuario"];

                $tam_carrito = 0;

                if (isset($_COOKIE['carrito'])) {
                    $carritoaux = $_COOKIE['carrito'];
                    $carrito = unserialize($carritoaux);
                    $tam_carrito = sizeof($carrito);
                }

                if ($tam_carrito == 0) {
                    echo "<div class='CARRITO VACIO'>
										<h1>Tu carrito está vacío....</h1>
										<br>
										<h1>A qué esperas caraculo... <br>Encuentra tus artículos favoritos entre las mejores ofertas</h1>									
										<div id='etiquetas'>											
											<a href='bañadores.php'><div id='bañador' title='Ir a la tienda'></div></a>
											<a href='equipacion.php'><div id='equipo' title='Ir a la tienda'></div></a>										
											<a href='material.php'><div id='entreno' title='Ir a la tienda'></div></a>
											<a href='aguasabiertas.php'><div id='neopreno' title='Ir a la tienda'></div></a>												
										</div>
									</div>";
                } else {
                    echo "<h2>Carrito de Compras</h2>";

                    echo "<table id='celdas' width='90%' border='1' align='center'>
                        <tr>
                            <th>Producto</th>
                            <th>Nombre</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Precio Total</th>
                        </tr>";

                    foreach ($carrito as $producto_id => $cantidad) {
                        $consulta = "select * from productos where ID=$producto_id";
                        $resultado = $conexion->query($consulta);

                        while ($registro = $resultado->fetch_assoc()) {
                            echo "<tr align='center'>";
                            echo "<td> <img width='70' src=" . $registro['Imagen'] . "></img></td>";
                            echo "<td>" . $registro['Nombre'] . "</td>";
                            echo "<td>" . $registro['Precio'] . " € </td>";
                            echo "<td>" . $carrito[$registro['ID']] . "</td>";
                            echo "<td>" . $registro['Precio'] * $carrito[$registro['ID']] . " € </td>";
                            echo "<td>
														<a href=./borrar-cesta.php?productoId=" . $producto_id . ">
															<button id='botonx' type='reset' title='eliminar'><img width='20' src='imagenes/papelera.jpg'></button>
														</a>
													</td>";
                        }
                    }

                    echo "</table>";

                    // Calcular la cantidad total
                    $total_amount = 0;

                    foreach ($carrito as $producto_id => $cantidad) {
                        $consulta = "select * from productos where ID=$producto_id";
                        $resultado = $conexion->query($consulta);

                        while ($registro = $resultado->fetch_assoc()) {
                            $total_amount += $registro['Precio'] * $carrito[$registro['ID']];
                        }
                    }

                    echo "<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post' id='form_pay'>
                        <!-- Valores requeridos -->
                        <input type='hidden' name='business' value='sb-gngo228196001@business.example.com'>
                        <input type='hidden' name='cmd' value='_xclick'>
                        <input type='hidden' name='currency_code' value='EUR'>
                        <input type='hidden' name='return' value='http://localhost/COMERCIO/IMAGYM/pagoconexito.php'>
                        <input type='hidden' name='cancel_return' value='http://localhost/COMERCIO/IMAGYM/pago_cancelado.php'>
                        
                        <!-- Valores calculados -->
                        <input type='hidden' name='item_name' value='Productos en el carrito'>
                        <input type='hidden' name='amount' value='$total_amount'>
                        <input type='hidden' name='quantity' value='1'>
                        
                        <hr>
                        <button id='boton' class='terminar' type='submit'>Pagar ahora con Paypal</button>
                    </form>";
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
