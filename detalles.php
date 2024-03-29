<?php
// Lugar para comprobar y mostrar el mensaje de error.
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']); // Limpia el mensaje de error para futuras peticiones
}

include('conexion.php');
// ... Resto del código PHP antes del HTML ...
?>
<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Detalles de los productos</title>
		<link rel="stylesheet" href="css/principal.css">
		<link rel="stylesheet" href="css/detalles.css">
		
	</head>	
	<body>
		<div id="body">		
		
			<?php include('cabecera.php');?>
			
			<section>	
				<div id="articulos">
				
					
					
					<div id="derecha">
					<h6 class="volver"><a href="javascript:history.go(-1)"><img title="Volver atrás" src="imagenes/volver.jpg"></img></a></h6>
							
						<?php
						
							$ProductoID=$_GET["ProductoID"];
								
							$consultadetalles="SELECT * FROM productos WHERE ID='$ProductoID'";
							$resultadodetalles=mysqli_query($conexion, $consultadetalles);
							
							
							while ($registrodetalles=mysqli_fetch_row($resultadodetalles)){?>					
						
						
							<div id="producto">							
								<br>
								
	
								<br><br>

								<!--Muestra la imagen del articulo-->
								<div id="prenda"><img src="<?php echo $registrodetalles[2];?>"></img></div>
							</div>
							
							<div id="detalles">
							
								<!--Muestra el nombre del articulo-->
								<p id="art"><b><?php echo $registrodetalles[1];?></b></p>

								<!--Muestra la descripción del articulo-->
								<p id="descripcion"><b><?php echo $registrodetalles[7];?></b></p>
								
								<!--Muestra el precio del articulo-->
								
								<p id="precio"><b>Precio: <?php echo $registrodetalles[3] . " €";?></b></p>


								<form method='POST' action='<?php echo isset($_SESSION["cliente"]) ? "./añadir-favoritos.php?ProductoID=" . $registrodetalles[0] : "registro.php"; ?>' target='_self'>
									<button type='submit' id='boton-favoritos' style="background:none; border:none; padding:0; margin:0;">
										<img src='./imagenes/añadirFavoritos.png' alt='Favoritos' style="vertical-align: middle;"/> AÑADIR A FAVORITOS
									</button>
								</form>

																	
								
								<button id="comprar" type="submit">
								<form method='POST' action='<?php echo isset($_SESSION['cliente']) ? "./añadir-cesta.php?ProductoID=" . $registrodetalles[0] : "registro.php"; ?>' target='_self'>
   							 <label>Cantidad</label>
								<input type='number' name='cantidad' min='1' max='<?php echo $registrodetalles[4]; ?>' value='1' required />
    
									<!-- Sección de tallas -->
									<?php
									$consultaTallas = "SELECT Talla FROM Tallas INNER JOIN ProductoTallas ON Tallas.ID = ProductoTallas.TallaID WHERE ProductoTallas.ProductoID = $ProductoID";
									$resultadoTallas = mysqli_query($conexion, $consultaTallas);

									if (mysqli_num_rows($resultadoTallas) > 0) { // Comprueba si hay tallas disponibles
										echo "<label for='talla'>Talla:</label>";
										echo "<select name='talla' id='talla'>";
										while ($talla = mysqli_fetch_assoc($resultadoTallas)) {
											echo "<option value='{$talla['Talla']}'>{$talla['Talla']}</option>";
										}
										echo "</select>";
									}
									?>

									<input type="submit" id="boton" value="COMPRAR">
								</form>


							</div>
							<br><br>	
																	
						<?php } ?>
					</div>
				</div>	
			</section>
			
			<?php include('pie.php');?>	
		</div>
	</body>
</html>