<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>IMAGYM: Tienda online de productos para el gimnasio</title>
		<link rel="stylesheet" href="css/principal.css">
		<link rel="stylesheet" href="css/portada.css">

	</head>	
	<body>
		<div id="body">		
		
			<?php 
			require_once(__DIR__.'/vendor/autoload.php');
			$shieldon = new \Shieldon\Firewall\Integration\Bootstrap();
			$shieldon->run();

			include('cabecera.php');?>
			
		<section>			
			<section id="carousel">
			<a href="producto.php?categoria=1" class="slide" style="background-image: url(./imagenes/portada/ropa-deportiva.jpeg);">
            <span>Ropa Deportiva</span>
        </a>
        <a href="producto.php?categoria=2" class="slide" style="background-image: url(./imagenes/portada/material.png);">
            <span>Material</span>
        </a>
        <a href="producto.php?categoria=3" class="slide" style="background-image: url(./imagenes/portada/maquinas.jpeg);">
            <span>Máquinas</span>
        </a>
        <a href="producto.php?categoria=4" class="slide" style="background-image: url(./imagenes/portada/suplementacion.jpg);">
            <span>Suplementos</span>
        </a>
		<button id="prevButton" class="arrow">&lt;</button>
   		<button id="nextButton" class="arrow">&gt;</button>
    		</section>

					<script>
							<script>
							window.embeddedChatbotConfig = {
							chatbotId: "BvNu_1MgdthT_wsQMHZ_j",
							domain: "www.chatbase.co"
							}
							</script>
							<script
							src="https://www.chatbase.co/embed.min.js"
							chatbotId="BvNu_1MgdthT_wsQMHZ_j"
							domain="www.chatbase.co"
							defer>
							</script>
			</section>
			
			<?php include('pie.php');?>	
			<script src="carrusel.js"></script>
	
		
		</div>
	</body>
</html>