<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de productos</title>
    <link rel="stylesheet" href="principal.css">
    <link rel="stylesheet" href="articulos.css">
    <script>


    </script>

</head>

<body>
    <div id="body">

        <?php include('cabecera.php'); ?>

        <section>
            <div id="articulos">
                <!--izquierda-->
                <?php include('navegador.php'); ?>

                <!--derecha-->
                <div id="derecha">
                    <h6 class="volver"><a href="javascript:history.go(-1)"><img title="Volver atrás" src="imagenes/volver.jpg"></img></a></h6>

                    <?php

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

                    $resultadolista = mysqli_query($conexion, $consultalista);

                  //  $total_registros = mysqli_num_rows($resultadolista);


                    ?>
                    <div id="productos">
                        <h1>
                            PRODUCTOS
                        </h1>
                    </div>

                    <?php while ($registrolista = mysqli_fetch_row($resultadolista)) { ?>
                        <div id="producto">

                            <a href="detalles.php?referencia=<?php echo $registrolista[0]; ?>">
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

                                        <!--Muesta el precio original tachado si está rebajado-->
                                        <div id="precio">
                                            <b>Precio: <?php echo $registrolista[3] . " €"; ?></b>
                                        </div>                                        
                                    </div>
                                    <button id="boton" type="submit">
                                        <a href='comprar.php?referencia=<?php echo $registrolista[5]; ?>'>Comprar</a>
                                    </button>
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