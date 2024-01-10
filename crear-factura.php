<?php
session_start();
?>

<?php
// Incluir la conexión y la clase
//include('crear-factura.php');

include('conexion.php');

//$productoID = $_GET['ProductoID'];
$clienteID = $_SESSION['codusuario'];
//$cantidad =$_GET['cantidad'];


if (isset($_COOKIE['carrito'])) {
	$carritoaux = $_COOKIE['carrito'];
    $carrito = unserialize($carritoaux);

	// Insertar datos en la tabla Facturas
	$fechaCompra = date('Y-m-d');

	$total_amount = 0;

	foreach ($carrito as $clave_carrito => $detalles) {
		list($producto_id, $talla_producto) = explode('_', $clave_carrito);

		$consulta = "SELECT * FROM Productos where ID=$producto_id";
		$resultado = $conexion->query($consulta);

		while ($registro = $resultado->fetch_assoc()) {
			$total_amount += $registro['Precio'] * $detalles['cantidad'];
		}
	}
	//$precioTotal = calcularPrecioTotal($carrito);
	$insertFactura = "INSERT INTO Facturas (ClienteID, FechaCompra, PrecioTotal) VALUES ('$clienteID', '$fechaCompra', '$total_amount')";
	$resultado2 = $conexion->query($insertFactura);

	// Obtener el ID de la factura recién creada
	$facturaID = $conexion->insert_id;

	// Insertar datos en la tabla ProductosEnFacturas
	foreach ($carrito as $clave_carrito => $detalles) {
		list($producto_id, $talla_producto) = explode('_', $clave_carrito);
		$talla_producto_escaped = $conexion->real_escape_string($talla_producto);

		$insertProductosEnFacturas = "INSERT INTO ProductosEnFacturas (FacturaID, ProductoID, Cantidad, Talla) VALUES ('$facturaID', '$producto_id', '{$detalles['cantidad']}','$talla_producto_escaped')";
		$resultado3 = $conexion->query($insertProductosEnFacturas);
	}
}

// Eliminar la cookie del carrito después de crear la factura
setcookie('carrito', serialize($carrito), time() - 3600, '/');

// Actualizar la variable de sesión
//$_SESSION['carrito'] = $carrito;

// Redirigir a una página de éxito 
header('Location: pagoconexito.php');

?>