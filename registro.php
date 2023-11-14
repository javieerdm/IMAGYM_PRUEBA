<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Regístrate y encuentra nuestros mejores artículos con increíbles ofertas</title>
		<link rel="stylesheet" href="principal.css">
		<link rel="stylesheet" href="registro.css">

	</head>	
	<body>
		<div id="body">		
		
			<?php include('cabecera.php');?>
			
			<section>
				<?php		
					
				if (isset($_POST["crear"])){
					
						$NOMBRE=$_POST['NOMBRE'];
						$EMAIL=$_POST['EMAIL'];					
						$CONTRASEÑA=$_POST['CONTRASEÑA'];
						
						
						
						$consultaemail="Select * from Usuarios where EMAIL='$EMAIL'";
						$resultadoemail=mysqli_query($conexion, $consultaemail);
						$registroemail=mysqli_num_rows($resultadoemail);
						
						if($registroemail==1){
							echo "<script  type='text/javascript'>alert('El email ya existe');</script>";
						}else{						
							$consultainsertar="insert into Usuarios (NOMBRE, EMAIL, CONTRASEÑA, Rol)
							values ('$NOMBRE','$EMAIL', '$CONTRASEÑA', 'cliente')";						
							$resultadoinsertar=mysqli_query ($conexion, $consultainsertar);	
							
							echo "<script  type='text/javascript'>alert('Bienvenido a IMAGYM');</script>";							
							echo "<script type='text/javascript'>window.location.href='registrado.php';</script>";
						}
						
					
				}
				?>
				
			
				
				<div id="formulario">
					<h2 id="reg">Registro Nuevo Usuario</h2><br>
						<div id="datos">
							<form id="formregistro" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
								<label class="reg1">*Nombre</label>
								<input type="text" name="NOMBRE" required><br>
								<label class="reg1">*Email</label>
								<input type="email" name="EMAIL" required><br>								
								<label class="reg1">*Contraseña</label>
								<input type="password" name="CONTRASEÑA" required><br>
								
								<input class="terminos" type="checkbox" name="casilla" required>
								He leído y acepto los <a href="condiciones.php">términos y condiciones de uso.</a>
								<br>
							
								<button class='botonreg' type='submit' name='crear'>Enviar</button>
								<button class='botonreg' type='reset' >Limpiar</button>
								<br><br>
							</form>							
						</div>
					</form>
				</div>
				<br><br>				
		</section>
			
			<?php include('pie.php');?>		
		
		</div>
	</body>
</html>