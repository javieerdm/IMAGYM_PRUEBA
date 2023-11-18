<?php
session_start();
?>

<?php

// Incluir la conexión y la clase

include('conexion.php');

class CrearFactura
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function crearFactura($cliente)
    {
        // Obtener datos del carrito desde la cookie
        if (isset($_SESSION['carrito'])) {
            $carritoaux = $_SESSION['carrito'];
            $carrito = unserialize($carritoaux);

            // Insertar datos en la tabla Facturas
            $fechaCompra = date('Y-m-d');
            $precioTotal = $this->calcularPrecioTotal($carrito);
            $insertFactura = "INSERT INTO Facturas (ClienteID, FechaCompra, PrecioTotal) VALUES ('$cliente', '$fechaCompra', '$precioTotal')";
            $this->conexion->query($insertFactura);

            // Obtener el ID de la factura recién creada
            $facturaID = $this->conexion->insert_id;

            // Insertar datos en la tabla ProductosEnFacturas
            foreach ($carrito as $productoID => $cantidad) {
                $insertProductosEnFacturas = "INSERT INTO ProductosEnFacturas (FacturaID, ProductoID, Cantidad) VALUES ('$facturaID', '$productoID', '$cantidad')";
                $this->conexion->query($insertProductosEnFacturas);
            }

            // Eliminar la cookie del carrito después de crear la factura
            setcookie('carrito', serialize($carrito), time() + 3600, '/');
        }
    }

    private function calcularPrecioTotal($carrito)
    {
        $total_amount = 0;

        foreach ($carrito as $productoID => $cantidad) {
            $consulta = "SELECT Precio FROM productos WHERE ID = '$productoID'";
            $resultado = $this->conexion->query($consulta);

            if ($registro = $resultado->fetch_assoc()) {
                $total_amount += $registro['Precio'] * $cantidad;
            }
        }

        return $total_amount;
    }
}

// include('conexion.php');
include('crear-factura.php');

// Crear una instancia de la clase
$crearFactura = new CrearFactura($conexion);

// Obtener el ID del cliente desde la sesión
$clienteID = $_SESSION['codusuario'];

// Llamar al método para crear la factura
$crearFactura->crearFactura($clienteID);

// Actualizar la variable de sesión
$_SESSION['carrito'] = $carrito;

// Redirigir a una página de éxito 
header('Location: pagoconexito.php');

?>