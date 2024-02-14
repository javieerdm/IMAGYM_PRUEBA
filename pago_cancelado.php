<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Añade productos a tu cesta </title>
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/carrito.css">

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

        <h1>Pedido cancelado</h1> <br>
        <h2>El pedido fue cancelado, vuelve a la página de compra haciendo click en el siguiente botón </h2>


        <form action="index.php" method="post">
            <button id='boton' type="submit" name="finalizar">Finalizar</button>
        </form>

    </div>
</body>

</html>
