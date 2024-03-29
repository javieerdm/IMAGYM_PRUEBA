<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de productos</title>
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/articulos.css">
    <script>

    </script>
</head>

<body>
    <div id="body">
        <?php include('cabecera.php');
        include('conexion.php'); ?>

        <section>
            <div id="articulos">

                <div id="derecha">
                    <?php
                    $terminoBusqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
                    if ($terminoBusqueda != '') {
                        $consultalista = "SELECT * FROM productos WHERE Nombre LIKE '%$terminoBusqueda%'";
                    } else {

                        if (isset($_GET['genero']) && isset($_GET['categoria'])) {
                            $generos = $_GET['genero'];
                            $categoria = $_GET['categoria'];
                            $consultalista = "SELECT *
                            FROM productos where GeneroID='$generos' && CategoriaID='$categoria'";
                        } else if (isset($_GET['genero'])) {
                            $generos = $_GET['genero'];
                            $consultalista = "SELECT *
                            FROM productos where GeneroID='$generos'";
                        } else if (isset($_GET['categoria'])) {
                            $categoria = $_GET['categoria'];
                            $consultalista = "SELECT *
                            FROM productos where CategoriaID='$categoria'";
                        } else {
                            $consultalista = "SELECT *
                            FROM productos";
                        }
                    }

                    $resultadolista = mysqli_query($conexion, $consultalista);
                    ?>
                    <div id="productos">
                        <h1>
                            PRODUCTOS
                        </h1>
                    </div>

                    <?php while ($registrolista = mysqli_fetch_row($resultadolista)) { ?>
                        <div id="producto">
                            <a href="detalles.php?ProductoID=<?php echo $registrolista[0]; ?>" id="detalle-producto">
                                <div id="producto1">
                                    <!--Muestra la imagen del articulo-->
                                    <div id="prenda">
                                        <img src="<?php echo $registrolista[2]; ?>"></img>
                                    </div>
                                    <br>
                                    <!--Muestra  el nombre del articulo-->
                                    <div id="art">
                                        <?php echo $registrolista[1]; ?>
                                    </div>
                                    <div id="coste">
                                        <!--Muesta el precio -->
                                        <div id="precio">
                                            <b>Precio: <?php echo $registrolista[3] . " €"; ?></b>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <br>
        </section>
        <br>
        <?php include('pie.php'); ?>
    </div>
</body>

</html>
