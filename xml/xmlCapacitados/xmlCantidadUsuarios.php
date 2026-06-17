<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbCapacitados.class.php");
	require("../../objetos/usuario.class.php");
	
	$unidad 	  = $_POST['unidadUsuario'];
	$tipoUnidad = $_SESSION['USUARIO_TIPOUNIDAD'];
	
	$objUsuarios = new dbCapacitados;
	$objUsuarios->CantidadUsuarios($unidad,&$usuarios);
	$cantidad = count($usuarios);
	$titular = 0;
	$suplente = 0;
	for ($i=0; $i<$cantidad; $i++){
		if($usuarios[$i]->getPerfil()==10) $titular++;
		if($usuarios[$i]->getPerfil()==20) $suplente++;
	}
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
   	echo "<usuarios>";
   	echo "<titular>".$titular."</titular>";
   	echo "<suplente>".$suplente."</suplente>";
	 	echo "</usuarios>";
	echo "</root>";
?>