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
						<img width='40' src='imagenes/camion.jpg'>&nbsp ENVÍO GRATIS A PARTIR DE 70€	
					</h6></font>
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
									if($_SESSION["administrador"]=='SI'){
										echo "Administrador";
										echo "<button class='boton'><a href='cerrar.php'>Cerrar sesión</a></button>";
										echo "<button class='boton'><a href='basedatos/crud.php'>Base de datos</a></button>";
									}																
									else{
										echo "Hola " . $_SESSION["cliente"];
										echo "<button class='boton'><a href='cerrar.php'>Cerrar sesión</a></button>";										
									}
								}
							?>
							</form>
						</div>
						
						<hr class="linea1">
						
						
					<!--contacto, registro, carrito-->						
						<div id="contacto">
							<nav id="A">
								<ul>
									<li><a href="contacto.php"><img src="imagenes/sobre.png"> Contacto</a><li>
									<li><a href="registro.php"><img src="imagenes/usuario.png"> Registro</a><li>
									<?php 
									
										if(isset($_SESSION["codusuario"])){
											if($_SESSION["administrador"]=='SI'){}										
											else{												
												$cliente=$_SESSION["codusuario"];
												
												$consultac="Select NºPEDIDO from carro where CODUSU='$cliente'";
												$resultadoc=mysqli_query($conexion, $consultac);
												$nregistroc=mysqli_num_rows($resultadoc);
												
												

												$consultap="Select NºFACTURA from pedidos where CODUSU='$cliente'";
												$resultadop=mysqli_query($conexion, $consultap);
												$registrop=mysqli_fetch_row($resultadop);
												
												echo "<li><a href='carrito.php'><img src='imagenes/carrito.png'>Mi cesta ($nregistroc)</a><li>";												
												if($registrop[0]!=0){
													echo "<li><a href='pedidos.php'><img src='imagenes/pedido.jpg'> Mis pedidos</a><li>";
												}else{}
											}
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
							<li><a href="vertodo.php">Ver todos</a></li>
							<li><a href="banadores.php">Bañadores</a></li>
							<li><a href="equipacion.php">Equipación</a></li>
							<li><a href="material.php">Material Entreno</a></li>
							<li><a href="aguasabiertas.php">Aguas abiertas</a></li>
							<li><a href="rebajados.php">Outlet</a></li>
						</ul>
					</nav>				
				</div>
			
			
			</div>
		</header>
	</body>
</html>