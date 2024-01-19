<!doctype html>
<?php
	session_start();
?>
	
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Cabecera de página</title>
		<link rel="stylesheet" href="cabecera.css">
	</head>	
	<body>
	<?php	
		include ('conexion.php');
	?>
		<header>
			<div id="header">
				<div id="principio">
					<h6 id="camion">
						<img width='40' src='imagenes/camion.jpg'>&nbsp ENVÍO GRATIS A PARTIR DE 50€	
					</h6>
				</div>
				<div id="cabecera_alta">
				
					<!-- LOGOTIPO -->
					
					<div id="logo">
						<a href="index.php"><div id="imagen" title="Ir a inicio"></div><a>						
					</div>
					<div id="caja2">
					
					
					<!-- LOGIN -->		
					
						<div id="usuario">
							<form action="insertarcliente.php" method="POST">
								
							<?php
								if(!isset($_SESSION["cliente"])){									
									echo "<input class='usuario' type='text' size='18' name='usu' placeholder='Email'>
									<input class='usuario' type='password' size='8' name='pass' placeholder='Contraseña'>									
									<button class='boton' type='submit'>Entrar</button>";									
								}
								if(isset($_SESSION["cliente"])){
									if($_SESSION["rol"]=='administrador'){
										echo "Administrador";
										echo "<button class='boton'><a href='cerrar.php'>Cerrar sesión</a></button>";
										echo "<button class='boton'><a href='basedatos.php'>Base de datos</a></button>";
										
									}																
									else{
										echo "Bienvenido " . $_SESSION["cliente"];
										echo "<button class='boton'><a href='cerrar.php'>Cerrar sesión</a></button>";										
									}
								}
							?>
							</form>
						</div>
						
						<hr class="linea1">
						
						
					<!--contacto, registro, carrito-->						
					<form action="producto.php" method="GET">
   									 <input type="text" id="busqueda" name="busqueda" placeholder="Buscar productos...">
    								  <button type="submit">Buscar</button>
									</form>
					<div id="contacto">

							<nav id="A">

								<ul>

									<li><a href="contacto.php"><img src="imagenes/sobre.png"> Contacto</a><li>
									<li><a href="registro.php"><img src="imagenes/usuario.png"> Registro</a><li>
									<?php

										if(isset($_SESSION["codusuario"]) && isset($_SESSION["rol"]) && $_SESSION["rol"] == 'cliente') {
									 			$cliente=$_SESSION["codusuario"];
										
												
												

										 		 $consultap="Select ID from facturas where ClienteID='$cliente'";
										 		 $resultadop=mysqli_query($conexion, $consultap);
										 		 $registrop=mysqli_fetch_row($resultadop);
												
										 		echo "<li><a href='carrito.php'><img src='imagenes/carrito.png'>Mi cesta </a><li>";												
										 		 	echo "<li><a href='pedidos.php'><img src='imagenes/pedido.jpg'> Mis pedidos</a><li>";
										 		
										}
									
									?>
								</ul>
							</nav>						
						</div>
					</div>
				</div>
				
				<!--Menú horizontal -->
				
				<div id="cabecera_baja">
					<nav>
						<ul id="B">
						<div class="menu-desplegable">
							<a href="javascript:void(0)">
								<img src="imagenes/menu.png" alt="Menú" />
							</a>
							<div class="contenido-desplegable">
								<!-- Aquí insertas el contenido de tu navegador.php -->
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
								</form>
							</div>
						</div>
							<li><a href="producto.php">Ver todos</a></li>
							<li><a href="producto.php?categoria=1">Ropa deportiva</a></li>
							<li><a href="producto.php?categoria=4">Suplementos</a></li>
							<li><a href="producto.php?categoria=2">Material </a></li>
							<li><a href="producto.php?categoria=3">Máquinas</a></li>
						</ul>
					</nav>				
				</div>
			
			
			</div>
		</header>
	</body>
</html>