<?php

	session_start();		//inicia sesión
	session_destroy();		//cierra sesión
	
	header("location:index.php");
?>