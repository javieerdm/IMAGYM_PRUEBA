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
		
			<?php include('cabecera.php');?>
			
			<section>	
				<div id="articulos">
					<!--izquierda-->
					<?php include('navegador.php');?>
					
					<!--derecha-->
					<div id="derecha">
					<h6 class="volver"><a href="javascript:history.go(-1)"><img title="Volver atrás" src="imagenes/volver.jpg"></img></a></h6>
					
					<?php
						
                        
						$generos=$_GET['genero'];
                        $categoria=$_GET['categoria'];
							
						$consultalista="SELECT *
						FROM productos where GeneroID='$generos' && CategoriaID='$categoria'";
						$resultadolista=mysqli_query($conexion, $consultalista); 
								
						$total_registros=mysqli_num_rows($resultadolista);


						$consultagenero="Select CODIGO_GENERO, GENERO from genero WHERE CODIGO_GENERO='$generos'";
						$resultadogenero=mysqli_query($conexion, $consultagenero);
								
					?>
						<div id="titulo">
							<h1>
								<?php
									while ($registrogenero=mysqli_fetch_row($resultadogenero)){
										echo $registrogenero[1];
									}									
								?>
							
							</h1>
						</div>
						
						<?php while ($registrolista=mysqli_fetch_row($resultadolista)){?>													
						<div id="producto">
								
							<a href="detalles.php?referencia=<?php echo $registrolista[5];?>">	
								<div id="producto1">
								
									<!--Muesrtra el texto "REBAJADO" en rojo si lo está, y si no lo está,  pone un salto de línea-->
									<h5>	<?php if ($registrolista[4]=="SI"){
													echo "Rebajado"; 
												}else{
													echo "<br>";
												}
											?>
									</h5>									
									<!--Muestra la imagen del articulo-->
									<div id="prenda">																			
										<img src="<?php echo $registrolista[0];?>"></img>
									</div>	
									<br>
									
									<!--Muestra  el nombre del articulo-->
									<div id="art">
										<?php echo $registrolista[1];?>
									</div>
									
									<div id="coste">
									
										<!--Muesta el precio original tachado si está rebajado-->
										<div id="precio">
											<?php if ($registrolista[4]=="SI") { echo "<strike>"; }?>
											<b>Precio: <?php echo $registrolista[2] . " €";?></b>
											<?php if ($registrolista[4]=="SI") { echo "</strike>"; }?>
										</div>
										
										<!--Muestra el articulo con su nombre, precio original tachado y precio rebajado en rojo-->
										<?php if ($registrolista[4]=="SI") {?>
										<div class="rebajado">
											<b>Ahora: <?php echo $registrolista[3] . " €";?></b>
										</div><?php } ?>
									</div>
									<button id="boton" type="submit">
										<a href='comprar.php?referencia=<?php echo $registrolista[5];?>'>Comprar</a>
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
			
			<?php include('pie.php');?>	
			
		</div>
	</body>
</html>