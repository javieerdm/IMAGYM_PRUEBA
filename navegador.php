<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado por categoria y genero</title>
    <link rel="stylesheet" href="navegador.css">

</head>

<body><!-- navegador section parte izquierda-->

    <div id="izquierda">

        <div id="buscador">
            <form class="ordenar" method="GET">
                Buscar por:<br><br>

                <ul class="ordenar"><a href="producto.php?categoria=1">Ropa Deportiva</a>
                    <li class="ordenar"><a href="producto.php?genero=1">Camisetas</a></li>
                    <li class="ordenar"><a href="producto.php?genero=2">Pantalones</a></li>
                    <li class="ordenar"><a href="producto.php?genero=3">Zapatillas</a></li>
                </ul>
                <ul class="ordenar"><a href="producto.php?categoria=2">Material</a>
                    <li class="ordenar"><a href="producto.php?genero=4">Mancuernas</a></li>
                    <li class="ordenar"><a href="producto.php?genero=5">Gomas</a></li>
                    <li class="ordenar"><a href="producto.php?genero=6">Barras</a></li>
                </ul>
                <ul class="ordenar"><a href="producto.php?categoria=3">Máquinas</a>
                    <li class="ordenar"><a href="producto.php?genero=7">Cardio</a></li>
                    <li class="ordenar"><a href="producto.php?genero=8">Rack</a></li>
                    <li class="ordenar"><a href="producto.php?genero=9">Musculación</a></li>
                </ul>
                <ul class="ordenar"><a href="producto.php?categoria=4">Suplementos</a>
                    <li class="ordenar"><a href="producto.php?genero=10">Proteina</a></li>
                    <li class="ordenar"><a href="producto.php?genero=11">Creatina</a></li>
                    <li class="ordenar"><a href="producto.php?genero=12">Pre-Entreno</a></li>
                </ul>
                <br>
            </form>

        </div>
        <div id="ofertas">
            <a href="rebajados.php">
                <h1>OUTLET</h1>
                <h4>Artículos rebajados hasta el 50%</h4>
            </a>
            <br>
        </div>
    </div>
</body>

</html>