<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabecera de página</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace a tu archivo CSS personalizado -->
    <link rel="stylesheet" href="css/cabecera.css">
</head>
<body>
<?php
    include ('conexion.php');
?>
<header>
    <div class="container-fluid bg-light">
        <div class="row align-items-center">
            <div class="col-md-4">
                <h6 id="camion">
                    <img width='40' src='imagenes/camion.jpg'>&nbsp ENVÍO GRATIS A PARTIR DE 50€
                </h6>
            </div>
            <div class="col-md-4 text-center">
                <a href="index.php" class="navbar-brand">
				<img src="./imagenes/logotipo.png" alt="Logo" title="Ir a inicio" class="img-fluid" style="max-width: 200px;">
                </a>
            </div>
            <div class="col-md-4 text-right">
                <div class="dropdown">
                    <?php if(!isset($_SESSION["cliente"])): ?>
                        <a class="nav-link" href="registro.php">Registro</a>
                    <?php endif; ?>
                    <?php if(isset($_SESSION["cliente"])): ?>
                        <?php if($_SESSION["rol"] == 'administrador'): ?>
                            <a class="nav-link" href="basedatos.php">Base de datos</a>
                        <?php endif; ?>
                        <a class="nav-link" href="cerrar.php">Cerrar sesión</a>
                    <?php else: ?>
                        <form class="form-inline" action="insertarcliente.php" method="POST">
                            <input class="form-control mr-2" type="text" name="usu" placeholder="Email">
                            <input class="form-control mr-2" type="password" name="pass" placeholder="Contraseña">
                            <button class="btn btn-primary" type="submit">Entrar</button>
                        </form>
                    <?php endif; ?>
                    <form class="form-inline" action="producto.php" method="GET">
                        <input class="form-control mr-2" type="text" id="busqueda" name="busqueda" placeholder="Buscar productos...">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </form>
                    <a class="nav-link" href="contacto.php"><img src="imagenes/sobre.png" alt="Contacto" class="icon"> Contacto</a>
                    <?php if(isset($_SESSION["codusuario"]) && isset($_SESSION["rol"]) && $_SESSION["rol"] == 'cliente'):$cliente=$_SESSION["codusuario"]; ?>
                        <a class="nav-link" href="carrito.php"><img src="imagenes/carrito.png" alt="Cesta" class="icon"> Cesta</a>
                        <a class="nav-link" href="pedidos.php"><img src="imagenes/pedido.jpg" alt="Pedidos" class="icon"> Pedidos</a>
                        <a class="nav-link" href="favoritos.php"><img src="imagenes/favoritos.png" alt="Favoritos" class="icon"> Favoritos</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Menú horizontal -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="producto.php">Ver todos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="producto.php?categoria=1">Ropa deportiva</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="producto.php?categoria=4">Suplementos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="producto.php?categoria=2">Material</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="producto.php?categoria=3">Máquinas</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Enlace a Bootstrap JS y jQuery (al final del body) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
