<?php
	// CONEXION A LA BASE DE DATOS
	
	include ('conexion.php');
		
		$nombre=$_POST["nombre"];
		$correo=$_POST["correo"];
		$mensaje=$_POST["mensaje"];
		
		$consultainsertarcontacto="INSERT INTO contacto(NOMBRE, CORREO, MENSAJE) 
		VALUES ('$nombre', '$correo', '$mensaje')";
	
		$resultadoinsertarcontacto=mysqli_query ($conexion, $consultainsertarcontacto);		
		
		echo "<script type='text/javascript'>alert('Su mensaje ha sido enviado. Gracias por contactar con nosotros. Le responderemos lo antes posible.');</script>";
		echo "<script type='text/javascript'>window.location.href='contacto.php';</script>";
		
	
?>

