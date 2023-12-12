<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Añade productos a tu cesta </title>
    <link rel="stylesheet" href="principal.css">
    <link rel="stylesheet" href="carrito.css">

    <style>
        h1 {
            color: black;
            font-size: 20px;
            font-weight: bold;
        }

        h2 {
            color: black;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div id="body">

        <?php include('cabecera.php'); ?>

        <h1>¡SU PEDIDO HA SIDO PROCESADO!</h1> <br>
        <h2>Su pedido ha sido realizado con éxito. ¡Gracias por confiar en nosotros! Su pedido llegará en 3-4 días laborables.</h2>


        <form action="index.php" method="post">
            <button id='boton' type="submit" name="finalizar">Finalizar</button>
        </form>

    </div>
</body>

</html>
