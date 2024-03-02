<?php
	$server = "localhost";
	$user = "root";
	$password = "admin1";//poner tu propia contraseña, si tienes una.
	// $password = "admin1";//poner tu propia contraseña, si tienes una.
	$bd = "inventario";

	$conexion = mysqli_connect($server, $user, $password, $bd);
	if (!$conexion){ 
		die('Error de Conexión: ' . mysqli_connect_errno());	
	}	
?>

