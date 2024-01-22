<!doctype html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Contacta con nosotros y resuelve tus dudas</title>
	<link rel="stylesheet" href="css/principal.css">
	<link rel="stylesheet" href="css/contacto.css">

</head>

<body>
	<div id="body">

		<?php include('cabecera.php'); ?>

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
					<iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d1096.492342994844!2d-1.8517710224634156!3d38.9845377307178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzjCsDU5JzA0LjIiTiAxwrA1MScwNS41Ilc!5e0!3m2!1ses!2ses!4v1698752162095!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</section>

		<?php include('pie.php'); ?>

	</div>
</body>

</html>