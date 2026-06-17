<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbUsuarios.class.php");
	require("../../objetos/usuario.class.php");
	
	$claveActual 	= $_POST['claveActual'];		
	$claveNueva	 	= $_POST['nuevaClave'];
	$codigoUsuario  = $_POST['codigoUsuario'];		
	
	$objDBUsuarios = new dbUsuarios;
	$resultado = $objDBUsuarios->modificaClaveUsuario($codigoUsuario, $claveActual, $claveNueva);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<root>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</root>";

 ?>