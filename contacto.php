<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Contacta con nosotros y resuelve tus dudas</title>
		<link rel="stylesheet" href="principal.css">
		<link rel="stylesheet" href="contacto.css">
		
	</head>	
	<body>
		<div id="body">		
		
			<?php include('cabecera.php');?>
			
			<section>			
				<div id="section">
					<div id="contactos">
						<form id="formu" action="insertarcontacto.php" method="POST">
							<fieldset>
								<legend class="cont">CONTACTAR</legend>
								<br>						
									<label class="cont">Nombre*</label>
									<br>							
									<input class="cont" type="text" name="nombre" size="30" required>
									<br><br>				
									<label class="cont">Correo electrónico*</label>
									<br>
									<input class="cont" type="email" name="correo" size="30" required>
									<br><br>
									<label class="cont">Mensaje*</label>
									<br>
									​<textarea class="cont" rows="8" cols="35" name="mensaje" required></textarea>
									
									<button class="boton" type="submit">Enviar</button>
							</fieldset>
						</form>
					</div>
					<div id="localizacion">
						<p class="direccion">GRUPO IMAGYM<br>C/ Doctor Beltrán Mateos N 10, 4ºA <br> 02002 Albacete<br>
						Teléfono de contacto: 969 12 34 78</p>
						<br>
						<iframe src="https://maps.app.goo.gl/1Fk1dQpwhwYmJ8yR7" 
						width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
			</section>			
			
			<?php include('pie.php');?>		
		
		</div>
	</body>
</html>