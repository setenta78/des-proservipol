<?php
	// incluimos la conexión a MySQL

	include_once('dbcon.php');

	// variables para insertar datos a mysqli
	$codigo = strip_tags(trim($_POST["FUN_CODIGO"]));
    $rut = strip_tags(trim($_POST["FUN_RUT"]));
    $escalafon = strip_tags(trim($_POST["ESC_CODIGO"]));
    $grado = strip_tags(trim($_POST["GRA_CODIGO"]));
    $unidad = strip_tags(trim($_POST["UNI_CODIGO"]));
    $apaterno = strip_tags(trim($_POST["FUN_APELLIDOPATERNO"]));
    $amaterno = strip_tags(trim($_POST["FUN_APELLIDOMATERNO"]));
    $nombre = strip_tags(trim($_POST["FUN_NOMBRE"]));
    $nombre2 = strip_tags(trim($_POST["FUN_NOMBRE2"]));
    
    $query = "INSERT INTO clientes (nombre, email, pais, password) 
	VALUES('$nombre', '$email', '$pais', '$password')";
    
	if ($con->query($query)) {  
        return true;
    }else{
        return false;
    }

?>