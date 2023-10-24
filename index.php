<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>IMAGYM: Tienda online de productos para el gimnasio</title>
		<link rel="stylesheet" href="principal.css">
		<link rel="stylesheet" href="portada.css">

	</head>	
	<body>
		<div id="body">		
		
			<?php include('cabecera.php');?>
			
			<section>			
					<div id="section1">
						<a href="producto.php?categoria=1"><div id="ropa"></div></a>
						<a href="producto.php?categoria=2"><div id="material"></div></a>
					</div>
					<div id="section2">
						<a href="producto.php?categoria=3"><div id="maquinas"></div></a>
						<a href="producto.php?categoria=4"><div id="suplementos"></div></a>
					</div>				
			</section>
			
			<?php include('pie.php');?>		
		
		</div>
	</body>
</html>