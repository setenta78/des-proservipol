<?php
	// incluimos la conexión
	include "dbcon.php";

	// Variables para editar la tabla por id
	$codigo = $_POST["FUN_CODIGO"];
    $rut = $_POST["FUN_RUT"];
    $escalafon = $_POST["ESC_CODIGO"];
    $grado = $_POST["GRA_CODIGO"];
    $unidad = $_POST["UNI_CODIGO"];
    $apaterno = $_POST["FUN_APELLIDOPATERNO"];
    $amaterno = $_POST["FUN_APELLIDOMATERNO"];
    $nombre = $_POST["FUN_NOMBRE"];
    $nombre2 = $_POST["FUN_NOMBRE2"];
	
	
	// SQL para actualizar un registro	
	$query = "UPDATE clientes SET nombre='{$nombre}',email='{$email}',pais='{$pais}', password='{$password}' WHERE id='{$id}'";
	if ($con->query($query)) {
		echo 1;
	}else{
		echo 0;
	}
?>