<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Todos los productos que puedes encontrar en nuestra tienda</title>
		<link rel="stylesheet" href="principal.css">
		<link rel="stylesheet" href="articulos.css">		
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
					
						<div id="titulo">
							<h1>Todos los artículos</h1>
							
						<?php
						
								$consultatodos="SELECT IMAGEN, NOMBRE, PRECIO, REBAJAS, REBAJADO, REFERENCIA, DESCUENTO FROM productos  ORDER BY precio ASC";
								$resultadotodos=mysqli_query($conexion, $consultatodos);
								
								$num_registros=12;				//paginación
								if(isset($_GET["pagina"])){
								$pagina=$_GET["pagina"];
								}
								else{
									$pagina=1;
								}				
								$total_registros=mysqli_num_rows($resultadotodos);
								$paginas_totales=ceil($total_registros/$num_registros);
								$empezar=($pagina-1)*$num_registros;
								$consultapaginacion="SELECT IMAGEN, NOMBRE, PRECIO, REBAJAS, REBAJADO, REFERENCIA, DESCUENTO FROM productos  ORDER BY precio ASC limit $empezar, $num_registros";
								$resultadopaginacion=mysqli_query($conexion,$consultapaginacion);							
								
						?>
						
						</div>
						
						<?php while ($registrotodos=mysqli_fetch_row($resultadopaginacion)){?>					
						<div id="producto">												
							<a href="detalles.php?referencia=<?php echo $registrotodos[5];?>">	
								<div id="producto1">
								
									<!--Muesrtra el texto "REBAJADO" en rojo si lo está, y si no lo está,  pone un salto de línea-->
									<h5>	<?php if ($registrotodos[4]=="SI"){
													echo "Rebajado"; 
												}else{
													echo "<br>";
												}
											?>
									</h5>
									
									<!--Muestra la imagen del articulo-->
									<div id="prenda">																			
										<img src="<?php echo $registrotodos[0];?>"></img>
									</div>	
									<br>
									
									<!--Muestra  el nombre del articulo-->
									<div id="art">
										<?php echo $registrotodos[1];?>
									</div>
									
									<div id="coste">
									
										<!--Muesta el precio original tachado si está rebajado-->
										<div id="precio">
											<?php 
										
												if ($registrotodos[4]=="SI") { echo "<strike>"; }?>
													<b>Precio: <?php echo $registrotodos[2] . " €";?></b>
											<?php if ($registrotodos[4]=="SI") { echo "</strike>";}?>
										</div>
										
										<!--Muestra el articulo con su nombre, precio original tachado y precio rebajado en rojo-->
										<?php if ($registrotodos[4]=="SI") {?>
										<div class="rebajado">
										
											<b>Ahora: <?php echo $registrotodos[3] . " €";?></b>
										</div><?php }?>
									</div>
									<button id="boton" type="submit">
										<a href='comprar.php?referencia=<?php echo $registrotodos[5];?>'>Comprar</a>
									</button>									
									<br><br>									
								</div>
							</a>									
						</div>											
						<?php } ?>
					</div>
				</div>
				<br>
				<center>
					<table margin="auto">
						<tr>
							<td class="paginacion">Página 
								<?php			
								for($i=1; $i<=$paginas_totales; $i++){
									echo "<a href='?pagina=".$i."'>" . $i .' '. "</a>";
										
									
								} ?>						
							</td>
						<tr>
					</table>
				</center>
			</section>
			<br>
			
			<?php include('pie.php');?>	
			
		</div>
	</body>
</html>