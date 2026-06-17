<?php
	
	// Creamos las variables de conexión
	$servername = "172.21.100.41";
	$username = "proservipolv3";
	$password = "carta77";
	$database = "DB_PROSERVIPOL_V3";
	// Creamos la conexion con MySQL
	$con = new mysqli($servername, $username, $password, $database);
	// Revisamos la conexión
	if ($con->connect_error) {
	  	die("Conexión fallida: " . $con->connect_error);
	}else{
		echo "Conexión OK";
  }
?>