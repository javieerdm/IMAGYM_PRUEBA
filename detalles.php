<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Detalles de los productos</title>
		<link rel="stylesheet" href="principal.css">
		<link rel="stylesheet" href="detalles.css">
		
	</head>	
	<body>
		<div id="body">		
		
			<?php include('cabecera.php');?>
			
			<section>	
				<div id="articulos">
				
					<!--izquierda-->
					<?php //include('navegador.php');?>
					
					
					<div id="derecha">
					<h6 class="volver"><a href="javascript:history.go(-1)"><img title="Volver atrás" src="imagenes/volver.jpg"></img></a></h6>
							
						<?php
						
							$ProductoID=$_GET["ProductoID"];
								
							$consultadetalles="SELECT * FROM productos WHERE ID='$ProductoID'";
							$resultadodetalles=mysqli_query($conexion, $consultadetalles);
							
							
							while ($registrodetalles=mysqli_fetch_row($resultadodetalles)){?>					
						
						<div id="producto">
							<div id="producto1">							
								<br>
								<!--Muestra la referencia del articulo-->	
								<div class="referencia">ID<?php echo " " . $registrodetalles[0];?></div>
								<br><br>

								<!--Muestra la imagen del articulo-->
								<div id="prenda"><img src="<?php echo $registrodetalles[2];?>"></img></div>
							</div>
							
							<div id="detalles">
							
								<!--Muestra el nombre del articulo-->
								<p id="art"><b><?php echo $registrodetalles[1];?></b></p>
								
								<!--Muestra el precio del articulo-->
								
								<p id="precio"><b>Precio: <?php echo $registrodetalles[3] . " €";?></b></p>
								
								
								<button id="comprar" type="submit">
									<form method='POST' <?php if (isset($_SESSION['cliente'])) { ?> action='./añadir-cesta.php?ProductoID=<?php echo $registrodetalles[0]; ?>' <?php } else { ?> action='login.php' <?php } ?>target='_self'>
									<label>
                                        Cantidad
                                    </label>
                                    <input type='number' name='cantidad' min='<?php if ($registrodetalles[4] > 0) {
                                                                                    echo "1";
                                                                                } else {
                                                                                    echo "0";
                                                                                } ?>' max='<?php echo $registrodetalles[4]; ?>' value='<?php if ($registrodetalles[4] > 0) {
                                                                                                                                        echo "1";
                                                                                                                                    } else {
                                                                                                                                        echo "0";
                                                                                                                                    } ?>' />
                                   
                                    <input type="submit" id="boton" value="COMPRAR">
								</button>
							</div>
							<br><br>	
						</div>											
						<?php } ?>
					</div>
				</div>	
			</section>
			
			<?php include('pie.php');?>	
		</div>
	</body>
</html>