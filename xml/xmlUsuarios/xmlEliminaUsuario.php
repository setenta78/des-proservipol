<?
	header ('content-type: text/xml');
	include("../configuracionBD4.php"); 
	require("../../baseDatos/dbUsuarios.class.php");
	require("../../objetos/usuario.class.php");
	
	$codigoUsuario  = $_POST['codigoUsuario'];		
	
	$objDBUsuarios = new dbUsuarios;
	$resultado = $objDBUsuarios->eliminaUsuario($codigoUsuario);
	
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
  	echo "<usuario>";
   	echo "<resultado>".$resultado."</resultado>";
   	echo "</usuario>";

 ?>