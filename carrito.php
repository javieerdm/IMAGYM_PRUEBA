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



                if (!isset($_COOKIE['carrito'])) {
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

                    $carritoaux = $_COOKIE['carrito'];
                    $carrito = unserialize($carritoaux);

                    echo "<p>", sizeof($carrito), "</p>";

                    echo "<h2>Carrito de Compras</h2>";

                    echo "<table border='1'>
                        <tr>
                            <th>Producto</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                        </tr>";

                    foreach ($carrito as $producto_id => $cantidad) {
                        $consulta = "select * from productos where ID=$producto_id";
                        $resultado = $conexion->query($consulta);

                        while ($registro = $resultado->fetch_assoc()) {

                            echo "<tr>";
                            echo "<td> <img src=".$registro['Imagen']."></img></td>";
                            echo "<td>" . $registro['Nombre'] . "</td>";
                            echo "<td>" . $registro['Precio'] . "</td>";
                            echo "<td>" . $carrito[$registro['ID']] . "</td>";
                        }
                    }

                    echo "</table>";


                    echo "<div id='articulos'>
									<br>	
									<h1>Cesta</h1>					
									<hr class='linea2'><br>
									
									<div id='derecha'>";

                    echo
                    "<table id='celdas' width='90%' border='1' align='center'>
												<tr>												
													<th colspan='3'>Producto</th>													
													<th>Descuento</th>
													<th colspan='1'>Precio</th>													
													<th>Total</th>
													
												</tr>";
                    while ($registrocarro = mysqli_fetch_row($resultadocarro)) {

                        echo "<tr align='center' >";

                        //Muestra la referencia
                        echo "<td>Ref: $registrocarro[1]</td>";

                        //Muestra el precio original
                        echo "<td><img width='70' src='$registrocarro[2]'></img></td>												
														<td class='nombre'><a href='detalles.php?referencia=$registrocarro[1]'>$registrocarro[3]</a></td>";

                        //Muestra el tipo de descuento
                        if ($registrocarro[8] != 0) {
                            echo "<td>$registrocarro[8] %</td>";
                        } else {
                            echo "<td></td>";
                        }


                        //Si las rebajas es distinto de 0, muestra el precio rebajado en rojo
                        if ($registrocarro[5] != 0) {
                            echo "<td align='right'>
															<strike><font size='1px'>$registrocarro[4] €</font></strike>&nbsp
															<font color='red'>$registrocarro[5] €</font>
														</td>";
                        } else {
                            echo "<td align='right'>$registrocarro[4] €</td>";
                        }

                        //Importe total del producto
                        echo "<td>$registrocarro[9] €</td>";

                        //eliminar articulo
                        echo "<td>
														<a href='borrarcompra.php?referencia=$registrocarro[0]&cliente=$registrocarro[6];' >
															<button id='botonx' type='reset' title='eliminar'><img width='20' src='imagenes/papelera.jpg'></button>
														</a>
													</td>";

                        echo "</tr><br>";
                    }

                    echo "</table><br><br><br>
											
											<hr class='linea2'><br>";

                    $consultaimporte = "Select SUM(PRECIO), SUM(REBAJAS), SUM(TOTAL), CODUSU, PRECIO, 
											DESCUENTO, SUM(AHORRO) FROM carro WHERE CODUSU='$codigo'";
                    $resultadoimporte = mysqli_query($conexion, $consultaimporte);
                    $registroimporte = mysqli_fetch_row($resultadoimporte);

                    if (isset($registroimporte[0])) {
                        echo "<span class='envio'><img width='40' src='imagenes/camion.jpg'>&nbsp Gastos de envío <font color='blue'>GRATIS</font> a partir de 70€</span>";

                        //Mostramos la facturación si hay productos comprados										
                        echo "<p class='factura'>Importe(sin descuentos):$registroimporte[0] €</p><br>";


                        //mostramos el ahorro												
                        if ($registroimporte[6] != 0) {
                            echo "<p class='factura'>Ahorras en tu compra:<font color='red'> $registroimporte[6] €</font></p><br>";
                        }

                        //Calculamos el IVA correspondiente al precio original
                        $Iva = $registroimporte[0] * 21 / 100;
                        $iva = number_format($Iva, 2);
                        echo "<p class='factura'>IVA (21%): $iva €</p><br>";

                        //Calculamos los gastos de envio: si el importe es menor de 100€, paga 5.99€ más
                        $gastosenvio = 0;
                        if ($registroimporte[2] < 70) {
                            $gastosenvio = 5.99;
                            echo "<p class='factura'>Gastos de envio: $gastosenvio €</p><br>";
                        } else {
                            echo "<p class='factura'>Gastos de envio: gratis</p><br>";
                        }

                        //Calculamos el importe a pagar
                        $pagar = $registroimporte[2] + $gastosenvio;
                        $pagar1 = number_format($pagar, 2);
                        echo "<p class='factura'><strong>IMPORTE A PAGAR: $pagar1 €</strong></p>";

                        //Terminamos el pedido

                        echo "<p>
													<a class='terminar' href='validarcompra.php'>
														<button id='boton' type='reset'>Terminar mi pedido</button>
													</a>
												</p>
													
												<br><br><br>
											
												<p class='seguir'><a href='vertodo.php'>Seguir comprando</a></p><br><br>
											
												<br><br>";
                    }
                    echo
                    "</div>
								</div>";
                }
            }

            ?>

        </section>
        <?php include('pie.php'); ?>
    </div>
</body>

</html>