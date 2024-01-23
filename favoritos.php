<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Favoritos</title>
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/favoritos.css"> <!-- Asume que tienes un archivo CSS para favoritos -->
</head>

<body>
    <div id="body">
        <?php include('cabecera.php'); ?>

        <section>
            <h1>Mis Productos Favoritos</h1>

            <?php
            // Asegúrate de tener una sesión iniciada y una conexión a la base de datos
            //session_start();
            include('conexion.php');

            // Obtener el ID del usuario a partir del nombre en la sesión
            $nombre_usuario = $_SESSION["cliente"];
            $consultaUsuario = "SELECT ID FROM Usuarios WHERE Nombre = '$nombre_usuario'";
            $resultadoUsuario = $conexion->query($consultaUsuario);
            $filaUsuario = $resultadoUsuario->fetch_assoc();
            $usuario_id = $filaUsuario['ID'];

            // Obtener los productos favoritos del cliente desde la base de datos
            $consultaFavoritos = "SELECT P.ID, P.Nombre, P.Imagen, P.Precio, P.Descripcion 
                                  FROM Favoritos F
                                  JOIN Productos P ON F.ProductoID = P.ID
                                  WHERE F.UsuarioID = $usuario_id";
            $resultadoFavoritos = $conexion->query($consultaFavoritos);

            if ($resultadoFavoritos->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>Producto</th>
                            <th>Imagen</th>
                            <th>Precio</th>
                            <th>Descripción</th>
                        </tr>";

                while ($favorito = $resultadoFavoritos->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $favorito['Nombre'] . "</td>
                            <td><img src='" . $favorito['Imagen'] . "' alt='" . $favorito['Nombre'] . "' /></td>
                            <td>" . $favorito['Precio'] . " €</td>
                            <td>" . $favorito['Descripcion'] . "</td>
                          </tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No tienes productos favoritos.</p>";
            }
            ?>

        </section>

        <?php include('pie.php'); ?>
    </div>
</body>

</html>
