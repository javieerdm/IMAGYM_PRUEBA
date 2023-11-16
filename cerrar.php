<?php

	session_start();		//inicia sesión

	setcookie('carrito', '', time() - 3600, '/');

	
	session_destroy();		//cierra sesión
	
	header("location:index.php");
?>