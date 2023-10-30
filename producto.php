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

                           
                                <div id="producto1">

                                    <!--Muestra la imagen del articulo-->
                                    <a href="detalles.php?ProductoID=<?php echo $registrolista[0]; ?>">
                                    <div id="prenda">
                                        <img src="<?php echo $registrolista[2]; ?>"></img>
                                    </div>
                                    </a>
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
                                    <form method='POST' <?php if (isset($_SESSION['usuario'])) { ?> action='PHP/añadir-cesta.php?ProductoID=<?php echo $registrolista[0]; ?>' <?php } else { ?> action='login.php' <?php } ?>target='_self'>
                                    <label>
                                        Cantidad
                                    </label>
                                    <input type='number' name='cantidad' min='<?php if ($registrolista[4] > 0) {
                                                                                    echo "1";
                                                                                } else {
                                                                                    echo "0";
                                                                                } ?>' max='<?php echo $registrolista[4]; ?>' value='<?php if ($registrolista[4] > 0) {
                                                                                                                                        echo "1";
                                                                                                                                    } else {
                                                                                                                                        echo "0";
                                                                                                                                    } ?>' />
                                   
                                    <input type="submit" id="boton" value="COMPRAR">
                                   
                                </form>
                                    <br><br>
                                </div>
                            
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

