<?php
	$server = "localhost";
	$user = "u106442988_uta";
	$password = "4&E&i1v?C";//poner tu propia contraseña, si tienes una.
	// $password = "admin1";//poner tu propia contraseña, si tienes una.
	$bd = "u106442988_inventario";

	$conexion = mysqli_connect($server, $user, $password, $bd);
	if (!$conexion){ 
		die('Error de Conexión: ' . mysqli_connect_errno());	
	}	
?>

