<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>FORMULARIO</title>		
		<link rel="stylesheet" href="principal.css">
		<link rel="stylesheet" href="registro.css">
		
	</head>
	<body>
		<div id="body">		
		
			<?php include('cabecera.php');?>
			
			<section>

				<?php
				
					if(!isset($_SESSION['ID'])){
						header("location:index.php");
					}
					else{
						
						$condicion=$_SESSION['ID'];
						
						$consulta="select * from Usuarios where ID='$condicion'";
						$resultado=mysqli_query($conexion,$consulta); 
						$registro=mysqli_fetch_row($resultado);							
						
					}	
				?>	

				<div id="formulario">		  
				  <h2 id="reg">Mis datos</h2>
				  <br>
					<div id="datos">
						<form id="formregistro" method="POST">
							<label class="reg1">Nombre</label>
							<input type="text" name="NOMBRE" placeholder="NOMBRE"value="<?php echo $registro[3]; ?>"><br>
							<label class="reg1">Email</label>
							<input type="email" name="EMAIL" placeholder="EMAIL" value="<?php echo $registro[1]; ?>"><br>
							<label class="reg1">Contraseña</label>
							<input type="password" name="CONTRASEÑA" placeholder="CONTRASEÑA" value="<?php echo $registro[2]; ?>"><br>
								
							<button class='botonreg' type='submit'><a href="producto.php">Ir a tienda</a></p>
						</form>
					</div>
				</div>
				<br><br>
			</section>
			
			<?php include('pie.php');?>		
		
		</div>
	</body>
</html>