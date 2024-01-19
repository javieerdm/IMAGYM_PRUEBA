<?php 

	// CONEXION A LA BASE DE DATOS
			
		include ('conexion.php');
		
		$usu=$_POST["usu"];
		$pass=$_POST["pass"];

		if (empty($usu) || empty($pass)) {
			header("Location: registro.php");
			exit;
		}
		
		$consultainsertarcliente="select ID, NOMBRE, EMAIL, CONTRASEÑA, ROL from Usuarios 
		where EMAIL='$usu' and CONTRASEÑA='$pass'";
		$resultadoinsertarcliente=mysqli_query($conexion, $consultainsertarcliente);
		$registroinsertarcliente=mysqli_num_rows($resultadoinsertarcliente);	/*numero de filas que tiene la tabla*/			
	
	
		if ($registroinsertarcliente=="1"){
			
			$fila=mysqli_fetch_row($resultadoinsertarcliente);
			$nom=$fila[1];
			$ID=$fila[0];
			$rol=$fila[4];

			
			session_start();
			$_SESSION["cliente"]=$nom;
			$_SESSION["codusuario"]=$ID;
			$_SESSION["rol"]=$rol;
			header("location:registrado.php");
		}		
		else{
			header("location:registro.php");
		}
	
?>		