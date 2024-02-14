<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Listado por categoría y género</title>
    <link rel="stylesheet" href="css/navegador.css">
</head>
<body>
    <div id="izquierda">
        <div id="buscador">
            <form class="ordenar" method="GET">
                Buscar por:<br><br>

                <div class="categoria">
                    <a href="producto.php?categoria=1">Ropa Deportiva</a>
                    <div class="sub-categoria">
                        <a href="producto.php?genero=1">Camisetas</a>
                        <a href="producto.php?genero=2">Pantalones</a>
                        <a href="producto.php?genero=3">Zapatillas</a>
                    </div>
                </div>
                <div class="categoria">
                    <a href="producto.php?categoria=2">Material</a>
                    <div class="sub-categoria">
                        <a href="producto.php?genero=4">Mancuernas</a>
                        <a href="producto.php?genero=5">Gomas</a>
                        <a href="producto.php?genero=6">Barras</a>
                    </div>
                </div>
                <div class="categoria">
                    <a href="producto.php?categoria=3">Máquinas</a>
                    <div class="sub-categoria">
                        <a href="producto.php?genero=7">Cardio</a>
                        <a href="producto.php?genero=8">Rack</a>
                        <a href="producto.php?genero=9">Musculación</a>
                    </div>
                </div>
                <div class="categoria">
                    <a href="producto.php?categoria=4">Suplementos</a>
                    <div class="sub-categoria">
                        <a href="producto.php?genero=10">Proteina</a>
                        <a href="producto.php?genero=11">Creatina</a>
                        <a href="producto.php?genero=12">Pre-Entreno</a>
                    </div>
                </div>                
            </form>
        </div>
    </div>
</body>
</html>
