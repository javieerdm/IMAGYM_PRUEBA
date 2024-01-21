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
		
			<?php 
			require_once(__DIR__.'/vendor/autoload.php');
			$shieldon = new \Shieldon\Firewall\Integration\Bootstrap();
			$shieldon->run();

			include('cabecera.php');?>
			
			<section>			
					<div id="section1">
						<a href="producto.php?categoria=1"><div id="ropa"><span>Ropa deportiva</span></div></a>
						<a href="producto.php?categoria=2"><div id="material"><span>Material</span></div></a>
					</div>
					<div id="section2">
						<a href="producto.php?categoria=3"><div id="maquinas"><span>Máquinas</span></div></a>
						<a href="producto.php?categoria=4"><div id="suplementos"><span>Suplementos</span></div></a>
					</div>
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
		
		</div>
	</body>
</html>